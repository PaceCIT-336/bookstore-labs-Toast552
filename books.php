<?php 
class Book {
    private $title;
    private $author;
    private $blurb;
    private $image_location;
    private $price;

    public function __construct($title, $author, $blurb, $image_location, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->blurb = $blurb;
        $this->image_location = $image_location;
        $this->price = $price;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getBlurb() {
        return $this->blurb;
    }

    public function setBlurb($blurb) {
        $this->blurb = $blurb;
    }

    public function getImageLocation() {
        return $this->image_location;
    }

    public function setImageLocation($image_location) {
        $this->image_location = $image_location;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
}

$books = array();

$book1 = new Book(
    'Learning PHP',
    'David Sklar',
    'PHP is a great language for building web applications.',
    'assets/imgs/learningphp.jpg',
    '25.99'
);

$book2 = new Book(
    'JavaScript: The Definitive Guide',
    'David Flanagan',
    'This guide comprehensively covers the entire JavaScript language.',
    'assets/imgs/js-definitive-guide.jpg',
    '32.99'
);

$book3 = new Book(
    'HTML and CSS: Design and Build Websites',
    'Jon Duckett',
    'This book teaches the basics of creating websites using HTML and CSS.',
    'assets/imgs/html-css.jpg',
    '20.00'
);

$book4 = new Book(
    'PHP Objects, Patterns, and Practice',
    '',
    'This book shows how to use PHP to build sophisticated web applications.',
    'assets/imgs/php-objects.jpg',
    '38.50'
);

$books = array($book1, $book2, $book3, $book4);
