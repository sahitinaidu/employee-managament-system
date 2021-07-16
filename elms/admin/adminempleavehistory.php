<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['alogin']))
    {  
header('location:../main.php');
}
else{

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
                        <div class="page-title" style="font-size:24px;">count of leaves</div>
                    </div>
                  <?php $msg="Successfully forwarded to hod";?>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Count of Leaves</span>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                               
                                 
                                    <tbody>

<thead>
                                        <tr>
                                            <th>#</th>
                                             <th >EmpId</th>
                                             <th>LeaveId</th>
                                            <th >Approved Leaves</th>
                                             
                                             <th>Waiting for Approval Leaves</th>
                                                                        
                                             <th>Not Approved Leaves</th>

                                             <th>Remaining Leaves</th>
                                        </tr>
                                    </thead>
  <?php 
 $eid=intval($_GET['empid']);
 $lid=intval($_GET['leaveid']);
 $Check="SELECT LeaveId from tblforword where LeaveId='$lid'";
 $check1 = $dbh -> prepare($Check);
 $check1->execute();
 $check2=$check1->fetchAll(PDO::FETCH_OBJ);
 
     if ( $check2 ) {
      $update="UPDATE tblforword set
       Approved = (SELECT COUNT(*)  from tblleaves where Status=1 and empid=$eid),
       Waiting=(SELECT COUNT(*)  from tblleaves where Status=0 and empid=$eid),
       NotApproved=(SELECT COUNT(*)  from tblleaves where Status=2 and empid=$eid) ,
       Remaining=8-(SELECT COUNT(*)  from tblleaves where Status=1 and empid=$eid)
       where tblforword.LeaveId=$lid";

        $update1 = $dbh -> prepare($update);
        $update1->execute();

     }
else{
$insert="INSERT INTO tblforword (LeaveId,EmpId,Approved,Waiting,NotApproved,Remaining) Values ($lid,$eid,(SELECT COUNT(*)  from tblleaves where Status=1 and empid=$eid),(SELECT COUNT(*)  from tblleaves where Status=0 and empid=$eid),(SELECT COUNT(*)  from tblleaves where Status=2 and empid=$eid),(8-(SELECT COUNT(*)  from tblleaves where Status=1 and empid=$eid)))";
 $insert1 = $dbh -> prepare($insert);
$insert1->execute();
}
$sql = "SELECT * froM tblforword Where LeaveId=$lid ";
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
                                            <td><?php echo htmlentities($result->EmpId);?></td>
                                            <td><?php echo htmlentities($result->LeaveId);?></td>
                                            <td><?php echo htmlentities($result->Approved);?></td>
                                            <td><?php echo htmlentities($result->Waiting);?></td>
                                            <td><?php echo htmlentities($result->NotApproved);?></td>
                         <td><?php echo htmlentities($result->Remaining);?></td>                                                                                    
                                                        
                                        </tr>
                                                                          
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
         
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="../../css-img/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../../css-img/plugins/materialize/js/materialize.min.js"></script>
        <script src="../../css-img/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../../css-img/plugins/jquery-blockui/jquery.blockui.js"></script>
      
        <script src="../../css-img/js/alpha.min.js"></script>
        <script src="../../css-img/js/pages/table-data.js"></script>
         <script src="../../css-img/js/pages/ui-modals.js"></script>
        <script src="../../css-img/plugins/google-code-prettify/prettify.js"></script>
        
    </body>
</html>
<?php } ?>