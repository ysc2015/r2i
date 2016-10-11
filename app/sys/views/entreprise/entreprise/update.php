


<button id="update_entreprise_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#update-entreprise' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier entreprise</button>
<script>
    var update = false;
    $(document).ready(function() {
        $("#update_entreprise_show").click(function() {

            update = false;

            $("#entreprise_update_nom").val(entreprise_dt.row('.selected').data().nom);
            $("#entreprise_update_adresse_siege").val(entreprise_dt.row('.selected').data().adresse_siege);
            $("#entreprise_update_adresse_livraison").val(entreprise_dt.row('.selected').data().adresse_livraison);
            $("#entreprise_update_gerant_entreprise").val(entreprise_dt.row('.selected').data().gerant_entreprise);
            $("#entreprise_update_contact_nom").val(entreprise_dt.row('.selected').data().contact_nom);
            $("#entreprise_update_contact_prenom").val(entreprise_dt.row('.selected').data().contact_prenom);
            $("#entreprise_update_contact_tel_mobile").val(entreprise_dt.row('.selected').data().contact_tel_mobile);
            $("#entreprise_update_contact_tel_fixe").val(entreprise_dt.row('.selected').data().contact_tel_fixe);
            $("#entreprise_update_contact_email").val(entreprise_dt.row('.selected').data().contact_email);
        });
    } );
</script>
<?php

include_once __DIR__."/modals/update.php";

?>