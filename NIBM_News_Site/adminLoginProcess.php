<?php
    require_once("./database/config.php");
?>

<?php
    if(!isset($_POST["adminLogin"])){
        echo "<script>window.open('adminLog.php', '_self')</script>";   
    }

    if(isset($_POST["adminLogin"])){
        $un = $_POST["adminUsername"];
        $pw = $_POST["adminPassword"];

        $query = "SELECT * FROM users WHERE username='$un' AND password='$pw'";

        $results = mysqli_query($con, $query);

        if(mysqli_num_rows($results) <= 0){
            echo "<script>window.open('adminLog.php', '_self')</script>";
            exit();
        }
        echo "<script>window.open('admin.php', '_self')</script>";

    }
?>