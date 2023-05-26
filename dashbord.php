<?php
session_start();
if (isset($_SESSION['dashbord'])){
 
}
else {
    header('location:indexs.php');
}
include "init.php";
include "connect.php";
$UserID=$_SESSION['UserId'];
$sql = "SELECT * FROM myshop.users where UserId = ? limit 1";
$stmt = $con -> prepare($sql);
$stmt -> execute([$UserID]);
$result = $stmt -> fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    
    <!-- 2  -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@100;200;300;400;500&display=swap"
        rel="stylesheet"> -->
        <!-- Charts links -->
        <link rel="stylesheet" href="layout/css/charts/tailwind.output.css" />
        
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="layout/js/charts/init-alpine.js" defer></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
        
        <script src="layout/js/charts/charts-pie.js" defer></script>
        <script src="layout/js/charts/charts-lines.js" defer></script>
        <link rel="stylesheet" href="layout/css/style.css">
        
    </head>
    
    <body>
    <div class="dashboard">
        <div class="slidbar">
            <div class="slidbar-content">
                <a href="#" class="logo">logo</a>
                <ul class="menu-main">
                    <li class="sub-menus">
                        <a href="dashbord.php" class="active">
                            <i class="fa-solid fa-house fa-fw"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sub-menus has-children">
                        <a href="#" class="">
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
                    
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="head">
                <div class="container">
                                       <a href="#" class="navicon" onclick="showslidbar()"><i class="fa-solid fa-bars"></i></a>

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
                            <li><a href="#" class="profile"><img width="40" height="40" src="layout/imges/user/<?php echo $result['Avater']?>" alt=""
                                        onclick="showProfileMenu()"></a></li>
                        </ul>
                        <div class="profile-menu ">
                            <div class="profile-name">
                                <img src="layout/imges/avatar.png" alt="">
                                <span><?php echo $result['Fullname'] ;?></span>
                            </div>
                            <hr>
                            <?php
                            echo "
                                <a href='UpdateUser.php?id=".$result['UserID']."' >
                            
                                <i class='fa-regular fa-user'></i>
                                <span>My profile</span>
                            </a>
                                ";
                            ?>
                            <a href="Logout.php">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>Logout</span>
                            </a>
                        </div>



                    </div>
                </div>
            </div>
            <h2 class="main-title">Dashborad</h2>
            <div class="card-das">
                <div class="row-das">
                    <div class="col-das">
                        <span>
                            <img src="layout/imges/icons/dash2.svg" alt="">
                        </span>
                        <div class="content">
                            <p>Account balance</p>
                            <span>$ 46,760.89</span>
                        </div>
                    </div>
                    <div class="col-das">
                        <span>
                            <img src="layout/imges/icons/dash2.svg" alt="">
                        </span>
                        <div class="content">
                            <p>Account balance</p>
                            <span>$ 46,760.89</span>
                        </div>
                    </div>
                    <div class="col-das">
                        <span>
                            <img src="layout/imges/icons/dash2.svg" alt="">
                        </span>
                        <div class="content">
                            <p>Account balance</p>
                            <span>$ 46,760.89</span>
                        </div>
                    </div>
                    <div class="col-das">
                        <span>
                            <img src="layout/imges/icons/dash2.svg" alt="">
                        </span>
                        <div class="content">
                            <p>Account balance</p>
                            <span>$ 46,760.89</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dash-count">
                <div class="row-das">
                    <div class="col-das " style="background: #ff9f43;">
                        <div class="content">
                            <span>
                               <?php 
                                                    $sql = "SELECT *
                                                            FROM myshop.users where GroupID = 0";                                                 
                                                    $stmt=$con->prepare($sql);
                                                    $stmt->execute();
                                                    
                                                        echo $stmt->rowCount();
                                                        
                                                    
                                                    ?>
                            </span>
                            <p>Users</p>
                        </div>
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="col-das" style="background: #00cfe8;">
                        <div class="content">
                            <span>
                                <?php 
                                     $sql = "SELECT *
                                                            FROM myshop.supplier ";                                                 
                                                    $stmt=$con->prepare($sql);
                                                    $stmt->execute();
                                                    
                                                        echo $stmt->rowCount();
                                                        
                                                    
                                                    ?>               
                            </span>
                            <p>Suppliers</p>
                        </div>
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <div class="col-das" style="background: #1b2850;">
                        <div class="content">
                            <span>100</span>
                            <p>Customers</p>
                        </div>
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="col-das" style="background: #28c76f;">
                        <div class="content">
                            <span>100</span>
                            <p>Customers</p>
                        </div>
                        <i class="fa-regular fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 table-status">
                <div class="card">
                    <div class="card-body">
                        <div class="head">
                            <h4 class="card-title">Order Status</h4>
                            <a class="to-order" href="#">See more <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Order No</th>
                                        <th>Product Cost</th>
                                        <th>Prodact name</th>
                                        <th>Date Start</th>
                                        <th>Payment Mode</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="layout/imges/face/face1.jpg" alt="">
                                            <span>Abood Alnjjar</span>
                                        </td>
                                        <th>05213</th>
                                        <th>$56</th>
                                        <th>ipone 6s</th>
                                        <th>2023/1/1</th>
                                        <th>Paypal</th>
                                        <td>
                                            <div class="badge badge-outline-success">Approved</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="layout/imges/face/face1.jpg" alt="">
                                            <span>Abood Alnjjar</span>
                                        </td>
                                        <th>05213</th>
                                        <th>$56</th>
                                        <th>ipone 6s</th>
                                        <th>2023/1/1</th>

                                        <th>Paypal</th>
                                        <td>
                                            <div class="badge badge-outline-warning">Pending</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="layout/imges/face/face1.jpg" alt="">
                                            <span>Abood Alnjjar</span>
                                        </td>
                                        <th>05213</th>
                                        <th>$56</th>
                                        <th>ipone 6s</th>
                                        <th>2023/1/1</th>

                                        <th>Paypal</th>
                                        <td>
                                            <div class="badge badge-outline-danger">Rejected</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="layout/imges/face/face1.jpg" alt="">
                                            <span>Abood Alnjjar</span>
                                        </td>
                                        <th>05213</th>
                                        <th>$56</th>
                                        <th>ipone 6s</th>
                                        <th>2023/1/1</th>

                                        <th>Paypal</th>
                                        <td>
                                            <div class="badge badge-outline-success">Approved</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Charts section -->
            <div class="charts">
                <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Charts
                </h2>
                <div class="grid gap-6 mb-8 md:grid-cols-2">
                    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                            Revenue
                        </h4>
                        <canvas id="pie"></canvas>
                        <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                            <!-- Chart legend -->
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
                                <span>Shirts</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                                <span>Shoes</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                                <span>Bags</span>
                            </div>
                        </div>
                    </div>
                    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                            Traffic
                        </h4>
                        <canvas id="line"></canvas>
                        <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                            <!-- Chart legend -->
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                                <span>Organic</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                                <span>Paid</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- new prodact -->

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
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
                const navbar=document.querySelector(".slidbar");
        function showslidbar(){
            if(navbar.classList.contains("active")){
                navbar.classList.remove("active");
            }
            else{
                navbar.classList.add("active");
            }
        }
    </script>
    <script src="layout/js/backend.js"></script>
</body>

</html>
<?php include $tpl . "footer.php"; ?>