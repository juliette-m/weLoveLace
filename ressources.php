<?php

require_once('./config.php');
/*include('form.php');*/

try {
    $pdo = new PDO(MYSQL_DSN, DB_USER, DB_PWD);
} catch (PDOException $e) {
    echo $e->getMessage();  
    $pdo = null;            
    die();                  
}

$statement = $pdo->query('SELECT * FROM t_ressources');
$ressources = $statement->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ressources</title>
    <link rel="stylesheet" href="./style/normalize.css">
    <link rel="stylesheet" href="./style/stylejuju.css">
    <link rel="stylesheet" href="./style/jquery/magnific-popup.css">
    <script src="./js/jquery/jquery-3.3.1.min.js"></script>
    <script src="./js/jquery/jquery.magnific-popup.min.js"></script>
</head>
<body>

    <div id="ressourceSection">
        <div id="ressourceSelect">
            <button class="ressourceBtn" data-button="site" id="left-btn">Sites</button>
            <button class="ressourceBtn" data-button="presse">Presse</button>
            <button class="ressourceBtn" data-button="livre">Livres</button>
            <button class="ressourceBtn" data-button="media">Medias</button>
            <button class="ressourceBtn" data-button="all">All</button>
        </div>

        <div id="ressourceParent"> 
           <?php

            for ($i=0; $i<count($ressources); $i++) {
                echo '<div class="ressourceChild" data-category="' . $ressources[$i]['type'] . '"><img src="./img/ressources/' . $ressources[$i]['image'] . '" alt="' . $ressources[$i]['titre'] . '">';
                echo '<div class="overlay"><h2>' . $ressources[$i]['titre'] . '</h2>';
                echo '<p>' . substr($ressources[$i]['description'], 0, 400) . '</p><button class="btnInfo">En savoir +</button></div></div>';
                echo '<div class="ressourceDetail"><h2>' . $ressources[$i]['titre'] . '</h2><h3>' . $ressources[$i]['auteur'] . '</h3><a href="' . $ressources[$i]['lien'] . '">Lien</a><p>' . $ressources[$i]['description'] . '</p></div>';
            }

            ?>
        </div>
    </div>
    
    <script>
        
        // Tri tags
        ressourceSelect.addEventListener("click", function(event){
            if (event.target.tagName == "BUTTON") {
                var tagRessource = document.getElementsByClassName("ressourceChild");

                for (let i = 0; i < tagRessource.length; i++) {
                    tagRessource[i].classList.add('hideRessource');
                    if (tagRessource[i].dataset.category == event.target.dataset.button) {
                        tagRessource[i].classList.remove('hideRessource');
                    }
                    else if (event.target.dataset.button == "all"){
                        tagRessource[i].classList.remove('hideRessource');
                    }
                }
            }
        })
        
        // Popup pour detail ressource --- à vérifier avec david
//        $(document).ready(function(){ 
//            $('#ressourceParent').magnificPopup({
//              delegate: 'img', 
//              type: 'image'
//            });
//        })
        
    </script>
    
</body>
</html>