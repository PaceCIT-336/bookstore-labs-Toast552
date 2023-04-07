<?php foreach($books as $id => $book) { ?>
  <section>
    <h2><?php echo $book->getTitle(); ?></h2>
    <img src="<?php echo $book->getImagePath(); ?>" alt="<?php echo $book->getTitle(); ?>">
    <p><?php echo $book->getDescription(); ?></p>
    <p><?php echo $book->getAuthor(); ?></p>
    <p><?php echo '$' . number_format($book->getPrice(), 2); ?></p>

    <form method="post" action="add_review.php">
      <input type="hidden" name="book_id" value="<?php echo $id; ?>">
      <label for="rating">Rating:</label>
      <select name="rating" id="rating">
        <option value="5">5</option>
        <option value="4">4</option>
        <option value="3">3</option>
        <option value="2">2</option>
        <option value="1">1</option>
      </select>
      <br>
      <label for="review">Review:</label>
      <textarea name="review" id="review"></textarea>
      <br>
      <input type="submit" value="Add Review">
   
