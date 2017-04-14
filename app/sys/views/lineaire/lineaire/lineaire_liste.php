<!-- Table lineaires sous projets -->
<div class="block" id="lineaires_block">
    <div class="block-content table-responsive" style="overflow-x: scroll;">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="lineaires_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th class="bg bg-info-light" colspan="4" style="text-align: center;">Site</th>
                <!--CTR/CDI-->
                <th class="bg bg-success-light" colspan="20" style="text-align: center;">CTR/CDI</th>
            </tr>
            <tr>
                <th colspan="4" style="text-align: center;">Infos Sous Projet</th>
                <!--CTR/CDI-->
                <!--Aiguillage et Tirage-->
                <th colspan="6" style="text-align: center;background-color: #70b9eb;">Câbles</th>
                <th colspan="6" style="text-align: center;background-color: #46c37b;">Tubage</th>
                <th colspan="6" style="text-align: center;background-color: #f3b760;">Bpe</th>
                <th colspan="2" style="text-align: center;background-color: #44b4a6;">Tiroirs</th>
            </tr>
            <tr>
                <th rowspan="2">Sous-projet</th>
                <th rowspan="2">Ville</th>
                <th rowspan="2">LR</th>
                <th rowspan="2">LR sur PM Existant</th>
                <!--CTR/CDI-->
                <!--Aiguillage et Tirage-->
                <!--cables-->
                <th id="col-4"></th>
                <th id="col-5"></th>
                <th id="col-6"></th>
                <th id="col-7"></th>
                <th id="col-8"></th>
                <th id="col-9"></th>
                <!--tubage-->
                <th id="col-10"></th>
                <th id="col-11"></th>
                <th id="col-12"></th>
                <th id="col-13"></th>
                <th id="col-14"></th>
                <th id="col-15"></th>
                <!--boites-->
                <th id="col-16"></th>
                <th id="col-17"></th>
                <th id="col-18"></th>
                <th id="col-19"></th>
                <th id="col-20"></th>
                <th id="col-21"></th>
                <!--NRO-->
                <th id="col-22"></th>
                <th id="col-23"></th>
            </tr>
            <tr>
                <!--CTR/CDI-->
                <!--Aiguillage et Tirage-->
                <!--cables-->
                <th>720FO</th>
                <th>432FO</th>
                <th>288FO</th>
                <th>144FO</th>
                <th>72FO</th>
                <th>48FO</th>
                <!--tubage-->
                <th>21/25</th>
                <th>16/20</th>
                <th>15/18</th>
                <th>Trançons à tuber</th>
                <th>18/21</th>
                <th>11/14</th>
                <!--boites-->
                <th>720FO</th>
                <th>432FO</th>
                <th>288FO</th>
                <th>144FO</th>
                <th>72FO</th>
                <th>48FO</th>
                <!--NRO-->
                <th>CTR</th>
                <th>TOR</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sous-projet</th>
                <th>Ville</th>
                <th>LR</th>
                <th>LR sur PM Existant</th>
                <!--CTR/CDI-->
                <!--Aiguillage et Tirage-->
                <!--cables-->
                <th>720FO</th>
                <th>432FO</th>
                <th>288FO</th>
                <th>144FO</th>
                <th>72FO</th>
                <th>48FO</th>
                <!--tubage-->
                <th>21/25</th>
                <th>16/20</th>
                <th>15/18</th>
                <th>Trançons à tuber</th>
                <th>18/21</th>
                <th>11/14</th>
                <!--boites-->
                <th>720FO</th>
                <th>432FO</th>
                <th>288FO</th>
                <th>144FO</th>
                <th>72FO</th>
                <th>48FO</th>
                <!--NRO-->
                <th>CTR</th>
                <th>TOR</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table lineaires sous projets -->

<script>
    var linears_dt;
    function getZ(f) {
        if(f == null || f == '') return 0;
        return parseInt(f);
    }

    function has_master(key) {
        //console.log(key in masters);
        return (key in masters);
    }

    var masters = undefined;

    $(document).ready(function() {

        $('#lineaires_block').addClass('block-opt-refresh');

        $.ajax({
            url: "api/projet/projet/get_ctr_masters.php",
            dataType: "json"
        }).done(function (msg) {

            //console.log(msg);

            $('#lineaires_block').removeClass('block-opt-refresh');


            masters = msg.masters;

            /*console.log('objet : ');
            console.log(masters);
            console.log('objet length : ');
            console.log(Object.keys(masters).length);*/

            linears_dt = $('#lineaires_table').on('preXhr.dt', function ( e, settings, data ) {
                $('#lineaires_block').addClass('block-opt-refresh');
            }).DataTable( {
                "iDisplayLength":500,
                "language": {
                    "url": "assets/js/plugins/datatables/French.json"
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Excel',
                        header : true,
                        className : 'button button-primary',
                        filename : 'avancement lineaires'
                    }
                ],
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": 'api/projet/sousprojet/lineaires_liste.php',
                    "type":'POST',
                },
                "columns": [
                    { "data": "lib_nro" },
                    { "data": "ville" },
                    { "data": "lr" },
                    { "data": "lr_sur_pm" },
                    //CTR&CDI
                    //Aiguillage et Tirage
                    //Cables
                    { "data": "t6_lineaire1" },//720FO : 4
                    { "data": "t6_lineaire2" },//432FO : 5
                    { "data": "t6_lineaire3" },//288FO : 6
                    { "data": "t6_lineaire4" },//144FO : 7
                    { "data": "t8_lineaire3" },//72FO : 8
                    { "data": "t8_lineaire4" },//48FO : 9
                    //Tubage
                    { "data": "t6_lineaire9" },//21/25 : 10
                    { "data": "t6_lineaire10" },//16/20 : 11
                    { "data": "t6_lineaire11" },//15/18 : 12
                    { "data": "t6_lineaire12" },//Trançons à tuber : 13
                    { "data": "t8_lineaire9" },//18/21 : 14
                    { "data": "t8_lineaire11" },//11/14 : 15
                    //Boites
                    { "data": "t6_lineaire5" },//720FO : 16
                    { "data": "t6_lineaire6" },//432FO : 17
                    { "data": "t6_lineaire7" },//288FO : 18
                    { "data": "t6_lineaire8" },//144FO : 19
                    { "data": "t8_lineaire7" },//72FO : 20
                    { "data": "t8_lineaire8" },//48FO : 21
                    //NRO
                    { "data": "t6_lineaire13" },//CTR : 22
                    { "data": "t6_lineaire14" },//TOR : 23
                    { "data": "zone" }

                ],
                "columnDefs": [
                    {
                        "targets": 0,
                        orderData: [ 0, 24 ],
                        "data": "lib_nro",
                        "render": function ( data, type, full, meta ) {
                            if(type == "display"){
                                return  '<a href="?page=sousprojet&idsousprojet='+full.id_sous_projet+'">'+full.lib_nro + '-' + full.zone+'</a>';
                            }

                            return full.lib_nro + '-' + full.zone;
                        }
                    },
                    {
                        "targets": [4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23],
                        "render": function ( data, type, full, meta ) {
                            var d;

                            //TODO case all rows(full or masters test)

                            /*switch (meta.col) {
                                case 6 : d = getZ(full.t6_lineaire3) + getZ(full.t8_lineaire1);
                                    break;
                                case 7 : d = getZ(full.t6_lineaire4) + getZ(full.t8_lineaire2);
                                    break;
                                case 12 : d = getZ(full.t6_lineaire11) + getZ(full.t8_lineaire10);
                                    break;
                                case 13 : d = getZ(full.t6_lineaire12) + getZ(full.t8_lineaire12);
                                    break;
                                case 18 : d = getZ(full.t6_lineaire7) + getZ(full.t8_lineaire5);
                                    break;
                                case 19 : d = getZ(full.t6_lineaire8) + getZ(full.t8_lineaire6);
                                    break;
                                default : d = getZ(data);
                                    break;
                            }*/

                            //var obj = is_master(full.id_sous_projet);

                            //console.log(obj);

                            //console.log('zz');

                            switch (meta.col) {
                                case 4 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire1);
                                    break;
                                case 5 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire2);
                                    break;
                                case 6 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire3) + getZ(full.t8_lineaire1);
                                    break;
                                case 7 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire4) + getZ(full.t8_lineaire2);
                                    break;
                                case 8 : d = getZ(full.t8_lineaire3);
                                    break;
                                case 9 : d = getZ(full.t8_lineaire4);
                                    break;
                                case 10 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire9);
                                    break;
                                case 11 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire10);
                                    break;
                                case 12 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire11) + getZ(full.t8_lineaire10);
                                    break;
                                case 13 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire12) + getZ(full.t8_lineaire12);
                                    break;
                                case 14 : d = getZ(full.t8_lineaire9);
                                    break;
                                case 15 : d = getZ(full.t8_lineaire11);
                                    break;
                                case 16 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire5);
                                    break;
                                case 17 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire6);
                                    break;
                                case 18 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire7) + getZ(full.t8_lineaire5);
                                    break;
                                case 19 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire8) + getZ(full.t8_lineaire6);
                                    break;
                                case 20 : d = getZ(full.t8_lineaire7);
                                    break;
                                case 21 : d = getZ(full.t8_lineaire8);
                                    break;
                                case 22 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire13);
                                    break;
                                case 23 : d = getZ((has_master(full.id_master_ctr) ? masters[full.id_master_ctr] : full).t6_lineaire14);
                                    break;

                                default : d = getZ(data);
                                    break;
                            }

                            return d;

                        }
                    },
                    { "targets": [ 6,7,12,13,18,19 ], "visible": true, "orderable": false },
                    { "targets": [ 24 ], "visible": false, "searchable": true }
                ],
                "order": [[0, 'desc']]
                ,
                "drawCallback": function( settings ) {
                    $('#lineaires_block').removeClass('block-opt-refresh');
                },
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    for(i=4;i<=23;i++) {

                        total = api
                            .column( i )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        $('#col-' + i).html(total);
                    }
                }
            } );
        });

    } );
</script>