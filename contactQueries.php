<?php
session_start();
$_SESSION['page']="contact";
include_once 'mysql.php';
include_once 'adminHeader.php';
include_once 'adminTop.php';
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
   <?php include_once 'adminLeft.php'; ?>

</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="adminHome.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Contact Queries</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Contact Queries</h1>
        </div>
    </div><!--/.row-->
<?php
                if (isset($_GET) && !empty($_GET)) {
                    if (isset($_GET) && !empty($_GET) && $_GET['s'] == 0) {
                        ?>                      
                        <div class="alert bg-danger" id="danger-alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong> <?php echo $_GET['st'] ?> </strong>
                        </div>                      
                    <?php } ?>

                    <?php
                    if (isset($_GET) && !empty($_GET) && $_GET['s'] == 1) {
                        ?>

                        <div class="alert bg-success" id="danger-alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong> <?php echo $_GET['st'] ?> </strong>
                        </div>

                        <?php
                    }
                }

               $strSQL = "SELECT * FROM contactus order by posted_on desc";
                $rs = mysql_query($strSQL);

                if (mysql_num_rows($rs) == 0) {
                    ?>
                    <div class="alert bg-info" id="danger-alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong> There is no Queries Posted. </strong>
                    </div>
                <?php } else {
                    ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Orders</div>
                <div class="panel-body">
                    <table data-toggle="table">
                        <thead> 
                                <tr> 
                                    <th>#</th> 
                                    <th>Name</th> 
                                    <th>Email</th> 
                                    <th>Mobile</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Posted On</th>                                    
                                </tr> 
                            </thead> 
                            <tbody> 
                                <?php
                                 $i = 1;
                                while ($row = mysql_fetch_array($rs)) {
                                   
                                    ?>

                                    <tr > 
                                        <td><?php echo $i; ?></td> 
                                        <td><?php echo $row['name']; ?></td> 
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['mobile']; ?></td>
                                        <td><?php echo $row['subject']; ?></td>
                                        <td><?php echo $row['message']; ?></td>
                                        <td><?php echo $row['posted_on']; ?></td>
                                    </tr> 
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody> 
                    </table>
                </div>
            </div>
        </div>
    </div><!--/.row-->	
  
                <?php } ?>

</div><!--/.main-->





<!-- Classie -->
<?php include_once 'adminFooter.php'; ?>




