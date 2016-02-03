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

	switch ($type) {
		case 'missing':
			$missing = $babelEditor->getMissingStrings();
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

				<?php $i=0; foreach ($missing as $string) { ?>

					<table class="translate_item" id="translate-table-<?php echo $i; ?>">
						<thead>
							<tr>
								<td><span class="key"></strong><?php echo $string->id; ?></span></td>
								<td></td>
								<td>Translated Text for <?php echo $locale; ?> locale</td>
							</tr>
						</thead>
						<tbody>
						<tr>
							<td class="original">
								<p><span id="original-<?php echo $i;?>"><?php echo $string->defaultMessage; ?></span></p>
							</td>
							<td>
								<button class="copybutton" data-id="<?php echo $i; ?>">Copy &gt;</button>
							</td>
							<td>
								<textarea class="translation" name="<?php echo $string->id; ?>" id="translation-<?php echo $i; ?>"></textarea>
							</td>
						</tr>
						</tbody>
						<?php if ($string->description !== null && $string->description !== $string->defaultMessage) { ?>
						<tfoot>
							<tr>
								<td colspan="3">
									<strong>Context:</strong><br /><?php echo $string->description; ?>
								</td>
							</tr>
						</tfoot>
						<?php } ?>
					</table>



				<?php
					$i++;
				}
				?>

			</main>
			<footer>
				<hr />
				Created by Actionable
			</footer>
		</div>

		<script type="text/javascript" src="assets/editor.js"></script>

	</body>
</html>