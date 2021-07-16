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
        <title>ADMIN | Dashboard</title>
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../../css-img/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
        <link href="../../css-img/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
        <link href="../../css-img/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">

        	
        <!-- Theme Styles -->
        <link href="../../css-img/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css-img/css/custom.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
           <?php include('includes/header.php');?>
		   
       <?php include('includes/sidebar.php');?>

            <main class="mn-inner">
                <div class="middle-content">
                   
                 <div class="page-title">Officials</div>
                    <div class="row no-m-t no-m-b">
                        <div class="col s12 m12 l12">
                            <div class="card invoices-card">
                                <div class="card-content">
                                
                             <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="200">Employee ID</th>
											<th width="200">Employee Name</th>
                                            <th width="120">Email ID</th>
                                             <th width="180">Position</th>              
                                            <th align="center">Action</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php $sql = "SELECT tblhead.EmpId,tblhead.EmailId,tblhead.Position from tblhead ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{       $eid=$result->EmpId;
		$s="SELECT FirstName,LastName,EmailId from tblemployees where EmpId=:eid";
		$quer = $dbh->prepare($s);
		$quer-> bindParam(':eid', $eid, PDO::PARAM_STR);
		$quer->execute();
		$res=$quer->fetchObject();
		if($quer->rowCount() > 0)
		{
			$fname=$res->FirstName;
			$lname=$res->LastName;
			$personmail=$res->EmailId;
      ?>  

                                        <tr>
                                            <td> <b><?php echo htmlentities($cnt);?></b></td>
                                              <td><?php echo htmlentities($result->EmpId);?></a></td>
											  <td><?php echo htmlentities($fname.' '.$lname); ?></td>
                                            <td><?php echo htmlentities($result->EmailId);?></td>
                                            <td><?php echo htmlentities($result->Position);?></td>
                                           <td><a href="updateofficial.php?mail=<?php echo htmlentities($result->EmailId);?>&&personmail=<?php echo htmlentities($res->EmailId);?>" class="waves-effect waves-light btn blue m-b-xs"  > Update </a></td>
                                    </tr>
									<?php $cnt++; } } }?>
                                    </tbody>
                                </table>
												
                                </div>
                            </div>
							<div>
                   </div>
                        </div>
                    </div>
                </div>

            </main> 
				

        
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
        
    </body>
</html>
<?php } ?>