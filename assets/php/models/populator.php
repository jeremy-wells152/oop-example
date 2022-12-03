<?php

namespace Models;

use \Connection\Database;

class Populator {

    /**
     * @var Model[]
     * 
     * Notice that I can tip off VSCode's Intellisense as to the type of this array...
     */
    private array $models;
    
    /**
     * @var Database
     */
    private Database $database;

    /**
     * @var int[]
     */
    private array $imageIds;

    function __construct(Database $database) {
        $this->database = $database;
        $this->database->connect();
        $this->models = [];
        $this->imageIds = [];
    }

    // Imagine a form of get_products but it will get ALL the required data for the site at this single level. So it's
    // get_products
    // get_categories
    // get_platforms
    // ..etc
    //
    // That's what this can do. You could probably get this function done with an SP as well.
    public function populateModels() : void {
        $set = Database::questionMarks(count($this->imageIds));
        $dts = str_repeat('i', count($this->imageIds));

        // Retrieve images.
        $results = $this->database->select(<<<SQL
            SELECT `id`, `url`, `rating`
            FROM `images`
            WHERE id IN {$set}
        SQL, $this->imageIds, $dts);

        /**
         * @var Image[]
         */
        $images = [];
        while (count($images) > 0) {
            $result = array_shift($results);
            $images[Image::getUniqueIdPrefix() . $result['id']] = new Image($this, $result['id'], $result['url'], $result['rating']);
        }

        // Now go through the register models and hand out the objects we created.
        foreach ($this->models as $model) {
            $model->populate($images[$model->getUniqueId()]);
        }
    }

    public function requestImage(Model $model, int $id) : void {
        $this->models[] = $model;
        $this->imageIds[] = $id;
    }
}