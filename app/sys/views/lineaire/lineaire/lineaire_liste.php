<!-- Table lineaires sous projets -->
<div class="block">
    <div class="block-content table-responsive" style="overflow-x: scroll;">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="lineaires_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th class="bg bg-info-light" colspan="4" style="text-align: center;">Site</th>
                <!--CTR-->
                <th class="bg bg-success-light" colspan="14" style="text-align: center;">CTR</th>
                <!--CDI-->
                <th class="bg bg-warning-light" colspan="12" style="text-align: center;">CDI</th>
            </tr>
            <tr>
                <th colspan="4" style="text-align: center;">Infos Sous Projet</th>
                <!--CTR-->
                <!--Aiguillage et Tirage-->
                <th colspan="4" style="text-align: center;background-color: #70b9eb;">Câbles</th>
                <th colspan="4" style="text-align: center;background-color: #46c37b;">Tubage</th>
                <th colspan="4" style="text-align: center;background-color: #f3b760;">Boites</th>
                <th colspan="2" style="text-align: center;background-color: #44b4a6;">NRO</th>
                <!--CDI-->
                <!--Aiguillage et Tirage-->
                <th colspan="4" style="text-align: center;background-color: #70b9eb;">Câbles</th>
                <th colspan="4" style="text-align: center;background-color: #46c37b;">Tubage</th>
                <th colspan="4" style="text-align: center;background-color: #f3b760;">Boites</th>
            </tr>
            <tr>
                <th>Sous-projet</th>
                <th>Ville</th>
                <th>LR</th>
                <th>LR sur PM Existant</th>
                <!--CTR-->
                <!--Aiguillage et Tirage-->
                <!--cables-->
                <th>720FO</th>
                <th>432FO</th>
                <th>288FO</th>
                <th>144FO</th>
                <!--tubage-->
                <th>21/25</th>
                <th>16/20</th>
                <th>15/18</th>
                <th>Trançons à tuber</th>
                <!--boites-->
                <th>720FO</th>
                <th>432FO</th>
                <th>288FO</th>
                <th>144FO</th>
                <!--NRO-->
                <th>CTR</th>
                <th>TOR</th>
                <!--CDI-->
                <!--Aiguillage et Tirage-->
                <!--câbles-->
                <th>288FO</th>
                <th>144FO</th>
                <th>72FO</th>
                <th>48FO</th>
                <!--tubage-->
                <th>18/21</th>
                <th>15/18</th>
                <th>11/14</th>
                <th>Trançons à tuber</th>
                <!--boites-->
                <th>288FO</th>
                <th>144FO</th>
                <th>72FO</th>
                <th>48FO</th>
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
                <!--CTR-->
                <!--Aiguillage et Tirage-->
                <!--cables-->
                <th>720FO</th>
                <th>432FO</th>
                <th>288FO</th>
                <th>144FO</th>
                <!--tubage-->
                <th>21/25</th>
                <th>16/20</th>
                <th>15/18</th>
                <th>Trançons à tuber</th>
                <!--boites-->
                <th>720FO</th>
                <th>432FO</th>
                <th>288FO</th>
                <th>144FO</th>
                <!--NRO-->
                <th>CTR</th>
                <th>TOR</th>
                <!--CDI-->
                <!--Aiguillage et Tirage-->
                <!--câbles-->
                <th>288FO</th>
                <th>144FO</th>
                <th>72FO</th>
                <th>48FO</th>
                <!--tubage-->
                <th>18/21</th>
                <th>15/18</th>
                <th>11/14</th>
                <th>Trançons à tuber</th>
                <!--boites-->
                <th>288FO</th>
                <th>144FO</th>
                <th>72FO</th>
                <th>48FO</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table lineaires sous projets -->

<script>
    var linears_dt;
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
                //CTR
                //Aiguillage et Tirage
                { "data": "t6_lineaire1" },
                { "data": "t6_lineaire2" },
                { "data": "t6_lineaire3" },
                { "data": "t6_lineaire4" },
                { "data": "t6_lineaire9" },
                { "data": "t6_lineaire10" },
                { "data": "t6_lineaire11" },
                { "data": "t6_lineaire12" },
                { "data": "t6_lineaire5" },
                { "data": "t6_lineaire6" },
                { "data": "t6_lineaire7" },
                { "data": "t6_lineaire8" },
                { "data": "t6_lineaire13" },
                { "data": "t6_lineaire14" },
                //CDI
                //Aiguillage et Tirage
                { "data": "t8_lineaire1" },
                { "data": "t8_lineaire2" },
                { "data": "t8_lineaire3" },
                { "data": "t8_lineaire4" },
                { "data": "t8_lineaire9" },
                { "data": "t8_lineaire10" },
                { "data": "t8_lineaire11" },
                { "data": "t8_lineaire12" },
                { "data": "t8_lineaire5" },
                { "data": "t8_lineaire6" },
                { "data": "t8_lineaire7" },
                { "data": "t8_lineaire8" },
                { "data": "zone" }

            ],
            "columnDefs": [
                {
                    "targets": 0,
                    orderData: [ 0, 30 ],
                    "data": "lib_nro",
                    "render": function ( data, type, full, meta ) {
                        if(type == "display"){
                            return  '<a href="?page=sousprojet&idsousprojet='+full.id_sous_projet+'">'+full.lib_nro + '-' + full.zone+'</a>';
                        }

                        return full.lib_nro + '-' + full.zone;
                    }
                },
                { "targets": [ 30 ], "visible": false, "searchable": true }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                ;
            }
        } );
    } );
</script>