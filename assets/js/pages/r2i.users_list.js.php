<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : r2i.users_list.js.php
 *  Author     : RR
 *  Description: Custom JS code : Users listing
 */
var API_URL = 'public/api/r2iApiUser.php';
var oTable;
var userData = {};

var UsersListDatatables = function() {
    var API_URL = 'public/api/r2iApi.php';
    // Events
    var openAddForm = function() {
        //add project form
        jQuery('.open-add-form').on('click', function(){
            window.location.href = '?page=users&action=add';
        });
    };
    var openEditForm = function() {
        //open edit project form
        jQuery('.open-edit-form').on('click', function(){
            window.location.href = '?page=users&action=edit&userid='+userData.user_id;
        });
    };
    var openDeleteDialog = function() {
        // When the add project form is submitted
        jQuery('.open-delete-dialog').on('click', function(){
            console.log('hey am clicked !');
            console.log(userData);
            $("#user_name").text(userData.user_firstname + ' ' + userData.user_lastname);
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                /*height:140,*/
                modal: true,
                buttons: {
                    "Supprimer": function() {
                        console.log('delete user with these infos => ');
                        console.log(userData);
                        $( this ).dialog( "close" );

                        $.ajax({
                            url: API_URL,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                parameters: '{"user_id":' + userData.user_id + '}',
                                method : 'delete_user'
                            },
                            success: function (response) {
                                console.log(response);
                                openDialog(response.msg);
                            },
                            error: function (e) {
                                console.log(e.responseText);
                            }
                        });
                    },
                    Annuler: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        });
    };
    var openDialog = function(txt) {
        $( "#alertbox p").html(txt);
        $( "#alertbox" ).dialog({
            dialogClass: "alert-box",
            resizable: false,
            /*height:140,*/
            modal: true,
            buttons: {
                "Fermer": function() {
                    $( this ).dialog( "close" );
                    window.location.reload();
                }
            }
        });
    };
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableFull = function() {
        oTable = jQuery('.js-dataTable-full').dataTable({
            "language": {
                "decimal":        "",
                "emptyTable":     "No data available in table",
                "info":           "",
                "infoEmpty":      "",
                "infoFiltered":   "(filtered from _MAX_ total entries)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "_MENU_",
                "loadingRecords": "Loading...",
                "processing":     "Chargement des utilisateurs...",
                "search":         "Rechercher:",
                "zeroRecords":    "No matching records found",
                "paginate": {
                    "first":      "First",
                    "last":       "Last",
                    "next":       "Suivant",
                    "previous":   "Précédent"
                },
                "aria": {
                    "sortAscending":  ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            },
            "processing": true,
            /*"serverSide": true,*/
            "ajax": {
                'type': 'POST',
                'url': API_URL,
                'data': {
                    method: 'get_all_users'
                },
            },
            "columns": [
                { "data": "user_id" },
                { "data": "profil_abbrev"},
                { "data": "user_firstname" },
                { "data": "user_lastname"},
                { "data": "email"}
            ],
            columnDefs: [ { "bSortable": false, "aTargets": [-1] } ],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]]
        });

        $('#masterTable tbody').on( 'click', 'tr', function (evt) {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                $('.linked').prop('disabled', true);
            }
            else {
                oTable.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                userData = oTable.fnGetData(this); // get datarow
                if (null != userData)  // null if we clicked on title row
                {
                    //now aData[0] - 1st column(count_id), aData[1] -2nd, etc.
                    //there is a data
                    console.log(userData);
                    $('.linked').prop('disabled', false);
                }
            }
        } );
    };



    // DataTables Bootstrap integration
    var bsDataTables = function() {
        var $DataTable = jQuery.fn.dataTable;

        // Set the defaults for DataTables init
        jQuery.extend( true, $DataTable.defaults, {
            dom:
            "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            renderer: 'bootstrap',
            oLanguage: {
                sLengthMenu: "_MENU_",
                sInfo: "Showing <strong>_START_</strong>-<strong>_END_</strong> of <strong>_TOTAL_</strong>",
                oPaginate: {
                    sPrevious: '<i class="fa fa-angle-left"></i>',
                    sNext: '<i class="fa fa-angle-right"></i>'
                }
            }
        });

        // Default class modification
        jQuery.extend($DataTable.ext.classes, {
            sWrapper: "dataTables_wrapper form-inline dt-bootstrap",
            sFilterInput: "form-control",
            sLengthSelect: "form-control"
        });

        // Bootstrap paging button renderer
        $DataTable.ext.renderer.pageButton.bootstrap = function (settings, host, idx, buttons, page, pages) {
            var api     = new $DataTable.Api(settings);
            var classes = settings.oClasses;
            var lang    = settings.oLanguage.oPaginate;
            var btnDisplay, btnClass;

            var attach = function (container, buttons) {
                var i, ien, node, button;
                var clickHandler = function (e) {
                    e.preventDefault();
                    if (!jQuery(e.currentTarget).hasClass('disabled')) {
                        api.page(e.data.action).draw(false);
                    }
                };

                for (i = 0, ien = buttons.length; i < ien; i++) {
                    button = buttons[i];

                    if (jQuery.isArray(button)) {
                        attach(container, button);
                    }
                    else {
                        btnDisplay = '';
                        btnClass = '';

                        switch (button) {
                            case 'ellipsis':
                                btnDisplay = '&hellip;';
                                btnClass = 'disabled';
                                break;

                            case 'first':
                                btnDisplay = lang.sFirst;
                                btnClass = button + (page > 0 ? '' : ' disabled');
                                break;

                            case 'previous':
                                btnDisplay = lang.sPrevious;
                                btnClass = button + (page > 0 ? '' : ' disabled');
                                break;

                            case 'next':
                                btnDisplay = lang.sNext;
                                btnClass = button + (page < pages - 1 ? '' : ' disabled');
                                break;

                            case 'last':
                                btnDisplay = lang.sLast;
                                btnClass = button + (page < pages - 1 ? '' : ' disabled');
                                break;

                            default:
                                btnDisplay = button + 1;
                                btnClass = page === button ?
                                    'active' : '';
                                break;
                        }

                        if (btnDisplay) {
                            node = jQuery('<li>', {
                                'class': classes.sPageButton + ' ' + btnClass,
                                'aria-controls': settings.sTableId,
                                'tabindex': settings.iTabIndex,
                                'id': idx === 0 && typeof button === 'string' ?
                                settings.sTableId + '_' + button :
                                    null
                            })
                                .append(jQuery('<a>', {
                                        'href': '#'
                                    })
                                    .html(btnDisplay)
                                )
                                .appendTo(container);

                            settings.oApi._fnBindAction(
                                node, {action: button}, clickHandler
                            );
                        }
                    }
                }
            };

            attach(
                jQuery(host).empty().html('<ul class="pagination"/>').children('ul'),
                buttons
            );
        };

        // TableTools Bootstrap compatibility - Required TableTools 2.1+
        if ($DataTable.TableTools) {
            // Set the classes that TableTools uses to something suitable for Bootstrap
            jQuery.extend(true, $DataTable.TableTools.classes, {
                "container": "DTTT btn-group",
                "buttons": {
                    "normal": "btn btn-default",
                    "disabled": "disabled"
                },
                "collection": {
                    "container": "DTTT_dropdown dropdown-menu",
                    "buttons": {
                        "normal": "",
                        "disabled": "disabled"
                    }
                },
                "print": {
                    "info": "DTTT_print_info"
                },
                "select": {
                    "row": "active"
                }
            });

            // Have the collection use a bootstrap compatible drop down
            jQuery.extend(true, $DataTable.TableTools.DEFAULTS.oTags, {
                "collection": {
                    "container": "ul",
                    "button": "li",
                    "liner": "a"
                }
            });
        }
    };

    return {
        init: function() {
            console.log('users list init');
            //events
            openAddForm();
            openEditForm();
            openDeleteDialog();
            // Init Datatables
            bsDataTables();
            initDataTableFull();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ UsersListDatatables.init(); });