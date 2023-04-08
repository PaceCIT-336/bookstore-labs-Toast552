<?php foreach ($books as $id => $book) { ?>
  <article>
    <h2><?php echo htmlspecialchars($book->getTitle()); ?></h2>
    <figure>
      <img src="<?php echo htmlspecialchars($book->getImagePath()); ?>" alt="<?php echo htmlspecialchars($book->getTitle()); ?>">
      <figcaption><?php echo htmlspecialchars($book->getTitle()); ?></figcaption>
    </figure>
    <p><?php echo htmlspecialchars($book->getDescription()); ?></p>
    <p>By <?php echo htmlspecialchars($book->getAuthor()); ?></p>
    <p><?php echo '$' . number_format($book->getPrice(), 2); ?></p>
    <form method="post" action="add_review.php">
      <label for="rating">Rating:</label>
      <select name="rating" id="rating" required>
        <option value="" selected disabled hidden>Choose a rating</option>
        <option value="5">5 - Excellent</option>
        <option value="4">4 - Very Good</option>
        <option value="3">3 - Good</option>
        <option value="2">2 - Fair</option>
        <option value="1">1 - Poor</option>
      </select>
      <br>
      <label for="review">Review:</label>
      <textarea name="review" id="review" rows="4" cols="50" placeholder="Enter your review here" required></textarea>
      <br>
      <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($id); ?>">
      <input type="submit" value="Submit Review">
    </form>
  </article>
<?php } ?>
