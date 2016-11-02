
//NjQ1YjM1ZTAzMDVmMTg4YzBjMWMzNTAxY2FmZGI5OTM6Ojk3MGJkNjI3ZjQxNWUwYTEyNzIxMGQyY2VjZjIzMTFm

(function(w){
	//console.log(jQuery)
	if(typeof jQuery == "undefined") throw "RC2K: Missing JQuery module";
	w.rc2k = {
		osa : {
			url: 'http://sd-83414.dedibox.fr/osa/rest/',
			ui: {
				/*auth : function(account, callback){
				 $.ajax({'url':url + '/auth','method':'get','data':account}).done(callback);
				 },*/
				tache: {
					create: function (token, obj) {
						/*
						{
							idp : id projet,
							ide : id etape,
							etape : nom de l'etape
						}
						*/
						if(typeof obj == "undefined") throw "RC2K: id projet doit être défini"
						window.open (rc2k.osa.url + token + '/tache_create/' + btoa(JSON.stringify(obj)), '', "menubar=no, status=no, scrollbars=no, menubar=no, titlebar=no, toolbar=no width=600, height=600");
						//window.open (rc2k.osa.ui.url + token + '/tache_create/', '', "menubar=no, status=no, scrollbars=no, menubar=no, width=200, height=100");

					}
				}
			},
			ws: {
				// url: 'http://sd-83414.dedibox.fr/osa/rest',
				projet: {
					create: function (token, obj, callback) {
						$.ajax({
							method: "POST",
							url: rc2k.osa.url + token + "/_/"+ "api/projet.php",
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
				}
			}
		}
		};


})(window);