
//NjQ1YjM1ZTAzMDVmMTg4YzBjMWMzNTAxY2FmZGI5OTM6Ojk3MGJkNjI3ZjQxNWUwYTEyNzIxMGQyY2VjZjIzMTFm

(function(w){
	//console.log(jQuery)
	if(typeof jQuery == "undefined") throw "RC2K: Missing JQuery module";
	w.rc2k = {
		osa : {
			url: 'http://sd-83414.dedibox.fr/osa/rest/',
			ui: {
				tache: {
					create: function (obj) {
						/*
						{
							idp : id projet,
							ide : id etape,
							etape : nom de l'etape,
							url: http://sd-83414.dedibox.fr/r2i/api/projet/api/projet/sousprojet/insert_tache_osa.php
						}
						*/
						if(typeof obj == "undefined") throw "RC2K: id projet doit être défini"
						window.open (rc2k.osa.url + 'tache_create/' + btoa(JSON.stringify(obj)), '', "menubar=no, status=no, scrollbars=no, menubar=no, titlebar=no, toolbar=no width=600, height=600");
						//window.open (rc2k.osa.ui.url + token + '/tache_create/', '', "menubar=no, status=no, scrollbars=no, menubar=no, width=200, height=100");
 					}
				}
			},
			ws: {
				auth : function(token, callback){
					$.ajax({'url':rc2k.osa.url + 'auth/' + token}).done(callback);
				},
				projet: {
					create: function (obj, callback) {
						$.ajax({
							method: "POST",
							url: rc2k.osa.url + "_/"+ "api/projet.php",
							data: {
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
							url: rc2k.osa.url + "_/"+ "api/tache.php",
							data: {
								r2i_list_tache: true,
								id: idp
							}
						}).done(callback);
					}
				}
			}
		}
		};


})(window);