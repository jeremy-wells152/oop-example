<?php

namespace Models;

use \Connection\Database;

interface Model {

    /**
     * Give the already instanced model the populated data to replicate.
     * 
     * @param   Model   $model
     * 
     * @return  void
     */
    public function populate(Model $model) : void;

    public function getUniqueId() : string;

    public static function getUniqueIdPrefix() : string;
}