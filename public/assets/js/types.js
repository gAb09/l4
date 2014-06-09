function justifToggle() {
	var label = document.getElementById("justif_label");
	var check = document.getElementById("justif_check");
	var div = document.getElementById("req_justif_div");

	if (check.checked === true)
	{
		label.innerHTML = "Champ “Justificatif” requis";
		div.className="";
	}
	else
	{
		label.innerHTML = "Champ “Justificatif” non requis";
		div.className="invisible";
	}
}