<?php

namespace Static;

use \Models\Populator;
use \Models\Image;
use \Connection\Database;

class Environment {
	private static Populator $populator;

	public static function getImage(int $id) : Image {
		self::initPopulator();
		return new Image(self::$populator, $id);
	}

	private static function initPopulator() : void {
		if (isset(self::$populator)) {return;}
		$db = new Database('127.0.0.1', 80, 'root', '123'); // I forgot the port
		self::$populator = new Populator($db);
	}
}