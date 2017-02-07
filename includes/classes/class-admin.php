<?php
namespace WPPC\Admin;

class WPPC_Admin {

    public static function save_profile_meta( $user_id ) {

        if( ! check_admin_referer( 'wppc-publishing-controls', 'wppc-publishing-controls-nonce') ) {
            return false;
        }

        if( ! empty( $_POST[ 'wppc-restrict-publishing' ] ) ) {
            update_user_meta( (int) $user_id, 'wppc-disallow-publish', true );
        } else {
            update_user_meta( (int) $user_id, 'wppc-disallow-publish', false );
        }
    }

    public static function add_profile_meta( $user ) {
        wp_nonce_field( 'wppc-publishing-controls', 'wppc-publishing-controls-nonce' );
        $disallowed = ( get_user_meta( $user->ID, 'wppc-disallow-publish', true ) ) ? 'on' : '';
        ?>
        <h2><?php _e( 'Publishing Control', 'wppc' ); ?></h2>
        <table class="form-table">
            <tbody>
                <tr id="wppc-restrict-publish-wrap">
                    <th>
                        <label for="wppc-restrict-publish">
                            <?php _e( 'Disallow Publishing', 'wppc' ); ?>
                        </label>
                    </th>
                    <td>
                        <input type="checkbox" id="wppc-restrict-publishing" name="wppc-restrict-publishing" <?php checked( $disallowed, 'on' ) ?>>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php
    }
}