<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 17/04/2017
 * Time: 17:26
 */

namespace share\SharePress\WordPress;

class WPCronManager {
    public function addRecurringEvent ($callable, $recurrence = 'daily') {
        add_action( $callable[1], $callable );
        if ( !wp_next_scheduled( $callable[1] ) ) {
            // Schedule the event
            wp_schedule_event( time(), $recurrence, $callable[1] );
        }
    }

    public function removeRecurringEvent ($callable) {
        $timestamp = wp_next_scheduled( $callable[1] );
        wp_unschedule_event( $timestamp, $callable[1] );
    }

    public function addSingleEvent () {
    }

    public function removeSingleEvent () {
    }
}