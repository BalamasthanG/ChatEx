function callEvent(obj,id){
	var httpRequest;
	if(window.XMLHttpRequest){
		httpRequest = new XMLHttpRequest();
	}else{
		httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
	}
		
	httpRequest.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if(id === 'member_card'){
				if(document.getElementById(id).classList.contains("overlay_off")){
					document.getElementById(id).classList.remove("overlay_off");
				}
				document.getElementById(id).classList.add("overlay_on");
			}else if(id === 'reload'){
				window.location.reload(true);
			}
			document.getElementById(id).innerHTML = this.responseText;
		}
	}
	
	httpRequest.open("GET", "/ChatEx/php/ResponseJs.php?paramId="+obj.id+"&paramValue="+obj.value, true);
	httpRequest.send();
}

function overlayOff(obj){
	document.getElementById(obj.id).classList.remove("overlay_on");
	document.getElementById(obj.id).classList.add("overlay_off");
}
