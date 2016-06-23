<?php
/**
 * file: dashboard_index.php
 * User: rabii
 */
?>
<?php
/**
 * file: dashboard.php
 * User: rabii
 */
?>

<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="assets/js/plugins/slick/slick.min.css">
<link rel="stylesheet" href="assets/js/plugins/slick/slick-theme.min.css">

<!-- Page Plugins -->
<script src="assets/js/plugins/slick/slick.min.js"></script>
<script src="assets/js/plugins/chartjs/Chart.min.js"></script>
<script>
    $(function () {
        // Init page helpers (Slick Slider plugin)
        App.initHelpers('slick');
    });
</script>
<script type="text/javascript">

    $(document).ready(function(){

        /*// Get Chart Container
         var $dashChartLinesCon  = jQuery('.js-dash-chartjs-lines')[0].getContext('2d');

         // Set Chart and Chart Data variables
         var $dashChartLines, $dashChartLinesData;

         // Lines Chart Data
         var $dashChartLinesData = {
         labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
         datasets: [
         {
         label: 'This Week',
         fillColor: 'rgba(44, 52, 63, .07)',
         strokeColor: 'rgba(44, 52, 63, .25)',
         pointColor: 'rgba(44, 52, 63, .25)',
         pointStrokeColor: '#fff',
         pointHighlightFill: '#fff',
         pointHighlightStroke: 'rgba(44, 52, 63, 1)',
         data: [34, 42, 40, 65, 48, 56, 80]
         },
         {
         label: 'Last Week',
         fillColor: 'rgba(44, 52, 63, .1)',
         strokeColor: 'rgba(44, 52, 63, .55)',
         pointColor: 'rgba(44, 52, 63, .55)',
         pointStrokeColor: '#fff',
         pointHighlightFill: '#fff',
         pointHighlightStroke: 'rgba(44, 52, 63, 1)',
         data: [18, 19, 20, 35, 23, 28, 50]
         }
         ]
         };

         // Init Lines Chart
         $dashChartLines = new Chart($dashChartLinesCon).Line($dashChartLinesData, {
         scaleFontFamily: "'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif",
         scaleFontColor: '#999',
         scaleFontStyle: '600',
         tooltipTitleFontFamily: "'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif",
         tooltipCornerRadius: 3,
         maintainAspectRatio: false,
         responsive: true
         });*/
    })
</script>

<!-- Stats -->
<div class="content bg-white border-b">
    <div class="row items-push text-uppercase">
        <div class="col-xs-6 col-sm-3">
            <div class="font-w700 text-gray-darker animated fadeIn">Total projets</div>
            <div class="h1 text-primary animated flipInX"><?= Projet::count()?></div>
        </div>
        <div class="col-xs-6 col-sm-3">
            <div class="font-w700 text-gray-darker animated fadeIn">Total sous projets</div>
            <div class="h1 text-primary animated flipInX"><?= SousProjet::count()?></div>
        </div>
        <div class="col-xs-6 col-sm-3">
            <div class="font-w700 text-gray-darker animated fadeIn">Total Chambres</div>
            <div class="h1 text-primary animated flipInX"><?= Chambre::count()?></div>
        </div>
        <div class="col-xs-6 col-sm-3">
            <div class="font-w700 text-gray-darker animated fadeIn">Total Tablettes</div>
            <div class="h1 text-primary animated flipInX"><?= Tablette::count()?></div>
        </div>
    </div>
</div>
<!-- END Stats -->
<div class="content">
</div>

