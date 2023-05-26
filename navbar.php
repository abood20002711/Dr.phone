<?php 
include "init.php";
include "connect.php";
include $tpl ."header.php";
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <div class="collapse navbar-collapse contain" id="navbarSupportedContent">
            <form class="d-flex" role="search">
              <a class="navbar-brand" href="#">Navbar</a>
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            </form>
            <a href="#">Login</a>
            <div class="icons">
                <ul>
                    <li><a href=""><i class="fa-regular fa-heart"></i></a></li>
                    <li><a href=""><i class="fa-solid fa-cart-shopping"></i></a></li>
                    <li><a href=""><i class="fa-regular fa-user"></i></a></li>
                </ul>
            </div>
          </div>
        </div>
      </nav>


<?php include $tpl . "footer.php"; ?>