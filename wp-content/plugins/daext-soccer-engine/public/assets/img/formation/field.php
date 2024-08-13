<?php

/*
 * This file dynamically generates the svg used to represent the field based on the plugin options.
 */

$hex_rgb_or_dec_rgba_color = '/^((\#([0-9a-fA-F]{3}){1,2})|(rgba\(\d{1,3},\d{1,3},\d{1,3},(\d{1}|\d{1}\.\d{1,2})\)))$/';

//get data
if(!isset($_GET['formation_field_background_color']) or
   !isset($_GET['formation_field_line_color']) or
   !isset($_GET['formation_field_line_stroke_width']) or
   preg_match($hex_rgb_or_dec_rgba_color, $_GET['formation_field_background_color']) === 0 or
   preg_match($hex_rgb_or_dec_rgba_color, $_GET['formation_field_line_color']) === 0 or
   intval($_GET['formation_field_line_stroke_width'], 10) < 1 or
   intval($_GET['formation_field_line_stroke_width'], 10) > 1000
){
    die('Invalid Data');
}else{
    $formation_field_background_color = $_GET['formation_field_background_color'];
	$formation_field_line_color = $_GET['formation_field_line_color'];
	$formation_field_line_stroke_width = intval($_GET['formation_field_line_stroke_width'], 10);
}

//set the content type as a image/svg+xml
header('Content-type: image/svg+xml');

$output = '<?xml version="1.0" encoding="utf-8"?>
<!-- Generator: Adobe Illustrator 23.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<svg version="1.1" id="field" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 710 785" style="enable-background:new 0 0 710 785;" xml:space="preserve">
<style type="text/css">
	.dase-field-background{fill:' . $formation_field_background_color . ';}
	.dase-field-line-1{fill:none;stroke:' . $formation_field_line_color . ';stroke-width:' . $formation_field_line_stroke_width . ';}
	.dase-field-line-2{fill:none;stroke:' . $formation_field_line_color . ';stroke-width:' . $formation_field_line_stroke_width . ';stroke-miterlimit:10;}
</style>
<polygon id="field_fill" class="dase-field-background" points="605.8,37.3 106.2,37.3 7.1,747 149.1,747 704.9,747 "/>
<g id="field_lines">
	<polygon id="field_border" class="dase-field-line-1" points="590.2,55.5 121.8,55.5 29,728.8 162.1,728.8 683,728.8 	"/>
	<path class="dase-field-line-1" d="M421.3,590.7c-15.5-17.2-39.2-28.3-65.7-28.3c-26.5,0-50.3,11-65.7,28.3"/>
	<polyline class="dase-field-line-1" points="160.5,729 171.8,591.2 535.8,591.2 546.9,728.8 	"/>
	<polyline class="dase-field-line-1" points="266.4,729.1 268.2,681.2 439.2,681.2 440.9,728.9 	"/>
	<line id="_x3C_Path_x3E__1_" class="dase-field-line-2" x1="83.2" y1="337.2" x2="628.8" y2="337.2"/>
	<path id="_x3C_Path_x3E_" class="dase-field-line-2" d="M428.7,336.5c-1.1-30.9-33.9-55.2-73.1-55.2s-72,24.3-73.1,55.2
		c-1.2,31.9,31.5,58.5,73.1,58.5S429.9,368.4,428.7,336.5z"/>
	<polyline class="dase-field-line-1" points="492.6,55.1 499.1,134.7 209.4,134.7 216,55 	"/>
	<path class="dase-field-line-1" d="M302.9,134.4c11.7,11.1,30.7,18.3,52.3,18.3c21.6,0,40.6-7.2,52.3-18.3"/>
	<polyline class="dase-field-line-1" points="416.8,55.3 417.7,82.2 290.9,82.2 291.9,55.4 	"/>
</g>
</svg>';

echo $output;