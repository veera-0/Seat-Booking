<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "booking";

/*

First create a table in the database i.e booking

command to create a table

create table reservations(name varchar(100) NOT NULL,roll_no varchar(10) primary key,branch varchar(10) NOT NULL,year varchar(2) NOT NULL,mobile varchar(10),seat varchar(20) NOT NULL);

*/

/*

Please fill the E8,I8 seats as they have been already select by default.
You can also remove if you don't want .. It's your call.

*/

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

//check selected seat if its already in db
$checkSeatQuery = "SELECT seat FROM reservations WHERE seat = ?";
$checkSeatStmt = $conn->prepare($checkSeatQuery);
$checkSeatStmt->bind_param("s", $selectedSeat);
$checkSeatStmt->execute();
$checkSeatStmt->store_result();

//check roll number if its already in db
$checkRollNoQuery = "SELECT roll_no FROM reservations WHERE roll_no = ?";
$checkRollNoStmt = $conn->prepare($checkRollNoQuery);
$checkRollNoStmt->bind_param("s", $rollno);
$checkRollNoStmt->execute();
$checkRollNoStmt->store_result();

if ($checkSeatStmt->num_rows > 0) {
    header("Location: selected_page_error.html"); 
    exit;
} elseif ($checkRollNoStmt->num_rows > 0) {
    header("Location: error_page.html"); 
    exit;
}

$sql = "INSERT INTO reservations (name, roll_no, branch, year, mobile, seat) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $name, $rollno, $branch, $year, $mobile, $selectedSeat);


if ($stmt->execute()) {
    header("Location: result.html"); 
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$checkSeatStmt->close();
$checkRollNoStmt->close();
$stmt->close();
$conn->close();
?>
