function initVolets() {
	var curhead = document.getElementById("tetiere"+mois);
	if (curhead) {
		curhead.className = "";
	}

	var curcorps = document.getElementById("corps"+mois);
	if (curhead) {
		curcorps.className = "";
	}
}


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
