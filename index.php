<?php

$host = '127.0.0.1';
$db   = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
echo ('connected to ' . $db  . ' using ');
echo $pdo->query('select version()')->fetchColumn();

$series = $pdo->query('SELECT * FROM series');
$movies = $pdo->query('SELECT * FROM movies');

if (isset($_GET['order'])){
    if ($_GET['order'] == 'rating')
        $series = $pdo->query('SELECT * FROM series ORDER BY rating DESC');
    if ($_GET['order'] == 'title')
        $series = $pdo->query('SELECT * FROM series ORDER BY title ASC');
}


?>


<a href='index.php?order=title'>Title</a>
<a href='index.php?order=rating'>rating</a>

<?php
echo "<br/> <br/> <br/>" . "Series" . "<br/>";

$stmt = $pdo->query('SELECT * FROM netland.series ORDER BY rating;');
while ($row = $stmt->fetch())
{
    echo "<br/>" . $row['title'] . " - Rating:  " . $row['rating'] . "<a href='series.php?id=" . $row['id'] . "'> Meer informatie</a>";
}

echo "<br/> <br/> <br/>" . "Movies" . "<br/>";

$stmt = $pdo->query('SELECT * FROM netland.movies ORDER BY duur;');
while ($row = $stmt->fetch())
{
    echo "<br/>" . $row['title'] . " - Duur:  " . $row['duur'] . "min" . "<a href='films.php?id=" . $row['id'] . "'> Meer informatie</a>";
}

?>  