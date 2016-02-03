<?php

spl_autoload_register(function($className)
{
	$namespace=str_replace("\\","/",__NAMESPACE__);
	$className=str_replace("\\","/",$className);
	$class="classes/".(empty($namespace)?"":$namespace."/")."{$className}.php";
	include_once($class);
});

try {
	$reactIntlEditor = new \ReactIntlEditor\ReactIntlEditor();
} catch (\ReactIntlEditor\Exception $e) {

	echo '<div style="color:black;border:3px solid red;padding:15px;max-width:800px;width:100%;">';
	echo '<p>An error has occured during startup:</p><p>' . $e->getMessage() . '</p>';
	echo '</div>';
	die();
}

?><html lang="en">
	<head>
		<title>React Intl Editor</title>
		<link rel="stylesheet" href="assets/react-intl-editor.css" />
	</head>

	<body>
		<div class="wrapper">
			<header>
				<h1>React Intl Editor</h1>
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
							<td><?php echo $reactIntlEditor->sourceFileCount; ?></td>
						</tr>
						<tr>
							<th>Strings Found</th>
							<td><?php echo $reactIntlEditor->sourceStringCount; ?></td>
						</tr>
						<tr>
							<th>Locales Found</th>
							<td><?php echo $reactIntlEditor->localeCount; ?></td>
						</tr>
					</tbody>
				</table>
				</div>

				<div class="half">
					<h1>Locales</h1>

					<?php foreach ($reactIntlEditor->locales as $locale) { ?>

						<div class="locale_header"><h2><?php echo $locale; ?></h2>
						<?php if ($reactIntlEditor->getMissingStringCount($locale) == 0) {
							echo '<span>&#9989;</span>';
						} else {
							echo '<span>&#10060;</span>';
						} ?></div>
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
							<td><a href="editor.php?locale=<?php echo $locale; ?>&amp;type=matching"><?php echo $reactIntlEditor->getMatchingStringCount($locale); ?></a></td>
						</tr>
						<tr>
							<th>Missing Strings</th>
							<td><a href="editor.php?locale=<?php echo $locale; ?>&amp;type=missing"><?php echo $reactIntlEditor->getMissingStringCount($locale); ?></a></td>
						</tr>
						<tr>
							<th>Orphaned Strings</th>
							<td><?php echo $reactIntlEditor->getOrphanedStringCount($locale); ?></td>
						</tr>
						</tbody>
					</table>

					<?php } ?>

				</div>
			</main>
			<footer>
				<hr />
				<a href="https://github.com/shawnhooper/react-intl-editor">React Intl Editor on GitHub</a>
			</footer>
		</div>
	</body>
</html>