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
				<a data-toggle="modal" data-target="#modal-add-sujet" data-backdrop="static" data-keyboard="false">
					<button
						class="btn btn-success push-5-r push-10" type="button"
						style="margin-left: 103px; margin-bottom: 20px !important">
						<i class="fa fa-plus"></i> Ajouter sujet
					</button>
				</a>

				<a data-toggle="modal" data-target="#modal-mod-cat" data-backdrop="static" data-keyboard="false">
					<button
						class="btn btn-info push-5-r push-10" type="button"
						style="margin-left: 103px; margin-bottom: 20px !important">
						<i class="fa fa-edit"></i> Modifier catégorie
					</button>
				</a>

				<a data-toggle="modal" data-target="#modal-add-sous-cat" data-backdrop="static" data-keyboard="false">
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
				<div id="scats_container">
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ajouter sujet Modal -->
<div class="modal fade" id="modal-add-sujet" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="block block-themed block-transparent remove-margin-b">
				<div class="block-header bg-primary">
					<ul class="block-options">
						<li>
							<button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
						</li>
					</ul>
					<h3 class="block-title" id="wiki-sujet-add">Ajouter sujet</h3>
				</div>
				<div class="block-content" id="wiki-cat-root-add-block">
					<form class="js-validation-bootstrap form-horizontal" id="wiki_add_sujet">

						<div class='alert alert-success' id='message_wiki_add_sujet' role='alert' style="display: none;">
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
				<button class="btn btn-sm btn-primary" id="save_sujet" type="button"><i class="fa fa-check"></i> Enregistrer</button>
			</div>
		</div>
	</div>
</div>
<!-- END ajouter sujet Modal -->

<!-- ajouter sous cat Modal -->
<div class="modal fade" id="modal-add-sous-cat" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="block block-themed block-transparent remove-margin-b">
				<div class="block-header bg-primary">
					<ul class="block-options">
						<li>
							<button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
						</li>
					</ul>
					<h3 class="block-title" id="wiki-sous-cat-add">Ajouter sous catégorie</h3>
				</div>
				<div class="block-content" id="wiki-cat-root-add-block">
					<form class="js-validation-bootstrap form-horizontal" id="wiki_add_sous_cat">

						<div class='alert alert-success' id='message_wiki_add_sous_cat' role='alert' style="display: none;">
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
				<button class="btn btn-sm btn-primary" id="save_sous_cat" type="button"><i class="fa fa-check"></i> Enregistrer</button>
			</div>
		</div>
	</div>
</div>
<!-- END ajouter sous cat Modal -->

<!-- modifier cat Modal -->
<div class="modal fade" id="modal-mod-cat" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="block block-themed block-transparent remove-margin-b">
				<div class="block-header bg-primary">
					<ul class="block-options">
						<li>
							<button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
						</li>
					</ul>
					<h3 class="block-title" id="wiki-cat-mod">Modifier Catégorie</h3>
				</div>
				<div class="block-content" id="wiki-cat-mod-block">
					<form class="js-validation-bootstrap form-horizontal" id="wiki_mod_cat">

						<div class='alert alert-success' id='message_wiki_mod_cat' role='alert' style="display: none;">
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
				<button class="btn btn-sm btn-primary" id="save_cat" type="button"><i class="fa fa-check"></i> Enregistrer</button>
			</div>
		</div>
	</div>
</div>
<!-- END modifier cat Modal -->

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

			var html = '<div class="list-group">';
			html += '<a class="list-group-item active" href="javascript:void(0)">';
			html += '<span class="badge">'+scats.length+'</span>';
			html += ' Sous catégories';
			html += '</a>';


			for(;i<scats.length;i++){
				//html += '<div class="row"><a class="alert-link cat-list" href="?page=wiki&idcat='+scats[i].id+'">'+scats[i].nom+'</a></div>';

				html += '<a class="list-group-item" href="?page=wiki&idcat='+scats[i].id+'">';
				html += '<i class="fa fa-book push-5-r"></i> '+scats[i].nom;
				html += '</a>';
			}

			html += '</div>';

			$('#scats_container').html(html);
		});
		
	}
	$(document).ready(function() {

		getCatSubjects(get('idcat'));
		
	});
</script>