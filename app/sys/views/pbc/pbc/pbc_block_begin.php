<div class="block block-themed" id="pbc_block">
    <div class="block-header bg-info">
        <ul class="block-options">
            <li>
                <button id="pbc_block_refresh" type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <?php
          $text = "";
          extract($_GET);
          if(isset($type) && !empty($type)) {

              switch($type) {

                  case "1" :
                      $text = "Avec Réponse";
                      break;
                  case "2" :
                      $text = "Sans Réponse";
                      break;
                  case "3" :
                      $text = "Résolus";
                      break;
                  default :
                      $text = "Err URL";
                      break;
              }
          } else {

              $text = "Err URL";
          }
        ?>
        <h3 class="block-title">BLQ / PBC <?= $text ?></h3>
    </div>
    <div class="block-content">
        <div class="block" id="pbc_block_content">