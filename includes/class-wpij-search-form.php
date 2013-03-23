<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Paul
 * Date: 26/09/12
 * Time: 7:48
 * To change this template use File | Settings | File Templates.
 */

require_once( "class-wpij-datasource.php" );
require_once( "class-wpij-pagination.php" );


class SearchForm {

	private $jobs;
	private $pagination;

	/**
	 * Creates a new instance of the plugin
	 */
	function __construct() {
		add_shortcode( 'job_search_form', array( &$this, 'job_search_form_shortcode' ) );
		add_action( 'init', array( &$this, 'process_form' ) );
		add_shortcode( 'job_search_results', array( &$this, 'job_search_results_shortcode' ) );

			add_action( 'wp_ajax_get_jobs', array( &$this, 'ajax_process_form' ) );
			add_action( 'wp_ajax_nopriv_get_jobs', array( &$this, 'ajax_process_form' ) );


	}

	/**
	 * Defines the shortcode output
	 * @return string
	 */
	function job_search_form_shortcode() {

		$options = get_option( 'indeed_options' );

		// only load scripts / styles when shortcode is present
		wp_enqueue_style( 'bootstrap-styles' );
		wp_enqueue_script( 'wp-indeed-jobs' );

		$results_page = get_permalink( $options['results_page'] );

		ob_start();
		include_once( 'form-fields.php' );
		return ob_get_clean();
	}

	/**
	 * it processes the form by gathering the submitted criteria and sending to the Indeed API via query string
	 */
	function process_form() {

		// fetch user settings
		$options = get_option( 'indeed_options' );

		// it sets the current page for pagination
		$page     = isset( $_GET['results'] ) ? intval( $_GET['results'] ) : 1;
		$per_page = $options['limit'];

		if ( ! is_admin() ) {
			// it checks to see if form was submitted
			if ( isset( $_POST['action'] ) and $_POST['action'] == 'search-indeed-jobs' ) {
				$nonce = $_POST['indeed-nonce'];

				// it verifies the form nonce for security purposes
				if ( ! wp_verify_nonce( $nonce, 'indeed-search-nonce' ) )
					die( "Security check" );
				else {

					// it extracts $_POST values into associative array

					foreach ( $_POST as $key => $value ) {
						$criteria[$key] = urlencode( stripslashes( $value ) );
					}

					// it adds the offset to the query parameters
					$criteria['start'] = 0;

					// it removes unnecessary valuse from  $criteria
					if ( isset( $criteria['indeed-nonce'] ) )
						unset( $criteria['indeed-nonce'] );
					if ( isset( $criteria['value'] ) )
						unset( $criteria['value'] );
					if ( isset( $criteria['action'] ) )
						unset( $criteria['action'] );

					delete_transient( 'wpij-criteria' );
					set_transient( 'wpij-criteria', $criteria );

					// it stores an array of job search results into a private class variable
					$response = DataSource::fetch_jobs( $criteria );

					$total_count = DataSource::$total_results;

					delete_transient( 'wpij-pagination' );

					$this->pagination = new Pagination( $page, $per_page, $total_count );
					set_transient( 'wpij-pagination', $this->pagination );
				} //end else

			} elseif ( isset( $_GET['results'] ) ) {
				$pagination       = get_transient( 'wpij-pagination' );
				$total_count      = $pagination->total_count;
				$this->pagination = new Pagination( $page, $per_page, $total_count );
				set_transient( 'wpij-pagination', $this->pagination );
				$criteria = get_transient( 'wpij-criteria' );

				// pagination query
				$criteria['start'] = $this->pagination->offset();

				$response = DataSource::fetch_jobs( $criteria );

			} else {
				// do nothing
			}
			if ( ! empty( $response ) )
				$this->jobs = $response->results;


		} // end is_admin
	} // end process_form

	/**
	 * Respond to ajax requests and return a list of jobs matching criteria
	 */
	function ajax_process_form() {

		// fetch user settings
		$options = get_option( 'indeed_options' );

		// it sets the current page for pagination
		$page     = isset( $_GET['get_var'] ) ? intval( $_GET['get_var'] ) : 1;
		$per_page = $options['limit'];

		// it checks to see if form was submitted
		if ( isset( $_POST['post_var'] ) ) {
			$criteria = array();

			// it extracts the serialized form values into an array
			$criteria = self::parseQueryString( $_POST['post_var'] );

			foreach ( $criteria as $key => $value ) {
				$criteria[$key] = filter_var($value, FILTER_SANITIZE_STRING);
			}

			// it adds the offset to the query parameters
			$criteria['start']     = 0;
			$criteria['useragent'] = urlencode( $criteria['useragent'] );
			// it removes unnecessary valuse from  $criteria
			if ( isset( $criteria['indeed-nonce'] ) )
				unset( $criteria['indeed-nonce'] );
			if ( isset( $criteria['value'] ) )
				unset( $criteria['value'] );
			if ( isset( $criteria['action'] ) )
				unset( $criteria['action'] );

			delete_transient( 'wpij-criteria' );
			set_transient( 'wpij-criteria', $criteria );

			// it stores an array of job search results into a private class variable
			$response = DataSource::fetch_jobs( $criteria );

			$total_count = DataSource::$total_results;

			delete_transient( 'wpij-pagination' );

			$this->pagination = new Pagination( $page, $per_page, $total_count );
			set_transient( 'wpij-pagination', $this->pagination );


		} elseif ( isset( $_GET['get_var'] ) ) {
			$pagination       = get_transient( 'wpij-pagination' );
			$total_count      = $pagination->total_count;
			$this->pagination = new Pagination( $page, $per_page, $total_count );
			set_transient( 'wpij-pagination', $this->pagination );
			$criteria = get_transient( 'wpij-criteria' );

			// pagination query
			$criteria['start'] = $this->pagination->offset();

			$response = DataSource::fetch_jobs( $criteria );

		} else {
			// do nothing
		}

		if ( isset( $response ) )
			$json['results'] = $response->results;
		else
			$json['results'] = array();

		$json['pagination'] = $this->display_pagination();
		echo json_encode( $json );
		die();

	} // end ajax_process_form

	/*
	 * receives array of job objects and displays in HTML
	 */
	function job_search_results_shortcode() {
		// load styles
		wp_enqueue_style( 'bootstrap-styles' );
		// load scripts
		wp_enqueue_script( 'wp-indeed-jobs' );


		// it gathers the necessary data
		$options = get_option( 'indeed_options' );

		$results_page = get_permalink( $options['results_page'] );

		// it starts outputting the jobs to the page
		$output = "<div class=\"job-search-results\">";

		if ( ! empty( $this->jobs ) ) {
			$i = 0;
			foreach ( $this->jobs as $job ) :
				$i ++;

				$output .= "<div class=\"job job-{$i}\">";

				$output .= "<p class=\"job-title\"><strong>" . __( 'Job Title', 'wp-indeed-jobs' ) . ": </strong><a href=\"{$job->url}\">{$job->jobtitle}</a></p>";
				$output .= "<p><strong>" . __( 'Company', 'wp-indeed-jobs' ) . ": </strong>{$job->company}</p>";
				$output .= "<p><strong>" . __( 'Location', 'wp-indeed-jobs' ) . ": </strong>{$job->formattedLocation}</p>";
				$output .= "<p><strong>" . __( 'Job Source', 'wp-indeed-jobs' ) . ": </strong>{$job->source}</p>";
				$output .= "<p><strong>" . __( 'Date', 'wp-indeed-jobs' ) . ": </strong>{$job->date}</p>";
				$output .= "<p><strong>" . __( 'Description', 'wp-indeed-jobs' ) . ": </strong>{$job->snippet}</p>";

				$output .= "</div>";
			endforeach;
		}

		$output .= $this->display_pagination();
		return apply_filters( 'wpij_display_search_results', $output );
	}

	/**
	 * Displays the pagination for search results
	 * @return string
	 */
	function display_pagination() {
		// it gathers the necessary data
		$options      = get_option( 'indeed_options' );
		$results_page = get_permalink( $options['results_page'] );

		// it displays the pagination links for navigating between search result pages
		$output           = "<div class=\"pagination\" style=\"clear: both;\"><ul>";
		$this->pagination = get_transient( 'wpij-pagination' );
		if ( $this->pagination->total_pages() > 1 ) {

			if ( $this->pagination->has_previous_page() ) {
				$output .= "<li><a href=\"{$results_page}?results=";
			} else {
				$output .= "<li class=\"disabled\"><a href=\"{$results_page}?results=";
			}
			$output .= $this->pagination->previous_page();
			$output .= "\">&laquo; Previous</a></li>";

			$current_page = $this->pagination->current_page;
			for ( $i = $current_page; $i <= $current_page + 9; $i ++ ) {
				if ( $i == $current_page ) {
					$output .= "<li class=\"active\"><a data-page=\"{$i}\" href=\"#\">{$i}</a></li>";
				} else {
					$output .= "<li><a data-page=\"{$i}\" href=\"{$results_page}?results={$i}\">{$i}</a></li>";
				}
			}

			if ( $this->pagination->has_next_page() ) {
				$output .= "<li><a  data-page=\"{$i}\" href=\"{$results_page}?results=";
				$output .= $this->pagination->next_page();
				$output .= "\">Next &raquo;</a></li>";
			}

		}

		$output .= "</ul></div>";
		return $output;
	}

	/**
	 * @param $str
	 *
	 * @return array
	 */
	static function parseQueryString( $str ) {
		$op    = array();
		$pairs = explode( "&", $str );
		foreach ( $pairs as $pair ) {
			list( $k, $v ) = array_map( "urldecode", explode( "=", $pair ) );
			$op[$k] = $v;
		}
		return $op;
	}
} // end SearchForm

$search_form = new SearchForm();