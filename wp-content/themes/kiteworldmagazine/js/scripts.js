function showCountry(str) {
  if (str=="") {
    document.getElementById("countries").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest) {
    xmlhttp=new XMLHttpRequest();
  } else {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    	document.getElementById("countries").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","http://in-brighton.com/kiteworld/wp-content/themes/kiteworldmagazine/custom/search.php?c="+str,true);
  xmlhttp.send();
}