<?php

spl_autoload_register(function($className)
{
	$namespace=str_replace("\\","/",__NAMESPACE__);
	$className=str_replace("\\","/",$className);
	$class="classes/".(empty($namespace)?"":$namespace."/")."{$className}.php";
	include_once($class);
});

$babelEditor = new \BabelEditor\BabelEditor();


?><html lang="en">
	<head>
		<title>Babel Editor</title>
		<link rel="stylesheet" href="assets/babel-editor.css" />
	</head>

	<body>
		<div class="wrapper">
			<header>
				<h1>Babel Editor</h1>
			</header>
			<main>
				<?php



				?>
			</main>
			<footer>
				<hr />
				Created by Actionable
			</footer>
		</div>
	</body>
</html>