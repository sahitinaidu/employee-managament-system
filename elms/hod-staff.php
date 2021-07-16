<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['hod-login']))
    {   
header('location:main.php');
}
else{
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>
		
        <?php 
		echo strtoupper(substr($_SESSION['hod-login'],0,STRPOS($_SESSION['hod-login'],"_"))) ;
        
        ?> | Staff
       </title>
    </head>
    <body>
           <?php include('includes/header.php');?>
		   
       <?php include('includes/hodsidebar.php');?>

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
                                 
                                    <span class="card-title"><h5>Staff Information</h5></span>
                             <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="200">Employee ID</th>
                                            <th width="120"> Name</th>
                                              <th width="180">EmailId</th> 
                                               <th width="180">MobileNo</th> 
											    
											   </tr>

                                    </thead>
                                 
                               <tbody>
<?php
$email=$_SESSION['hod-login'];
if($email==='registrar@nitandhra.ac.in'){
  $reportingto='registrar@nitandhra.ac.in';
}else{
    $dept_name= substr($email,strpos($email,"_")+1,strpos($email,"@nitandhra.ac.in")-strpos($email,"_")-1);
     $Department=$dept_name;
    $sql_1 = "SELECT DepartmentName from tbldepartments where DepartmentShortName='".$dept_name."';"; 
$query_1 = $dbh -> prepare($sql_1);
$query_1->execute();
$results_1=$query_1->fetchAll(PDO::FETCH_OBJ);
$cnt_1=1;
if($query_1->rowCount() > 0)
{
foreach($results_1 as $result)
{   $Department=$result->DepartmentName;
    } }
    $sql_2 = "SELECT schoolName from tbldepartments where SchoolShortName='".$dept_name."';";
$query_2 = $dbh -> prepare($sql_2);
$query_1->execute();
$results_2=$query_2->fetchAll(PDO::FETCH_OBJ);
$cnt_2=1;
if($query_2->rowCount() > 0)
{
foreach($results_2 as $result)
{   $Department=$result->schoolName;
    } }
}
$sql = "SELECT DISTINCT tblemployees.EmpId, tblemployees.FirstName,tblemployees.LastName,tblemployees.EmailId,tblemployees.Phonenumber from   tblemployees join tblhead   where tblhead.EmailId = '$email' and tblemployees.Department='$Department' or tblemployees.reportingto='$reportingto' ";

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
                                            <td> <b><?php echo htmlentities($cnt);?></b></td>
                                              <td><a href="hod-staff_details.php?empid=<?php echo htmlentities($result->EmpId);?>"><?php echo htmlentities($result->EmpId);?></a></td>
                                           <td><?php echo htmlentities($result->FirstName." ".$result->LastName);?></td>
                                             <td><?php echo htmlentities($result->EmailId);?></td>
                                              <td><?php echo htmlentities($result->Phonenumber);?></td>
          
          
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
        
               
    </body>
</html>
