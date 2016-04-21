<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : r2i.projects_list.js.php
 *  Author     : RR
 *  Description: Custom JS code used in Admin Page Projects list
*/

var API_URL = 'public/api/r2iApi.php';
var iTableCounter = 1;
var oTable;
var oInnerTable;
var detailsTableHtml;
var data = [];
var projectData = {};
var showSubProjectEditForm = function(id) {
    console.log('i show this is ' + id);
    window.location.href = '?page=zones&action=edit&zoneid='+id;
};
var deleteSubProject = function(id) {
    console.log('i delete this is ' + id);
};
var fnFormatDetails = function (table_id, html) {
    var sOut = "<table id=\"exampleTable_" + table_id + "\" class=\"table table-bordered table-striped js-dataTable-full\">";
    sOut += html;
    sOut += "</table>";
    return sOut;
};
var openDetails = function (elem,projectid) {
    console.log('clicked');
    console.log(projectid);
    var nTr = $(elem).parents('tr')[0];
    var nTds = elem;

    if (oTable.fnIsOpen(nTr)) {
        console.log('1');
        elem.innerHTML = '<i class="fa fa-plus"></i>';
        oTable.fnClose(nTr);
    }
    else {
        console.log('2');
        $.ajax({
            url: API_URL,
            type: 'POST',
            dataType: 'json',
            data: {parameters : JSON.stringify({projectid : projectid}), method : 'get_sub_projects_by_project_id'},
            success: function (response) {
                console.log('get_sub_projects_by_project_id success');
                console.log(response);
                data = response.data;

                elem.innerHTML = '<i class="fa fa-minus"></i>';
                oTable.fnOpen(nTr, fnFormatDetails(iTableCounter, detailsTableHtml), 'details');
                oInnerTable = $("#exampleTable_" + iTableCounter).dataTable({
                    "bJQueryUI": true,
                    "bFilter": false,
                    "bSort" : false, // disables sorting
                    "columns": [
                        /*{ "data": "dep" },
                        { "data": "city"},
                        { "data": "plate" },
                        { "data": "zone"},*/{
                            "sClass": 'text-center',
                            mRender: function (data, type, row) {
                                html = '<h3 class="h5 font-w600 push-10" align="left"><a class="link-effect" href="?page=zones&action=edit&zoneid='+row.sub_project_id+'">'+row.zone+'</a></h3>';
                                return html
                            }
                        }
                    ],
                    "bPaginate": false,
                    /*"serverSide": true,*/
                    "aaData": data,
                    "binfo": true,
                    "sDom": '<"header"i>t<"Footer">',
                    "language": {
                        "decimal":        "",
                        "emptyTable":     "aucun sous-projet",
                        "info":           "<span class=\"label label-info\">sous projets</span>",
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
                    }
                });
                $( "#exampleTable_" + iTableCounter+" tr:odd" ).css( "background-color", "#F7F792" );
                iTableCounter = iTableCounter + 1;
            },
            error: function (response) {
                console.log('get_sub_projects_by_project_id error');
                console.log(response);
                data = [];
            }
        });
    }
};
var ProjectsListDatatables = function() {
    // Open add project form
    var openAddForm = function() {
        //add project form
        jQuery('.open-add-form').on('click', function(){
            window.location.href = '?page=projects&action=add';
        });
    };
    var openEditForm = function() {
        //open edit project form
        jQuery('.open-edit-form').on('click', function(){
            window.location.href = '?page=projects&action=edit&projectid='+projectData.project_id;
        });
    };
    // Open add sub project(zone) form
    var openAddZoneForm = function() {
        //add sub project form
        jQuery('.open-add-zone-form').on('click', function(){
            window.location.href = '?page=zones&projectid='+projectData.project_id+'&action=add';
        });
    };
    var openDeleteDialog = function() {
        // When the add project form is submitted
        jQuery('.open-delete-dialog').on('click', function(){
            console.log('hey am clicked !');
            console.log(projectData.project_name);
            $("#project_name").text(projectData.project_name);
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                /*height:140,*/
                modal: true,
                buttons: {
                    "Supprimer": function() {
                        console.log('delete project with these infos => ');
                        console.log(projectData);
                        $( this ).dialog( "close" );
                    },
                    Annuler: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        });
    };
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableFull = function() {
        // you would probably be using templates here
        detailsTableHtml = $("#detailsTable").html();

        //Insert a 'details' column to the table
        var nCloneTh = document.createElement('th');
        var nCloneTd = document.createElement('td');
        nCloneTd.innerHTML = '<img src="assets/img/misc/open.png">';
        nCloneTd.className = "center";

        jQuery('#masterTable thead tr').each(function () {
            this.insertBefore(nCloneTh, this.childNodes[0]);
        });

        jQuery('#masterTable tbody tr').each(function () {
            this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
        });
        oTable = jQuery('#masterTable').dataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'colvis',
                    columns: ':not(:first-child)'
                }
            ],
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
                },
                buttons: {
                    colvis: 'Afficher/Masquer colonnes'
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
                {
                    "mDataProp": null,
                    "sClass": "center",
                    mRender: function (data, type, row) {
                        html = '<button class="btn btn-xs btn-default" type="button" onclick="openDetails(this,'+row.project_id+');" data-toggle="tooltip" title="Sous projets"><i class="fa fa-plus"></i></button>';
                        return html
                    }
                },
                { "data": "project_id" },
                /*{ "data": "project_name"},*/
                { "data": "ceation_date" },
                { "data": "attribution_date"},
                { "data": "city"},
                { "data": "plate_dept_code"},
                { "data": "site_code"},
                { "data": "type_site_id"},
                { "data": "size"},
                { "data": "orig_site_state_id"},
                { "data": "orig_site_provision_date"}
            ],
            columnDefs: [
                { "bSortable": false, "aTargets": [0] },
                {
                    "targets": [ 3,4,5,6 ],
                    "visible": false
                }
            ],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]]
        });
        oTable.fnSort( [ [1,'asc'] ] );

        //
        $('#masterTable tbody').on( 'click', 'tr', function (evt) {
            var $table=$(evt.target).closest('table');
            if($table.attr('id').indexOf('masterTable') > -1) {
                var $cell=$(evt.target).closest('td');
                if( $cell.index()>0){
                    if ( $(this).hasClass('selected') ) {
                        $(this).removeClass('selected');
                        $('.linked').prop('disabled', true);
                    }
                    else {
                        oTable.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                        projectData = oTable.fnGetData(this); // get datarow
                        if (null != projectData)  // null if we clicked on title row
                        {
                            //now aData[0] - 1st column(count_id), aData[1] -2nd, etc.
                            //there is a data
                            console.log(projectData);
                            $('.linked').prop('disabled', false);
                        }
                    }
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
            console.log('projects list init');
            //events
            openAddForm();
            openEditForm();
            openAddZoneForm();
            openDeleteDialog();
            // Init Datatables
            bsDataTables();
            initDataTableFull();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ ProjectsListDatatables.init(); });