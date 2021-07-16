      
function date_convert(f){
    var dt_str="";
if (parseInt(f.getDate())-10<0){
    dt_str+="0";
}
dt_str+=f.getDate()+"-";
if (parseInt(f.getMonth())-10<0){
    dt_str+="0";
}
dt_str+=parseInt(f.getMonth());
dt_str+="-";
dt_str+=f.getFullYear();

    return dt_str;
}
            var from_date_index=fl.tableHeaders.indexOf("From date");
            var to_date_index=fl.tableHeaders.indexOf("To date");
            function conv_dt(str){
                 var from =str.split("-");
     
var f = new Date(from[2],from[1]-1,from[0]);
return f;
            }
             
            function filterTable(){
                var filStr=[];
        var a="";
        var dept_array=values_array[0].concat(values_array[1]).concat(values_array[2]);
      if (dept_array.length>0){
          a=dept_array[0];
      }
        for (var i=1;i<dept_array.length;i++){
            a+="|"+dept_array[i];
        }
        filStr.push(a);
        for (var i=3;i<values_array.length;i++){
            var b="";
             if (values_array[i].length>0){
          b='^'+values_array[i][0]+'$';
      }
        for (var j=1;j<values_array[i].length;j++){
            b+="|"+'^'+values_array[i][j]+'$';
        }
        filStr.push(b);
        }
        for (var i=0;i<mappingArr.length;i++){
         if (mappingArr[i]!==-1){
          
                $('#example').DataTable().column(mappingArr[i]).search(filStr[i], true, false,true).draw();
         }
            
          $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
 
      
      
        if (from_date_index===-1 || to_date_index===-1){
            return true;
        }
        if (values_array[leave_date_index].length===0){
     
            return true;
        }
        var from_dt=data[from_date_index] || 0;
        var to_dt=data[to_date_index] || 0;
     var from =from_dt.split("-");
     
var f = new Date(from[2],from[1]-1,from[0]);

     var to =to_dt.split("-");
     
var t = new Date(to[2],to[1]-1,to[0]);

for (var i=0;i<values_array[leave_date_index].length;i++){
    
    if (conv_dt(values_array[leave_date_index][i])>=f && conv_dt(values_array[leave_date_index][i])<=t){
        return true;
    }
}
      
 return false;
    }
);
        }
        }
    