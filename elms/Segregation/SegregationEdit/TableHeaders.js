if (document.title==="REGISTRAR | Staff" || document.title==="DIRECTOR | Staff"){
    fl=new Seg(["SNo","Emp ID","Name","Department"]);
}else if (document.title==="REGISTRAR | All Leaves" || document.title==="DIRECTOR | All Leaves"  ){
    fl=new Seg(["SNo","Employee ID","Department","Leave Type","From date","To date","Status"]);
}
else if (document.title==="ADMIN | Dashboard" || document.title==="REGISTRAR | Dashboard"){
    
    fl=new Seg(["SNo","Employee ID","Department","Leave Type","Applied date","Status"]);
}else if (document.title==="ADMIN | All Leaves"){
       fl=new Seg(["SNo","Employee ID","Department","From date","To date","Leave Type","Status"]);
}else if (document.title==="ADMIN | Manage Employee"){
       fl=new Seg(["SNo","Employee ID","Name","Department","Action"]);
}else if (document.title==="ADMIN | View Employee"){
       fl=new Seg(["SNo","Employee ID","Name","Department"]);
}else if (document.title==="HOD | Dashboard"){
       fl=new Seg(["SNo","Employee ID","Leave Type","Applied date","Status"]);
}else if (document.title==="HOD | All Leaves"  ){
    fl=new Seg(["SNo","Employee ID","Leave Type","From date","To date","Status"]);
}else if (document.title==="HEAD | Dashboard"){
       fl=new Seg(["SNo","Employee ID","Leave Type","Applied date","Status"]);
}else if (document.title==="HEAD | All Leaves"  ){
    fl=new Seg(["SNo","Employee ID","Leave Type","From date","To date","Status"]);
}
