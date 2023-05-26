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

// Display the item in Cart
$UserID=$_SESSION['UserId'];
$stmt=$con->prepare("select * from myshop.cart where UserID = ? ");
$stmt ->execute([$UserID]);
$items = $stmt ->fetchAll();
$count = $stmt ->rowCount();
// Totle prices for the Items in the Cart
$stmt2=$con->prepare("select SUM(Price) as totle from myshop.cart where UserID = ? ");
$stmt2 ->execute([$UserID]);
$totle = $stmt2 ->fetch();

// delete Item from the Cart
 if (isset($_GET['CartRowID'])){
        $id=$_GET['CartRowID'];
        $sql2 = "DELETE FROM myshop.cart WHERE ID=?";
        $delete= $con->prepare($sql2);
        $delete->execute([$id]);
        header("Location:Cart.php");
        die();

    }
// send the order details to the database
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($count > 0){
    $CustomerName = $_POST['CustomerName'];
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $Country = $_POST['Country'];
    $State = $_POST['State'];
    $Address = $_POST['Address'];
    $ZipCode = $_POST['Zip'] ;
    $PaymentMethod = "";
    $Paypal = $_POST['Paypal'];
    $Credit = $_POST['Credit'];
    if($Paypal == ""){
        $PaymentMethod = "Credit";
    }
    else {
        $PaymentMethod = "Paypal";
    }
    $order = $con->prepare("insert into myshop.orderdetalis (UserID,NumOfItem,Total,PaymentMethod,CustomerName,Phone,Email,Country,State,Address,ZipCode) VALUES 
    (:UserID,:NumOfItem,:Total,:PaymentMethod,:CustomerName,:Phone,:Email,:Country,:State,:Address,:ZipCode)");
    $order->bindParam(":UserID", $UserID);
    $order->bindParam(":NumOfItem", $count);
    $order->bindParam(":Total", $totle['totle']);
    $order->bindParam(":PaymentMethod", $PaymentMethod);
    $order->bindParam(":CustomerName", $CustomerName);
    $order->bindParam(":Phone", $Phone);
    $order->bindParam(":Email", $Email);
    $order->bindParam(":Country", $Country);
    $order->bindParam(":State", $State);
    $order->bindParam(":Address", $Address);
    $order->bindParam(":ZipCode", $ZipCode);
    $order -> execute();
    // delete All item in Cart 
    $del = $con->prepare("DELETE from myshop.cart where UserID = ?");
    $del->execute([$UserID]);
    // Update item quantity in the database
    echo "<script>
        Swal.fire(
        'Good job!',
        'Order is completed ',
        'success'
                    )
    </script>";
        }
        else{
            echo "<script>     Swal.fire({
            title: 'Error!',
            text: 'There must be items in the cart to complete the order',
            icon: 'error',
            confirmButtonText: 'OK'
        })</script>";
        }
}
?>



<!-- Font Jost - 400 -->
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
        <div class="container">
            <div class="cartShoping">
                <div class="row">
                    <div class="col-lg-5">
                        <h4>Order Summary</h4>
                        <div class="card">
                            <div class="card-body">
                                <div class="row orderSummary">
                                    <?php foreach($items as $item) {?> 
                                    <div class="col-lg-12 itemCol">
                                        <div class="itemInfo">
                                            <img src="layout/imges/proudact/<?php echo $item['img']?>" alt=""
                                                width="50" height="50">
                                            <div class="context">
                                                <h5 class="itemName"><?php echo $item['ItemName']?></h5>
                                                <?php 
                                                    $qury = $con -> prepare("select subcategory.SubCatName from myshop.subcategory where SubCateID = (select items.sCategory from myshop.items where ID = ?)");
                                                    $qury ->execute([$item['ItemID']]);
                                                    $subcat= $qury ->fetch();

                                                ?>
                                                <span class="SubCat"><?php echo $subcat['SubCatName']?></span>
                                            </div>
                                        </div>
                                        <div class="price">
                                            <p class="priceitems"><?php echo $item['Price']?>$</p>
                                            <a href="Cart.php?CartRowID=<?php echo $item['ID']?>"><i class="fa-solid fa-xmark"></i></a>
                                        </div>
                                    </div>
                                    <?php }?>
                                    
                                   
                                    
                                    
                                </div>
                                <div class="row confirmOrder">
                                    <div class="col-lg-12">
                                        <div class="totol">
                                            <span>Totol (USD)</span>
                                            <h6>$<?php print_r ($totle['totle'])?></h6>
                                        </div>
                                        <div class="confirmbtn">
                                            <button class="confirm" type="submit" form="my-form">Confirm Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-12 DeliveryInfo">
                                <h4>Delivery Information</h4>
                                <div class="card">
                                    <div class="card-body">
                                        <form  id="my-form"  onsubmit ="return PaymentMethod()" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                            <div class="row">
                                                <div class="col col-lg-4">
                                                    <label for="">Name</label>
                                                    <input type="text" name="CustomerName" id="" class="form-control" required>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <label for="">Phone</label>
                                                    <input type="tel" pattern="[0-9-()-+ ]*" id="phone" name="Phone"
                                                        class="form-control" required>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <label for="">Email</label>
                                                    <input type="email" name="Email" id="" class="form-control" required>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <label for="">Country</label>
                                                    <select id="country" required name="Country" class="form-control">
                                                    </select>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <label for="">State</label>
                                                    <select name="State" required id="state" class="form-control">
                                                        <option value="-1">Select State</option>
                                                    </select>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <label for="">Zip Code</label>
                                                    <input type="text" name="Zip" id="" class="form-control" required
                                                        placeholder="93944">
                                                </div>
                                                <div class="col col-lg-12">
                                                    <label for="">Address</label>
                                                    <input type="text" name="Address" id="" class="form-control" required>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <!--  Payment Method-->
                            <div class="col-lg-12 Payment">
                                <h4>Payment Method</h4>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        
                                        <div class="card">

                                            <div class="accordion" id="accordionExample">

                                                <div class="card mb-0">
                                                    <div class="card-header p-0" id="headingTwo">
                                                        <h2 class="mb-0">
                                                            <button
                                                                class="btn btn-light btn-block text-left collapsed p-3 rounded-0 border-bottom-custom"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#collapseTwo" aria-expanded="false"
                                                                aria-controls="collapseTwo">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">

                                                                    <span>Paypal</span>
                                                                    <img src="layout/imges/icons/7kQEsHU.png"
                                                                        width="30">


                                                                </div>
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                        data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            
                                                            <input type="text" class="form-control Paypal"
                                                                placeholder="Paypal email" id="Paypal" name="Paypal"  form="my-form">
                                                                
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card mb-0">
                                                    <div class="card-header p-0">
                                                        <h2 class="mb-0">
                                                            <button
                                                                class="btn btn-light btn-block text-left p-3 rounded-0"
                                                                data-toggle="collapse" data-target="#collapseOne"
                                                                aria-expanded="true" aria-controls="collapseOne">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">

                                                                    <span>Credit card</span>
                                                                    <div class="icons">
                                                                        <img src="layout/imges/icons/W1vtnOV.png"
                                                                            width="30">
                                                                        <img src="layout/imges/icons/2ISgYja.png"
                                                                            width="30">
                                                                        <img src="layout/imges/icons/35tC99g.png"
                                                                            width="30">
                                                                        <img src="layout/imges/icons/W1vtnOV.png"
                                                                            width="30">
                                                                    </div>

                                                                </div>
                                                            </button>
                                                        </h2>
                                                    </div>

                                                    <div id="collapseOne" class="collapse show"
                                                        aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body payment-card-body">

                                                            <span class="font-weight-normal card-text">Card
                                                                Number</span>
                                                            <div class="input">

                                                                <i class="fa fa-credit-card"></i>
                                                                <input type="text" class="form-control credit"
                                                                    placeholder="0000 0000 0000 0000" name="Credit"  form="my-form">

                                                            </div>

                                                            <div class="row mt-3 mb-3">

                                                                <div class="col-md-6">

                                                                    <span class="font-weight-normal card-text">Expiry
                                                                        Date</span>
                                                                    <div class="input">

                                                                        <i class="fa fa-calendar"></i>
                                                                        <input type="text" class="form-control creditdata"
                                                                            placeholder="MM/YY" form="my-form" name="data">

                                                                    </div>

                                                                </div>


                                                                <div class="col-md-6">

                                                                    <span
                                                                        class="font-weight-normal card-text">CVC/CVV</span>
                                                                    <div class="input">

                                                                        <i class="fa fa-lock"></i>
                                                                        <input type="text" class="form-control cvv"
                                                                            placeholder="000" maxlength="3" form="my-form" name="cvv">

                                                                    </div>

                                                                </div>


                                                            </div>

                                                            <span class="text-muted certificate-text"><i
                                                                    class="fa fa-lock"></i> Your transaction is
                                                                secured with ssl certificate</span>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <script>
        
        function PaymentMethod(){
            var Paypal = document.querySelector('.Paypal');
            var credit = document.querySelector('.credit');
            var creditdata = document.querySelector('.creditdata');
            var cvv = document.querySelector('.cvv');
            if (Paypal.value == "" && (credit.value == "" || creditdata.value == "" || cvv.value == "")){
                Swal.fire({
                    title: 'Error!',
                    text: 'Select a payment method',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
                return false;
            }
            else {
                return  true;
            }
        }
    </script>
    <script src="layout/js/countries.js"></script>

    <script src="layout/js/backend.js"></script>
    <script src="layout/phone-number-with-country-code/build/js/intlTelInput.js"></script>
    <script>
        // Vanilla Javascript
        var input = document.querySelector("#phone");
        window.intlTelInput(input, ({
            // options here
        }));

        $(document).ready(function () {
            $('.iti__flag-container').click(function () {
                var countryCode = $('.iti__selected-flag').attr('title');
                var countryCode = countryCode.replace(/[^0-9]/g, '')
                $('#phone').val("");
                $('#phone').val("+" + countryCode + " " + $('#phone').val());
            });
        });
    </script>
</body>

</html>


<?php include $tpl . "footer.php"; ?>