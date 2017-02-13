<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>

    <script src="assets/plugins/jQuery-2.1.4.min.js"></script>
    <script src="assets/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <script src="icheck-1.x/icheck.min.js"></script>
    <link rel="stylesheet" href="assets/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="icheck-1.x/skins/all.css">


    <style type="text/css">
        #redBorder {
            border-right-color: red;
            border-right-width: medium;
        }
    </style>

</head>
<body>


<div class="row">
    <div class="col-sm-6">
        <button id="addNewTracon" class="btn btn-primary">Nouveau SNK</button>
    </div>
</div>

<form>
<div class="container" id="mainContainer">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered">
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>Chambre Départ</td>
                    <td>Nom de la chambre</td>
                    <td>6</td>
                    <td rowspan="2">7</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label>Ch non empruntée</label>&nbsp;<input type="checkbox" name="ch_non_empruntee[]">
                    </td>
                    <td>
                        <select class="form-control" name="list1[]">
                            <option value="MM">MM</option>
                            <option value="M">M</option>
                            <option value="PEO">PEO</option>
                            <option value="IMPOSSIBLE">IMPOSSIBLE</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="list2[]">
                            <option value="IMB">IMB</option>
                            <option value="L1T">L1T</option>
                            <option value="L2T">L2T</option>
                            <option value="L3T">L3T</option>
                            <option value="L4T">L4T</option>
                            <option value="L6T">L6T</option>
                        </select>
                    </td>
                    <td>
                        <input class="form-control" name="nom_chambre[]">
                    </td>
                    <td>
                        <select class="form-control" name="list3[]">
                            <option value="VOITURE">VOITURE</option>
                            <option value="SECURISEE">SECURISEE</option>
                            <option value="ENROBE">ENROBE</option>
                            <option value="PRIVEE">PRIVEE</option>
                        </select>
                    </td>

                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        Alvéole
                    </td>
                    <td style="border-right-color: red; border-right-width: medium;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td rowspan="13">Tronçon 01</td>
                </tr>
                <tr>
                    <td>
                        <select class="form-control" name="list4[]">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </td>
                    <td><input class="form-control" type="number" name="alveole1[]"></td>
                    <td style="border-right-color: red; border-right-width: medium;" class="text-right"><b>-----------------></b></td>
                    <td>Longueur</td>
                    <td><input class="form-control" type="text" name="longueur[]"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label>Occupé:</label> &nbsp; <input name="occupe" type="checkbox"></td>
                    <td><label>Libre:</label> &nbsp; <input name="libre" type="checkbox"></td>
                    <td style="border-right-color: red; border-right-width: medium;">
                        <label>+4 Libres:</label> &nbsp; <input name="libres[]" type="checkbox">
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-center" style="border-right-color: red; border-right-width: medium;">
                        Diamêtre du Fourreaux emprunté
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>Ø32</label>&nbsp; <input name="o32[]" type="checkbox">
                    </td>
                    <td style="border-right-color: red; border-right-width: medium;"><input type="checkbox">
                        &nbsp;<label>Unitaire</label></td>
                    <td colspan="2" class="text-right"><label>Tubage Souple à poser</label> <input type="checkbox"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>Ø45</label>&nbsp; <input name="o45[]" type="checkbox">
                    </td>
                    <td style="border-right-color: red; border-right-width: medium;"></td>
                    <td colspan="2" class="text-right">
                        <label>Tubage Rigide à poser</label> <input name="tubage_rigide[]" type="checkbox">
                    </td>
                    <td></td>

                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>Ø60</label>&nbsp; <input name="o60[]" type="checkbox">
                    </td>
                    <td style="border-right-color: red; border-right-width: medium;"></td>
                    <td colspan="2" class="text-right">
                        <label>Tubage Existant</label> <input name="tubage_existant[]" type="checkbox">
                    </td>
                    <td></td>

                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>Ø80</label>&nbsp; <input name="o80[]" type="checkbox">
                    </td>
                    <td style="border-right-color: red; border-right-width: medium;"></td>
                    <td colspan="2" class="text-right">
                        <label>Réservation</label> <input name="reservation[]" type="checkbox">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><label>Ø100</label>&nbsp; <input name="o100[]" type="checkbox"></td>
                    <td style="border-right-color: red; border-right-width: medium;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <label>Ø150</label>&nbsp; <input name="o150[]" type="checkbox">
                    </td>
                    <td style="border-right-color: red; border-right-width: medium;"></td>
                    <td colspan="2"><input name="parcours_non_conforme[]" type="checkbox"> <label>Parcours Non
                            Conforme</label></td>

                    <td></td>
                </tr>

                <tr>
                    <td>
                        <select class="form-control" name="list5[]">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </td>
                    <td><input class="form-control" type="number" name="nombre[]"></td>
                    <td style="border-right-color: red; border-right-width: medium;" class="text-right"><b style="font-size: large;">-----------------&gt;</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>

</div>
</form>

<script>
    var number = 1;
    $(document).ready(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-red',
            radioClass: 'iradio_square-red',
            increaseArea: '20%' // optional
        });

        $('#addNewTracon').click(function (){
            number++;
            var table = $('#mainContainer > div')[0];
            var toClone = $(table).clone();
            var troncon = toClone.find('td:contains("Tronçon")')[0];
            $(troncon).text('Tronçon ' + (number < 10 ? '0' + number : number));
            toClone.appendTo('#mainContainer');
        });
    });
</script>


</body>
</html>
