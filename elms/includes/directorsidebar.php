     <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper">
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-info">
                   
                        </div>
                    </div>
             <?php if (isset($_GET['file_type'])){ ?>
                    <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
    <?php if ($_SESSION['dir-login']=="registrar@nitandhra.ac.in"){?>
                   
                   <li class="no-padding"><a class="waves-effect waves-grey" href="Segregation.php?file_type=Dashboard">DashBoard</a></li>   
    <?php }else{?>	
    <li class="no-padding"><a class="waves-effect waves-grey" href="../dir-dashboard.php">DashBoard</a></li>   
                 
                  <?php }?><li class="no-padding"><a class="waves-effect waves-grey" href="Segregation.php?file_type=Staff">Staff</a></li>
				    <li class="no-padding"><a class="waves-effect waves-grey" href="Segregation.php?file_type=All Leaves">All Leaves</a></li>
          <li class="no-padding"><a class="waves-effect waves-grey" href="../dir-changepassword.php">Change Password</a></li>
    
                  <li class="no-padding"><a class="waves-effect waves-grey" href="../Jomon.php">Sign Out</a></li>
                </ul>
             <?php }else{?>
                    <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
    <?php if ($_SESSION['dir-login']=="registrar@nitandhra.ac.in"){?>
                   
                   <li class="no-padding"><a class="waves-effect waves-grey" href="Segregation/Segregation.php?file_type=Dashboard">DashBoard</a></li>   
    <?php }else{?>	
    <li class="no-padding"><a class="waves-effect waves-grey" href="dir-dashboard.php">DashBoard</a></li>   
                 
                  <?php }?><li class="no-padding"><a class="waves-effect waves-grey" href="Segregation/Segregation.php?file_type=Staff">Staff</a></li>
				    <li class="no-padding"><a class="waves-effect waves-grey" href="Segregation/Segregation.php?file_type=All Leaves">All Leaves</a></li>
          <li class="no-padding"><a class="waves-effect waves-grey" href="dir-changepassword.php">Change Password</a></li>
    
                  <li class="no-padding"><a class="waves-effect waves-grey" href="Jomon.php">Sign Out</a></li>
                </ul>
             <?php } ?> 
              
                </div>
            </aside>