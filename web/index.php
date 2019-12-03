<style>

.container {
    border: solid;
    border-color: red;
    height: 400px;
    background-image: url('https://i.pinimg.com/originals/be/b7/7b/beb77b9dbd5a17d16ddf97d7612bf3eb.jpg');
    background-size: cover;
    background-position: center;
    opacity: 90%;
}

.button {
    background-color: #ED1D24;
    display: inline;
    border: solid 1px;
    color: black;
    padding: 5px 5px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 15px;
    border-radius: 5px;
    
}

input {
    padding: 5px 5px;
}

.searchbar {
    display: flex;
    justify-content: center;
    padding-top: 40px;

}

.results {
    display: flex;
    justify-content: center;
    margin-bottom: 0px;
    font-family: Impact;
    border: solid;

}

h3 {
    display: flex;
    justify-content: left;
    margin-bottom: 0px;
    font-family: Impact; 
}

/* p {
    display: flex;
    justify-content: center;
    margin-bottom: 0px;
    font-family: Impact normal;
} */

h2 {
    display: flex;
    justify-content: center;
    color: white;
    font-family: Impact;
}

h5 {
    display: flex;
    justify-content: center;
    margin-bottom: 0px;
    font-family: Impact;
}

</style>

<?php

require_once(__DIR__ . '/../src/includes/db_conn.php');
require_once(__DIR__ . '/../config.php');

$input = !empty($_GET['c']) ? $_GET['c'] : '';

?>
<div class="container h-100">
    <form method="GET">
    <div class="d-flex justify-content-center h-100">
        <h2>Broswe your favorite superhero stories</h2>
        <h5>Hulk, X-Men, Wolverine, Wasp (Ultimate), Spider-Man</h5>
        <div class="searchbar">
            <input class="search_input" type="text" name="c" placeholder="3-D Man" />
            <input class="button" type="submit" name= "submit" value="Search"/>
        </div>
    </div>
    </form>
</div>
<?php

$min_length = 3;

if(strlen($input) >= $min_length) {
    $input = htmlspecialchars($input);

 $input = mysqli_real_escape_string($con, $input);

 $raw_results = mysqli_query($con, "SELECT `title`, `issue`, `description`, `thumbnail`, `characters`, `thumbnail`, `extension` FROM comics Where (`characters` LIKE '%".$input."%')") or die(mysqli_error($con));

 if (mysqli_num_rows($raw_results) > 0){
    while($results = mysqli_fetch_array($raw_results)) {
        '<div class="results">' .
            print "<p>__________________________________________</p>";
            print "<p><h3>" .$results['title']. "</h3></p>";
            print "<p class='col-md-8'>" .$results['description']. "</p>";
            print '<div class="image"><img height="300" width="300" src="' .  $results['thumbnail'] . '.' . $results['extension'] . '"/></div>';
        '</div>';
    }
}
else {
    print "No results";
}

} else {
    if (!empty($input)) {
        print "Minimum length is " . $min_length;
    }
}
