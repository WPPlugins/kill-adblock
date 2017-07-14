<?php
/*
Plugin Name: Block AdBlock
Description: Block AdBlock
Author: Admiral
Version: 1.3
Author URI: https://mrkindy.com/
Text Domain: kill-adblock
Domain Path: /languages
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'KILLADBLOCK_VERSION', '1.2.0' );
/**
 * initiate plugins
 */
require 'init.php';
/**
 * Load admin setting page
 */
require 'admin-option.php';