function callEvent(obj){
	var httpRequest;
	if(window.XMLHttpRequest){
		httpRequest = new XMLHttpRequest();
	}else{
		httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
	}
		
	httpRequest.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			document.getElementById(id).innerHTML = this.responseText;
		}
	}
	
	httpRequest.open("GET", "/ChatEx/php/ResponseJs.php?paramId="+obj.id+"&paramValue="+obj.value, true);
	httpRequest.send();
}
