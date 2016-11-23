
//NjQ1YjM1ZTAzMDVmMTg4YzBjMWMzNTAxY2FmZGI5OTM6Ojk3MGJkNjI3ZjQxNWUwYTEyNzIxMGQyY2VjZjIzMTFm

(function(w){
	//console.log(jQuery)
	if(typeof jQuery == "undefined") throw "RC2K: Missing JQuery module";
	w.rc2k = {
		dispatch : function(a){setTimeout((function(){this.postMessage('init','*');}).bind(a),2000)},
		osa : {
			url: 'http://sd-83414.dedibox.fr/osa/',
			ui: {
				tache: {
					list : function(obj){
						/*
						{
							idp : id projet,
							ide : id etape,
							etape : nom de l'etape,
							url: http://sd-83414.dedibox.fr/r2i/api/projet/api/projet/sousprojet/insert_tache_osa.php
						}
						*/
						if(typeof obj == "undefined") throw "RC2K/OSA: parametre non défini";
						var popup = window.open (rc2k.osa.url + 'ui/tache_list/' + btoa(JSON.stringify(obj)), '', "menubar=no, status=no, scrollbars=no, menubar=no, titlebar=no, toolbar=no width=600, height=600");
						dispatch(popup);
					},
					create: function (obj) {
						/*
						{
							idp : id projet,
							ide : id etape,
							etape : nom de l'etape,
							url: http://sd-83414.dedibox.fr/r2i/api/projet/api/projet/sousprojet/insert_tache_osa.php
						}
						*/
						if(typeof obj == "undefined") throw "RC2K/OSA: parametre doit être défini"
						var popup = window.open (rc2k.osa.url + 'ui/tache_create/' + btoa(JSON.stringify(obj)), '', "menubar=no, status=no, scrollbars=no, menubar=no, titlebar=no, toolbar=no width=600, height=600");
 						dispatch(popup);
 					},
 					traiter: function(obj){
 						/*
						{
							idt: id tache a traiter,
							callback : {
								param : parametres a envoyer avec l'url de callback,
								url: url de callback
							}	
						}
 						*/
 						if(typeof obj == "undefined") throw "RC2K/OSA: parametre non défini";
 						var popup = window.open (rc2k.osa.url + 'ui/tache_traiter/' + btoa(JSON.stringify(obj)), '', "menubar=no, status=no, scrollbars=no, menubar=no, titlebar=no, toolbar=no width=600, height=600");
						dispatch(popup);
 					},
 					affecter: function(obj){
 						/*
						{
							idt: id tache a traiter,
							callback : {
								param : parametres a envoyer avec l'url de callback,
								url: url de callback
							}	
						}
 						*/
 						if(typeof obj == "undefined") throw "RC2K/OSA: parametre non défini";
 						var popup = window.open (rc2k.osa.url + 'ui/tache_affecter/' + btoa(JSON.stringify(obj)), '', "menubar=no, status=no, scrollbars=no, menubar=no, titlebar=no, toolbar=no width=600, height=600");
						dispatch(popup);
 					}
				}
			},
			ws: {
				auth : function(token, callback){
					$.ajax({'url':rc2k.osa.url + 'ws/auth/' + token}).done(callback);
				},
				projet: {
					create: function (obj, callback) {
						$.ajax({
							method: "POST",
							url: rc2k.osa.url + "api/projet.php",
							data: {
								r2i_agent : true,
								referant_projet: obj.ref,
								nom_projet: obj.prj,
								description_projet: obj.des,
								date_fin_projet: obj.dat,
								id_filiale: obj.fil,
								id_pole: obj.pol,
							}
						}).done(callback);
					}
				},
				tache : {
					list : function(idp, callback){
						$.ajax({
							method: "POST",
							url: rc2k.osa.url + "api/tache.php",
							data: {
								r2i_list_tache: true,
								r2i_all : true,
								id: idp
							}
						}).done(callback);
					},
					cloturer : function(idt, callback){
						$.ajax({
				            method: 'POST',
				            url: rc2k.osa.url + 'api/tache.php',
				            data: {
				                cloturer: true,
				                id: idt
				            }
				        }).done(callback);
					}
				},

			}
		}
		};

		window.addEventListener("message", function(event){
			if (event.data == "close") {
				event.source.close();
			}
		}, false);


})(window);