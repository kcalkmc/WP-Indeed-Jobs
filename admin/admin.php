<?php
/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */

/**
 * Initializes the plugin options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */
add_action( 'admin_init', 'pdw_wpij_initialize_plugin_options' );

function pdw_wpij_initialize_plugin_options() {


	// First, we register a section. This is necessary since all future options must belong to one.
	add_settings_section(
		'general_settings_section', // ID used to identify this section and with which to register options
		__( 'WP Indeed Job Search Options', 'wp-indeed-jobs' ), // Title to be displayed on the administration page
		'pdw_wpij_general_options_callback', // Callback used to render the description of the section
		'indeed_options' // Page on which to add this section of options
	);

	// Next, we will introduce the fields
	add_settings_field(
		'publisher_id', // ID used to identify the field throughout the plugin
		__( 'Publisher ID', 'wp-indeed-jobs' ), // The label to the left of the option interface element
		'pdw_wpij_publisher_id_callback', // The name of the function responsible for rendering the option interface
		'indeed_options', // The page on which this option will be displayed
		'general_settings_section', // The name of the section to which this field belongs
		array( // The array of arguments to pass to the callback. In this case, just a description.
			__( 'provide your Indeed publisher ID.', 'wp-indeed-jobs' )
		)
	);

	add_settings_field(
		'channel', // ID used to identify the field throughout the plugin
		__( 'Channel', 'wp-indeed-jobs' ), // The label to the left of the option interface element
		'pdw_wpij_channel_callback', // The name of the function responsible for rendering the option interface
		'indeed_options', // The page on which this option will be displayed
		'general_settings_section', // The name of the section to which this field belongs
		array( // The array of arguments to pass to the callback. In this case, just a description.
			__( 'Channel.', 'wp-indeed-jobs' )
		)
	);

	add_settings_field(
		'limit', // ID used to identify the field throughout the plugin
		__( 'Max Number of jobs to fetch', 'wp-indeed-jobs' ), // The label to the left of the option interface element
		'pdw_wpij_limit_callback', // The name of the function responsible for rendering the option interface
		'indeed_options', // The page on which this option will be displayed
		'general_settings_section', // The name of the section to which this field belongs
		array( // The array of arguments to pass to the callback. In this case, just a description.
			__( 'Enter max number of jobs to fetch.', 'wp-indeed-jobs' )
		)
	);

	add_settings_field(
		'results_page', // ID used to identify the field throughout the plugin
		__( 'Select the page to display results on', 'wp-indeed-jobs' ), // The label to the left of the option interface element
		'pdw_wpij_results_page_callback', // The name of the function responsible for rendering the option interface
		'indeed_options', // The page on which this option will be displayed
		'general_settings_section', // The name of the section to which this field belongs
		array( // The array of arguments to pass to the callback. In this case, just a description.
			__( 'Select the page to display results on.', 'wp-indeed-jobs' )
		)
	);

	// Finally, we register the fields with WordPress
	register_setting(
		'indeed_options', 'indeed_options', 'pdw_wpij_plugin_validate_input'
	);
}

// end pdw_wpij_initialize_plugin_options

/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */

/**
 * This function provides a simple description for the General Options page.
 *
 * It is called from the 'pdw_wpij_initialize_plugin_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function pdw_wpij_general_options_callback() {
	echo '<p>' . __( 'WP Indeed Jobs settings.', 'wp-indeed-jobs' ) . '</p>';
}

// end pdw_wpij_general_options_callback

/* ------------------------------------------------------------------------ *
 * Field Callbacks
 * ------------------------------------------------------------------------ */

/**
 * This function renders the interface elements
 *
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function pdw_wpij_publisher_id_callback( $args ) {

	// First, we read the social options collection
	$options = get_option( 'indeed_options' );

	// Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	$id = '';
	if ( isset( $options['publisher_id'] ) ) {
		$id = stripslashes( $options['publisher_id'] );
	} // end if

	// Render the output
	echo '<input type="text" id="publisher_id" name="indeed_options[publisher_id]" value="' . $id . '" />';
}

function pdw_wpij_limit_callback( $args ) {

	// First, we read the social options collection
	$options = get_option( 'indeed_options' );

	// Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	$limit = '';
	if ( isset( $options['limit'] ) ) {
		$limit = stripslashes( $options['limit'] );
	} // end if

	// Render the output
	echo '<input type="text" id="limit" name="indeed_options[limit]" value="' . $limit . '" />';
}

/**
 * @param $args
 */
function pdw_wpij_channel_callback( $args ) {

	// First, we read the social options collection
	$options = get_option( 'indeed_options' );

	// Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	$channel = '';
	if ( isset( $options['channel'] ) ) {
		$limit = stripslashes( $options['channel'] );
	} // end if

	// Render the output
	echo '<input type="text" id="channel" name="indeed_options[channel]" value="' . $channel . '" />';
}

/**
 * @param $args
 */
function pdw_wpij_results_page_callback( $args ) {

	$options = get_option( 'indeed_options' );

	$html = '<select id="results_page" name="indeed_options[results_page]">';
	$html .= '<option value="default">Select a page...</option>';
	$pages = get_posts( array( 'post_type' => 'page' ) );
	foreach ( $pages as $page ) {
		$html .= '<option value="' . $page->ID . '"' . selected( $options['results_page'], $page->ID, false ) . '>' . $page->post_title . '</option>';
	}
	$html .= '</select>';

	echo $html;
}

/**
 *
 */
function pdw_wpij_create_menu_page() {
	global $pdw_wpij_settings_page;

	/* If no settings are available, add the default settings to the database. */
	//if ( false === get_option( 'indeed_options' ) )
	//	add_option( 'indeed_options', pdw_wpij_get_default_settings(), '', 'yes' );

	$pdw_wpij_settings_page = add_options_page(
		__( 'WP Indeed Job Search Options', 'wp-indeed-jobs' ), // The title to be displayed on the corresponding page for this menu
		__( 'WP Indeed Job Search', 'wp-indeed-jobs' ), // The text to be displayed for this actual menu item
		'manage_options', // Which type of users can see this menu
		'wpij-settings', // The unique ID - that is, the slug - for this menu item
		'indeedjobs_plugin_options_page', // The name of the function to call when rendering the menu for this page
		''
	);
}

// end pdw_wpij_create_menu_page
add_action( 'admin_menu', 'pdw_wpij_create_menu_page' );

/**
 *
 */
function indeedjobs_plugin_options_page() {
	?>
<!-- Create a header in the default WordPress 'wrap' container -->
<div class="wrap">

    <!-- Add the icon to the page -->
    <div id="icon-plugins" class="icon32"></div>
    <h2><?php _e( 'WP Indeed Job Search Options', 'wp-indeed-jobs' ); ?></h2>

    <!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
	<?php settings_errors(); ?>

    <!-- Create the form that will be used to render our options -->
    <form method="post" action="options.php">
			<?php settings_fields( 'indeed_options' ); ?>
			<?php do_settings_sections( 'indeed_options' ); ?>
			<?php submit_button(); ?>
    </form>


</div><!-- /.wrap -->
<?php
}

// end pdw_wpij_plugin_display

/**
 * @param $input
 *
 * @return mixed|void
 */
function pdw_wpij_plugin_validate_input( $input ) {


	// Create our array for storing the validated options
	$output = array();

	// Loop through each of the incoming options
	foreach ( $input as $key => $value ) {

		// Check to see if the current option has a value. If so, process it.
		if ( isset( $input[$key] ) ) {

			// Strip all HTML and PHP tags and properly handle quoted strings
			$output[$key] = strip_tags( stripslashes( $input[$key] ) );
		} // end if
	} // end foreach
	// Return the array processing any additional functions filtered by this action
	return apply_filters( 'pdw_wpij_plugin_validate_input', $output, $input );
}

/**
 * @return array
 */
function pdw_wpij_get_default_settings() {

	/* Add the database version setting. */
	add_option( 'pdw_wpij_db_version', INDEED_DB_VERSION );


	$pdw_wpij_settings = array(
		'publisher_id' => '',
		'limit'        => '25'

	);
	return $pdw_wpij_settings;
}

/* Display a notice that can be dismissed */
add_action( 'admin_notices', 'pdw_wpij_admin_notice' );

/**
 *
 */
function pdw_wpij_admin_notice() {
	$settings_page = admin_url() . 'options-general.php?page=wpij-settings';
	global $current_user;
	$user_id = $current_user->ID;
	if ( current_user_can( 'manage_options' ) ) {
		/* Check that the user hasn't already clicked to ignore the message */
		if ( ! get_user_meta( $user_id, 'pdw_wpij_ignore_notice' ) ) {
			echo '<div class="updated"><p>';
			printf( __( 'WP Indeed Job Search plugin activated. Please check the %1$ssettings%2$s. | %3$sDismiss%4$s', 'wp-indeed-jobs' ), '<a href="' . $settings_page . '">', '</a>', '<a href="?pdw_wpij_nag_ignore=0">', '</a>' );
			echo "</p></div>";
		}
	}
}

add_action( 'admin_init', 'pdw_wpij_nag_ignore' );

/**
 *
 */
function pdw_wpij_nag_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	/* If user clicks to ignore the notice, add that to their user meta */
	if ( isset( $_GET['pdw_wpij_nag_ignore'] ) && '0' == $_GET['pdw_wpij_nag_ignore'] ) {
		add_user_meta( $user_id, 'pdw_wpij_ignore_notice', 'true', true );
	}
}