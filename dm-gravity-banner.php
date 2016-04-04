<?php

/*
Plugin Name: DM Gravity Banner
Description: Adds custom banner before gravity forms.
Plugin URI: https://github.com/DesignMissoula/DM-gravity-banner
Author: Bradford Knowlton
Author URI: http://bradknowlton.com
Version: 1.2.2
License: GPL2
Text Domain: hwd
Domain Path: /languages

GitHub Plugin URI: https://github.com/DesignMissoula/DM-gravity-banner
GitHub Branch: master

Requires PHP: 5.3.0
Requires WP: 4.4
*/

/*

    Copyright (C) 2016  Bradford Knowlton brad@healthywebdeveloper.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


add_filter( 'gform_form_tag', 'form_tag', 10, 2 );
function form_tag( $form_tag, $form ) {
 		
    return $form_tag;
}


/* Admin init */
add_action( 'admin_init', 'my_settings_init' );
 
/* Settings Init */
function my_settings_init(){
 
    /* Register Settings */
    register_setting(
        'reading',             // Options group
        'my-option-name',      // Option name/database
        'my_settings_sanitize' // sanitize callback function
    );
 
    /* Create settings section */
    add_settings_section(
        'my-section-id',                   // Section ID
        'My Additional Reading Settings',  // Section title
        'my_settings_section_description', // Section callback function
        'reading'                          // Settings page slug
    );
 
    /* Create settings field */
    add_settings_field(
        'my-settings-field-id',       // Field ID
        'Droid Identification',       // Field title 
        'my_settings_field_callback', // Field callback function
        'media',                    // Settings page slug
        'my-section-id'               // Section ID
    );
}
 
/* Sanitize Callback Function */
function my_settings_sanitize( $input ){
    return isset( $input ) ? true : false;
}
 
/* Setting Section Description */
function my_settings_section_description(){
    echo wpautop( "This aren't the Settings you're looking for. Move along." );
}
 
/* Settings Field Callback */
function my_settings_field_callback(){
    ?>
    <label for="droid-identification">
        <input id="droid-identification" type="checkbox" value="1" name="my-option-name" <?php checked( get_option( 'my-option-name', true ) ); ?>> "You don't need to see Identification."
    </label>
    <?php
}