<div class="block block-themed">
    <div class="block-header bg-info">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title">gestionplaque</h3>
    </div>
    <div class="block-content">
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">
                <?php
                foreach($connectedProfil->gestionplaque() as $tab) {?>
                    <li class="<?=($connectedProfil->gestionplaque()[0]==$tab?"active":"")?>">
                        <a href="#<?=$tab."_content"?>"><?= $tab?></a>
                    </li>
                <?php }?>

            </ul>
            <div class="block-content tab-content">
                <?php
                foreach($connectedProfil->gestionplaque() as $tab) {?>
                    <div class="tab-pane <?=($connectedProfil->gestionplaque()[0]==$tab?"active":"")?>" id="<?=$tab."_content"?>">
                        <?php
                        if(file_exists($file = $views_folder."sousprojet/tabcontent/gestionplaque/{$tab}.html")) {
                            include $file;
                        } elseif(file_exists($file = $views_folder."sousprojet/tabcontent/gestionplaque/{$tab}.php")) {
                            include $file;
                        }
                        ?>
                    </div>
                <?php }?>

            </div>
        </div>
    </div>
</div>