<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['alogin']))
    {  
header('location:../main.php');
}
else{

$eid=$_GET['empid'];


    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>ADMIN | View Employee</title>
        
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
$eid=$_GET['empid'];
$sql = "SELECT * from  tblemployees where EmpId=:eid";
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
<label for="lastName">Last name</label>
<input id="lastName" name="lastName" value="<?php echo htmlentities($result->LastName);?>" type="text" readonly required>
</div>

<div class="input-field col m6 s12">
<label for="FatherName">Father's Name</label>
<input id="FatherName" name="FatherName" value="<?php echo htmlentities($result->FatherName);?>"  type="text" readonly required>
</div>

<div class="input-field col m6 s12">
<label for="MotherName">Mother's name</label>
<input id="MotherName" name="MotherName" value="<?php echo htmlentities($result->MotherName);?>" type="text" readonly required>
</div>

<div class="input-field col s12">
<label for="email">Email</label>
<input  name="email" type="email" id="email" value="<?php echo htmlentities($result->EmailId);?>" readonly autocomplete="off" readonly required>
<span id="emailid-availability" style="font-size:12px;"></span> 
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
<label for="FacType">Regular/Adhoc/Contract</label>
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
<label for="joiningdate">Date of Joining</label>
<input id="joiningdate" name="joiningdate" type="tel"  value="<?php echo date('j M, Y', strtotime($result->joiningdate));?>" maxlength="10" readonly required>
</div>

<div class="input-field col m6 s12">
<label for="phone">Mobile no</label>
<input id="phone" name="mobileno" type="tel"  value="<?php echo htmlentities($result->Phonenumber);?>" maxlength="10" readonly required>
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
        <script src="../../css-img/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../../css-img/plugins/materialize/js/materialize.min.js"></script>
        <script src="../../css-img/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../../css-img/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../../css-img/js/alpha.min.js"></script>
        <script src="../../css-img/js/pages/form_elements.js"></script>
        
    </body>
</html>
<?php } ?> 