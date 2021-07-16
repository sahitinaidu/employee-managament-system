<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['dir-login']))
    {   
header('location:main.php');
}
else{

 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <?php 
        $email=$_SESSION['dir-login'];
        if($email=='registrar@nitandhra.ac.in'){
            ?>
        
        <title>REGISTRAR | Emp-Leave History </title>
        <?php }
        else{ ?>
            <title>DIRECTOR | Emp-Leave History </title> 
       <?php } ?>
        <!-- Styles -->
       <link type="text/css" rel="stylesheet" href="../css-img/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../css-img/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../css-img/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

            
        <!-- Theme Styles -->
        <link href="../css-img/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        </style>
    </head>
    <body>
       <?php include('includes/header.php');?>
            
       <?php include('includes/directorsidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title" style="font-size:24px;">Leave History</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                 <span class="card-title">Count of Leaves</span>
            
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
 $eid=intval($_GET['empid']);
 $emplid=$_GET['employeeid'];


 $Check="SELECT EmployeeId from tblcount where EmployeeId='$emplid'";
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
      $update="UPDATE tblcount set
       Approved = (SELECT COUNT(*)  from tblleaves where Status=1 and empid=$eid),
       Waiting=(SELECT COUNT(*)  from tblleaves where Status=0 and empid=$eid),
       NotApproved=(SELECT COUNT(*)  from tblleaves where Status=2 and empid=$eid) ,
       Remaining=$r
       where tblcount.EmployeeId='$emplid'";

        $update1 = $dbh -> prepare($update);
        $update1->execute();

     }
else{
    $sql="SELECT sum(noofdays) as s from tblleaves where Status=1 and empid=$eid";
$sql=$dbh->prepare($sql);
$sql->execute();
$res=$sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $r){
  $r=8-$r->s;
}
$insert="INSERT INTO tblcount (Approved,Waiting,NotApproved,Remaining,EmployeeId) Values ((SELECT COUNT(*)  from tblleaves where Status=1 and empid=$eid),(SELECT COUNT(*)  from tblleaves where Status=0 and empid=$eid),(SELECT COUNT(*)  from tblleaves where Status=2 and empid=$eid),$r,(Select EmpId from tblemployees where id=$eid))";
 $insert1 = $dbh -> prepare($insert);
$insert1->execute();
}
$sql = "SELECT * from tblcount Where EmployeeId= '$emplid' ";
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
                                <span class="card-title">Leave History</span>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                               
                                 
                                    <tbody>

<thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="120">Leave Type</th>
                                            <th>From</th>
                                            <th>To</th>
                                              <th width="120">No.of Days leave applied fo</th>
                                             <th width="120">Posting Date</th>
                                                                        
                                             <th>Status</th>
                                        </tr>
                                    </thead>
									<?php 
$eid=intval($_GET['empid']);
$sql = "SELECT  DISTINCT LeaveType,ToDate,FromDate,Description,PostingDate,AdminRemarkDate,AdminRemark,Status,noofdays from tblleaves  where tblleaves.empid=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
$now=date("Y/m/d");
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>  
                                  <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                            <td><?php echo date('j M, Y', strtotime($result->FromDate));?></td>
                                            <td><?php echo date('j M, Y', strtotime($result->ToDate));?></td>
                                           <td><?php echo htmlentities($result->noofdays);?></td>
                                            <td><?php echo date('j M, Y h:i A', strtotime($result->PostingDate));?></td>
											                                                                                      
                                                                                 <td><?php $stats=$result->Status;
 if($stats==1 && strtotime($result->ToDate) >= strtotime($now)){
                                                  ?>
                                                 <span style="color: green">Approved</span>
                                                 <?php } if($stats==2 )  { ?>
                                                <span style="color: red">Not Approved</span>
												<?php } if($stats==9 || $stats==10)  { ?>
                                                <span style="color: red">Not Eligible</span>
												<?php } if($stats==3 )  { ?>
                                                <span style="color: darkred ">Forwarded To HOD </span>
                                                 <?php } if($stats==0 )  { ?>
                                                <span style="color: darkred">Submitted by Employee</span>
                                                  <?php } if($stats==5 )  { ?>
                                                <span style="color: orangered">Cancelled</span>
												<?php } if($stats==7 )  { ?>
                                                <span style="color: green">Recommended by HOD</span>
												<?php } if($stats==8 )  { ?>
                                                <span style="color: red">Not Recommended</span>
												<?php } if($stats==4 && strtotime($result->ToDate) >= strtotime($now))  { ?>
                                                <span style="color: orange">Partially Cancelled</span>
												
												  <?php } if($stats==4 && strtotime($result->ToDate) < strtotime($now))  { ?>
												 <span style="color: limegreen">Partially Used</span>
												<?php } if($stats==1){
												if(strtotime($result->ToDate) < strtotime($now))  { ?>
												<span style="color: darkgreen">Used</span>
												<?php } }?>

                                             </td>
          
                                        </tr>
                                                                          
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                                <?php
                                $eid=intval($_GET['empid']);
$sql = "SELECT  DISTINCT EmpId from tblemployees  where id=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$now=date("Y/m/d");
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>  

                                <br><br>
                                <a href="dirdetails.php? 
                                          empid=<?php echo htmlentities($result->EmpId);?>" class="modal-trigger waves-effect waves-light btn"  >Back</a></td>
                                      <?php } }?>
                                          
                            </div>
                        </div>
                    </div>
                </div>
            </main>
         
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