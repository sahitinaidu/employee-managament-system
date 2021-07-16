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
        <title>DIRECTOR | Dashboard</title>
        
        <!-- Styles -->
       
    </head>
    <body>
           <?php include('includes/header.php');?>
		   
       <?php include('includes/directorsidebar.php');?>

            <main class="mn-inner">
                <div class="middle-content">
                   
                  <link type="text/css" rel="stylesheet" href="../css-img/plugins/materialize/css/materialize.min.css"/>
   
        <link href="../css-img/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../css-img/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

            
        <!-- Theme Styles -->
        <link href="../css-img/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css-img/css/custom.css" rel="stylesheet" type="text/css"/>

                    <div class="row no-m-t no-m-b">
                        <div class="col s12 m12 l12">
                            <div class="card invoices-card">
                                <div class="card-content">
                                 
                                    <span class="card-title"><h5>Latest Leave Applications</h5></span>
                             <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="200">Employee ID</th>
                                            <th width="120">Leave Type</th>

                                             <th width="180">Applied on</th>                 
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                 
                               <tbody>
<?php
$email=$_SESSION['dir-login'];
$Check="SELECT DISTINCT tblforword.LeaveId from tblforword join tblleaves on tblforword.LeaveId= tblleaves.id";
$check1 = $dbh -> prepare($Check);

$check1->execute();
$check2=$check1->fetchAll(PDO::FETCH_OBJ);

    if ( $check2 ) {
 $sql = "SELECT DISTINCT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.PostingDate,tblleaves.Status from tblleaves join  tblhead join tblemployees join tblforword on tblemployees.reportingto=tblhead.EmailId and tblleaves.empid=tblemployees.id  where tblhead.EmailId = '$email'and tblleaves.id=tblforword.LeaveId  and  tblleaves.Status='3' order by lid desc";
$query = $dbh -> prepare($sql);

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
                                            <td> <b><?php echo htmlentities($cnt);?></b></td>
                                              <td><a href="dir-emp-leave-details.php?leaveid=<?php echo htmlentities($result->lid);?>"><?php echo htmlentities($result->EmpId);?></a></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                            <td><?php echo date('j M, Y h:i A', strtotime($result->FromDate));?></td>
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
                                         <?php $cnt++;}} }?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
            </main>
          
        </div>
         <script src="../css-img/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../css-img/plugins/materialize/js/materialize.min.js"></script>
        <script src="../css-img/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../css-img/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../css-img/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../css-img/js/alpha.min.js"></script>
        <script src="../css-img/js/pages/table-data.js"></script>
        
        <!-- Javascripts -->
        
       
        
        <script src="../css-img/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../css-img/plugins/counter-up-master/jquery.counterup.min.js"></script>
        <script src="../css-img/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="../css-img/plugins/chart.js/chart.min.js"></script>
        <script src="../css-img/plugins/flot/jquery.flot.min.js"></script>
        <script src="../css-img/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="../css-img/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="../css-img/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../css-img/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../css-img/plugins/curvedlines/curvedLines.js"></script>
        <script src="../css-img/plugins/peity/jquery.peity.min.js"></script>
        
        <script src="../css-img/js/pages/dashboard.js"></script>
        
        <!-- Javascripts -->
               
    </body>
</html>
<?php } ?>