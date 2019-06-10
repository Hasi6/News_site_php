<?php
    require("./database/config.php");
?>

<?php

    if(isset($_POST["login"])){
        $em = $_POST["email"];
        $pw = $_POST["password"];


        $query = "SELECT * FROM users WHERE email='$em' AND password='$pw'";

        $results = mysqli_query($con, $query);

        $row = mysqli_num_rows($results);
        if($row > 0){
            return header("Location:index.php");
        }
        else{
            return header("Location:login.php");
        }
    }

?>