<?php
session_start();
$_SESSION['page']="category";
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
            <li class="active">Add Category</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Category</h1>
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
                            $strSQL = "SELECT * FROM category where id='" . $_GET['id'] . "'";
                            $rs = mysql_query($strSQL);
                            while ($row = mysql_fetch_array($rs)) {
                                ?>
                                <form enctype="multipart/form-data" method="post" action="addCategoryStatus.php"> 
                                    <?php
                                $strSQL1 = "SELECT * FROM types";
                                $rs1 = mysql_query($strSQL1);
                                ?>
                                    <div class="form-group">
                                    <label for="selector1">Type</label>
                                    <div><select name="type_id" id="type_id" class="form-control" required="">
                                            <option value="">Select Type</option>
                                            <?php while ($row1 = mysql_fetch_array($rs1)) { ?>
                                            <option value="<?php echo $row1['id']; ?>" <?php if($row1['id']==$row['type_id']) { ?> selected="" <?php }  ?> ><?php echo $row1['type_title']; ?></option>
                                            <?php } ?>                     
                                        </select>
                                    </div>
                                </div>
                                    <div class="form-group"> 
                                        <label for="Name">Name</label> 
                                        <input type="text" class="form-control" id="name"  name="name" placeholder="Name" style="width: 100%;" value="<?php echo $row['name']; ?>"> 
                                    </div> 
                                    <div class="form-group"> 
                                        <label for="Description">Description</label> 
                                        <textarea cols="50" rows="5" class="form-control" id="Description" name="description" placeholder="Description"><?php echo $row['description']; ?> </textarea>
                                    </div> 
                                    <div class="form-group"> 
                                    <label for="Name">Price in Dollar</label> 
                                    <input type="text" class="form-control" id="price"  name="price" placeholder="Price" style="width: 100%;" value="<?php echo $row['price_in_dollar']; ?>"> 
                                </div>
                                    <div class="form-group"> 
                                        <label for="image">Image</label> 
                                        <input type="file" id="file" name="file">
                                        <img src="<?php echo $row['file_location']; ?>" style="height:50px;width: 50px;">
                                        <input type="text" value="update" name="update" hidden="">
                                        <input type="text" value="<?php echo $row['id']; ?>" name="id" hidden="">
                                    </div>
                                    <div class="form-group">
                                        <label for="selector1">Status</label>
                                        <div><select name="status" id="status" class="form-control">
                                                <option <?php if($row['status']==1) { ?> selected="" <?php } ?> value="1">Active</option>
                                                <option <?php if($row['status']==0) { ?> selected="" <?php } ?> value="0">In-Active</option>                                        
                                            </select>
                                        </div>
                                    </div>                             
                                    <button type="submit" class="btn btn-primary">Submit</button> 
                                </form>
                            <?php }
                            ?>

<?php } else { ?>
                            <form enctype="multipart/form-data" method="post" action="addCategoryStatus.php"> 
                                <?php
                                $strSQL1 = "SELECT * FROM types";
                                $rs1 = mysql_query($strSQL1);
                                ?>
                                <div class="form-group">
                                    <label for="selector1">Type</label>
                                    <div><select name="type_id" id="type_id" class="form-control" required="">
                                            <option value="">Select Type</option>
                                            <?php while ($row1 = mysql_fetch_array($rs1)) { ?>
                                                <option value="<?php echo $row1['id']; ?>" ><?php echo $row1['type_title']; ?></option>
                                            <?php } ?>                     
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label for="Name">Name</label> 
                                    <input type="text" class="form-control" id="name"  name="name" placeholder="Name" style="width: 100%;"> 
                                </div> 
                                <div class="form-group"> 
                                    <label for="Description">Description</label> 
                                    <textarea cols="50" rows="5" class="form-control" id="Description" name="description" placeholder="Description"> </textarea>
                                </div> 
                                <div class="form-group"> 
                                    <label for="Name">Price in Dollar</label> 
                                    <input type="text" class="form-control" id="price"  name="price" placeholder="Price" style="width: 100%;"> 
                                </div> 
                                <div class="form-group"> 
                                    <label for="image">Image</label> 
                                    <input type="file" id="file" name="file"> 
                                </div>
                                <div class="form-group">
                                    <label for="selector1">Status</label>
                                    <div><select name="status" id="status" class="form-control">
                                            <option value="1" selected="">Active</option>
                                            <option value="0">In-Active</option>                                        
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



