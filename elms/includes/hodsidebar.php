     <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper">
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-info">
                    <?php 
$hid=$_SESSION['hid'];
$sql = "SELECT FirstName,LastName,HodId from  tblhod where id=:hid";
$query = $dbh -> prepare($sql);
$query->bindParam(':hid',$hid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                <p><?php echo htmlentities($result->FirstName." ".$result->LastName);?></p>
                                <span><?php echo htmlentities($result-HodId)?></span>
                         <?php }} ?>
                        </div>
                    </div>
              <?php  if (isset($_GET['file_type'])){?>
                  
              
                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
  
   <li class="no-padding"><a class="waves-effect waves-grey" href="Segregation.php?file_type=Dashboard">DashBoard</a></li>
   <li class="no-padding"><a class="waves-effect waves-grey" href="../hod-staff.php">Staff</a></li>
				   <li class="no-padding"><a class="waves-effect waves-grey" href="Segregation.php?file_type=All Leaves">All Leaves</a></li>
                   <li class="no-padding"><a class="waves-effect waves-grey" href="../hod-changepassword.php">Change Password</a></li>
	<li class="no-padding"><a class="waves-effect waves-grey" href="../jomon.php">Sign Out</a></li>
                                
                </ul>
<?php }else{?>
                      <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
  
   <li class="no-padding"><a class="waves-effect waves-grey" href="Segregation/Segregation.php?file_type=Dashboard">DashBoard</a></li>
   <li class="no-padding"><a class="waves-effect waves-grey" href="hod-staff.php">Staff</a></li>                
   <li class="no-padding"><a class="waves-effect waves-grey" href="Segregation/Segregation.php?file_type=All Leaves">All Leaves</a></li>
                   <li class="no-padding"><a class="waves-effect waves-grey" href="hod-changepassword.php">Change Password</a></li>
	<li class="no-padding"><a class="waves-effect waves-grey" href="jomon.php">Sign Out</a></li>
                                
                </ul>
<?php }?>
                </div>
            </aside>