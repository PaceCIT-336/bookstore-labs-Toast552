<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Rainy Bookstore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/styles.css">
    <?php session_start();
    include_once("cart.php"); ?>
</head>
<?php
// Define a constant for the base directory of the website
define('BASE_DIR', __DIR__);

// Include the books.php file
require_once(BASE_DIR . '/books.php');

// Check if the $books array is empty or not
if (empty($books)) {
    echo 'No books found.';
    exit;
}

// Loop through the books array to output the same thing for each book
foreach ($books as $book) {
    // Check if all the required properties exist for each book object
    if (!isset($book->title, $book->image_location, $book->price)) {
        continue; // Skip this book if any of the required properties are missing
    }

    // Check if the image file exists for each book
    $image_path = BASE_DIR . '/' . $book->image_location;
    if (!file_exists($image_path)) {
        $image_path = 'https://via.placeholder.com/300x400?text=No+Image'; // Use a placeholder image if the image file is missing
    }

    // Output the book section element
    ?>
    <section class="book">
        <img src="<?php echo $image_path ?>" alt="<?php echo $book->title ?>" />
        <h2><?php echo $book->title ?></h2>
        <?php if (isset($book->author)): ?>
            <h3><?php echo $book->author ?></h3>
        <?php endif; ?>
        <p><?php echo $book->blurb ?></p>
        <p class="price">$<?php echo $book->price ?></p>
        <button>Add to Cart</button>
    </section>
    <?php
}
?>

<body>
    <header>
        <h1><a href="index.php">Rainy Bookstore</a></h1>
    </header>
    <main class="container shop">
        <div class="container">
        <section class="tile">
            <img src="assets/imgs/learningphp.jpg">
            <h3>Learning PHP, MySQL & JavaScript</h3>
            <p>Robin Nixon.<br>
                A step-by-step guide to creating dynamic websites.</p>
            <p>$60</p>
            <form name="phpbookform" id="phpbookform" action="" method="POST">
                <input type="hidden" name="title" value="Learning PHP, MySQL & JavaScript">
                <input type="hidden" name="price" value="60">
                <button type="submit">Add to Cart</button>
            </form>
        </section>
        <section class="tile">
            <img src="assets/imgs/learningpython.jpg">
            <h3>Learning Python</h3>
            <p>Mark Lutz.<br>
                Powerful Object-Oriented Programming</p>
            <p>$49</p>
            <form name="pybookform" id="pybookform" action="" method="POST">
                <input type="hidden" name="title" value="Learning Python">
                <input type="hidden" name="price" value="49">
                <button type="submit">Add to Cart</button>
            </form>
        </section>
        <section class="tile">
            <img src="assets/imgs/htmlcss.jpg">
            <h3>HTML & CSS 9th Ed</h3>
            <p>Joe Casabona.<br>
                Design and build webpages</p>
            <p>$35</p>
            <form name="htmlbookform" id="htmlbookform" action="" method="POST">
                <input type="hidden" name="title" value="HTML & CSS 9th Ed">
                <input type="hidden" name="price" value="35">
                <button type="submit">Add to Cart</button>
            </form>
        </section>
        <section class="tile">
            <img src="assets/imgs/dictionary.jpg">
            <h3>American Heritage Dictionary</h3>
            <p>The English Language.</p>
            <p>$55</p>
            <form name="dictbookform" id="dictbookform" action="" method="POST">
                <input type="hidden" name="title" value="American Heritage Dictionary">
                <input type="hidden" name="price" value="55">
                <button type="submit">Add to Cart</button>
            </form>
        </section>
    </div>
    <aside id="cart">
        <img src="assets/imgs/cart.png">
        <p id="cartSummary">
            Items: <?php echo count($_SESSION["items"]); ?><br><br>
            Total: $<?php echo $_SESSION["total"]; ?>
        </p>
        <form id="checkoutform" name="checkoutform" action="checkout.php" method="POST">
            <input type="hidden" name="cart" id="cartInput" value="<?php echo implode("|", $_SESSION["items"]); ?>">
            <input type="hidden" name="total" id="totalInput" value="<?php echo $_SESSION["total"]; ?>">
            <button id="checkout">Checkout</button>
        </form>
        <form id="clearform" name="clearform" action="" method="POST">
            <button id="clearCart" name="clear" value="clear">Clear Cart</button>
        </form>
    </aside>
    </main>
</body>

</html>