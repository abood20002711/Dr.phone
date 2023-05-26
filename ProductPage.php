<?php 
session_start();
if (isset($_SESSION['Homepage'])){
 
}
else {
    header('location:index.php');
}
include "init.php";
include "connect.php";
include $tpl ."header.php";
            $sql ="select * from myshop.maincategort  ";
            $stmt=$con->prepare($sql);
            $stmt->execute();
            $result=$stmt ->fetchAll();    
            
            // 
            if (isset($_GET['SubCategory'])  ){
                $SubCatID=$_GET['SubCategory'];
                $sql2 = "select * from myshop.items where sCategory = ?";
                $ItemByCat= $con->prepare($sql2);
                $ItemByCat->execute([$SubCatID]);
                $result12=$ItemByCat ->fetchAll();
                
                $sql3 = "select * from myshop.subcategory where SubCateID = ? ";
                $TitleCat= $con->prepare($sql3);
                $TitleCat->execute([$SubCatID]);     
                $result13=$TitleCat ->fetch(); 
                
           }
            // $Catg = GetCatName($CatgName);

           // Add Item to Wishlist 
           if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_GET['AddToWishList'])){
              $WishID=$_GET['AddToWishList'];
              $UserID = $_SESSION['UserId'];
              $ItemName = $_POST['ItemName'];
              $Price = $_POST['Price'] ;
              $image = $_POST['image'];

              $stmt3 = $con->prepare("insert into myshop.wishlist(UserID,ItemID,itemname,price,img) VALUES (:UserID,:ItemID,:ItemName,:Price,:img)");
              $stmt3->bindParam(":UserID", $UserID);
              $stmt3->bindParam(":ItemID", $WishID);
              $stmt3->bindParam(":ItemName", $ItemName);
              $stmt3->bindParam(":Price", $Price);
              $stmt3->bindParam(":img", $image);
              $stmt3->execute();

              echo "<script>
          Swal.fire(
          'Good job!',
          'The Itame is Added To Your Wishlist',
          'success'
                      )
      </script>";
            }
          }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=\, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="layout/css/bootstrap.min.css">
  <link rel="stylesheet" href="layout/css/style.css">
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
        <li><a class="loginbtn ">Log in</a></li>
        <li><a href="" class="favourites"><i class="fa-regular fa-heart"></i></a></li>
        <li><a href="#" class="user" id="accountSettings" onclick="shoowDropDown()"><i class="fa-regular fa-user"></i></a></li>
        
          <ul class="dropdown">
            <li><a href=""><i class="fa-solid fa-user-pen"></i>Edit Profile</a></li>
            <li><a href=""><i class="fa-solid fa-gear"></i>Settings</a></li>
            <li><a href=""><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
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
                                <li><a href='#'><?php echo $Category['CategoryName'] ?></a>
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

  <div class="bodys">
    <div class="catg-Mobile">
      <div class="container">
        <div class="head-catg">
          <h3 class="catge-name"><?php 
            echo $result13['SubCatName'];
          ?> </h3>
        </div>
        <div class="body-catg">
          <div class="row">
                   <?php foreach($result12 as $item) {?>  
                    <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card" >
                        <div class="media">
                            <a class="card-img-top" href="ProductView.php?id=<?php echo  $item['ID']; ?>">
                                <img src="layout/imges/proudact/<?php echo $item['image'];?>"  class="img-fluid" width="60" height="60">
                            </a>
                            <a href="#?AddToWishList=<?php echo $item['ID']?>" onclick="submitForm()" class="fav"><i class="fa-regular fa-heart"></i></a>
                            </div>
                            <div class="card-body">
                            <div class="prodict-title">
                                <h4><?php echo  $item['ItemName']; ?></h4>
                                <span><?php echo  $item['Price']; ?></span>
                            </div>
                            <div class="rate">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-stroke"></i>
                            </div>

                              <a href="ProductView.php?id=<?php echo $item['ID']; ?>" class="add-to-cart">Add to Cart</a>
                            </div>
                    </div>
                    </div>
                    <form  method="POST" id="addtowish">
                        <input type="hidden" name="ItemName" value="<?php echo $item['ItemName']; ?>">
                      <input type="hidden" name="Price" value="<?php echo $item['Price']; ?>">
                      <input type="hidden" name="image" value="<?php echo $item['image']; ?>">
                    </form>     
                    <?php }?>            
          </div>
        </div>
      </div>
    </div>

   
                            <div class="tec-prands">
                              <div class="container">
                                <div class="row">
                                  <div class="col col-lg-2"><img src="layout/imges/HomePage/dell.svg" alt=""></div>
                                  <div class="col col-lg-2"><img src="layout/imges/HomePage/acer.svg" alt=""></div>
                                  <div class="col col-lg-2"><img src="layout/imges/HomePage/assus.svg" alt=""></div>
                                  <div class="col col-lg-2"><img src="layout/imges/HomePage/panasonic.svg" alt=""></div>
                                  <div class="col col-lg-2"><img src="layout/imges/HomePage/nokia.svg" alt=""></div>
                                  <div class="col col-lg-2"><img src="layout/imges/HomePage/vaio.svg" alt=""></div>
                                </div>
                              </div>
                            </div>
                            <div class="site-footer">
                              <div class="footer-newslettet">
                                <div class="container">
                              <div class="row">
                                
                                <div class="col col-lg-12">
                                    <div class="context">
                                      <h3>Sign Up For Newsletters</h3>
                                      <p>Get E-mail updates about our latest shop and<span>   special offers</span>.</p>
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
                                          <?php foreach ($result as $MainCategory) { ?>
                                            <li ><a href="#"><?php echo $MainCategory['NameMainCat'] ?></a> </li>
                                          <?php }?>
                            
                                      </ul>
                                    </div>
                                    <div class="col col-lg-2 col-md-2 col-sm-12">
                                      <h4>&nbsp;</h4>
                                      <ul>
                                        <li><a href="#">About</a></li>
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
                                                                      <img src="layout/imges/HomePage/patment-icon1.png" alt="">
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                              </div>
                            </div>
  </div>
  </div>

  <script src="layout/js/backend.js"></script>
  <script>
    function submitForm() {
    // Get the form element
    var form = document.getElementById("addtowish");
    
    // Submit the form
    form.submit();
  }
  </script>                                         


</body>

</html>
<?php include $tpl . "footer.php"; ?>