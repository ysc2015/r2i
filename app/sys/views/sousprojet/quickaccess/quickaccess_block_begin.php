<div class="block block-themed block-opt-hidden" id="quickaccess_block">
    <div class="block-header bg-info-light">
        <ul class="block-options">
            <!--<li>
                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>-->
            <li>
                <button id="open_poche" class='btn btn-info btn-sm' style="color: #000;"><span class='glyphicon glyphicon-folder-open'>&nbsp;</span> Ouvrir sous projet</button>
            </li>
        </ul>
        <!--<h3 class="block-title"></h3>-->
        <select class="js-select2 form-control" id="poches_select" name="poches_select" size="1" style="width: 80%;" data-placeholder="Séléctionner une poche..">
            <option value="">&nbsp;</option>
            <?php
            $stm = $db->prepare("select sp.id_sous_projet,sp.zone,n.lib_nro from sous_projet sp , projet p, nro n where sp.id_projet = p.id_projet and p.id_nro = n.id_nro order by n.lib_nro,sp.zone asc");
            $stm->execute();
            $poches = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($poches as $poche) {
                echo "<option value=\"$poche->id_sous_projet\">$poche->lib_nro - $poche->zone</option>";
            }
            ?>
        </select>
    </div>
    <div class="block-content">
        <div class="block" id="quickaccess_block_content">