<?php
    require("./database/config.php");
?>

<?php

    if(isset($_POST["register"])){
        $uname = $_POST["username"];
        $em = $_POST["email"];
        $pw = $_POST["password"];
        $cpw = $_POST["cpassword"];

        if($pw != $cpw){
            return header("Location:register.php");
        }

        $query = "INSERT INTO users(username, email, password) VALUES('$uname', '$em', '$pw')";

        $results = mysqli_query($con, $query);
    }

?>