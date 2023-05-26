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


if (isset($_GET['id'])  ){
    $itemID=$_GET['id'];
    $sql2 = "select * from myshop.items where ID = ? ";
    $ItemByCat= $con->prepare($sql2);
    $ItemByCat->execute([$itemID]);
    $items=$ItemByCat ->fetchAll(); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['AddToCart'])){
    $UserID=$_SESSION['UserId'];
    $Quantity=$_POST['Quantity'];
    $Item_ID=$_POST['Item_ID'];
    $ItemName=$_POST['ItemName'];
    $Price=$_POST['Price'] * $_POST['Quantity'];
    $image=$_POST['image'];

    $stmt2 = $con->prepare("insert into myshop.cart(UserID,ItemID,ItemName,Price,Quantity,img) VALUES (:UserID,:ItemID,:ItemName,:Price,:Quantity,:img)");
    $stmt2 ->bindParam(":UserID",$UserID);
    $stmt2 ->bindParam(":ItemID",$Item_ID);
    $stmt2 ->bindParam(":ItemName",$ItemName);
    $stmt2 ->bindParam(":Price",$Price);
    $stmt2 ->bindParam(":Quantity",$Quantity);
    $stmt2 ->bindParam(":img",$image);
    $stmt2 -> execute();

    echo "<script>
        Swal.fire(
        'Good job!',
        'The Itame is Added To Your Cart',
        'success'
                    )
    </script>";
}
    
    elseif(isset($_POST['AddToWishlist'])){
      
            $UserID = $_SESSION['UserId'];
            $Item_ID = $_POST['Item_ID'];
            $ItemName = $_POST['ItemName'];
            $Price = $_POST['Price'] ;
            $image = $_POST['image'];

            $stmt3 = $con->prepare("insert into myshop.wishlist(UserID,ItemID,itemname,price,img) VALUES (:UserID,:ItemID,:ItemName,:Price,:img)");
            $stmt3->bindParam(":UserID", $UserID);
            $stmt3->bindParam(":ItemID", $Item_ID);
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

<!-- Font Jost - 400 -->
<!DOCTYPE html>
<html lang="en">
<? echo $_GET['wishId'] ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/admin/layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="layout/css/style.css">
    <link rel="stylesheet" href="/admin/layout/css/FrameWork.css">
    <link rel="stylesheet" href="/admin/layout/css/all.min.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Cairo:wght@300;400;700&family=Epilogue:wght@400;600;700&family=Merienda+One&family=Montserrat:wght@300;700&family=Nunito:wght@300;400;600&family=Poppins:wght@500;600&family=Raleway:wght@400;500;600&family=Roboto:wght@100;300;400;500;700&family=Space+Mono&display=swap"
        rel="stylesheet">
    <!-- Hambargers css -->
    <link rel="stylesheet" href="/admin/layout/css/Hambargers.css">
    <link rel="stylesheet" href="/admin/layout/css/hamburgers/hamburgers.css">



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
        <div class="proudact-view">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <?php foreach($items as $item) {
                            ?>
                        <div class="col-lg-6 image">
                            <img class="img-fluid" src="layout/imges/proudact/<?php echo $item['image'] ?>" alt="noy found">
                            </div>
                            <div class="col-lg-6 context">

                                <div class="row">
                                    <div class="col-lg-12 colinfo">
                                        <h2><?php echo $item['ItemName'] ; ?></h2>
                                    <div class="rate">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                        <span>( 55 sale )</span>
                                    </div>
                                    <span class="price">USD <?php echo $item['Price']?></span>
                                    
                                </div>
                                <div class="col-lg-12 colinfo">
                                    <p class="description"><?php echo $item['Description']?></p>
                                </div>
                                <div class="col-lg-12 colinfo">
                                    <form action="ProductView.php?id=<?php echo $item['ID']?>" method="POST" name="add">
                                        <!-- <label for="">QTY: </label> -->
                                        <input  type="number" id="tentacles" name="Quantity" value="1" min="1" max="10" required>
                                        <input type="hidden" name="Item_ID" value="<?php echo $item['ID']?>"/>
                                        <input type="hidden" name="ItemName" value="<?php echo $item['ItemName']?>"/>
                                        <input type="hidden" name="Price" value="<?php echo $item['Price']?>"/>
                                        <input type="hidden" name="image" value="<?php echo $item['image']?>"/>
                                        <button type="submit" class="AddCart" name="AddToCart">Add to Cart</button>
                                        <br>
                                    </form>
                                    <form action="ProductView.php?id=<?php echo $item['ID'] ?>" method="POST" name="wish">
                                        <input type="hidden" name="Item_ID" value="<?php echo $item['ID'] ?>" />
                                        <input type="hidden" name="ItemName" value="<?php echo $item['ItemName'] ?>" />
                                        <input type="hidden" name="Price" value="<?php echo $item['Price'] ?>" />
                                        <input type="hidden" name="image" value="<?php echo $item['image'] ?>" />
                                        <button    type="submit" name="AddToWishlist" class="AddWish"><i class="fa-regular fa-heart"></i> </button>                                        
                                        </form>
                                        </div>
                                        <div class="col-lg-12 colinfo footer">
                                    <?php   
                                            $CatID=$item['Category'];
                                            $sql3 = "select * from myshop.Category where CategoryID = ?";
                                            $ItemByCat= $con->prepare($sql3);
                                            $ItemByCat->execute([$CatID]);
                                            $result12=$ItemByCat ->fetch();                                        
                                            // SubCategory
                                            $SunCatID=$item['sCategory'];
                                            $sql4 = "select * from myshop.subcategory where SubCateID = ?";
                                            $ItemBySubCat= $con->prepare($sql4);
                                            $ItemBySubCat->execute([$SunCatID]);
                                            $result13=$ItemBySubCat ->fetch(); 
                                        echo "<p>Category : <span> ".$result12['CategoryName']." </span></p>";
                                       echo  "<p>Sub Category : <span>".$result13['SubCatName']."</span></p>";
                                    ?>
 
                                    <div class="share">
                                        <p>Share This Product</p>
                                        <ul>
                                            <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-tiktok"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                </div>
                            </div>
                            
                            
                     



                        </div>
                        <?php }?>
                    </div>
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
                            <img src="/admin/layout/imges/HomePage/patment-icon1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="/admin/layout/js/backend.js"></script>


</body>

</html>


<?php include $tpl . "footer.php"; ?>