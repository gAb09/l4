function volet(capt) {
	var tableau = capt.parentNode;
	var head = tableau.childNodes[3];
	var corps = tableau.childNodes[5];
	alert(head.className+'  '+corps.className);
	if (head.className == "replie") {
		head.className = "";
		corps.className = "";
	}else{
		head.className = "replie";
		corps.className = "replie";
	}

}
