<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['alogin']))
    {  
header('location:../main.php');
}
else
{
$mail=$_GET['mail'];
$personmail=$_GET['personmail'];
		$dep=array();
		$s=$dbh -> prepare( "SELECT DepartmentName from tbldepartments" );
		$s->execute();
		$re=$s->fetchAll();
		foreach ($re as $row)
		{
			array_push($dep,$row['DepartmentName']);
		}
		$school=array();
		$s=$dbh -> prepare( "SELECT schoolName from tblschools" );
		$s->execute();
		$re=$s->fetchAll();
		foreach ($re as $row)
		{
			array_push($school,$row['schoolName']);
		}
		$sec=array();
		$sr=$dbh -> prepare( "SELECT sectionName from tblsections" );
		$sr->execute();
		$re=$sr->fetchAll();
		foreach ($re as $row)
		{
			array_push($sec,$row['sectionName']);
		}
if(isset($_POST['update']))
{
		$sth=$dbh -> prepare( "SELECT Department from tblemployees where EmailId=:personmail" );
		$sth-> bindParam(':personmail', $personmail, PDO::PARAM_STR);
		$sth->execute();
		$res=$sth->fetchObject();
		if($sth->rowCount() > 0)
		{
			$department=$res->Department;
			if(in_array($department,$dep,true)){
				$st=$dbh -> prepare( "SELECT DepartmentShortName from tbldepartments where DepartmentName=:department" );
				$st-> bindParam(':department', $department, PDO::PARAM_STR);
				$st->execute();
				$res=$st->fetchObject();
				if($st->rowCount() > 0)
				{
					$repoting="hod_".$res->DepartmentShortName."@nitandhra.ac.in";
				}	
			}
			else if(in_array($department,$school,true)){
				$st=$dbh -> prepare( "SELECT SchoolShortName from tblschools where schoolName=:department" );
				$st-> bindParam(':department', $department, PDO::PARAM_STR);
				$st->execute();
				$res=$st->fetchObject();
				if($st->rowCount() > 0)
				{
					$repoting="hod_".$res->SchoolShortName."@nitandhra.ac.in";
				}
			}
			else if(in_array($department,$sec,true)){
				$secname=str_replace(' ','',strtolower($department));
				$repoting="head_".$secname."@nitandhra.ac.in";
			}
			else{
				$repoting="null";
			}
		}
	$sql="update tblemployees set reportingto=:repoting WHERE EmailId=:personmail";
	$query = $dbh->prepare($sql);
	$query->bindParam(':repoting',$repoting,PDO::PARAM_STR);
	$query->bindParam(':personmail',$personmail,PDO::PARAM_STR);
	$query->execute();
$empmail=$_POST['empmail'];
$q="SELECT EmpId from tblemployees where EmailId=:empmail";
$quer = $dbh->prepare($q);
$quer-> bindParam(':empmail', $empmail, PDO::PARAM_STR);
$quer->execute();
$results=$quer->fetchObject();
if($quer->rowCount() > 0)
{
$employeeid=$results->EmpId;
if($mail!="registrar@nitandhra.ac.in" && $mail!="director@nitandhra.ac.in"){
	$report="registrar@nitandhra.ac.in";
}
else if($mail=="registrar@nitandhra.ac.in"){
	$report="director@nitandhra.ac.in";
}
else if($mail== "director@nitandhra.ac.in"){
	$report="null";
}
$sql="update tblemployees set reportingto=:report WHERE EmpId=:employeeid";
$query = $dbh->prepare($sql);
$query->bindParam(':report',$report,PDO::PARAM_STR);
$query->bindParam(':employeeid',$employeeid,PDO::PARAM_STR);
$query->execute();
$password=md5($_POST['password']);

$sql="update tblhead set EmpId=:employeeid,Password=:password WHERE EmailId=:mail";
$query = $dbh->prepare($sql);
$query->bindParam(':employeeid',$employeeid,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':mail',$mail,PDO::PARAM_STR);
$query->execute();
?>
<script>alert("Position upadated Successfully");</script>
<?php 
}
else
{ ?>
<script>alert("Something went wrong. please try again");</script>
<?php
}

}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
       
        <!-- Title -->
        <title>ADMIN | Update Manager</title>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
       
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../../css-img/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../../css-img/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../../css-img/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css-img/css/custom.css" rel="stylesheet" type="text/css"/>
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
        form{
            width:80%;
            margin-left: 10%;
           
        }
        select{
            display: none;
            float: left;
        }
       
        .myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px;
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block
}

.myUL li a:hover:not(.header) {
  background-color: #eee;
}
#schools{
   
  border: 1px solid #ddd;
  margin-top: -1px;
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block;
  width:100%;
}

.myUL button:hover:not(.header) {
  background-color: #eee;
}
button{
			
			margin-top:6%;
		}
        </style>
    <script type="text/javascript">
function valid()
{
if(document.addemp.password.value!= document.addemp.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.addemp.confirmpassword.focus();
return false;
}
return true;
}
</script>

    </head>
    <body>
  <?php include('includes/header.php');?>
           
       <?php include('includes/sidebar.php');?>
   <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Update Official</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addemp">
                                    <div>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
<div class="col m6">
<div class="row">
     
 <div class="input-field col  s12">
<label for="empid">Enter Employee Email</label>
<input  name="empmail" id="empid" type="text" autocomplete="off" required>
<span id="emailid-availability" style="font-size:12px;"></span>
</div>
<div class="input-field col s12">
<label for="password">Password</label>
<input id="password" name="password" type="password" autocomplete="off" required>
</div>

</div>
</div>  
                                        
<div class="col m6">
<div class="row">
<div class="input-field col s12">
<label for="confirm">Confirm password</label>
<input id="confirm" name="confirmpassword" type="password" autocomplete="off" required>
</div> 
<div class="input-field col s12">
<br/>
<?php echo $mail;?>
<hr style="margin-top:1%; margin-bottom:4%;" />
</div>

<br/><br/>
<br/>

<div class="button">
<button type="submit" name="update" onclick="return valid();" id="add" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>
</div>
</div>
</div>
<br><br><br>
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
        <script src="../../css-img/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../../css-img/plugins/materialize/js/materialize.min.js"></script>
        <script src="../../css-img/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../../css-img/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../../css-img/js/alpha.min.js"></script>
        <script src="../../css-img/js/pages/form_elements.js"></script>
       
    </body>
</html>
<?php } ?> 
