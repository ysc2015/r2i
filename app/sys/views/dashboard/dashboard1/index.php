<!-- Stats -->
<div class="content bg-white border-b">
    <div class="row items-push text-uppercase">
        <div class="col-xs-6 col-sm-3">
            <div class="font-w700 text-gray-darker animated fadeIn">Total Projets</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)"><?=Projet::count();?></a>
        </div>
        <div class="col-xs-6 col-sm-3">
            <div class="font-w700 text-gray-darker animated fadeIn">Total Sous-projets</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)"><?=SousProjet::count();?></a>
        </div>
        <div class="col-xs-6 col-sm-3">
            <div class="font-w700 text-gray-darker animated fadeIn">Total Ordres de travaux</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)"><?=OrdreDeTravail::count();?></a>
        </div>
        <div class="col-xs-6 col-sm-3">
            <div class="font-w700 text-gray-darker animated fadeIn">Total Equipes(Tablettes)</div>
            <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)"><?=EquipeSTT::count();?></a>
        </div>
    </div>
</div>
<!-- End Stats -->
<br>