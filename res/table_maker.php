<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pup";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "
    CREATE TABLE users (
        email VARCHAR(255) PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        pword VARCHAR(255) NOT NULL,
        birthday DATE NOT NULL,
        gender VARCHAR(255) NOT NULL,
        region VARCHAR(255),
        province VARCHAR(255),
        type VARCHAR(255),
        image MEDIUMBLOB
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table users created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();
?>