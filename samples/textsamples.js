var xhr = new XMLHttpRequest();

xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
        if (xhr.status === 200) {
            // Sanitize response text
            var sanitized_response = xhr.responseText.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
            document.getElementById('sampleBody').innerHTML = sanitized_response;
        } else {
            console.error('Request failed with status ' + xhr.status);
            // Display error message to user
            document.getElementById('sampleBody').innerHTML = 'Failed to load sample.';
        }
        // Reset the modal content to show the loading icon
        document.getElementById('sampleBody').innerHTML = '<div class="loader"></div>';
        // Remove the loading icon
        document.getElementById('sampleModal').style.display = 'block';
    }
};

// Add timestamp to prevent caching attacks
var timestamp = new Date().getTime();

xhr.open('POST', 'book_sample.php?t=' + timestamp);
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

// Validate bookid before sending the request
var bookid = document.getElementById('bookid').value;
if (bookid && !isNaN(bookid) && bookid > 0) {
    xhr.send('id=' + bookid);
} else {
    console.error('Invalid book ID: ' + bookid);
    // Display error message to user
    document.getElementById('sampleBody').innerHTML = 'Invalid book ID.';
    // Remove the loading icon
    document.getElementById('sampleModal').style.display = 'block';
}
