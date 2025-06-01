<?php
session_start();
/*if (!isset($_SESSION['super_admin_id'])) {
    header("Location: super_admin_login.php");
    exit;
}*/

$host = 'localhost';
$db = 'onlineshopbl_db';
$user = 'root';
$pass = 'LaulauJoy@2003';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tables = [];
    $stmt = $pdo->query("SHOW TABLES");
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        $tables[] = $row[0];
    }

    $backup = "";
    foreach ($tables as $table) {
        $create = $pdo->query("SHOW CREATE TABLE `$table`")->fetch(PDO::FETCH_ASSOC);
        $backup .= "-- Table structure for `$table`\n\n";
        $backup .= $create['Create Table'] . ";\n\n";

        $rows = $pdo->query("SELECT * FROM `$table`");
        while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
            $columns = array_map(function ($val) use ($pdo) {
                return $pdo->quote($val);
            }, array_values($row));
            $backup .= "INSERT INTO `$table` VALUES (" . implode(", ", $columns) . ");\n";
        }
        $backup .= "\n\n";
    }

    $filename = "backup_" . date("Y-m-d_H-i-s") . ".sql";
    header("Content-Type: application/sql");
    header("Content-Disposition: attachment; filename=$filename");
    echo $backup;
    exit;

} catch (PDOException $e) {
    echo "❌ Erreur de sauvegarde : " . $e->getMessage();
}
?>

