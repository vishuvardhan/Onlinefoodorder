<?php
session_start();
include_once 'mysql.php';
include_once 'headernew.php';
include_once 'userTopNew.php';
?>
  

<section id="aa-myaccount" style="background-color:#FFF;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-myaccount-area">         
                    <div class="row">
                         <div class="col-md-3">
                           
                        </div>
                        <div class="col-md-6">
                            <div class="aa-myaccount-login">
                                <h4> Login</h4>
                                <?php
                                    if (isset($_GET) && !empty($_GET) && $_GET['s'] == 0) {
                                        ?>

                                        <div class="alert alert-danger" id="danger-alert">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong> <?php echo $_GET['st'] ?> </strong>
                                        </div>

                                        <?php }
                                    ?>
                                <form method="POST" action="adminLoginStatus.php" class="aa-login-form">
                                    <label for="">Username or Email address<span>*</span></label>
                                    <input type="text" placeholder="Username or email" name="username" required="">
                                    <label for="">Password<span>*</span></label>
                                    <input type="password" placeholder="Password" name="password"required="">
                                    <input type="text" id="login" value="login" name="login" hidden="">
                                    <button type="submit" class="btn btn-primary">Login</button>                                    
                                    
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3">
                           
                        </div>
                    </div>          
                </div>
            </div>
        </div>
    </div>
</section>


<?php include 'footernew.php'; ?>