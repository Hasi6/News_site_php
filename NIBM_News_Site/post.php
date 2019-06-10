<?php
    require_once("./includes/header.php");
    require_once("./database/config.php");
?>

<?php
  if(!isset($_GET["id"])){
    echo "No Posts Found";
    exit();
  }

  if(isset($_GET["id"])){

  $id =$_GET["id"];
  $query = "SELECT * FROM posts WHERE id=$id";

  $results = mysqli_query($con, $query);

  $row = mysqli_num_rows($results);

  $details = mysqli_fetch_array($results);


  if($row <= 0){
    echo "No Posts Found";
    exit();
  }

}

?>
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('<?php echo $details['image']?>')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1><?php echo $details['title']?></h1>
            <h2 class="subheading"><?php echo $details['subtitle']?></h2>
            <span class="meta">Posted by
              <a href="#"><?php echo $details['username']?></a>
              <?php echo $details['date']?></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
         <?php echo $details['body']?>
        </div>
      </div>
    </div>
  </article>

  <hr>
<?php
    require_once("./includes/footer.php");
?>