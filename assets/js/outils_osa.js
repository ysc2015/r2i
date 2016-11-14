/**
 * Created by fadil on 02/11/16.
 */
function appelscriptosa(typeetape, id_sous_projet,ide)
{
    rc2k.osa.ws.auth("NjQ1YjM1ZTAzMDVmMTg4YzBjMWMzNTAxY2FmZGI5OTM6Ojk3MGJkNjI3ZjQxNWUwYTEyNzIxMGQyY2VjZjIzMTFm",function(response){
        console.log(response);
        var aresponse = JSON.parse(response);
        var idetape=0;
        if(false) {
            alert("Authentification non autorisé");
        }else{ console.log(ide+" ok "+id_sous_projet);
            //apres authentification
            $.ajax({
                method: "POST",
                url: "api/projet/sousprojet/get_projet_id.php",
                dataType : "json",
                data: {
                    idsp: id_sous_projet,
                    tentre: ide
                },
                success : function (e) {
                    console.log("appelscriptosa e.idetape: "+e.idetape+", e.id: "+e.id);

                    idetape = e.idetape;
                    if(idetape!=0){
                        if(e.id ==0){
                            rc2k.osa.ws.projet.create({
                                ref:"",//id_utilisateur connecte
                                prj:e.nom ,//nom de projet
                                des:e.nom,//desc else nom projet
                                dat:new Date(),//date fin de projet
                                fil:"2"//ftth
                            }, function(reponse){

                                var areponse = JSON.parse (reponse);
                                console.log(areponse["extra"]);
                                $.ajax({
                                    method: "POST",
                                    url: "api/projet/projet/set_projet_id_osa.php",
                                    data: {
                                        idosa:areponse["extra"],
                                        idsp: id_sous_projet

                                    },
                                    success : function(response){
                                        console.log(response);
                                        rc2k.osa.ui.tache.create({
                                            idp : areponse["extra"],
                                            ide : idetape,
                                            etape : typeetape,
                                            url : "http://sd-83414.dedibox.fr/r2i/api/projet/api/projet/sousprojet/insert_tache_osa.php"

                                        });
                                    }
                                })
                            });

                        }else {
                            rc2k.osa.ui.tache.create({
                                idp : e.id,
                                ide : idetape,
                                etape : typeetape,
                                url : "http://sd-83414.dedibox.fr/r2i/api/projet/api/projet/sousprojet/insert_tache_osa.php"
                            });
                        }
                    }else{
                        alert("Etape non creer merci de l'enregistrer");

                    }

                }


            });

        }
    });
}


function calculetache_osa(typeetape,id_sous_projet,ide,idhref,content_href){

    $.ajax({
        method: "POST",
        url: "api/projet/sousprojet/get_projet_id.php",
        dataType: "json",
        data: {
            idsp: id_sous_projet,
            tentre: ide
        },
        success: function (e) {
            console.log(typeetape);
            console.log(e);
            console.log("calculetache_osa idetape: "+e.idetape+", id:"+e.id);
            if(e.idetape!=0) {

                    $.ajax({
                        method : "GET",
                        url :"app/sys/api/osa/osa_api.php",
                        data:{
                            idetape: e.idetape,
                            typeetape: typeetape,
                            idprojet:e.id
                        },
                        success : function(reponse){
                            $('#'+idhref).html(content_href+reponse);

                        }
                    });

            }

        }
    });


}
function liste_tache_osa(typeetape,id_sous_projet,ide){
    var idligne=0;
    $.ajax({
        method: "POST",
        url: "api/projet/sousprojet/get_projet_id.php",
        dataType: "json",
        data: {
            idsp: id_sous_projet,
            tentre: ide
        },
        success: function (e) {

            console.log("liste_tache_osa calculetache_osa idetape: "+e.idetape+", id:"+e.id);
            if(e.idetape!=0) {

                $.ajax({
                    method : "GET",
                    url :"app/sys/api/osa/osa_api.php",
                    data:{
                        idetape: e.idetape,
                        typeetape: typeetape,
                        idprojet:e.id,
                        methode:"tache_liste"
                    },
                    success : function(reponse){
                        console.log(reponse);
                        var datajson = JSON.parse(reponse);

                       console.log("resultat tache_liste_osa");
                       console.log(datajson);
                        projet_dt = $('#projet_table').DataTable({

                            "data": datajson,

                        });
                        $('#projet_table tbody').on( 'click', 'tr', function () {
                            if ( $(this).hasClass('selected') ) {
                                $(this).removeClass('selected');


                            }
                            else {
                                projet_dt.$('tr.selected').removeClass('selected');
                                $(this).addClass('selected');


                             }

                        } );

                        $('#traite_tache_osa').click(function(){
                            idligne = (projet_dt.row('.selected').data()!=undefined?projet_dt.row('.selected').data()[0]:0);


                            rc2k.osa.ui.tache.traiter({
                                idt : idligne
                            });
                        });
                        $('#affecte_tache_osa').click(function(){
                             idligne = (projet_dt.row('.selected').data()!=undefined?projet_dt.row('.selected').data()[0]:0);

                            rc2k.osa.ui.tache.affecter({
                                idt : idligne
                            });

                        });
                    }
                });

            }

        }
    });

}
