<?php
/**
 * Main customind file.
 */

use Customind\Autoloader;
use Customind\Core\Customind;

defined( 'ABSPATH' ) || exit;

define( 'CUSTOMIND_VERSION', '0.0.1' );

define( 'CUSTOMIND_FILE', __FILE__ );

define( 'CUSTOMIND_DIR', __DIR__ );

require_once __DIR__ . '/core/Autoloader.php';

$autoloader = new Autoloader();
$autoloader->add_namespace( 'Customind\Core', __DIR__ . '/core' )->register();

require __DIR__ . '/core/utils.php';

global $customind;

$customind = new Customind();
