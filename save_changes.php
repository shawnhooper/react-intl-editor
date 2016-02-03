<?php

spl_autoload_register(function($className)
{
	$namespace=str_replace("\\","/",__NAMESPACE__);
	$className=str_replace("\\","/",$className);
	$class="classes/".(empty($namespace)?"":$namespace."/")."{$className}.php";
	include_once($class);
});

try {
	$locale = $_POST['locale'];
	$type = $_POST['type'];

	if ($locale == '') {
		throw new \BabelEditor\Exception('Missing Locale');
	}
	$babelEditor = new \BabelEditor\BabelEditor($locale);

	switch ($type) {
		case 'missing':
			var_dump($_POST);
			die();
			$babelEditor->saveChanges($_POST);

			break;
		default:
			throw new \BabelEditor\Exception('Unknown String Type Specified in Querystring');
			break;
	}


} catch (\BabelEditor\Exception $e) {

	echo '<div style="color:black;border:3px solid red;padding:15px;max-width:800px;width:100%;">';
	echo '<p>An error has occured during startup:</p><p>' . $e->getMessage() . '</p>';
	echo '</div>';
	die();
}
