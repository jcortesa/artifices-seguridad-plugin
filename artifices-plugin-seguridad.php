<?php
/*
Plugin Name: Opciones de Seguridad para clientes Artifices
Plugin URI: https://www.artifices.net
Description: Opciones básicas de seguridad: límite de revisiones, no actualizaciones automaticas, no edición de ficheros, no instalación de plugins. 
* Version: 1.0.4
* Author: Jesus Cortes
* Author URI: http://www.artifices.net
License: GPLv2 or later
Text Domain: artifices
*/

if( ! class_exists( 'Artifices_Updater' ) ){
    include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
}

$updater = new Artifices_Updater( __FILE__ );
$updater->set_username( 'artifices' );
$updater->set_repository( 'artifices-seguridad-plugin' );
/*
    $updater->authorize( 'abcdefghijk1234567890' ); // Your auth code goes here for private repos
*/
$updater->initialize();


// LIMITAR NUMERO DE REVISIONES EN LA BD

if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 2);
if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', false);

// IMPEDIR EDICION TEMAS & PLUGINS

define('DISALLOW_FILE_EDIT',true);

// IMPEDIR INSTALACION DE PLUGINS

define('DISALLOW_FILE_MODS',true);

// Limitar subidas

 @ini_set( 'upload_max_size' , '5M' );

// PERSONALIZAR LOGO LOGIN

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(https://www.artifices.net/wp-content/uploads/2017/03/logo_web_01.png);
		height:52px;
		width:240px;
		background-size: 240px 52px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
// From https://codex.wordpress.org/Function_Reference/get_currentuserinfo
	global $current_user;
	get_currentuserinfo();	
	
	if ('artifices' === $current_user->user_login) {
		// ACTIVAR EDICION TEMAS & PLUGINS
		define('DISALLOW_FILE_EDIT',false);
	}
?>
