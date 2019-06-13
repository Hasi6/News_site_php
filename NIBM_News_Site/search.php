<?php
    require_once("./includes/header.php");
    require_once("./database/config.php");
?>
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/about-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>About Me</h1>
            <span class="subheading">This is what I do.</span>
          </div>
        </div>
      </div>
    </div>
  </header>


  <?php
  
    if(!isset($_POST["searchBtn"])){
        echo "<script>window.open('index.php', '_self')</script>";
    }

    $keyWord = $_POST["keyword"];

    $query = "SELECT * FROM posts WHERE (username LIKE '%$keyWord%' OR title LIKE '%$keyWord%' OR subtitle LIKE '%$keyWord%' OR body LIKE '%$keyWord%' OR image LIKE '%$keyWord%' OR date LIKE '%$keyWord%') AND username != 'admin'";
    $results = mysqli_query($con, $query);

    if(mysqli_num_rows($results) <= 0){
        echo "No Posts To Show";
        require_once("./includes/footer.php");
        exit();
    }

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


  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

      </div>
    </div>
  </div>

  <hr>
<?php
    require_once("./includes/footer.php");
?>