<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <title>made with love</title>
</head>
<body>

<?php
  // $msg = "HOWDY";
  // echo '<script type="text/javascript">console.log("'. $msg .'");</script>';

  require_once './includes/fun.php';
  consoleMsg("PHP to JS is wicked fun!");

  // include env.php that holds global vars with secret info
  require_once './env.php';

  // include database connection code
  require_once './includes/database.php';
?>

    <header>

    <div class="hero">
        <div class="hero-image-container" onclick="clearAllFilters()">
        <a href="../index.php">
            <img src="images/headerWlogoHeart.png" alt="Hero Image" class="hero-image">
          </a>
        </div>
    </div>

    <a href="javascript:void(0);" class="back_button" onclick="goBack()">←</a>
    
    </header>

    <main>
        <div class="containerOne">
            

        <?php
                // Get all the recipes from "recipes" table in the "idm232" database
                // $query = "SELECT * FROM recipes";
                // $query = "SELECT * FROM `recipes` WHERE `id` = 23 ";
                $recID = $_GET['recID'];
                $query = "SELECT * FROM recipes WHERE id={$recID}";
          
                $results = mysqli_query($db_connection, $query);
                if ($results->num_rows > 0) {
                  consoleMsg("Query successful! number of rows: $results->num_rows");
                  while ($oneRecipe = mysqli_fetch_array($results)) {

                    $id = $oneRecipe['id']; 
                    echo '<div class="main_info">';
                    
                    echo '<figure class="oneRec">';
                        echo '<img src="./images/' . $oneRecipe['Main IMG'] . '" alt="Dish Image">';
                    
                      echo '<div class="text">';
                        echo '<div class="title">';
                        echo '<figcaption>' . ' ' . $oneRecipe['Title'] . '</figcaption>';
                        echo '</div>';

                        echo '<div class="subTitle">';
                        echo '<figcaption class="subCap">' . ' ' . $oneRecipe['Subtitle'] . '</figcaption>';
                        echo '</div>';

                        echo '<div class="timeEst">';
                        echo '<figcaption class="time">' . ' ' . $oneRecipe['Cook Time'] . '</figcaption>';
                        echo '</div>';

                        echo '<div class="servingSize">';
                        echo '<figcaption class="serving">' . ' ' . $oneRecipe['Servings'] . ' servings </figcaption>';
                        echo '</div>';

                        echo '<div class="recDesc">';
                        echo '<p class="desc">' . ' ' . $oneRecipe['Description'] . '</p>';
                        echo '</div>';

                        echo '<div class="caloriesPerserving">';
                        echo '<figcaption class="calories">' . ' ' . $oneRecipe['Cal/Serving'] . ' calories </figcaption>';
                        echo '</div>';
                      echo '</div>';
                    echo '</figure>';
                    echo '</div>';
                  }

                } else {
                  consoleMsg("QUERY ERROR");
                }
            ?>
    
        </div>

        <div class="containerTwo">

        <?php
                // Get all the recipes from "recipes" table in the "idm232" database
                // $query = "SELECT * FROM recipes";
                // $query = "SELECT * FROM `recipes` WHERE `id` = 23 ";

                $recID = $_GET['recID'];
                $query = "SELECT * FROM recipes WHERE id={$recID}";

                $results = mysqli_query($db_connection, $query);
                if ($results->num_rows > 0) {
                  consoleMsg("Query successful! number of rows: $results->num_rows");
                  while ($oneRecipe = mysqli_fetch_array($results)) {

                    $id = $oneRecipe['id']; 
                    echo '<div class="ingredients">';
                    
                    echo '<figure class="ing">';
                    echo '<img class="ingImg" src="./images/ing/' . $oneRecipe['Ingredients IMG'] . '" alt="Ingredients Image">';
                    
                      echo '<div class="text">';

                      echo '<div class="ingList">';

                            echo '<p class="allIng"> Ingredients: ' . $oneRecipe['All Ingredients']  .  '</p>'; 
                            
                            $ingredientsArray = explode("*", $oneRecipe['All Ingredients']);
                            echo '<p class="ingArray"> Ingredients Array: ' . $ingredientsArray[1]  .  '</p>'; 

                            echo '<figcaption class="ingListTitle"> Ingredients </figcaption>';
                            echo '<ul class="ingList">';
                            for($lp = 0; $lp < count($ingredientsArray); $lp++) {
                              echo '<li>' . $ingredientsArray[$lp] . '</li>';
                            }
                            echo '<ul>';
                      echo '</div>';

                      echo '</div>';
                    echo '</figure>';
                    echo '</div>';
                  }

                } else {
                  consoleMsg("QUERY ERROR");
                }
            ?>
        </div>


        <div class="containerThree">

        <?php
                // Get all the recipes from "recipes" table in the "idm232" database
                // $query = "SELECT * FROM recipes";
                // $query = "SELECT * FROM `recipes` WHERE `id` = 23 ";

                $recID = $_GET['recID'];
                $query = "SELECT * FROM recipes WHERE id={$recID}";

                $results = mysqli_query($db_connection, $query);
                if ($results->num_rows > 0) {
                  consoleMsg("Query successful! number of rows: $results->num_rows");
                  while ($oneRecipe = mysqli_fetch_array($results)) {

                    $id = $oneRecipe['id']; 
                    echo '<div class="steps">';
                    echo '<figure class="step">';

                        $stepTextArray = explode("*", $oneRecipe['All Steps']);
                        echo '<p class="stepNumArray"> Number of Step Text: ' . count($stepTextArray) . '</p>';
                        
                        $stepImagesArray = explode("*", $oneRecipe['Step IMGs']);
                        echo '<p class="stepImgArray"> Number of Step Images: ' . count($stepImagesArray) . '</p>';   

                        for($lp = 0; $lp < count($stepTextArray); $lp++) {
                          // If step starts with a number, get number minus one for image name
                          $firstChar = substr($stepTextArray[$lp],0,1);
                          if (is_numeric($firstChar)) {
                            consoleMsg("First Char is: $firstChar");
                            echo '<hr class="line">';
                            echo '<img src="./images/stepImg/' . $stepImagesArray[$firstChar-1] . '" alt="Step Image">';
                            
                            echo '<span class="step-number">' . $firstChar . '.</span> ';
                          }
                              // Check if the first character is numeric before adding a period
                            $stepDesc = is_numeric($firstChar) ? substr($stepTextArray[$lp], 1) : $stepTextArray[$lp];
                            echo '<figcaption class="stepDesc">' . $stepDesc . '</figcaption>';
                        }

                    echo '</figure>';
                    echo '</div>';
                  }

                } else {
                  consoleMsg("QUERY ERROR");
                }
            ?>

        </div>

    </main>

    <a href="javascript:void(0);" class="back_button" onclick="goBack()">←</a>

    <footer>
        <div class="footer-container">
            <p>&copy; 2023 made with love <br> website by ella fromherz </p>
        </div>
    </footer>
    


<script>
  
    function goBack() {
        window.history.back();
    }
</script>

    <!-- <script src="main.js"></script> -->
</body>
</html>
