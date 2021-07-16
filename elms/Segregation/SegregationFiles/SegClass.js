
class Seg {
  constructor(tableHeaders) {
    this.tableHeaders = tableHeaders;
    this.str='<tr>';
   
    for (var j=0;j<this.tableHeaders.length;j++){
                
            this.str+='<th>'+this.tableHeaders[j]+'</th>';
                }
                this.str+='</tr>';
   document.getElementsByTagName('thead')[0].innerHTML=this.str; 
  }
}