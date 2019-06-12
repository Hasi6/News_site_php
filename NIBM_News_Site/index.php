<?php
    require_once("./includes/header.php");
    require_once("./database/config.php");
?>
<!-- Page Header -->
<header class="masthead headerIndex" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Welcome <?php if(isset($_SESSION['uname'])){echo $_SESSION['uname'];} else{echo "Guest";} ?></h1>
            <span class="subheading">A Blog Theme by Start Bootstrap</span>
          </div>
        </div>
      </div>
    </div>
  </header>
          <h1 class="text-center">Admin Messages</h1>

          <?php
          $usernameAdmin = "admin";
            $query = "SELECT * FROM posts WHERE username='$usernameAdmin' ORDER BY date DESC LIMIT 0,1";
            $results =  mysqli_query($con, $query);
            $row = mysqli_fetch_array($results);

            $title = $row["title"];
            $subTitle = $row["subtitle"];
            $body = $row["body"];
            $image = $row["image"];
          ?>
          <header class="container-fluid masthead headerIndex" style="background-image: url('<?php if(mysqli_num_rows($results) > 0){echo $image;} ?>')">;
          <div class="overlay"></div>
            <div class="container">
              <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                  <div class="site-heading">
                    <h1><?php echo $title;?></h1>
                    <span class="subheading"><?php echo $subTitle;?></span>
                    <span class="subheading"><?php echo $body;?></span>
                  </div>
                </div>
              </div>
            </div>
          </header>
  <!-- Main Content -->
  <div class="mainContainer">
    
          
          
          <?php

              $query = "SELECT * FROM posts WHERE username!='admin' ORDER BY date DESC LIMIT 0,12";

              $results = mysqli_query($con, $query);

              while($row = mysqli_fetch_array($results)){
                  echo "
                  <div class='row row1'>
                  <div class='col-md-12'>
                  <div class='post-preview post-body'>
                  <img src=".$row["image"]." class='postImage'>
                  <a href='post.php?id=".$row["id"]. "'>
                  <h2 class='post-title'>"
                  .$row["title"] ."
                  </h2>
                  <h3 class='post-subtitle'>"
                  .$row["subtitle"] ."
                  </h3>
                </a>
                <p class='post-meta'>Posted by
                    <a href='users.php?uname=".$row["username"]."'>".$row["username"]."</a>
                    ".$row["date"]."</p>
                    </div>
                    <hr>
                    </div>
                      </div>
                    ";
              }
              if(mysqli_fetch_array($results) <=0){
                echo "<p>No More Posts Found</p>";
              }

          ?>
        
        </div>
  <?php
    require_once("./includes/footer.php");
?>