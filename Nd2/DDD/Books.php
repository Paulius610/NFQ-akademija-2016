<?php
/**
 * Created by PhpStorm.
 * User: paulius
 * Date: 16.11.15
 * Time: 17.49
 */
namespace Nd2\DDD;


class Book {

  private $bookId;

  private $title;

  private $year;

  private $authors;

  private $genre;

  public function __construct($row) {
    $this->title = $row['title'];
    $this->year = $row['year'];
    $this->genre = $row['genre'];
    $this->authors = $row['authors'];
    $this->bookId = $row['bookId'];
  }

  
  
  /**
   * @return mixed
   */
  public function getBookId() {
    return $this->bookId;
  }

  /**
   * @param mixed $bookId
   */
  public function setBookId($bookId) {
    $this->bookId = $bookId;
  }

  /**
   * @return mixed
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * @param mixed $title
   */
  public function setTitle($title) {
    $this->title = $title;
  }

  /**
   * @return mixed
   */
  public function getYear() {
    return $this->year;
  }

  /**
   * @param mixed $year
   */
  public function setYear($year) {
    $this->year = $year;
  }

  /**
   * @return mixed
   */
  public function getAuthors() {
    return $this->authors;
  }

  /**
   * @param mixed $authors
   */
  public function setAuthors($authors) {
    $this->authors = $authors;
  }

  /**
   * @return mixed
   */
  public function getGenre() {
    return $this->genre;
  }

  /**
   * @param mixed $genre
   */
  public function setGenre($genre) {
    $this->genre = $genre;
  }
}