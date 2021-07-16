<?php



if ($page_title=="REGISTRAR | Staff" || $page_title=="DIRECTOR | Staff"){
$table_array=array("$result->EmpId","$result->FirstName"." "."$result->LastName","$result->Department");
}

if ($page_title=="REGISTRAR | All Leaves" || $page_title=="DIRECTOR | All Leaves" ){
$table_array=array("$result->EmpId","$result->Department","$result->LeaveType",convertDate("$result->FromDate"),convertDate("$result->ToDate"),"$result->Status");
}
if ($page_title=="ADMIN | Dashboard" || $page_title=="REGISTRAR | Dashboard"  ){
$table_array=array("$result->EmpId","$result->Department","$result->LeaveType", convertDate("$result->PostingDate"),"$result->Status");
}

if ($page_title=="ADMIN | All Leaves"){
$table_array=array("$result->EmpId","$result->Department",convertDate("$result->FromDate"),convertDate("$result->ToDate"),"$result->LeaveType","$result->Status");
}

if ($page_title=="ADMIN | Manage Employee"){
$table_array=array("$result->EmpId","$result->FirstName"." "."$result->LastName","$result->Department","Edit");


}
if ($page_title=="ADMIN | View Employee"){
$table_array=array("$result->EmpId","$result->FirstName"." "."$result->LastName","$result->Department");
}
if ($page_title=="HOD | Dashboard"){
$table_array=array("$result->EmpId","$result->LeaveType", convertDate("$result->PostingDate"),"$result->Status");
}
if ($page_title=="HOD | All Leaves"  ){
$table_array=array("$result->EmpId","$result->LeaveType",convertDate("$result->FromDate"),convertDate("$result->ToDate"),"$result->Status");
}
if ($page_title=="HEAD | Dashboard"){
$table_array=array("$result->EmpId","$result->LeaveType", convertDate("$result->PostingDate"),"$result->Status");
}
if ($page_title=="HEAD | All Leaves"  ){
$table_array=array("$result->EmpId","$result->LeaveType",convertDate("$result->FromDate"),convertDate("$result->ToDate"),"$result->Status");
}
?>