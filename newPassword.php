<?php
include "init.php";
include "connect.php";
include $tpl ."header.php";
?>


    <div class="rest" style="height:100vh;background-color:#f2f3f8;">
        <div class="container ">
            <div class="row h-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Forget password</h1>
                            <p class="lead">
                                Enter your email to reset your password.
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>>
                                        <div class="form-group">
                                            <div class="inputbx">
                                                <label>Password</label>
                                                <input class="form-control form-control-lg" type="password" id="password"
                                                    name="password" placeholder="Enter your new password" required>
                                                <i class="fa-solid fa-key"></i>
                                                <i onclick="visibili()" class="fa-regular fa-eye hide" id="hide"></i>
                                            </div>
                                            <div class="inputbx">
                                                <label>Confirm Password</label>
                                                <input class="form-control form-control-lg" type="password" id="password"
                                                    name="password" placeholder="Enter your new password" required>
                                                    <i class="fa-solid fa-check"></i>
                                                    
                                            </div>
                                        </div>
                                        <div class="text-center mt-3">
                                                 <div class="inputbx">
                                                    <input type="submit"  value="Login" name="submit" class="btn btn-primary submit" style="width:90% !important">
                                                </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include $tpl . "footer.php"; ?>