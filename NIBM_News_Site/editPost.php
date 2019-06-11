<?php
    require_once("./includes/header.php");
    require_once("./database/config.php");

    if(!isset($_SESSION["uname"])){
      header("Location:pageNotFound.php");
      exit();
    }

    if(!isset($_GET["id"])){
      header("Location:pageNotFound.php");
      exit();
    }

    $id = $_GET["id"];
    $query = "SELECT * FROM posts WHERE id=$id";
    $results = mysqli_query($con, $query);

    $row = mysqli_fetch_array($results);

    if($row <= 0){
      header("Location:pageNotFound.php");
      exit();
    }

    $title = $row["title"];
    $subtitle = $row["subtitle"];
    $body = $row["body"];
    $image = $row["image"];

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
        <form name="sentMessage" id="contactForm" action="#" method="POST" novalidate enctype="multipart/form-data">
          
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Title</label>
              <input type="email" class="form-control" value="<?php echo $title; ?>" name="editTitle" placeholder="Title" id="email" required data-validation-required-message="Please enter your email address.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Subtitle</label>
              <input type="text" class="form-control" value="<?php echo $subtitle; ?>" name="editSubtitle" placeholder="SubTitle" id="email" required data-validation-required-message="Please enter your email address.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Post</label>
              <textarea rows="5" class="form-control" name="editBody" placeholder="Post.." id="message" required data-validation-required-message="Please enter a message."><?php echo $body; ?></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Subtitle</label>
              <img src="<?php echo $image; ?>" style="width:400px; height:300px" alt="">
              <input type="file" value="<? echo $image; ?>" class="form-control mt-4" name="editImage" id="email" required data-validation-required-message="Please enter your email address.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div id="success"></div>
          <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary btn-block" name="editPost" id="sendMessageButton">Edit</button>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php

    if(isset($_POST["editPost"])){
        $et = $_POST["editTitle"];
        $est = $_POST["editSubtitle"];
        $eb = $_POST["editBody"];
        $filetmp= $_FILES['editImage']['tmp_name'];
        $filename = $_FILES['editImage']['name'];
        $filepath = "./images/update/";

        
        $query = "UPDATE posts SET title='$et', subtitle='$est', body='$eb', image = '$filepath/$filename' WHERE id=$id";

        $results = mysqli_query($con, $query);
        move_uploaded_file($filetmp, $filepath.$filename);

        if($results){
            echo "<script>window.open('post.php?id=$id', '_self')</script>";
        }
    }

?>


<?php
    require_once("./includes/footer.php");
?>