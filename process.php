<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "booking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$rollno = $_POST['rollno'];
$branch = $_POST['branch'];
$year = $_POST['year'];
$mobile = $_POST['mobile'];
$selectedSeat = $_POST['selected-seat'];

$sql = "INSERT INTO reservations (name, roll_no, branch, year, mobile, seat) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $name, $rollno, $branch, $year, $mobile, $selectedSeat);

if ($stmt->execute()) {
    header("Location: result.html");
    exit;
} else {
    if ($stmt->errno == 1062) { 
        header("Location: error_page.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>
