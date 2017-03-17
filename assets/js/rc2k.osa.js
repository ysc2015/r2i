
//NjQ1YjM1ZTAzMDVmMTg4YzBjMWMzNTAxY2FmZGI5OTM6Ojk3MGJkNjI3ZjQxNWUwYTEyNzIxMGQyY2VjZjIzMTFm

(function(w){

	if(typeof jQuery == "undefined") throw "RC2K: Missing JQuery module";
	w.rc2k = {
		dispatch : function(a){setTimeout((function(){this.postMessage('init','*');}).bind(a),2000)},
		osa : {
			url: w.OSA_SERVER+'osa/',
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
						rc2k.dispatch(popup);
					},
					create: function (obj) {
						/*
						{
							idp : id projet,
							ide : id etape,
							etape : nom de l'etape,
							url: http://sd-83414.dedibox.fr/r2i/api/projet/api/projet/sousprojet/insert_tache_osa.php,
							// affectation
							id_r2i_users : [ids...]
						}
						*/
						if(typeof obj == "undefined") throw "RC2K/OSA: parametre doit être défini"
						var popup = window.open (rc2k.osa.url + 'ui/tache_create/' + btoa(JSON.stringify(obj)), '', "menubar=no, status=no, scrollbars=no, menubar=no, titlebar=no, toolbar=no width=600, height=600");
 						rc2k.dispatch(popup);
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
						rc2k.dispatch(popup);
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
						rc2k.dispatch(popup);
 					}
				}
			},
			ws: {
				auth : function(token, callback){
					$.ajax({'url':rc2k.osa.url + 'ws/auth/' + token}).done(callback);
				},
				projet: {
					create: function (obj, callback) {
						console.log("obj.ref : "+obj.ref);
						$.ajax({
							method: "POST",
							url: rc2k.osa.url + "api/switcher.php?controller=Projet&action=create",
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
							method: "GET",
							url: rc2k.osa.url + "api/switcher.php?controller=Tache&action=R2ITaches",
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
				            url: rc2k.osa.url + 'api/switcher.php?controller=Tache&action=cloturer',
				            data: {
				                cloturer: true,
				                id: idt
				            }
				        }).done(callback);
					},
					affecter : function(id_users, id_tache, callback){
						$.ajax({
				            method: 'POST',
				            url: rc2k.osa.url + 'api/switcher.php?controller=Tache&action=affecter',
				            data: {
				                add: true,
				                users: id_users.join(';'),
				                id_tache: id_tache,
				                sites: [].join(';'),
				                groups: [].join(';')
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