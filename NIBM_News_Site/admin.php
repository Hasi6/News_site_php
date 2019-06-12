<?php
    require_once("./includes/header.php");
    require_once("./database/config.php");
    
    if(!isset($_SESSION["uname"])){
      echo "<script>window.open('adminLog.php', '_self')</script>";
  }

    if(isset($_SESSION["uname"])){
        $_SESSION["uname"];
        $_SESSION["uemail"];
    }

    $Aname = $_SESSION["uname"];
    $query = "SELECT * FROM users WHERE username='$Aname'";

    $results = mysqli_query($con, $query);


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
                if($_SESSION["uname"] == $uname ){
                    echo "<a class='btn btn-info mt-4' id='edit' href='editUser.php?uname=".$uname."'>Edit Details</a>";
                }
            ?>

          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Posts</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">All Users</a>
  </li>
  
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <?php
          
          $query = "SELECT * FROM posts ORDER BY date DESC";

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
                  echo "<a class='btn btn-warning btn-block' href=editPost.php?id=".$row["id"].">Edit Post</a>
                  <a class='btn btn-danger btn-block' href=deletePost.php?id=".$row["id"].">Delete Post</a>
                  <hr>
                  </div>
                    </div>
                    </div>
                  ";
                
          }
          if(mysqli_fetch_array($results) <=0){
            echo "<p>No More Posts Found</p>";
          }

      ?>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <?php
          
          $query = "SELECT * FROM users ORDER BY userId DESC";

          $results = mysqli_query($con, $query);
          $row = mysqli_fetch_array($results);
          while($row = mysqli_fetch_array($results)){
              echo "
              <div class='row row1'>
              <div class='col-md-12'>
              <div class='post-preview post-body'>
              <img src=".$row["image"]." class='image' style='width: 400px;height: 300px'>
              <a href='post.php?id=".$row["userId"]. "'>
              <h2 class='post-title'>"
              .$row["username"] ."
              </h2>
              <h3 class='post-subtitle'>"
              .$row["email"] ."
              </h3>
            </a>
            <p class='post-meta'>Posted by
                <a href='users.php?uname=".$row["username"]."'>".$row["username"]."</a></p>
                ";
                  echo "<a class='btn btn-danger btn-block' href=deleteUser.php?id=".$row["userId"].">Delete User</a>
                  <hr>
                  </div>
                    </div>
                    </div>
                  ";
                
          }
          if(mysqli_fetch_array($results) <=0){
            echo "<p>No More Posts Found</p>";
          }

      ?>
  </div>
</div>
  

  

  <hr>
<?php
    require_once("./includes/footer.php");
?>

<script>
    const edit = document.getElementById("edit");

    edit.addEventListener('click', ()=>{
        
    });
</script>