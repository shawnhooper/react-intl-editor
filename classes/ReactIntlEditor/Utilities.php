<?php
namespace ReactIntlEditor;


class Utilities {
	/**
	 * Retrieves the POST or GET objects, without replacing periods in the key
	 * with underscores (default PHP behaviour).
	 * h/t http://stackoverflow.com/questions/68651/get-php-to-stop-replacing-characters-in-get-or-post-arrays
	 *
	 * @param $source string either POST or GET
	 *
	 * @return array
	 */
	static function getRealInput($source) {
		$pairs = explode("&", $source == 'POST' ? file_get_contents("php://input") : $_SERVER['QUERY_STRING']);
		$vars = array();
		foreach ($pairs as $pair) {
			$nv = explode("=", $pair);
			$name = urldecode($nv[0]);
			$value = urldecode($nv[1]);
			$vars[$name] = $value;
		}
		return $vars;
	}

}