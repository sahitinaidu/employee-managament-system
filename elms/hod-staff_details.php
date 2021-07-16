<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['hod-login']))
    {   
header('location:main.php');
}
else{



// code for action taken on leave
if(isset($_POST['update']))
{ 
$did=intval($_GET['leaveid']);
$description=$_POST['description'];
$status=$_POST['status'];   
date_default_timezone_set('Asia/Kolkata');
$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
$sql="UPDATE tblleaves set AdminRemark=:description,Status=:status,AdminRemarkDate=:admremarkdate where id=:did";
$query = $dbh->prepare($sql);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':admremarkdate',$admremarkdate,PDO::PARAM_STR);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();
$msg="Leave updated Successfully";
}



 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>HOD | Emp-Information </title>
        
         <link type="text/css" rel="stylesheet" href="../css-img/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
            
       <?php include('includes/hodsidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title" style="font-size:24px;">Information</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                               
                                 
                                    <tbody>
<?php 
$empid1=($_GET['empid']);
$sql = "SELECT  tblemployees.EmpId ,tblemployees.id,tblemployees.FirstName,tblemployees.LastName,tblemployees.Gender,tblemployees.EmailId,tblemployees.Phonenumber,tblemployees.category,tblemployees.Dob,tblemployees.designation,tblemployees.FacType from tblemployees  where tblemployees.EmpId=:empid1 limit 1";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid1',$empid1,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>  

                                        <tr>
                                            <td style="font-size:16px;"> <b>Name :				</b>
                                             <a href="editemployee.php?empid=<?php echo htmlentities($result->id);?>" target="_blank">
                                              <?php echo htmlentities($result->FirstName." ".$result->LastName);?></a></td>
                                              <td style="font-size:16px;"><b>Id :				</b><?php echo htmlentities($result->EmpId);?></td>
                                              <td style="font-size:16px;"><b>Gender :				</b><?php echo htmlentities($result->Gender);?></td>
                                          </tr>

                                          <tr>
                                             <td style="font-size:16px;"><b>Email id :				</b><?php echo htmlentities($result->EmailId);?></td>
                                             <td style="font-size:16px;"><b>Contact No. :				</b><?php echo htmlentities($result->Phonenumber);?></td>
                                             <td style="font-size:16px;"><b>category:				</b><?php echo htmlentities($result->category);?></td>
                                           
                                        </tr>
                                             
  <tr>
                                             <td style="font-size:16px;"><b>Designation:				</b><?php echo htmlentities($result->designation);?></td>
                                             <td style="font-size:16px;"><b>Employement Type: 				</b><?php echo htmlentities($result-> FacType );?> </td>                                           
                                             <td style="font-size:16px;"><b>Date of Birth:				</b><?php echo htmlentities($result->Dob);?></td>
                                            </tr>
<tr>

                                          <td><a href="head-staff_leavehistory.php?empid=<?php echo htmlentities($result->id);?> && 
                                          employeeid=<?php echo htmlentities($result->EmpId);?>
                                  " class="waves-effect waves-light btn blue m-b-xs"  >View Leave History </a></td>
                                                 
                                        </tr>
 </td>
</tr>
<?php } ?>
   </form>                                     </tr>
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
       <script src="../css-img/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../css-img/plugins/materialize/js/materialize.min.js"></script>
        <script src="../css-img/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../css-img/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../css-img/js/alpha.min.js"></script>
        <script src="../css-img/js/pages/table-data.js"></script>
    </body>
</html>
</html>