<!-- Table lineaires sous projets -->
<div class="block">
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
    $(document).ready(function() {

        linears_dt = $('#lineaires_table').DataTable( {
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

                        switch (meta.col) {
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
                ;
            }
        } );
    } );
</script>