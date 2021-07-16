<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['apply']))
{

$empid=$_SESSION['empid'];
$employeeid=$_POST['employeeid'];
$leavetype=$_POST['leavetype'];
$fromdate=$_POST['fromdate'];  
$todate=$_POST['todate'];
$description=$_POST['description'];  
$arrangement=$_POST['arrangement'];  
$fromdate1 = strtotime($fromdate);
$todate1 = strtotime($todate);
 $diff = $todate1 - $fromdate1;

 
$noofdays= abs(round($diff / 86400))+1;
$adressleave=$_POST['adressleave'];
$yesorno=$_POST['yes_no'];
$from1=$_POST['from'];
$to=$_POST['to'];

$status=0;
$isread=0;
$fromdate1=strtotime($fromdate);
if($fromdate > $todate){
                $error=" ToDate should be greater than FromDate ";
           }

else if($fromdate1 <strtotime("now")){
    $error="from date should be greater than todays date";
}else{
     $sql ="SELECT Department FROM tblemployees WHERE id=:empid";
    $query= $dbh -> prepare($sql);
     $query-> bindParam(':empid', $empid, PDO::PARAM_STR);
     
     $query-> execute();
     $results=$query->fetchAll(PDO::FETCH_OBJ);
     foreach($results as $result){$department=$result->Department;}
$sql="INSERT INTO tblleaves(Department,LeaveType,ToDate,noofdays,Description,FromDate,WeatherStationleaveRequried,from1,to1,arrangement,adressleave,Status,IsRead,empid) VALUES(:department,:leavetype,:todate,:noofdays,:description,:fromdate,:yesorno,:from1,:to,:arrangement,:adressleave,:status,:isread,:empid)";
$query = $dbh->prepare($sql);
$query->bindParam(':department',$department,PDO::PARAM_STR);
$query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':noofdays',$noofdays,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':arrangement',$arrangement,PDO::PARAM_STR);
$query->bindParam(':adressleave',$adressleave,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':yesorno',$yesorno,PDO::PARAM_STR);
$query->bindParam(':from1',$from1,PDO::PARAM_STR);
$query->bindParam(':to',$to,PDO::PARAM_STR);


$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
   echo "<script type='text/javascript'>alert('Leave Applied successfully!')</script>";
}
else 
{
    echo "<script type='text/javascript'>alert('failed!')</script>";
}

}}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>EMPLOYEE | Apply Leave</title>
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../css-img/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../css-img/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="../css-img/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css-img/css/custom.css" rel="stylesheet" type="text/css"/>
  <style>
       .col1{
            width: 5%;
            float: left;
            display:inline;
           text-align: center;
           justify-content: center;
           vertical-align: middle;
           margin-left: 0.5%;
           margin-top:0.5%;
        }
        .col{
            width: 20%;
            float: left;
            display:inline;
            
        }
       
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
[type="radio"]:not(:checked), [type="radio"]:checked {
    position: absolute;
    left: auto !important;
    opacity: 1 !important;
}
        </style>
 


    </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
   <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Apply for Leave</div>
                    </div>
                    <div class="col s12 m12 l8">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addemp">
                                    <div>
									<div class="col m12">
                                      <div class="row">
                                        <h3>Apply for Leave</h3>
										</div>
										</div>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m12">
                                                        <div class="row">
     <?php if($error){?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>



 <div class="input-field col  s12">
<select  name="leavetype" autocomplete="off">
<option value="">Select leave type...</option>
<?php $sql = "SELECT  LeaveType from tblleavetype";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                            
<option value="<?php echo htmlentities($result->LeaveType);?>"><?php echo htmlentities($result->LeaveType);?></option>
<?php }} ?>
</select>
</div>

<div class="input-field col m6 s12">
<label for="fromdate">From  Date</label>
<input style="width: 80%;
    border:0px solid transparent;
    border-radius: 0;
    border-bottom: 1px solid #aaa;
    padding: 1em .5em .5em;
    padding-left: 2em;
    outline:none;
    margin:0.5em auto;
    transition: all .5s ease;" placeholder="" id="mask1" name="fromdate" class="masked" type="date" data-inputmask="'alias': 'date'" required>
</div>


<div class="input-field col m6 s12">
<label for="todate">To Date</label>
<input style="width: 89%;
    border:0px solid transparent;
    border-radius: 0;
    border-bottom: 1px solid #aaa;
    padding: 1em .5em .5em;
    padding-left: 2em;
    outline:none;
    margin:0.5em auto;
    transition: all .5s ease;"  placeholder="" id="mask1" name="todate" class="masked" type="date" data-inputmask="'alias': 'date'" required>
</div>


<!--div class="input-field col m6 s12">
<label for="noofdays">No of Days</label>
<input id="noofdays" name="noofdays" type="text" autocomplete="off" required>
</div-->


<div class="input-field col m12 s12">
<label for="Purpose">Purpose</label>    
<textarea id="textarea1" name="description" class="materialize-textarea" length="500" ></textarea>
</div>

<div class="input-field col m12 s12">
<label for="Alternate arragement">Alternate Arrangement Details</label>    
<textarea id="textarea1" name="arrangement" class="materialize-textarea" length="500" ></textarea>
</div>
  <div style="width:100%;">
        <div class="col" >
            Whether station leave required
        </div>
        <div class="col1">
        <input type="radio" id="yes" name="yes_no" value="Yes"/>
        
        </div>
        <div class="col">Yes</div>
       
        <div class="col1">
        <input type="radio" id="no" name="yes_no" value="No" />
        
        </div>
        <div class="col">No</div> 
        </div>
    </div>
       <div id="visibleYes"  style="width:100%; display:none;">
            
        <div>
            
            
<div class="input-field col m6 s12">
<label for="from">From</label>
<input id="from" name="from" type="text"></div>

<div class="input-field col m6 s12">
<label for="to">To</label>
<input id="from" name="to" type="text">
</div>

        </div>
        </div>
        
<div class="input-field col m6 s12">
<label for="adressleave">Address during leave</label>
<input id="adressleave" name="adressleave" type="text" autocomplete="off" required>
</div>

</div>

 <div class="input-field col  s4">
      <button type="submit" name="apply"  class="waves-effect waves-light btn indigo m-b-xs">Apply</button>   
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
        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="../css-img/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../css-img/plugins/materialize/js/materialize.min.js"></script>
        <script src="../css-img/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../css-img/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../css-img/js/alpha.min.js"></script>
        <script src="../css-img/js/pages/form_elements.js"></script>
          <script src="../css-img/js/pages/form-input-mask.js"></script>
                <script src="../css-img/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
    </body>
    <script>
        document.getElementById('yes').onchange=function(){
            document.getElementById('visibleYes').style.display='block';
        }
        
        document.getElementById('no').onchange=function(){
            document.getElementById('visibleYes').style.display='none';
        }
    </script>
</html>
<?php } ?> 