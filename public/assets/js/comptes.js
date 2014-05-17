function togle_actif() {
	var label = document.getElementById("actif_label");
	var check = document.getElementById("actif_check");

	if (check.checked === true)
	{
		label.innerHTML = "Compte activé";
	}
	else
	{
		label.innerHTML = "Compte désactivé";
	}
}