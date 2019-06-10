<?php
    require("./database/config.php");
?>

<?php

    if(isset($_POST["register"])){
        $uname = $_POST["username"];
        $em = $_POST["email"];
        $pw = $_POST["password"];
        $cpw = $_POST["cpassword"];
        $image = "\images\\profile_pic\\profile.jpg";

        if($pw != $cpw){
            return header("Location:register.php");
        }
        // check if the email alerady exits
        $query0 = "SELECT * FROM users WHERE email='$em'";

        $results0 = mysqli_query($con, $query0);

        $query1 = "SELECT * FROM users WHERE username='$uname'";

        $results1 = mysqli_query($con, $query1);

        if(mysqli_num_rows($results0) > 0){
            return header("Location:register.php");
        }
        if(mysqli_num_rows($results1) > 0){
            return header("Location:register.php");
        }

        $pw = hash("sha512", $pw);
        $query = "INSERT INTO users(username, email, password, image) VALUES('$uname', '$em', '$pw', '$image')";

        $results = mysqli_query($con, $query);
        return header("Location:index.php");
    }

?>