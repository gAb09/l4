/*----------  Pointage web = marquage comme pointé selon l'état fourni sur le site Caisse d´Épargne 
Changement de la couleur du fond de ligne et update du pointage (pages "Pointage") -----------*/
function bascule_statut_pointage(xxx) {// aFa automatiser l'attribution du nom de la classe 
	// Obtenir le <tr> parent de l'input select name"pointage" et changer sa classe 
	var row = xxx.parentNode.parentNode.parentNode;
	var input = row.childNodes[1].childNodes[1].childNodes[2];

	// alert(input.value); /* CTRL */


	if (row.className == "surlignage st_emise") {
		row.className = "surlignage st_www";
		return;
	}


	if (row.className == "surlignage st_www") {
		row.className = "surlignage st_releve";
		return;
	}


	if (row.className == "surlignage st_releve") {
		row.className = "surlignage st_emise";
	}

}


function bascule_statut_recdep(xxx) {
	// Obtenir le <tr> parent de l'input select name"pointage" et changer sa classe 
	var row = xxx.parentNode.parentNode.parentNode;
	var input = row.childNodes[1].childNodes[1].childNodes[2];

	// alert(input.value); /* CTRL */


	if (row.className == "surlignage st_prev") {
		row.className = "surlignage st_emise";
		return;
	}

	if (row.className == "surlignage st_emise") {
		row.className = "surlignage st_prev";
		return;
	}


}


/*
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
	xhr.send(null); */
}

