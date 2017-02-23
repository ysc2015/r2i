<?php
/**
 * file: sidebar.php
 * User: rabii
 */
?>
<!-- Sidebar -->
<nav id="sidebar">
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
                <!-- Themes functionality initialized in App() -> uiHandleTheme() -->
                <div class="btn-group pull-right">
                    <!--<button class="btn btn-link text-gray dropdown-toggle" data-toggle="dropdown" type="button">
                        <i class="si si-drop"></i>
                    </button>-->
                    <ul class="dropdown-menu dropdown-menu-right font-s13 sidebar-mini-hide">
                        <li>
                            <a data-toggle="theme" data-theme="default" tabindex="-1" href="javascript:void(0)">
                                <i class="fa fa-circle text-default pull-right"></i> <span class="font-w600">Default</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="theme" data-theme="assets/css/themes/amethyst.min.css" tabindex="-1" href="javascript:void(0)">
                                <i class="fa fa-circle text-amethyst pull-right"></i> <span class="font-w600">Amethyst</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="theme" data-theme="assets/css/themes/city.min.css" tabindex="-1" href="javascript:void(0)">
                                <i class="fa fa-circle text-city pull-right"></i> <span class="font-w600">City</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="theme" data-theme="assets/css/themes/flat.min.css" tabindex="-1" href="javascript:void(0)">
                                <i class="fa fa-circle text-flat pull-right"></i> <span class="font-w600">Flat</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="theme" data-theme="assets/css/themes/modern.min.css" tabindex="-1" href="javascript:void(0)">
                                <i class="fa fa-circle text-modern pull-right"></i> <span class="font-w600">Modern</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="theme" data-theme="assets/css/themes/smooth.min.css" tabindex="-1" href="javascript:void(0)">
                                <i class="fa fa-circle text-smooth pull-right"></i> <span class="font-w600">Smooth</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <a class="h5 text-white" href="#">
                    <i class="fa text-primary">R2I</i>
                </a>
            </div>
            <!-- END Side Header -->

            <!-- Side Content -->
            <div class="side-content">
                <ul class="nav-main">
                    <?php
                        $connectedProfil->sidebar();
                        //if($connectedProfil->id_utilisateur == 1 or $connectedProfil->id_utilisateur == 2)  $connectedProfil->sidebar_test();
                    ?>
                    <li class="nav-main-heading"><span class="sidebar-mini-hide">Wiki</span></li>
                    <li class="">
                    	<a class="nav-submenu" data-toggle="nav-submenu"><i class="si si-puzzle"></i><span class="sidebar-mini-hide"  id="idcat0">Catégories</span></a>
                        <ul id="menu_categorie">
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- END Side Content -->
        </div>
        <!-- Sidebar Content -->
    </div>
    <!-- END Sidebar Scroll Container -->
</nav>
<!-- END Sidebar -->


<script>
$(document).ready(function() {

var pressTimer;
$('span[id^=\'idcat\']').on('click',function(){
  var temp=$(this).attr('id');
  if(temp!='' && temp.length>=6 && temp.substring(0,5)=='idcat' && temp.replace('idcat','')!='')
  {
	get_liste_sujets(temp.replace('idcat',''));
  }
});

});


//DEBUT fonction d'initialisation du menu des Catégories
var str_pcats='';
function get_categorie_menu(id_cat) {
	var pcats,url="api/wiki/get_parent_categorie.php",idc='';
	if(id_cat!==undefined) {url="api/wiki/get_categorie_by_parent.php"; idc=id_cat;}
	console.log(url);
	$.ajax({
	  url: url,
	  data: {id: idc},
	  async: false
	})
		.done(function( data ) {
	    if ( console && console.log ) {
	      console.log( "Sample of data:", data );
	      pcats = jQuery.parseJSON( data );
	    }
		});
	console.log(pcats.length);
	var i=0;
	 for(;i<pcats.length;i++){
		console.log(url+'  '+pcats[i].id);
		str_pcats+='<li class=""><a class="nav-submenu" data-toggle="nav-submenu"><span class="sidebar-mini-hide" id="idcat'+pcats[i].id+'">'+pcats[i].nom+'</span></a><ul>';
		get_categorie_menu(pcats[i].id);
		str_pcats+='</ul></li>';
	}
}
//FIN fonction d'initialisation du menu des Catégories

//DEBUT d'initialisation du menu des Catégories
<?php //if(!isset($_GET['clickMenu'])) { ?>
get_categorie_menu(undefined);
console.log(str_pcats);
str_pcats+='<li class=""><a href="" id="ajouter_categorie" data-toggle="modal" data-target="#modal-fromleft"><i class="fa fa-plus"></i> Ajouter</a></li>';
$('#menu_categorie').html(str_pcats);
//alert('test');
<?php //} ?>
//FIN d'initialisation du menu des Catégories

</script>
