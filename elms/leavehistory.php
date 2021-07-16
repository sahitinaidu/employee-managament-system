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
                        <div class="page-title"><h5>Leave History</h5></div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                               
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="120">Leave Type</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>No of Days</th>
                                            <th width="120">Applied On</th>
                                            <th>Status</th>
                                            <th align="center">Action</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php 
$eid=$_SESSION['empid'];
$sql = "SELECT id,LeaveType,ToDate,FromDate,noofdays,Description,PostingDate,AdminRemarkDate,AdminRemark,Status from tblleaves where empid=:eid order by FromDate desc";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
$now=date("Y/m/d");
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                            <td><?php 
                                            $fromdate=$result->FromDate;
                                            $newfromdate = date("d-m-Y", strtotime($fromdate));
                                            echo $newfromdate;?></td>
                                            <td><?php 
                                            $todate=$result->ToDate;
                                            $newtodate=date("d-m-Y",strtotime($todate));
                                            echo $newtodate;?></td>
                                            <td><?php echo htmlentities($result->noofdays);?></td>
                                            <td><?php 
                                            $postingdate=$result->PostingDate;
                                            $newpostingdate=strtotime($postingdate);
                                            $newpostingdate = date ("d-m-Y h:i:s A", $newpostingdate); 
                                            echo $newpostingdate;?></td>
                                                                                                                                  
                                            <td><?php $stats=$result->Status;
                                                  if($stats==1 && strtotime($result->ToDate) >= strtotime($now)){
                                                  ?>
                                                 <span style="color: green">Approved</span>
                                                 <?php } if($stats==2 && strtotime($result->ToDate) >= strtotime($now) )  { ?>
                                                <span style="color: red">Not Approved</span>
                                                <?php } if($stats==9 || $stats==10)  { 
                                                if( strtotime($result->ToDate) >= strtotime($now)){?>
                                                <span style="color: red">Not Eligible</span>
                                                <?php }} if($stats==3 && strtotime($result->ToDate) >= strtotime($now) )  { ?>
                                                <span style="color: darkred ">Forwarded To HOD</span>
                                                 <?php } if($stats==0 && strtotime($result->ToDate) >= strtotime($now) )  { ?>
                                                <span style="color: darkred">Submitted</span>
                                                  <?php } if($stats==5 && strtotime($result->ToDate) >= strtotime($now))  { ?>
                                                <span style="color: orangered">Cancelled</span>
                                                <?php } if($stats==7 && strtotime($result->ToDate) >= strtotime($now))  { ?>
                                                <span style="color: green">Recommended by HOD</span>
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
                                               <td><a href="cancellationForm.php?days=<?php echo htmlentities($result->noofdays);?> &&
lid=<?php echo htmlentities($result->id);?>">cancel</a></td>
                                        </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              <div class="row">
                     <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                               <span class="card-title">Count of leaves</span>
                 <table id="example" class="display responsive-table ">
                               
                                 
                                    <tbody>

<thead>
                                        <tr>
                                            <th>#</th>
                                             <th >EmpId</th>
                                             
                                            <th >Approved Leaves</th>
                                             
                                             <th>Waiting for Approval Leaves</th>
                                                                        
                                             <th>Not Approved Leaves</th>

                                             <th>Remaining Leaves</th>
                                        </tr>
                                    </thead>
    <?php 
 
  $lid=intval($_GET['leaveid']);
 $Check="SELECT LeaveId from tblforword where EmpId=$eid";
 $check1 = $dbh -> prepare($Check);
 $check1->execute();
 $check2=$check1->fetchAll(PDO::FETCH_OBJ);
 
     if ( $check2 ) {
      
	  $sql="SELECT sum(noofdays) as s from tblleaves where Status=1 and empid=$eid";
$sql=$dbh->prepare($sql);
$sql->execute();
$res=$sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $r){
  $r=8-$r->s;
}
     
     }
else{
$sql="SELECT sum(noofdays) as s from tblleaves where Status=1 and empid=$eid";
$sql=$dbh->prepare($sql);
$sql->execute();
$res=$sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $r){
  $r=8-$r->s;
  $update="UPDATE tblforword set
       Approved = (SELECT COUNT(*)  from tblleaves where Status=1 and empid=$eid),
       Waiting=(SELECT COUNT(*)  from tblleaves where Status=0 and empid=$eid),
       NotApproved=(SELECT COUNT(*)  from tblleaves where Status=2 and empid=$eid) ,
       Remaining=$r
       where tblforword.LeaveId=$lid";

        $update1 = $dbh -> prepare($update);
        $update1->execute();

}
$insert="INSERT INTO tblforword (LeaveId,EmpId,Approved,Waiting,NotApproved,Remaining,EmployeeId) Values ($lid,$eid,(SELECT COUNT(*)  from tblleaves where Status=1 and empid=$eid),(SELECT COUNT(*)  from tblleaves where Status=0 and empid=$eid),(SELECT COUNT(*)  from tblleaves where Status=2 and empid=$eid),'$r',(Select EmpId from tblemployees where id=$eid))";
 $insert1 = $dbh -> prepare($insert);
$insert1->execute();
}
$sql = "SELECT * froM tblforword Where EmpId=$eid and LeaveId=(select MAX(LeaveId) from tblforword where EmpId=$eid)";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;

if($query->rowCount() > 0)
{
	foreach($results as $result)
{ 
?> 
                                  <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->EmployeeId);?></td>
                                            
                                            <td><?php echo htmlentities($result->Approved);?></td>
                                            <td><?php echo htmlentities($result->Waiting);?></td>
                                            <td><?php echo htmlentities($result->NotApproved);?></td>
                                               <td><?php echo htmlentities($result->Remaining);?></td>                                                                                    
                                                                          


                                             </td>
          
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