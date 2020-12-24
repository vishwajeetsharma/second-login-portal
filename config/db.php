<?php

require('constants.php');

$conn = new mysqli("localhost", "root", "", "try");


if ($conn->connect_error) {
    die('Database error ' .$conn->connect_error);
}
?>