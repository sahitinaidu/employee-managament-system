<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js'></script>
  
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
session_start();
error_reporting(0);
include('../includes/config.php');
$login_id= (empty($_SESSION['hod-login'])?"":$_SESSION['hod-login']).(empty($_SESSION['dir-login'])?"":$_SESSION['dir-login']).
        (empty($_SESSION['emplogin'])?"":$_SESSION['emplogin']).(empty($_SESSION['alogin'])?"":$_SESSION['alogin']);
if(strlen($login_id)==0)
    {   
header('location:main.php');
}
else{
    
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
    </head>
    <link rel="stylesheet" href="SegregationFiles/SegregationStyling.css">
    <link rel="stylesheet" href="SegregationFiles/CalendarStyling.css">
    <body>
           <?php 
           $notifications=TRUE;
           include('../includes/header.php');
           $users_array=array("DIRECTOR","REGISTRAR","HOD","HEAD","ADMIN","EMPLOYEE");
           $user=strtoupper(explode("_",explode("@", $login_id,2)[0],2)[0]);
           if (!in_array($user, $users_array)){
               $user="EMPLOYEE";
           }
		   if ($user=="DIRECTOR" || $user=="REGISTRAR"){
                       include('../includes/directorsidebar.php');
                   } else if ($user=="HOD" || $user=="HEAD"){
                       include('../includes/hodsidebar.php');
                   }else if ($user=="ADMIN"){
                       include('../admin/includes/sidebar.php');
                   }else{
                       include('../includes/sidebar.php');
                   }
                   $email=$login_id;
$page_type=$_GET['file_type'];
$page_title=$user." | ".$page_type;    
    
                   ?>
       
      <script>
          var leave_date_index=-1;
            var date_array;
         document.title="<?php echo $user;?>"+" | "+"<?php echo $_GET['file_type'] ?>";
        
        </script>
    <?php 
        function convertDate($str){
           $s= explode(" ",$str)[0];
           return date('j M, Y', strtotime(explode("-",$s)[2]."-".explode("-",$s)[1]."-".explode("-",$s)[0]));
        }
    ?>
            
            <main class="mn-inner">
                <div class="middle-content" style="width:calc(100% - 100px)!important;">
                   
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
    <link rel="stylesheet" href="SegregationFiles/SegregationStyling.css">
  <link rel="stylesheet" href="SegregationFiles/CalStyling.css">
 
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
               <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../../css-img/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../../css-img/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="../../css-img/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css-img/css/custom.css" rel="stylesheet" type="text/css"/>
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                    
        <link href="../../css-img/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
                  
        <link type="text/css" rel="stylesheet" href="../../css-img/plugins/materialize/css/materialize.min.css"/>
        <link href="../../css-img/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="../../css-img/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css-img/css/custom.css" rel="stylesheet" type="text/css"/>
            
        <!-- Theme Styles -->
     
 
                    <div class="row no-m-t no-m-b">
                        <div class="col s12 m12 l12">
                            <div class="card invoices-card">
                                <div class="card-content">
                                 
                                 <span class="card-title"><h5><?php echo $_GET['file_type'] ?></h5></span>
                                      <div style="width:100%;">
                                     
                                        <?php include 'SegregationFiles/Dropdowns.php';?>
                             <table id="example" class="display responsive-table ">
                                    <thead>
                                    </thead>
                                      
                                    <script src="SegregationFiles/SegClass.js"></script>
                                    <script src="SegregationEdit/TableHeaders.js"></script>
                                    
                               <tbody>
                                   
                                    <?php include 'SegregationEdit/SegPhpData.php';?>
                                    <?php include 'SegregationFiles/SegTableData.php';?>
                         
                                    </tbody>
                                </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
            </main>
          
       
        <script src="SegregationFiles/SegJS.js"></script>
        
        <?php include 'SegregationEdit/division.php'; 
        for ($i=0;$i<count($more_filters);$i++){?>
        <script>
            var f="<?php echo $more_filters[$i]; ?>"; 
            mappingArr.push(fl.tableHeaders.indexOf(f));
        </script>
        
        <?php }  ?>
        <script src="SegregationFiles/FilteringJS.js"></script>
        <?php 
        if (!$notifications){?>
        <script>
        $('.badge1').css('visibility','hidden');
        $('.fa-bell-o').hide();
        </script>
       <?php }
       if (!$division || !$more){?>
        <script>
           $('.input-icons').css("float","left");
           $('.input-icons').css("width","60%");
           $('.container').css("padding-right","8%");
           $('.container').css("padding-left","0%");
           $('.input-icons').css("text-align","center");
           $('#myInput').css("width","90%");
           </script>
     <?php      if (!$more){ ?>
           <script>  $('.container').eq(1).hide();</script>
           
     <?php     }if (!$division){ ?>
           <script>
           $('.container').eq(0).hide();
           
           </script>
       <?php  }} ?>
          
      
       <script src="../../css-img/plugins/materialize/js/materialize.min.js"></script>
        <script src="../../css-img/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../../css-img/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../../css-img/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../../css-img/js/alpha.min.js"></script>
        <script src="../../css-img/js/pages/table-data.js"></script>
        
        <!-- Javascripts -->
        
       
        
        <script src="../../css-img/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../../css-img/plugins/counter-up-master/jquery.counterup.min.js"></script>
        <script src="../../css-img/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="../../css-img/plugins/chart.js/chart.min.js"></script>
        <script src="../../css-img/plugins/flot/jquery.flot.min.js"></script>
        <script src="../../css-img/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="../../css-img/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="../../css-img/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../../css-img/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../../css-img/plugins/curvedlines/curvedLines.js"></script>
        <script src="../../css-img/plugins/peity/jquery.peity.min.js"></script>
        
        <script src="../../css-img/js/pages/dashboard.js"></script>
        
        <!-- Javascripts -->
        <style>
        table.dataTable thead .sorting,table.dataTable thead .sorting_asc,table.dataTable thead .sorting_desc,table.dataTable thead .sorting_asc_disabled,
table.dataTable thead .sorting_desc_disabled	{
background-position: left! important;
padding-left: 20px !important;
}
</style>	
    </body>
</html>
<?php } ?>