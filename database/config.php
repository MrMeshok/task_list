<?
$host = 'localhost';
$db   = 'tasklist';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$DB = new PDO($dsn, $user, $pass, $opt);
$DB->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
$DB->setAttribute(PDO::MYSQL_ATTR_DIRECT_QUERY, 0);
// $stmt = $pdo->query('SELECT login FROM users');
// while ($row = $stmt->fetch())
// {
//     echo $row['login'] . "\n";
// }