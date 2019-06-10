<?php
    require_once("./database/config.php");
?>
<?php

    $query = "SELECT * FROM posts";

    $results = mysqli_query($con, $query);

    while($row = mysqli_fetch_array($results)){
        
    }

?>