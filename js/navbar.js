var br = document.getElementsByClassName("br");
br[0].style.height="55px";
function menu(){				
	var x=document.getElementById("navbar");
	var y=document.getElementById("icon");
	if (x.className === "navbar") {
		x.className += " responsive";
		y.style.backgroundColor = "#bbb";
		br[0].style.height="5px";
	}else{
		x.className = "navbar";
		y.style.backgroundColor = "#ddd";
		br[0].style.height="55px";
	}
}