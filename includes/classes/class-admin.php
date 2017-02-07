<?php
namespace WPPC\Admin;

class WPPC_Admin {

    public static function add_profile_meta() {
        wp_nonce_field( 'wppc-publishing-controls' );
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
                        <input type="checkbox" id="wppc-restrict-publishing" <?php echo ( ! current_user_can( 'manage_options' ) ) ? 'disabled="disabled"' : ''; ?>>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php
    }
}