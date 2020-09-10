<?php
    require_once('conn.php');
    
    if (empty($_POST['name'])) {
        die('Please write your name!');    
    }

    $name = $_POST['name'];

    $sql = sprintf("INSERT INTO Ronn_users (name) VALUES ('%s')", $name);

    $result = $conn->query($sql);
    
    if (!$result) {
        die($conn->error);
    }

    header("Location: index.php");

    // while ($row = $result->fetch_assoc()) {
    //     echo $row['name'] . "<br>";
    // }
?>
