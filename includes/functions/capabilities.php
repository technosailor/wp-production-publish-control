<?php
namespace WPPC\Capabilities;

/**
 * Callback removes publishing capabilities if current user meets restriction criteria
 *
 * @param $all_caps
 * @param $caps
 * @param $args
 * @return mixed
 */
function limit_publish_capability( $all_caps, $caps, $args ) {

    $current_user = get_user_by( 'id', get_current_user_id() );

    $banned_caps = [];
    foreach( get_post_types() as $post_type ) {
        $banned_caps = array_merge( $banned_caps, [
            'publish_' . $post_type,
            'publish_' . $post_type . 's',
            'publish_others_' . $post_type . 's',
        ] );
    }

    if( 'technosailor' === $current_user->display_name ) {
        foreach( $banned_caps as $banned ) {
            if( array_key_exists( $banned, $all_caps ) ) {
                $all_caps[ $banned ] = false;
            }
        }
    }

    return $all_caps;
}