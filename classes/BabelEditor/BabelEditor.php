<?php
namespace BabelEditor;

class BabelEditor {

	private $fileList = [];
	private $sourceStrings = [];

	/***
	 * @param $name string The property to retrieve
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function __get($name) {
		switch ($name) {
			case 'fileCount':
				return count($this->fileList);
				break;
			case 'stringCount';
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
		$this->fileList = $this->getFileList(realpath('.') . '/intl/messages/');

		/**
		 * Extract All Strings from Source Files
		 */
		foreach ($this->fileList as $file) {
			$found = $this->extractStringsFromFile($file);

			$this->sourceStrings = array_merge($this->sourceStrings, $found);

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
	private function extractStringsFromFile($file) {

		$contents = file_get_contents($file);
		$stringsFound = json_decode($contents);
		return $stringsFound;

	}
}