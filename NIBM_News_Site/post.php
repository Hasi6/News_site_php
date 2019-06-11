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
              <!-- check username and display edit button -->
              <?php
                if(isset($_SESSION["uname"])){
                  if( $_SESSION["uname"]== $details['username']){
                  echo "<button class='btn btn-info mt-4' id='edit'>Edit Post</button>";
                }
              }
              ?>
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
  <!-- comment Section -->
  <div class="container">
    <form action="#" method="POST">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
        <div class="form-group floating-label-form-group controls">
              <textarea rows="5" class="form-control" name="comment" placeholder="Add Comment.." id="message" required data-validation-required-message="Please enter a message."></textarea>
              <p class="help-block text-danger"></p>
            </div>
        </div>
        
      </div>
      <div class="form-group mt-4">
           <button class="btn btn-primary m-6" name="postComment" id="sendMessageButton">Post</button>
      </div>
      </form>
    </div>
  <hr>

  <!-- display comment -->
  <div class="container">
  <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <?php
            $postId = $details["id"];
            $query1 = "SELECT * FROM comments WHERE postId='$postId' ORDER BY date DESC";
            $results1 = mysqli_query($con, $query1);
            
            $row12 = mysqli_fetch_array($results1);
            if($row12 < 0){
              echo "No Comments Found";
            }
            else{
            $userFrom = $row12["userFrom"];
            $queryGetProPic = "SELECT * FROM users WHERE username='$userFrom'";
            $resultsGetProPic = mysqli_query($con, $queryGetProPic);

            $rowGetProPic = mysqli_fetch_array($resultsGetProPic);

            $username = $_SESSION["uname"];

            while($row1 = mysqli_fetch_array($results1)){
              echo "<img src="."".$rowGetProPic["image"]." style='width:75px;border-radius:50%'> <a href=''>".$row1["userFrom"]."</a>";
              echo "<p>".$row1["body"]."</p>";
              echo "<p>".$row1["date"]."</p>";
              if(($username == $row1["userFrom"])){
                echo "<button class='btn btn-danger' name='delete'>Delete Comment</button> <hr>";
              }
            }
            echo "No More Comments";
            } 
          ?>
        </div>
  </div>
  </div>

  <!-- add comments to database -->
  <?php
if(!isset($_SESSION["uname"])){
    header("Location:post.php");
}

if(!isset($_GET["id"])){
    header("Location:post.php");
}
$id = $_GET["id"];
    if(isset($_POST["postComment"])){
        $comment = $_POST["comment"];
        $userFrom = $_SESSION["uname"];

        $query = "INSERT INTO comments (body, userFrom, postId) VALUES('$comment', '$userFrom', '$id')";

        $results = mysqli_query($con, $query);

            // header("Location:post.php?id=".$id."");
    }

?>
<?php
    require_once("./includes/footer.php");
?>