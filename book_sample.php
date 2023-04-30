<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['id'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    if ($id !== false && $id > 0) {
        // Use a whitelist of allowed image IDs to prevent directory traversal attacks
        $allowed_ids = array(1, 2, 3, 4, 5);
        if (in_array($id, $allowed_ids)) {
            // Add a timestamp to the image URL to prevent caching attacks
            $timestamp = time();
            echo '<img src="samples/' . $id . '.jpg?t=' . $timestamp . '">';
        } else {
            echo 'Invalid sample ID.';
        }
    } else {
        echo 'Invalid input.';
    }
} else {
    echo 'No sample ID was provided.';
}
?>
