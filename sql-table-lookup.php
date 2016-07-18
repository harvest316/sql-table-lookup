<?php
/**
 * @package SQL_Table_Lookup
 * @version 0.1
 */
/*
Plugin Name: SQL Table Lookup
Plugin URI: http://wordpress.org/extend/plugins/sql-table-lookup/
Description: You can use these SQL lookup shortcodes to extract data from any table in your WordPress database:

[sql query="SELECT a FROM b WHERE c='d';"]
[sql]SELECT a FROM b WHERE c='d';[/sql]
[sql table="b" unique_lookup_field="c" lookup_value="d" return_field="a"]

If a table or column name has a space or other unusual character in it, wrap it in `backticks`.  If a value contains a space or other unusual characters, wrap it in 'single quotes'.

While I've taken considerable effort to prevent SQL injection attacks by escaping all other dangerous characters with esc_sql (which uses mysql_real_escape_string/mysqli_real_escape_string and addslashes), I would advise against using this plugin on a site that accepts any kind of posts or comments from untrusted sources.

Author: Paul Harvey, SEO, harvest316
Version: 0.1
Author URI: http://corpseo.com.au/
*/

function sql_lookup( $atts, $content="" ) {
	global $wpdb;
	$result = "";
	$wpdb->show_errors(); define( 'DIEONDBERROR', true ); 

	if ( $atts['query'] != "" ) {

		$query = str_replace("&#8217;","'", esc_sql($atts['query']));

	} else if ( $content != "" ) {

		$query = str_replace("&#8217;","'", esc_sql($content));

	} else {

		$return_field = esc_sql($atts['return_field']);
		$table = esc_sql($atts['table']);
		$unique_lookup_field = esc_sql($atts['unique_lookup_field']);
		$lookup_value = esc_sql($atts['lookup_value']);

		$query = "SELECT `$return_field` "
			."FROM `$table` "
			."WHERE `$unique_lookup_field` "
			."= '$lookup_value' "
			."LIMIT 1";
	}
	$result = $wpdb->get_results( $query, ARRAY_N );
	return $result[0][0];

	$wpdb->hide_errors(); define( 'DIEONDBERROR', false );
}

add_shortcode( 'sql', 'sql_lookup' );
?>