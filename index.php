<?php

spl_autoload_register(function($className)
{
	$namespace=str_replace("\\","/",__NAMESPACE__);
	$className=str_replace("\\","/",$className);
	$class="classes/".(empty($namespace)?"":$namespace."/")."{$className}.php";
	include_once($class);
});

try {
	$babelEditor = new \BabelEditor\BabelEditor();
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
			</header>
			<main>

				<div class="half">
				<h1>Project Stats</h1>
				<table id="project_stats">
					<thead>
					<tr>
						<th>Property</th>
						<th>Value</th>
					</tr>
					</thead>
					<tbody>
						<tr>
							<th>Message Files Found</th>
							<td><?php echo $babelEditor->sourceFileCount; ?></td>
						</tr>
						<tr>
							<th>Strings Found</th>
							<td><?php echo $babelEditor->sourceStringCount; ?></td>
						</tr>
						<tr>
							<th>Locales Found</th>
							<td><?php echo $babelEditor->localeCount; ?></td>
						</tr>
					</tbody>
				</table>
				</div>

				<div class="half">
					<h1>Locales</h1>

					<?php foreach ($babelEditor->locales as $locale) { ?>

						<h2><?php echo $locale; ?></h2>
					<table id="project_stats">
						<thead>
						<tr>
							<th>Property</th>
							<th>Value</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<th>Matching Strings</th>
							<td><?php echo $babelEditor->getMatchingStringCount($locale); ?></td>
						</tr>
						<tr>
							<th>Missing Strings</th>
							<td><?php echo $babelEditor->getMissingStringCount($locale); ?></td>
						</tr>
						<tr>
							<th>Orphaned Strings</th>
							<td><?php echo $babelEditor->getOrphanedStringCount($locale); ?></td>
						</tr>
						</tbody>
					</table>

					<?php } ?>

				</div>
			</main>
			<footer>
				<hr />
				Created by Actionable
			</footer>
		</div>
	</body>
</html>