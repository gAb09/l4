/*----------   Bascule du signe du montant (pages Recettes/Dépenses & Écritures) -----------*/
function initialise() {
	bascule_signe();
	banque();
}

function separateur(select) {
	var span = document.getElementById("sep1");
	sep = separateurs[select.value];
	span.innerHTML = sep;
	// alert(sep);
}


function separateur2(select) {
	var span = document.getElementById("sep2");
	sep = separateurs[select.value];
	span.innerHTML = sep;
	// alert(sep);
}



function bascule_signe() {
	var label = document.getElementById("banque2_label");

	if (document.form.signe_1.checked == 1)
	{
		document.getElementById("montant").style.color="red"; /* aFA passer par les classe de span */
		label.innerHTML="Vers";
	}
	else
	{
		document.getElementById("montant").style.color="blue";
		label.innerHTML="Depuis";
	}
}



/*----------   Affichage de la banque de destination (pages Écritures)-----------*/
function banque() {
	var div = document.getElementById("banque2");
	var form = document.form;
	var select = document.getElementById("double");
	var label = document.getElementById("label_flag");

	// alert(separateurs);

	/* Si le "type_id" sélectionné via le formulaire est dans la liste des types qui requièrent une banque liée
	(c'est le tableau $type_dble_ecriture passé en json depuis ecriture_form.blade.php */
		if (select.checked === true)
		{
			div.className="input"; /* Si oui on affiche la div banque liée */
			label.innerHTML="Écriture double";
		}
		else
		{
			div.className="input invisible";
			label.innerHTML="Écriture simple";
		}

	}

	/*----------   Affichage des formulaires d'édtion des notes (widget Notes) -----------*/
	function show_form_creer() {
		document.getElementById("coulisse_form_creer").className="visible";
	}

	function show_form_editer() {
		document.getElementById("coulisse_form_editer").className="visible";
	}


/*----------  Pointage web = marquage comme pointé selon l'état fourni sur le site Caisse d´Épargne 
Changement de la couleur du fond de ligne et update du pointage (pages "Pointage") -----------*/
function bascule_pointage(xxx) {
		// Obtenir le <tr> parent de l'input select name"pointage" et changer sa classe 
		var row = xxx.parentNode.parentNode.parentNode;
		var input = row.childNodes[1].childNodes[1].childNodes[2];

		// alert(input.value); /* CTRL */


		if (row.className == "surlignage st_prev") {
			row.className = "surlignage st_emise";
			return;
		}

		if (row.className == "surlignage st_emise") {
			row.className = "surlignage st_www";
			return;
		}


		if (row.className == "surlignage st_www") {
			row.className = "surlignage st_releve";
			return;
		}


		if (row.className == "surlignage st_releve") {
			row.className = "surlignage st_prev";
		}

	}

