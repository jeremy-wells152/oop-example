<?php

namespace Models;

class Image implements Model, HTMLGenerator {

    private int $id;
    private string $url;
    private float $rating;

    function __construct(Populator $populator, int $id, ?string $url = null, ?float $rating = null) {
        $this->id = $id;

        // Populator filled fields.
        $populator->requestImage($this, $this->id);
        $this->url = $url;
        $this->rating = $rating;
    }

    public function getId() : int {return $this->id;}
    public function getRating() : float {return $this->rating;}
    public function getUrl() : string {return $this->url;}
    public function getUniqueId() : string {return self::getUniqueIdPrefix() . $this->id;}
    public static function getUniqueIdPrefix() : string {return 'IMAGE';}
    
    public function populate(Model $model) : void {
        $this->url = $model->url;
        $this->rating = $model->rating;
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