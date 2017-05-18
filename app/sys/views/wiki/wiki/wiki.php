<div class="row">
	<div class="col-md-3">
		<nav id="sidebar2" style="background-color: #3d6f90;">
			<!-- Sidebar Scroll Container -->
			<div id="sidebar-scroll">
				<!-- Sidebar Content -->
				<!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
				<div class="sidebar-content">
					<!-- Side Header -->
					<div class="side-header side-content bg-white-op">
						<!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
						<button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
							<i class="fa fa-times"></i>
						</button>
						<a class="h5 text-white" href="#">
							<i class="fa text-primary">Catégories</i>
						</a>
					</div>
					<!-- END Side Header -->

					<!-- Side Content -->
					<div class="side-content block block-transparent" id="cats-list" style="min-height: 300px;">
						<ul class="nav-main">
							<div id="menu_categorie"><?= /*getWikiCategoriesMenu()*/""?></div>
						</ul>
					</div>
					<!-- END Side Content -->
				</div>
				<!-- Sidebar Content -->
			</div>
			<!-- END Sidebar Scroll Container -->
		</nav>
	</div>
	<div class="col-md-9">

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
				<h3 class="block-title" id="cat-title">Séléctionner une catégorie</h3>
			</div>
			<div class="block-content" id="cat-block-content">
				<?php

				extract($_GET);

				$categorie = WikiCategorie::first(
					array('conditions' =>
						array("id = ?", 14)//$idc
					)
				);
				?>

				<div class="row">
					<div class="col-md-9">
						<a id="add-sujet-show" data-toggle="modal" data-target="#modal-add-sujet" data-backdrop="static" data-keyboard="false">
							<button
								class="btn btn-success push-5-r push-10" type="button"
								style="margin-left: 103px; margin-bottom: 20px !important">
								<i class="fa fa-plus"></i> Ajouter sujet
							</button>
						</a>

						<a id="mod-cat-show" data-toggle="modal" data-target="#modal-mod-cat" data-backdrop="static" data-keyboard="false">
							<button
								class="btn btn-info push-5-r push-10" type="button"
								style="margin-left: 103px; margin-bottom: 20px !important">
								<i class="fa fa-edit"></i> Modifier catégorie
							</button>
						</a>

						<a id="add-sous-cat-show" data-toggle="modal" data-target="#modal-add-sous-cat" data-backdrop="static" data-keyboard="false">
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

	</div>
</div>

<!-- ajouter sujet Modal -->
<div class="modal fade" id="modal-add-sujet" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
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

						<div class="form-group">
							<div class="col-md-6">
								<label for="cat_subject_title">Titre</label>
								<input class="form-control" type="text" id="cat_subject_title" name="cat_subject_title">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<label for="js-ckeditor">Contenu</label>
								<textarea class="form-control" id="js-ckeditor" name="ckeditor" required rows="30"></textarea>
							</div>
						</div>

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

						<div class="form-group">
							<div class="col-md-9">
								<label for="sub_cat_name">Nom</label>
								<input class="form-control" type="text" id="sub_cat_name" name="sub_cat_name">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-9">
								<label for="sub_cat_desc">Déscription</label>
								<textarea class="form-control" id="sub_cat_desc" name="sub_cat_desc" rows="6" placeholder="Description.."></textarea>
							</div>
						</div>

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

						<div class="form-group">
							<div class="col-md-9">
								<label for="u_cat_name">Nom</label>
								<input class="form-control" type="text" id="u_cat_name" name="u_cat_name">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-9">
								<label for="u_cat_desc">Déscription</label>
								<textarea class="form-control" id="u_cat_desc" name="u_cat_desc" rows="6" placeholder="Description.."></textarea>
							</div>
						</div>

						<div class='alert alert-success' id='message_wiki_mod_cat' role='alert' style="display: none;">
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
				<button class="btn btn-sm btn-primary" id="update_cat" type="button"><i class="fa fa-check"></i> Enregistrer</button>
			</div>
		</div>
	</div>
</div>
<!-- END modifier cat Modal -->

<!-- ajouter catégorie root Modal -->
<div class="modal fade" id="modal-add-cat0" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="block block-themed block-transparent remove-margin-b" id="add_cat_block">
				<div class="block-header bg-primary">
					<ul class="block-options">
						<li>
							<button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
						</li>
					</ul>
					<h3 class="block-title" id="wiki-cat-root-add-title">Ajouter catégorie (racine)</h3>
				</div>
				<div class="block-content" id="wiki-cat-root-add-block">
					<form class="js-validation-bootstrap form-horizontal" id="wiki_add_root_cat_form">
						<div class="form-group">
							<div class="col-md-9">
								<label for="cat_name">Nom <span class="text-danger">*</span></label>
								<input class="form-control" type="text" id="cat_name" name="cat_name">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-9">
								<label for="cat_desc">Déscription</label>
								<textarea class="form-control" id="cat_desc" name="cat_desc" rows="6" placeholder="Description.."></textarea>
							</div>
						</div>
						<div class='alert alert-success' id='message_wiki_cat_add_root' role='alert' style="display: none;">
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
				<button class="btn btn-sm btn-primary" id="save_root_cat" type="button"><i class="fa fa-check"></i> Enregistrer</button>
			</div>
		</div>
	</div>
</div>
<!-- END ajouter catégorie root Modal -->

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

	function get_liste_sujets(id) {

		window.location.replace("?page=wiki&idcat="+id);
	}

	function getWikiCatsTree() {

		$('#cats-list').addClass('block-opt-refresh');

		$.ajax({
			method: "POST",
			url: "api/wiki/get_cats_tree.php",
			dataType: "json"
		}).done(function (msg) {

			$('#cats-list').removeClass('block-opt-refresh');

			if(msg.error == 0) {

				$('#menu_categorie').html(msg.html + '<li><a id="show_root_cat_add" href="#" data-toggle="modal" data-target="#modal-add-cat0" data-backdrop="static" data-keyboard="false"><i class="si si-plus"></i><span class="sidebar-mini-hide">Ajouter catégorie (Racine)</span></a></li>');

				App.uiNav2();

				$('#menu_categorie').find("ul").each(function() {
					if($( this ).html() == '') {

						$( this ).prev().removeClass('nav-submenu');
					}
				});

				$('a').on('click', 'span.open-cat', function(e) {
					e.stopPropagation();

					loadCat($( this ).attr('id').substring(5));
				});

			} else {
				console.log(msg.errormsg);
			}
		});
	}

	function getCatSubjects(idcat) {

		$('#wikicat_block').addClass('block-opt-refresh');

		$.ajax({
			url: "api/wiki/sujet_liste.php",
			type: 'POST',
			data: {idcat: idcat}
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
			html += '<a class="list-group-item list-group-item-heading'+(obj.parentcat > 0 ? ' list-sub-cats' :  '')+'" id="idpcat'+obj.parentcat+'" href="javascript:void(0)">';
			html += ' Catégorie mère : '+obj.parentcatname;
			html += '</a>';
			html += '<a class="list-group-item active" href="javascript:void(0)">';
			html += '<span class="badge">'+scats.length+'</span>';
			html += ' Sous catégories';
			html += '</a>';


			for(;i<scats.length;i++){
				//html += '<div class="row"><a class="alert-link cat-list" href="?page=wiki&idcat='+scats[i].id+'">'+scats[i].nom+'</a></div>';

				html += '<a class="list-group-item list-sub-cats" id="idscat'+scats[i].id+'" href="javascript:void(0)">';
				html += '<i class="fa fa-book push-5-r"></i> '+scats[i].nom;
				html += '</a>';
			}

			html += '</div>';

			$('#scats_container').html(html);
		});

	}

	function loadCat(idcat) {

		console.log('load cat : ' + idcat);

		$('#wikicat_block').addClass('block-opt-refresh');

		$.ajax({

			method: "POST",
			dataType: "json",
			url: "api/wiki/add_root_cat.php",
			data: {
				nom : $('#cat_name').val(),
				description : $('#cat_desc').val()
			}

		}).done(function (msg) {

			$('#wikicat_block').removeClass('block-opt-refresh');

			if(msg.error == 0) {

				$("#cat-block-content").html(msg.content);

			}

		});
	}

	var wikiDidChange = false;

	$(document).ready(function() {


		getWikiCatsTree();

		//getCatSubjects(3);


		$('body').on('click', '#show_root_cat_add', function() {

			wikiDidChange = false;

			$("#wiki_add_root_cat_form")[0].reset();
		});

		$('body').on('click', '.list-sub-cats', function() {

			loadCat($( this ).attr('id').substring(6));
		});

		$("#save_root_cat").click(function(e) {

			e.preventDefault();

			$('#add_cat_block').addClass('block-opt-refresh');

			$.ajax({

				method: "POST",
				dataType: "json",
				url: "api/wiki/add_root_cat.php",
				data: {
					nom : $('#cat_name').val(),
					description : $('#cat_desc').val()
				}

			}).done(function (msg) {

				$('#add_cat_block').removeClass('block-opt-refresh');

				App.showMessage(msg,'#message_wiki_cat_add_root');

				if(msg.error == 0) {

					wikiDidChange = true;

					$("#wiki_add_root_cat_form")[0].reset();

				}

			});
		});

		$('#modal-add-cat0').on('hidden.bs.modal', function () {

			getWikiCatsTree();
		});

	});

</script>