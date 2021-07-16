<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['cancel'])){
    $eid=$_SESSION['empid'];
	$startdate=$_GET['from'];
	$enddate=$_GET['to'];
	$fromdate=$_POST['fromdate'];
    $todate=$_POST['todate'];
	$day2=$_GET['days'];
	$id=$_GET['lid'];
    $cancelleddays=$_POST['canceldays'];
    $remainingdays=$day2-$cancelleddays;
	if($remainingdays==0){
		$status=5;
	}
	else{
		$status=4;
	}
$sql = "update tblleaves set status=:status,noofdays=:remainingdays where id=:id and empid=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> bindParam(':remainingdays',$remainingdays, PDO::PARAM_STR);
$query -> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
if($query -> execute()){
	$msg="cancelled successfully";
}
else{
	$msg="failed";
}
/*if(strtotime($fromdate)>strtotime($startdate) && strtotime($enddate)>strtotime($todate)){
	$end=$fromdate;
	$from=$todate;
	$sql = "select * from tblleaves where empid=:eid";
	$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$leaveType=$results->LeaveType;
$desc=$results->Description;
$dept=$results->Department;
$pdate=$results->PostingDate;
$req=$results->WeatherStationleaveRequired;
$from=$results->from1;
$to=$results->to1;
$arrangement=$results->arrangement;
$address=$results->addressleave;
$deptid=$results->deptid;

$sql1="insert into tblleaves(LeaveType,ToDate,noofdays,FromDate,Description,Department,PostingDate,
WeatherStationleaveRequired,from1,to1,arrangement,addressleave,Status,empid,deptid) values(:leaveType,:enddate,:no,:todate,:desc,:dept,:pdate,:req,:from,:to,:arrangement,:address,:status,:deptid,:eid)";
$query = $dbh->prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
}*/
}
   ?>
    

<!DOCTYPE html>
<html lang="en">
    <head>
       
        <!-- Title -->
		
        <title>Cancellation Form</title>
		
           
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../css-img/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../css-img/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
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
                        <div class="page-title">Cancellation Form</div>
                    </div>
                    <div class="col s12 m7 15">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" action="" method="post"  action="" name="updatemp">
                                    <div>
									<div class="col s12">
                                      <div class="row">
                                        <h4>CANCELLATION FORM</h4>
										</div>
										</div>
                                           <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m12">
                                                        <div class="row">
<?php
$eid=$_SESSION['emplogin'];
$sql = "SELECT * from  tblemployees where EmailId=:eid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':eid',$eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>
 
 <div class="input-field col  s12">
<select id="canc" name="canceldays" autocomplete="off">
<option>Select no. of. days</option>

</select>
</div>
     
       
<div class="input-field col m6 s10">
<label for="fromdate">From  Date</label>
<input style="width: 80%;
    border:0px solid transparent;
    border-radius: 0;
    border-bottom: 1px solid #aaa;
    padding: 1em .5em .5em;
    padding-left: 2em;
    outline:none;
    margin:0.5em auto;
    transition: all .5s ease;"  placeholder="" id="mask1" name="fromdate" class="masked" type="date" data-inputmask="'alias': 'date'" required>

</div>

<div class="input-field col m6 s10">
<label for="todate">To Date</label>
<input style="width: 85%;
    border:0px solid transparent;
    border-radius: 0;
    border-bottom: 1px solid #aaa;
    padding: 1em .5em .5em;
    padding-left: 2em;
    outline:none;
    margin:0.5em auto;
    transition: all .5s ease;"  placeholder="" id="mask1" name="todate" class="masked" type="date" data-inputmask="'alias': 'date'" required>
</div>
               

<div class="input-field col s12">
<label for="remarks">Remarks</label>
<textarea id="remarks" name="remarks" class="materialize-textarea" length="500" ></textarea>
 </div>
<div class="input-field col s10">
<button type="submit" name="cancel" onclick="return valid();" id="submit"  class="waves-effect waves-light btn indigo m-b-xs">Submit</button>                                            
</div>
</div>
</div>
         
                                           
<div class="col m10">
<div class="row">
    <script>
        
var days=<?php echo $_GET['days'] ?>;

for (var i=1;i<=days;i++){
    document.getElementById('canc').innerHTML+="<option>"+i+"</option>";
}
    </script>
                                                   
                               
<?php }} ?>

</div>


                                                         

                                                     
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                     
                                   
                                     
                                    </div>
                                </form>
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
        <script src="../css-img/js/pages/form_elements.js"></script>
       
    </body>
</html>
