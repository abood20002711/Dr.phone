<?php
include "init.php";
include "connect.php";
include $tpl . "header.php";
$sql = "select items.*,category.CategoryName,subcategory.SubCatName
                                                     from myshop.items,myshop.subcategory, myshop.category
                                                      where Category = CategoryID and sCategory=SubCateID";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
// Delete Proudact
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql2 = "DELETE FROM myshop.Items WHERE ID=?";
    $delete = $con->prepare($sql2);
    $delete->execute([$id]);
    header("Location:ProductsList.php");
    die();

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodact Add</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/cRebootss/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
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
    <!-- phone  number -->
    <link rel="stylesheet" href="layout/phone-number-with-country-code/build/css/intlTelInput.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <div class="dashboard">
        <div class="slidbar">
            <div class="slidbar-content">
                <a href="#" class="logo">logo</a>
                <ul class="menu-main">
                    <li class="sub-menus">
                        <a href="dashbord.php">
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
                            <li><a href="#" class="profile"><img src="layout/imges/avatar.png" alt=""
                                        onclick="showProfileMenu()"></a></li>
                        </ul>
                        <div class="profile-menu ">
                            <div class="profile-name">
                                <img src="layout/imges/avatar.png" alt="">
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

            <!-- prodact List  -->
            <div class="form-add Proudact-List">
                <div class="sec-title" style="display: flex;align-items: center;justify-content: space-between;">
                    <div class="desc">
                        <h2 class="main-title">Product List</h2>
                        <p class="desc-title">Manage your products</p>
                    </div>
                    <a href="AddProduct.php" class="btn btn-primary" style="width: 200px !important;">Add new
                        prodact</a>

                </div>
            </div>
            <div class="prodactList">
                <div class="card">
                    <div class="card-body">
                        <!-- <div class="head">
                            <div class="filter" onclick="showicons()">
                                <a href="#" class="filter-icons">
                                    <img id="filter-icon" class="active" src="/OurProject/admin/layout/imges/icons/filter.svg" alt="">
                                    <img id="close-filter" class="" src="/OurProject/admin/layout/imges/icons/closes.svg" alt="">
                        
                                </a>
                            </div>
                    
                        </div>
                        <div class="filter-cat">
                            <form action="">
                                <div class="row">
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <select name="Category" id="" class="form-control">
                                                <option value="Ipohne">Ipohne</option>
                                                <option value="card">card</option>
                                                <option value="charger">charger</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <select name="Category" id="" class="form-control">
                                                <option value="Ipohne">Ipohne</option>
                                                <option value="card">card</option>
                                                <option value="charger">charger</option>
                                            </select>
                                        </div>
                                    </div>
                        
                                </div>
                            </form>
                        </div> -->
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Proudact Name</th>
                                        <th>Prodact Code</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Salary</th>
                                        <th>Add Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($result as $pro) {
                                        echo
                                            "<tr> 
                                                                <td>" . $pro['ItemName'] . "</td>
                                                                <td>" . $pro['ItemCodes'] . "</td>
                                                                <td>" . $pro['Quantity'] . "</td>
                                                                <td>" . $pro['CategoryName'] . "</td>
                                                                <td>" . $pro['SubCatName'] . "</td>
                                                                <td>" . $pro['Price'] . "</td>
                                                                <td>" . $pro['AddDate'] . "</td>
                                                                <td class='actions'>
                                                                <a title='Edit Proudact' href='UpdateUser.php?id=" . $pro['ID'] . "' class='action'><i class='fa-regular fa-pen-to-square'></i></a>
                                                                <a title='Remove Proudact' href='ProductsList.php?id=" . $pro['ID'] . "' class='action'><i class='fa-regular fa-trash-can'></i></a>
                                                            </td>
                                                            </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MDB -->

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
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

        // filter icons 
        let filterIcon = document.getElementById("filter-icon");
        let close = document.getElementById("close-filter");
        let filterCat = document.querySelector(".filter-cat");
        function showicons() {
            filterIcon.classList.toggle("active");
            close.classList.toggle("active");
            filterCat.classList.toggle("active");
        }


    </script>
    <script>            $(document).ready(function () {
            $('#example').DataTable();

        });</script>

</body>

</html>
<?php include $tpl . "footer.php"; ?>