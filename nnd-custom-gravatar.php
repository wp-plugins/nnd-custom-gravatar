<?php
/*
Plugin Name: NND Custom Gravatar Adder
Plugin URI: http://nnd.bostonsuperblog.com/2010/10/30/wordpress-plug-in-nerd-next-doors-custom-gravatar/
Description: Allows you to add your own custom default avatar
Version: 2.0
Author: Dan Jones
Author URI: http://nnd.BostonSuperBlog.com
License: GPL2
*/

/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

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
//START OF ADD A CUSTOM GRAVATAR
add_filter( 'avatar_defaults', 'nndnewgravatar' );
//add_option( 'nndcustgrav_options[grav_url]', plugins_url('/images/nnddefgrav.png', __FILE__));
function nndnewgravatar ($avatar_defaults) {
$nnddefaultgravatar = plugins_url('/images/nnddefgrav.png', __FILE__);
$currentoptions = get_option('nndcustgrav_options');
$nndcustomgravatar = $currentoptions['grav_url'];
$avatar_defaults[$nndcustomgravatar] = "NND Custom Gravatar";
$avatar_defaults[$nnddefaultgravatarNND] = "NND Default Gravatar";
return $avatar_defaults;}
//END OF ADD A CUSTOM GRAVATAR
// add the admin options page
add_action('admin_menu', 'nndcustgrav_admin_page');
function nndcustgrav_admin_page() {
add_options_page('NND Custom Gravatar Options', 'NND Custom Gravatar', 'manage_options', 'nndcustgrav', 'nndcustgrav_options_page');
}
// display the admin options page
function nndcustgrav_options_page() {
?>
<div>
	<h2>NND Custom Gravatar</h2>
Options relating to the NND Custom Gravatar Plugin.
	<form action="options.php" method="post">
		<?php settings_fields('nndcustgrav_settings'); ?>
		<?php do_settings_sections('nndcustgrav'); ?>
		
		<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
	</form>
</div>
<?php
}?>
<?php // add the admin settings and such
add_action('admin_init', 'nndcustgrav_admin_init');
function nndcustgrav_admin_init(){
add_settings_section('nndcustgrav_main', 'NND Custom Gravatar Settings', 'nndcustgrav_section_text', 'nndcustgrav');
add_settings_field('nndcustgrav_text_string', 'URL for Custom Gravatar', 'nndcustgrav_setting_string', 'nndcustgrav', 'nndcustgrav_main');
register_setting( 'nndcustgrav_settings', 'nndcustgrav_options', 'nndcustgrav_options_validate' );
}?>
<?php function nndcustgrav_section_text() {
echo '<p>Enter your Custom Gravatar URL here.</p>';
} ?>
<?php function nndcustgrav_setting_string() {
$options = get_option('nndcustgrav_options');
echo "<input id='nndcustgrav_text_string' name='nndcustgrav_options[grav_url]' size='40' type='text' value='{$options['grav_url']}' />";
} ?>
<?php // validate our options
function nndcustgrav_options_validate($input) {
$newinput['text_string'] = trim($input['text_string']);
if(!preg_match('/^[a-z0-9]{32}$/i', $newinput['text_string'])) {
$newinput['text_string'] = '';
}
//return $newinput;
return $input;
}
?>
<?php
//ADD THE DONATE LINK FOR OURSELVES (MAYBE SOMEONE LIKES US ENOUGH TO DONATE...)
if ( !function_exists( 'add_NND_donate_link' ) ) :
 function add_NND_donate_link($links, $file) {
static $this_plugin;
if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);

if ($file == $this_plugin){
$donate_link = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ZZJD8LKR2UAE8" target="_blank">Donate</a>';
 array_push($links, $donate_link);
}
return $links;
 }
endif;
 add_filter('plugin_row_meta', 'add_NND_donate_link', 10, 2 );
 //END OF DONATION CODE
?>