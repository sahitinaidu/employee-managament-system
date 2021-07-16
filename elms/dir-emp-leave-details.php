<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['dir-login'])==0)
    {   
header('location:index.php');
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
        <?php 
        $email=$_SESSION['dir-login'];
        if($email=='registrar@nitandhra.ac.in'){
            ?>
        <title>REGISTRAR | Emp-Leave Details </title>
        <?php }
        else{ ?>
            <title>DIRECTOR | Emp-Leave Details </title> 
       <?php } ?>
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
            
       <?php include('includes/directorsidebar.php');?>
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
$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblemployees.Gender,tblemployees.Phonenumber,tblemployees.EmailId,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.arrangement,tblleaves.adressleave,tblleaves.FromDate,tblleaves.Description,tblleaves.PostingDate,tblleaves.Status,tblleaves.AdminRemark,tblleaves.AdminRemarkDate,tblforword.Approved,tblforword.Waiting,tblforword.NotApproved,tblforword.Remaining from tblleaves join tblemployees join tblforword on tblleaves.empid=tblemployees.id and tblforword.LeaveId=tblleaves.id  where tblleaves.id=:lid";
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
                                            <td style="font-size:16px;"> <b>Name :</b></td>
                                              <td><a href="editemployee.php?empid=<?php echo htmlentities($result->id);?>" target="_blank">
                                                <?php echo htmlentities($result->FirstName." ".$result->LastName);?></a></td>
												<td></td>
                                              <td style="font-size:16px;"><b>Id :</b></td>
                                              <td><?php echo htmlentities($result->EmpId);?></td>
                                             
                                          </tr>

                                          <tr>
                                             <td style="font-size:16px;"><b>Email id :</b></td>
                                            <td><?php echo htmlentities($result->EmailId);?></td>
											<td></td>
                                             <td style="font-size:16px;"><b>Contact No. :</b></td>
                                            <td><?php echo htmlentities($result->Phonenumber);?></td>
                                            <td>&nbsp;</td>
                                             <td>&nbsp;</td>
                                        </tr>

  <tr>
                                             <td style="font-size:16px;"><b>Leave Type :</b></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
											<td></td>
                                             <td style="font-size:16px;"><b>Leave Date . :</b></td>
                                            <td>From <?php echo date('j M, Y', strtotime($result->FromDate));?> to <?php echo date('j M, Y', strtotime($result->ToDate));?></td>
                                            
											</tr>
										<tr>
										<td style="font-size:16px;"><b>Leave Description : </b></td>
                                            <td colspan="5"><?php echo htmlentities($result->Description);?></td>
										</tr>
                                           
                                        <tr>
                                          <td style="font-size:16px;"><b>Approved leaves :</b></td>
                                            <td><?php echo htmlentities($result->Approved);?></td>
											<td></td>
                                             <td style="font-size:16px;"><b>Waiting for Approval</b></td>
                                            <td><?php echo htmlentities($result->Waiting);?> </td>
                                            </tr>

                                        <tr>
                                          <td style="font-size:16px;"><b>Not Approved leaves :</b></td>
                                            <td><?php echo htmlentities($result->NotApproved);?></td>
											<td></td>
                                             <td style="font-size:16px;"><b>Remaining Leaves</b></td>
                                            <td><?php echo htmlentities($result->Remaining);?> </td>
                                            </tr>
										<tr>
										<td style="font-size:16px;"><b>Alternate Arrangement :</b></td>
                                            <td><?php echo htmlentities($result->arrangement);?></td>
										<td></td>
											<td style="font-size:16px;"><b>Adress during Leave :</b></td>
                                            <td><?php echo htmlentities($result->adressleave);?></td>  
                                        </tr>
 
<tr>
<td style="font-size:16px;"><b>leave Status :</b></td>
<td colspan="5"><?php $stats=$result->Status;
 if($stats==1 && strtotime($result->ToDate) >= strtotime($now)){
                                                  ?>
                                                 <span style="color: green">Approved</span>
                                                 <?php } if($stats==2 && strtotime($result->ToDate) >= strtotime($now) )  { ?>
                                                <span style="color: red">Not Approved</span>
												<?php } if($stats==9 || $stats==10)  { 
												if( strtotime($result->ToDate) >= strtotime($now)){?>
                                                <span style="color: red">Not Eligible</span>
												<?php }} if($stats==3 && strtotime($result->ToDate) >= strtotime($now) )  { ?>
                                                <span style="color: darkred ">Forwarded</span>
                                                 <?php } if($stats==0 && strtotime($result->ToDate) >= strtotime($now) )  { ?>
                                                <span style="color: darkred">Submitted by Employee</span>
                                                  <?php } if($stats==5 && strtotime($result->ToDate) >= strtotime($now))  { ?>
                                                <span style="color: orangered">Cancelled</span>
												<?php } if($stats==7 && strtotime($result->ToDate) >= strtotime($now))  { ?>
                                                <span style="color: green">Recommended</span>
												<?php } if($stats==8 && strtotime($result->ToDate) >= strtotime($now))  { ?>
                                                <span style="color: red">Not Recommended</span>
												<?php } if($stats==5 || $stats==9 || $stats==10 || $stats==2 || $stats==3 || $stats==0 || $stats==7 || $stats==8){
													if( strtotime($result->ToDate) < strtotime($now))  { ?>
                                                <span style="color: orange">Not Used</span>
												
												  
													<?php }} if($stats==1){
												if(strtotime($result->ToDate) < strtotime($now))  { ?>
												<span style="color: darkgreen">Used</span>
												<?php } }?>
</td>
</tr>


<tr>
 <td>
  <a class="modal-trigger waves-effect waves-light btn" href="#modal1">Take Action</a>
<form name="adminaction" method="post">
<div id="modal1" class="modal modal-fixed-footer" style="width:30% ; height: 40%">
    <div class="modal-content" >
        <h4>Leave take action</h4>
          <select class="browser-default" name="status" required="">
                                            <option value="">Choose your option</option>
                                            <option value="1">Approved</option>
                                            <option value="2">Not Approved</option>
                                        </select>
                                        <p><textarea id="textarea1" name="description" class="materialize-textarea" name="description" placeholder="Description" length="300" maxlength="300" ></textarea></p>
    </div>
    <div class="modal-footer" style="width:90%">
       <input type="submit" class="waves-effect waves-light btn blue m-b-xs" name="update" value="Submit">
    </div>
</div>   
 </td>
 
   </form> 
<td><a href="dirempleavehistory.php?empid=<?php echo htmlentities($result->id);?> && 
     leaveid=<?php echo htmlentities($result->lid);?>" class="waves-effect waves-light btn blue m-b-xs" style="margin-bottom:0" >View Leave History </a></td>
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
       <script src="../css-img/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../css-img/plugins/materialize/js/materialize.min.js"></script>
        <script src="../css-img/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../css-img/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../css-img/js/alpha.min.js"></script>
        <script src="../css-img/js/pages/table-data.js"></script>
    </body>
</html>
<?php } ?>