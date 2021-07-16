<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['alogin']))
    {  
header('location:../main.php');
}
else{
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from  tblleavetype  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Leave type record deleted";

}
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>ADMIN | Manage Leave Type</title>
        
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
    </head>
    <body>
       <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                    
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                               
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>SNo.</th>
                                            <th>Leave Type</th>
                                            <th>Action</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php $sql = "SELECT * from tblleavetype";
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
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                            
                                            <td><a href="editleavetype.php?lid=<?php echo htmlentities($result->id);?>">Edit</a></td>
                                            <td><a href="manageleavetype.php?del=<?php echo htmlentities($result->id);?>" >Delete</a> </td>
                                        </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
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