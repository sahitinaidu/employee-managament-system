<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(empty($_SESSION['alogin']))
    {  
header('location:../main.php');
}
else{
if(isset($_POST['adddepartment']))
{
$deptname=$_POST['departmentname'];
$deptshortname=$_POST['departmentshortname'];
$deptcode=$_POST['deptcode'];   
$sql="INSERT INTO tbldepartments(DepartmentName,DepartmentCode,DepartmentShortName) VALUES(:deptname,:deptcode,:deptshortname)";
$query = $dbh->prepare($sql);
$query->bindParam(':deptname',$deptname,PDO::PARAM_STR);
$query->bindParam(':deptcode',$deptcode,PDO::PARAM_STR);
$query->bindParam(':deptshortname',$deptshortname,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Department ";
}
else 
{
$error="Something went wrong. Please try again";
}

}
if(isset($_POST['addschool']))
{
$schoolname=$_POST['schoolname'];
$schoolshortname=$_POST['schoolshortname'];

$sql="INSERT INTO  tblschools(schoolName,SchoolShortName) VALUES (:schoolname,:schoolshortname)";
$query = $dbh->prepare($sql);
$query->bindParam(':schoolname',$schoolname,PDO::PARAM_STR);
$query->bindParam(':schoolshortname',$schoolshortname,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="School ";
}
else 
{
$error="Something went wrong. Please try again";
}

}
if(isset($_POST['addsection']))
{
$sectname=$_POST['sectionname'];
  
$sql="INSERT INTO tblsections (sectionName) VALUES (:sectname)";
$query = $dbh->prepare($sql);
$query->bindParam(':sectname',$sectname,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Section ";
}
else 
{
$error="Something went wrong. Please try again";
}

}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>ADMIN | Add Department</title>
        
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function () {
  $('.group').hide();
  $('#department').show();
  $('#selectMe').change(function () {
    $('.group').hide();
    $('#'+$(this).val()).show();
  })
}); 
        </script>
    </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Add </div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="card">
                            <div class="card-content">
                              
                                <div class="row">
                                    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><?php echo htmlentities($msg); ?>:<strong>CREATED SUCCESSFULLY</strong> </div><?php }
                ?>
                                  <div class="dept" style="width:92%; margin-left:4%;"> 
								  <select id="selectMe">								
                                        <option value="department">Department</option>
                                        <option value="section">Section</option>
                                        <option value="school">School</option>
                                        
                                    </select>
									</div>
                                     <div id="department" class="group">
                                          <form class="col s12" name="chngpwd" method="post">
                                          
                                        <div class="row">
                                            <div class="input-field col s12">
<input id="departmentname" type="text"  class="validate" autocomplete="off" name="departmentname"  required>
                                                <label for="deptname">Department Name</label>
                                            </div>


          <div class="input-field col s12">
<input id="departmentshortname" type="text"  class="validate" autocomplete="off" name="departmentshortname"  required>
                                                <label for="deptshortname">Department Short Name</label>
                                            </div>
   <div class="input-field col s12">
 <input id="deptcode" type="text" name="deptcode" class="validate" autocomplete="off" required>
                                                <label for="password">Department Code</label>
                                            </div>




<div class="input-field col s12">
<button type="submit" name="adddepartment" class="waves-effect waves-light btn indigo m-b-xs">ADD</button>

</div>

                                        </div>
                                       
                                    </form>
                                     </div>
                                    <div id="section" class="group">
                                         <form class="col s12" name="chngpwd" method="post">
                                         
                                        <div class="row">
                                            <div class="input-field col s12">
<input id="sectionname" type="text"  class="validate" autocomplete="off" name="sectionname"  required>
                                                <label for="sectionname">Section Name</label>
                                            </div>


<div class="input-field col s12">
<button type="submit" name="addsection" class="waves-effect waves-light btn indigo m-b-xs">ADD</button>

</div>

                                        </div>
                                       
                                    </form>
                                    </div>
                                    <div id="school" class="group">
                                        <form class="col s12" name="chngpwd" method="post">
                                         
                                        <div class="row">
                                            <div class="input-field col s12">
<input id="schoolname" type="text"  class="validate" autocomplete="off" name="schoolname"  required>
                                                <label for="deptname">School Name</label>
                                            </div>


          <div class="input-field col s12">
<input id="schoolshortname" type="text"  class="validate" autocomplete="off" name="schoolshortname"  required>
                                                <label for="schoolshortname">School Short Name</label>
                                            </div>
 




<div class="input-field col s12">
<button type="submit" name="addschool" class="waves-effect waves-light btn indigo m-b-xs">ADD</button>

</div>

                                        </div>
                                       
                                    </form>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>                                                  
                    </div>               
                </div>
            </main>

        </div>
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