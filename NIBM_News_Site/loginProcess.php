<?php
    require("./database/config.php");
?>

<?php

    if(isset($_POST["login"])){
        $em = $_POST["email"];
        $pw = $_POST["password"];

        $pw = hash("sha512", $pw);
        $query = "SELECT * FROM users WHERE email='$em' AND password='$pw'";

        $results = mysqli_query($con, $query);

        $row = mysqli_num_rows($results);
        if($row > 0){
            $query1 = "SELECT * FROM users WHERE email='$em'";
            $results1 = mysqli_query($con, $query1);
            $row = mysqli_fetch_array($results1);

            session_start();
            $_SESSION["uname"] = $row["username"];
            $_SESSION["uemail"] = $row["email"];
            return header("Location:index.php");
            
        }
        else{
            return header("Location:login.php");
        }
    }

?>