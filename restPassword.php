<?php
include "init.php";
include "connect.php";
include $tpl ."header.php";

if (isset($_POST['submit'])){
    $email=$_POST['email'];
    echo "$email";
}

?>
<div class="forget" style="height:100vh;background-color:#f2f3f8;">   
<div class="container " >
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
                                        <label>Email</label>
                                        <input class="form-control form-control-lg" type="email" name="email"
                                            placeholder="Enter your email" required>
                                    </div>
                                        <div class="text-center mt-3">
                                                 <div class="inputbx">
                                                    <input  type="submit"  value="Rest password" name="submit" class="btn btn-primary submit" style="width:90% !important">
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
<!-- </body> -->
<?php include $tpl . "footer.php"; ?>