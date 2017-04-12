<?php
$nbrPerPage = 10;
if (isset($_POST['nbrPerPage'])) {
    $nbrPerPage = $_POST['nbrPerPage'];
}
$nbr = DBHelper::count('chambre');
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
                            <option value="id_chambre"><?php echo $lang["id_chambre_label"]; ?></option><option value="id_ressource"><?php echo $lang["id_ressource_label"]; ?></option><option value="id_sous_projet"><?php echo $lang["id_sous_projet_label"]; ?></option><option value="type_entree"><?php echo $lang["type_entree_label"]; ?></option><option value="ref_chambre"><?php echo $lang["ref_chambre_label"]; ?></option><option value="villet"><?php echo $lang["villet_label"]; ?></option><option value="sous_projet"><?php echo $lang["sous_projet_label"]; ?></option><option value="ref_note"><?php echo $lang["ref_note_label"]; ?></option><option value="code_ch1"><?php echo $lang["code_ch1_label"]; ?></option><option value="code_ch2"><?php echo $lang["code_ch2_label"]; ?></option><option value="gps"><?php echo $lang["gps_label"]; ?></option><option value="type_chambre"><?php echo $lang["type_chambre_label"]; ?></option><option value="traite"><?php echo $lang["traite_label"]; ?></option><option value="manchon_prevu"><?php echo $lang["manchon_prevu_label"]; ?></option>
                        </select>
                    </div>
                </form>

                <h2>
                    <?php echo $lang['chambre_TITLE']; ?> 
                    <sup><span class="label label-info" id="nbrOf_chambre"><?php echo $nbr; ?></span>
                    <span class="label label-primary" id="nPage"></span></sup> 
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm" id="btn_prev"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm" id="btn_next"><i class="fa fa-arrow-right"></i></button>
                    </div>

                    <button id="btn_new" data-toggle="modal" href="#modal-form" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New chambre</button>
                    <button id="btn_refresh" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</button>
                    <button id="btn_checkAll" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left"><i class="fa fa-check"></i> Select All</button>
                    <button id="btn_remove" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>
                </div>
            </div>
            
            <div class="mail-box-header">
                <button class="btn btn-xs btn-primary" onclick="show_hide(0)">id_chambre</button> <button class="btn btn-xs btn-primary" onclick="show_hide(1)">id_ressource</button> <button class="btn btn-xs btn-primary" onclick="show_hide(2)">id_sous_projet</button> <button class="btn btn-xs btn-primary" onclick="show_hide(3)">type_entree</button> <button class="btn btn-xs btn-primary" onclick="show_hide(4)">ref_chambre</button> <button class="btn btn-xs btn-primary" onclick="show_hide(5)">villet</button> <button class="btn btn-xs btn-primary" onclick="show_hide(6)">sous_projet</button> <button class="btn btn-xs btn-primary" onclick="show_hide(7)">ref_note</button> <button class="btn btn-xs btn-primary" onclick="show_hide(8)">code_ch1</button> <button class="btn btn-xs btn-primary" onclick="show_hide(9)">code_ch2</button> <button class="btn btn-xs btn-primary" onclick="show_hide(10)">gps</button> <button class="btn btn-xs btn-primary" onclick="show_hide(11)">type_chambre</button> <button class="btn btn-xs btn-primary" onclick="show_hide(12)">traite</button> <button class="btn btn-xs btn-primary" onclick="show_hide(13)">manchon_prevu</button> 
            </div>

            <div class="mail-box">
                <table class="table table-bordered table-hover table-mail">
                    <thead>
                        <tr><th></th><th id="cell_0_0">id_chambre</th><th id="cell_0_1">id_ressource</th><th id="cell_0_2">id_sous_projet</th><th id="cell_0_3">type_entree</th><th id="cell_0_4">ref_chambre</th><th id="cell_0_5">villet</th><th id="cell_0_6">sous_projet</th><th id="cell_0_7">ref_note</th><th id="cell_0_8">code_ch1</th><th id="cell_0_9">code_ch2</th><th id="cell_0_10">gps</th><th id="cell_0_11">type_chambre</th><th id="cell_0_12">traite</th><th id="cell_0_13">manchon_prevu</th><th>Action</th></tr>
                    </thead>
                    <tbody id="chambre_body_id">
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
                        <h3 class="m-t-none m-b"><?php echo $lang["chambre_modal_title"]; ?></h3>

                        <p><?php echo $lang["chambre_modal_description"]; ?></p>

                        <input id="id_chambre" type="hidden" value=""> 
                        
                        <div class="form-group">
                            <label for="<?php echo $lang["id_chambre_id"]; ?>"><?php echo $lang["id_chambre_label"]; ?></label> 
                            <input id="<?php echo $lang["id_chambre_id"]; ?>" placeholder="<?php echo $lang["id_chambre_placeholder"]; ?>" class="form-control " type="text" readonly>
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["id_ressource_id"]; ?>"><?php echo $lang["id_ressource_label"]; ?></label> 
                            <input id="<?php echo $lang["id_ressource_id"]; ?>" placeholder="<?php echo $lang["id_ressource_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["id_sous_projet_id"]; ?>"><?php echo $lang["id_sous_projet_label"]; ?></label> 
                            <input id="<?php echo $lang["id_sous_projet_id"]; ?>" placeholder="<?php echo $lang["id_sous_projet_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["type_entree_id"]; ?>"><?php echo $lang["type_entree_label"]; ?></label> 
                            <input id="<?php echo $lang["type_entree_id"]; ?>" placeholder="<?php echo $lang["type_entree_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["ref_chambre_id"]; ?>"><?php echo $lang["ref_chambre_label"]; ?></label> 
                            <input id="<?php echo $lang["ref_chambre_id"]; ?>" placeholder="<?php echo $lang["ref_chambre_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["villet_id"]; ?>"><?php echo $lang["villet_label"]; ?></label> 
                            <input id="<?php echo $lang["villet_id"]; ?>" placeholder="<?php echo $lang["villet_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["sous_projet_id"]; ?>"><?php echo $lang["sous_projet_label"]; ?></label> 
                            <input id="<?php echo $lang["sous_projet_id"]; ?>" placeholder="<?php echo $lang["sous_projet_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["ref_note_id"]; ?>"><?php echo $lang["ref_note_label"]; ?></label> 
                            <input id="<?php echo $lang["ref_note_id"]; ?>" placeholder="<?php echo $lang["ref_note_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["code_ch1_id"]; ?>"><?php echo $lang["code_ch1_label"]; ?></label> 
                            <input id="<?php echo $lang["code_ch1_id"]; ?>" placeholder="<?php echo $lang["code_ch1_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["code_ch2_id"]; ?>"><?php echo $lang["code_ch2_label"]; ?></label> 
                            <input id="<?php echo $lang["code_ch2_id"]; ?>" placeholder="<?php echo $lang["code_ch2_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["gps_id"]; ?>"><?php echo $lang["gps_label"]; ?></label> 
                            <input id="<?php echo $lang["gps_id"]; ?>" placeholder="<?php echo $lang["gps_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["type_chambre_id"]; ?>"><?php echo $lang["type_chambre_label"]; ?></label> 
                            <input id="<?php echo $lang["type_chambre_id"]; ?>" placeholder="<?php echo $lang["type_chambre_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["traite_id"]; ?>"><?php echo $lang["traite_label"]; ?></label> 
                            <input id="<?php echo $lang["traite_id"]; ?>" placeholder="<?php echo $lang["traite_placeholder"]; ?>" class="form-control " type="text" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $lang["manchon_prevu_id"]; ?>"><?php echo $lang["manchon_prevu_label"]; ?></label> 
                            <input id="<?php echo $lang["manchon_prevu_id"]; ?>" placeholder="<?php echo $lang["manchon_prevu_placeholder"]; ?>" class="form-control i-checks-form-control" type="checkbox" >
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
    var apiName = 'chambre';
    var lastResponseData = null;
    var hiddenColumns = [false,false,false,false,false,false,false,false,false,false,false,false,false,false];
    
    function getData() {
        var obj = {
                        <?php echo $lang["id_chambre_id"]; ?>: valById("<?php echo $lang["id_chambre_id"]; ?>"),
            <?php echo $lang["id_ressource_id"]; ?>: valById("<?php echo $lang["id_ressource_id"]; ?>"),
            <?php echo $lang["id_sous_projet_id"]; ?>: valById("<?php echo $lang["id_sous_projet_id"]; ?>"),
            <?php echo $lang["type_entree_id"]; ?>: valById("<?php echo $lang["type_entree_id"]; ?>"),
            <?php echo $lang["ref_chambre_id"]; ?>: valById("<?php echo $lang["ref_chambre_id"]; ?>"),
            <?php echo $lang["villet_id"]; ?>: valById("<?php echo $lang["villet_id"]; ?>"),
            <?php echo $lang["sous_projet_id"]; ?>: valById("<?php echo $lang["sous_projet_id"]; ?>"),
            <?php echo $lang["ref_note_id"]; ?>: valById("<?php echo $lang["ref_note_id"]; ?>"),
            <?php echo $lang["code_ch1_id"]; ?>: valById("<?php echo $lang["code_ch1_id"]; ?>"),
            <?php echo $lang["code_ch2_id"]; ?>: valById("<?php echo $lang["code_ch2_id"]; ?>"),
            <?php echo $lang["gps_id"]; ?>: valById("<?php echo $lang["gps_id"]; ?>"),
            <?php echo $lang["type_chambre_id"]; ?>: valById("<?php echo $lang["type_chambre_id"]; ?>"),
            <?php echo $lang["traite_id"]; ?>: valById("<?php echo $lang["traite_id"]; ?>"),
            <?php echo $lang["manchon_prevu_id"]; ?>: valById("<?php echo $lang["manchon_prevu_id"]; ?>"),

        };
        return obj;
    }
    
    function checkData(data) {
        
        if (data.<?php echo $lang["id_ressource_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["id_ressource_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["id_sous_projet_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["id_sous_projet_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["type_entree_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["type_entree_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["ref_chambre_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["ref_chambre_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["villet_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["villet_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["sous_projet_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["sous_projet_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["ref_note_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["ref_note_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["code_ch1_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["code_ch1_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["code_ch2_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["code_ch2_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["gps_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["gps_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["type_chambre_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["type_chambre_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["traite_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["traite_empty_message"]; ?>"], "error");
            return false;
        }
        
        if (data.<?php echo $lang["manchon_prevu_id"]; ?> == "") {
            showNotification("Error", ["<?php echo $lang["manchon_prevu_empty_message"]; ?>"], "error");
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
                    var nbr = $('#nbrOf_chambre').text();
                    nbr++;
                    $('#nbrOf_chambre').text(nbr);
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
                        var nbr = $('#nbrOf_chambre').text();
                        nbr -= elementToRemove;
                        $('#nbrOf_chambre').text(nbr);
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
                    $('#chambre_body_id').html('');
                    var html = '';
                    var addedHtml = ["<span class='label label-", "primary" , "'><i class='fa fa-", 'check' , "'></i></span>"];
                    for (var i = 0; i < response.data.length; i++) {
                        html = '<tr id="id_' + i + '" class="">';
                        html += '<td class="check-mail">';
                        html += '<input value="' + response.data[i].id_chambre + '" type="checkbox" class="i-checks">';
                        html += '</td>';
                        html += "<td id=\"cell_" + i + "_0\" class=\"mail-contact\">" + response.data[i].id_chambre + "</td>";
                        html += "<td id=\"cell_" + i + "_1\" class=\"mail-contact\">" + response.data[i].id_ressource + "</td>";
                        html += "<td id=\"cell_" + i + "_2\" class=\"mail-contact\">" + response.data[i].id_sous_projet + "</td>";
                        html += "<td id=\"cell_" + i + "_3\" class=\"mail-contact\">" + response.data[i].type_entree + "</td>";
                        html += "<td id=\"cell_" + i + "_4\" class=\"mail-contact\">" + response.data[i].ref_chambre + "</td>";
                        html += "<td id=\"cell_" + i + "_5\" class=\"mail-contact\">" + response.data[i].villet + "</td>";
                        html += "<td id=\"cell_" + i + "_6\" class=\"mail-contact\">" + response.data[i].sous_projet + "</td>";
                        html += "<td id=\"cell_" + i + "_7\" class=\"mail-contact\">" + response.data[i].ref_note + "</td>";
                        html += "<td id=\"cell_" + i + "_8\" class=\"mail-contact\">" + response.data[i].code_ch1 + "</td>";
                        html += "<td id=\"cell_" + i + "_9\" class=\"mail-contact\">" + response.data[i].code_ch2 + "</td>";
                        html += "<td id=\"cell_" + i + "_10\" class=\"mail-contact\">" + response.data[i].gps + "</td>";
                        html += "<td id=\"cell_" + i + "_11\" class=\"mail-contact\">" + response.data[i].type_chambre + "</td>";
                        html += "<td id=\"cell_" + i + "_12\" class=\"mail-contact\">" + response.data[i].traite + "</td>";

                       if(response.data[i].manchon_prevu == 1) { 
                            addedHtml[1] = "primary";
                            addedHtml[3] = "check";
                       } else {
                            addedHtml[1] = "danger";
                            addedHtml[3] = "remove";
                       }
                       var str = addedHtml.join("");                            
                       html += "<td id=\"cell_" + i + "_13\" class=\"mail-contact\">" + str + "</i></td>";

                        html += '<td class="">' +
                                '<button onclick="btn_edit_click(' + i + ');" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>' +
                                '</td>';
                        //html += '<td class="text-right mail-date"></td>';
                        html += '</tr>';
                        $('#chambre_body_id').append(html);

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
                    $('#nbrOf_chambre').text('Number : ' + response.extra.NbrQ + ' Total : ' + response.extra.NbrT);
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
                $("#<?php echo $lang["id_chambre_id"]; ?>").val(data.id_chambre);
        $("#<?php echo $lang["id_ressource_id"]; ?>").val(data.id_ressource);
        $("#<?php echo $lang["id_sous_projet_id"]; ?>").val(data.id_sous_projet);
        $("#<?php echo $lang["type_entree_id"]; ?>").val(data.type_entree);
        $("#<?php echo $lang["ref_chambre_id"]; ?>").val(data.ref_chambre);
        $("#<?php echo $lang["villet_id"]; ?>").val(data.villet);
        $("#<?php echo $lang["sous_projet_id"]; ?>").val(data.sous_projet);
        $("#<?php echo $lang["ref_note_id"]; ?>").val(data.ref_note);
        $("#<?php echo $lang["code_ch1_id"]; ?>").val(data.code_ch1);
        $("#<?php echo $lang["code_ch2_id"]; ?>").val(data.code_ch2);
        $("#<?php echo $lang["gps_id"]; ?>").val(data.gps);
        $("#<?php echo $lang["type_chambre_id"]; ?>").val(data.type_chambre);
        $("#<?php echo $lang["traite_id"]; ?>").val(data.traite);

            if(data.manchon_prevu) {
                $('#<?php echo $lang["manchon_prevu_id"]; ?>').iCheck("check");    
            }

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