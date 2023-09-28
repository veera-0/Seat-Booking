<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "booking";

$stylesheet_url = "styles.css";
echo "<link rel='stylesheet' href='{$stylesheet_url}'>";

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



$sql = "INSERT INTO reservations (name, roll_no, branch, year, mobile, seat) VALUES ('$name', '$rollno', '$branch', '$year', '$mobile', '$selectedSeat')";

//get columns to check the roll number
$data = "SELECT roll_no from reservations";
$result = $conn->query($data);

while($row = $result->fetch_assoc()){
    $roll = $row['roll_no'];
    if($roll == $rollno){
        echo "Alreay seat booked through this roll no";
        exit;
    }
    else if($conn->query($sql) === TRUE){
        header("Location: result.html");
        exit;
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}

// if ($conn->query($sql) === TRUE) {
//     header("Location: result.html");
//     exit;
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

$conn->close();
?>
