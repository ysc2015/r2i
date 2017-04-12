<?php
$nbrPerPage = 10;
if (isset($_POST['nbrPerPage'])) {
    $nbrPerPage = $_POST['nbrPerPage'];
}
$nbr = DBHelper::count('syno_alveole');
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
                            <option value="id_alveole"><?php echo $lang["id_alveole_label"]; ?></option><option value="masque"><?php echo $lang["masque_label"]; ?></option><option value="taille"><?php echo $lang["taille_label"]; ?></option><option value="etat"><?php echo $lang["etat_label"]; ?></option><option value="position"><?php echo $lang["position_label"]; ?></option><option value="couleur"><?php echo $lang["couleur_label"]; ?></option><option value="tubage"><?php echo $lang["tubage_label"]; ?></option><option value="tubage_taille"><?php echo $lang["tubage_taille_label"]; ?></option><option value="id_chambre_src"><?php echo $lang["id_chambre_src_label"]; ?></option><option value="id_chambre_dst"><?php echo $lang["id_chambre_dst_label"]; ?></option>
                        </select>
                    </div>
                </form>

                <h2>
                    <?php echo $lang['syno_alveole_TITLE']; ?> 
                    <sup><span class="label label-info" id="nbrOf_syno_alveole"><?php echo $nbr; ?></span>
                    <span class="label label-primary" id="nPage"></span></sup> 
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm" id="btn_prev"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm" id="btn_next"><i class="fa fa-arrow-right"></i></button>
                    </div>

                    <button id="btn_new" data-toggle="modal" href="#modal-form" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New syno_alveole</button>
                    <button id="btn_refresh" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</button>
                    <button id="btn_checkAll" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left"><i class="fa fa-check"></i> Select All</button>
                    <button id="btn_remove" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>
                </div>
            </div>
            
            <div class="mail-box-header">
                <button class="btn btn-xs btn-primary" onclick="show_hide(0)">id_alveole</button> <button class="btn btn-xs btn-primary" onclick="show_hide(1)">masque</button> <button class="btn btn-xs btn-primary" onclick="show_hide(2)">taille</button> <button class="btn btn-xs btn-primary" onclick="show_hide(3)">etat</button> <button class="btn btn-xs btn-primary" onclick="show_hide(4)">position</button> <button class="btn btn-xs btn-primary" onclick="show_hide(5)">couleur</button> <button class="btn btn-xs btn-primary" onclick="show_hide(6)">tubage</button> <button class="btn btn-xs btn-primary" onclick="show_hide(7)">tubage_taille</button> <button class="btn btn-xs btn-primary" onclick="show_hide(8)">id_chambre_src</button> <button class="btn btn-xs btn-primary" onclick="show_hide(9)">id_chambre_dst</button> 
            </div>

            <div class="mail-box">
                <table class="table table-bordered table-hover table-mail">
                    <thead>
                        <tr><th></th><th id="cell_0_0">id_alveole</th><th id="cell_0_1">masque</th><th id="cell_0_2">taille</th><th id="cell_0_3">etat</th><th id="cell_0_4">position</th><th id="cell_0_5">couleur</th><th id="cell_0_6">tubage</th><th id="cell_0_7">tubage_taille</th><th id="cell_0_8">id_chambre_src</th><th id="cell_0_9">id_chambre_dst</th><th>Action</th></tr>
                    </thead>
                    <tbody id="syno_alveole_body_id">
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
                        <h3 class="m-t-none m-b"><?php echo $lang["syno_alveole_modal_title"]; ?></h3>

                        <p><?php echo $lang["syno_alveole_modal_description"]; ?></p>

                        <input id="id_alveole_update" type="hidden" value=""> 
                        
                        <div class="form-group">
                            <label for="<?php echo $lang["id_alveole_id"]; ?>"><?php echo $lang["id_alveole_label"]; ?></label> 
                            <input id="<?php echo $lang["id_alveole_id"]; ?>" placeholder="<?php echo $lang["id_alveole_placeholder"]; ?>" class="form-control " type="text" readonly>
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["masque_id"]; ?>"><?php echo $lang["masque_label"]; ?></label> 
                            <input id="<?php echo $lang["masque_id"]; ?>" placeholder="<?php echo $lang["masque_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["taille_id"]; ?>"><?php echo $lang["taille_label"]; ?></label> 
                            <input id="<?php echo $lang["taille_id"]; ?>" placeholder="<?php echo $lang["taille_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["etat_id"]; ?>"><?php echo $lang["etat_label"]; ?></label> 
                            <input id="<?php echo $lang["etat_id"]; ?>" placeholder="<?php echo $lang["etat_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["position_id"]; ?>"><?php echo $lang["position_label"]; ?></label> 
                            <input id="<?php echo $lang["position_id"]; ?>" placeholder="<?php echo $lang["position_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["couleur_id"]; ?>"><?php echo $lang["couleur_label"]; ?></label> 
                            <input id="<?php echo $lang["couleur_id"]; ?>" placeholder="<?php echo $lang["couleur_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["tubage_id"]; ?>"><?php echo $lang["tubage_label"]; ?></label> 
                            <input id="<?php echo $lang["tubage_id"]; ?>" placeholder="<?php echo $lang["tubage_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["tubage_taille_id"]; ?>"><?php echo $lang["tubage_taille_label"]; ?></label> 
                            <input id="<?php echo $lang["tubage_taille_id"]; ?>" placeholder="<?php echo $lang["tubage_taille_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["id_chambre_src_id"]; ?>"><?php echo $lang["id_chambre_src_label"]; ?></label> 
                            <input id="<?php echo $lang["id_chambre_src_id"]; ?>" placeholder="<?php echo $lang["id_chambre_src_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["id_chambre_dst_id"]; ?>"><?php echo $lang["id_chambre_dst_label"]; ?></label> 
                            <input id="<?php echo $lang["id_chambre_dst_id"]; ?>" placeholder="<?php echo $lang["id_chambre_dst_placeholder"]; ?>" class="form-control " type="text" >
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
    var apiName = 'syno_alveole';
    var lastResponseData = null;
    var hiddenColumns = [false,false,false,false,false,false,false,false,false,false];
    
    function getData() {
        var obj = {
                        <?php echo $lang["id_alveole_id"]; ?>: valById("<?php echo $lang["id_alveole_id"]; ?>"),
            <?php echo $lang["masque_id"]; ?>: valById("<?php echo $lang["masque_id"]; ?>"),
            <?php echo $lang["taille_id"]; ?>: valById("<?php echo $lang["taille_id"]; ?>"),
            <?php echo $lang["etat_id"]; ?>: valById("<?php echo $lang["etat_id"]; ?>"),
            <?php echo $lang["position_id"]; ?>: valById("<?php echo $lang["position_id"]; ?>"),
            <?php echo $lang["couleur_id"]; ?>: valById("<?php echo $lang["couleur_id"]; ?>"),
            <?php echo $lang["tubage_id"]; ?>: valById("<?php echo $lang["tubage_id"]; ?>"),
            <?php echo $lang["tubage_taille_id"]; ?>: valById("<?php echo $lang["tubage_taille_id"]; ?>"),
            <?php echo $lang["id_chambre_src_id"]; ?>: valById("<?php echo $lang["id_chambre_src_id"]; ?>"),
            <?php echo $lang["id_chambre_dst_id"]; ?>: valById("<?php echo $lang["id_chambre_dst_id"]; ?>"),

        };
        if($('#id_alveole_update').val() !== '') {
            obj.id_alveole_update = $('#id_alveole_update').val();
        }
        return obj;
    }
    
    function checkData(data) {
        
        if (data.<?php echo $lang["masque_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["masque_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["taille_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["taille_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["etat_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["etat_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["position_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["position_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["couleur_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["couleur_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["tubage_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["tubage_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["tubage_taille_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["tubage_taille_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["id_chambre_src_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["id_chambre_src_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["id_chambre_dst_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["id_chambre_dst_empty_message"]; ?>"], "error");
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
                    var nbr = $('#nbrOf_syno_alveole').text();
                    nbr++;
                    $('#nbrOf_syno_alveole').text(nbr);
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
                        var nbr = $('#nbrOf_syno_alveole').text();
                        nbr -= elementToRemove;
                        $('#nbrOf_syno_alveole').text(nbr);
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
                    $('#syno_alveole_body_id').html('');
                    var html = '';
                    var addedHtml = ["<span class='label label-", "primary" , "'><i class='fa fa-", 'check' , "'></i></span>"];
                    for (var i = 0; i < response.data.length; i++) {
                        html = '<tr id="id_' + i + '" class="">';
                        html += '<td class="check-mail">';
                        html += '<input value="' + response.data[i].id_alveole + '" type="checkbox" class="i-checks">';
                        html += '</td>';
                        html += "<td id=\"cell_" + i + "_0\" class=\"mail-contact\">" + response.data[i].id_alveole + "</td>";
                        html += "<td id=\"cell_" + i + "_1\" class=\"mail-contact\">" + response.data[i].masque + "</td>";
                        html += "<td id=\"cell_" + i + "_2\" class=\"mail-contact\">" + response.data[i].taille + "</td>";
                        html += "<td id=\"cell_" + i + "_3\" class=\"mail-contact\">" + response.data[i].etat + "</td>";
                        html += "<td id=\"cell_" + i + "_4\" class=\"mail-contact\">" + response.data[i].position + "</td>";
                        html += "<td id=\"cell_" + i + "_5\" class=\"mail-contact\">" + response.data[i].couleur + "</td>";
                        html += "<td id=\"cell_" + i + "_6\" class=\"mail-contact\">" + response.data[i].tubage + "</td>";
                        html += "<td id=\"cell_" + i + "_7\" class=\"mail-contact\">" + response.data[i].tubage_taille + "</td>";
                        html += "<td id=\"cell_" + i + "_8\" class=\"mail-contact\">" + response.data[i].id_chambre_src + "</td>";
                        html += "<td id=\"cell_" + i + "_9\" class=\"mail-contact\">" + response.data[i].id_chambre_dst + "</td>";

                        html += '<td class="">' +
                                '<button onclick="btn_edit_click(' + i + ');" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>' +
                                '</td>';
                        //html += '<td class="text-right mail-date"></td>';
                        html += '</tr>';
                        $('#syno_alveole_body_id').append(html);

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
                    $('#nbrOf_syno_alveole').text('Number : ' + response.extra.NbrQ + ' Total : ' + response.extra.NbrT);
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
        $('#id_alveole_update').val(data.id_alveole);
                $("#<?php echo $lang["id_alveole_id"]; ?>").val(data.id_alveole);
        $("#<?php echo $lang["masque_id"]; ?>").val(data.masque);
        $("#<?php echo $lang["taille_id"]; ?>").val(data.taille);
        $("#<?php echo $lang["etat_id"]; ?>").val(data.etat);
        $("#<?php echo $lang["position_id"]; ?>").val(data.position);
        $("#<?php echo $lang["couleur_id"]; ?>").val(data.couleur);
        $("#<?php echo $lang["tubage_id"]; ?>").val(data.tubage);
        $("#<?php echo $lang["tubage_taille_id"]; ?>").val(data.tubage_taille);
        $("#<?php echo $lang["id_chambre_src_id"]; ?>").val(data.id_chambre_src);
        $("#<?php echo $lang["id_chambre_dst_id"]; ?>").val(data.id_chambre_dst);

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