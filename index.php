<?php 
session_start();
if (isset($_SESSION['dashbord'])){
 header("Location:dashbord.php");
}
if (isset($_SESSION['Homepage'])){
  header("Location:HomePage.php");
}
$PageTilte="Log in";
include "init.php";
// include "dashbord.php";
include "function.php";
include "connect.php";
include $tpl ."header.php";
// include "includs/lang/english.php" // later
// check if user coming from http post request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username=$_POST['username'];
      $password=$_POST['password'];
      $hasherPass= sha1($password);
   
      // Check if admin exists in database
      $stmt= $con->prepare("select UserID,Email,Password from myshop.users where Email = ? and Password =? and GroupID	= 1 limit 1");
      $stmt ->execute(array($username,$hasherPass));
      $result = $stmt ->fetch();
      $count=$stmt->rowCount();
      // Check if User exists in database
      $stmt2= $con->prepare("select UserID,Email,Password from myshop.users where Email = ? and Password =? and GroupID	= 0 limit 1");
      $stmt2 ->execute(array($username,$hasherPass));
      $result2 = $stmt2 ->fetch();
      $count2=$stmt2->rowCount();
    //   if count is greater 0 means the database contains this user
      if ($count > 0){
        $_SESSION['dashbord'] = $username; //register Session name
        $_SESSION['UserId'] = $result['UserID'];
        header("Location:dashbord.php");
        exit();
      }
      elseif ($count2 > 0){
        $_SESSION['Homepage'] = $username; //register Session name
        $_SESSION['UserId'] = $result2['UserID'];
        header("Location:HomePage.php");
        exit();
      }
      else{
        echo "<script>     
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'The username or password is incorrect',

            })
        </script>";
      }
    }
    
 ?>
  <!-- Start Login page -->
  <div class="page-login ">
        <div class="content">
            <div class="formbx">
                <h2>Welcom back</h2>
                <p class="c-8">Welcom back! Pleas enter your details</p>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="inputbx form-outline ">
                        <span class="form-label">Username</span>
                        <input type="text" name="username" placeholder="Enter your usernane"  class="form-control ">
                        <a href="#"><i class="fa fa-user "></i></a>
                    </div>
                    <div class="inputbx ">
                        <span>Password</span>
                        <input type="password" name="password" placeholder="Enter your password" id="password" class="pass form-control">
                        <i class="fa-solid fa-key"></i>
                        <i onclick="visibili()" class="fa-regular fa-eye hide" id="hide"></i>
                    </div>
                    <div class="remember ">
                        <label for="remember"><input type="checkbox" class="form-check-inpu" id="remember"> Remember me</label>
                        <a href="restPassword.php">Forgot password</a>
                    </div>
                    <div class="inputbx">
                        <input type="submit" value="Login" name="submit" class="btn btn-primary">
                    </div>
                </form>
                <div class="or">or</div>
                <div class="log-with">
                    <a href="#" class="face"><i class="fa-brands fa-facebook-f fa-lg"></i></i></a>
                    <a href="#" class="twi"><i class="fa-brands fa-twitter fa-lg"></i></a>
                    <a href="#" class="goo"><i class="fa-brands fa-google-plus-g fa-lg"></i></a>
                </div>
                <div class="reg">
                   <?php echo "<p>Don't have an account? <a href='signup.php'>Sign up here</a></p>"; ?>
                </div>
            </div>
        </div>
        <div class="img">
            <img src="layout/imges/pexels-bogdan-glisik-1661471.png" alt="">
        </div>
    </div>
    <!-- End login page -->


<?php include $tpl . "footer.php"; ?>
