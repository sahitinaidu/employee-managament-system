<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['alogin']))
    {  
header('location:../main.php');
}
else{
$eid=intval($_GET['empid']);
if(isset($_POST['update']))
{


$fname=$_POST['firstName'];
$lname=$_POST['lastName']; 
$FatherName =$_POST['FatherName']; 
$MotherName =$_POST['MotherName'];  
$bloodgroup=$_POST['bloodgroup'];
$email=$_POST['email'];
$branchname=$_POST['branchname'];
$password=md5($_POST['password']);
$gender=$_POST['gender'];
$dob=$_POST['dob'];
if($_POST['dept_schl_sec']=="schools"){
$department=$_POST['dep_sch'];
}
if($_POST['dept_schl_sec']=="sections"){
$department=$_POST['dep_sec'];
}
if($_POST['dept_schl_sec']=="departments"){
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
$category=$_POST['category'];
$joiningdate=$_POST['joiningdate'];
//echo $category;
$Teaching_nonTeaching=$_POST['teaching_nonteaching'];
//echo $teachingnon;
$FacType=$_POST['regular_adhoc'];
//echo $empType;
if($_POST['teaching_nonteaching'] == "Teaching" && $_POST['regular_adhoc'] == "regular"){
  
$designation=$_POST['desg'];
}
else if($_POST['teaching_nonteaching'] == "Non-Teaching" && $_POST['regular_adhoc'] == "regular" ){
$designation=$_POST['ndesg'];
}
else{
    $designation="Nothing";
}

$sql="update tblemployees set FirstName=:fname,LastName=:lname,FatherName=:FatherName,MotherName=:MotherName,branchname=:branchname,Gender=:gender,Dob=:dob,Department=:department,bloodgroup=:bloodgroup,designation=:designation,Address=:address,Phonenumber=:mobileno,agp=:agp,basicpay=:basicpay,paylevel=:paylevel,bogmeet=:bogmeet,panno=:panno,aadharno=:aadharno,bankname=:bankname,accountno=:accountno,ifsc=:ifsc,category=:category,Teaching_nonTeaching=:Teaching_nonTeaching,reportingto=:repoting,joiningdate=:join,FacType=:FacType where id=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':FatherName',$FatherName,PDO::PARAM_STR);
$query->bindParam(':MotherName',$MotherName,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':branchname',$branchname,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':department',$department,PDO::PARAM_STR);
$query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
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
$query->bindParam(':Teaching_nonTeaching',$Teaching_nonTeaching,PDO::PARAM_STR);
$query->bindParam(':repoting',$repoting,PDO::PARAM_STR);
$query->bindParam(':join',$joiningdate,PDO::PARAM_STR);
$query->bindParam(':FacType',$FacType,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$msg="Employee record updated Successfully";
}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>ADMIN | Update Employee</title>
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
    </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
   <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Update employee</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="updatemp">
                                    <div>
                                        <h3>Update Employee Info</h3>
                                           <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
<?php 
$eid=intval($_GET['empid']);
$sql = "SELECT * from  tblemployees where id=:eid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':eid',$eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{            
    ?> 
 <div class="input-field col  s12">
<label for="empcode">Employee Code(Must be unique)</label>
<input  name="empcode" id="empcode" value="<?php echo htmlentities($result->EmpId);?>" type="text" autocomplete="off" readonly required>
<span id="empid-availability" style="font-size:12px;"></span> 
</div>


<div class="input-field col m6 s12">
<label for="firstName">First name</label>
<input id="firstName" name="firstName" value="<?php echo htmlentities($result->FirstName);?>"  type="text" required>
</div>

<div class="input-field col m6 s12">
<label for="lastName">Last name </label>
<input id="lastName" name="lastName" value="<?php echo htmlentities($result->LastName);?>" type="text" autocomplete="off" required>
</div>
<div class="input-field col m6 s12">
<label for="FatherName">Father's name </label>
<input id="FatherName" name="FatherName" value="<?php echo htmlentities($result->FatherName);?>" type="text" autocomplete="off" required>
</div>
<div class="input-field col m6 s12">
<label for="MotherName">Mother's name </label>
<input id="MotherName" name="MotherName" value="<?php echo htmlentities($result->MotherName);?>" type="text" autocomplete="off" required>
</div>

<div class="input-field col s12">
<label for="email">Email Id</label>
<input  name="email" type="email" id="email" value="<?php echo htmlentities($result->EmailId);?>" readonly autocomplete="off" required>
<span id="emailid-availability" style="font-size:12px;"></span> 
</div>
<div class="input-field col m6 s12">
<label for="agp">AGP</label>
<input id="agp" name="agp" value="<?php echo htmlentities($result->agp);?>"  type="text" >
</div>
<div class="input-field col m6 s12">
<label for="basicpay">Basic Pay</label>
<input id="basicpay" name="basicpay" type="text"  value="<?php echo htmlentities($result->basicpay);?>" >
</div>
<div class="input-field col m6 s12">
<label for="paylevel">Pay Level</label>
<input id="paylevel" name="paylevel" value="<?php echo htmlentities($result->paylevel);?>"  type="text" >
</div>
<div class="input-field col m6 s12">
<label for="bogmeet">BoG Meeting Date</label>
<input id="bogmeet" name="bogmeet" class="datepicker" type="tel" value="<?php echo htmlentities($result->bogmeet);?>"   >
</div>

</div></div>
                                                                                              
<div class="col m6">
<div class="row">
<div class="input-field col m6 s12">
<select  name="gender" autocomplete="off">
<option value="<?php echo htmlentities($result->Gender);?>"><?php echo htmlentities($result->Gender);?></option>                                          
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
</div>

<div class="input-field col m6 s12">
<label for="birthdate">Date of Birth</label>
<input id="birthdate" name="dob" class="datepicker" type="tel" value="<?php echo htmlentities($result->Dob);?>" required>
</div>  
<div class="input-field col m6 s12">
 <select name="bloodgroup" id="bloodgroup" required>
     <option>Select BloodGroup</option>
     <option>A+</option>
     <option>A-</option>
     <option>AB+</option>
     <option>AB-</option>
     <option>B+</option>
     <option>B-</option>
     <option>O+</option>
     <option>O-</option>
     
 </select>
</div> 
<div >
        <div class="input-field col m6 s12">
            <select name="category" id="category" required>Category:
                <option>select category</option>
                <option>General</option>
                <option>OBC</option>
                <option>SC</option>
                <option>ST</option>
            </select>
        </div>
       
           
</div>  
                                                   


<div class="input-field col m12 s12">
<label for="address">Address</label>
<input id="address" name="address" type="text"  value="<?php echo htmlentities($result->Address);?>" autocomplete="off" required>
</div>
<div class="input-field col m6 s12">
<label for="phone">Mobile number</label>
<input id="phone" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber);?>" maxlength="10" autocomplete="off" required>
 </div> 
<div class="input-field col m6 s12">
<label for="joiningdate">Date of Joining</label>
<input id="joiningdate" name="joiningdate" class="datepicker" type="tel" value="<?php echo date('j M, Y', strtotime($result->joiningdate));?>" required>
</div>
<div class="input-field col m6 s12">
<label for="panno">Pan Number</label>
<input id="panno" name="panno" value="<?php echo htmlentities($result->panno);?>"  type="text"  required>
</div>
<div class="input-field col m6 s12">
<label for="aadharno">Aadhar No.</label>
<input id="aadharno" name="aadharno" value="<?php echo htmlentities($result->aadharno);?>"  type="text" required>
</div>

<div class="input-field col m6 s12">
<label for="bankname">Bank Name</label>
<input id="bankname" name="bankname" type="text"  value="<?php echo htmlentities($result->bankname);?>"  required>
</div>
<div class="input-field col m6 s12">
<label for="accountno">Account No.</label>
<input id="accountno" name="accountno" type="text"  value="<?php echo htmlentities($result->accountno);?>" required>
</div>                        
<div class="input-field col m6 s12">
<label for="ifsc">IFSC Code</label>
<input id="ifsc" name="ifsc" type="text"  value="<?php echo htmlentities($result->ifsc);?>" required>
</div>                             
<div class="input-field col m6 s12">
<label for="branchname">Branch Name</label>
<input id="branchname" name="branchname" type="text"  value="<?php echo htmlentities($result->branchname);?>" required>
</div>  
         </div>
                                                    </div>                                                                                                                    
<div style="text-align:center;" class="input-field col s12">
 <div style="text-align:center;" class="input-field col s12">
        <div style="width:100%; ">            
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
        <div id="visibleTeaching"  style="width:100%; display:none;">
            
        <div>
           
            
            <div class="col1">
                 <input type="radio" value="regular" id="regular" name="regular_adhoc" />
                 
            </div>
            <div class="col">
                Regular
            </div>
            <div class="col1">
                 <input type="radio"  value="adhoc" id="adhoc" name="regular_adhoc" />
                 
            </div>
            <div class="col">
                Adhoc
            </div>
        
           
        <div id="visibleNonTeaching" style="display:none;">
            
            <div class="col1">
                 <input type="radio" value="contract" id="contract" name="regular_adhoc" />
                 
            </div>
            <div class="col">
                Contract
            </div>
        </div>
           
        </div>
    </div>
        <div style="width:100%;">
       
        </div>
   
        <div id='des' style="width:45%;display: none; margin-left:3%">
            <br>
            <div id="tdesignation" style="display:none;">
            <select name="desg" id="td" > Designation
             <option>select designation</option>
            </select>
            </div>
            <div id="ntdesignation" style="display:none;">
            <select name="ndesg" id="ntd" > Designation
                <option>select designation</option>
            </select>
            </div>
            
        </div>
       
    <br>
        <br>
        <div  style="width:100%;">
            
        <div class="col1">
            <input type="radio" value="departments" id="departments" name="dept_schl_sec" />
        </div>
            <div class="col" style="padding-left:0px;">
                Departments
            </div>
        <div class="col1">
            <input type="radio" value="schools" id="schools" name="dept_schl_sec" />
        </div>
            <div class="col" style="padding-left:0px;">
                Schools
            </div>
       
        <div class="col1">
        <input type="radio" value="sections" id="sections" name="dept_schl_sec" />
       
        </div>
            <div class="col">
                Sections
            </div>
           
            <br>
        </div>
       

        <div id='dep_sec' style="width:45%;display: none;margin-left:3%">
           
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
           
        </div>
</div></div>
<?php
include('includes/config1.php');
$query1="select DepartmentName from tbldepartments order by DepartmentName asc";
$result1=mysqli_query($con, $query1);
$sql1="select schoolName from tblschools order by schoolName asc";
$sql_res=mysqli_query($con, $sql1);
$quer="select sectionName from tblsections order by sectionName asc";
$sql_re=mysqli_query($con, $quer);
$num=mysqli_num_rows($result1);
$no=mysqli_num_rows($sql_res);
$nb=mysqli_num_rows($sql_re);
$count=0;
$cnt1=0;
$ct=0;
while($num>0){
$row = mysqli_fetch_array($result1);
$app=$row['DepartmentName'];
$arr[$count]=$app;
//echo $app;
$num--;
$count++;
}
while($no>0){
$rw = mysqli_fetch_array($sql_res);
$van=$rw['schoolName'];
$array[$cnt1]=$van;
//echo $van;
$no--;
$cnt1++;
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
                                                        var teach_nonteach="<?php echo $result->Teaching_nonTeaching; ?>";
                                                        var type_fac="<?php echo $result->FacType; ?>";
                                                 var designation_name="<?php echo $result->designation; ?>";
                                                 var category_name="<?php echo $result->category; ?>";
                                                 var blood_group="<?php echo $result->bloodgroup; ?>";
            var departments_array = <?php echo json_encode($arr); ?>;
            var schools_array=<?php echo json_encode($array); ?>;
            var sections_array=<?php echo json_encode($ary); ?>;
            var tdes=["Professor","Associate Professor","Assistant Professor"];
           tdes.sort();
            for (var i=0;i<tdes.length;i++)
            document.getElementById("td").innerHTML+="<option>"+tdes[i]+"</option>";
            var ntdes=["Executive engineer","Medical officer","Sports officer","Security officer","Senior technical assistant","Assistant engineer","Sports assistant","Junior engineer","Superintendent","Accountant","Technical assistant","Senior technician","Senior assistant","Technician","Laboratory Assistant","Work assistant","Junior assistant","Attendant","Mali"];
            ntdes.sort();
    for (var i=0;i<ntdes.length;i++)
            document.getElementById("ntd").innerHTML+="<option>"+ntdes[i]+"</option>";
            
           document.getElementById('depts').innerHTML+= '<option>select department</option></li>';
           document.getElementById('schls').innerHTML+= '<option>select school</option></li>';
           document.getElementById('secs').innerHTML+= '<option>select section</option></li>';
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
       if (teach_nonteach==="Non-Teaching"){
           document.getElementById('non_teaching').checked=true;
           document.getElementById('visibleTeaching').style.display='block';
                  document.getElementById('visibleNonTeaching').style.display='block';
                  if (type_fac==="regular"){
                      document.getElementById('des').style.display='block';
                    document.getElementById('ntdesignation').style.display='block';
                    document.getElementById('regular').checked=true;
                    $("#ntdesignation option:contains(" + designation_name + ")").attr('selected', 'selected');
                  }else if (type_fac==="adhoc"){
                    document.getElementById('adhoc').checked=true;
                  }else if (type_fac==="contract"){
                    document.getElementById('contract').checked=true;
                  }
       }else if (teach_nonteach==="Teaching"){
           document.getElementById('teaching').checked=true;
        document.getElementById('visibleTeaching').style.display='block';
        if (type_fac==="regular"){
                      document.getElementById('des').style.display='block';
                    document.getElementById('tdesignation').style.display='block';
                    document.getElementById('regular').checked=true;
                    $("#tdesignation option:contains(" + designation_name + ")").attr('selected', 'selected');
                  }else if (type_fac==="adhoc"){
                      document.getElementById('adhoc').checked=true;
                  }
       }
       
       var dept_name="<?php echo $result->Department; ?>";
       if (departments_array.includes(dept_name)){
           document.getElementById('dep_sec').style.display='block';
           document.getElementById('deptList').style.display='block';
           document.getElementById('departments').checked=true;
           $("#deptList option:contains(" + dept_name + ")").attr('selected', 'selected');
       }else if (schools_array.includes(dept_name)){ 
           document.getElementById('dep_sec').style.display='block';
        document.getElementById('schoolsList').style.display='block';
           document.getElementById('schools').checked=true;
        $("#schoolsList option:contains(" + dept_name + ")").attr('selected', 'selected');
       }else if (sections_array.includes(dept_name)){
           document.getElementById('dep_sec').style.display='block';
          document.getElementById('secList').style.display='block';
          document.getElementById('sections').checked=true;
          $("#secList option:contains(" + dept_name + ")").attr('selected', 'selected');
       }
         
         $("#category option:contains(" + category_name + ")").attr('selected', 'selected');
         $("#bloodgroup option:contains(" + blood_group + ")").attr('selected', 'selected');
</script>
                                                    <?php }}?>
<div class="input-field col s12">
<button type="submit" name="update"  id="update" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>
</div>
</div>
</div> 
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