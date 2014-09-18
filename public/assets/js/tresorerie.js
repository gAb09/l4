/*----------   Affichage des formulaires d'édtion des notes (widget Notes) -----------*/
function show_form_creer() {
	document.getElementById("coulisse_form_creer").className="visible";
}

function show_form_editer() {
	document.getElementById("coulisse_form_editer").className="visible";
}

/*----------   Boîte de confirmation de suppression (toutes pages) -----------*/
function confirmation() {
	var conf = confirm( "Voulez vous vraiment supprimer cet enregistrement ?" ) ;
	if( !conf )
	{
		return false;

	}
}

function getXMLHttpRequest() {
	var xhr = null;

	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest();
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}

	return xhr;
}

function masquer(objet)
{
	objet.setAttribute("style", "display:none");
}