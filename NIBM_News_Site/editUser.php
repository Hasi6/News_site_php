<?php
    require_once("./includes/header.php");
    require_once("./database/config.php");
    if(!isset($_SESSION["uname"])){
      header("Location:index.php");
    }
?>

<?php
// Get user id using session username
    $username = $_SESSION["uname"];

    $query = "SELECT * FROM users WHERE username='$username'";
    $results = mysqli_query($con, $query);

    $row = mysqli_fetch_array($results);

    $userId = $row["userId"];

?>

<?php

    $query = "SELECT * FROM users WHERE userId=$userId";
    $results = mysqli_query($con , $query);
    $row = mysqli_fetch_array($results);

    $username = $row["username"];
    $email = $row["email"];
    $image = $row["image"];

    if(isset($_POST["edit"])){
        $username = $_POST["editUsername"];
        $email = $_POST["editEmail"];
        $filetmp= $_FILES['editImage']['tmp_name'];
        $filename = $_FILES['editImage']['name'];
        $filepath = "./images/profile_pic/";

        $query = "UPDATE users SET email='$email', image = '$filepath/$filename' WHERE userId=$userId";

        $results = mysqli_query($con, $query);
        move_uploaded_file($filetmp, $filepath.$filename);

        if($results){
            return header("Location:Users.php?uname=$username");
        }
    }

?>
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Contact Me</h1>
            <span class="subheading">Have questions? I have answers.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form name="sentMessage" id="contactForm" novalidate action="#" method="POST" enctype="multipart/form-data">
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Username</label>
              <input type="text" class="form-control" readonly value="<?php echo $username;?>" name="editUsername" placeholder="Name" id="name" required data-validation-required-message="Please enter your Username.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Email Address</label>
              <input type="email" class="form-control" value="<?php echo $email;?>" name="editEmail" placeholder="Email Address" id="email">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <img src="<?php echo $image;?>" class="mt-4" style='width:400px; height:300px'>
              <input class="form-control mt-4" type="file" name="editImage">
            </div>
          </div>
          
          
          <br>
          <div id="success"></div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" id="sendMessageButton" name="edit">Edit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
    require_once("./includes/footer.php");
?>