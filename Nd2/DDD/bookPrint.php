<?php

	use Nd2\DDD\BooksRepository;
	require 'Books.php';

	require './BooksRepository.php';

	if(isset($_GET['id'])) {

		$bookRep = new BooksRepository();
		$book = $bookRep->findById($_GET['id']);
	}
	if(!empty($book)) {
		?>
		<div>
			<table>
				<th>Title</th>
				<th>Year</th>
				<th>Genre</th>
				<th>Authors</th>
				<tr>
					<td><?php echo $book->getTitle() ?></td>
					<td><?php echo $book->getYear() ?></td>
					<td><?php echo $book->getGenre() ?></td>
					<td><?php echo $book->getAuthors() ?></td>
				</tr>
			</table>
		</div>

		<?php echo '<a href="../booksPrint.php/">Books list</a>';
	}

