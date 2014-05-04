function justifRequis() {
	var trigger = document.getElementById("req_justif_0");
	var div = document.getElementById("req_justif_div");
	var label0 = document.getElementById("label0");
	var label1 = document.getElementById("label1");
	// alert(trigger.checked);

	if (trigger.checked === true) {
		// alert('non requis');
		label0.className="nobr";
		label1.className="nobr muted";
		div.className="invisible";
	}else{
		// alert('requis');
		label0.className="nobr muted";
		label1.className="nobr";
		div.className="";
	}
}