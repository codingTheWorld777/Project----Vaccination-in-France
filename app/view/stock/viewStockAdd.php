<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax parallax2">
        <div class="titre">
            Stock des vaccins ...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        $button_name = "Supprimer";
        ?>
        
        <form role="form" method='get' action='router2.php' style="margin-top: 8px;">
            <div class="form-group">
                <input type="hidden" name='action' value='<?php echo($target);?>'>
                
                <div style="display: flex; justify-content:start; margin-bottom: 24px">
                    <div style="margin-right: 40px;">
                        <label for="centre_label">centre_label : </label>
                        <select class="form-control" id='centre_label' name='centre_label' style="width: 120px">
                            <?php
                            foreach ($results['centre'] as $centre) {
                                $centreLabel = $centre['centre_label'];
                                $centreAdresse = $centre['centre_adresse'];
                                echo ("<option>$centreLabel : $centreAdresse</option>");
                            }
                            ?>
                        </select>
                    </div>

                    <div style="margin-left: 40px;">
                        <label for="vaccin_label">vaccin_label : </label>
                        <select class="form-control" id='vaccin_label' name='vaccin_label' style="width: 100px">
                            <?php
                            foreach ($results['vaccin'] as $vaccin) {
                                $vaccinLabel = $vaccin['vaccin_label'];
                                echo ("<option>$vaccinLabel</option>");
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <?php
                if ($_GET['target'] != "stockDeleted") {
                    echo("
                        <div>
                            <label for='vaccin_add'>Nombre des doses ajoutées pour le stock: </label>
                            <input type='number' id='vaccin_add' name='vaccin_add' value='1'>
                        </div>
                    ");
                    $button_name = "Ajouter";
                }
                ?>
            </div>
            
            <button class="btn btn-primary" type="submit"><?php echo($button_name); ?></button>
        </form>
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

