<?php
/*
Plugin Name: NND Custom Gravatar Adder
Plugin URI: http://nnd.bostonsuperblog.com/2010/10/30/wordpress-plug-in-nerd-next-doors-custom-gravatar/
Description: Allows you to add your own custom default avatar
Version: 1.0
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

function nndnewgravatar ($avatar_defaults) {

$myavatar = get_bloginfo('url') . '/wp-content/plugins/NNDCustomGravatar/images/nnddefgrav.png';
$avatar_defaults[$myavatar] = "NND Custom Gravatar";

return $avatar_defaults;}

//END OF ADD A CUSTOM GRAVATAR
?>