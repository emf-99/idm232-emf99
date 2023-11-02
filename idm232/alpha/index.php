<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
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
        <div class="hero-image-container">
            <img src="images/headerWlogoHeart.png" alt="Hero Image" class="hero-image">
        </div>
    </div>

    <div class="subhead"> 
      <h2>Recipies made simple...  Recipies made with love.</h2>
    </div> 

        <div class="search-filter-area">
            <div class="search-area">
                <input type="text" placeholder="Search for recipes">
                <button type="submit">Search</button>
            </div>
            <div class="filters">
              <div class="filtersCentered">
                <label><input type="checkbox" name="filter" value="beef"> Beef</label>
                <label><input type="checkbox" name="filter" value="chicken"> Chicken</label>
                <label><input type="checkbox" name="filter" value="vegetarian"> Vegetarian</label>
                <label><input type="checkbox" name="filter" value="chicken"> Pork</label>
                <label><input type="checkbox" name="filter" value="vegetarian"> Fish</label>
                <button class="clearAllButton">Clear all</button>
              </div>
            </div>
        </div>

    </header>

    <main>
        <div class="container">

            <div class="recipe-thumbnails">
            <?php
      // Get all the recipes from "recipes" table in the "idm232" database
      $query = "SELECT * FROM recipes";
      $results = mysqli_query($db_connection, $query);
      if ($results->num_rows > 0) {
        consoleMsg("Query successful! number of rows: $results->num_rows");
        while ($oneRecipe = mysqli_fetch_array($results)) {
          // echo '<h3>' .$oneRecipe['Title']. ' - '  . $oneRecipe['Cal/Serving']  .  '</h3>'; 
          $id = $oneRecipe['id']; 
            // convert line 56 like 72
          echo '<figure class="oneRec">';
          // like line 74
          echo '<img src="./images/' . $oneRecipe['Main IMG'] . '" alt="Dish Image">';
          // like line 75
          echo '<figcaption>' . $id . ' ' . $oneRecipe['Title'] . '</figcaption>';
          echo '</figure>';
          // like line 77
          echo '<figcaption class="subCap">' . $id . ' ' . $oneRecipe['Subtitle'] . '</figcaption>';
          echo '</figure>';
        }

      } else {
        consoleMsg("QUERY ERROR");
      }
    ?>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <p>&copy; 2023 made with love <br> website by ella fromherz </p>
        </div>
    </footer>
    
    <script src="main.js"></script>
</body>
</html>
