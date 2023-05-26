<?php
include "init.php";
include "connect.php";
include $tpl . "header.php";

$UserID = $_GET['updateId'];
$sqlget = "SELECT * from myshop.users where UserID = ?";
$stm = $con->prepare($sqlget);
$stm->execute([$UserID]);
$result = $stm->fetchAll();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $GroupID = $_POST['GroupID'];
    $password = $_POST['password'];
    $hasherPass = sha1($password);
    $country = $_POST['country'];
    $state = $_POST['state'];
    $phone = $_POST['phone'];
    $image = $_POST['image'];
    $fullname = $firstname . " " . $lastname;
    $UserID = $_GET['updateId'];
    echo $email;

    $stmt = $con->prepare("UPDATE  myshop.users set fname=:fname, lname=:lname,Password = :Password,Email=:Email,phone=:phone,Country=:Country,State=:State,Fullname=:Fullname,GroupID=:GroupID where UserID=:id ");
    $stmt->bindParam(":fname", $firstname);
    $stmt->bindParam(":lname", $lastname);
    $stmt->bindParam(":Password", $hasherPass);
    $stmt->bindParam(":Email", $email);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":Country", $country);
    $stmt->bindParam(":State", $state);
    $stmt->bindParam(":Fullname", $fullname);
    $stmt->bindParam(":GroupID", $GroupID);
    $stmt->bindParam(":id", $UserID);
    $stmt->execute();

    echo "<script>
        Swal.fire(
        'Good job!',
        'Update Prodact completed successfully',
        'success'
                    )
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodact Add</title>
    <link rel="stylesheet" href="/OurProject/admin/layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="/OurProject/admin/layout/css/style.css">
    <link rel="stylesheet" href="/OurProject/admin/layout/css/FrameWork.css">
    <link rel="stylesheet" href="/OurProject/admin/layout/css/all.min.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Cairo:wght@300;400;700&family=Epilogue:wght@400;600;700&family=Merienda+One&family=Montserrat:wght@300;700&family=Nunito:wght@300;400;600&family=Poppins:wght@500;600&family=Raleway:wght@400;500;600&family=Roboto:wght@100;300;400;500;700&family=Space+Mono&display=swap"
        rel="stylesheet">

</head>

<body>
    <div class="dashboard">
        <div class="slidbar">
            <div class="slidbar-content">
                <a href="#" class="logo">logo</a>
                <ul class="menu-main">
                    <li class="sub-menus">
                        <a href="dashbord.php" class="">
                            <i class="fa-solid fa-house fa-fw"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sub-menus has-children">
                        <a href="#">
                            <i class="fa-solid fa-cart-flatbed fa-fw"></i>
                            <span>products</span>
                            <i class="fa fa-sort-down"></i>
                        </a>
                        <ul class="drop-menu ">
                            <li><a href="ProductsList.phpl">Product List</a></li>
                            <li><a href="AddProduct.php">Add Product</a></li>
                            <li><a href="CategoryList.php">Category List</a></li>
                            <li><a href="AddCategory.php">Add Category</a></li>
                            <li><a href="SubCatList.php">Sub Category List</a></li>
                            <li><a href="AddSubCate.php">Add Sub Category</a></li>
                        </ul>
                    </li>

                    <li class="sub-menus has-children">
                        <a href="#" class="">
                            <i class="fa-solid fa-truck-arrow-right fa-fw"></i>
                            <span>Orders</span>
                            <i class="fa fa-sort-down"></i>
                        </a>
                        <ul class="drop-menu ">

                            <li><a href="OrdersList.html">Orders List</a></li>
                            <li><a href="addOrder.html">Add Order</a></li>
                        </ul>
                    </li>

                    <li class="sub-menus has-children">
                        <a href="#" class="active">
                            <i class="fa-solid fa-users fa-fw"></i>
                            <span>customers</span>
                            <i class="fa fa-sort-down"></i>
                        </a>
                        <ul class="drop-menu ">
                            <li><a href="SupplierList.php">Supplier List</a></li>
                            <li><a href="AddSupplier.php">Add Supplier </a></li>
                            <li><a href="UserList.php">User List</a></li>
                            <li><a href="AddNewUser.php">Add User</a></li>
                        </ul>
                    </li>
                    <li class="sub-menus has-children">
                        <a href="#" class="">
                            <i class="fa-solid fa-envelope fa-fw"></i>
                            <span>Messages</span>
                            <i class="fa fa-sort-down"></i>
                        </a>
                        <ul class="drop-menu">
                            <li><a href="supplierlist.html">Inbox</a></li>
                            <li><a href="addsupplier.html">Compose </a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <div class="content">
            <div class="head">
                <div class="container">
                    <div class="search-box">
                        <div class="search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="search" placeholder="Search products" class="form-control" />
                        </div>
                    </div>
                    <div class="icons">
                        <ul>
                            <li><a href="#"><i class="fa-solid fa-moon"></i></a></li>
                            <li class="Notifications"><a href="#"><i class="fa-solid fa-bell"></i></i></a></li>
                            <li><a href="#" class="profile"><img src="/OurProject/admin/layout/imges/avatar.png" alt=""
                                        onclick="showProfileMenu()"></a></li>
                        </ul>
                        <div class="profile-menu ">
                            <div class="profile-name">
                                <img src="/OurProject/admin/layout/imges/avatar.png" alt="">
                                <span>Abood ALnjjar</span>
                            </div>
                            <hr>
                            <a href="#">
                                <i class="fa-regular fa-user"></i>
                                <span>My profile</span>
                            </a>
                            <a href="#">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>Logout</span>
                            </a>
                        </div>



                    </div>
                </div>
            </div>

            <!-- Update User -->
            <div class="form-add new-users">
                <div class="sec-title">
                    <h2 class="main-title">User Management</h2>
                    <p class="desc-title">Add/Update User</p>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="">Frist Name *</label>
                                        <input type="text" name="firstname" id="" class="form-control required" value="<?php foreach ($result as $us) {
                                            echo $us['fname'];
                                        } ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="">Last Name *</label>
                                        <input type="text" name="lastname" id="" class="form-control required" value="<?php foreach ($result as $us) {
                                            echo $us['lname'];
                                        } ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="">Email *</label>
                                        <input type="email" name="email" id="" class="form-control " required value="
                                                <?php foreach ($result as $us) {
                                                    echo $us['Email'];
                                                } ?>
                                               ">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="">Role</label>
                                        <select name="GroupID" id="" class="form-control">
                                            <?php
                                            foreach ($result as $us) {
                                                $value = $us['GroupID'];
                                                if ($value = 1) {
                                                    echo "
                                                            <option value='0'>User</option>
                                                            <option selected value='1'>Admin</option>
                                                            ";
                                                } else {
                                                    echo "
                                                            <option selected value='0'>User</option>
                                                            <option  value='1'>Admin</option>
                                                            ";
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="">Password *</label>
                                        <input type="password" name="password" id="" class="form-control " required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="">Confirm Password *</label>
                                        <input type="password" name="" id="" class="form-control " required>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="">Country *</label>
                                        <select id="country" required name="country" class="form-control" required>
                                            <option selected>
                                                <?php foreach ($result as $us) {
                                                    echo $us['Country'];
                                                } ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="">State *</label>
                                        <select name="state" required id="state" class="form-control" required>
                                            <option>
                                                <?php foreach ($result as $us) {
                                                    echo $us['State'];
                                                } ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group" style="display: flex;flex-direction: column;">
                                        <label for="">Phone Number *</label>
                                        <input type="tel" pattern="[0-9-()-+ ]*" id="phone" name="phone"
                                            class="phone form-control" required style="flex: 1;" value="<?php foreach ($result as $us) {
                                                echo $us['phone'];
                                            } ?>">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Avater *</label>
                                        <div class="image-upload">
                                            <input type="file" name="image" id="uplodeimg" class="form-control" required
                                                value="
                                                <?php foreach ($result as $us) {
                                                    echo $us['Avater'];
                                                } ?>
                                               ">
                                            <div class="image-uploads">
                                                <img src="layout/imges/icons/upload.svg" alt="">
                                                <h4>Drag and drop a file to upload</h4>
                                                <span id="imageName" class="imageName"></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <input type="submit" value="<?php $UserID ?>" class="btn btn-primary"
                                        style="width: 100px !important;">
                                    <a href="#" class="btn btn-secondary" style="width: 100px !important;">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const page = document.querySelector(".dashboard");
        const profileMenu = document.querySelector(".profile-menu");
        function showProfileMenu() {
            if (profileMenu.classList.contains("active")) {
                profileMenu.classList.remove("active");
            }
            else {
                profileMenu.classList.add("active");
            }
        }


        let Menu = document.querySelector(".menu-main");
        let SubMenu;
        Menu.addEventListener("click", e => {
            if (e.target.closest(".has-children")) {
                const hasChild = e.target.closest(".has-children");
                ShowSubMenu(hasChild);
            }

        });
        function ShowSubMenu(hasChild) {
            SubMenu = hasChild.querySelector(".drop-menu");
            SubMenu.classList.toggle("is-active");
        }
        // img 
        let input = document.getElementById("uplodeimg");
        let imageName = document.getElementById("imageName")

        input.addEventListener("change", () => {
            let inputImage = document.querySelector("input[type=file]").files[0];

            imageName.innerText = inputImage.name;
        }) 
    </script>
    <script src="/OurProject/admin/layout/js/backend.js"></script>
    <script src="/OurProject/admin/layout/js/countries.js"></script>
    <script src="/OurProject/admin/layout/phone-number-with-country-code/build/js/intlTelInput.js"></script>
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