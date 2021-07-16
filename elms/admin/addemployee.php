<!DOCTYPE html>
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['alogin']))
    {  
header('location:../main.php');
}
else{
if(isset($_POST['add']))
{
$empid=$_POST['empcode'];
$fname=$_POST['firstName'];
$lname=$_POST['lastName']; 
$ftname=$_POST['FatherName']; 
$mname=$_POST['MotherName'];  
$bloodgroup=$_POST['bloodgroup'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$gender=$_POST['gender'];
$dob=$_POST['dob'];
$branchname=$_POST['branchname'];
if($_POST['dep_sch']!=="select school" && $_POST['dep_sch']!=="select section" && $_POST['dep_sch']!=="select department"){
$department=$_POST['dep_sch'];
}
if($_POST['dep_sec']!=="select school" && $_POST['dep_sec']!=="select section" && $_POST['dep_sec']!=="select department"){
$department=$_POST['dep_sec'];
}
if($_POST['dep']!=="select school" && $_POST['dep']!=="select section" && $_POST['dep']!=="select department"){
$department=$_POST['dep'];
}
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
$address=$_POST['address'];
if($_POST['desg']!== "select designation" || $_POST['ndesg']!== "select designation"){
if($_POST['desg']!== "select designation" ){    
$designation=$_POST['desg'];
}

if($_POST['ndesg']!== "select designation" ){
$designation=$_POST['ndesg'];
}
}
else{
    $designation="Nothing";
}
$mobileno=$_POST['mobileno'];
$agp=$_POST['agp'];
$basicpay=$_POST['basicpay'];
$paylevel=$_POST['paylevel'];
$bogmeet=$_POST['bogmeet'];
$panno=$_POST['panno'];
$aadharno=$_POST['aadharno'];
$bankname=$_POST['bankname'];
$accountno=$_POST['accountno'];
$ifsc=$_POST['ifsc'];
$category=$_POST['cat'];
$joiningdate=$_POST['joiningdate'];
//echo $category;
$teachingnon=$_POST['teaching_nonteaching'];
//echo $teachingnon;
$empType=$_POST['regular_adhoc'];
//echo $empType;
$status=1;

$sql="INSERT INTO tblemployees(EmpId,FirstName,LastName,FatherName,MotherName,EmailId,branchname,Password,Gender,Dob,Department,bloodgroup,reportingto,designation,Address,Phonenumber,agp,basicpay,paylevel,bogmeet,panno,aadharno,bankname,accountno,ifsc,category,Teaching_nonTeaching,FacType,joiningdate,Status) VALUES(:empid,:fname,:lname,:ftname,:mname,:email,:branchname,:password,:gender,:dob,:department,:bloodgroup,:repoting,:designation,:address,:mobileno,:agp,:basicpay,:paylevel,:bogmeet,:panno,:aadharno,:bankname,:accountno,:ifsc,:category,:teachingnon,:empType,:joiningdate,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':ftname',$ftname,PDO::PARAM_STR);
$query->bindParam(':mname',$mname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':branchname',$branchname,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':department',$department,PDO::PARAM_STR);
$query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
$query->bindParam(':repoting',$repoting,PDO::PARAM_STR);
$query->bindParam(':designation',$designation,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':agp',$agp,PDO::PARAM_STR);
$query->bindParam(':basicpay',$basicpay,PDO::PARAM_STR);
$query->bindParam(':paylevel',$paylevel,PDO::PARAM_STR);
$query->bindParam(':bogmeet',$bogmeet,PDO::PARAM_STR);
$query->bindParam(':panno',$panno,PDO::PARAM_STR);
$query->bindParam(':aadharno',$aadharno,PDO::PARAM_STR);
$query->bindParam(':bankname',$bankname,PDO::PARAM_STR);
$query->bindParam(':accountno',$accountno,PDO::PARAM_STR);
$query->bindParam(':ifsc',$ifsc,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':teachingnon',$teachingnon,PDO::PARAM_STR);
$query->bindParam(':empType',$empType,PDO::PARAM_STR);
$query->bindParam(':joiningdate',$joiningdate,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Employee record added Successfully";
}
else
{
$error="Something went wrong. Please try again";
}

}

    ?>
<html lang="en">
    <head>
       
        <!-- Title -->
        <title>ADMIN | Add Employee</title>
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
        [type="radio"]:not(:checked), [type="radio"]:checked {
    position: absolute;
    left: auto !important;
    opacity: 1 !important;
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

<script>
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
</script>

<script>
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
                    
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" action="" name="addemp">
                                    <div>
                                        <div class="col s12">
                        <div class="page-title">Add employee</div>
                    </div>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
     <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

 <div class="input-field col  s12">
<label for="empcode">Employee Code(Must be unique)</label>
<input  name="empcode" id="empcode" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required>
<span id="empid-availability" style="font-size:12px;"></span>
</div>


<div class="input-field col m6 s12">
<label for="firstName">First name</label>
<input id="firstName" name="firstName" type="text" required>
</div>

<div class="input-field col m6 s12">
<label for="lastName">Last name</label>
<input id="lastName" name="lastName" type="text" autocomplete="off" required>
</div>
<div class="input-field col m6 s12">
<label for="FatherName">Father's name</label>
<input id="FatherName" name="FatherName" type="text" autocomplete="off" required>
</div>
<div class="input-field col m6 s12">
<label for="MotherName">Mother's name</label>
<input id="MotherName" name="MotherName" type="text" autocomplete="off" required>
</div>

<div class="input-field col s12">
<label for="email">Email ID</label>
<input  name="email" type="email" id="email" onBlur="checkAvailabilityEmailid()" autocomplete="off" required>
<span id="emailid-availability" style="font-size:12px;"></span>
</div>

<div class="input-field col m6 s12">
<label for="password">Password</label>
<input id="password" name="password" type="password" autocomplete="off" required>
</div>
<div class="input-field col m6 s12">
<label for="confirm">Confirm Password</label>
<input id="confirm" name="confirmpassword" type="password" autocomplete="off" required>
</div>

<div class="input-field col m6 s12">
<label for="agp">AGP</label>
<input id="firstName" name="agp" type="text">
</div>
<div class="input-field col m6 s12">
<label for="basicpay">Basic Pay</label>
<input id="firstName" name="basicpay" type="text" >
</div>
<div class="input-field col m6 s12">
<label for="paylevel">Pay Level</label>
<input id="firstName" name="paylevel" type="text" >
</div>
<div class="input-field col m6 s12">
<label for="bogmeet">BoG Meeting Date</label>
<input id="firstName" name="bogmeet" class="datepicker" type="text" >
</div>
</div>
</div>                                                
<div class="col m6">
<div class="row">
<div class="input-field col m6 s12">
<select  name="gender" autocomplete="off">
<option value="">Gender</option>                                          
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>

</div>
<div class="input-field col m6 s12">
<label for="birthdate">Date of Birth</label>
<input id="birthdate" name="dob" type="date" class="datepicker" autocomplete="off" required>
</div>
<div class="input-field col m6 s12">   
<div style="width:100%; ">
        <div>
            <select name="bloodgroup" >Blood Group:
                <option>Select blood group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
        </div>
        </div>    </div> 
<div class="input-field col m6 s12">   
<div style="width:100%; ">
        <div>
            <select name="cat" >Category:
                <option>Select Category</option>
                <option>General</option>
                <option>OBC</option>
                <option>SC</option>
                <option>ST</option>
            </select>
        </div>
        </div>  </div>  
<div class="input-field col s12">
<label for="address">Address</label>
<input id="address" name="address" type="text" autocomplete="off" required>
</div>
                                                       
<div class="input-field col m6 s12">
<label for="phone">Mobile Number</label>
<input id="phone" name="mobileno" type="tel" maxlength="10" autocomplete="off" required>
 </div>
<div class="input-field col m6 s12">
<label for="joiningdate">Date of Joining</label>
<input id="joiningdate" name="joiningdate" type="date" class="datepicker" autocomplete="off" required>
 </div>
<div class="input-field col m6 s12">
<label for="panno">Pan Number</label>
<input id="panno" name="panno" type="text" autocomplete="off" required>
</div>
<div class="input-field col m6 s12">
<label for="aadharno">Aadhar No.</label>
<input id="aadharno" name="aadharno" type="text" autocomplete="off" required>
</div>

<div class="input-field col m6 s12">
<label for="bankname">Bank Name</label>
<input id="bankname" name="bankname" type="text" autocomplete="off" required>
</div>
<div class="input-field col m6 s12">
<label for="accountno">Account No.</label>
<input id="accountno" name="accountno" type="text" autocomplete="off" required>
</div>
<div class="input-field col m6 s12">
<label for="ifsc">IFSC Code</label>
<input id="ifsc" name="ifsc" type="text" autocomplete="off" required>
</div>
<div class="input-field col m6 s12">
<label for="branchname">Branch Name</label>
<input id="branchname" name="branchname" type="text" autocomplete="off" required>
</div>
</div>
</div>
<div style="text-align:center;" class="input-field col s12">
    
        <div style="text-align:center;" class="input-field col s12">
        <div style="width:100%;">
        
        <div class="col1">
        <input type="radio" value="Teaching" id="teaching" name="teaching_nonteaching" />
       
        </div>
        <div class="col">Teaching</div>
       
        <div class="col1">
        <input type="radio" value="Non-Teaching"  id="non_teaching" name="teaching_nonteaching" />
       
        </div>
        <div class="col">Non-Teaching</div>
        </div>
    </div>
       <div style="text-align:center;" class="input-field col s12">
        
        <div id="visibleTeaching"  style="width:100%; display:none; ">
            
        <div>
           
            <div class="col1">
                 <input type="radio" value="regular" id="regular" name="regular_adhoc" />
                 
            </div>
            <div class="col"> Regular</div>
            <div class="col1">
                 <input type="radio"  value="adhoc" id="adhoc" name="regular_adhoc" />
                 
            </div>
            <div class="col">Adhoc</div>
             </div>
           
        <div id="visibleNonTeaching" style="display:none;">
           
            <div class="col1">
                 <input type="radio" value="contract" id="contract" name="regular_adhoc" />
                 
            </div>
            <div class="col"> Contract</div>
               
        </div>
            <br>
        </div>
        
   <div id='des' style="width:45%; display:none; margin-left:3%">
            <br>
            <div id="tdesignation" style="display:none;">
              <select name="desg" id="td" > Designation
              <option>Select Designation</option>
            </select>
            </div>
            <div id="ntdesignation" style="display:none;">
            <select name="ndesg" id="ntd" > Designation
                <option>Select Designation</option>
            </select>
            </div>
            <br>
        </div>
        <br>
        <br>
               <div style="width:100%;">
            
        <div class="col1">
            <input type="radio" id="departments" name="dept_schl_sec" />
        </div>
            <div class="col">
                Departments
            </div>
        <div class="col1">
            <input type="radio" id="schools" name="dept_schl_sec" />
        </div>
            <div class="col">
                Schools
            </div>
        <div class="col1">
        <input type="radio" id="sections" name="dept_schl_sec" />
        </div>
            <div class="col">
                Sections
            </div>
            <br>
        </div>
        <div id='dep_sec' style="width:45%; display: none; margin-left:3%">
            <div style="display:none;" id='deptList'>
            <br>
            <select name="dep" id='depts'>
</select>
        </div>
         <div style="display:none;" id='schoolsList'>
            <br>
<select name="dep_sch" id='schls'>
</select>
        </div>
        <div style="display:none;" id='secList'>
            <br>
    <select name="dep_sec" id='secs'>    
    </select>
        </div>
            <br>
        </div>
        <?php
        include('includes/config1.php');
$query="select DepartmentName from tbldepartments order by DepartmentName asc";
$result=mysqli_query($con, $query);
$sql="select schoolName from tblschools order by schoolName asc";
$sql_res=mysqli_query($con, $sql);
$quer="select sectionName from tblsections order by sectionName asc";
$sql_re=mysqli_query($con, $quer);
$num=mysqli_num_rows($result);
$no=mysqli_num_rows($sql_res);
$nb=mysqli_num_rows($sql_re);
$count=0;
$cnt=0;
$ct=0;
while($num>0){
$row = mysqli_fetch_array($result);
$app=$row['DepartmentName'];
$arr[$count]=$app;
//echo $app;
$num--;
$count++;
}
while($no>0){
$rw = mysqli_fetch_array($sql_res);
$van=$rw['schoolName'];
$array[$cnt]=$van;
//echo $van;
$no--;
$cnt++;
}
while($nb>0){
$ro = mysqli_fetch_array($sql_re);
$vap=$ro['sectionName'];
$ary[$ct]=$vap;
//echo $vap;
$nb--;
$ct++;
}
?>

<script>
  var tdes=["Professor","Associate Professor","Assistant Professor"];
           tdes.sort();
            for (var i=0;i<tdes.length;i++)
            document.getElementById("td").innerHTML+="<option>"+tdes[i]+"</option>";
            var ntdes=["Executive Engineer","Medical Officer","Sports Officer","Security Officer","Senior Technical Assistant","Assistant Engineer","Sports Assistant","Junior Engineer","SuperIntendent","Accountant","Technical Assistant","Senior Technician","Senior Assistant","Technician","Laboratory Assistant","Work Assistant","Junior Assistant","Attendant","Mali"];
            ntdes.sort();
    for (var i=0;i<ntdes.length;i++)
            document.getElementById("ntd").innerHTML+="<option>"+ntdes[i]+"</option>";
            
            var departments_array = <?php echo json_encode($arr); ?>;
            var schools_array=<?php echo json_encode($array); ?>;
            var sections_array=<?php echo json_encode($ary); ?>;
        
           document.getElementById('depts').innerHTML+= '<option>Select Department</option></li>';
           document.getElementById('schls').innerHTML+= '<option>Select School</option></li>';
           document.getElementById('secs').innerHTML+= '<option>Select Section</option></li>';
   for (var i=0;i<departments_array.length;i++){
           document.getElementById('depts').innerHTML+= '<option>'+departments_array[i]+'</option></li>';
   }
         
   for (var i=0;i<schools_array.length;i++){
       document.getElementById('schls').innerHTML+='<option>'+schools_array[i]+'</option>';
   }
   
   for (var i=0;i<sections_array.length;i++){
       document.getElementById('secs').innerHTML+='<option>'+sections_array[i]+'</option>';
   }
               $('#teaching').change(function(){
                 
                if (document.getElementById('teaching').checked===true){
                    document.getElementById('des').style.display='none';
                    document.getElementById('visibleTeaching').style.display='block';
                    document.getElementById('visibleNonTeaching').style.display='none';
                   
                    document.getElementById('tdesignation').style.display='none';
                    document.getElementById('ntdesignation').style.display='none';
                    document.getElementById('regular').checked=false;
                    document.getElementById('adhoc').checked=false;
                    document.getElementById('contract').checked=false;
                }
                });
                $('#non_teaching').change(function(){
                if (document.getElementById('non_teaching').checked===true){
                    document.getElementById('visibleTeaching').style.display='block';
                    document.getElementById('visibleNonTeaching').style.display='block';
                    document.getElementById('des').style.display='none';
                    document.getElementById('tdesignation').style.display='none';
                    document.getElementById('ntdesignation').style.display='none';
                    document.getElementById('regular').checked=false;
                    document.getElementById('adhoc').checked=false;
                    document.getElementById('contract').checked=false;
                   
                }
            });
             $('#regular').change(function(){
                if (document.getElementById('regular').checked===true){
                    if (document.getElementById('teaching').checked===true){
                 
                   document.getElementById('des').style.display='block';
                    document.getElementById('tdesignation').style.display='block';
                    document.getElementById('ntdesignation').style.display='none';
                }else{
                 
                    document.getElementById('des').style.display='block';
                    document.getElementById('tdesignation').style.display='none';
                    document.getElementById('ntdesignation').style.display='block';
                }
                }
            });
             $('#adhoc').change(function(){
 
                if (document.getElementById('adhoc').checked===true){  
                    document.getElementById('des').style.display='none';
                    document.getElementById('tdesignation').style.display='none';
                    document.getElementById('ntdesignation').style.display='none';
                }
            });
             $('#contract').change(function(){
                if (document.getElementById('contract').checked===true){
                    document.getElementById('des').style.display='none';
                    document.getElementById('tdesignation').style.display='none';
                    document.getElementById('ntdesignation').style.display='none';
                   
                }
            });
            
             $('#departments').change(function(){
                if (document.getElementById('departments').checked===true){
                    document.getElementById('dep_sec').style.display='block';
                    document.getElementById('deptList').style.display='block';
                    document.getElementById('secList').style.display='none';
                    document.getElementById('schoolsList').style.display='none';
                }
            });
     
             $('#sections').change(function(){
                if (document.getElementById('sections').checked===true){
                    document.getElementById('dep_sec').style.display='block';
                    document.getElementById('deptList').style.display='none';
                    document.getElementById('secList').style.display='block';
                    document.getElementById('schoolsList').style.display='none';
                   
                   
                }
            });
       $('#schools').click(function(){
                      if (document.getElementById('schools').checked===true){
                    document.getElementById('dep_sec').style.display='block';
                    document.getElementById('deptList').style.display='none';
                    document.getElementById('secList').style.display='none';
                    document.getElementById('schoolsList').style.display='block';
    }
       });
      
        </script>
        
        <br>
<button type="submit" name="add" onclick="return valid();" id="add" class="waves-effect waves-light btn indigo m-b-xs">ADD</button>

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