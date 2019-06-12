<?php
    require_once("./database/config.php");

    if(!isset($_SESSION["uname"])){
        header("Location:pageNotFound.php"); 
    }

    if(isset($_SESSION["uname"])){
        $_SESSION["uname"];
        $_SESSION["uemail"];
    }

    if(isset($_POST["edit"])){
        $username = $_POST["editUsername"];
        $email = $_POST["editEmail"];
        $filetmp= $_FILES['editImage']['tmp_name'];
        $filename = $_FILES['editImage']['name'];
        $filepath = "./images/profile_pic/";

        $query = "INSERT INTO users (username, email, image) VALUES ('$username', '$email', '$filepath/$filename') WHERE userId";

        $results = mysqli_query($con, $query);
        move_uploaded_file($filetmp, $filepath.$filename);

        if($results){
            return header("Location:index.php");
        }
    }