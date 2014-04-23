<!-- Dates aFa revoir traduction de la date -->
<!-- Banque - Dates - Montant & Signe - Double écriture -->
<fieldset>
	<div class="input">
		<!-- Banque -->
		{{ Form::label('banque_id', 'Banque', array ('id' => 'banque', 'class' => '')) }}
		{{ Form::select('banque_id', Banque::listForInputSelect(), $ecriture->banque_id) }}  <!-- aPo probleme de selected -->
	</div>

	<!-- Date émission -->
	<div class="input">
		{{ Form::label('date_emission', 'Date écriture', array ('class' => '')) }}
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
	<div>
		<!-- Ecriture double -->
		{{ Form::checkbox('double_flag', '1', $ecriture->double_flag, array ('class' => 'nobr', 'id' => 'double', 'onChange' => 'javascript:banque();')) }}
		{{ Form::label('double_flag', 'Écriture double', array ('class' => 'nobr')) }}
	</div>
</fieldset>

<!-- Libellés — Banque -->
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
		{{Form::select('type_id', Type::listForInputSelect(), $ecriture->type_id, array ('class' => 'long') ) }}
	</div>

	<div class="input">
		<!-- Type (justificatif) -->
		{{ Form::label('justificatif', 'Justificatif', array ('class' => '')) }}

		@if(isset($ecriture->type->sep_justif))
		<div class="input nobr">
			{{ $ecriture->type->sep_justif }}
		</div>
		@endif

		{{ Form::text('justificatif', $ecriture->justificatif, array ('class' => 'long margright')) }}   <!-- aPo probleme de selected -->
	</div>
</fieldset>

<!-- Compte -->
<fieldset>
	<div class="input">
		{{ Form::label('compte_id', 'Compte', array ('class' => '', 'id' => 'compte')) }}
		{{Form::select('compte_id', Compte::listForInputSelect(), $ecriture->compte_id, array ('class' => '')) }}
	</div>
</fieldset>
<?php

if (!isset($ecriture->banque2->id))
	{
		$banque2_id = 'Sélectionnez la banque liée';
		$type2_id = 'Sélectionnez le type d’écriture';
		$justif2 = 'Saisissez éventuellement le justificatif';
		$ecriture2_id = '';
	}else
	{
		$banque2_id = $ecriture->banque2->banque_id;
		$type2_id = $ecriture->banque2->type_id;
		$justif2 = $ecriture->banque2->justificatif;
		$ecriture2_id = $ecriture->banque2->id;
	}

?>

<!-- Banque 2 -->
<fieldset id="banque2" >
	<div class="input">
		<!-- Banque 2 -->
		{{ Form::hidden('ecriture2_id', $ecriture2_id) }}
		{{ Form::label('banque2_id', 'Banque liée', array ('class' => '', 'id' => 'banque2_label')) }}
		{{ Form::select('banque2_id', Banque::listForInputSelect(), $banque2_id, array ('class' => 'rrert'))}}  <!-- aPo probleme de selected -->
	</div>
	<div class="input">
		<!-- Type 2 -->
		{{ Form::label('type2_id', 'Type', array ('class' => '')) }}
		{{Form::select('type2_id', Type::listForInputSelect(), $type2_id, array ('class' => 'long') ) }}
	</div>

	<div class="input">
		<!-- Type (justificatif) -->
		{{ Form::label('justif2', 'Justificatif', array ('class' => '')) }}

		@if(isset($ecriture->banque2->type->sep_justif))
		<div class="input nobr">
			{{ $ecriture->banque2->type->sep_justif }}
		</div>
		@endif

		{{ Form::text('justif2', $justif2, array ('class' => 'long margright')) }}   <!-- aPo probleme de selected -->
	</div>
</fieldset>

