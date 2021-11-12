<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class BookSingleton
{
    private $author = 'Gamma, Helm, Johnson, and Vlissides';
    private $title  = 'Design Patterns';
    private static $book = NULL;
    private static $isLoanedOut = FALSE;


    private function __construct()
    {
        # code...
    }

    public static function borrowBook()
    {
        if(self::$isLoanedOut == FALSE){
            if(self::$book == NULL)
            {
                self::$book = new BookSingleton();
            }
            self::$isLoanedOut = TRUE;
            return self::$book;
        }else{
            return NULL;
        }
    }

    public function returnBook() {
        self::$isLoanedOut = FALSE;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthorAndTitle()
    {
        return $this->getTitle() . ' by ' . $this->getAuthor();
    }
}

class BookBorrower
{
    private $borrowedBook;
    private $haveBook = FALSE;

    public function __construct(){}

    public function getAuthorAndTitle()
    {
        if($this->haveBook == TRUE)
        {
            return $this->borrowedBook->getAuthorAndTitle();
        } else {
            return "I don't have the book";
        }
    }

    public function borrowBook()
    {
        $this->borrowedBook = BookSingleton::borrowBook();
        if($this->borrowedBook == NULL)
        {
            $this->haveBook = FALSE;
        }else {
            $this->haveBook = TRUE;
        }
    }
    function returnBook() {
        $this->borrowedBook->returnBook();
    }
   
}

/**
 * Initialization
 */

writeln('BEGIN TESTING SINGLETON PATTERN');
writeln('');

$bookBorrower1 = new BookBorrower();
$bookBorrower2 = new BookBorrower();

$bookBorrower1->borrowBook();
writeln('BookBorrower1 asked to borrow the book');
writeln('BookBorrower1 Author and Title: ');
writeln($bookBorrower1->getAuthorAndTitle());
writeln('');

$bookBorrower2->borrowBook();
writeln('BookBorrower2 asked to borrow the book');
writeln('BookBorrower2 Author and Title: ');
writeln($bookBorrower2->getAuthorAndTitle());
writeln('');

$bookBorrower1->returnBook();
writeln('BookBorrower1 returned the book');
writeln('');

$bookBorrower2->borrowBook();
writeln('BookBorrower2 Author and Title: ');
writeln($bookBorrower1->getAuthorAndTitle());
writeln('');

writeln('END TESTING SINGLETON PATTERN');

function writeln($line_in) {
  echo $line_in.'<br/>';
}