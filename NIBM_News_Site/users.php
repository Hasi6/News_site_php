<?php
    require_once("./includes/header.php");
    require_once("./database/config.php");
    
    if(isset($_SESSION["uname"])){
        $_SESSION["uname"];
        $_SESSION["uemail"];
    }

    if(!isset($_GET["uname"])){
      header("Location:pageNotFound.php");
        exit();
    }
    $uname = $_GET["uname"];
    $query = "SELECT * FROM users WHERE username='$uname'";

    $results = mysqli_query($con, $query);

    if(mysqli_num_rows($results) <=0){
        header("Location:pageNotFound.php");
    }

    $row = mysqli_fetch_array($results);

    $uname = $row["username"];
    $image = $row["image"];
    $email = $row["email"];

    


?>
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('<?php echo $image ?>')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1><?php echo $uname ?></h1>
            <span class="subheading"><?php echo $email ?></span>

            <?php
                if($_SESSION["uname"] === $uname ){
                    echo "<button class='btn btn-info mt-4' id='edit'>Edit Details</button>";
                }
            ?>

          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <?php

              $query = "SELECT * FROM posts WHERE username='$uname' ORDER BY date DESC";

              $results = mysqli_query($con, $query);
              $row = mysqli_fetch_array($results);
              while($row = mysqli_fetch_array($results)){
                  echo "
                  <div class='row row1'>
                  <div class='col-md-12'>
                  <div class='post-preview post-body'>
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
                    <a href='users.php?uname=".$row["username"]."'>".$row["username"]."</a>
                    ".$row["date"]."</p>
                    ";
                    if($row["username"] == $_SESSION["uname"]){
                      echo "<a class='btn btn-danger btn-block' href=deletePost.php?id=".$row["id"].">Delete Post</a>
                      <hr>
                      </div>
                        </div>
                        </div>
                      ";
                    }
                    
              }
              if(mysqli_fetch_array($results) <=0){
                echo "<p>No More Posts Found</p>";
              }

          ?>

  

  <hr>
<?php
    require_once("./includes/footer.php");
?>

<script>
    const edit = document.getElementById("edit");

    edit.addEventListener('click', ()=>{
        
    });
</script>