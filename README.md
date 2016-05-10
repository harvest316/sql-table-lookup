# sql-table-lookup
WordPress Plugin that provides shortcodes to retrieve a value from any table in the WordPress database.
Published at https://wordpress.org/plugins/sql-table-lookup/

# Description
You can use these SQL lookup shortcodes to extract data from any table in your WordPress database:

[sql query="SELECT a FROM b WHERE c='d';"]

[sql]SELECT a FROM b WHERE c='d';[/sql]

[sql table="b" unique_lookup_field="c" lookup_value="d" return_field="a"]

If a table or column name has a space or other unusual character in it, wrap it in `backticks`. If a value contains a space or other unusual characters, wrap it in 'single quotes'.

While I've taken considerable effort to prevent SQL injection attacks by escaping all other dangerous characters with esc_sql (which uses mysql_real_escape_string/mysqli_real_escape_string and addslashes), I would advise against using this plugin on a site that accepts any kind of posts or comments from untrusted sources.
