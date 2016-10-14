<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="equipe">Equipe</label>
            <select class="form-control" id="equipe" name="equipe" size="1" style="width: 100%;" data-placeholder="Séléctionner équipe..">
                <option value="">&nbsp;</option>
                <?php
                $stm = $db->prepare("select * from equipe_stt");

                $stm->execute();
                $teams = $stm->fetchAll();

                foreach($teams as $team)
                {
                    echo "<option value=\"{$team['id_equipe_stt']}\">{$team['prenom']} {$team['nom']}</option>";
                }
                ?>
            </select>
            <label for="ordre">Ordre de travail</label>
            <select class="form-control" id="ordre" name="ordre" size="1" style="width: 100%;" data-placeholder="Séléctionner équipe..">
                <option value="">&nbsp;</option>
                <?php
                $stm = $db->prepare("select ot.*,ott.lib_type_ordre_travail from ordre_de_travail as ot, select_type_ordre_travail as ott where ot.id_type_ordre_travail=ott.id_type_ordre_travail and ot.id_sous_projet=".$_GET['idsousprojet']." and ot.type_entree='".$_GET['tentree']."'");

                $stm->execute();
                $jobs = $stm->fetchAll();

                foreach($jobs as $job)
                {
                    echo "<option value=\"{$job['id_ordre_de_travail']}\">{$job['lib_type_ordre_travail']}</option>";
                }
                ?>
            </select>
            <label for="date_debut">Date début</label>
            <input class="form-control " type="date" id="date_debut" name="date_debut" value="">
            <label for="date_fin">Date fin</label>
            <input class="form-control " type="date" id="date_fin" name="date_fin" value="">
        </div>
        <button id="affecter_ot" class='btn btn-success btn-sm' style="width: 100%;"><span class='glyphicon glyphicon-check'>&nbsp;</span> Affecter</button>
    </div>
    <div class="col-md-9">
        <div id="calender"><!--calendar wrapper-->

        </div>
    </div>
</div>
<script>
    $(function () {
    });
    $(document).ready(function() {
        $('#calender').fullCalendar({
            /*header: {
                left: 'prev,next',
                center: 'title',
                right: 'month'
            }*/
        });
    } );
</script>