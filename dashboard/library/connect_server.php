<?php
function dbConnecting()
{
    // $hostname = 'localhost';
    // $username = 'root';
    // $password = '';
    // $database = 'delinepal';
    // $conn = mysqli_connect($hostname, $username, $password, $database);


    //   server user name 
        $servername = 'localhost';
        $username = 'delinepal_user';
        $password = 'QZIl@hF!2th[';
        $dbname = 'delinepal_delinepal';
      $conn = mysqli_connect($servername, $username, $password, $dbname);

    // echo "db connection in progresss";
    if (!$conn) {
        echo "unable to connect database";
        die();
    //  header("location:preload.php");
    }
    else {
        //  header("location:../../index.php");
        // echo "Connected";
        return $conn;
    }
}
?>