<style>
<!-- -->
#status{
	font-family:Arial; padding:5px;
}
ul#files{ list-style:none; padding:0; margin:0; }
ul#files li{ padding:10px; margin-bottom:2px; width:200px; float:left; margin-right:10px; -moz-border-radius:5px; -webkit-border-radius:5px; text-align: center;}
ul#files li img{ max-width:180px; max-height:150px; }
.success{ background:#99f099; border:1px solid #339933; }
.error{ background:#f0c6c3; border:1px solid #cc6622; }

</style>	

<?php if (! isset ( $_GET ['action'])) {
	?>

<div class="block block-themed">
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
		<h3 class="block-title">Liste des Sujets :</h3>
	</div>
	<div class="block-content">
	
		<?php if(isset($_GET['success_msg']) && !empty($_GET['success_msg'])) { ?>
		<div class="alert alert-success alert-dismissable">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><i class="fa fa-check"></i><?= $_GET['success_msg']; ?></p>
        </div>
        <?php } ?>  
        <?php if(isset($_GET['error_msg']) && !empty($_GET['error_msg'])) { ?>
		<div class="alert alert-warning alert-dismissable">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><i class="fa fa-warning"></i><?= $_GET['error_msg']; ?></p>
        </div>
        <?php } ?>
                           
		<a href="?page=wiki&action=ajouterSujet"><button
				class="btn btn-info push-5-r push-10" type="button"
				style="margin-left: 103px; margin-bottom: 20px !important">
				<i class="fa fa-plus"></i>
			</button></a>

		<ul class="list list-timeline pull-t" id="ul_sujets">

		</ul>
	</div>
</div>

<script>
        $(document).ready(function() {
        
			//DEBUT récuperation de la liste des sujets
			$.ajax({
			  		url: "api/wiki/sujet_liste.php?draw=2&columns[0][data]=id&columns[0][name]=&columns[0][searchable]=false&columns[0][orderable]=true&columns[0][search][value]=&columns[0][search][regex]=false&columns[1][data]=titre&columns[1][name]=&columns[1][searchable]=false&columns[1][orderable]=true&columns[1][search][value]=&columns[1][search][regex]=false&columns[2][data]=contenu&columns[2][name]=&columns[2][searchable]=false&columns[2][orderable]=true&columns[2][search][value]=&columns[2][search][regex]=false&columns[3][data]=nom&columns[3][name]=&columns[3][searchable]=true&columns[3][orderable]=true&columns[3][search][value]=&columns[3][search][regex]=false&columns[4][data]=date_creation&columns[4][name]=&columns[4][searchable]=true&columns[4][orderable]=true&columns[4][search][value]=&columns[4][search][regex]=false&order[0][column]=4&order[0][dir]=desc&start=0&length=10&search[value]=&search[regex]=false&_=1487584533612",
			  		data: {id_cat: <?php if(isset($_GET['id_cat']) && !empty($_GET['id_cat'])) echo $_GET['id_cat']; else echo '0'; ?>}
	  		       })
			  		.done(function( data ) {
			    	if ( console && console.log ) 
			      		console.log( "Sample of data:", data );
			      		var obj = jQuery.parseJSON( data );
			      		var tab = obj.data,i=0,str='',datec;
			      		for(;i<tab.length;i++){
							console.log( "ID :", tab[i].id );
							datec=new Date(tab[i].date_creation);
							str+='<li><div class="list-timeline-time">'+timeCalcul(datec)+'</div><a href="?page=wiki&action=afficherSujet&id='+tab[i].id+'"><i class="fa fa-file-text-o list-timeline-icon bg-default"></i></a><div class="list-timeline-content"><p class="font-w600">'+tab[i].titre+'</p><p class="font-s13">'+tab[i].nom+'</p></div></li>';}
						if(i==0)
						str+='<p class="font-s13">Pas de sujets !!</p>'
			      			str+='<br/>';
							$('#ul_sujets').html(str);
			    								
			  		});
			//FIN récuperation de la liste des sujets
			});

        	//DEBUT fonction de calcule du temps entre la date courante est la date de creation d'un sujet
			function timeCalcul(datec)
			{
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
			//FIN fonction de calcule du temps entre la date courante est la date de creation d'un sujet

			
    </script>
<?php
} else if ($_GET ['action'] == 'ajouterSujet' || $_GET ['action'] == 'modifierSujet') {
	?>
<div class="block">
	<div class="block-header">
		<ul class="block-options">
			<li>
				<button type="button">
					<i class="si si-settings"></i>
				</button>
			</li>
		</ul>
		<h3 class="block-title">Ajouter un Nouveau Sujet :</h3>
	</div>
	<div class="block-content block-content-narrow">
		<form class="form-horizontal push-10-t" 
			action="base_forms_elements_modern.html" method="post"
			onsubmit="return false;" id="myForm">
			<?php if($_GET['action']=='ajouterSujet') { ?>
				<input type="hidden" id="id_sujet" name="id_sujet">
			<?php } ?>
			<?php if($_GET['action']=='modifierSujet') { ?>
				<input type="hidden" id="id_sujet" name="id_sujet"
				value="<?= $_GET['id']; ?>">
			<?php } ?>
		
			<div class="form-group">
				<div class="col-sm-9">
					<div class="form-material floating">
						<input class="form-control" id="titre_sujet" name="titre_sujet"
							type="text" style="text-align: center" minlength="4" required> <label for="titre_sujet">Titre <span class="text-danger">*</span></label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-9">
					<div class="form-material floating">
						<select class="form-control" id="categorie_sujet"
							name="categorie_sujet" size="1" required>

						</select> <label for="categorie_sujet">Séléctionner une catégorie <span class="text-danger">*</span></label>
					</div>
				</div>
			</div>
			<!-- Start Edit text -->
			<div class="form-group">
				<label class="col-xs-12" for="js-ckeditor">Contenu : <span class="text-danger">*</span></label>
				<div class="col-xs-12">
					<!-- CKEditor (.js-ckeditor-inline + .js-ckeditor classes are initialized in App() -> uiHelperCkeditor()) -->
                    <!-- For more info and examples you can check out http://ckeditor.com -->
                    <div id="js-ckeditor-inline" contenteditable="true" style="visibility: hidden;width: 0px; height: 0px"></div>
                    <textarea id="js-ckeditor" name="ckeditor" required></textarea>
                                    
                    <!-- END CKEditor -->
				</div>
			</div>

			<!-- End Edit text -->


			<div class="form-group">
				<label class="col-xs-12" for="pieces_joint_sujet">Piéces joint :</label>
				<div class="col-xs-12">
					<ul id="files"></ul>
				</div>
				<div id="mainbody" class="col-xs-12">
					<div id="fileuploader">Upload</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-9">
					<button class="btn btn-sm btn-primary submit" onclick="envoyer()">Enregistrer</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script>

	var files_str='';
	var fileUp;
	var id_s;
	var success=false,msg;
	var fileup_has_files=false;
	$(document).ready(function()
{
	fileUp=$("#fileuploader").uploadFile({
	url:"api/wiki/upload_file.php",
	fileName:"myfile",
	multiple:true,
	dragDrop:true,
	dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
    abortStr:"abandonner",
	cancelStr:"résilier",
	doneStr:"fait",
	multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers ne sont pas autorisés.",
	extErrorStr:"n'est pas autorisé. Extensions autorisées:",
	sizeErrorStr:"n'est pas autorisé. Admis taille max:",
	uploadErrorStr:"Upload n'est pas autorisé",
	uploadStr:"Téléchargez",
	returnType: "json",
	showDelete: true,
	showDownload:true,
	statusBarWidth:600,
	dragdropWidth:600,
	onSuccess:function(files,data,xhr,pd)
	{
	    //files: list of files
	    //data: response from server
	    //xhr : jquer xhr object
	    //alert(files_str);
	    files_str+=data+';';
	    
	},
	onSelect:function(files)
	{
		console.log( "ON:", "onSelect:function(files)" );
		fileup_has_files=true;
	    return true; //to allow file submission.
	},
	deleteCallback: function (data, pd) {
	    for (var i = 0; i < data.length; i++) {
		$.post("api/wiki/delete_file.php", {op: "delete",name: data[i]},
		    function (resp,textStatus, jqXHR) {
		        //Show Message	
		        //alert("Fichier Supprimer");
		    });
	    }
	    pd.statusbar.hide(); //You choice.

	},
	downloadCallback:function(filename,pd)
		{
			location.href="api/wiki/download_file.php?filename="+filename;
		},
	autoSubmit:false,
	dynamicFormData: function()
	{
		var data ={ id:id_s}
		return data;
	},
	afterUploadAll:function(obj)
	{
		console.log( "AFTER:", "afterUploadAll:function(obj)" );
		alert("ok");
		setTimeout(function() {}, 3000);
		if(success) window.location.replace("?page=wiki&success_msg="+msg); 
	 	else window.location.replace("?page=wiki&error_msg="+msg);
	}
	});
});

	$(function () {
	    // Init page helpers (Summernote + CKEditor plugins)
	    App.initHelpers(['summernote', 'ckeditor']);
	});
	//DEBUT d'initialisation du menu des Catégories
	//$("#myForm").validate();
	//FIN d'initialisation du menu des Catégories

	//DEBUT fonction d'envoi des données d'un sujet
	function envoyer()
	{
		/*alert($('#titre_sujet').val());
		alert($('#pieces_joint_sujet').val());
		alert($('#categorie_sujet').val());*/
		
		var titre=$('#titre_sujet').val();
		var contenu=CKEDITOR.instances['js-ckeditor'].getData();
		var piecejoint=$('#pieces_joint_sujet').val();
		var categorie=$('#categorie_sujet').val();
		
		if(titre!='' && titre.length>=4 && contenu!='' && categorie!=''){
		//*var files='';
	    $('li[id^=\'li-\']').each(function()
	    {
	      //alert($(this).attr("src"));
	      files_str+=$(this).attr("id").substring(3,$(this).attr("id").length)+';';
	    });  
		//alert(files_str);
		if(files_str!=='') files_str=files_str.substring(0,(files_str.length-1));
		//alert(files);
		var url="api/wiki/sujet_add.php";
		<?php if($_GET['action']==='modifierSujet') {?>
		url="api/wiki/sujet_update.php";
		<?php } ?>
		$.ajax({
		  url: url,
		  method: "POST",
		  data: {id: $('#id_sujet').val(), titre: $('#titre_sujet').val(), contenu: contenu, categorie: $('#categorie_sujet').val(), files: files_str},
		  async: false
		})
		  	.done(function( data ) {
		    if ( console && console.log ) {
		      console.log( "Sample of data:", data );
		    }
		    
		    var obj = jQuery.parseJSON( data );
		    if(obj.error=='0') { success=true; id_s=obj.id; }
		    else { success=false; }
		    msg=obj.message[0];
		    	
		    
	 	 });
	 	 if(success)
	 	 {  console.log( "BEFORE:", "fileUp.startUpload()" );
		 	fileUp.startUpload();
		 	console.log( "AFTER:", "fileUp.startUpload()" );
		 	if(!fileup_has_files)  { console.log( "IN:", "if(!fileup_has_files)" ); window.location.replace("?page=wiki&success_msg="+msg); }
	 	 }
	 	else window.location.replace("?page=wiki&error_msg="+msg); 
			}
	}
	//FIN fonction d'envoi des données d'un sujet

	//DEBUT récuperation du SUJET a modifier
	var id_cate;
	<?php if($_GET['action']=='modifierSujet') { ?>
	$( document ).ready(function() {
	$.ajax({
	  url: "api/wiki/get_sujet.php",
	  data: {id: $('#id_sujet').val()},
	  async: false
	})
	  .done(function( data ) {
	    if ( console && console.log )
	      console.log( "Sample of data:", data );
	      var obj = jQuery.parseJSON( data );
	      //alert( obj.name === "John" );
	      //var tab = obj.data;
	      
		console.log( "ID :", obj.id );
	        $('#titre_sujet').val(obj.titre);
		id_cate=obj.id_categorie;
		$('#js-ckeditor').html(obj.contenu);
		var str_files = obj.piecesjointe.split(';'),files='';
	        for (var i=0; i < str_files.length; i++)
	        {
	        if(str_files[i]!=='') {
	        	var src=''; 
	            if(str_files[i].endsWith('.pdf')) src='assets/img/wiki/pdf.png';
	            else if(str_files[i].endsWith('.doc') || str_files[i].endsWith('.docx')) src='assets/img/wiki/word.png';
	            else if(str_files[i].endsWith('.xls') || str_files[i].endsWith('.xlsx')) src='assets/img/wiki/excel.png';
	            else if(str_files[i].endsWith('.ppt') || str_files[i].endsWith('.pptx')) src='assets/img/wiki/powerp.png';
	            else if(str_files[i].endsWith('.txt')) src='assets/img/wiki/txt.png';
	            else if(str_files[i].endsWith('.png') || str_files[i].endsWith('.jpeg') || str_files[i].endsWith('.jpg') || str_files[i].endsWith('.gif')) src=str_files[i];
	            else src='assets/img/wiki/file.png';
	            
		        files+='<li id="li-'+str_files[i].replace('app/sys/api/uploads/wiki/','')+'" class="success"><div class="img-container"><img src="'+src+'" alt=""><div class="img-options"><div class="img-options-content"><button class="btn btn-sm btn-default" onclick="deletefile(\''+str_files[i].replace('app/sys/api/uploads/wiki/','')+'\')"><i class="fa fa-times"></i> Delete</button><br><br><button class="btn btn-sm btn-default" onclick="downloadfile(\''+str_files[i].replace('app/sys/api/uploads/wiki/','')+'\')"><i class="fa fa-download"></i> Download</button></div></div></div><br>'+str_files[i].replace('app/sys/api/uploads/wiki/','')+'</li>';
	           }
		    
	        $('#files').html(files);
	        
	    }
	        console.log( "FIN DONE :", "GET_SUJET" );
	  });

	//DEBUT récuperation des catégories
	console.log( "HNNAAA :", "HNNAAA" );
	$.ajax({
  		url: "api/wiki/categorie_select.php",
  	  	async: false
		})
  		.done(function( data ) {
    		if ( console && console.log ) 
      			console.log( "Sample of data:", data );
			    var obj = jQuery.parseJSON( data );
			    //alert( obj.name === "John" );
			    var tab = obj.data,i=0,str1='<option style="text-align: center"></option>',str2='';
			    for(;i<tab.length;i++){
					console.log( "ID :", tab[i].id );
        			if(id_cate==tab[i].id) str1='<option value="'+tab[i].id+'" style="text-align: center">'+tab[i].nom+'</option>';
					str2+='<option value="'+tab[i].id+'" style="text-align: center">'+tab[i].nom+'</option>';
										}
					var str=str1+str2;
					$('#categorie_sujet').html(str);
    										
  		});
	//FIN récuperation des catégories
	});
	//FIN récuperation du SUJET a modifier
        <?php } else { ?>
	//DEBUT récuperation des catégories
	$.ajax({
  		url: "api/wiki/categorie_select.php",
		async: false
		})
  		.done(function( data ) {
    		if ( console && console.log ) 
      			console.log( "Sample of data:", data );
			    var obj = jQuery.parseJSON( data );
			    //alert( obj.name === "John" );
			    var tab = obj.data,i=0,str2='<option style="text-align: center"></option>';
			    for(;i<tab.length;i++){
					console.log( "ID :", tab[i].id );
  
					str2+='<option value="'+tab[i].id+'" style="text-align: center">'+tab[i].nom+'</option>';
										}
					$('#categorie_sujet').html(str2);
    										
  		});
	//FIN récuperation des catégories
   	<?php } ?>
   	

	//DEBUT de la fonction de supression d'un fichier
	function deletefile(file)
	{
		$.ajax({
	  		url: "api/wiki/delete_file.php",
	  		data: {op: 'delete', name: file},
			async: false
		})
	  .done(function( data ) {
	    if ( console && console.log ) {
	      console.log( "Sample of data:", data );
	      //var obj = jQuery.parseJSON( data );
	      //alert( obj.name === "John" );
	      //var tab = obj.data;
	      
		  /*console.log( "ID :", obj.id );
		        $('#titre_sujet').val(obj.titre);
			$('#js-ckeditor').html(obj.contenu);*/
			var id="li-"+file;
			$("li[id='"+id+"']").remove();
	    }
	  });
	}
	//FIN de la fonction de supression d'un fichier

	//DEBUT de la fonction de téléchargement d'un fichier
	function downloadfile(file)
	{	
	  window.open("app/sys/api/uploads/wiki/"+file);
	}
	//FIN de la fonction de téléchargement d'un fichier

	//DEBUT de la fonction d'envoi d'un fichier
	/*$(function(){
			var btnUpload=$('#upload');
			var status=$('#status');
			new AjaxUpload(btnUpload, {
				action: 'api/wiki/upload_file.php',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|png|jpeg|gif|pdf|doc|docx|xls|xlsx|ppt|pptx|txt)$/.test(ext))){ 
	                    // extension is not allowed 
						status.text('Only PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT, JPG, PNG or GIF files are allowed');
						return false;
					}
					status.text('Uploading...');
				},
				onComplete: function(file, response){
					//On completion clear the status
					status.text('');
					//Add uploaded file to list
					if(response==="success"){
						var src=''; 
				        if(file.endsWith('.pdf')) src='assets/img/wiki/pdf.png';
				        else if(file.endsWith('.doc') || file.endsWith('.docx')) src='assets/img/wiki/word.png';
				        else if(file.endsWith('.xls') || file.endsWith('.xlsx')) src='assets/img/wiki/excel.png';
				        else if(file.endsWith('.ppt') || file.endsWith('.pptx')) src='assets/img/wiki/powerp.png';
				        else if(file.endsWith('.txt')) src='assets/img/wiki/txt.png';
				        else if(file.endsWith('.png') || file.endsWith('.jpg') || file.endsWith('.gif')) src=file;
				        else src='assets/img/wiki/file.png';
						$('<li id="li-'+file+'"></li>').appendTo('#files').html('<div class="img-container"><img src="'+src+'" alt="" /><div class="img-options"><div class="img-options-content"><button class="btn btn-sm btn-default" onclick="deletefile(\''+file+'\')"><i class="fa fa-times"></i> Delete</button><br/><br/><button class="btn btn-sm btn-default" onclick="downloadfile(\''+file+'\')"><i class="fa fa-download"></i> Download</button></div></div></div><br />'+file).addClass('success');
					} else{
						$('<li id="li-'+file+'"></li>').appendTo('#files').text(file).addClass('error');
					}
				}
			});
			
		});*/
	//FIN de la fonction d'envoi d'un fichier
</script>

<?php } 
 else if($_GET['action']=='afficherSujet' || $_GET['action']=='supprimerSujet'){
?>
<div class="content content-boxed">
	<!-- Affichage d'un sujet -->
	<div class="block">
		<div class="block-content block-content-full block-content-narrow">
			<!-- Sujet -->
			<h2 class="h3 font-w600 push-30-t push" id="titre_sujet"></h2>

			<a href="?page=wiki&action=supprimerSujet&id=<?= $_GET['id']; ?>"><button
					class="btn btn-danger push-5-r push-10" type="button">
					<i class="fa fa-times"></i> Supprimer
				</button></a>&nbsp;&nbsp; <a
				href="?page=wiki&action=modifierSujet&id=<?= $_GET['id']; ?>"><button
					class="btn btn-info push-5-r push-10" type="button">
					<i class="fa fa-edit"></i> Modifier
				</button></a>

			<div id="faq1" class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							<span id="date_creation_sujet" style="font-size: 70% !important;"></span>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span id="date_dernier_modification_sujet"
								style="font-size: 70% !important;"></span>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span id="auteur_sujet"
								style="font-size: 70% !important;"></span>
								
						</h3>
					</div>
					<div id="faq1_q1" class="panel-collapse collapse in">
						<div class="panel-body" id="contenu_sujet"></div>



					</div>
				</div>

			</div>
			<!-- END Sujet -->
		</div>
	</div>
	<!-- END Affichage d'un sujet -->
</div>

<script>
var id;

<?php if(isset($_GET['id']) && !empty($_GET['id'])) { ?>
id=<?= $_GET['id']; ?>;
<?php } ?>
//alert(id);

//DEBUT de récupération du SUJET à afficher
$.ajax({
  url: "api/wiki/get_sujet.php",
  data: {id: id},
	async: false
})
  .done(function( data ) {
    if ( console && console.log ) {
      console.log( "Sample of data:", data );
      var obj = jQuery.parseJSON( data );
      //alert( obj.name === "John" );
      //var tab = obj.data;
      
	console.log( "ID :", obj.id );
        $('#titre_sujet').html(obj.titre);
	
	$('#date_creation_sujet').html('<i class="fa fa-calendar"></i>&nbsp;&nbsp;Date Création&nbsp;:&nbsp;'+obj.date_creation);
	$('#date_dernier_modification_sujet').html('<i class="fa fa-calendar"></i>&nbsp;&nbsp;Date Dernier Modification&nbsp;:&nbsp;'+obj.date_dernier_modification);
	$('#auteur_sujet').html('<i class="fa fa-user"></i>&nbsp;&nbsp;Auteur&nbsp;:&nbsp;'+obj.auteur);
	var str_files = obj.piecesjointe.split(';'),files='<label class="col-xs-12" for="pieces_joint_sujet">Piéces joint :</label><ul id="files">';
        for (var i=0; i < str_files.length; i++)
        if(str_files[i]!=='') { 
        var src=''; 
        if(str_files[i].endsWith('.pdf')) src='assets/img/wiki/pdf.png';
        else if(str_files[i].endsWith('.doc') || str_files[i].endsWith('.docx')) src='assets/img/wiki/word.png';
        else if(str_files[i].endsWith('.xls') || str_files[i].endsWith('.xlsx')) src='assets/img/wiki/excel.png';
        else if(str_files[i].endsWith('.ppt') || str_files[i].endsWith('.pptx')) src='assets/img/wiki/powerp.png';
        else if(str_files[i].endsWith('.txt')) src='assets/img/wiki/txt.png';
        else if(str_files[i].endsWith('.png') || str_files[i].endsWith('.jpg') || str_files[i].endsWith('.gif')) src=str_files[i];
        else src='assets/img/wiki/file.png';
        files+='<li id="li-'+str_files[i].replace('app/sys/api/uploads/wiki/','')+'" class="success"><div class="img-container"><img src="'+src+'" alt=""><div class="img-options"><div class="img-options-content"><button class="btn btn-sm btn-default" onclick="deletefile(\''+str_files[i].replace('app/sys/api/uploads/wiki/','')+'\')"><i class="fa fa-times"></i> Delete</button><br><br><button class="btn btn-sm btn-default" onclick="downloadfile(\''+str_files[i].replace('app/sys/api/uploads/wiki/','')+'\')"><i class="fa fa-download"></i> Download</button></div></div></div><br>'+str_files[i].replace('app/sys/api/uploads/wiki/','')+'</li>'; 
        }
		files+='</ul><br/><br/>';
        $('#contenu_sujet').html(obj.contenu+files);
        
    }
  });
//FIN de récupération du SUJET a afficher

function deletefile(file)
{
	$.ajax({
  url: "api/wiki/delete_file.php",
  data: {op: 'delete', name: file},
	async: false
})
  .done(function( data ) {
    if ( console && console.log ) {
      console.log( "Sample of data:", data );
      //var obj = jQuery.parseJSON( data );
      //alert( obj.name === "John" );
      //var tab = obj.data;
      
	/*console.log( "ID :", obj.id );
        $('#titre_sujet').val(obj.titre);
	$('#contenu_sujet').html(obj.contenu);*/
	var id="li-"+file;
	
	$("li[id='"+id+"']").remove();
    }
  });
}

function downloadfile(file)
{
	
  window.open("app/sys/api/uploads/wiki/"+file);
 
}

<?php if($_GET['action']=='supprimerSujet') { ?>
		if(confirm("Êtes-vous sûr de vouloir supprimer définitivement le sujet ?")){
			$.ajax({
				  url: "api/wiki/sujet_delete.php",
				  method: "POST",
				  data: {id: id}
					})
				  	.done(function( data ) {
				    if ( console && console.log ) {
				      console.log( "Sample of data:", data );
				    }
				    var obj = jQuery.parseJSON( data );
				    if(obj.error=='0')
				    	window.location.replace("?page=wiki&success_msg="+obj.message[0]);
				    else
				    	window.location.replace("?page=wiki&error_msg="+obj.message[0]);
			 	 });
			}
<?php } ?>
</script>
<?php } 
?>
	
<!-- From Left Modal -->
<div class="modal fade" id="modal-fromleft" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromleft">
    	<div class="modal-content">
    	<form class="form-horizontal push-10-t" 
			action="base_forms_elements_modern.html" method="post"
			onsubmit="return false;" id="myForm1">
        	<div class="block block-themed block-transparent remove-margin-b">
            	<div class="block-header bg-primary-dark">
                	<ul class="block-options">
                    	<li>
                        	<button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                       	</li>
                    </ul>
                    <h3 class="block-title">Ajouter une nouvelle Catégorie :</h3>
              	</div>
                <div class="block-content">
                	<div class="form-group">
						<div class="col-sm-9">
							<div class="form-material floating">
								<input class="form-control" id="nom_categorie" name="nom_categorie" type="text" style="text-align: center" required>
								<label for="nom_categorie">Nom <span class="text-danger">*</span></label>
							</div>
						</div>
					</div>
					<br/>
					<div class="form-group">
						<div class="col-sm-9">
							<div class="form-material floating">
								<select class="form-control" id="categorie_parent" name="categorie_parent" size="1" required>
				                </select> 
								<label for="categorie_sujet">Séléctionner une catégorie <span class="text-danger">*</span></label>
							</div>
						</div>
					</div>
					<br/>
					<div class="form-group">
                    	<div class="col-sm-9">
                        	<div class="form-material floating">
                            	<textarea class="form-control" id="description_categorie" name="description_categorie" rows="4"></textarea>
                                <label for="description_categorie">Description</label>
                            </div>
                        </div>
                    </div>
                    <br/>
            	</div>
	      	</div>
	      	<br/><br/><br/><br/><br/><br/>
	      	<div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Annuler</button>
                        <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal" onclick="envoyerCat()"><i class="fa fa-check"></i> Enregistrer</button>
                    </div>
                    </form>
 		</div>
                
            </div>
        </div>
         
        <!-- END From Left Modal -->
		
		<script>
		//DEBUT fonction d'envoi des données d'un sujet
		function envoyerCat()
		{
			/*alert($('#nom_categorie').val());
			alert($('#categorie_parent').val());
			alert($('#description_categorie').val());
			/*alert($('#categorie_sujet').val());*/
			
		$.ajax({
		  url: "api/wiki/categorie_add.php",
		  method: "POST",
		  data: {nom: $('#nom_categorie').val(), description: $('#description_categorie').val(), categorie: $('#categorie_parent').val()}
		})
	  	.done(function( data ) {
	    if ( console && console.log ) 
	      console.log( "Sample of data:", data );
	    	var obj = jQuery.parseJSON( data );
		if(obj.error=='0')
		    window.location.replace("?page=wiki&success_msg="+obj.message[0]);
		else
		    window.location.replace("?page=wiki&error_msg="+obj.message[0]);
	 	 });
		}
		//FIN fonction d'envoi des données d'un sujet
		
		//DEBUT récuperation des catégories
		$.ajax({
  		url: "api/wiki/categorie_select.php"
		})
  		.done(function( data ) {
    		if ( console && console.log ) 
      			console.log( "Sample of data:", data );
			    var obj = jQuery.parseJSON( data );
			    //alert( obj.name === "John" );
			    var tab = obj.data,i=0,str2='<option style="text-align: center"></option>';
			    for(;i<tab.length;i++){
					console.log( "ID :", tab[i].id );
  
					str2+='<option value="'+tab[i].id+'" style="text-align: center">'+tab[i].nom+'</option>';
										}
					$('#categorie_parent').html(str2);
    										
  		});
		//FIN récuperation des catégories
	
	
	
	
		</script>
