<li class="nav-main-heading"><span class="sidebar-mini-hide">Menu Test</span></li>
<li>
    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">changer profil</span></a>
    <ul>
        <li>
            <?php
            $stm = $db->prepare("select * from profil_utilisateur");
            $stm->execute();
            $profils = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($profils as $profil) {
                echo "<a class=\"changemod\" href=\"#\" id=\"".$profil->id_profil_utilisateur."\">".$profil->lib_profil_utilisateur."</a>";
            }
            ?>
        </li>
    </ul>
</li>
<li>
    <a href="?page=mailcreation"><i class="si si-list"></i><span class="sidebar-mini-hide">liste mail création</span></a>
</li>

<script>
    $(document).ready(function() {
        $(".changemod").click(function() {
            console.log('clicked');
            console.log($( this).attr('id'));
            $.ajax({
                method: "POST",
                url: "api/test/user_profil_update.php",
                data: {
                    idu : <?= $connectedProfil->id_utilisateur ?>,
                    idp : $( this).attr('id')
                }
            }).done(function (msg) {
                window.location.href = '';
            });
        });
    } );
</script>