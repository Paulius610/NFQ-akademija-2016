<?php
# Fill our vars and run on cli
# $ php -f booksData.php
$dbname = 'knygos';
$dbuser = 'root';
$dbpass = 'root';
$dbhost = 'localhost';
$bookId=$_GET['id'];

$connect = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($connect,$dbname) or die("Could not open the db '$dbname'");

$query = 'select Books.*, group_concat(booksGenres.genre SEPARATOR ",") as genre from booksGenres right join Books on booksGenres.bookId=Books.bookId where Books.bookId='.$bookId.' group by Books.bookId;';

$result = mysqli_query($connect,$query);

?>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<table>
<tr>
<td>id</td><td>Title</td><td>Year</td><td>Genre</td><td>Author</tr>
<?php
while($row = mysqli_fetch_array($result)) {

  echo '<tr><td>'.$row['bookId'].'</td><td>'.$row['title'].'</td><td>'.$row['year'].'</td><td>'.$row['genre'].'</td>';
$query2 = 'select Books.*, group_concat(Authors.name SEPARATOR ",") as Author from BooksWithAuthors inner join Books on BooksWithAuthors.bookId=Books.bookId inner join Authors on BooksWithAuthors.authorId=Authors.authorId where Books.bookId='.$row['bookId'].' group by Books.bookId';

$result2 = mysqli_query($connect,$query2);
while($row2 = mysqli_fetch_array($result2)){
echo '<td>'.$row2['Author'].'</td>';
}
'</tr>';
}
?>
</table>
</body>
</html>
