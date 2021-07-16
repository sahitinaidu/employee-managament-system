<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['alogin']))
    {  
header('location:../main.php');
}
else{ 
if(isset($_GET['deldept']))
{
$id=$_GET['deldept'];
$sql = "delete from  tbldepartments  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Department  deleted successfully')</script>";

}
if(isset($_GET['delsect']))
{
$id=$_GET['delsect'];
$sql = "delete from  tblsections  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Setion  deleted successfully')</script>";

}
if(isset($_GET['delschool']))
{
$id=$_GET['delschool'];
$sql = "delete from  tblschools  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('School  deleted successfully')</script>";

}
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>ADMIN | Manage Department</title>
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../../css-img/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../../css-img/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../../css-img/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

            
        <!-- Theme Styles -->
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
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function () {
  $('.group').hide();
  $('#department').show();
  $('#selectMe').change(function () {
    $('.group').hide();
    $('#'+$(this).val()).show();
  })
}); 
        </script>
    </head>
    <body>
       <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                    
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                 <select id="selectMe">
                                        <option value="department">Department</option>
                                        <option value="section">Section</option>
                                        <option value="school">School</option>
                                        
                                    </select>
                                     <div id="department" class="group">
                                <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Dept Name</th>
                                            <th>Dept Short Name</th>
                                            <th>Dept Code</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php

 $sql = "SELECT * from tbldepartments";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->DepartmentName);?></td>
                                            <td><?php echo htmlentities($result->DepartmentShortName);?></td>
                                             <td><?php echo htmlentities($result->DepartmentCode);?></td>
                                            <td><a href="editdepartment.php?deptid=<?php echo htmlentities($result->id);?>&key=<?php echo htmlentities('department');?>">Edit</i></a></td>
											<td><a href="managedepartments.php?deldept=<?php echo htmlentities($result->id);?>" >Delete</a></td>
                                            
                                        </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table></div>
                                <div id="section" class="group">
                                     <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Section Name</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php $sql = "SELECT * from tblsections";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->sectionName);?></td>
                                           
                                            <td><a href="editdepartment.php?deptid=<?php echo htmlentities($result->id);?>&key=<?php echo htmlentities('section');?>">Edit</i></a></td>
                                            <td><a href="managedepartments.php?delsect=<?php echo htmlentities($result->id);?>" >Delete</a></td>
                                            
                                        </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                                </div>
                                 <div id="school" class="group">
                                      <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>School Name</th>
                                            <th>School Short Name</th>
                                            
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php $sql = "SELECT * from tblschools";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->schoolName);?></td>
                                            <td><?php echo htmlentities($result->SchoolShortName);?></td>
                                            
                                            <td><a href="editdepartment.php?deptid=<?php echo htmlentities($result->id);?>&key=<?php echo htmlentities('school');?>">Edit</i></a></td>
                                            <td><a href="managedepartments.php?delschool=<?php echo htmlentities($result->id);?>" >Delete</a></td>
                                            
                                        </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
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
        <script src="../../css-img/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../../css-img/js/alpha.min.js"></script>
        <script src="../../css-img/js/pages/table-data.js"></script>
        
    </body>
</html>
<?php } ?>