<?php

	use Nd2\Active_records\Book;

	require './Books.php';

	if(isset($_GET['id'])) {

		$book = new Book();
		$book->load($_GET['id']);
	}
	if(!empty($book)) {
		?>
		<div>
			<table>
				<th>Title</th>
				<th>Year</th>
				<th>Authors</th>
				<tr>

					<td><?php echo $book->getTitle() ?></td>
					<td><?php echo $book->getYear() ?></td>
					<td><?php echo $book->getAuthors() ?></td>
				</tr>
			</table>
		</div>

		<?php echo '<a href="../booksPrint.php/">List of books</a>';
	}

