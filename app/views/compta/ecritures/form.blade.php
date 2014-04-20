<!-- liste d'inputs commune au vues CREATE et EDIT -->
  <script type="text/javascript">
var type_dble_ecriture = <?php echo json_encode($type_dble_ecriture);?>;
 
</script>

<!-- Dates aFa revoir traduction de la date-->
<fieldset>
	<div class="input">
		{{ Form::label('date_emission', 'Date écriture', array ('class' => '')) }}
		{{ Form::text('date_emission', F::dateSaisie($ecriture->date_emission), array ('class' => '')) }}

		<br /><a href="" class="bouton">Aujourd'hui</a>

	</div>
	<div class="input nobr">
		{{ Form::label('date_valeur', 'Date de valeur', array ('class' => '')) }}
		{{ Form::text('date_valeur', F::dateSaisie($ecriture->date_valeur), array ('class' => 'calendrier')) }}

		<br /><a href="" class="bouton">Aujourd'hui</a>

	</div>
</fieldset>

<!-- Libellés — Banque -->
<fieldset>
	<div class="input">
		<!-- Libellé -->
		{{ Form::label('Libelle', 'Libellé', array ('class' => '')) }}
		{{ Form::text('libelle', $ecriture->libelle, array ('class' => '')) }}
	</div>

	<div class="input">
		<!-- Libellé détail -->
		{{ Form::label('libelle_detail', 'Libellé détail', array ('class' => '')) }}
		{{ Form::text('libelle_detail', $ecriture->libelle_detail, array ('class' => 'margright')) }}
	</div>

	<div class="input">
		<!-- Banque -->
		{{ Form::label('banque_id', 'Banque', array ('id' => 'banque', 'class' => '')) }}
		{{Form::select('banque_id', Banque::listForInputSelect(), $ecriture->banque_id)}}  <!-- aPo probleme de selected -->


	</div>
</fieldset>

<!-- Montant - Signe — Type — Banque 2 -->
<fieldset>
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

<fieldset>
	<div class="input">
		<!-- Type -->
		{{ Form::label('type_id', 'Type', array ('class' => '')) }}
		{{Form::select('type_id', Type::listForInputSelect(), $ecriture->type_id, array ('class' => '', 'onChange' => 'javascript:banque();') ) }}
	</div>

	<div class="input">
		<!-- Type (justificatif) -->
		{{ Form::label('type_justif', 'Justificatif', array ('class' => '')) }}

		@if(isset($ecriture->type->sep_justif))
		<div class="input nobr">
			{{ $ecriture->type->sep_justif }}
		</div>
		@endif

		{{ Form::text('type_justif', $ecriture->type_justif, array ('class' => 'margright')) }}   <!-- aPo probleme de selected -->
	</div>

	<div class="input" id="div_banque2">
		<!-- Banque 2 -->
		{{ Form::label('banque2_id', 'Banque liée', array ('class' => '', 'id' => 'banque2_label')) }}
		{{Form::select('banque2_id', Banque::listForInputSelect(), $ecriture->banque2_id, array ('class' => ''))}}  <!-- aPo probleme de selected -->
	</div>
</fieldset>

<!-- Compte -->
<fieldset>
	<div class="input">
		{{ Form::label('compte_id', 'Compte', array ('class' => '', 'id' => 'compte')) }}
		{{Form::select('compte_id', Compte::listForInputSelect(), $ecriture->compte_id, array ('class' => '')) }}
	</div>
</fieldset>

