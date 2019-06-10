<?php
    require_once("./includes/header.php");
    require_once("./database/config.php");
    
    if(isset($_SESSION["uname"])){
        $_SESSION["uname"];
        $_SESSION["uemail"];
    }

    if(!isset($_GET["uname"])){
        echo "No Users Found";
        exit();
    }
    $uname = $_GET["uname"];
    $query = "SELECT * FROM users WHERE username='$uname'";

    $results = mysqli_query($con, $query);

    if(mysqli_num_rows($results) <=0){
        echo "No Users Found";
        exit();
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

<script>
    const edit = document.getElementById("edit");

    edit.addEventListener('click', ()=>{
        
    });
</script>