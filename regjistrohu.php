<?php
$host = 'localhost';
$db_name = 'fooddelivery';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Emri = $_POST['emri'] ?? '';
    $Email = $_POST['email'] ?? '';
    $Password = $_POST['password'] ?? '';
    $Adresa = $_POST['adresa'] ?? '';
    $NrTel = $_POST['nrtel'] ?? '';

    $conn = new mysqli($host, 'root', '', $db_name);
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO regjistrimi (Emri, Email, Password, Adresa, NrTel) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $Emri, $Email, $Password, $Adresa, $NrTel);
        $stmt->execute();
        echo "Registration successful...";
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action="regjistrohu.php" method="post">
            <input type="text" name="emri" placeholder="emri">
            <input type="text" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <input type="text" name="adresa" placeholder="adresa">
            <input type="text" name="nrtel" placeholder="nr_tel">
            <input type="submit">
        </form>
</body>
</html>