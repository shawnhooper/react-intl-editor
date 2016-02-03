<?php

spl_autoload_register(function($className)
{
	$namespace=str_replace("\\","/",__NAMESPACE__);
	$className=str_replace("\\","/",$className);
	$class="classes/".(empty($namespace)?"":$namespace."/")."{$className}.php";
	include_once($class);
});

try {
	$locale = $_GET['locale'];
	$type = $_GET['type'];
	$babelEditor = new \BabelEditor\BabelEditor($locale);
} catch (\BabelEditor\Exception $e) {

	echo '<div style="color:black;border:3px solid red;padding:15px;max-width:800px;width:100%;">';
	echo '<p>An error has occured during startup:</p><p>' . $e->getMessage() . '</p>';
	echo '</div>';
	die();
}

?><html lang="en">
	<head>
		<title>Babel Editor</title>
		<link rel="stylesheet" href="assets/babel-editor.css" />
	</head>

	<body>
		<div class="wrapper">
			<header>
				<h1>Babel Editor</h1>
				<h2><?php echo $locale; ?></h2>
			</header>
			<main>

			</main>
			<footer>
				<hr />
				Created by Actionable
			</footer>
		</div>
	</body>
</html>