<?php
namespace BabelEditor;

class BabelEditor {

	private $sourceFiles = [];
	private $localeFiles = [];

	private $sourceStrings = [];
	private $localeStrings = [];

	/***
	 * @param $name string The property to retrieve
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function __get($name) {
		switch ($name) {
			case 'sourceFileCount':
				return count($this->sourceFiles);
				break;
			case 'localeCount':
				return count($this->localeFiles);
				break;
			case 'sourceStringCount';
				return count($this->sourceStrings);
				break;
		}

		throw new \Exception('Invalid Property Specified');
	}

	/***
	 * BabelEditor constructor.
	 */
	public function __construct() {
		/**
		 * Find all the Source Files
		 */
		$this->sourceFiles = $this->getFileList(realpath('.') . '/intl/messages/');

		/**
		 * If no source files can be found, throw an error
		 */
		if ($this->sourceFileCount == 0) {
			throw new Exception('No source files were found in intl/messages/.  At least one source file must be included.');
		}

		/**
		 * Find all the Locale Files
		 */
		$this->localeFiles = $this->getFileList(realpath('.') . '/intl/locales/');

		/**
		 * If no locales can be found, throw an error
		 */
		if ($this->localeCount == 0) {
			throw new Exception('No locale files were found in intl/locales/.  At least one locale file must be specified.');
		}

		/**
		 * Extract All Strings from Source Files
		 */
		foreach ($this->sourceFiles as $file) {
			$found = $this->extractStringsFromSourceFile($file);

			$this->sourceStrings = array_merge($this->sourceStrings, $found);

		}

		/**
		 * Extract All Strings from Locale Files
		 */
		foreach ($this->localeFiles as $file) {
			$found = $this->extractStringsFromLocaleFile($file);
			$locale = basename($file, '.json');
			$this->localeStrings[$locale] = $found;
		}

	}

	/***
	 * @param $path string The path to search for json files
	 *
	 * @return array An array of filenames (full paths)
	 */
	private function getFileList($path) {
		$fileList = [];

		$Directory = new \RecursiveDirectoryIterator($path);
		$Iterator = new \RecursiveIteratorIterator($Directory);
		$Regex = new \RegexIterator($Iterator, '/^.+\.json$/i', \RecursiveRegexIterator::GET_MATCH);

		foreach($Regex as $folder) {
			foreach ($folder as $file) {
				array_push($fileList, $file);
			}
		}

		return $fileList;
	}

	/***
	 * @param $file string Path to the file to be read
	 *
	 * @return array an array containing each string array from the JSON files
	 */
	private function extractStringsFromSourceFile($file) {

		$contents = file_get_contents($file);
		$stringsFound = json_decode($contents);
		return $stringsFound;

	}

	/***
	 * @param $file string Path to the file to be read
	 *
	 * @return array an array containing each string array from the JSON files
	 */
	private function extractStringsFromLocaleFile($file) {
		$stringsFound = [];
		$contents = file_get_contents($file);
		$json = json_decode($contents);
		if ( ! $json ) return [];
		foreach ($json as $key=>$value) {
			array_push($stringsFound, array($key, $value));
		}

		return $stringsFound;

	}

}