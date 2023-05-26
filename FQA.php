<?php 
session_start();
if (isset($_SESSION['Homepage'])){
 
}
else {
    header('location:index.php');
}
include "init.php";
include "connect.php";
// include $tpl ."header.php";
            $sql ="select * from myshop.maincategort  ";
            $stmt=$con->prepare($sql);
            $stmt->execute();
            $result=$stmt ->fetchAll();    

            
            // User information
            $UserID=$_SESSION['UserId'];
            $sql2 = "SELECT * FROM myshop.users where UserId = ? limit 1";
            $stmt2 = $con -> prepare($sql2);
            $stmt2 -> execute([$UserID]);
            $result2 = $stmt2 -> fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=\, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="layout/css/bootstrap.min.css">
  <link rel="stylesheet" href="layout/css/FrameWork.css">
  <link rel="stylesheet" href="layout/css/all.min.css" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
  href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Cairo:wght@300;400;700&family=Epilogue:wght@400;600;700&family=Merienda+One&family=Montserrat:wght@300;700&family=Nunito:wght@300;400;600&family=Poppins:wght@500;600&family=Raleway:wght@400;500;600&family=Roboto:wght@100;300;400;500;700&family=Space+Mono&display=swap"
    rel="stylesheet">
    <!-- Hambargers css -->
    <link rel="stylesheet" href="layout/css/Hambargers.css">
    <link rel="stylesheet" href="layout/css/hamburgers/hamburgers.css">
    <link rel="stylesheet" href="layout/css/style.css">



</head>

<body>
  <div class="navbar">
    <div class="container">
      <a class="logo" href="HomePage.php">LOGO</a>

      <div class="search">
        <span class="i-ser"><i class="fa fa-search" aria-hidden="true"></i></span>
        <input id="search" type="search" class="form-control" placeholder="Search any thing">
        <span onclick="clear_fild()" class="i-remo" id="search"><i class="fa-solid fa-xmark"></i></span>
      </div>

      <ul class="icons">
        <li><a href="" class="favourites"><i class="fa-regular fa-heart"></i></a></li>
        <li><a href="#" class="user" id="accountSettings" onclick="shoowDropDown()"><i class="fa-regular fa-user"></i></a></li>
        
          <ul class="dropdown">
            <li class="userInfo">
              <img src="layout/imges/user/avatar.png" alt="">
              <span><?php echo $result2['Fullname'] ;?></span>
            </li>
            <li><a href=""><i class="fa-solid fa-user-pen"></i>Edit Profile</a></li>

            <li><a href="Logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
          </ul>
        
        <li><a href="" class="cart"><i class="fa-solid fa-cart-shopping"></i></a></li>
      </ul>
    </div>
  </div>

  <!-- Start mega menu -->
  <div class="mega-menu">
    <div class="overlay"></div>
    <div class="container">
      <div class="hamburger hamburger--collapse " id="hamburger">
        <div class="hamburger-box">
          <div class="hamburger-inner"></div>
        </div>
      </div>
      <div class="memu"></div>
      <ul class="menu-main">
        <div class="mobile-menu-head">
          <div class="go-back"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
          <div class="currnet-menu-title">Shop</div>
          <div class="close-menu">&times;</div>
        </div>
            <?php foreach ($result as $MainCategory) { ?>
              <li class='has-children'><a><?php echo $MainCategory['NameMainCat'] ?></a>
                <i class='fa fa-angle-down'></i>
                  <div class='sub-menu' id='sub-menu'>
                          <ul>
                            <?php
                                        $sql2 ="select * from myshop.category where parentID=:MainCategoryID";
                                        $stmt2=$con->prepare($sql2);
                                        $stmt2->bindParam(":MainCategoryID",$MainCategory['MainCatID']);
                                        $stmt2->execute();
                                        $result2=$stmt2 ->fetchAll();    
                            ?>
                            <?php   foreach ($result2 as $Category) {?>
                                <li><a href='ProductPage.php?Category=<?=$Category['CategoryID']?>'><?php echo $Category['CategoryName'] ?></a>
                                    <ul>
                                      <?php
                                        $sql3 ="select * from myshop.subcategory where parentID=:CategoryID";
                                        $stmt3=$con->prepare($sql3);
                                        $stmt3->bindParam(":CategoryID",$Category['CategoryID']);
                                        $stmt3->execute();
                                        $result3=$stmt3 ->fetchAll();    
                                      ?>
                                      <?php foreach ($result3 as $SubCategory) { ?>
                                        <li><a href='ProductPage.php?SubCategory=<?=$SubCategory['SubCateID']?>'><?php echo $SubCategory['SubCatName'] ?></a>
                                      <?php }?>
                                    </ul>
                                </li>
                            <?php }?>
                              
                          </ul>
                  </div>
              </li>  
            <?php } ?>
      </ul>
    </div>
  </div>
  </div>

      <div class="site-content">
        <div class="FQA">
            <div class="container">
                <div class="FQA-head">
                    <h1>Frequently Asked Questions</h1>
                    <p>This Agreement was last modified on 18th february 2016</p>
                </div>
                <div class="FQA-content">
                    <div class="content-head">
                        <h5>Shipping Information</h5>
                    </div>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="content">
                                    <h3>What Shipping Methods Are Available?</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sapien lorem, consectetur et turpis id, blandit
                                    interdum metus. Morbi sed ligula id elit mollis efficitur ut nec ligula. Proin erat magna, pellentesque at elementum at,
                                    eleifend a tortor.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="content">
                                    <h3>How Long Will it Take To Get My Package?</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sapien lorem, consectetur et turpis id, blandit
                                    interdum metus. Morbi sed ligula id elit mollis efficitur ut nec ligula. Proin erat magna, pellentesque at elementum at,
                                    eleifend a tortor.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="content">
                                    <h3>How Do I Track My Order?</h3>
                                    <p>Integer ex turpis, venenatis vitae nibh vel, vestibulum maximus quam. Ut pretium orci ac vestibulum porttitor. Fusce
                                    tempus diam quis justo porttitor gravida.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="content">
                                    <h3>Do I Need A Account To Place Order?</h3>
                                    <p>Integer ex turpis, venenatis vitae nibh vel, vestibulum maximus quam. Ut pretium orci ac vestibulum porttitor. Fusce
                                    tempus diam quis justo porttitor gravida.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="secound-FQA">
            <div class="container">
                <div class="FQA-head">
                    <h1>FAQ Second Version</h1>
                </div>
                <div class="FQA-content">
                    <div class="row">
                        <div class="col  col-lg-12">
                            <ul class="arrow">
                                <li>
                                    <input type="checkbox" checked>
                                    <i></i>
                                    <h2>What Shipping Methods Are Available?</h2>
                                    <p>Vestibulum velit nibh, egestas vel faucibus vitae, feugiat sollicitudin urna. Praesent iaculis id ipsum sit
                                        amet
                                        pretium. Aliquam tristique sapien nec enim euismod, scelerisque facilisis arcu consectetur.</p>
                                </li>
                                <li>
                                    <input type="checkbox" checked>
                                    <i></i>
                                    <h2>How Long Will it Take To Get My Package?</h2>
                                    <p>Vestibulum velit nibh, egestas vel faucibus vitae, feugiat sollicitudin urna. Praesent iaculis id ipsum sit
                                        amet
                                        pretium. Aliquam tristique sapien nec enim euismod, scelerisque facilisis arcu consectetur.</p>
                                </li>
                                <li>
                                    <input type="checkbox" checked>
                                    <i></i>
                                    <h2>How Do I Track My Order?</h2>
                                    <p>Vestibulum velit nibh, egestas vel faucibus vitae, feugiat sollicitudin urna. Praesent iaculis id ipsum sit
                                        amet
                                        pretium. Aliquam tristique sapien nec enim euismod, scelerisque facilisis arcu consectetur.</p>
                                </li>
                                <li>
                                    <input type="checkbox" checked>
                                    <i></i>
                                    <h2>How Do I Place an Order?</h2>
                                    <p>Vestibulum velit nibh, egestas vel faucibus vitae, feugiat sollicitudin urna. Praesent iaculis id ipsum sit
                                        amet
                                        pretium. Aliquam tristique sapien nec enim euismod, scelerisque facilisis arcu consectetur.</p>
                                </li>
                            <li>
                                <input type="checkbox" checked>
                                <i></i>
                                <h2>How Should I to Contact if I Have Any Queries?</h2>
                                <p>Vestibulum velit nibh, egestas vel faucibus vitae, feugiat sollicitudin urna. Praesent iaculis id ipsum sit
                                    amet
                                    pretium. Aliquam tristique sapien nec enim euismod, scelerisque facilisis arcu consectetur.</p>
                            </li>
                            <li>
                                <input type="checkbox" checked>
                                <i></i>
                                <h2>Do I Need an Account to Place an Order?</h2>
                                <p>Vestibulum velit nibh, egestas vel faucibus vitae, feugiat sollicitudin urna. Praesent iaculis id ipsum sit
                                    amet
                                    pretium. Aliquam tristique sapien nec enim euismod, scelerisque facilisis arcu consectetur.</p>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div></div>
        <div class="site-footer">
            <div class="footer-newslettet">
                <div class="container">
                    <div class="row">

                        <div class="col col-lg-12">
                            <div class="context">
                                <h3>Sign Up For Newsletters</h3>
                                <p>Get E-mail updates about our latest shop and<span> special offers</span>.</p>
                            </div>
                            <form action="" class="email">

                                <input type="email" name="" id="" placeholder="Your Email Address">
                                <button>Sign Up</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="footer-body">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-5 col-md-4 col-sm-12">
                            <div class="logo">
                                LOGO
                            </div>
                            <div class="call">
                                <i class="fa-solid fa-headset"></i>
                                <div class="call-about">
                                    <span>Got Questions ? Call us 24/7!</span>
                                    <p>0781211215,0781211215</p>
                                </div>
                            </div>
                            <div class="Address">
                                <p>Contact Info</p>
                                <span>Jordan,Amman,Marka</span>
                                <div class="social">
                                    <ul>
                                        <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
                                        <li><a href="#"><i class="fa-regular fa-envelope"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class=" col col-lg-2 col-md-3 col-sm-12 ">
                            <h4>Find It Fast</h4>
                            <ul>
                                <li><a href="#">Smart Phone</a></li>
                                <li><a href="#">Smart Phone</a></li>
                                <li><a href="#">Smart Phone</a></li>
                                <li><a href="#">Smart Phone</a></li>
                                <li><a href="#">Smart Phone</a></li>
                                <li><a href="#">Smart Phone</a></li>
                                <li><a href="#">Smart Phone</a></li>
                                <li><a href="#">Smart Phone</a></li>
                            </ul>
                        </div>
                        <div class="col col-lg-2 col-md-2 col-sm-12">
                            <h4>&nbsp;</h4>
                            <ul>
                                <li><a href="About.php">About</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                        <div class="col col-lg-2 col-md-3 col-sm-12">
                            <h4>Customer Care</h4>
                            <ul>
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">FAQs</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="copyright-bar">
                <div class="container">
                    <div class="row">
                        <div class=" col col-lg-12">
                            <p>© <span>Dr.Phone </span>- All Rights Reserved</p>
                            <img src="/admin/layout/imges/HomePage/patment-icon1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <script src="layout/js/backend.js"></script>



</body>

</html>
<?php include $tpl . "footer.php"; ?>