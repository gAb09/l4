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

function masquer(icoclose)
{
	var message = document.getElementById("messages");
	var icoshow = document.getElementById("icoshowmessages");
	var icohide = document.getElementById("icohidemessages");

	message.className = message.className + ' masquer';
	icoshow.className = icoshow.className.replace(' hidden', '');
	icohide.className = icohide.className + ' hidden';
}


function montrer(icoclose)
{
	var message = document.getElementById("messages");
	var icoshow = document.getElementById("icoshowmessages");
	var icohide = document.getElementById("icohidemessages");

	message.className = message.className.replace(' masquer', '');
	icoshow.className = icoshow.className + ' hidden';
	icohide.className = icohide.className.replace(' hidden', '');
}
