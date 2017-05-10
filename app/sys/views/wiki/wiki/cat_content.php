<?php

extract($_GET);

$categorie = WikiCategorie::first(
    array('conditions' =>
        array("id = ?", $idc)
    )
);
?>

<div class="row">
    <div class="col-md-9">
        <a id="add-sujet-show" data-toggle="modal" data-target="#modal-add-sujet" data-backdrop="static" data-keyboard="false">
            <button
                class="btn btn-success push-5-r push-10" type="button"
                style="margin-left: 103px; margin-bottom: 20px !important">
                <i class="fa fa-plus"></i> Ajouter sujet
            </button>
        </a>

        <a id="mod-cat-show" data-toggle="modal" data-target="#modal-mod-cat" data-backdrop="static" data-keyboard="false">
            <button
                class="btn btn-info push-5-r push-10" type="button"
                style="margin-left: 103px; margin-bottom: 20px !important">
                <i class="fa fa-edit"></i> Modifier catégorie
            </button>
        </a>

        <a id="add-sous-cat-show" data-toggle="modal" data-target="#modal-add-sous-cat" data-backdrop="static" data-keyboard="false">
            <button
                class="btn btn-default push-5-r push-10" type="button"
                style="margin-left: 103px; margin-bottom: 20px !important">
                <i class="fa fa-plus"></i> Ajouter sous catégorie
            </button>
        </a>

        <ul class="list list-timeline pull-t" id="ul_sujets">

        </ul>
    </div>
    <div class="col-md-3">
        <div id="scats_container">
        </div>
    </div>
</div>