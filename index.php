<?php
// obtain GET parameters passed in from browser
$pokemon_name = $_GET['name'];
$pokemon_gen = $_GET['gen'];
$pokemon_type = $_GET['type'];

// create database object (connected to database file).
$database = new PDO('sqlite:pokedex-database.sqlite');


// execute a "search" of the pokedex table for pokemon with names matching
$name_result = $database->query("SELECT * FROM pokedex WHERE pname LIKE '%{$pokemon_name}%' ");
$gen_result = $database->query("SELECT * FROM pokedex WHERE pgen LIKE '%{$pokemon_gen}%' ");
$type_result = $database->query("SELECT * FROM pokedex WHERE type_1 LIKE '%{$pokemon_type}%' OR type_2 LIKE '%{$pokemon_type}%' ");

// fetch the data from the database into variable
$name_data = $name_result->fetchAll(PDO::FETCH_ASSOC);
$gen_data = $gen_result->fetchAll(PDO::FETCH_ASSOC);
$type_data = $type_result->fetchAll(PDO::FETCH_ASSOC);

/*  foreach ($name_data as $pokemon)
{
    $chill = array($pokemon['pname'], $pokemon['pgen'], $pokemon['type_1']);
} 

foreach ($type_data as $g1)
{
    $will = array($g1['pname'], $g1['pgen'], $g1['type_1']);
} */
?>
<!DOCTYPE html>
    <head>
        <link rel="stylesheet" type="text/css" href="pokedex_style.css">
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue|Cairo&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="main">
            <header>
                <h1>Pokedex</h1>
            </header>
            <div class="choices">
                <form autocomplete="on">
                <h3>Name</h3>
                <input name="name" type="text">

                <h3>Type</h3>
                <input name="type" type="text" list="type_list">
                <datalist id="type_list">
                    <option>Bug</option>
                    <option>Dark</option>
                    <option>Dragon</option>
                    <option>Electric</option>
                    <option>Fairy</option>
                    <option>Fire</option>
                    <option>Fighting</option>
                    <option>Flying</option>
                    <option>Ghost</option>
                    <option>Grass</option>
                    <option>Ground</option>
                    <option>Ice</option>
                    <option>Normal</option>
                    <option>Poison</option>
                    <option>Psychic</option>
                    <option>Rock</option>
                    <option>Steel</option>
                    <option>Water</option>
                </datalist>

                <br> <br>
                <input type="submit" value="search">
                </form>

                <div class="results">
                    <?php  
                    // generate a list of pokemon based on search results
                    if (!empty($_GET['name'])) {
                        foreach ($name_data as $pokemon) {
                            if ($pokemon >= 1) {
                            $names = "<p> {$pokemon['pname']} is type {$pokemon['type_1']}-{$pokemo['type_2']}  Gen {$pokemon['pgen']} <p>";
                            }
                            echo $names;
                        }
                    }

                    else if (empty($_GET['name']) && !empty($_GET['type'])) {
                        foreach ($type_data as $poke) {
                            $types = "<p> {$poke['pname']} is type {$poke['type_1']}-{$poke['type_2']} Gen {$poke['pgen']} <p>";
                            if ($poke > 1) {
                            echo $types;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
