<?php
    require_once("./database/config.php");
?>
<?php
session_start();
if(!isset($_SESSION["uname"])){
    header("Location:post.php");
}

if(!isset($_GET["id"])){
    header("Location:post.php");
}
$id = $_GET["id"];
    if(isset($_POST["postComment"])){
        $comment = $_POST["comment"];
        $userFrom = $_SESSION["uname"];

        $query = "INSERT INTO comments (body, userFrom, postId) VALUES('$comment', '$userFrom', '$id')";

        $results = mysqli_query($con, $query);

        if($results){
            header("Location:index.php");
        }
    }

?>