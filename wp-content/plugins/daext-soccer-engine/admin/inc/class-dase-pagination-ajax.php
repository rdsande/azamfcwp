<?php
/**
 * Handles the pagination used in the paginated tables of the front-end.
 *
 * @package daext-soccer-engine
 */

/**
 * Handles the pagination used in the paginated tables of the front-end.
 */
class Dase_Pagination_Ajax {

	// PROPERTIES ---------------------------------------------------------------.

	// Total number of items.
	public $total_items = -1;

	// Number of records to display per page.
	public $record_per_page = 10;

	// Store the number of adjacent pages to show on each side of the current page inside the pagination.
	private $adjacents = 2;

	// Store the current page value, this is set through the set_current_page() method.
	private $current_page = 0;

	private $pagination = array();

	// METHODS ------------------------------------------------------------------.

	/**
	 * Set the total number of items.
	 *
	 * @param $value
	 *
	 * @return void
	 */
	public function set_total_items( $value ) {
		$this->total_items = (int) $value;
	}

	/**
	 * Set the number of items to show per page.
	 *
	 * @param $value
	 *
	 * @return void
	 */
	public function set_record_per_page( $value ) {
		if ( intval( $value, 10 ) === 0 ) {
			$this->record_per_page = 1000000000;
		} else {
			$this->record_per_page = intval( $value, 10 );
		}
	}

	/**
	 * Set the current page parameter by getting it from $_GET['p'], if it's not set or it's not > than 0 then set it to 1.
	 *
	 * @param $page
	 *
	 * @return void
	 */
	public function set_current_page( $page ) {
		$this->current_page = $page;
	}

	// Set the number of adjacent pages to show on each side of the current page inside the pagination.
	private function adjacents( $value ) {
		$this->adjacents = (int) $value;
	}

	// Generate and return the pagination data.
	public function getData() {
		$this->generatePagination();
		return $this->pagination;
	}

	/**
	 * Generate the pagination and store it inside the $this->pagination property.
	 *
	 * Note that the each single item of the pagination is represented with an associative array that has three keys:
	 *
	 * - 'destination_page' The pagination page loaded when the user clicks on a pagination item.
	 * - 'type' The type of pagination items:
	 *    - 'prev' The previous button
	 *    - 'next' The next button
	 *    - 'ellipses' The ellipses (...) sign
	 *    - 'number' The button which displays the pagination number
	 * - 'disabled' A flag used to make the pagination item visually greyed and not clickable
	 */
	public function generatePagination() {

		// Reset the $pagination variable, that store the pagination data.
		$this->pagination = array();

		// Setup page vars for display.
		$prev     = $this->current_page - 1;// previous page.
		$next     = $this->current_page + 1;// next page.
		$lastpage = ceil( $this->total_items / $this->record_per_page );// last page.
		$lpm1     = $lastpage - 1;// last page minus 1.

		// Generate the pagination and save it inside the $this->pagination property.
		if ( $lastpage > 1 ) {

			// Generate previous button.
			if ( $this->current_page ) {
				if ( $this->current_page > 1 ) {
					// if the current page is > 1 the previous button is clickable.
					$this->pagination[] = array(
						'destination_page' => intval( $prev, 10 ),
						'type'             => 'prev',
						'disabled'         => false,
					);
				} else {
					// If the current page is not > 1 the previous button is not clickable.
					$this->pagination[] = array(
						'destination_page' => intval( $prev, 10 ),
						'type'             => 'prev',
						'disabled'         => true,
					);
				}
			}

			// Generate pages buttons.
			if ( $lastpage < 7 + ( $this->adjacents * 2 ) ) {

				// not enough pages to bother breaking it up.
				for ( $counter = 1; $counter <= $lastpage; $counter++ ) {
					if ( $counter == $this->current_page ) {
						$this->pagination[] = array(
							'destination_page' => intval( $counter, 10 ),
							'type'             => 'number',
							'disabled'         => true,
						);
					} else {
						$this->pagination[] = array(
							'destination_page' => intval( $counter, 10 ),
							'type'             => 'number',
							'disabled'         => false,
						);
					}
				}
			} elseif ( $lastpage > 5 + ( $this->adjacents * 2 ) ) {// enough pages to hide some.

				// close to beginning; only hide later pages.
				if ( $this->current_page < 1 + ( $this->adjacents * 2 ) ) {
					for ( $counter = 1; $counter < 4 + ( $this->adjacents * 2 ); $counter++ ) {
						if ( $counter == $this->current_page ) {
							$this->pagination[] = array(
								'destination_page' => intval( $next - 1, 10 ),
								'type'             => 'number',
								'disabled'         => true,
							);
						} else {
							$this->pagination[] = array(
								'destination_page' => intval( $counter, 10 ),
								'type'             => 'number',
								'disabled'         => false,
							);
						}
					}
					$this->pagination[] = array(
						'destination_page' => null,
						'type'             => 'ellipses',
						'disabled'         => false,
					);
					$this->pagination[] = array(
						'destination_page' => intval( $lpm1, 10 ),
						'type'             => 'number',
						'disabled'         => false,
					);
					$this->pagination[] = array(
						'destination_page' => intval( $lastpage, 10 ),
						'type'             => 'number',
						'disabled'         => false,
					);
				}

				// In middle; hide some front and some back.
				elseif ( $lastpage - ( $this->adjacents * 2 ) > $this->current_page && $this->current_page > ( $this->adjacents * 2 ) ) {
					$this->pagination[] = array(
						'destination_page' => 1,
						'type'             => 'number',
						'disabled'         => false,
					);
					$this->pagination[] = array(
						'destination_page' => 2,
						'type'             => 'number',
						'disabled'         => false,
					);
					$this->pagination[] = array(

						'destination_page' => null,
						'type'             => 'ellipses',
						'disabled'         => false,
					);
					for ( $counter = $this->current_page - $this->adjacents; $counter <= $this->current_page + $this->adjacents; $counter++ ) {
						if ( $counter == $this->current_page ) {
							$this->pagination[] = array(
								'destination_page' => intval( $counter, 10 ),
								'type'             => 'number',
								'disabled'         => true,
							);
						} else {
							$this->pagination[] = array(
								'destination_page' => intval( $counter, 10 ),
								'type'             => 'number',
								'disabled'         => false,
							);
						}
					}
					$this->pagination[] = array(
						'destination_page' => null,
						'type'             => 'ellipses',
						'disabled'         => false,
					);
					$this->pagination[] = array(
						'destination_page' => intval( $lpm1, 10 ),
						'type'             => 'number',
						'disabled'         => false,
					);
					$this->pagination[] = array(
						'destination_page' => intval( $lastpage, 10 ),
						'type'             => 'number',
						'disabled'         => false,
					);
				}

				// close to end; only hide early pages.
				else {
					$this->pagination[] = array(
						'destination_page' => 1,
						'type'             => 'number',
						'disabled'         => false,
					);
					$this->pagination[] = array(
						'destination_page' => 2,
						'type'             => 'number',
						'disabled'         => false,
					);
					$this->pagination[] = array(
						'destination_page' => null,
						'type'             => 'ellipses',
						'disabled'         => false,
					);
					for ( $counter = $lastpage - ( 2 + ( $this->adjacents * 2 ) ); $counter <= $lastpage; $counter++ ) {
						if ( $counter == $this->current_page ) {
							$this->pagination[] = array(
								'destination_page' => intval( $counter, 10 ),
								'type'             => 'number',
								'disabled'         => true,
							);
						} else {
							$this->pagination[] = array(
								'destination_page' => intval( $counter, 10 ),
								'type'             => 'number',
								'disabled'         => false,
							);
						}
					}
				}
			}

			// Generate next button.
			if ( $this->current_page ) {
				if ( $this->current_page < $counter - 1 ) {
					$this->pagination[] = array(
						'destination_page' => intval( $next, 10 ),
						'type'             => 'next',
						'disabled'         => false,
					);
				} else {
					$this->pagination[] = array(
						'destination_page' => null,
						'type'             => 'next',
						'disabled'         => true,
					);
				}
			}
		}

		return $this->pagination;
	}

	/**
	 * Generate the query string to use inside the SQL query.
	 *
	 * @return string
	 */
	public function query_limit() {

			// Calculate the $list_start position.
			$list_start = ( $this->current_page - 1 ) * $this->record_per_page;

			// Start of the list should be less than pagination count.
		if ( $list_start >= $this->total_items ) {
			$list_start = ( $this->total_items - $this->record_per_page ); }

			// List start can't be negative.
		if ( $list_start < 0 ) {
			$list_start = 0; }

			return 'LIMIT ' . intval( $list_start, 10 ) . ', ' . intval( $this->record_per_page, 10 );
	}

	/**
	 * Returns an array with the limits
	 *
	 * @return array
	 */
	public function query_limit_values() {

		// Calculate the $list_start position.
		$list_start = ( $this->current_page - 1 ) * $this->record_per_page;

		// Start of the list should be less than pagination count.
		if ( $list_start >= $this->total_items ) {
			$list_start = ( $this->total_items - $this->record_per_page ); }

		// List start can't be negative.
		if ( $list_start < 0 ) {
			$list_start = 0; }

		return array(
			'list_start'      => intval( $list_start, 10 ),
			'record_per_page' => intval( $this->record_per_page, 10 ),
		);
	}
}
