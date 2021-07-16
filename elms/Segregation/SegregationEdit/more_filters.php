<?php
if ($page_title=="ADMIN | Dashboard" || $page_title=="REGISTRAR | Dashboard" ){
$more_filters=array("Leave Type","Applied date");

    
}
if ($page_title=="ADMIN | All Leaves"){
$more_filters=array("Status","Leave Type","From date","To date","Leave date");
}

if ($page_title=="REGISTRAR | Staff" || $page_title=="DIRECTOR | Staff"){
$more_filters=FALSE;
    }
if ($page_title=="REGISTRAR | All Leaves" || $page_title=="DIRECTOR | All Leaves" || $page_title=="HOD | All Leaves"  || $page_title=="HEAD | All Leaves" ){
$more_filters=array("Status","Leave Type","From date","To date","Leave date");
    }
    

if ($page_title=="ADMIN | Manage Employee"){
//$more_filters=array("Status","Leave Type","From date","To date","Applied date","Leave date");
    $more_filters=FALSE;
    }
if ($page_title=="ADMIN | View Employee"){
//$more_filters=array("Status","Leave Type","From date","To date","Applied date","Leave date");
  $more_filters=FALSE;
    }
    if ($page_title=="HOD | Dashboard"){
$more_filters=array("Leave Type","Applied date");

    
}if ($page_title=="HEAD | Dashboard"){
$more_filters=array("Leave Type","Applied date");

    
}

?>