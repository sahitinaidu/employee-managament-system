<?php
if ($page_title=="ADMIN | Dashboard"){
$query_array=array("select DepartmentName,count(tblleaves.EmpId) as ct from tbldepartments left outer join tblleaves on tblleaves.Department=tbldepartments.DepartmentName and tblleaves.Status='0' group by tbldepartments.DepartmentName order by tbldepartments.DepartmentName asc;","select schoolName,count(tblleaves.EmpId) as ct from tblschools left outer join tblleaves on tblleaves.Department=tblschools.schoolName and tblleaves.Status='0' group by tblschools.schoolName order by tblschools.schoolName asc;","select sectionName,count(tblleaves.EmpId) as ct from tblsections left outer join tblleaves on tblleaves.Department=tblsections.sectionName and tblleaves.Status='0' group by tblsections.sectionName order by tblsections.sectionName asc;");
}
if ($page_title=="ADMIN | All Leaves"){
$query_array=FALSE;
}

if ($page_title=="DIRECTOR | Staff"){
$query_array=FALSE;
}
if ($page_title=="DIRECTOR | All Leaves"){
$query_array=FALSE;
}

if ($page_title=="REGISTRAR | Dashboard"){
$query_array=array("SELECT DISTINCT tbldepartments.DepartmentName, COUNT(tblleaves.id) as ct  from tblleaves join  tblemployees  on tblleaves.empid=tblemployees.id and ( CASE  when (tblemployees.reportingto='registrar@nitandhra.ac.in' && CURRENT_DATE<ToDate) then (tblleaves.Status='3' or tblleaves.Status='10')  
                          Else (tblleaves.Status='7' or tblleaves.Status='8') END )  right outer join tbldepartments on tbldepartments.DepartmentName=tblleaves.Department  group by tbldepartments.DepartmentName order by tbldepartments.DepartmentName asc ","SELECT DISTINCT tblschools.schoolName, COUNT(tblleaves.id) as ct from tblleaves join  tblemployees  on tblleaves.empid=tblemployees.id and ( CASE  when (tblemployees.reportingto='registrar@nitandhra.ac.in' && CURRENT_DATE<ToDate) then (tblleaves.Status='3' or tblleaves.Status='9')  
                          Else (tblleaves.Status='7' or tblleaves.Status='8') END )  right outer join tblschools on tblschools.schoolName=tblleaves.Department  group by tblschools.schoolName order by tblschools.schoolName asc ","SELECT DISTINCT tblsections.sectionName, COUNT(tblleaves.id) as ct from tblleaves join  tblemployees  on tblleaves.empid=tblemployees.id and ( CASE  when (tblemployees.reportingto='registrar@nitandhra.ac.in' && CURRENT_DATE<ToDate) then (tblleaves.Status='3' or tblleaves.Status='9')  
                          Else (tblleaves.Status='7' or tblleaves.Status='8') END )  right outer join tblsections on tblsections.sectionName=tblleaves.Department  group by tblsections.sectionName order by tblsections.sectionName asc ");
}
if ($page_title=="REGISTRAR | Staff"){
$query_array=FALSE;
}
if ($page_title=="REGISTRAR | All Leaves"){
$query_array=FALSE;
}

if ($page_title=="ADMIN | Manage Employee"){
$query_array=FALSE;
}
if ($page_title=="ADMIN | View Employee" || $page_title=="HOD | Dashboard" ){
$query_array=FALSE;
}
?>