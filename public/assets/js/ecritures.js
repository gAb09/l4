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


function bascule_verrou() {
	var label = document.getElementById("verrou");
	var verrou = document.getElementById("check_verrou");

	if (verrou.checked == 1)
	{
		label.style.color="red"; /* aFA passer par les classe de span */
		label.innerHTML= txt_label+"  VÉROUILLÉ";
	}
	else
	{
		label.style.color="green";
		label.innerHTML= txt_label+"  DÉVÉROUILLÉ";
	}
}


/*----------   Affichage de la banque de destination (pages Écritures)-----------*/
function banque() {
	var div = document.getElementById("ecriture2");
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

	function separateur(select) {
		div = select.parentNode;
		span = div.getElementsByTagName("SPAN")[0];
		// alert(div+span);
		sep = separateurs[select.value];
		span.innerHTML = sep;
	}



	function tri(path, param) {
		var par_page = document.getElementById('par_page').value;
		var sens_tri = document.getElementById('sens_tri').value;
		var critere = param.id;
		var prev_tri_sur = document.getElementById('prev_tri_sur').value;
		if (prev_tri_sur === critere) {
			if(sens_tri == "asc"){
				sens = "desc";
			}else{
				sens = "asc";
			}
		}else{
			sens = "asc";
		}
		var adresse = path+"?tri_sur="+critere+"&sens_tri="+sens+"&par_page="+par_page;
		alert( sens);
		location.href = adresse;
	}


	function changeParPage(path, tri_sur, sens) {
		var par_page = document.getElementById('par_page').value;

		var adresse = path+"?tri_sur="+tri_sur+"&sens_tri="+sens+"&par_page="+par_page;
		// alert( adresse);
		location.href = adresse;
	}
