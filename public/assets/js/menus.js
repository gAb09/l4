function toggle_publication() {
	var label = document.getElementById("publication");
	var check = document.getElementById("publication_check");

	if (check.checked === true)
	{
		label.innerHTML = "Menu activé";
	}
	else
	{
		label.innerHTML = "Menu désactivé";
	}
}

