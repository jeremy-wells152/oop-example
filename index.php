<?php
    require_once 'assets/php/static/autoload.php';

    use \Models\Populator;
    use \Models\Image;

    $populator = new Populator();

    /**
     * @var Image[]
     */
    $images = [];
    for ($i = 0; $i < SHOWPERPAGE; $i++) { // Statics should really only be at this level most of the time (the page level or the API endpoint level).
        $img = new Image($i);
        $images[] = $img;
        $populator->registerModel($img);
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