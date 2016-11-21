<?php
/**
 * Created by PhpStorm.
 * User: paulius
 * Date: 16.11.15
 * Time: 18.52
 */
namespace Nd2\DDD;

class BooksRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = new \PDO("mysql:host=localhost;dbname=knygos", 'root', 'root');

        if (!$this->connection) {
            die('Could not conenct to database');
        }
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param \PDO $connection
     * @return DbConnection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
        return $this;
    }

    public function findById($id)
    {

        $stmt = $this->connection->prepare("SELECT Books.* FROM Books
        WHERE bookId = $id;");
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return new Book($stmt->fetch());
    }

    public function findAllBooks()
    {
        $stmt = $this->connection->prepare('SELECT Books.title, GROUP_CONCAT(Authors.name) FROM Books INNER JOIN BooksWithAuthors ON Books.bookId = BooksWithAuthors.bookId INNER JOIN Authors ON  Authors.authorId=BooksWithAuthors.authorId GROUP BY Books.title;');


        $stmt->execute();
        return $stmt->fetchAll();
    }
}
