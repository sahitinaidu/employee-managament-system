 <?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['signin']))
{
    $_SESSION['dir-login']="";
    $_SESSION['hod-login']="";
    $_SESSION['emp-login']="";
    $_SESSION['alogin']="";
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT * FROM tblhead WHERE EmailId=:uname and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{		if($uname=="director@nitandhra.ac.in"){
			$_SESSION['dir-login']=$_POST['username'];
			echo '<script> window.location.href= "dir-dashboard.php"</script>';
		}else if ($uname=="registrar@nitandhra.ac.in"){
                    $_SESSION['dir-login']=$_POST['username'];
			echo '<script> window.location.href= "Segregation/Segregation.php?file_type=Dashboard"</script>';
                }
		else{
         $_SESSION['hod-login']=$_POST['username'];
         echo '<script>  window.location.href = "Segregation/Segregation.php?file_type=Dashboard" </script>';
		}
}else{
    $sql ="SELECT * FROM tblemployees WHERE EmailId=:uname and Password=:password";
    $query= $dbh -> prepare($sql);
     $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
     $query-> bindParam(':password', $password, PDO::PARAM_STR);
     $query-> execute();
     $results=$query->fetchAll(PDO::FETCH_OBJ);
      if($query->rowCount() > 0)
      {
         $_SESSION['emplogin']=$_POST['username'];
         foreach($results as $result){
         $_SESSION['empid']=$result->id;}
        echo "<script type='text/javascript'> document.location = 'myprofile.php'; </script>";
      }else{
        
          $sql ="SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
          $query= $dbh -> prepare($sql);
          $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
          $query-> bindParam(':password', $password, PDO::PARAM_STR);
          $query-> execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          if($query->rowCount() > 0)
          {
            $_SESSION['alogin']=$_POST['username'];
            echo "<script type='text/javascript'> document.location = 'Segregation/Segregation.php?file_type=Dashboard'; </script>";
          }else{
            echo "<script>alert('Invalid Details');</script>";
          }
      }
}

    
}




?><!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>ELMS | Home Page</title>
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../css-img/plugins/materialize/css/materialize.min.css"/>
             <link href="../css-img/css/materialdesign.css" rel="stylesheet">
        <link href="../css-img/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <meta charset="utf-8">
                   <meta name="viewport" content="width=device-width, initial-scale=1">
                   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" >       

            
        <!-- Theme Styles -->
        <link href="../css-img/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css-img/css/custom.css" rel="stylesheet" type="text/css"/>
        
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body>
        <div class="loader-bg"></div>
        <div class="loader">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-spinner-teal lighten-1">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        
            <header class="mn-header navbar-fixed">
                <nav class="cyan darken-1">  
               
                          
                 <div class="header-title col s3">      
                            <span class="chapter-title">EMS | Employee Management System</span>
                        </div>                        
                </nav>
            </header>
             
                <div class="mn-content valign-wrapper">
            <main class="mn-inner container">
  <h4 align="center"><div class="new"><a  href="../index.php"> Login</a></div></h4>
               <div class="solid">
                      <div class="row">

                          <div class="col s12 m6 l4 offset-l4 offset-m3">
                              <div class="card white darken-1">
                                  <div class="card-content ">
                                      <span class="card-title">Sign In</span>
                                       <div class="row">
                                           <form class="col s12" name="signin" method="post">
                                               <div class="input-field col s12">
                                                   <input id="username" type="text" name="username" class="validate" autocomplete="off" required >
                                                   <label for="email">Username</label>
                                               </div>
                                               <div class="input-field col s12">
                                                   <input id="password" type="password" class="validate" name="password" autocomplete="off" required>
                                                   <label for="password">Password</label>
                                               </div>
                                               
                                                   <input type="submit" name="signin" value="Sign in" class="waves-effect waves-light btn teal">
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
                    
                
        </div>
       
           

 
           
           
           
            
           
             
       
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="../css-img/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../css-img/plugins/materialize/js/materialize.min.js"></script>
        <script src="../css-img/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../css-img/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../css-img/js/alpha.min.js"></script>
        
    </body>
</html>