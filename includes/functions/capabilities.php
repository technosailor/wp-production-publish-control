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

    $user_meta_disallow = get_user_meta( get_current_user_id(), 'wppc-disallow-publish', true );

    /**
     * This filter is used to override whatever admin setting list of domains are banned.
     * Supply an array here.
     */
    $domains_disallow = apply_filters( 'wppc\restricted_domains', get_option( 'wppc-restricted-domains' ) );

    $email_parts = explode( '@', $current_user->user_email );
    $email_domain = $email_parts[1];

    if( ! empty( $user_meta_disallow ) || in_array( $email_domain, $domains_disallow ) ) {
        foreach( $banned_caps as $banned ) {
            if( array_key_exists( $banned, $all_caps ) ) {
                $all_caps[ $banned ] = false;
            }
        }
    }

    return $all_caps;
}