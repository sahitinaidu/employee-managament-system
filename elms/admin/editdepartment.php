<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['alogin']))
    {  
header('location:../main.php');
}
else{
	$bid=intval($_GET['deptid']);
    $key=$_GET['key'] ; 
if(isset($_POST['updatedept']))
{

$deptname=$_POST['departmentname'];
$deptshortname=$_POST['departmentshortname'];
$deptcode=$_POST['deptcode'];   
$sql="update tbldepartments set DepartmentName=:deptname,DepartmentCode=:deptcode,DepartmentShortName=:deptshortname where id=:bid";
$query = $dbh->prepare($sql);
$query->bindParam(':deptname',$deptname,PDO::PARAM_STR);
$query->bindParam(':deptcode',$deptcode,PDO::PARAM_STR);
$query->bindParam(':deptshortname',$deptshortname,PDO::PARAM_STR);
$query->bindParam(':bid',$bid,PDO::PARAM_STR);
$query->execute();
$msg="Department updated Successfully";
}
if(isset($_POST['updatesect']))
{

$sectname=$_POST['sectionname']; 
$sql="update tblsections set sectionName=:sectname where id=:bid";
$query = $dbh->prepare($sql);
$query->bindParam(':sectname',$sectname,PDO::PARAM_STR);
$query->bindParam(':bid',$bid,PDO::PARAM_STR);
$query->execute();
$msg="Section updated Successfully";
}
if(isset($_POST['updateschool']))
{

$schoolname=$_POST['schoolname'];
$schoolshortname=$_POST['schoolshortname'];   
$sql="update tblschools set schoolName=:schoolname,SchoolShortName=:schoolshortname where id=:bid";
$query = $dbh->prepare($sql);
$query->bindParam(':schoolname',$schoolname,PDO::PARAM_STR);
$query->bindParam(':schoolshortname',$schoolshortname,PDO::PARAM_STR);
$query->bindParam(':bid',$bid,PDO::PARAM_STR);
$query->execute();
$msg="School updated Successfully";
}
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>ADMIN | Update department</title>
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../../css-img/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../../css-img/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="../../css-img/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css-img/css/custom.css" rel="stylesheet" type="text/css"/>
  <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Update </div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="card">
                            <div class="card-content">
                              
                                <div class="row">
                                    <?php if($key=="department"){?>
                                    <form class="col s12" name="chngpwd" method="post">
                                          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
<?php 
$bid=intval($_GET['deptid']);
$sql = "SELECT * from tbldepartments WHERE id=:bid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bid',$bid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

                                        <div class="row">
                                            <div class="input-field col s12">
<input id="departmentname" type="text"  class="validate" autocomplete="off" name="departmentname" value="<?php echo htmlentities($result->DepartmentName);?>"  required>
                                                <label for="deptname">Department Name</label>
                                            </div>


          <div class="input-field col s12">
<input id="departmentshortname" type="text"  class="validate" autocomplete="off" value="<?php echo htmlentities($result->DepartmentShortName);?>" name="departmentshortname"  required>
                                                <label for="deptshortname">Department Short Name</label>
                                            </div>
  <div class="input-field col s12">
 <input id="deptcode" type="text" name="deptcode" class="validate" autocomplete="off" value="<?php echo htmlentities($result->DepartmentCode);?>" required>
                                                <label for="password">Department Code</label>
                                            </div>

<?php }} ?>


<div class="input-field col s12">
<button type="submit" name="updatedept" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>

</div>




                                        </div>
                                       
                                    </form><?php }
                                    else if($key=="section") { ?>
                                        <form class="col s12" name="chngpwd" method="post">
                                          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
<?php 
$bid=intval($_GET['deptid']);
$sql = "SELECT * from tblsections WHERE id=:bid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bid',$bid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

                                        <div class="row">
                                            <div class="input-field col s12">
<input id="sectionname" type="text"  class="validate" autocomplete="off" name="sectionname" value="<?php echo htmlentities($result->sectionName);?>"  required>
                                                <label for="sectionname">Section Name</label>
                                            </div>        
<?php }} ?>

<div class="input-field col s12">
<button type="submit" name="updatesect" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>
</div>
                                        </div>
                                       
                                    </form><?php } else if($key=="school"){
                                        ?> 
 <form class="col s12" name="chngpwd" method="post">
                                          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
<?php 
$bid=intval($_GET['deptid']);
$sql = "SELECT * from tblschools WHERE id=:bid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bid',$bid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

                                        <div class="row">
                                            <div class="input-field col s12">
<input id="schoolname" type="text"  class="validate" autocomplete="off" name="schoolname" value="<?php echo htmlentities($result->schoolName);?>"  required>
                                                <label for="deptname">School Name</label>
                                            </div>


          <div class="input-field col s12">
<input id="schoolshortname" type="text"  class="validate" autocomplete="off" value="<?php echo htmlentities($result->SchoolShortName);?>" name="schoolshortname"  required>
                                                <label for="schoolshortname">School Short Name</label>
                                            </div>
  <?php }} ?>


<div class="input-field col s12">
<button type="submit" name="updateschool" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>

</div>




                                        </div>
                                       
                                    </form><?php } else{} ?>
                                </div>
                            </div>
                        </div>
                     
             
                   
                    </div>
                
                </div>
            </main>

        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="../../css-img/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../../css-img/plugins/materialize/js/materialize.min.js"></script>
        <script src="../../css-img/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../../css-img/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../../css-img/js/alpha.min.js"></script>
        <script src="../../css-img/js/pages/form_elements.js"></script>
        
    </body>
</html>
<?php } ?> 