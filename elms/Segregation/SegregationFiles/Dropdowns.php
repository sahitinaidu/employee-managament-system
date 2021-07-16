<?php $more=TRUE; $division=TRUE;?>  
<div style="margin-right:0px; width: 5%; padding-right: 0px; float:left;"class="dataTables_length1" id="example_length">
                                        <label>
                                            Show
                                            <select id="selPage" style="width: 100%;border-color:rgba(0,0,0,0.2); color: rgba(0,0,0,0.6);" name="example_length" aria-controls="example" class="browser-default">
                                                <option value="10" selected="selected">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </label>
                                    </div>
                                          

<div class="input-icons" style="margin-top: 11px;width:25%; float:right;">
                                            <i class="fa fa-search icon" aria-hidden="true"></i>
                                            <input type="text" class="input-field" id="myInput" placeholder="Search .." title="search records">
                                        </div>
                                  
                                  
                                        <div class="container" style="margin-top: 17px;float:left;width: 35%;padding-left: 4%;padding-right: 2%;margin-left: 0px;margin-right: 0px;">                                    
                                            
  <div class="dropdown">
  
      <button id="selButton" class="btn btn-default dropdown-toggle" style="width:100%;" type="button" data-toggle="dropdown">Select division

    
<i class="fa fa-caret-down" aria-hidden="true" style="float:right; vertical-align:middle; "></i>
        <div style="float:right; margin-left: 5px;">
  <i class="fa fa-bell-o" style="font-size: 20px; float: left; color: black">
        </i>
       
  
            <span style="top:-0.95px; right:13.2px;"class="badge1 badge-danger1">6</span>
</div>
    </button>
    <ul class="dropdown-menu" style="width: 100%;">
        <script> var sum1=0,sub_arr=[];
        
var controlCheckFlag=false;
        </script>
        <?php 
        $div_array=array("Departments","Schools","Sections");
        for ($i=0;$i<count($div_array);$i++){
        ?>
<li class="dropdown-submenu">
    
    <a class="test" tabindex="-1" href="#" style="padding-left: 0px!important;padding-right:0px!important;">
        <i style="float:left; color: green; margin-right: 5px;font-size: 16px;margin-left: 2px;margin-top: 2px;" class="fa fa-check" aria-hidden="true"></i>
        <?php echo $div_array[$i];?>
          <div style="float:right; margin-left: 5px; ">
              
              
       <i style="float:left;font-size: 22px;" class="fa fa-caret-right" aria-hidden="true"></i>
  
       <span style="right:5.8px; top: -6.5px;" class="badge1 badge-danger1"></span>
</div>
        </a>
        <ul class="dropdown-menu" style=" max-height: 300px !important;
            overflow-y:scroll !important;margin-top: -6px;">
            <?php
            
            include 'SegregationEdit/notification.php';
            if ($query_array==FALSE){
                $notifications=FALSE;
            $query_array=array("select DepartmentName,count(tblleaves.EmpId) as ct from tbldepartments left outer join tblleaves on tblleaves.Department=tbldepartments.DepartmentName and tblleaves.Status='' group by tbldepartments.DepartmentName order by tbldepartments.DepartmentName asc;","select schoolName,count(tblleaves.EmpId) as ct from tblschools left outer join tblleaves on tblleaves.Department=tblschools.schoolName and tblleaves.Status='0' group by tblschools.schoolName order by tblschools.schoolName asc;","select sectionName,count(tblleaves.EmpId) as ct from tblsections left outer join tblleaves on tblleaves.Department=tblsections.sectionName and tblleaves.Status='0' group by tblsections.sectionName order by tblsections.sectionName asc;");
            }
            $sql=$query_array[$i];
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;?>
            <li class="SelAll"> <a style="padding-left:0px!important;" tabindex="-1" href="#">
            <i style="float:left; color: green; margin-right: 5px;font-size: 16px;margin-left: 2px;margin-top: 2px;" class="fa fa-check" aria-hidden="true"></i>
       
                    <div style="text-align: left; margin-left: 5px;">
            Select all
                
            </div>
          </a> 
        </li>
  
            <script>
                var sum=0,cnt=0,values_array=[];
            </script>        
    <?php
if($query->rowCount() > 0)
{
foreach($results as $result)
{ $res_array=array("$result->DepartmentName","$result->schoolName","$result->sectionName");
            ?>
            <li class="sub1"> <a style="padding-left:0px!important;" tabindex="-1" href="#">
                    
                    <i style="float:left; color: green; margin-right: 5px;font-size: 16px;margin-left: 2px;margin-top: 2px;" class="fa fa-check" aria-hidden="true"></i>
       
                    <div style="text-align: left; margin-left: 5px;">
  <?php echo $res_array[$i]; ?>
                <span style="top:-6px; right: 9px;"class="badge1 badge-danger1"><?php echo $result->ct; ?></span>
                <script>
                    sum+=parseInt("<?php echo $result->ct; ?>");
                  cnt++;
                </script>
            </div>
          </a> 
        </li>
  
                <?php $cnt++;}} ?>
        <script>
            var i="<?php echo $i?>";
            document.getElementsByClassName('dropdown-submenu')[i].getElementsByTagName('span')[0].innerHTML=sum;
            sum1+=sum;
            
    for (var j=0;j<document.getElementsByClassName('badge1 badge-danger1').length;j++){
          if (document.getElementsByClassName('badge1 badge-danger1')[j].innerHTML==="0"){
              document.getElementsByClassName('badge1 badge-danger1')[j].style.visibility='hidden';
          }
      }
      sub_arr.push(cnt);
        </script>
  </ul>
      </li>
        <?php } ?>
      <script>
    document.getElementsByClassName('dropdown')[0].getElementsByTagName('span')[0].innerHTML=sum1;
    if (sum1===0){
        document.getElementsByClassName('dropdown')[0].getElementsByTagName('span')[0].style.visibility='hidden';
    }

      </script>
    </ul>
  
</div>
                                </div>
                                          
                                   <div class="container" style="margin-top: 17px;float:right;width: 35%;padding-left: 2%;padding-right: 4%;margin-left: 0px;margin-right: 0px;">                                    
  <div class="dropdown">
  
      <button role="button" class="btn btn-default dropdown-toggle" style="width:100%;" type="button" >More Filters
<i class="fa fa-caret-down" aria-hidden="true" style="float:right; vertical-align:middle; "></i>        
    </button>
    <ul class="dropdown-menu" style="width: 100%;">
        <?php include 'SegregationEdit/more_filters.php';
        if ($more_filters==FALSE){
            $more=FALSE;
            $more_filters=array("Leave Type","Applied date");
        }
        for ($i=0;$i<count($more_filters);$i++){?>
            
            <script>
                var sum=0,cnt=0;
            </script>     
      <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#" style="padding-left: 0px!important;padding-right:0px!important;">
        <i style="float:left; color: green; margin-right: 5px;font-size: 16px;margin-left: 2px;margin-top: 2px;" class="fa fa-check" aria-hidden="true"></i>
        <?php echo $more_filters[$i]; ?>
        <div style="float:right; margin-left: 5px; ">
              
       <i style="float:left;font-size: 22px; margin-right: 10px;" class="fa fa-caret-right" aria-hidden="true"></i>

           
</div>
          </a>  
      
         <?php if ($more_filters[$i]=="From date" || $more_filters[$i]=="To date" || $more_filters[$i]=="Applied date" || $more_filters[$i]=="Leave date" ){?>
         
                
          <ul class="dropdown-menu" style="opacity:0 ;width: 100%; margin-top: -6px;">
             
              <input type="text" style="transform: translate(0px,-50px);" class="form-control date" placeholder="Pick the multiple dates">
              <script>
           
                  cnt++;
                </script>
                
                        <span></span>
                          <?php   if ($more_filters[$i]=="Leave date"){ ?>
             <script>
                 leave_date_index="<?php echo $i; ?>";
                 leave_date_index= parseInt(leave_date_index)+3;
                          </script>
            <?php  } ?>
          <?php }else{  ?>
                        
          <ul class="dropdown-menu" style=" margin-top: -6px;">
                    <li class="SelAll"> <a style="padding-left:0px!important;" tabindex="-1" href="#">
            <i style="float:left; color: green; margin-right: 5px;font-size: 16px;margin-left: 2px;margin-top: 2px;" class="fa fa-check" aria-hidden="true"></i>
       
                    <div style="text-align: left; margin-left: 5px;">
            Select all
                
            </div>
          </a> 
        </li>
           
            
    <?php $stat_arr=array("Approved","Not Approved","Recommended","Not Recommended","Used","Not Used","Submitted","Forwarded","Cancelled","Not Eligible");
    if ($more_filters[$i]=="Status"){
        for ($j=0;$j<count($stat_arr);$j++){
        ?>
            <li class="sub1"> <a style="padding-left:0px!important;" tabindex="-1" href="#">
                    
                    <i style="float:left; color: green; margin-right: 5px;font-size: 16px;margin-left: 2px;margin-top: 2px;" class="fa fa-check" aria-hidden="true"></i>
       
                    <div style="text-align: left; margin-left: 5px;">
  <?php echo $stat_arr[$j]; ?>
                         
                        <span></span>
                         <script>
                  cnt++;
                </script>
            </div>
          </a> 
        </li>
  
    <?php  }?>
    <?php }else if ($more_filters[$i]=="Leave Type"){
          $sql_11="select LeaveType from tblleavetype";
            
$query11 = $dbh -> prepare($sql_11);
$query11->execute();
$results11=$query11->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results11 as $result){?>
      <li class="sub1"> <a style="padding-left:0px!important;" tabindex="-1" href="#">
                    
                    <i style="float:left; color: green; margin-right: 5px;font-size: 16px;margin-left: 2px;margin-top: 2px;" class="fa fa-check" aria-hidden="true"></i>
       
                    <div style="text-align: left; margin-left: 5px;">
  <?php echo $result->LeaveType; ?>
                         
                        <span></span>
                         <script>
                  cnt++;
                </script>
            </div>
          </a> 
        </li>
<?php }}
}
        
          } ?>
        
                 <script>
          sub_arr.push(cnt);
        </script>   
        </ul>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
                                      </div>
                                   <br>
                                        <br>
                                        <br>
                                        <br>
                                    <div id="tagsDiv" style="width:100%;"></div>      
                                    