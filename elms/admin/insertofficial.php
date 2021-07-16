<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['alogin']))
    {  
header('location:../main.php');
}
else{
  if(isset($_POST['update']))
  {
$empemail=$_POST['empemail'];
$password=md5($_POST['password']);  
$department=$_POST['nm'];
if($department=="DIRECTOR"){
	$email="director@nitandhra.ac.in";
	$v="null";
}
else if($department=="REGISTRAR"){
	$email="registrar@nitandhra.ac.in";
	$v="director@nitandhra.ac.in";	
}else{
    $email=strtolower(substr($department,strpos($department,"-")+1))."_";
    
    $dp= explode(" ",strtolower(substr($department, 0,strpos($department,"-"))) );
 
    for ($i=0;$i<count($dp);$i++){
    $email=$email.$dp[$i];
    }
    $email=$email."@nitandhra.ac.in";
    $v="registrar@nitandhra.ac.in";
}
$sth=$dbh -> prepare( "select EmpId from tblemployees where EmailId=:empemail " );
$sth-> bindParam(':empemail', $empemail, PDO::PARAM_STR);
$sth->execute();
$results=$sth->fetchObject();
if($sth->rowCount() > 0)
{ $sql="update tblemployees set reportingto=:v WHERE EmailId=:empemail";
	$query = $dbh->prepare($sql);
	$query->bindParam(':v',$v,PDO::PARAM_STR);
	$query->bindParam(':empemail',$empemail,PDO::PARAM_STR);
	$query->execute();
  $employeeid=$results->EmpId;
  $sql2="INSERT INTO tblhead(EmpId,EmailId,Password,Position) VALUES (:employeeid,:email,:password,:department)";
  $query1=$dbh->prepare($sql2);
  $query1->bindParam(':employeeid',$employeeid,PDO::PARAM_STR);
  $query1->bindParam(':email',$email,PDO::PARAM_STR);
  $query1->bindParam(':password',$password,PDO::PARAM_STR);
  $query1->bindParam(':department',$department,PDO::PARAM_STR);
  $query1->execute();
?>
<script>alert("Position added Successfully");</script>
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
        <title>ADMIN | Insert Official</title>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../../css-img/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../../css-img/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../../css-img/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css-img/css/custom.css" rel="stylesheet" type="text/css"/>
  <style>
        .dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}
.dropdown {
  position: relative;
  display: inline-block;
}
.dropdown-content {
  display: none;
  overflow: auto;
  z-index: 1;
}   

    </style>
    <script type="text/javascript">
function valid()
{
if(document.addemp.password.value!== document.addemp.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.addemp.confirmpassword.focus();
return false;
}
return true;
}
function checkAvailabilityEmpid() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'empcode='+$("#empcode").val(),
type: "POST",
success:function(data){
$("#empid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
function checkAvailabilityEmailid() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#emailid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
   </head>
    <body>
  <?php include('includes/header.php');?>     
       <?php include('includes/sidebar.php');?>
   <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Insert New Official</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addemp" style="width:80%;">
                                    <div>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
 <div class="input-field col  s12">
<label for="empcode">Enter Email of the person</label>
<input  name="empemail" id="empcode" type="text" autocomplete="off" required>
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
<div class="button" style="margin-left:0.1%">
    <div class="dropdown" style="width:100%;">
<button  type="button"name='get_dept' onclick="myFunction();" class="dropbtn" id='position' style="margin: 13px;margin-left: 8px; border-bottom-color: rgba(0,0,0,0.3);background-color: white; color:black; width: 100%; height: 30px; border-style: none; border-bottom-style: solid; border-width: 0.5px;padding-bottom: 23px; padding-left: 2px; padding-top: 6px;">
    <span style="float:left; font-family: Roboto; font-size: 14px;color:rgba(0,0,0,0.4);">SELECT </span><i class="fa fa-caret-down" aria-hidden="true" style="float:right;"></i>
</button>
    <input type="text" name="nm" style="display:none;" id="nm"/>
    <div id="myDropdown" style="opacity:1; width:100%;" class="dropdown-content">
        <button type="button" value="SELECT" onclick="fun2(this.value);" style="background-color: white; color:black; width: 100%; height: 30px; border-width:1px;border-style: none; "><span style="float:left; font-family: Roboto; font-size: 14px;color:rgba(0,0,0,0.4);">SELECT</span></button>
    <button type="button" value="DIRECTOR" onclick="fun2(this.value);" style="background-color: white; color:black; width: 100%; height: 30px; border-style: none; "><span style="float:left; font-family: Roboto; font-size: 14px;color:rgba(0,0,0,0.4);">DIRECTOR</span></button><br>
    <button  type="button" value="REGISTRAR" onclick="fun2(this.value);" style="background-color: white; color:black; height: 30px; border-style: none;  width: 100%;"><span style="float:left; font-family: Roboto; font-size: 14px;color:rgba(0,0,0,0.4);">REGISTRAR</span></button><br>
    <button type="button" onclick="fun1('myDropdown1');" style="background-color: white;width: 100%; color:black;  height: 30px; border-style: none; "><span style="float:left; font-family: Roboto; font-size: 14px;color:rgba(0,0,0,0.4);">DEPARTMENTS</span><i class="fa fa-caret-down" aria-hidden="true" style="float:right;"></i>    </button><br>
        <div id="myDropdown1" style="opacity:1; width: 100%;display: none;" class="dropdown-content1"></div>
        <button type="button" onclick="fun1('myDropdown2');" style="width: 100%;background-color: white; color:black; height: 30px; border-style: none; "><span style="float:left; font-family: Roboto; font-size: 14px;color:rgba(0,0,0,0.4);">SCHOOLS</span><i class="fa fa-caret-down" aria-hidden="true" style="float:right;"></i></button><br>
        <div id="myDropdown2" style="opacity:1; width: 100%;display: none;" class="dropdown-content1"></div>
    <button type="button" onclick="fun1('myDropdown3');" style="width: 100%;background-color: white; color:black; height: 30px; border-style: none; "><span style="float:left; font-family: Roboto; font-size: 14px;color:rgba(0,0,0,0.4);">SECTIONS</span><i class="fa fa-caret-down" aria-hidden="true" style="float:right;"></i></button>
    <br>
     <div id="myDropdown3" style="opacity:1; width: 100%;display: none;" class="dropdown-content1">
        </div>
</div>
</div>
</div>
</div>
</div>
</div>
<br><br><br>
</div>                                   
<button type="submit" name="update" onclick="return valid();" id="add" class="waves-effect waves-light btn indigo m-b-xs">INSERT</button>
        <script>            
<?php $sql = "SELECT DepartmentShortName from tbldepartments";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>      
    document.getElementById('myDropdown1').innerHTML+='<button type="button" value="<?php echo strtoupper(htmlentities($result->DepartmentShortName));?>-HOD" onclick="fun2(this.value);" style="padding-left:50px; background-color: white; color:black; width: 100%; height: 30px; border-style: none; "><span style="float:left; font-family: Roboto; font-size: 14px;color:rgba(0,0,0,0.4);"><?php echo strtoupper(htmlentities($result->DepartmentShortName));?>-HOD</span></button><br>';
<?php } } 
$sql1 = "SELECT SchoolShortName from tblschools";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$cnt1=1;
if($query1->rowCount() > 0)
{
foreach($results1 as $result)
{   ?>      
    document.getElementById('myDropdown2').innerHTML+='<button type="button" value="<?php echo strtoupper(htmlentities($result->SchoolShortName));?>-HOD" onclick="fun2(this.value);" style="padding-left:50px; background-color: white; color:black; width: 100%; height: 30px; border-style: none; "><span style="float:left; font-family: Roboto; font-size: 14px;color:rgba(0,0,0,0.4);"><?php echo strtoupper(htmlentities($result->SchoolShortName));?>-HOD</span></button><br>';
            
<?php } } 
		include('includes/config1.php');
$quer="select sectionName from tblsections order by sectionName asc";
$sql_re=mysqli_query($con, $quer);
$nb=mysqli_num_rows($sql_re);
$ct=0;
while($nb>0){
$ro = mysqli_fetch_array($sql_re);
$vap=$ro['sectionName'];
$ary[$ct]=$vap;
$nb--;
$ct++;
}
?>
    var sections_array=<?php echo json_encode($ary); ?>;
    for (var i=0;i<sections_array.length;i++)
        document.getElementById('myDropdown3').innerHTML+='<button type="button" value="'+sections_array[i].toUpperCase()+'-HEAD"  onclick="fun2(this.value);" style="padding-left:50px; background-color: white; color:black; width: 100%; height: 30px; border-style: none; "><span style="float:left; font-family: Roboto; font-size: 14px;color:rgba(0,0,0,0.4);">'+sections_array[i].toUpperCase()+'-HEAD</span></button><br>';
            function fun1(a){
                document.getElementById('myDropdown').style.display="block";
                if (document.getElementById(a).style.display==="none"){
                    document.getElementById('myDropdown1').style.display="none";
                    document.getElementById('myDropdown2').style.display="none";
                    document.getElementById('myDropdown3').style.display="none";
                    document.getElementById(a).style.display="block";
                }else{
                    document.getElementById(a).style.display="none";
                }
            }
            function myFunction() {
                if (document.getElementById('myDropdown').style.display==="none"){
                    document.getElementById('myDropdown').style.display="block";
                    document.getElementById('position').style.display="none";
                }else{
                    document.getElementById('position').style.display="none";
                    document.getElementById('myDropdown').style.display="block";
                }
}
function fun2(selVal){
    document.getElementById('myDropdown').style.display="none";
    document.getElementById('position').getElementsByTagName('span')[0].innerHTML=selVal;
    document.getElementById('position').value=selVal;
    document.getElementById('nm').value=selVal;
    document.getElementById('position').style.display="block";
}
window.addEventListener('click', function(e){
	if (!document.getElementsByClassName('dropdown')[0].contains(e.target)){
          document.getElementById('position').style.display="block";
                    document.getElementById('myDropdown').style.display="none";
                
  } });   </script>     
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
