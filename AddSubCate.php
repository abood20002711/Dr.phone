<?php 
include "init.php";
include "connect.php";
include $tpl ."header.php";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $SubCatName=$_POST['SubCatName'];
    $SubCatCode =$_POST['SubCatCode'];
    $Description=$_POST['Description'];
    $parentID=$_POST['parentID'];
    // Check if CategoryName  is Code

    
    $sql2= "select * from myshop.subcategory where SubCatCode=:SubCatCode";
    $stm3= $con->prepare($sql2);
    $stm3->bindParam(':SubCatCode', $SubCatCode);
    $stm3 -> execute();
    if ($stm3->rowCount() > 0) {
        echo "<script>     Swal.fire({
        title: 'Error!',
        text: 'The Sub Category Code   already exists, use another Product Code ',
        icon: 'error',
        confirmButtonText: 'OK'
      })</script>";
    } 
    else{
        try{
                $stmt= $con->prepare("insert into myshop.subcategory (SubCatName,SubCatCode,Description,parentID) VALUES 
    (:SubCatName,:SubCatCode,:Description,:parentID)");
    $stmt->bindParam(":SubCatName",$SubCatName);
    $stmt->bindParam(":SubCatCode",$SubCatCode);
    $stmt->bindParam(":Description",$Description);
    $stmt->bindParam(":parentID",$parentID);
    
    $stmt ->execute();
    
        echo "<script>
        Swal.fire(
        'Good job!',
        'Add Category completed successfully',
        'success'
                    )
    </script>";
        }
        catch (exception $e) {
        echo "<script>     Swal.fire({
        title: 'Error!',
        text: 'You don\'t have a category',
        icon: 'error',
        confirmButtonText: 'OK'
      })</script>";
            }
    }

        
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
                        <a href="#" class="active">
                            <i class="fa-solid fa-cart-flatbed fa-fw"></i>
                            <span>products</span>
                            <i class="fa fa-sort-down"></i>
                        </a>
                        <ul class="drop-menu ">
                            <li><a href="ProductsList.php">Product List</a></li>
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
                        <a href="#" class="">
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

            <!-- new SubCategory -->
            <div class="form-add new-SubCategory">
                <div class="sec-title">
                    <h2 class="main-title">Add Sub Category</h2>
                    <p class="desc-title">Create new product Category</p>
                </div>
                <div class="card">
                    <div class="card-body">

                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="row">

                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="">Main Category *</label>
                                        <select name="maincategort" id="MainCat" class="form-control">
                                            <option value="">Select Main Category</option>
                                               <?php
                                                   
                                                    $stmt = $con->prepare('SELECT * FROM myshop.maincategort');
                                                    $stmt->execute();
                                                    $maincategort = $stmt->fetchAll();
                                                    //loop through the maincategort and add them as options in the select dropdown
                                                    foreach ($maincategort as $category) {
                                                        echo '<option value="'.$category['MainCatID'].'">'.$category['NameMainCat'].'</option>';
                                                    }
                                                    ?>             
                                        </select>
                                    </div>
                                                </div>
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="">Parent Category *</label>
                                        <select name="parentID" id="Category" class="form-control">
                                            <option value="">Select Category</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="">Category Name *</label>
                                        <input type="text" name="SubCatName" id="" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="">Category Code *</label>
                                        <input type="text" name="SubCatCode" pattern="[0-9-()-+ ]*" id="" class="form-control" placeholder="Use Numbers">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="Description" id="" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-primary" style="width: 100px !important;">
                                    <a href="#" class="btn btn-secondary" style="width: 100px !important;">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
	$(document).ready(function() {
		//when a category is selected, update the subcategory dropdown
		$('#MainCat').change(function() {
			var MainCatID = $(this).val();
			$.ajax({
				type: 'POST',
				url: 'getCat.php',
				data: {MainCatID: MainCatID},
				dataType: 'json',
				success: function(data) {
					$('#Category').empty();
					$.each(data, function(index, Category) {
						$('#Category').append('<option value="'+Category.CategoryID+'">'+Category.CategoryName+'</option>');
					});
				},
				error: function() {
					alert('Error: Could not retrieve subcategories.');
				}
			});
		});
	});
	</script>
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

    </script>

<?php include $tpl . "footer.php"; ?>