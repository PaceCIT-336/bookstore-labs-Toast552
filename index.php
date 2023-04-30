<div class="review">
  <div class="carousel" role="listbox" aria-label="Book Reviews">
    <?php $counter = 0; foreach ($books as $id => $book) { ?>
      <section class="review__item" role="option" aria-label="<?= htmlspecialchars($book->getTitle(), ENT_QUOTES); ?>">
        <h2><?= htmlspecialchars($book->getTitle(), ENT_QUOTES); ?></h2>
        <figure>
          <img src="<?= htmlspecialchars($book->getImagePath(), ENT_QUOTES); ?>" alt="<?= htmlspecialchars($book->getTitle(), ENT_QUOTES); ?>">
          <figcaption><?= htmlspecialchars($book->getTitle(), ENT_QUOTES); ?></figcaption>
        </figure>
        <p><?= htmlspecialchars($book->getDescription(), ENT_QUOTES); ?></p>
        <p>By <?= htmlspecialchars($book->getAuthor(), ENT_QUOTES); ?></p>
        <p><?= '$' . number_format($book->getPrice(), 2); ?></p>
        <form method="post" action="add_review.php">
          <label for="rating<?= $id; ?>">Rating:</label>
          <select name="rating" id="rating<?= $id; ?>" required>
            <option value="" selected disabled hidden>Choose a rating</option>
            <option value="5">5 - Excellent</option>
            <option value="4">4 - Very Good</option>
            <option value="3">3 - Good</option>
            <option value="2">2 - Fair</option>
            <option value="1">1 - Poor</option>
          </select>
          <br>
          <label for="review<?= $id; ?>">Review:</label>
          <textarea name="review" id="review<?= $id; ?>" rows="4" cols="50" placeholder="Enter your review here" required></textarea>
          <br>
          <input type="hidden" name="book_id" value="<?= htmlspecialchars($id, ENT_QUOTES); ?>">
          <input type="hidden" name="index" value="<?= $counter ?>">
          <input type="submit" value="Submit Review">
        </form>
        <?php $counter++; ?>
      </section>
    <?php } ?>
  </div>
  <button class="prev" aria-label="Previous">&lt;</button>
  <button class="next" aria-label="Next">&gt;</button>
</div>

<script>
  function createCarousel(carouselSelector, prevSelector, nextSelector) {
    const carousel = document.querySelector(carouselSelector);
    const articles = carousel.querySelectorAll('.review__item');
    const prevButton = document.querySelector(prevSelector);
    const nextButton = document.querySelector(nextSelector);
    let currentIndex = 0;

    if (!carousel) {
      console.error(`Carousel element ${carouselSelector} not found.`);
      return;
    }

    if (articles.length === 0) {
      console.error(`No carousel items found in ${carouselSelector}.`);
      return;
    }

    if (!prevButton) {
      console.error(`Previous button ${prevSelector} not found.`);
      return;
    }

    if (!nextButton) {
      console.error(`Next button ${nextSelector} not found.`);
      return;
    }

    prevButton.addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + articles.length) % articles.length;
      updateCarousel();
    });

    nextButton.addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % articles.length;
      updateCarousel();
    });

    function updateCarousel() {
      articles.forEach(article => article.classList.remove('active'));
      articles[currentIndex].classList.add('active');
    }
  }

 
  <!-- copy into index head -->
<link rel="stylesheet" type="text/css" href="assets/modal.css">
<script src="assets/textSamples.js" defer></script>

<!-- copy at the bottom of index body -->
<!-- The Modal -->
    <div id="sample" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span id="closeSample" class="close">&times;</span>
                <h2>Text Sample</h2>
                <h3 id="bookTitle"></h3>
            </div>
            <div class="container">
                <div id="sampleBody" class="modal-body">
                    
                </div>
            </div>
        </div>
        <script>
            let modal = document.getElementById('sample')
            let close = document.getElementById('closeSample')
            function hideSample() {
                modal.style.display = 'none'
            }
            close.onclick = hideSample
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </div>