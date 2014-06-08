@section('body')
onLoad="bascule_signe();banque();"
@stop

<!-- Dates aFa revoir traduction de la date -->

<!-- Tableau pour actualisation du séparateur -->
<script type="text/javascript">
var separateurs = {};

<?php 
echo "separateurs['0'] = 'uiuiui';";
foreach($separateurs as $id => $separateur) {
	echo "separateurs['$id'] = '$separateur';";
}
$class_verrou = (Session::get('class_verrou')) ? Session::get('class_verrou') : "invisible";
?>
</script>


<fieldset>
	<!-- Écriture simple/double -->
	<div class="input nobr">
		{{ Form::checkbox('double_flag', '1', $ecriture->double_flag, array ('class' => 'nobr', 'id' => 'double', 'onChange' => 'javascript:banque();')) }}
		{{ Form::label('double', 'Écriture double', array ('class' => 'nobr', 'id' => 'label_flag')) }}
	</div>
	<a class="iconemedium double" href ="{{ URL::action('EcritureController@edit', $ecriture->ecriture2->id) }}"></a>Aller à l’écriture liée
	<!-- Verrou simple/double -->
	<div class="{{$class_verrou}}" id = "verrou">
		{{ Form::checkbox('verrou', '1', '1', array ('class' => 'nobr', 'id' => 'check_verrou', 'onChange' => 'javascript:bascule_verrou();')) }}
		{{VERROU}}
		{{ Form::label('verrou', 'vérouillé', array ('class' => 'nobr', 'id' => 'label_verrou', 'style' => 'color:red')) }}
	</div>
</fieldset>
<!-- Banque - Dates - Montant & Signe - Écriture simple/double - Verrou simple/double -->
<fieldset>
	<div class="input">
		<!-- Banque -->
		{{ Form::label('banque_id', 'Banque', array ('id' => 'banque', 'class' => '')) }}
		{{ Form::select('banque_id', $list['banque'], $ecriture->banque_id) }}
	</div>

	<!-- Date émission -->
	<div class="input">
		{{ Form::label('date_emission', 'Date émission', array ('class' => '')) }}
		{{ Form::text('date_emission', F::dateSaisie($ecriture->date_emission), array ('class' => 'calendrier')) }}

		<br /><a href="" class="bouton">Aujourd'hui</a>
	</div>

	<!-- Date valeur -->
	<div class="input nobr">
		{{ Form::label('date_valeur', 'Date de valeur', array ('class' => '')) }}
		{{ Form::text('date_valeur', F::dateSaisie($ecriture->date_valeur), array ('class' => 'calendrier')) }}

		<br /><a href="" class="bouton">Aujourd'hui</a>
	</div>

	<div class="input">
		<!-- Montant -->
		{{ Form::label('montant', 'Montant', array ('class' => '')) }}
		{{ Form::text('montant', F::nbre($ecriture->montant), array ('class' => '')) }}

		<!-- Signe -->
		@foreach(Signe::listForInputRadio($ecriture->signe_id) as $signes => $signe)
		<br />
		{{ Form::radio('signe_id', $signe['value'], $signe["checked"], array ('class' => '', 'style' => 'vertical-align:inherit;', 'id' => $signe["id_css"], 'onClick' => 'javascript:bascule_signe();'))}}
		{{ Form::label($signe["id_css"], $signe['etiquette'], array ('class' => 'nobr','style' => '', 'id' => '')) }}
		@endforeach
	</div>
</fieldset>

<!-- Libellés -->
<fieldset>
	<div class="input">
		<!-- Libellé -->
		{{ Form::label('Libelle', 'Libellé', array ('class' => '')) }}
		{{ Form::text('libelle', $ecriture->libelle, array ('class' => 'long')) }}
	</div>

	<div class="input">
		<!-- Libellé détail -->
		{{ Form::label('libelle_detail', 'Libellé détail', array ('class' => '')) }}
		{{ Form::text('libelle_detail', $ecriture->libelle_detail, array ('class' => 'long margright')) }}
	</div>
</fieldset>

<!-- Type - justificatif-->
<fieldset>
	<div class="input">
		<!-- Type -->
		{{ Form::label('type_id', 'Type', array ('class' => '')) }}
		{{Form::select('type_id', $list['type'], $ecriture->type_id, array ('class' => 'long', 'onChange' => 'javascript:separateur(this);') ) }}
		<span>
			{{ isset($ecriture->type->sep_justif) ? $ecriture->type->sep_justif : '/' }}
		</span>
	</div>

	<div class="input">
		<!-- Type (justificatif) -->
		{{ Form::label('justificatif', 'Justificatif', array ('class' => '')) }}
		{{ Form::text('justificatif', $ecriture->justificatif, array ('class' => 'long margright')) }}   <!-- aPo probleme de selected -->
	</div>
</fieldset>

<!-- Compte -->
<fieldset>
	<div class="input">
		{{ Form::label('compte_id', 'Compte', array ('class' => '', 'id' => 'compte')) }}
		{{Form::select('compte_id', $list['compte'], $ecriture->type_id, array ('class' => '')) }}
	</div>
</fieldset>

<!-- Banque 2 -->
<fieldset id="ecriture2" >
	<p class="input">
		Écriture liée :
	</p>
	<div class="input">
		<!-- Banque 2 -->
		{{ Form::hidden('ecriture2_id', isset($ecriture->ecriture2->id) ? $ecriture->ecriture2->id : '') }}
		{{ Form::label('banque2_id', 'Banque liée', array ('class' => '', 'id' => 'banque2_label')) }}
		{{ Form::select('banque2_id', $list['banque'], isset($ecriture->ecriture2->banque_id) ? $ecriture->ecriture2->banque_id : 0, array ('class' => 'rrert'))}}
	</div>
	<div class="input">
		<!-- Type 2 -->
		{{ Form::label('type2_id', 'Type', array ('class' => '')) }}
		{{Form::select('type2_id', $list['type'], isset($ecriture->ecriture2->type_id) ? $ecriture->ecriture2->type_id : 0, array ('class' => 'long', 'onChange' => 'javascript:separateur(this);') ) }}
		<span>
			{{isset($ecriture->ecriture2->type->sep_justif) ? $ecriture->ecriture2->type->sep_justif :  '/'}}
		</span>
	</div>

	<div class="input">
		<!-- Type (justificatif) -->
		{{ Form::label('justif2', 'Justificatif', array ('class' => '')) }}
		{{ Form::text('justif2', isset($ecriture->ecriture2->justificatif) ? $ecriture->ecriture2->justificatif : INPUT_JUSTIF_TXT_DEFAUT, array ('class' => 'long margright')) }} 
	</div>
</fieldset>

<p>
	{{ link_to(Session::get('page_depart'), 'Retour à la liste', array('class' => 'badge badge-locale iconemedium list', 'style' => 'font-size:1.1em')); }}
</p>

@section('script')
<script src="/assets/js/ecritures.js">
</script>
@stop