<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

class ColorMag_Starter_Templates_Page {

	public function starter_templates()
	{
		?>
		<h1> Starter Template </h1>
		<?php

	do_action('colormag_starter_templates_page');
	}
}

new ColorMag_Starter_Templates_Page();
