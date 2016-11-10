<!-- ajouter ot Modal -->
<div class="modal fade" id="add-ot" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter ordre de travail</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="add_ot_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="type_ot">Type Ordre de travail <span class="text-danger">*</span></label>
                                <select class="form-control" id="type_ot" name="type_ot" size="1" style="width: 100%;" data-placeholder="Séléctionner type ot..">
                                    <option value="" selected disabled>Séléctionnez type ot</option>
                                    <?php
                                    extract($_GET);
                                    $sousProjet = SousProjet::first(
                                        array('conditions' =>
                                            array("id_sous_projet = ?", $idsousprojet)
                                        )
                                    );
                                    $options = "";
                                    switch($tentree) {
                                        case "transportaiguillage" :
                                            //echo "select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 1";
                                            $stm = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 1");
                                            $stm->execute();
                                            if($stm->rowCount()==0) {
                                                $options .= "<option value=\"1\">Aiguillage CTR ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                                            }
                                            break;
                                        case "transporttirage" :
                                            $stm = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail in (2,3)");
                                            $stm->execute();
                                            if($stm->rowCount()> 0) {
                                                $stm2 = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 2");
                                                $stm2->execute();
                                                if($stm2->rowCount() == 0) {
                                                    $options .= "<option value=\"2\">Tirage CTR ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                                                }
                                                $stm3 = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 3");
                                                $stm3->execute();
                                                if($stm3->rowCount() == 0) {
                                                    $options .= "<option value=\"3\">Raccordement CTR ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                                                }
                                            } else {
                                                $stm4 = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 4");
                                                $stm4->execute();
                                                if($stm4->rowCount() == 0) {
                                                    $options .= "<option value=\"2\">Tirage CTR ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                                                    $options .= "<option value=\"3\">Raccordement CTR ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                                                    $options .= "<option value=\"4\">Tirage et Raccordement CTR ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                                                }
                                            }
                                            break;
                                        case "distributionaiguillage" :
                                            $stm = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 5");
                                            $stm->execute();
                                            if($stm->rowCount()==0) {
                                                $options .= "<option value=\"5\">Aiguillage CDI ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                                            }
                                            break;
                                        case "distributiontirage" :
                                            $stm = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail in (6,7)");
                                            $stm->execute();
                                            if($stm->rowCount()> 0) {
                                                $stm2 = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 6");
                                                $stm2->execute();
                                                if($stm2->rowCount() == 0) {
                                                    $options .= "<option value=\"6\">Tirage CDI ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                                                }
                                                $stm3 = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 7");
                                                $stm3->execute();
                                                if($stm3->rowCount() == 0) {
                                                    $options .= "<option value=\"7\">Raccordement CDI ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                                                }
                                            } else {
                                                $stm4 = $db->prepare("select * from ordre_de_travail where id_sous_projet=$idsousprojet and type_entree = '$tentree' and id_type_ordre_travail = 8");
                                                $stm4->execute();
                                                if($stm4->rowCount() == 0) {
                                                    $options .= "<option value=\"6\">Tirage CDI ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                                                    $options .= "<option value=\"7\">Raccordement CDI ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                                                    $options .= "<option value=\"8\">Tirage et Raccordement CDI ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->zone."</option>";
                                                }
                                            }
                                            break;
                                        default : break;
                                    }
                                    echo $options;
                                    $typesot = SelectOrdreTravailType::all(array('conditions' => array('type_entree = ? AND system IS NULL' , $tentree)));
                                    var_dump($typesot);
                                    foreach($typesot as $typeot) {
                                        echo "<option value=\"$typeot->id_type_ordre_travail\">".$typeot->lib_type_ordre_travail."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <label for="commentaire">Commentaire <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="commentaire" name="commentaire" rows="6" placeholder="Commentaire.."></textarea>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_ot_add' role='alert' style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_ot" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter ot Modal -->
<script>
    $(document).ready(function() {

        $("#save_ot").click(function() {
            $.ajax({
                method: "POST",
                url: "api/ot/ot/ot_add.php",
                dataType: "json",
                data: {
                    idsp : get('idsousprojet'),
                    tentree : get('tentree'),
                    type_ot : $('#type_ot').val(),
                    type_ot_text : $('#type_ot option:selected').text(),
                    commentaire : $('#commentaire').val()
                }
            }).done(function (message) {
                if(message.error == 0) {
                    ot_dt.ajax.reload();
                    $("#add_ot_form")[0].reset();
                }
                App.showMessage(message,'#message_ot_add');
            });
        });
    } );
</script>