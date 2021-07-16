<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['emplogin']))
    {   
header('location:main.php');
}
else{
$eid=$_SESSION['emplogin'];
if(isset($_POST['update']))
{

$fname=$_POST['firstName'];
$lname=$_POST['lastName']; 
$ftname=$_POST['FatherName']; 
$mname=$_POST['MotherName'];    
$gender=$_POST['gender']; 
$dob=$_POST['dob']; 
$department=$_POST['department']; 
$designation=$_POST['designation']; 
$address=$_POST['address']; 
$mobileno=$_POST['mobileno']; 
$bloodgroup=$_POST['bloodgroup'];
$agp=$_POST['agp']; 
$basicpay=$_POST['basicpay']; 
$paylevel=$_POST['paylevel']; 
$bogmeet=$_POST['bogmeet']; 
$panno=$_POST['panno']; 
$aadharno=$_POST['aadharno']; 
$bankname=$_POST['bankname']; 
$accountno=$_POST['accountno']; 
$ifsc=$_POST['ifsc']; 
$joiningdate=$_POST['joiningdate'];
$category=$_POST['category']; 
$Teaching_nonTeaching=$_POST['Teaching_nonTeaching']; 
$FacType=$_POST['FacType']; 

$sql="update tblemployees set FirstName=:fname,LastName=:lname,FatherName=:ftname,MotherName=:mname,Gender=:gender,Dob=:dob,Department=:department,bloodgroup=:bloodgroup,designation=:designation,Address=:address,Phonenumber=:mobileno,agp=:agp,basicpay=:basicpay,paylevel=:paylvel,bogmeet=:bogmeet,panno=:panno,aadharno=:aadharno,bankname=:bankname,accountno=:accountno,ifsc=:ifsc,joiningdate=:joiningdate,category=:category,Teaching_nonTeaching=:Teaching_nonTeaching,FacType=:FacType where EmailId=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':ftname',$ftname,PDO::PARAM_STR);
$query->bindParam(':mname',$mname,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
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
$query->bindParam(':joiningdate',$joiningdate,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':Teaching_nonTeaching',$Teaching_nonTeaching,PDO::PARAM_STR);
$query->bindParam(':FacType',$FacType,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();

}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>EMPLOYEE | Details</title>
            
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
                        <div class="page-title"><h5>Employee Info</h5></div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="updatemp">
                                    <div>
                                       
                                           <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
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
<label for="empcode">Employee Code</label>
<input  name="empcode" id="empcode" value="<?php echo htmlentities($result->EmpId);?>" type="text"  readonly required>
<span id="empid-availability" style="font-size:12px;"></span> 
</div>

<div class="input-field col m6 s12">
<label for="firstName">First name</label>
<input id="firstName" name="firstName" value="<?php echo htmlentities($result->FirstName);?>"  type="text" readonly required>
</div>

<div class="input-field col m6 s12">
<label for="lastName">Last name </label>
<input id="lastName" name="lastName" value="<?php echo htmlentities($result->LastName);?>" type="text" readonly required>
</div>
<div class="input-field col m6 s12">
<label for="FatherName">Father's name</label>
<input id="FatherName" name="FatherName" value="<?php echo htmlentities($result->FatherName);?>" type="text" readonly required>
</div>
<div class="input-field col m6 s12">
<label for="MotherName">Mother's name</label>
<input id="MotherName" name="MotherName" value="<?php echo htmlentities($result->MotherName);?>" type="text" readonly required>
</div>
<div class="input-field col m6 s12">
<label for="email">Email</label>
<input  name="email" type="email" id="email" value="<?php echo htmlentities($result->EmailId);?>" readonly autocomplete="off" readonly required>
<span id="emailid-availability" style="font-size:12px;"></span> 
</div>
<div class="input-field col m6 s12">
<label for="joiningdate">Date of Joining</label>
<input id="joiningdate" name="joiningdate" type="text"  value="<?php echo date('j M, Y', strtotime($result->joiningdate));?>"  readonly required>
</div>
 <div class="input-field col m6 s12">
<label for="agp">AGP</label>
<input id="agp" name="agp" value="<?php echo htmlentities($result->agp);?>"  type="text" readonly required>
</div>
<div class="input-field col m6 s12">
<label for="basicpay">Basic Pay</label>
<input id="basicpay" name="basicpay" type="text"  value="<?php echo htmlentities($result->basicpay);?>"  readonly required>
</div>
<div class="input-field col m6 s12">
<label for="paylevel">Pay Level</label>
<input id="paylevel" name="paylevel" value="<?php echo htmlentities($result->paylevel);?>"  type="text" readonly required>
</div>
<div class="input-field col m6 s12">
<label for="bogmeet">BoG Meeting Date</label>
<input id="bogmeet" name="bogmeet" value="<?php echo htmlentities($result->bogmeet);?>"  type="text" readonly required>
</div>

<div class="input-field col m6 s12">
<label for="Teaching_nonTeaching">Teaching/nonTeaching</label>
<input id="Teaching_nonTeaching" name="Teaching_nonTeaching" type="text"  value="<?php echo htmlentities($result->Teaching_nonTeaching);?>"  readonly required>
</div>
<div class="input-field col m6 s12">
<label for="FacType">Employement type</label>
<input id="FacType" name="FacType" type="text"  value="<?php echo htmlentities($result->FacType);?>"  readonly required>
</div>
</div>
</div>
                                                    
<div class="col m6">
<div class="row">
<div class="input-field col m6 s12">
<label for="gender">Gender</label>
<input id="gender" name="gender" type="text"  value="<?php echo htmlentities($result->Gender);?>"  readonly required>
</div>

<div class="input-field col m6 s12">
<label for="todate">Date of Birth</label>
<input id="phone" name="dob" type="tel" value="<?php echo htmlentities($result->Dob);?>" maxlength="10" autocomplete="off" readonly required>
</div>                                                  
<div class="input-field col m6 s12">
<label for="department">Department</label>
<input id="department" name="department" type="text"  value="<?php echo htmlentities($result->Department);?>"  readonly required>                                      
<?php }} ?>

</div>
<div class="input-field col m6 s12">
<label for="designation">Designation</label>
<input id="address" name="designation" type="text"  value="<?php echo htmlentities($result->designation);?>"  readonly required>
</div>
<div class="input-field col m6 s12">
<label for="bloodgroup">Blood Group</label>
<input id="bloodgroup" name="bloodgroup" type="text"  value="<?php echo htmlentities($result->bloodgroup);?>" readonly required>
</div>
<div class="input-field col m6 s12">
<label for="category">Category</label>
<input id="category" name="category" type="text"  value="<?php echo htmlentities($result->category);?>"  readonly required>
</div>
<div class="input-field col m6 s12">
<label for="address">Address</label>
<input id="address" name="address" type="text"  value="<?php echo htmlentities($result->Address);?>"  readonly required>
</div> 
<div class="input-field col m6 s12">
<label for="phone">Mobile no</label>
<input id="phone" name="mobileno" type="tel"  value="<?php echo htmlentities($result->Phonenumber);?>" maxlength="10" readonly required>
</div>

<div class="input-field col m6 s12">
<label for="panno">Pan no</label>
<input id="panno" name="panno" value="<?php echo htmlentities($result->panno);?>"  type="text" readonly required>
</div>
<div class="input-field col m6 s12">
<label for="aadharno">Aadhar no</label>
<input id="aadharno" name="aadharno" value="<?php echo htmlentities($result->aadharno);?>"  type="text" readonly required>
</div>

<div class="input-field col m6 s12">
<label for="bankname">Bank Name</label>
<input id="bankname" name="bankname" type="text"  value="<?php echo htmlentities($result->bankname);?>"  readonly required>
</div>
<div class="input-field col m6 s12">
<label for="accountno">Account no</label>
<input id="accountno" name="accountno" type="text"  value="<?php echo htmlentities($result->accountno);?>"  readonly required>
</div>                        
<div class="input-field col m6 s12">
<label for="ifsc">IFSC Code</label>
<input id="ifsc" name="ifsc" type="text"  value="<?php echo htmlentities($result->ifsc);?>"  readonly required>
</div>
<div class="input-field col m6 s12">
<label for="branchname">Branch Name</label>
<input id="branchname" name="branchname" type="text"  value="<?php echo htmlentities($result->branchname);?>"  readonly required>
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
<?php } ?> 