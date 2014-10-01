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

function getFreres() {
	var xhr = getXMLHttpRequest();

	/* Assigner l'élément select "pere" */
	var idpere = document.getElementById("pere");

	/* Assigner l'élément select "freres" */
	var list_freres = document.getElementById('position');

	/* Assigner la div masquable des freres */
	var div_position = document.getElementById("div_position");

	/* Assigner le span qui contiendra le nom du père dans le texte d'aide */
	var span_pere = document.getElementById("span_pere");

	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status === 0)) {

			if (xhr.responseText) {
				var tableau = eval('(' + xhr.responseText + ')');
				var list = tableau.slice(0,1);
				var name = tableau.slice(1,2);
				// var suivant = tableau.slice(2,3);
// alert(suivant);
				div_position.className="";
				list_freres.innerHTML = list;
				// span_pere.innerHTML = name;
			}else{
				div_position.className="invisible";
			}
		}
	};
	xhr.open("GET", "freres?idpere="+idpere.value, true);
	xhr.send(null);
}

