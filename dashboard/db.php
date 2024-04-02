<?php
    $conn = mysqli_connect("localhost", "root", "", "auspicious_cluster");
    date_default_timezone_set("Asia/Kolkata");
    if (!$conn) {
        echo "not connected database";
    }    
?>