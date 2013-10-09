<?php

/* Add own button style to EDD Plugin (Settings >> Style). */
add_filter( 'edd_button_colors', 'eino_add_button_color' );

/**
 * Add button style to EDD Plugin.
 * 
 * @since 0.1.0
 */
function eino_add_button_color( $button_style  ) {
		
	if ( function_exists( 'edd_get_button_colors' ) ) {
		$button_style['eino-theme-color'] = array( 
			'label' => __( 'Eino Theme Color', 'eino' ),
			'hex'   => ''
		);
	}

	return $button_style;
	
}

/**
 * Get the Price of download.
 *
 * @author    Digital Store Theme
 * @copyright Copyright (c) 2013, Pippin
 * @link      https://easydigitaldownloads.com/theme/digital-store/
 *
 * Echoes the price with a custom format.
 *
 * @return    string
 * @access    private
 * @since     0.1.0
*/

if ( ! function_exists( 'eino_edd_the_price' ) ) {
    function eino_edd_the_price( $download_id ) {
        if ( edd_has_variable_prices( $download_id ) ) {
             $prices = get_post_meta( $download_id, 'edd_variable_prices', true );
             eino_sort_prices_by( $prices, 'amount' );
             $total = count( $prices ) - 1;
             if ( $prices[0]['amount'] < $prices[$total]['amount'] ) {
                 $min = $prices[0]['amount'];
                 $max = $prices[$total]['amount'];
             } else {
                 $min = $prices[$total]['amount'];
                 $max = $prices[0]['amount'];
             }
             return sprintf( '%s - %s', edd_currency_filter( $min ), edd_currency_filter( $max ) );
         } else {
             return edd_currency_filter( edd_format_amount( edd_get_download_price( $download_id ) ) );
         }
    }
}

/**
 * Sort Prices By
 
 * @author      Digital Store Theme
 * @copyright   Copyright (c) 2013, Pippin
 * @link        https://easydigitaldownloads.com/theme/digital-store/
 *
 * @access      private
 * @since       1.0.2
 * @return      void
*/
if ( ! function_exists( 'eino_sort_prices_by' ) ) {
    function eino_sort_prices_by( &$arr, $col ) {
        $sort_col = array();
        foreach ( $arr as $key => $row ) {
            $sort_col[$key] = $row[$col];
        }

        array_multisort( $sort_col, SORT_ASC, $arr );
    }
}

?>