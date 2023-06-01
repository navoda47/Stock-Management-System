function currval(){
		  var values = $(':input').map(function() {
    if ((this.id !="")||(this.id =="userDropdown")){ return   $(this).val() ; }
}).get(); 
 return values;
}

function numcurrval(){
		  var values = $(':input[type=number]').map(function() {
    if ((this.id !="")||(this.id =="userDropdown")){ return   $(this).val() ; }
}).get(); 
 return values;
}



function shajax(url , data,oput){
 $.ajax({url: url,data: data , type: "POST", success: function(json) {$("#"+oput).html(json) ;  } }); 	
}

function currvalpid(){
		  var values = $(':input').map(function() {
    if ((this.id !="")||(this.id =="userDropdown")){ return   this.id +":"+ $(this).val() ; }
}).get(); 
 return values;
}
function curnumvalpid(){
		  var values = $(':input[type=number]').map(function() {
    if ((this.id !="")||(this.id =="userDropdown")){ return   this.id +":"+ $(this).val() ; }
}).get(); 
 return values;
}

function selectradio(){
		var values = $(':input[type=radio]').map(function() {
    if (this.selected ==true) { return   $(this).val() ; }
}).get(); 
 return values;
}

function caldf(codeval){
var icode=codeval.substr(1);
var s1=($("#s"+icode).val()=="")?0:parseFloat($("#s"+icode).val()); 
var m1=($("#m"+icode).val()=="")?0:parseFloat($("#m"+icode).val());
var l1=($("#l"+icode).val()=="")?0:parseFloat($("#l"+icode).val());
var x1=($("#x"+icode).val()=="")?0:parseFloat($("#x"+icode).val());
//var amt =parseFloat($("#c"+icode).val()) * parseFloat($("#q"+icode).val()); 
var bal=parseFloat($("#t"+icode).val())-( s1 + m1 + l1 +x1 );
$("#d"+icode).val(bal);
return 0;
}	


