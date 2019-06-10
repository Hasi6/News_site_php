<?php
    require_once("./database/config.php");
    
    session_start();
            if(isset($_SESSION["uname"])){
            $_SESSION["uname"];
            $_SESSION["uemail"];
            }
?>

<?php

    if(isset($_POST["post"])){
        $um = $_SESSION["uname"];
        $ti = $_POST["title"];
        $st = $_POST["subtitle"];
        $ps = $_POST["body"];
        $filetmp= $_FILES['image']['tmp_name'];
        $filename = $_FILES['image']['name'];
        $filepath = "./images/update/";



        $query = "INSERT INTO posts (username, title, subtitle, body, image) VALUES ('$um', '$ti', '$st', '$ps', '$filepath/$filename')";

        $results = mysqli_query($con, $query);
        move_uploaded_file($filetmp, $filepath.$filename);
        if($results){
            return header("Location:index.php");
        }
    }

?>