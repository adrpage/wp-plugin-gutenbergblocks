<?php
/**
 * Plugin Name: Plug in play
 * Plugin URI: https://google.com/
 * Description: This is a plugin adds two custom developed blocks to gutenberg editor.
 * Version: 1.0.0
 * Author: Adrian P
 *
 */

use Site\src\Sliderblock\Sliderblock as Sliderblock;
use Site\src\Loadmoreblock\Loadmoreblock as Loadmoreblock;
use Site\src\Myblocksstyles as Styler;
use Site\src\Myblocksscripts as Scripter;

require(__DIR__."/vendor/autoload.php");

$slider = new SLiderblock();
$load = new Loadmoreblock();
$styler = new Styler();
$scripter = new Scripter;