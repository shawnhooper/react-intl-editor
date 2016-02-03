<?php
namespace BabelEditor;

class BabelEditor {

	private $fileCount = 0;
	private $fileList = [];

	public function __get($name) {
		switch ($name) {
			case 'fileCount':
				return $this->fileCount;
				break;
		}
	}

	public function __construct() {
		/**
		 * Load the Source String Files (messages)
		 */
		$this->fileList = $this->getFileList(realpath('.') . '/intl/messages/');
		$this->fileCount = count($this->fileList);

	}

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
}