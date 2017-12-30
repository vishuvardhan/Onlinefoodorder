<?php
session_start();
$_SESSION['page']="stock";
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
            <li class="active">Add Stocks</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Stocks</h1>
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
                            $strSQL = "SELECT * FROM stock where id='" . $_GET['id'] . "'";
                            $rs = mysql_query($strSQL);
                            $row = mysql_fetch_array($rs);
                            $strSQL1 = "SELECT * FROM category";
                            $rs1 = mysql_query($strSQL1);

                            $strSQL2 = "SELECT * FROM administrator";
                            $rs2 = mysql_query($strSQL2);
                            ?>
                            <form enctype="multipart/form-data" method="post" action="addStockStatus.php"> 
                                <div class="form-group">
                                    <label for="selector1">Category</label>
                                    <div><select name="category" id="status" class="form-control">
                                            <?php while ($row1 = mysql_fetch_array($rs1)) { ?>
                                                <option value="<?php echo $row1['id']; ?>" <?php if ($row1['id'] == $row['cat_id']) { ?> selected="" <?php } ?>><?php echo $row1['name']; ?></option>
                                            <?php } ?>                     
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group"> 
                                    <label for="Name">Stock in </label> 
                                    <input type="number" class="form-control" id="stock"  name="stock" placeholder="Stock"  value="<?php echo $row['stock_in_lbs'] ?>"style="width: 100%;"> 
                                </div> 

                                <div class="form-group">
                                    <label for="selector1">Added By</label>
                                    <div><select name="addedby" id="addedby" class="form-control">
                                            <?php while ($row1 = mysql_fetch_array($rs2)) { ?>
                                                <option value="<?php echo $row1['id']; ?>" <?php if ($row1['id'] == $row['added_by']) { ?> selected="" <?php } ?>><?php echo $row1['username']; ?></option>
                                            <?php } ?>                     
                                        </select>
                                    </div>
                                </div>   
                                <input type="text" value="update" name="update" hidden="">
                                <input type="text" value="<?php echo $row['id']; ?>" name="id" hidden="">
                                <button type="submit" class="btn btn-primary">Submit</button> 
                            </form>


                            <?php
                        } else {

                            $strSQL = "SELECT * FROM category";
                            $rs = mysql_query($strSQL);

                            $strSQL1 = "SELECT * FROM administrator";
                            $rs1 = mysql_query($strSQL1);
                            ?>
                            <form enctype="multipart/form-data" method="post" action="addStockStatus.php"> 
                                <div class="form-group">
                                    <label for="selector1">Category</label>
                                    <div><select name="category" id="status" class="form-control">
                                            <?php while ($row = mysql_fetch_array($rs)) { ?>
                                                <option value="<?php echo $row['id']; ?>" selected=""><?php echo $row['name']; ?></option>
                                            <?php } ?>                     
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group"> 
                                    <label for="Name">Stock in </label> 
                                    <input type="number" class="form-control" id="stock"  name="stock" placeholder="Stock" style="width: 100%;"> 
                                </div> 

                                <div class="form-group">
                                    <label for="selector1">Added By</label>
                                    <div><select name="addedby" id="addedby" class="form-control">
                                            <?php while ($row1 = mysql_fetch_array($rs1)) { ?>
                                                <option value="<?php echo $row1['id']; ?>" selected=""><?php echo $row1['username']; ?></option>
                                            <?php } ?>                     
                                        </select>
                                    </div>
                                </div>                              
                                <button type="submit" class="btn btn-primary">Submit</button> 
                            </form>
                        <?php } ?>
        </div>
    </div>



</div><!--/.main-->

<?php include_once 'adminFooter.php'; ?>