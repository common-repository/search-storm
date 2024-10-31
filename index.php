<?php
/*
Plugin Name: Multiple Category Search Storm
Plugin URI: 
Description: Search Storm allows you to search for an article by combining multiple categories
Search Storm allows you to search entering a keyword without selecting a category or entering a keyword and selecting one or more categories
Version: 1.5
Author: IMSEO
Author URI: http://imseo.it/
*/

/*
Copyright (C) 2012-16 IMSEO, http://imseo.it/ (dev@imseolab.it)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/


require_once dirname( __FILE__ ) . '/scripts/scripts.php';
if(isset($_GET['s'])){
	require_once dirname( __FILE__ ) . '/hooks.php';

	/**
	 * add filter to query
	 */
	add_filter( 'request', 'wss_alter_the_query' );
}

/**
 * add filter to wp search form
 */
add_filter('get_search_form', 'wss_search_form');

/**
 * add css 
 */


/**
 * add javascript scripts
 */
//wp_enqueue_script('');
function wss_enqueue_styles() {
    wp_enqueue_style( 'wss_style', '/wp-content/plugins/search-storm/css/wss_style.css', array(), '2014.01.03', 'screen' );
}
add_action( 'wp_enqueue_scripts', 'wss_enqueue_styles' );

/**
 * 
 * add fields to form
 */

function wss_add_form_field($return = false){
	$dom_id = 'wss_search_options';
	
	
	global $wpdb, $wp_locale;
        
        
        $ss_cat1 = get_option('searchstorm_category1');
        $ss_cat2 = get_option('searchstorm_category2');
        $ss_cat3 = get_option('searchstorm_category3');
        $ss_cat4 = get_option('searchstorm_category4');
        $ss_css = get_option('searchstorm_css');
        if($ss_css != ''):
            echo "<style>"
            .   $ss_css
            .   "</style>";
        endif;

        
	$w = '<div id="' . $dom_id . '" class="wss_search_storm_content">';
	#if($ss_cat1 != ''):
            $ss_cat1_name = ss_category_get($ss_cat1);
            $wss_cat1 = isset($_GET[$ss_cat1_name['name']]) ? $_GET[$ss_cat1_name['name']] : $ss_cat1_name['name'];
            $x1 = get_category_children_only($ss_cat1, $wss_cat1);
            if(!is_null($x1)):
                $w .= '<div id="ss_content_box1">';
                $w .= '<label id="ss_content_box1_label">'.$ss_cat1_name['name'].'</label>';
                $w .=  '<select id="' . $dom_id . '_'.$ss_cat1_name['name'].'" name="'.$ss_cat1_name['name'].'">';
                $w .= '<option></option>';	
                $w .= $x1;
                $w .= '</select>';
                $w .= '</div>';
            endif;
       #endif; 
       if($ss_cat2 != ''):
           $ss_cat2_name = ss_category_get($ss_cat2);
       
       $wss_cat2 = isset($_GET[$ss_cat2_name['name']]) ? $_GET[$ss_cat2_name['name']] : $ss_cat2_name['name'];
       $x2 = get_category_children_only($ss_cat2, $wss_cat2); 
	if(!is_null($x2)):
            $w .= '<div id="ss_content_box2">';
            $w .= '<label id="ss_content_box2_label">'.$ss_cat2_name['name'].'</label>';
            $w .=  '<select id="' . $dom_id . '_'.$ss_cat2_name['name'].'" name="'.$ss_cat2_name['name'].'">';
            $w .= '<option></option>';	
            $w .= $x2;
            $w .= '</select>';
            $w .= '</div>';	
	endif;
        endif;
        if($ss_cat3 != ''):
            $ss_cat3_name = ss_category_get($ss_cat3);
        
        $wss_cat3 = isset($_GET[$ss_cat3_name['name']]) ? $_GET[$ss_cat3_name['name']] : $ss_cat3_name['name'];
        $x3 = get_category_children_only($ss_cat3, $wss_cat3);
        if(!is_null($x3)):
            $w .= '<div id="ss_content_box3">';
            $w .= '<label id="ss_content_box3_label">'.$ss_cat3_name['name'].'</label>';
            $w .=  '<select id="' . $dom_id . '_'.$ss_cat3_name['name'].'" name="'.$ss_cat3_name['name'].'">';
            $w .= '<option></option>';	
            $w .= $x3;
            $w .= '</select>';
            $w .= '</div>';
	endif;
        endif;
        if($ss_cat4):
            $ss_cat4_name = ss_category_get($ss_cat4);
        
        $wss_cat4 = isset($_GET[$ss_cat4_name['name']]) ? $_GET[$ss_cat4_name['name']] : $ss_cat4_name['name'];
        $x4 = get_category_children_only($ss_cat4, $wss_cat4);
        if(!is_null($x4)):
            $w .= '<div id="ss_content_box4">';
            $w .= '<label id="ss_content_box4_label">'.$ss_cat4_name['name'].'</label>';
            $w .=  '<select id="' . $dom_id . '_'.$ss_cat4_name['name'].'" name="'.$ss_cat4_name['name'].'">';
            $w .= '<option></option>';	
            $w .= $x4;
            $w .= '</select>';
            $w .= '</div>';
	endif;
        endif;
	$w .= "</div>";
        //$w .= var_dump($_GET);;
	//$w .= $GLOBALS['wp_query']->request;

	
	if($return) return $w;
	//echo $w;
	
} 

function wss_search_form($form) {
	return preg_replace('/((<\/div\s*>\s*)?<\/form\s*>)/', wss_add_form_field(true) . '\\1', $form, 1);
}

/**
 * load configuration's section
 */
if ( is_admin() )
	require_once dirname( __FILE__ ) . '/admin.php';
	
	
