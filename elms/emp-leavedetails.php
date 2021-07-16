<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['emplogin']))
    {   
header('location:main.php');
}
else{
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from  tblleaves  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Leave record deleted";
}

 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>EMPLOYEE | Leave History</title>
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../css-img/plugins/materialize/css/materialize.min.css"/>
        <link href="../css-img/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../css-img/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        
        <!-- Theme Styles -->
        <link href="../css-img/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css-img/css/custom.css" rel="stylesheet" type="text/css"/>
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
                        <div class="page-title"><h5>Leave Details</h5></div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                               <span class="card-title">Leave Details</span>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                               <table id="example" class="display responsive-table ">
                               
                                 
                                    <tbody>
<?php 
$lid=intval($_GET['leaveid']);
$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblemployees.Gender,tblemployees.Phonenumber,tblemployees.EmailId,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.FromDate,tblleaves.Description,tblleaves.PostingDate,tblleaves.Status,tblleaves.AdminRemark,tblleaves.AdminRemarkDate from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.id=:lid";
$query = $dbh -> prepare($sql);
$query->bindParam(':lid',$lid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{       
      ?>  

                                      

  <tr>
                                             <td style="font-size:16px;"><b>Leave Type :</b></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                             <td style="font-size:16px;"><b>Leave Date . :</b></td>
                                            <td>From <?php echo htmlentities($result->FromDate);?> to <?php echo htmlentities($result->ToDate);?></td>
                                            </tr>                                    
<tr>
<td style="font-size:16px;"><b>leave Status :</b></td>
<td colspan="5"><?php $stats=$result->Status;
if($stats==1 && strtotime($result->ToDate) >= strtotime($now)){
                                             ?>
                                                 <span style="color: green">Approved</span>
                                                 <?php } if($stats==2 && strtotime($result->ToDate) >= strtotime($now))  { ?>
                                                <span style="color: red">Not Approved</span>
                                                <?php } if($stats==7 && strtotime($result->ToDate) >= strtotime($now)){ ?>
                                                 <span style="color: green">Recommended</span>
                                                 <?php } if($stats==8 && strtotime($result->ToDate) >= strtotime($now))  { ?>
                                                <span style="color: red">Not Recommended</span>
        
                                                 <?php } if($stats==0 && strtotime($result->ToDate) >= strtotime($now))  { ?>

 <span style="color: blue">waiting for approval</span>
 <?php } if($stats==3 && strtotime($result->ToDate) >= strtotime($now))  { ?>
                                                <span style="color: yellow">Forwarded</span>
 <?php } if($stats==5)  { ?>
                                                <span style="color: orangered">Cancelled</span>
                        <?php } if($stats==4)  { ?>
                                                <span style="color: orange">Partially Cancelled</span>
                        <?php } if($stats==5 && strtotime($result->ToDate) < strtotime($now))  { ?>
                         <span style="color: darkred">Not Used</span>
                          <?php } if($stats==4 && strtotime($result->ToDate) < strtotime($now))  { ?>
                         <span style="color: limegreen">Partially Used</span>
                        <?php } if($stats==0 || $stats==1 || $stats==2 || $stats==3 || $stats==7 || $stats==8){
                        if(strtotime($result->ToDate) < strtotime($now))  { ?>
                        <span style="color: darkgreen">Used</span>
                    <?php }} ?>


                                    </tr>
                                         <?php $cnt++;} }?>
                                         <tr>

                                             <td style="font-size:16px;"><b>Leave Description : </b></td>
                                            <td colspan="5"><?php echo htmlentities($result->Description);?></td>
                                                                                         
                                        </tr>
                                        <tr>

                                             <td style="font-size:16px;"><b>Admin Remark: </b></td>
                                            <td colspan="5"><?php echo htmlentities($result->AdminRemark);?></td>
                                                                                         
                                        </tr>
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
        <script src="../css-img/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../css-img/plugins/materialize/js/materialize.min.js"></script>
        <script src="../css-img/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../css-img/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../css-img/js/alpha.min.js"></script>
        <script src="../css-img/js/pages/table-data.js"></script>
        
    </body>
</html>
<?php } ?>