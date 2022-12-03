<?php
    require_once 'assets/php/static/autoload.php';

    use \Static\Environment;

    /**
     * @var Image[]
     */
    $images = [];
    // Statics should really only be at this level most of the time (the page level or the API endpoint level).
    // this includes methods and constants.
    for ($i = 0; $i < SHOWPERPAGE; $i++) {
        $img = Environment::getImage($i); 
        $images[] = $img;
    }

    $populator->populateModels();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Very Cool Test</title>
    </head>
    <body>
        <?php
        foreach ($images as $image) {
            echo $image->getHtml();
        }
        ?>
    </body>
</html>