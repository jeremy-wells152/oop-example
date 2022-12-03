<?php

namespace Models;

use \Connection\Database;

abstract class Model {

    /**
     * Requests data to be populated into the model.
     * 
     * NOTE: This could later pass in the Populator object for more intelligent fetching than rudamentory queries against the database.
     * 
     * I did that...
     */
    public abstract function request(Populator $populator) : void;

    /**
     * Give the already instanced model the populated data to replicate.
     * 
     * @param   Model   $model
     * 
     * @return  void
     */
    public abstract function populate(Model $model) : void;
}