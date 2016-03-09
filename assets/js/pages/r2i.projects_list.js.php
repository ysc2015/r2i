<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : r2i.projects_list.js.php
 *  Author     : RR
 *  Description: Custom JS code used in Admin Page Projects list
*/

//
function deleteProject(idp) {
    alert('deleteProject' + idp);
}
//
function showProjectSDFiles(idp) {
    window.open('?page=projects&action=sdfiles&idp='+idp);
}
//
function showProjectModify(idp) {
    window.open('?page=projects&action=mod&id='+idp);
}

var ProjectsListDatatables = function() {
    var API_URL = 'public/api/r2iApi.php';
    // Open add project form
    var openAddForm = function() {
        // When the add project form is submitted
        jQuery('.open-add-form').on('click', function(){
            window.location.href = "?page=projects&action=add";
        });
    };
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableFull = function() {
        jQuery('.js-dataTable-full').dataTable({
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
                "processing":     "Chargement des projets...",
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
                    method: 'get_all_projects'
                },
            },
            "columns": [
                { "data": "project_id" },
                { "data": "project_name"},
                { "data": "city" },
                { "data": "plate_dept_code"},
                { "data": "site_code"},
                /*{ "data": "type_site_id"},
                { "data": "size"},
                { "data": "orig_site_state_id"},
                { "data": "orig_site_provision_date"},*/
                {
                    "sClass": 'text-center',
                    mRender: function (data, type, row) {
                        html = '<div class="btn-group">';
                        html += '<button class="btn btn-xs btn-default" type="button" onclick="showProjectModify('+row.project_id+')" data-toggle="tooltip" title="Modifier Projet"><i class="fa fa-pencil"></i></button>';
                        html += '<button class="btn btn-xs btn-default" type="button" onclick="deleteProject('+row.project_id+')" data-toggle="tooltip" title="Supprimer Projet"><i class="fa fa-times"></i></button>';
                        html += '<button class="btn btn-xs btn-default" type="button" onclick="showProjectSDFiles('+row.project_id+')" data-toggle="tooltip" title="Fichiers Projet (SD)"><i class="fa fa-folder-open"></i></button>';
                        html += '</div>';
                        return html
                    }
                }
            ],
            columnDefs: [ { "bSortable": false, "aTargets": [-1] } ],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]]
        });
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
            //Add open project add-form functionality
            openAddForm();
            // Init Datatables
            bsDataTables();
            initDataTableFull();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ ProjectsListDatatables.init(); });