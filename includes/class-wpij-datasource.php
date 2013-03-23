<?php
/**
 * This class defines the API data source and methods to fetch the jobs
 */
class DataSource {

	public static $total_results;


	/*
	 * Performs the remore request to Indeed API
	 * @param string : the search URL
	 * returns Indeed API response as JSON
	 */
	public static function fetch_jobs( $criteria ) {
		$api_url = "http://api.indeed.com/ads/apisearch?";

		$indeed_query = $api_url . build_query( $criteria, '', '&' );
		$api_response = wp_remote_get( $indeed_query );
		$json_results = wp_remote_retrieve_body( $api_response );

		/** make sure response was successful or return false */
		if ( empty( $json_results ) )
			return false;

		/** converts to an object */
		$json_object         = json_decode( $json_results );
		self::$total_results = $json_object->totalResults;
		return $json_object;
	}
}

$data_source = new DataSource();
$ds          =& $data_source;