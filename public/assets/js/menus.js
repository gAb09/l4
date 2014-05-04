function publication() {
	var trigger = document.getElementById("publication_0");
	var label0 = document.getElementById("publication0");
	var label1 = document.getElementById("publication1");
	alert(trigger.checked);

	if (trigger.checked === true) {
		alert('masqué');
		label0.className="nobr";
		label1.className="nobr muted";
	}else{
		alert('publié');
		label0.className="nobr muted";
		label1.className="nobr";
	}
}