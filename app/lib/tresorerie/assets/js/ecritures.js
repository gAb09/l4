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
		label.innerHTML= txt_label+"  NON VALIDÉ";
	}
	else
	{
		label.style.color="green";
		label.innerHTML= txt_label+"  VALIDÉ";
	}
}


/*----------   Affichage de la banque de destination (pages Écritures)-----------*/
function banque() {
	var div = document.getElementById("ecriture2");
	var form = document.form;
	var select = document.getElementById("double");
	var label = document.getElementById("label_flag");

	/* S’il est coché écriture double */
		if (select.checked === true)
		{
			div.className="input"; /* Si oui on affiche la div banque liée */
			label.innerHTML="Écriture double";
		}
		else
		{
			div.className="input hidden";
			label.innerHTML="Écriture simple";
		}
	}

	function separateur(select) {
		var num = select.id.replace('type_id', '');
		var div = document.getElementById("divjustificatif" + num);
		var type_id = select.value;
		var span = document.getElementById("sep" + num);
		var hidden_input = document.getElementById("req_justif" + num);

		hidden_input.value = req_justif[type_id];

		// alert(req_justif[type_id] + sep);
		// alert(hidden_input.value);

		if(req_justif[type_id] === '0')
		{
			div.className = 'input hidden';
		}else{
			var sep = seps[type_id];
			div.className = 'input';
			span.innerHTML = sep;
		}
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
		// alert( adresse);
		location.href = adresse;
	}


	function changeParPage(path, tri_sur, sens) {
		var par_page = document.getElementById('par_page').value;

		var adresse = path+"?tri_sur="+tri_sur+"&sens_tri="+sens+"&par_page="+par_page;
		// alert( adresse);
		location.href = adresse;
	}

	function modificationCompte(path, valeur) {
		var compte_id = '';
		if (valeur == 1) {
			compte_id = document.getElementById('compte_activation').value;
		}else{
			compte_id = document.getElementById('compte_id_actif').value;
		}

		var adresse = path+"?id="+compte_id+"&valeur="+valeur;
		// alert( adresse);
		location.href = adresse;
	}

	function bascule_compte(label) {
		var bouton = document.getElementById("desactive_compte");
		var div = document.getElementById("div_compte_activation");
		var nota = document.getElementById("span_compte_activation");

		if (div.className === "")
		{
			nota.className = "invisible";
			div.className = "invisible";
			bouton.className = "invisible";
		}
		else
		{
			nota.className = "";
			div.className = "";
			bouton.className = "btn btn-small btn-danger";
		}
	}

	function aujourdhuiEmission() {
		var champs = document.getElementById("date_emission");
		champs.value = aujourdhui();

	}

	function aujourdhuiValeur() {
		var champs = document.getElementById("date_valeur");
		champs.value = aujourdhui();

	}

	function aujourdhui() {
		var today = new Date();
		var jour = today.getDate();
		var mois = today.getMonth()+1;
		var an = today.getFullYear();
		var date = jour+'-'+mois+'-'+an;
		return date;

	}
