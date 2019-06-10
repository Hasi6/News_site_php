<?php
    require_once("./includes/header.php");
?>
<!-- Page Header -->
<header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Clean Blog</h1>
            <span class="subheading">A Blog Theme by Start Bootstrap</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="mainContainer">
    
          
          <?php
              require_once("./database/config.php");
          ?>
          <?php

              $query = "SELECT * FROM posts ORDER BY date DESC";

              $results = mysqli_query($con, $query);

              while($row = mysqli_fetch_array($results)){
                  echo "
                  <div class='row'>
                  <div class='col-md-12'>
                  <div class='post-preview'>
                  <img src=".$row["image"]." class='image' style='width: 400px;height: 300px'>
                  <a href='post.php?id=".$row["id"]. "'>
                  <h2 class='post-title'>"
                  .$row["title"] ."
                  </h2>
                  <h3 class='post-subtitle'>"
                  .$row["subtitle"] ."
                  </h3>
                </a>
                <p class='post-meta'>Posted by
                    <a href='#'>".$row["username"]."</a>
                    ".$row["date"]."</p>
                    </div>
                    <hr>
                    </div>
                      </div>
                    ";
              }

          ?>
        
        </div>
  <?php
    require_once("./includes/footer.php");
?>