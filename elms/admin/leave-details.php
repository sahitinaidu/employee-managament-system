<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['alogin']))
    {  
header('location:../main.php');
}
else{



// code for action taken on leave
if(isset($_POST['update']))
{ 
$did=intval($_GET['leaveid']);
$description=$_POST['description'];
$arrangement=$_POST['arrangement'];
$adressleave=$_POST['adressleave'];
$status=$_POST['status'];   
date_default_timezone_set('Asia/Kolkata');
$admremarkdate=date('d-m-Y G:i:s ', strtotime("now"));
$sql="UPDATE tblleaves set AdminRemark=:description,Status=:status,arrangement=:arrangement,adressleave=:adressleave,AdminRemarkDate=:admremarkdate where id=:did";
$query = $dbh->prepare($sql);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':arrangement',$arrangement,PDO::PARAM_STR);
$query->bindParam(':adressleave',$adressleave,PDO::PARAM_STR);
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
        <title>ADMIN | Leave Details </title>
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../../css-img/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../../css-img/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../../css-img/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

                <link href="../../css-img/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css"/>  
        <!-- Theme Styles -->
        <link href="../../css-img/css/alpha.min.css" rel="stylesheet" type="text/css"/>

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
                        <div class="page-title" style="font-size:24px;">Leave Details</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                                    <tbody>
<?php 
$lid=intval($_GET['leaveid']);
$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblemployees.Gender,tblemployees.Phonenumber,tblemployees.EmailId,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.FromDate,tblleaves.Description,tblleaves.arrangement,tblleaves.adressleave,tblleaves.PostingDate,tblleaves.Status,tblleaves.AdminRemark,tblleaves.AdminRemarkDate from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.id=:lid";
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
                                            <td style="font-size:16px;"> <b>Name :</b>
                                              <a href="editemployee.php?empid=<?php echo htmlentities($result->id);?>" target="_blank">
                                                <?php echo htmlentities($result->FirstName." ".$result->LastName);?></a></td>
                                              <td style="font-size:16px;"><b>Id :</b>
                                              <?php echo htmlentities($result->EmpId);?></td>
                                              <td style="font-size:16px;"><b>Email id :</b>
                                            <?php echo htmlentities($result->EmailId);?></td>
                                          </tr>

                                          <tr>
                                             
                                             <td style="font-size:16px;"><b>Contact No. :</b>
                                            <?php echo htmlentities($result->Phonenumber);?></td>
                                            
                                             <td style="font-size:16px;"><b>Leave Type :</b>
                                            <?php echo htmlentities($result->LeaveType);?></td>
                                             <td style="font-size:16px;"><b>Leave Date . :</b>
                                            From <?php $fromdate=$result->FromDate;
                                            $newfromdate = date("d-m-Y", strtotime($fromdate));
                                            echo $newfromdate;?> to <?php $todate=$result->ToDate;
                                            $newtodate=date("d-m-Y",strtotime($todate));
                                            echo $newtodate;?></td>
											<td>&nbsp;</td>
                                             <td>&nbsp;</td>
											</tr>
											<tr>
                                            <td style="font-size:16px;"><b>Leave Description : </b>
                                            <?php echo htmlentities($result->Description);?></td>
											 
                                             <td style="font-size:16px;"><b>Alternate Arrangement :</b>
                                            <?php echo htmlentities($result->arrangement);?></td>
											
											<td style="font-size:16px;"><b>Adress during Leave :</b>
                                            <?php echo htmlentities($result->adressleave);?></td>
											</tr>
											<tr>
											<td style="font-size:16px;"><b>leave Status :</b>
<?php $stats=$result->Status;
if($stats==1){
?>
<span style="color: green">Approved</span>
 <?php } if($stats==2)  { ?>
<span style="color: red">Not Approved</span>
<?php } if($stats==0)  { ?>
 <span style="color: darkred">Submitted by Employee</span>
 <?php } ?>
</td>

<td><a href="leavehistory.php?empid=<?php echo htmlentities($result->id);?> && 
                                          leaveid=<?php echo htmlentities($result->lid);?>" class="waves-effect waves-light btn blue m-b-xs"  >View Leave History </a></td>
                                          
</tr>
<?php 
if($stats==0)
{
?>
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
        <script src="../../css-img/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../../css-img/plugins/materialize/js/materialize.min.js"></script>
        <script src="../../css-img/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../../css-img/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../../css-img/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../../css-img/js/alpha.min.js"></script>
        <script src="../../css-img/js/pages/table-data.js"></script>
         <script src="../../css-img/js/pages/ui-modals.js"></script>
        <script src="../../css-img/plugins/google-code-prettify/prettify.js"></script>
        
    </body>
</html>
<?php } ?>