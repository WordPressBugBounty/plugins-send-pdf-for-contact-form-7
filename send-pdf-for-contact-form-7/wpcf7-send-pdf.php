<?php
/*
Plugin Name: Send PDF for Contact Form 7
Plugin URI:  https://restezconnectes.fr/tutoriel-wordpress-lextension-send-pdf-for-contact-form-7/
Description: Send a PDF with Contact Form 7. It is originally created for Contact Form 7 plugin.
Version:     1.0.3.4
Author:      Florent Maillefaud
Author URI:  https://restezconnectes.fr
License:     GPL3 or later
Domain Path: /languages
Text Domain: send-pdf-for-contact-form-7
GitHub Plugin URI: https://github.com/Florent73/send-pdf-for-contact-form-7
*/

/*  Copyright 2007-2025 Florent Maillefaud (email: contact at restezconnectes.fr)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

defined( 'ABSPATH' )
	or die( 'No direct load ! ' );

define( 'WPCF7PDF_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPCF7PDF_URL', plugins_url('/', __FILE__) );
define( 'WPCF7PDF_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

if( !defined( 'WPCF7PDF_VERSION' )) { define( 'WPCF7PDF_VERSION', '1.0.3.4' ); }
if( !defined( 'WPCF7PDF_TEXT_DOMAIN' )) { define( 'WPCF7PDF_TEXT_DOMAIN', 'send-pdf-for-contact-form-7' ); }

if ( ! defined( 'WPCF7_ADMIN_READ_CAPABILITY' ) ) { define( 'WPCF7_ADMIN_READ_CAPABILITY', 'manage_options' ); }
if ( ! defined( 'WPCF7_ADMIN_READ_WRITE_CAPABILITY' ) ) {define( 'WPCF7_ADMIN_READ_WRITE_CAPABILITY', 'manage_options' ); }

require WPCF7PDF_DIR . 'classes/send-pdf.php';
require WPCF7PDF_DIR . 'classes/prepare-pdf.php';
require WPCF7PDF_DIR . 'classes/generate.php';
require WPCF7PDF_DIR . 'classes/settings.php';
require WPCF7PDF_DIR . 'includes/shortcodes.php';

add_action( 'plugins_loaded', '_cf7_sendpdf_load' );
function _cf7_sendpdf_load() {
	$cf7_sendpdf = new cf7_sendpdf();
	$cf7_sendpdf->hooks();

    load_plugin_textdomain( 'send-pdf-for-contact-form-7', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

// Activate / desactivate / unnstall plugin
register_deactivation_hook( __FILE__, array( 'cf7_sendpdf', 'wpcf7pdf_deactivation' ) );
register_uninstall_hook( __FILE__, array( 'cf7_sendpdf', 'wpcf7pdf_uninstall' ) );
add_action( 'plugins_loaded', array( 'cf7_sendpdf', 'init' ) );