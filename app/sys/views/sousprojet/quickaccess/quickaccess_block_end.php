        </div>
    </div>
</div>
<script>
    $(function () {
        // Init page plugins & helpers
        jQuery('#poches_select').select2({
            autocomplete: true
        });
    });

    $(document).ready(function() {
         $("#poches_select").change(function(e){

             e.preventDefault();

             if($("#poches_select").val() > 0) {

                 document.location.href = '?page=sousprojet&idsousprojet=' + $("#poches_select").val();
             }

        });

        /*$("#open_poche").click(function(e){

            e.preventDefault();

            if($("#poches_select").val() > 0) {

                document.location.href = '?page=sousprojet&idsousprojet=' + $("#poches_select").val();
            }

        });*/
    } );
</script>