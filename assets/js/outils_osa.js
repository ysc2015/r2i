var tache_dt;
/**
 * Created by fadil on 02/11/16.
 */

var idprojet = undefined;
var nomprojet  = undefined;
var tab_etape  = [];

function appelscriptosa(typeetape, id_sous_projet,ide)
{

    rc2k.osa.ws.auth(window.token,function(response){

        var aresponse = JSON.parse(response);
        var idetape=0;
        var id=0;
        if(false) {
            alert("Authentification non autorisé");
        }else{

            if(idprojet!==undefined){




                idetape = tab_etape[ide];
                id = idprojet;
                if(idetape!=0){
                    if(id ==0){

                        rc2k.osa.ws.projet.create({
                            ref:"",//id_utilisateur connecte
                            prj:nomprojet ,//nom de projet
                            des:nomprojet,//desc else nom projet
                            dat:new Date(),//date fin de projet
                            fil:"2"//ftth
                        }, function(reponse){

                            var areponse = JSON.parse (reponse);

                                if(areponse['error']!=1){
                                    $.ajax({
                                        method: "POST",
                                        url: "api/projet/projet/set_projet_id_osa.php",
                                        data: {
                                            idosa:areponse["extra"],
                                            idsp: id_sous_projet

                                        },
                                        success : function(response){

                                            rc2k.osa.ui.tache.create({
                                                idp : areponse["extra"],
                                                ide : idetape,
                                                etape : typeetape,
                                                url : window.OSA_SERVER+"r2i/api/projet/api/projet/sousprojet/insert_tache_osa.php"

                                            });
                                        }
                                    })
                                }else{
                                    alert("probleme de création de projet au niveau OSA :"+ areponse['message']);
                                }

                        });

                    }else {


                        rc2k.osa.ui.tache.create({
                            idp : id,
                            ide : idetape,
                            etape : typeetape,
                            url : window.OSA_SERVER+"r2i/api/projet/api/projet/sousprojet/insert_tache_osa.php"
                        });
                    }
                }else{
                    alert("Etape non creer merci de l'enregistrer");

                }
            }else{
            $.ajax({
                method: "POST",
                url: "api/projet/sousprojet/get_projet_id.php",
                dataType: "json",
                async : false,
                data: {
                    idsp: id_sous_projet,
                    tentre: ide
                },
                success: function (e) {

                        idprojet = e.id;
                        nomprojet = e.nom;
                        tab_etape = e.tab_etape;

                    idetape = tab_etape[ide];
                    id = idprojet;
                    if(idetape!=0){
                        if(id ==0){
                            rc2k.osa.ws.projet.create({
                                ref:"",//id_utilisateur connecte
                                prj:nomprojet ,//nom de projet
                                des:nomprojet,//desc else nom projet
                                dat:new Date(),//date fin de projet
                                fil:"2"//ftth
                            }, function(reponse){

                                var areponse = JSON.parse (reponse);

                                $.ajax({
                                    method: "POST",
                                    url: "api/projet/projet/set_projet_id_osa.php",
                                    data: {
                                        idosa:areponse["extra"],
                                        idsp: id_sous_projet

                                    },
                                    success : function(response){

                                        rc2k.osa.ui.tache.create({
                                            idp : areponse["extra"],
                                            ide : idetape,
                                            etape : typeetape,
                                            url : window.OSA_SERVER+"r2i/api/projet/api/projet/sousprojet/insert_tache_osa.php"

                                        });
                                    }
                                })
                            });

                        }else {

                            rc2k.osa.ui.tache.create({
                                idp : id,
                                ide : idetape,
                                etape : typeetape,
                                url : window.OSA_SERVER+"r2i/api/projet/api/projet/sousprojet/insert_tache_osa.php"
                            });
                        }
                    }else{
                        alert("Etape non creer merci de l'enregistrer");

                    }



                },
                error:function (e) {
                    console.log( "Error");
                    console.log( e);
                }
            });

        }





        }
    });
}

 function calculetache_osa(typeetape,id_sous_projet,ide,idhref,content_href){

    if(idprojet!==undefined  ){
        if(tab_etape[ide]!=0){
            $.ajax({
                method : "GET",
                url :"app/sys/api/osa/osa_api.php",
                data:{
                    idetape: tab_etape[ide],
                    typeetape: typeetape,
                    idprojet:idprojet,
                    token:window.token
                },
                success : function(reponse){
                    $('#'+idhref).html(content_href+reponse);

                },
                error:function (e) {
                    console.log( "Error");
                    console.log( e);
                }
            });
        }


    }else{
        $.ajax({
            method: "POST",
            url: "api/projet/sousprojet/get_projet_id.php",
            dataType: "json",
            async : false,
            data: {
                idsp: id_sous_projet,
                tentre: ide
            },
            success: function (e) {
                    idprojet = e.id;
                    nomprojet = e.nom;
                    tab_etape = e.tab_etape;
                if(tab_etape[ide]!=0) {
                    $.ajax({
                        method : "GET",
                        url :"app/sys/api/osa/osa_api.php",
                        data:{
                            idetape: tab_etape[ide],
                            typeetape: typeetape,
                            idprojet:idprojet,
                            token:window.token
                        },
                        success : function(reponse){
                            $('#'+idhref).html(content_href+reponse);

                        },
                        error:function (e) {
                            console.log( "Error");
                            console.log( e);
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


}
function liste_tache_osa(typeetape,id_sous_projet,ide){
    var idligne=0;
if(idprojet!==undefined){
    if(idprojet!=0) {
        $.ajax({
            method : "GET",
            url :"app/sys/api/osa/osa_api.php",
            data:{
                idetape: tab_etape[ide],
                typeetape: typeetape,
                idprojet:idprojet,
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
}else{
        $.ajax({
            method: "POST",
            url: "api/projet/sousprojet/get_projet_id.php",
            dataType: "json",
            async : false,
            data: {
                idsp: id_sous_projet,
                tentre: ide
            },
            success: function (e) {

                    idprojet = e.id;
                    nomprojet = e.nom;
                    tab_etape = e.tab_etape;

                if(idprojet!=0) {
                    $.ajax({
                        method : "GET",
                        url :"app/sys/api/osa/osa_api.php",
                        data:{
                            idetape: tab_etape[ide],
                            typeetape: typeetape,
                            idprojet:idprojet,
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



            },
            error:function (e) {
                console.log( "Error");
                console.log( e);
            }
        });

    }



}
