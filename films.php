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
$moviedata = $pdo->query('select * from movies where id ='. $_GET['link']);

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<table>
    <?php
    foreach ($moviedata as $row){
        ?>
    <tr>
        <td><?php echo "title: " .  $row['title']; ?></td>
        <td><?php echo "rating: " . $row['rating']; ?></td>
    </tr>
    <?php
    }

    ?>

</table>
</body>
</html>

