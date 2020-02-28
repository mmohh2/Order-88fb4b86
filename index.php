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
    throw new \PDOException($e->getMessage("no connection"), (int)$e->getCode());
}
if(isset($_GET['orderby'])){
    if($_GET['orderby']=="ascend") {
        $moviedata = $pdo->query('select * from movies order by id asc');
        $coachdata = $pdo->query('select * from series order by id asc');}
    if($_GET['orderby']=="descend") {
        $moviedata = $pdo->query('select * from movies order by id desc');
        $coachdata = $pdo->query('select * from series order by id desc');}}
else {
    $moviedata = $pdo->query('select * from movies');
    $coachdata = $pdo->query('select * from series');
}
?>

<html>
<head>
</head>
<body>
<table>
    <tr>
        <form method="get">
            <td><input name="orderby" type="submit" value="ascend"></td>
            <td><input name="orderby" type="submit" value="descend"></td>
        </form>
    <tr>
        <?php
        foreach ($moviedata as $row){
        ?>
    <tr>
        <td>
            <form action="movies.php" method="get">
                <a href="movies.php">
                    <input name="link" type="submit" value="<?php echo $row['id'] ?>">
                </a>
            </form>
            <?php echo "title: " .  $row['title']; ?></td>
        <td><?php echo "rating: " . $row['rating']; ?></td>
        <td><?php echo "director: " . $row['director']; ?></td>
        <td><?php echo "Release Date: " . $row['release_date']; ?></td>
    </tr>
    <?php
    }
    ?>
    <?php
    foreach ($coachdata as $rij){
        ?>
        <tr>
            <td>
                <form action="series.php" method="get">
                    <a href="series.php">
                        <input name="link" type="submit" value="<?php echo $rij['id'] ?>">
                    </a>
                </form>
                <?php echo "title: " . $rij['title']; ?></td>
            <td><?php echo "rating: " . $rij['rating']; ?></td>
            <td><?php echo "seasons: " . $rij['seasons']; ?></td>
            <td><?php echo "Awards: " . $rij['has_won_awards']; ?></td>
            <td><?php echo "Country: " . $rij['country']; ?></td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>