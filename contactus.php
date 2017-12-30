<?php
session_start();
include_once 'mysql.php';
include_once 'headernew.php';
include_once 'userTopNew.php';
?>


<section id="aa-contact" style="background-color:#FFF;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-contact-area">
                    <div class="aa-contact-top" style="padding-bottom: 20px;padding-top: 20px;">
                        <h2>We'd Love to Hear from You !</h2> 
                    </div>           
                    <div class="aa-contact-address" style="padding-bottom: 20px;padding-top: 20px;">
                        <div class="row">
                            <div class="col-md-8">
                                <?php
                                if (isset($_GET) && !empty($_GET)) {
                                    if (isset($_GET) && !empty($_GET) && $_GET['s'] == 0) {
                                        ?>                      
                                        <div class="alert alert-danger" id="danger-alert">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong> <?php echo $_GET['st'] ?> </strong>
                                        </div>                      
                                    <?php } ?>

                                    <?php
                                    if (isset($_GET) && !empty($_GET) && $_GET['s'] == 1) {
                                        ?>

                                        <div class="alert alert-success" id="danger-alert">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong> <?php echo $_GET['st'] ?> </strong>
                                        </div>
                                    <?php
                                    }
                                }
                                ?>
                                <div class="aa-contact-address-left">
                                    <form class="comments-form contact-form" action="contactusStatus.php" method="post">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">                        
                                                    <label>Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">                        
                                                    <input type="text" placeholder="Your Name" class="form-control" name="name" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">                        
                                                    <input type="email" placeholder="Email" class="form-control" name="email" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Subject</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">                        
                                                     <input type="text" placeholder="Subject" class="form-control" name="subject" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Mobile</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">                        
                                                     <input type="text" placeholder="Mobile" class="form-control" name="mobile" required="">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-4">
                                                <label>Message</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">                        
                                                    <textarea class="form-control" rows="3" placeholder="Message" name="message" required="" style="width: 100%;"></textarea>
                                                </div>
                                            </div>
                                        </div>                

                                        
                                        <button type="submit" class="btn btn-primary pull-right">Send</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="aa-contact-address-right">
                                    <address>
                                        <h4>onlinefood.com</h4>
                                        <p>Our food is best in town. </p>
                                        <p><span class="fa fa-home"></span>8700 Chesnut , Kansas city, MO</p>
                                        <p><span class="fa fa-phone"></span>+1 816-726-6442</p>
                                        <p><span class="fa fa-envelope"></span>Email: support.onlinefood.com</p>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include 'footernew.php'; ?>