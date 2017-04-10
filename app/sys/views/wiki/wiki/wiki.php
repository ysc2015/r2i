<?php

extract($_GET);

$categorie = WikiCategorie::first(
	array('conditions' =>
		array("id = ?", $idcat)
	)
);
?>
<div class="block block-themed" id="wikicat_block">
	<div class="block-header bg-primary">
		<ul class="block-options">
			<li>
				<button type="button" data-toggle="block-option"
						data-action="fullscreen_toggle">
					<i class="si si-size-fullscreen"></i>
				</button>
			</li>
			<li>
				<button type="button" data-toggle="block-option"
						data-action="refresh_toggle" data-action-mode="demo">
					<i class="si si-refresh"></i>
				</button>
			</li>
			<li>
				<button type="button" data-toggle="block-option"
						data-action="content_toggle">
					<i class="si si-arrow-up"></i>
				</button>
			</li>
		</ul>
		<h3 class="block-title"><?= $categorie->nom?></h3>
	</div>
	<div class="block-content">
		<div class="row">

		</div>
		<div class="row">
			<div class="col-md-9">
				<a href="?page=wiki&action=ajouterSujet">
					<button
						class="btn btn-success push-5-r push-10" type="button"
						style="margin-left: 103px; margin-bottom: 20px !important">
						<i class="fa fa-plus"></i> Ajouter sujet
					</button>
				</a>

				<a href="?page=wiki&action=ajouterSujet">
					<button
						class="btn btn-info push-5-r push-10" type="button"
						style="margin-left: 103px; margin-bottom: 20px !important">
						<i class="fa fa-edit"></i> Modifier catégorie
					</button>
				</a>

				<a href="?page=wiki&action=ajouterSujet">
					<button
						class="btn btn-default push-5-r push-10" type="button"
						style="margin-left: 103px; margin-bottom: 20px !important">
						<i class="fa fa-plus"></i> Ajouter sous catégorie
					</button>
				</a>

				<ul class="list list-timeline pull-t" id="ul_sujets">

				</ul>
			</div>
			<div class="col-md-3">
				<h4>Sous catégories</h4>
				<div id="scats_container">
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function timeCalcul(datec) {
		var minutes=((new Date()).getTime()-datec.getTime())/60000.0;
		var j,h;
		if(minutes>=60.0)
		{
			h=minutes/60.0;
			minutes%=60.0;
		}
		if(h>=24.0)
		{
			j=h/24.0;
			h%=24.0;
		}

		var temp='';
		if(j!==undefined) temp+=Number.parseInt(j)+' Jour(s) ';
		if(h!==undefined) temp+=Number.parseInt(h)+' Heure(s) ';
		temp+=Number.parseInt(minutes)+' Minute(s) ';
		return temp;
	}
	
	function getCatSubjects(idcat) {

		$('#wikicat_block').addClass('block-opt-refresh');

		$.ajax({
			url: "api/wiki/sujet_liste.php",
			type: 'POST',
			data: {idcat: get('idcat')}
		}).done(function( data ) {

			$('#wikicat_block').removeClass('block-opt-refresh');

			var obj = jQuery.parseJSON( data );
			var tab = obj.wksubjects, scats = obj.wksubcats,i=0,str='',datec;
			for(;i<tab.length;i++){
				datec=new Date(tab[i].date_creation);
				str+='<li><div class="list-timeline-time">'+timeCalcul(datec)+'</div><a href="?page=wiki&action=afficherSujet&id='+tab[i].id+'"><i class="fa fa-file-text-o list-timeline-icon bg-default"></i></a><div class="list-timeline-content"><p class="font-w600">'+tab[i].titre+'</p><p class="font-s13">Crée par : '+tab[i].prenom_utilisateur+' '+ tab[i].nom_utilisateur+'</p></div></li>';
			}
			if(i==0)
				str+='<p class="font-s13">Pas de sujets !!</p>'
			str+='<br/>';
			$('#ul_sujets').html(str);

			i = 0;

			var html = '';

			for(;i<scats.length;i++){
				html += '<div class="row"><a class="alert-link cat-list" href="?page=wiki&idcat='+scats[i].id+'">'+scats[i].nom+'</a></div>';
			}

			$('#scats_container').html(html);
		});
		
	}
	$(document).ready(function() {

		/*$('body').on('click', '.cat-list', function(e) {
			e.stopPropagation();

			console.log('pzzz');
		});*/

		getCatSubjects(get('idcat'));
		
	});
</script>