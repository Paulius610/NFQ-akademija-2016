<?php
/**
 * Created by PhpStorm.
 * User: paulius
 * Date: 16.11.15
 * Time: 17.49
 */
namespace Nd2\Active_records;


class Book {

  private $bookId;

  private $title;

  private $year;

  private $authors;

  private $genre;

  public function __construct()
  {
  }

  public function constructor($row)
  {
    $this->title = $row['title'];
    $this->year = $row['year'];
    $this->genre = $row['genre'];
    $this->authors = $row['authors'];
    $this->bookId = $row['bookId'];
  }

    /**
     * @return mixed
     */
    public function getBookId()
    {
        return $this->bookId;
    }

    /**
     * @param mixed $bookId
     * @return Book
     */
    public function setBookId($bookId)
    {
        $this->bookId = $bookId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     * @return Book
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param mixed $authors
     * @return Book
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     * @return Book
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }



  public function load($id) {
    $servername = "localhost";
    $username = "root";
    $password = "root";

    $conn;
    try {
      $conn = new \PDO("mysql:host=$servername;dbname=knygos", $username, $password);

      $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    $sql = "SELECT Books.*, GROUP_CONCAT(Authors.name) AS authors FROM Books
        LEFT JOIN  BooksWithAuthors ON Books.bookId =  BooksWithAuthors.bookId
        LEFT JOIN Authors ON  Authors.authorId= BooksWithAuthors.authorId
        WHERE Books.bookId=$id";
    foreach ($conn->query($sql) as $row) {
      $this->bookId = $row['bookId'];
      $this->title = $row['title'];
      $this->year = $row['year'];
      $this->genre = $row['genre'];
      $this->authors =$row['authors'];
    }
  }
  public function loadAll()
  {
    $servername = "localhost";
    $username = "root";
    $password = "root";

    $conn;
    try {
      $conn = new \PDO("mysql:host=$servername;dbname=knygos", $username, $password);

      $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    $stmt = $connection->prepare('SELECT Books.title, GROUP_CONCAT(Authors.name) FROM Books INNER JOIN BooksWithAuthors ON Books.bookId = BooksWithAuthors.bookId INNER JOIN Authors ON  Authors.authorId=BooksWithAuthors.authorId GROUP BY Books.title;');
    $stmt->execute();
    $objArray = $stmt->fetchAll();
      var_dump($objArray);
    foreach ($objArray as $key => $obj){
      $objArray[$key] = new Book($obj);
    }
    return $objArray;
  }
}