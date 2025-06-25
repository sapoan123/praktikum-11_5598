<?php
$conn = new mysqli("localhost", "root", "", "prak_5598");

$id = (int)$_GET['id'];
$conn->query("DELETE FROM tasks WHERE id = $id");

header("Location: index.php");
