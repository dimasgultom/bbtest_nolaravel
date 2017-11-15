<?php
header("Content-Type: application/json; charset=UTF-8");
include_once ('conn.php');

try {
  $stmt = $conn->prepare("SELECT * FROM game");
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $json = json_encode( $result, JSON_PRETTY_PRINT );
}
catch(PDOException $e) { echo "Error: " . $e->getMessage(); }
echo $json;
$conn = null;
?>
