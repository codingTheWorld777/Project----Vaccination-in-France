<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body onload="<?php if(empty($target)) echo("load()"); ?>" >
    <div class="parallax parallax2">
        <div class="titre">
            Trouver votre itinéraire ...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        
        <form role="form" method='get' action='router2.php?action=innov2' style="margin-top: 8px;">
            <div class="form-group">
                <div style="display: flex; justify-content:start; margin-bottom: 24px">
                    <input type="hidden" name="action" value="<?php echo($target); ?>" >
                    
                    <div style="margin-right: 40px;">
                        <label for="centre">Choisir un centre de vaccination : </label>
                        <select class="form-control" id='centre' name='centre' style="width: 180px">
                            <?php
                            foreach ($results['centre'] as $centre) {
                                $centreLabel = $centre['label'];
                                $centreAdresse = $centre['adresse'];
                                echo ("<option>$centreLabel : $centreAdresse</option>");
                            }
                            ?>
                        </select>
                    </div>

                    <div style="margin-left: 40px;">
                        <label for="patient">Information du patient : </label>
                        <select class="form-control" id='patient' name='patient' style="width: 140px">
                            <?php
                            foreach ($results['patient'] as $patient) {
                                $patientNom = $patient['nom'];
                                $patientPrenom = $patient['prenom'];
                                $patientAdresse = $patient['adresse'];
                                echo ("<option>$patientNom $patientPrenom : $patientAdresse</option>");
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <?php
                if (empty($target) && !empty($centre_adresse) && !empty($patient_adresse)) {
                    echo("<h3>Dans le cas votre navigateur bloque automatiquement <b class='text-danger'>Pop-ups</b>, cliquez ici pour voir votre itinéraire.</h3>");
                    echo("<a href='$results' id='ggMap' target='_blank'>$results</a>");
                }
                ?>
            </div>
            
            <?php
                if (!empty($target)) echo("<button class='btn btn-primary' type='submit'>Rechercher</button>");
                else echo("<a href='router2.php?action=innov2&target=getMap' class='btn btn-primary' style='margin-bottom:7px;'>Page précédente</a>");
            ?>
        </form>
        
    </div>
    
<script type="text/javascript">
    function load() {
        let url = document.getElementById("ggMap");
        console.log(url);
        window.open(url,'_blank');
    }
</script>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

