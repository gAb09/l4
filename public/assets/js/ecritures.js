function bascule_signe() {
	var label = document.getElementById("banque2_label");

	if (document.form.signe_1.checked == 1)
	{
		document.getElementById("montant").style.color="red"; /* aFA passer par les classe de span */
		label.innerHTML="Vers la banque :";
	}
	else
	{
		document.getElementById("montant").style.color="blue";
		label.innerHTML="Depuis la banque :";
	}
}



/*----------   Affichage de la banque de destination (pages Écritures)-----------*/
function banque() {
	var div = document.getElementById("banque2");
	var form = document.form;
	var select = document.getElementById("double");
	var label = document.getElementById("label_flag");

	/* Si le "type_id" sélectionné via le formulaire est dans la liste des types qui requièrent une banque liée (c'est le tableau $type_dble_ecriture passé en json depuis ecriture_form.blade.php */
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

	function separateur(select1) {
		var span = document.getElementById("sep1");
		sep = separateurs[select1.value];
		span.innerHTML = sep;
	}


	function separateur2(select2) {
		var span = document.getElementById("sep2");
		sep = separateurs[select2.value];
		span.innerHTML = sep;
	// alert(span);
}

