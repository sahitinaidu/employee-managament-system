
<?php 
 if ($page_title=="DIRECTOR | Staff"){
    $sql= "SELECT EmpId,FirstName,LastName,Department from tblemployees where reportingto<>'null';";
}else if ($page_title=="DIRECTOR | All Leaves"){
    $sql = "SELECT tblleaves.id as lid,tblleaves.FromDate,tblleaves.ToDate,tblemployees.Department,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id and tblemployees.reportingto<>'null' Order by lid desc ";
}

else if ($page_title=="REGISTRAR | Dashboard"){
    $sql = "SELECT DISTINCT tblleaves.id as lid,tblemployees.Department,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.PostingDate,tblleaves.Status  from tblleaves join  tblemployees  on tblleaves.empid=tblemployees.id and ( CASE  when (tblemployees.reportingto='registrar@nitandhra.ac.in' && CURRENT_DATE<ToDate) then (tblleaves.Status='3' or tblleaves.Status='9' or tblleaves.Status='10' )  
                          Else (tblleaves.Status='7' or tblleaves.Status='8') END )   order by lid DESC";
}else if ($page_title=="REGISTRAR | Staff"){
    $sql= "SELECT EmpId,FirstName,LastName,Department from tblemployees where reportingto<>'director@nitandhra.ac.in' and reportingto<>'null';";
}else if ($page_title=="REGISTRAR | All Leaves"){
    $sql = "SELECT tblleaves.id as lid,tblleaves.FromDate,tblleaves.ToDate,tblemployees.Department,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id and tblemployees.reportingto<>'director@nitandhra.ac.in' and tblemployees.reportingto<>'null' Order by lid desc ";
}
else if ($page_title=="ADMIN | Dashboard"){
    $sql = "SELECT tblleaves.id as lid,tblemployees.Department,tblemployees.FirstName,tblleaves.ToDate,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id and tblleaves.Status='0' Order by lid desc ";
}else if ($page_title=="ADMIN | All Leaves"){
    $sql = "SELECT tblleaves.id as lid,tblleaves.FromDate,tblleaves.ToDate,tblemployees.Department,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id Order by lid desc ";
}else if ($page_title=="ADMIN | Manage Employee"){
    $sql = "SELECT id,EmpId,Department,FirstName,LastName from tblemployees";
}else if ($page_title=="ADMIN | View Employee"){
   $sql = "SELECT Department,FirstName,LastName,EmpId from tblemployees";
}else if ($page_title=="HOD | Dashboard"){
   $sql="SELECT DISTINCT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.PostingDate,tblleaves.Status from tblleaves join  tblemployees  on tblleaves.empid=tblemployees.id where tblemployees.reportingto='$login_id' and CURRENT_DATE<ToDate and  (tblleaves.Status='3' or tblleaves.Status='9') order by lid desc";
}else if ($page_title=="HOD | All Leaves"){
   $sql = "SELECT tblleaves.id as lid,tblleaves.FromDate,tblleaves.ToDate,tblemployees.Department,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblemployees.reportingto='$login_id' Order by lid desc ";
}
else if ($page_title=="HEAD | Dashboard"){
   $sql="SELECT DISTINCT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.PostingDate,tblleaves.Status from tblleaves join  tblemployees  on tblleaves.empid=tblemployees.id where tblemployees.reportingto='$login_id' and CURRENT_DATE<ToDate and  (tblleaves.Status='3' or tblleaves.Status='9') order by lid desc";
}else if ($page_title=="HEAD | All Leaves"){
   $sql = "SELECT tblleaves.id as lid,tblleaves.FromDate,tblleaves.ToDate,tblemployees.Department,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblemployees.reportingto='$login_id' Order by lid desc ";
}
    







?>