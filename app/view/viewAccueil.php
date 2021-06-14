 
<!-- ----- debut de la page accueil -->
<?php include 'fragment/fragmentHeader.html'; ?>
<body>
    <div class="parallax">
        <div class="titre">Vaccination contre le COVID-19 !</div>
    </div>
    
    <div class="container">
        <?php
        include 'fragment/fragmentMenu.html';
        ?>
        
        <div class="jumbotron">
            <a href="router2.php?action=vaccinReadAll"><h1 style="color: white; font-family: 'Red Rose', cursive;">Découvrez nos vaccins !</h1></a>
        </div>

        <div class="jumbotron">
            <a href="router2.php?action=centreReadAll"><h1 style="color: white; font-family: 'Red Rose', cursive;">Allez à nos centres de vaccination !</h1></a>
        </div>

        <div class="jumbotron">
            <a href="router2.php?action=stockReadDosesByVaccinByCenter"><h1 style="color: white; font-family: 'Red Rose', cursive;">Nos stocks !</h1></a>
        </div>
        
        <div class="jumbotron">
            <a href="router2.php?action=rdvReadAll"><h1 style="color: white; font-family: 'Red Rose', cursive;">Liste des rendez-vous !</h1></a>
        </div>
    </div>
<?php include 'fragment/fragmentFooter.html'; ?>
<!-- ----- fin de la page accueil -->
