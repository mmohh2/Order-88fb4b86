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
$coachdata = $pdo->query('select * from series where id ='. $_GET['link']);
?>

<html>
<head>
</head>
<body>
<table>
    <?php
    foreach ($coachdata as $rij){
        ?>
        <tr>
            <td><?php echo "title: " . $rij['title']; ?></td>
            <td><?php echo "seasons: " . $rij['seasons']; ?></td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>
