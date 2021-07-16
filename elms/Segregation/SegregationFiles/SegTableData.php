<?php
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
$now=date("Y/m/d");
if($query->rowCount() > 0)
{
foreach($results as $result)
{    include 'SegregationEdit/SegEntriesData.php';
    ?>
<tr>
                                            <td> <b><?php echo htmlentities($cnt);?></b></td>
      <?php        for ($i=0;$i<count($table_array);$i++){
                                            if ($table_array[$i]=="$result->EmpId"){?>
                                                <?php if ($page_title=="ADMIN | Dashboard"){ ?>
                                             <td><a href="../admin/leave-details.php?leaveid=<?php echo htmlentities($result->lid);?>" target="_self"><?php echo htmlentities($result->EmpId);?></a></td>
                                             <?php } else if ($page_title=="ADMIN | All Leaves"){?>
                                                <td><a href="../admin/leavesadmin.php?leaveid=<?php echo htmlentities($result->lid);?>" target="_self"><?php echo htmlentities($result->EmpId);?></a></td>
                                            <?php } else if ($page_title=="REGISTRAR | Dashboard"){?>
                                                <td><a href="../dir-emp-leave-details.php?leaveid=<?php echo htmlentities($result->lid);?>" target="_self"><?php echo htmlentities($result->EmpId);?></a></td>
                                            <?php } else if ($page_title=="REGISTRAR | Staff"){?>
                                                <td><a href="../dirdetails.php?empid=<?php echo htmlentities($result->EmpId);?>" target="_self"><?php echo htmlentities($result->EmpId);?></a></td>
                                            <?php } else if ($page_title=="ADMIN | View Employee"){?>
                                                <td><a href="../admin/view-details.php?empid=<?php echo htmlentities($result->EmpId);?>" target="_self"><?php echo htmlentities($result->EmpId);?></a></td>
                                            <?php } else if ($page_title=="HOD | Dashboard" || $page_title=="HEAD | Dashboard"){?>
                                                <td><a href="../hod-emp-leavedetails.php?leaveid=<?php echo htmlentities($result->lid);?>" target="_self"><?php echo htmlentities($result->EmpId);?></a></td>
                                            <?php } else if ($page_title=="DIRECTOR | Staff"){?>
                                                <td><a href="../dirdetails.php?empid=<?php echo htmlentities($result->EmpId);?>" target="_self"><?php echo htmlentities($result->EmpId);?></a></td>
                                            <?php }else{ ?>
                                                <td><?php echo htmlentities($result->EmpId); ?></td>
                                       <?php } }else if ($table_array[$i]=="$result->Status"){  ?>
                                                      <td><?php $stats=$result->Status;
                                                 if($stats==1 && strtotime($result->ToDate) >= strtotime($now)){
                                                  ?>
                                                 <span style="color: green">Approved</span>
                                                 <?php } if($stats==2 && strtotime($result->ToDate) >= strtotime($now) )  { ?>
                                                <span style="color: red">Not Approved</span>
												<?php } if($stats==9 || $stats==10)  { 
												if( strtotime($result->ToDate) >= strtotime($now)){?>
                                                <span style="color: red">Not Eligible</span>
												<?php }} if($stats==3 && strtotime($result->ToDate) >= strtotime($now) )  { ?>
                                                <span style="color: darkred ">Forwarded</span>
                                                 <?php } if($stats==0 && strtotime($result->ToDate) >= strtotime($now) )  { ?>
                                                <span style="color: darkred">Submitted</span>
                                                  <?php } if($stats==5 && strtotime($result->ToDate) >= strtotime($now))  { ?>
                                                <span style="color: orangered">Cancelled</span>
												<?php } if($stats==7 && strtotime($result->ToDate) >= strtotime($now))  { ?>
                                                <span style="color: green">Recommended</span>
												<?php } if($stats==8 && strtotime($result->ToDate) >= strtotime($now))  { ?>
                                                <span style="color: red">Not Recommended</span>
												<?php } if($stats==5 || $stats==9 || $stats==10 || $stats==2 || $stats==3 || $stats==0 || $stats==7 || $stats==8){
													if( strtotime($result->ToDate) < strtotime($now))  { ?>
                                                <span style="color: orange">Not Used</span>
												
												  
													<?php }} if($stats==1){
												if(strtotime($result->ToDate) < strtotime($now))  { ?>
												<span style="color: darkgreen">Used</span>
												<?php } }?>
                                             </td>
    
                                          
                                             <?php }else if ($table_array[$i]=="Edit"){?>
                                                     <script>var confirm_msg='Do you want to delete?';
                                                     </script>   
 <td><a href='../admin/editemployee.php?empid=<?php echo htmlentities($result->id);?>'>edit <i class='fa fa-wrench' aria-hidden='true'></i></a><p style='display:inline;'>&nbsp;</p><p style='display:inline;'>&nbsp;</p><p style='display:inline;'>&nbsp;</p><p style='display:inline;'>&nbsp;</p>
     <a href='Segregation.php?del=<?php echo htmlentities($result->id)?> & file_type=Manage Employee' onclick='return confirm(confirm_msg)'>delete <i class='fa fa-close' style='color:red'></i></a></td>
                                             <?php }else{ ?>
           
                        <td><?php echo htmlentities($table_array[$i]);?></td>
                               
                                            <?php }} ?>            
                                    </tr>
                                         <?php $cnt++;}} ?>
                                    

