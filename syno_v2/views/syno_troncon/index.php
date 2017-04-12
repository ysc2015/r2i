<?php
$nbrPerPage = 10;
if (isset($_POST['nbrPerPage'])) {
    $nbrPerPage = $_POST['nbrPerPage'];
}
$nbr = DBHelper::count('syno_troncon');
$nbrPages = ceil($nbr / $nbrPerPage);
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <form class="pull-right mail-search">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" id="search_value" placeholder="Search for">
                        
                        <div class="input-group-btn">
                            <button id="btn_search" class="btn btn-sm btn-primary">
                                Search
                            </button>
                        </div>
                        
                        <select id="search_by" class="form-control input-sm">
                            <option value="id_troncon"><?php echo $lang["id_troncon_label"]; ?></option><option value="chambre_src"><?php echo $lang["chambre_src_label"]; ?></option><option value="chambre_dst"><?php echo $lang["chambre_dst_label"]; ?></option><option value="masque_src"><?php echo $lang["masque_src_label"]; ?></option><option value="masque_dst"><?php echo $lang["masque_dst_label"]; ?></option><option value="alveole_src"><?php echo $lang["alveole_src_label"]; ?></option><option value="alveole_dst"><?php echo $lang["alveole_dst_label"]; ?></option><option value="conduite_libre"><?php echo $lang["conduite_libre_label"]; ?></option><option value="type_reseau"><?php echo $lang["type_reseau_label"]; ?></option><option value="diametre"><?php echo $lang["diametre_label"]; ?></option><option value="etat_aveole"><?php echo $lang["etat_aveole_label"]; ?></option><option value="alveole_libre_4"><?php echo $lang["alveole_libre_4_label"]; ?></option><option value="passage"><?php echo $lang["passage_label"]; ?></option><option value="longueurGC"><?php echo $lang["longueurGC_label"]; ?></option><option value="alveole_diametre"><?php echo $lang["alveole_diametre_label"]; ?></option><option value="alveole_100_free"><?php echo $lang["alveole_100_free_label"]; ?></option><option value="autre"><?php echo $lang["autre_label"]; ?></option><option value="id_ordre_de_travail"><?php echo $lang["id_ordre_de_travail_label"]; ?></option>
                        </select>
                    </div>
                </form>

                <h2>
                    <?php echo $lang['syno_troncon_TITLE']; ?> 
                    <sup><span class="label label-info" id="nbrOf_syno_troncon"><?php echo $nbr; ?></span>
                    <span class="label label-primary" id="nPage"></span></sup> 
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm" id="btn_prev"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm" id="btn_next"><i class="fa fa-arrow-right"></i></button>
                    </div>

                    <button id="btn_new" data-toggle="modal" href="#modal-form" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New syno_troncon</button>
                    <button id="btn_refresh" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</button>
                    <button id="btn_checkAll" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left"><i class="fa fa-check"></i> Select All</button>
                    <button id="btn_remove" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>
                </div>
            </div>
            
            <div class="mail-box-header">
                <button class="btn btn-xs btn-primary" onclick="show_hide(0)">id_troncon</button> <button class="btn btn-xs btn-primary" onclick="show_hide(1)">chambre_src</button> <button class="btn btn-xs btn-primary" onclick="show_hide(2)">chambre_dst</button> <button class="btn btn-xs btn-primary" onclick="show_hide(3)">masque_src</button> <button class="btn btn-xs btn-primary" onclick="show_hide(4)">masque_dst</button> <button class="btn btn-xs btn-primary" onclick="show_hide(5)">alveole_src</button> <button class="btn btn-xs btn-primary" onclick="show_hide(6)">alveole_dst</button> <button class="btn btn-xs btn-primary" onclick="show_hide(7)">conduite_libre</button> <button class="btn btn-xs btn-primary" onclick="show_hide(8)">type_reseau</button> <button class="btn btn-xs btn-primary" onclick="show_hide(9)">diametre</button> <button class="btn btn-xs btn-primary" onclick="show_hide(10)">etat_aveole</button> <button class="btn btn-xs btn-primary" onclick="show_hide(11)">alveole_libre_4</button> <button class="btn btn-xs btn-primary" onclick="show_hide(12)">passage</button> <button class="btn btn-xs btn-primary" onclick="show_hide(13)">longueurGC</button> <button class="btn btn-xs btn-primary" onclick="show_hide(14)">alveole_diametre</button> <button class="btn btn-xs btn-primary" onclick="show_hide(15)">alveole_100_free</button> <button class="btn btn-xs btn-primary" onclick="show_hide(16)">autre</button> <button class="btn btn-xs btn-primary" onclick="show_hide(17)">id_ordre_de_travail</button> 
            </div>

            <div class="mail-box">
                <table class="table table-bordered table-hover table-mail">
                    <thead>
                        <tr><th></th><th id="cell_0_0">id_troncon</th><th id="cell_0_1">chambre_src</th><th id="cell_0_2">chambre_dst</th><th id="cell_0_3">masque_src</th><th id="cell_0_4">masque_dst</th><th id="cell_0_5">alveole_src</th><th id="cell_0_6">alveole_dst</th><th id="cell_0_7">conduite_libre</th><th id="cell_0_8">type_reseau</th><th id="cell_0_9">diametre</th><th id="cell_0_10">etat_aveole</th><th id="cell_0_11">alveole_libre_4</th><th id="cell_0_12">passage</th><th id="cell_0_13">longueurGC</th><th id="cell_0_14">alveole_diametre</th><th id="cell_0_15">alveole_100_free</th><th id="cell_0_16">autre</th><th id="cell_0_17">id_ordre_de_travail</th><th>Action</th></tr>
                    </thead>
                    <tbody id="syno_troncon_body_id">
                    </tbody>
                    <tfoot>
                        
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<div id="modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 b-r">
                        <h3 class="m-t-none m-b"><?php echo $lang["syno_troncon_modal_title"]; ?></h3>

                        <p><?php echo $lang["syno_troncon_modal_description"]; ?></p>

                        <input id="id_troncon_update" type="hidden" value=""> 
                        
                        <div class="form-group">
                            <label for="<?php echo $lang["id_troncon_id"]; ?>"><?php echo $lang["id_troncon_label"]; ?></label> 
                            <input id="<?php echo $lang["id_troncon_id"]; ?>" placeholder="<?php echo $lang["id_troncon_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["chambre_src_id"]; ?>"><?php echo $lang["chambre_src_label"]; ?></label> 
                            <input id="<?php echo $lang["chambre_src_id"]; ?>" placeholder="<?php echo $lang["chambre_src_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["chambre_dst_id"]; ?>"><?php echo $lang["chambre_dst_label"]; ?></label> 
                            <input id="<?php echo $lang["chambre_dst_id"]; ?>" placeholder="<?php echo $lang["chambre_dst_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["masque_src_id"]; ?>"><?php echo $lang["masque_src_label"]; ?></label> 
                            <input id="<?php echo $lang["masque_src_id"]; ?>" placeholder="<?php echo $lang["masque_src_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["masque_dst_id"]; ?>"><?php echo $lang["masque_dst_label"]; ?></label> 
                            <input id="<?php echo $lang["masque_dst_id"]; ?>" placeholder="<?php echo $lang["masque_dst_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["alveole_src_id"]; ?>"><?php echo $lang["alveole_src_label"]; ?></label> 
                            <input id="<?php echo $lang["alveole_src_id"]; ?>" placeholder="<?php echo $lang["alveole_src_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["alveole_dst_id"]; ?>"><?php echo $lang["alveole_dst_label"]; ?></label> 
                            <input id="<?php echo $lang["alveole_dst_id"]; ?>" placeholder="<?php echo $lang["alveole_dst_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["conduite_libre_id"]; ?>"><?php echo $lang["conduite_libre_label"]; ?></label> 
                            <input id="<?php echo $lang["conduite_libre_id"]; ?>" placeholder="<?php echo $lang["conduite_libre_placeholder"]; ?>" class="form-control i-checks-form-control" type="checkbox" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["type_reseau_id"]; ?>"><?php echo $lang["type_reseau_label"]; ?></label> 
                            <input id="<?php echo $lang["type_reseau_id"]; ?>" placeholder="<?php echo $lang["type_reseau_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["diametre_id"]; ?>"><?php echo $lang["diametre_label"]; ?></label> 
                            <input id="<?php echo $lang["diametre_id"]; ?>" placeholder="<?php echo $lang["diametre_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["etat_aveole_id"]; ?>"><?php echo $lang["etat_aveole_label"]; ?></label> 
                            <input id="<?php echo $lang["etat_aveole_id"]; ?>" placeholder="<?php echo $lang["etat_aveole_placeholder"]; ?>" class="form-control i-checks-form-control" type="checkbox" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["alveole_libre_4_id"]; ?>"><?php echo $lang["alveole_libre_4_label"]; ?></label> 
                            <input id="<?php echo $lang["alveole_libre_4_id"]; ?>" placeholder="<?php echo $lang["alveole_libre_4_placeholder"]; ?>" class="form-control i-checks-form-control" type="checkbox" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["passage_id"]; ?>"><?php echo $lang["passage_label"]; ?></label> 
                            <input id="<?php echo $lang["passage_id"]; ?>" placeholder="<?php echo $lang["passage_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["longueurGC_id"]; ?>"><?php echo $lang["longueurGC_label"]; ?></label> 
                            <input id="<?php echo $lang["longueurGC_id"]; ?>" placeholder="<?php echo $lang["longueurGC_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["alveole_diametre_id"]; ?>"><?php echo $lang["alveole_diametre_label"]; ?></label> 
                            <input id="<?php echo $lang["alveole_diametre_id"]; ?>" placeholder="<?php echo $lang["alveole_diametre_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["alveole_100_free_id"]; ?>"><?php echo $lang["alveole_100_free_label"]; ?></label> 
                            <input id="<?php echo $lang["alveole_100_free_id"]; ?>" placeholder="<?php echo $lang["alveole_100_free_placeholder"]; ?>" class="form-control i-checks-form-control" type="checkbox" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["autre_id"]; ?>"><?php echo $lang["autre_label"]; ?></label> 
                            <input id="<?php echo $lang["autre_id"]; ?>" placeholder="<?php echo $lang["autre_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["id_ordre_de_travail_id"]; ?>"><?php echo $lang["id_ordre_de_travail_label"]; ?></label> 
                            <input id="<?php echo $lang["id_ordre_de_travail_id"]; ?>" placeholder="<?php echo $lang["id_ordre_de_travail_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div>
                            <button id="btn_save" data-api="add" class="btn btn-sm btn-primary pull-right m-t-n-xs"><strong>Save</strong></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var page = 1;
    var maxPage = <?php echo $nbrPages; ?>;
    var apiName = 'syno_troncon';
    var lastResponseData = null;
    var hiddenColumns = [false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false];
    
    function getData() {
        var obj = {
                        <?php echo $lang["id_troncon_id"]; ?>: valById("<?php echo $lang["id_troncon_id"]; ?>"),
            <?php echo $lang["chambre_src_id"]; ?>: valById("<?php echo $lang["chambre_src_id"]; ?>"),
            <?php echo $lang["chambre_dst_id"]; ?>: valById("<?php echo $lang["chambre_dst_id"]; ?>"),
            <?php echo $lang["masque_src_id"]; ?>: valById("<?php echo $lang["masque_src_id"]; ?>"),
            <?php echo $lang["masque_dst_id"]; ?>: valById("<?php echo $lang["masque_dst_id"]; ?>"),
            <?php echo $lang["alveole_src_id"]; ?>: valById("<?php echo $lang["alveole_src_id"]; ?>"),
            <?php echo $lang["alveole_dst_id"]; ?>: valById("<?php echo $lang["alveole_dst_id"]; ?>"),
            <?php echo $lang["conduite_libre_id"]; ?>: valById("<?php echo $lang["conduite_libre_id"]; ?>"),
            <?php echo $lang["type_reseau_id"]; ?>: valById("<?php echo $lang["type_reseau_id"]; ?>"),
            <?php echo $lang["diametre_id"]; ?>: valById("<?php echo $lang["diametre_id"]; ?>"),
            <?php echo $lang["etat_aveole_id"]; ?>: valById("<?php echo $lang["etat_aveole_id"]; ?>"),
            <?php echo $lang["alveole_libre_4_id"]; ?>: valById("<?php echo $lang["alveole_libre_4_id"]; ?>"),
            <?php echo $lang["passage_id"]; ?>: valById("<?php echo $lang["passage_id"]; ?>"),
            <?php echo $lang["longueurGC_id"]; ?>: valById("<?php echo $lang["longueurGC_id"]; ?>"),
            <?php echo $lang["alveole_diametre_id"]; ?>: valById("<?php echo $lang["alveole_diametre_id"]; ?>"),
            <?php echo $lang["alveole_100_free_id"]; ?>: valById("<?php echo $lang["alveole_100_free_id"]; ?>"),
            <?php echo $lang["autre_id"]; ?>: valById("<?php echo $lang["autre_id"]; ?>"),
            <?php echo $lang["id_ordre_de_travail_id"]; ?>: valById("<?php echo $lang["id_ordre_de_travail_id"]; ?>"),

        };
        if($('#id_troncon_update').val() !== '') {
            obj.id_troncon_update = $('#id_troncon_update').val();
        }
        return obj;
    }
    
    function checkData(data) {
        
        if (data.<?php echo $lang["chambre_src_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["chambre_src_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["chambre_dst_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["chambre_dst_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["masque_src_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["masque_src_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["masque_dst_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["masque_dst_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["alveole_src_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["alveole_src_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["alveole_dst_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["alveole_dst_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["conduite_libre_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["conduite_libre_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["type_reseau_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["type_reseau_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["diametre_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["diametre_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["etat_aveole_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["etat_aveole_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["alveole_libre_4_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["alveole_libre_4_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["passage_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["passage_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["longueurGC_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["longueurGC_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["alveole_diametre_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["alveole_diametre_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["alveole_100_free_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["alveole_100_free_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["autre_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["autre_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["id_ordre_de_travail_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["id_ordre_de_travail_empty_message"]; ?>"], "error");
            return false;
        }
        
        return true;
    }
    
    function updateAPI() {
        var data = getData();
        if (!checkData(data)) {
            return;
        }
        $.ajax({
            url: API_BASE_URL + apiName + '&action=update',
            method: 'POST',
            data: data,
            success: function (response) {
                if (response.err == 0) {
                    showNotification('DONE', response.msg);
                    listAPI(page);
                }
            },
            error: function (response) {},
            complete: function () {},
            beforeSend: function () {}
        });
    }
    
    function addAPI() {
        var data = getData();
        if (!checkData(data)) {
            return;
        }
        $.ajax({
            url: API_BASE_URL + apiName + '&action=add',
            method: 'POST',
            data: data,
            success: function (response) {
                if (response.err == 0) {
                    showNotification('DONE', response.msg);
                    listAPI(page);
                    var nbr = $('#nbrOf_syno_troncon').text();
                    nbr++;
                    $('#nbrOf_syno_troncon').text(nbr);
                }
            },
            error: function (response) {},
            complete: function () {},
            beforeSend: function () {}
        });
    }
    
    function deleteAPI() {
        var elements = document.getElementsByClassName('i-checks');
        var ids = '';
        var elementToRemove = 0;
        for (var i = 0; i < elements.length; i++) {
            if (elements[i].checked) {
                ids += elements[i].value + ',';
                elementToRemove++;
            }
        }
        if (ids.length > 0) {
            ids = ids.substring(0, ids.length - 1);
            $.ajax({
                url: API_BASE_URL + apiName + '&action=delete',
                method: 'POST',
                data: {
                    ids: ids
                },
                success: function (response) {
                    if (response.err == 0) {
                        showNotification('DONE', response.msg);
                        if (page == maxPage) {
                            prevPage();
                        }
                        listAPI(page);
                        var nbr = $('#nbrOf_syno_troncon').text();
                        nbr -= elementToRemove;
                        $('#nbrOf_syno_troncon').text(nbr);
                    }
                },
                error: function (response) {},
                complete: function () {},
                beforeSend: function () {}
            });
        }
    }
    
    function listAPI(page) {
        var objData = {};
        objData.page = page;
        var search_value = $('#search_value').val().trim();
        var search_by = $('#search_by').val();
        
        if(search_value != '') {
            objData.search_value = search_value;
            objData.search_by = search_by;
        }
        $.ajax({
            url: API_BASE_URL + apiName + '&action=list',
            method: 'POST',
            data: objData,
            success: function (response) {
                if (response.err == 0) {
                    lastResponseData = response.data;
                    $('#syno_troncon_body_id').html('');
                    var html = '';
                    var addedHtml = ["<span class='label label-", "primary" , "'><i class='fa fa-", 'check' , "'></i></span>"];
                    for (var i = 0; i < response.data.length; i++) {
                        html = '<tr id="id_' + i + '" class="">';
                        html += '<td class="check-mail">';
                        html += '<input value="' + response.data[i].id_troncon + '" type="checkbox" class="i-checks">';
                        html += '</td>';
                        html += "<td id=\"cell_" + i + "_0\" class=\"mail-contact\">" + response.data[i].id_troncon + "</td>";
                        html += "<td id=\"cell_" + i + "_1\" class=\"mail-contact\">" + response.data[i].chambre_src + "</td>";
                        html += "<td id=\"cell_" + i + "_2\" class=\"mail-contact\">" + response.data[i].chambre_dst + "</td>";
                        html += "<td id=\"cell_" + i + "_3\" class=\"mail-contact\">" + response.data[i].masque_src + "</td>";
                        html += "<td id=\"cell_" + i + "_4\" class=\"mail-contact\">" + response.data[i].masque_dst + "</td>";
                        html += "<td id=\"cell_" + i + "_5\" class=\"mail-contact\">" + response.data[i].alveole_src + "</td>";
                        html += "<td id=\"cell_" + i + "_6\" class=\"mail-contact\">" + response.data[i].alveole_dst + "</td>";

                       if(response.data[i].conduite_libre == 1) { 
                            addedHtml[1] = "primary";
                            addedHtml[3] = "check";
                       } else {
                            addedHtml[1] = "danger";
                            addedHtml[3] = "remove";
                       }
                       var str = addedHtml.join("");                            
                       html += "<td id=\"cell_" + i + "_7\" class=\"mail-contact\">" + str + "</i></td>";
                        html += "<td id=\"cell_" + i + "_8\" class=\"mail-contact\">" + response.data[i].type_reseau + "</td>";
                        html += "<td id=\"cell_" + i + "_9\" class=\"mail-contact\">" + response.data[i].diametre + "</td>";

                       if(response.data[i].etat_aveole == 1) { 
                            addedHtml[1] = "primary";
                            addedHtml[3] = "check";
                       } else {
                            addedHtml[1] = "danger";
                            addedHtml[3] = "remove";
                       }
                       var str = addedHtml.join("");                            
                       html += "<td id=\"cell_" + i + "_10\" class=\"mail-contact\">" + str + "</i></td>";

                       if(response.data[i].alveole_libre_4 == 1) { 
                            addedHtml[1] = "primary";
                            addedHtml[3] = "check";
                       } else {
                            addedHtml[1] = "danger";
                            addedHtml[3] = "remove";
                       }
                       var str = addedHtml.join("");                            
                       html += "<td id=\"cell_" + i + "_11\" class=\"mail-contact\">" + str + "</i></td>";
                        html += "<td id=\"cell_" + i + "_12\" class=\"mail-contact\">" + response.data[i].passage + "</td>";
                        html += "<td id=\"cell_" + i + "_13\" class=\"mail-contact\">" + response.data[i].longueurGC + "</td>";
                        html += "<td id=\"cell_" + i + "_14\" class=\"mail-contact\">" + response.data[i].alveole_diametre + "</td>";

                       if(response.data[i].alveole_100_free == 1) { 
                            addedHtml[1] = "primary";
                            addedHtml[3] = "check";
                       } else {
                            addedHtml[1] = "danger";
                            addedHtml[3] = "remove";
                       }
                       var str = addedHtml.join("");                            
                       html += "<td id=\"cell_" + i + "_15\" class=\"mail-contact\">" + str + "</i></td>";
                        html += "<td id=\"cell_" + i + "_16\" class=\"mail-contact\">" + response.data[i].autre + "</td>";
                        html += "<td id=\"cell_" + i + "_17\" class=\"mail-contact\">" + response.data[i].id_ordre_de_travail + "</td>";

                        html += '<td class="">' +
                                '<button onclick="btn_edit_click(' + i + ');" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>' +
                                '</td>';
                        //html += '<td class="text-right mail-date"></td>';
                        html += '</tr>';
                        $('#syno_troncon_body_id').append(html);

                        var tr = document.getElementById('id_' + i);
                        applyClasses(tr);
                        $(tr.children[0].children[0]).iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                        });
                    }
                    
                    for(var i = 0 ; i < hiddenColumns.length; i++) {
                        show_hide(hiddenColumns[i]);
                    }
                    $('#nPage').text('Page : ' + page + ' - ' + response.extra.Pages);
                    $('#nbrOf_syno_troncon').text('Number : ' + response.extra.NbrQ + ' Total : ' + response.extra.NbrT);
                }
            },
            error: function (response) {},
            complete: function () {},
            beforeSend: function () {}
        });
    }
    
    function nextPage() {
        if (page < maxPage)
        {
            page++;
            return true;
        }
        return false;
    }

    function prevPage() {
        if (page > 1) {
            page--;
            return true;
        }
        return false;
    }

    function btn_edit_click(index) {
        var data = lastResponseData[index];
        $('#btn_save').attr('data-api', 'update');
        $('#id_troncon_update').val(data.id_troncon);
                $("#<?php echo $lang["id_troncon_id"]; ?>").val(data.id_troncon);
        $("#<?php echo $lang["chambre_src_id"]; ?>").val(data.chambre_src);
        $("#<?php echo $lang["chambre_dst_id"]; ?>").val(data.chambre_dst);
        $("#<?php echo $lang["masque_src_id"]; ?>").val(data.masque_src);
        $("#<?php echo $lang["masque_dst_id"]; ?>").val(data.masque_dst);
        $("#<?php echo $lang["alveole_src_id"]; ?>").val(data.alveole_src);
        $("#<?php echo $lang["alveole_dst_id"]; ?>").val(data.alveole_dst);

            if(data.conduite_libre) {
                $('#<?php echo $lang["conduite_libre_id"]; ?>').iCheck("check");    
            }
        $("#<?php echo $lang["type_reseau_id"]; ?>").val(data.type_reseau);
        $("#<?php echo $lang["diametre_id"]; ?>").val(data.diametre);

            if(data.etat_aveole) {
                $('#<?php echo $lang["etat_aveole_id"]; ?>').iCheck("check");    
            }

            if(data.alveole_libre_4) {
                $('#<?php echo $lang["alveole_libre_4_id"]; ?>').iCheck("check");    
            }
        $("#<?php echo $lang["passage_id"]; ?>").val(data.passage);
        $("#<?php echo $lang["longueurGC_id"]; ?>").val(data.longueurGC);
        $("#<?php echo $lang["alveole_diametre_id"]; ?>").val(data.alveole_diametre);

            if(data.alveole_100_free) {
                $('#<?php echo $lang["alveole_100_free_id"]; ?>').iCheck("check");    
            }
        $("#<?php echo $lang["autre_id"]; ?>").val(data.autre);
        $("#<?php echo $lang["id_ordre_de_travail_id"]; ?>").val(data.id_ordre_de_travail);

        $('#modal-form').modal('show');
    }

    $(function () {
        listAPI(page);
        
        $('#btn_search').click(function () {
            event.preventDefault();
            event.stopPropagation();
            var search_value = $('#search_value').val().trim();
        
            if(search_value != '') {
                page = 1;
                listAPI(page);
            } else {
                page = 1;
                listAPI(page);
            }
        });
        
        var selectBtnValues = ['Select All', 'Deselect All'];
        var selectBtnSelectedIndex = 0;
        $('#btn_checkAll').click(function () {
            if(selectBtnSelectedIndex == 0) {
                iCheckToggleByClass('i-checks','check');
                $(this).html('<i class="fa fa-check"></i> ' + selectBtnValues[1]);
                selectBtnSelectedIndex = 1;
            } else {
                selectBtnSelectedIndex = 0;
                iCheckToggleByClass('i-checks','uncheck');
                $(this).html('<i class="fa fa-check"></i> ' + selectBtnValues[0]);
            }
            
            
        });

        $('#btn_prev').click(function () {
            if (prevPage()) {
                listAPI(page);
            }
        });

        $('#btn_remove').click(deleteAPI);

        $('#btn_refresh').click(function () {
            listAPI(page);
        });

        $('#btn_save').click(function () {
            var data_api = $('#btn_save').attr('data-api');
            if (data_api == 'add') {
                addAPI();
            } else {
                updateAPI();
            }

        });

        $('#btn_new').click(function () {
            $('#btn_save').attr('data-api', 'add');
        });

        $('#btn_next').click(function (event) {
            if (nextPage()) {
                listAPI(page);
            }
        });
    });
</script>