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

    function __construct() {
        $this->database = new Database('127.0.0.1', 0, 'root', 'verysecurepassword'); // i forgot the port and dont want to look it up
        $this->database->connect();
        $this->models = [];
        $this->imageIds = [];
    }

    public function registerModel(Model $model) : void {
        $this->models[] = $model;
        $model->request($this);
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
        foreach ($this->models as $model) {
            // Retrieve image IDS.
            $results = $this->database->select(<<<SQL
                SELECT `id`, `url`, `rating`
                FROM `images`
                WHERE id IN {$set}
            SQL, $this->imageIds, $dts);

            foreach ($results as $result) {
                $model->populate(new Image($result['id'], $result['url'], $result['rating']));
            }

            // We can add further abstraction as needed to optimize and make things as efficient as possible....
        }
    }

    public function requestImage(int $id) : void {
        $imageIds[] = $id;
    }
}