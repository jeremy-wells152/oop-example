<?php

namespace Models;

class Image extends Model implements HTMLGenerator {

    private int $id;
    private string $url;
    private float $rating;

    function __construct(int $id, ?string $url = null, ?float $rating = null) {
        $this->id = $id;

        // Populator filled fields.
        $this->url = $url;
        $this->rating = $rating;
    }

    public function getId() : int {return $this->id;}
    public function getUrl() : string {return $this->url;}
    public function getRating() : float {return $this->rating;}
    
    public function populate(Model $model) : void {
        $this->url = $model->url;
        $this->rating = $model->rating;
    }

    public function request(Populator $populator) : void {
        $populator->requestImage($this->id);
    }

    public function getHtml() : string {
        return <<<HTML
            <div class="flexible-lad">
                <img src="{$this->url}">
                <div class="rating-bar"><div class="rating-bar-progress"></div></div>
            </div>
        HTML;
    }
}