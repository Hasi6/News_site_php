<?php
    require_once("./includes/header.php");
    require_once("./database/config.php");
?>
<?php
    if(!isset($_GET["id"])){
        header("Location:pageNotFound.php");
        exit();
    }
    if(!isset($_SESSION["uname"])){
        header("Location:pageNotFound.php");
        exit();
    }

    $username = $_SESSION["uname"];
    $id = $_GET["id"];

    $query = "SELECT * FROM posts WHERE username='$username' AND id=$id";
    $results = mysqli_query($con, $query);

    if(mysqli_num_rows($results) <= 0){
        header("Location:pageNotFound.php");
        exit();
    }

    $query = "DELETE FROM posts WHERE id=$id";
    $results = mysqli_query($con, $query);

    if($results){
        header("Location:users.php?uname=$username");
    }
   

?>