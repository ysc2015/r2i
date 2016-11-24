var tache_dt;
/**
 * Created by fadil on 02/11/16.
 */
function appelscriptosa(typeetape, id_sous_projet,ide)
{
    throw "duplicate";
    rc2k.osa.ws.auth(window.token,function(response){
       // console.log(response);
        var aresponse = JSON.parse(response);
        var idetape=0;
        if(false) {
            alert("Authentification non autorisé");
        }else{
            console.log("api/projet/sousprojet/get_projet_id.php : id_sous_projet " + id_sous_projet + ", ide : " + ide);
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

                console.log("e");
                console.log(e);
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
                                console.log("areponse rc2k.osa.ws.projet.create")
                                console.log(reponse)
                                var areponse = JSON.parse (reponse);

                                $.ajax({
                                    method: "POST",
                                    url: "api/projet/projet/set_projet_id_osa.php",
                                    data: {
                                        idosa:areponse["extra"],
                                        idsp: id_sous_projet

                                    },
                                    success : function(response){
                                        console.log("api/projet/projet/set_projet_id_osa.php")
                                        console.log(response)

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
   // console.log("calculetache_osa : "+ide)
    //if(ide == "SousProjetPlaqueSurveyAdresse") console.log(typeetape + " * " + id_sous_projet + " * " + ide)

    $.ajax({
        method: "POST",
        url: "api/projet/sousprojet/get_projet_id.php",
        dataType: "json",
        data: {
            idsp: id_sous_projet,
            tentre: ide
        },
        success: function (e) {
           // if(ide == "transportcmdfintravaux") console.log(e);
            if(e.idetape!=0) {

                    $.ajax({
                        method : "GET",
                        url :"app/sys/api/osa/osa_api.php",
                        data:{
                            idetape: e.idetape,
                            typeetape: typeetape,
                            idprojet:e.id,
                            token:window.token
                        },
                        success : function(reponse){
                            $('#'+idhref).html(content_href+reponse);

                        }
                    });

            }

        },
        error:function (e) {
            console.log( "Error");
            console.log( e);
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



            if(e.idetape!=0) {

                $.ajax({
                    method : "GET",
                    url :"app/sys/api/osa/osa_api.php",
                    data:{
                        idetape: e.idetape,
                        typeetape: typeetape,
                        idprojet:e.id,
                        methode:"tache_liste",
                        token:window.token
                    },
                    success : function(reponse){

                        var datajson = JSON.parse(reponse);


                        $('#tache_table').DataTable().destroy();


                        tache_dt = $('#tache_table').DataTable({

                            "data": datajson,
                            "columnDefs": [
                                { "targets": [0], "visible": false, "searchable": false }


                            ],

                        });



                    }
                });

            }

        }
    });

}
