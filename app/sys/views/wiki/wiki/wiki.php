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
			<div class="block-content">

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

<script>

	function get_liste_sujets(id) {

		window.location.replace("?page=wiki&idcat="+id);
	}

	$(document).ready(function() {

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
					console.log('charge cat');
				});

			} else {
				console.log(msg.errormsg);
			}
		});

		$('body').on('click', '#show_root_cat_add', function() {

			$("#wiki_add_root_cat_form")[0].reset();
		});

	});

</script>