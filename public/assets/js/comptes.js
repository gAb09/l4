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

function togle_lmh() {
	var label = document.getElementById("lmh_label");
	var check = document.getElementById("lmh_check");
	var div = document.getElementById("description_lmh");

	if (check.checked === true)
	{
		label.innerHTML = "Compte spécifique La Mauvaise Herbe";
		div.className = "";
	}
	else
	{
		label.innerHTML = "Compte basique du plan comptable";
		div.className = "invisible";
	}
}
