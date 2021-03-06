<?php
include($root . '/app/controller/config.php');
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="parallax parallax2">
        <div class="titre">
            Proposition vaccinée pour nos patients ...
        </div>
    </div>
    
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        
        // Proposer un rendez-vous de vaccination pour le patient
        function proposerRdv($patientInfo, $patientId, $activeCenter) {
            echo("<h4 style='color: #5a5050; margin-bottom: 24px;'>$patientInfo veut prendre un rendez-vous pour vacciner. Ajoutez un nouveau rendez-vous: </h4>");
            echo(
                "<form role='form' method='get' action='router2.php'>
                    <div class='form-group'>
                        <input type='hidden' name='action' value='setRdv'>
                        <input type='hidden' name='patientId' value='$patientId'>
                        <label for='centreInfo'>Choisir le centre où vous voulez vacciner: </label> 
                        <select class='form-control' id='centreInfo' name='centreInfo' style='width: 140px'>
            ");     
                    
            foreach ($activeCenter as $center) {
                $center = "{$center['centre_id']} : {$center['centre_label']} : {$center['centre_adresse']}";
                echo ("<option>$center</option>");
            }
            print_r($activeCenter);
                                    
            echo(
                        "</select>
                    </div>
                    <button class='btn btn-primary' type='submit'>Submit form</button>
                </form>
            ");
        }
        ?>
        <h3>Information de rendez-vous: </h3>
        
        <?php
            if (!empty($results)) {
                echo("<h4 style='color: #5a5050; margin-bottom: 24px;'>Vous avez déjà pris un rendez-vous. </h4>");
                echo("
                    <table class='table table-striped table-bordered table-hover'>
                        <thead>
                            <tr style='background-color: #AA6C39'>
                                <th scope='col'>nom</th>
                                <th scope='col'>prénom</th>
                                <th scope='col'>centre de vaccination</th>
                                <th scope='col'>adresse</th>
                                <th scope='col'>injection</th>
                                <th scope='col'>nom de vaccin</th>
                            </tr>
                        </thead>

                        <tbody>
                ");
                
                foreach ($results as $rdv) {
                    printf("
                        <tr>
                            <td>{$rdv['nom']}</td>
                            <td>{$rdv['prenom']}</td>
                            <td>{$rdv['centre_label']}</td>
                            <td>{$rdv['centre_adresse']}</td>
                            <td>{$rdv['injection']}</td>
                            <td>{$rdv['vaccin_label']}</td>    
                        </tr>    
                    ");
                }
                echo("
                        </tbody>
                    </table>
                ");
                    
                // ******** Proposer un rendez-vous pour le patient d'après son injection... ********
                // 1) Si le nombre de doses est égal à l'ịnjection du patient, ce patient n'a pas besoin de vacciner
                // alors ce patient ne peut pas venir à la page de 'pris d'un rendez-vous' ('viewSetRdv')
                // 
                // 2) Si le nombre de doses est supérieur à l'ịnjection du patient, ce patient a besoin de vacciner plus fois
                // jusqu'à le nombre de doses demandé
                if (intval($numberOfDose) == intval($patient_injection)) {
                    echo("<h4 style='color: #5a5050; margin-bottom: 24px;'>Vous avez reçu la dose complète de vaccin . <br>"
                            . "Les doses proposées du vaccin {$results[0]['vaccin_label']} par le ministère de la Santé sont $numberOfDose doses.</h4>");
                            
                    echo("<button class='btn btn-primary' style='margin-bottom:7px;' onclick='history.go(-1)'>Page précédente</button>");
                            
                } else if (intval($numberOfDose) > intval($patient_injection)) {
                    $patientId = explode(" : ", $patientInfo)[0];
                    $patientInfo = substr($patientInfo, 4, strlen($patientInfo) - 1);
                    proposerRdv($patientInfo, $patientId, $centerByVaccin);
                }
                      
            } else {
                echo("<h4 style='color: #5a5050; margin-bottom: 24px;'>Vous n'avez aucun rendez-vous avec notre centre de vaccination.</h4>");
                $patientId = explode(" : ", $patientInfo)[0];
                $patientInfo = substr($patientInfo, 4, strlen($patientInfo) - 1);
                proposerRdv($patientInfo, $patientId, $activeCenter);
            }
                    
        ?>
        
    </div>
<?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>