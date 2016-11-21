<?php

namespace nd2\Active_records;

use Nd2\Active_records\Book;

require './Books.php';

$books = new Book();
$books->loadAll();

if (!empty($books)) {
?>
<div>
    <table>
        <th>Id</th>
        <th>Title</th>
        <th>Year</th>
        <th>Genre</th>
        <th>Authors</th>
        <?php
        /** @var Book $book */
        foreach ($books as $book) {
            ;
            $id = $book->getBookId();
            echo $id;
            $title = $book->getTitle();
            $year = $book->getYear();
            $genre = $book->getGenre();
            $authors = $book->getAuthors();
            ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $title; ?></td>
                <td><?php echo $year; ?></td>
                <td><?php echo $genre; ?></td>
                <td><?php echo $authors; ?>
                </td>
            </tr>
            <?php
        } ?>
    </table>
    <?php
    } else { ?>
        <h2>No books found</h2>
        <?php
    } ?>
</div>