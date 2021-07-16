 $('#myInput').keyup(function(){
       $('#example').DataTable().search($(this).val()).draw() ;
});
$('#selPage').change( function() { 
    $('#example').DataTable().page.len( $(this).val() ).draw();
});

$(window).load( function() {
  $('#selPage').val($("#selPage option:first").val());
  $('#example').DataTable().page.len( $("#selPage option:first").val() ).draw();
} ); 

            $('.dropdown-toggle').first().on("click", function(e){
       $('.dropdown-submenu a.test').next('ul').hide();  
      controlCheckFlag=false;
       document.getElementsByClassName('container')[1].getElementsByTagName('ul')[0].style.display='none';
  });
    $('.dropdown-toggle').eq(1).on("click", function(e){
      
            $(this).next('ul').toggle();
            $('.dropdown-submenu a.test').next('ul').hide();  

  });
$('.dropdown-submenu a.test').next('ul').children().on("click",function(e){  
  
      if ($(this).is('.calClass') || $(this).is('.date')){
    
      }else{
  
  if ($(this).children().find("i").css('visibility') === 'hidden' )
    $(this).children().find("i").css('visibility','visible');
  else{
    $(this).children().find("i").css('visibility','hidden');
    $(this).parent().children().first().find('i').css('visibility','hidden');
    $(this).parent().parent().find('i').first().css('visibility','hidden');
    }
   
for (var k=0;k<document.getElementsByClassName('dropdown-submenu').length-document.getElementsByClassName('date').length;k++){
            if (document.getElementsByClassName('dropdown-submenu')[k].getElementsByTagName('ul')[0].getElementsByTagName('li')[0].getElementsByTagName('a')[0].getElementsByTagName('i')[0].style.visibility==='visible'){
                for (var l=0;l<document.getElementsByClassName('dropdown-submenu')[k].getElementsByTagName('ul')[0].getElementsByTagName('li').length;l++)
                document.getElementsByClassName('dropdown-submenu')[k].getElementsByTagName('ul')[0].getElementsByTagName('li')[l].getElementsByTagName('a')[0].getElementsByTagName('i')[0].style.visibility='visible';
       if ($(this).parent().find('i').first().css('visibility')==="visible")
                $(this).parent().parent().find('i').first().css('visibility','visible');
            }else{
                var flag=true;
                for (var l=1;l<document.getElementsByClassName('dropdown-submenu')[k].getElementsByTagName('ul')[0].getElementsByTagName('li').length;l++)
                { 
                flag=flag&(document.getElementsByClassName('dropdown-submenu')[k].getElementsByTagName('ul')[0].getElementsByTagName('li')[l].getElementsByTagName('a')[0].getElementsByTagName('i')[0].style.visibility==='visible');
                }
                if (flag===1){
      
                    document.getElementsByClassName('dropdown-submenu')[k].getElementsByTagName('ul')[0].getElementsByTagName('li')[0].getElementsByTagName('a')[0].getElementsByTagName('i')[0].style.visibility='visible'
    document.getElementsByClassName('dropdown-submenu')[k].getElementsByTagName('i')[0].style.visibility='visible';
                   
       }
            }
        }
    
           arrangeTags();
      }
      
      e.stopPropagation();
      e.preventDefault();
    });
    $('.dropdown-submenu a.test').on("click", function(e){
var s=$(this).parent().parent().parent().find('button').html();
var n=s.substring(0,s.indexOf("<i")).trim().toUpperCase();
 //controlCheckFlag=true;
 if (n==="MORE FILTERS"){
    var visFlag;
      if ($(this).next('ul').is(":visible")){
    visFlag=true;
      }else{
            visFlag=false;
            }
            $('.dropdown-submenu a.test').next('ul').hide();  
        $('.datepicker').hide();
        if (!visFlag){
            
        $(this).next('ul').show();
        
            $(this).next('ul').find('input').focus();
            
                e.stopPropagation();
                e.preventDefault();
         for (var r=0;r<document.getElementsByClassName('date').length;r++){       
                var refArr=values_array[document.getElementsByClassName('selAll').length+r];
                //document.getElementsByClassName('datepicker')[r].getElementsByClassName('clear')[0].click();
               
             
            }   
        }
        
        }else{
            if ($(this).next('ul').is(':visible')){
            $(this).next('ul').hide();
        }else{
        
            $('.dropdown-submenu a.test').next('ul').hide();  
            $(this).next('ul').show();
        }}
    e.stopPropagation();
    e.preventDefault();
    
});
  $('.dropdown-submenu a.test').next('ul').on("click", function(e){
      
 //controlCheckFlag=true;
  e.stopPropagation();
    e.preventDefault();
  });
  

for (var i=0;i<document.getElementsByClassName('fa fa-check').length;i++){
    document.getElementsByClassName('fa fa-check')[i].style.visibility='hidden';
}
      
              
        $(window).load(function(){

    $('.date').datepicker({
      multidate: true,
  format: 'dd-mm-yyyy',
   orientation: "top" ,
    clearBtn: true
    });
$('.date').focus();
	
    $('.date').datepicker().on('changeDate', function (ev) {
        controlCheckFlag=true;
        
   });
   $('.date').datepicker().on('changeMonth', function (ev) {
   controlCheckFlag=true;
   
   });
   
   $('.date').datepicker().on('changeYear', function (ev) {
   controlCheckFlag=true;
   
   });
   window.addEventListener('click', function(e){
    for (var t=0;t<document.getElementsByClassName('datepicker').length;t++){
        
        if (document.getElementsByClassName('datepicker')[t].contains(e.target)){   
        if (document.getElementsByClassName('clear')[0].contains(e.target)){
            
                e.stopPropagation();
                e.preventDefault();
        }
                controlCheckFlag=true;
            
        }
    }
        if (document.getElementsByClassName('dropdown-toggle')[1] && document.getElementsByClassName('dropdown-toggle')[1].contains(e.target)){   
            controlCheckFlag=true;
            
        }
if (!controlCheckFlag){
    document.getElementsByClassName('container')[1].getElementsByTagName('ul')[0].style.display='none';
}
controlCheckFlag=false;
    });
$('.date').change(function(){


       document.getElementsByClassName('dropdown-submenu')[0].getElementsByTagName('ul')[0].getElementsByTagName('li')[1].click();
       document.getElementsByClassName('dropdown-submenu')[0].getElementsByTagName('ul')[0].getElementsByTagName('li')[1].click();
});

        
});
 
     
         
function addTag(a,no_1){
document.getElementById('tagsDiv').innerHTML+='<button class="tagButton" type="button" >'+a+'<i style="margin-left:5px;" onclick="closeTag(this,'+no_1+');" class="fa fa-times" aria-hidden="true"></i></button>';
    
}
function clear(){
    document.getElementById('tagsDiv').innerHTML='';
    }
 function clearAll(){
     while(document.getElementsByClassName('fa fa-times').length!==0){
        document.getElementsByClassName('fa fa-times')[0].click();
    }
   clear();
 }
 function closeTag(a,no_2){
     var b=''+no_2;
     if (b.indexOf("_")!==-1){

    var first_level=parseInt(b.substring(0,1));
    var arr_val=b.substring(2);
  
  
        const index = values_array[document.getElementsByClassName('selAll').length+first_level].indexOf(arr_val);
        
if (index > -1) {
  values_array[document.getElementsByClassName('selAll').length+first_level].splice(index, 1);
}
if (values_array[document.getElementsByClassName('selAll').length+first_level].length>0)
$('.date').eq(first_level).datepicker('setDates',values_array[document.getElementsByClassName('selAll').length+first_level]);
else
$('.date').eq(first_level).datepicker('setDates',null);
        }else{
          a.parentElement.style.display="none";
        var w=0,sm=0,rem=0,y=0;
        for (var l=0;l<document.getElementsByClassName('dropdown-submenu').length;l++){
           y=sm;
            sm+=sub_arr[l];
            if(no_2<sm){
                w=l;
                rem=no_2-y+1;
                break;
            }
            
    }
  
    
    document.getElementsByClassName('dropdown-submenu')[w].getElementsByTagName('ul')[0].getElementsByTagName('li')[rem].click();
    }	
 }
 function arrangeTags(){
 
       values_array=[];
       for (var i=0;i<sub_arr.length;i++){
            var a=[];
            values_array.push(a);
       }
       var q=0,s1=0;
       s1=s1+sub_arr[q];
       clear();
       for (var i=0;i<document.getElementsByClassName('sub1').length;i++){
        while (i>=s1 && i<document.getElementsByClassName('sub1').length){      
        q++;
          s1=s1+sub_arr[q];
        }
       if (document.getElementsByClassName('sub1')[i].getElementsByTagName('a')[0].getElementsByTagName('i')[0].style.visibility==="visible"){
           var str=document.getElementsByClassName('sub1')[i].getElementsByTagName('div')[0].innerHTML;
                addTag(str.substring(0,str.indexOf("<span")).trim(),i);
               

                   values_array[q].push(str.substring(0,str.indexOf("<span")).trim());
                
       }
       }
       q=document.getElementsByClassName('selAll').length-1;
       for (var j=0;j<document.getElementsByClassName('date').length;j++){
         q++;   
       if ($('.date').eq(j).val().length>0){
       
       date_array=$('.date').eq(j).val().split(',');
       for (var i=0;i<date_array.length;i++){
         var tr="'"+j+"_"+date_array[i]+"'";
           addTag(date_array[i],tr);
           values_array[q].push(date_array[i]);
            }
       }
       }
       if (document.getElementsByClassName('fa fa-times').length!==0)
       document.getElementById('tagsDiv').innerHTML+='<label style="cursor:pointer;" onclick="clearAll();">CLEAR ALL</label>';
       filterTable();
    
   }
   var mappingArr=[];
        mappingArr.push(fl.tableHeaders.indexOf("Department"));
        
 