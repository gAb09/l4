function volet(capt) {
	var tableau = capt.parentNode;
	var head = tableau.childNodes[3];
	var corps = tableau.childNodes[5];
	if (head.className == "replie") {
		head.className = "";
		corps.className = "";
	}else{
		head.className = "replie";
		corps.className = "replie";
	}

}
	if (mois) {
		var curhead = document.getElementById("corps"+mois);
		var curcorps = document.getElementById("tetiere"+mois);
		curhead.className = "";
		curcorps.className = "";
	}

