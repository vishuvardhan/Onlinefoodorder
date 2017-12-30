<?php
session_start();
$_SESSION['page']="types";
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
            <li class="active">Add Food Type</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Food Type</h1>
        </div>
    </div><!--/.row-->
<?php
                
                    if (isset($_GET['s']) && !empty($_GET) && $_GET['s'] == 0) {
                        ?>                      
                        <div class="alert bg-danger" id="danger-alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong> <?php echo $_GET['st'] ?> </strong>
                        </div>                      
                    <?php } ?>

                    <?php
                    if (isset($_GET['s']) && !empty($_GET) && $_GET['s'] == 1) {
                        ?>

                        <div class="alert bg-success" id="danger-alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong> <?php echo $_GET['st'] ?> </strong>
                        </div>

                        <?php
                    }
              

               
                    ?>

      <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-6">
                    <?php
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                            $strSQL = "SELECT * FROM types where id='" . $_GET['id'] . "'";
                            $rs = mysql_query($strSQL);
                            while ($row = mysql_fetch_array($rs)) {
                                ?>
                                <form enctype="multipart/form-data" method="post" action="addTypeStatus.php" role="form"> 
                                    <div class="form-group"> 
                                        <label for="Name">Title</label> 
                                        <input type="text" class="form-control" id="type_title"  name="type_title" placeholder="Title" style="width: 100%;" value="<?php echo $row['type_title']; ?>"> 
                                    </div> 

                                    <input type="text" value="update" name="update" hidden="">
                                    <input type="text" value="<?php echo $row['id']; ?>" name="id" hidden="">
                                    <button type="submit" class="btn btn-primary">Submit</button> 
                                </form>
                            <?php }
                            ?>

                        <?php } else { ?>
                            <form enctype="multipart/form-data" method="post" action="addTypeStatus.php" role="form"> 
                                <div class="form-group"> 
                                    <label for="Name">Title</label> 
                                    <input type="text" class="form-control" id="type_title"  name="type_title" placeholder="Title" style="width: 100%;"> 
                                </div>                                                             
                                <button type="submit" class="btn btn-primary">Submit</button> 
                            </form>
                        <?php } ?>
                    </div>
            </div>
  
              

</div><!--/.main-->





<!-- Classie -->
<?php include_once 'adminFooter.php'; ?>

