<?php
namespace WPPC\Admin;

/**
 * Handles the rendering and saving of Admin User meta
 *
 * Class WPPC_Admin
 * @package WPPC\Admin
 */
class WPPC_Admin {

    /**
     * Saves User Profile data
     *
     * @param $user_id
     * @return bool
     */
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

    /**
     * Adds HTML UI to user profile
     *
     * @param $user
     */
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
                        <input
                            type="checkbox"
                            id="wppc-restrict-publishing"
                            name="wppc-restrict-publishing"
                            <?php checked( $disallowed, 'on' ) ?>
                            <?php echo ( get_current_user_id() === $user->ID ) ? 'disabled="disabled"' : ''; ?>
                        >
                    </td>
                </tr>
            </tbody>
        </table>

        <?php
    }

    /**
     * Registers all the settings and sections on the writing options admin page
     */
    public static function section_settings() {

        // Register Setting
        register_setting(
            'wppc',
            'wppc-restrict-publishing-domains-field'
        );

        // Register Section
        add_settings_section(
            'wppc-restrict-publishing-email-domains',
            __( 'Banned User Email Domains', 'wppc' ),
            [ 'WPPC\Admin\WPPC_Admin', 'restrict_email_domains' ],
            'writing'
        );

        // Register Field
        add_settings_field(
            'wppc-restrict-publishing-domains-field',
            __( 'Restricted Domains', 'wppc' ),
            [ '\WPPC\Admin\WPPC_Admin', 'email_domain_field' ],
            'writing',
            'wppc-restrict-publishing-email-domains'
        );

    }

    /**
     * Renders the HTML of the Settings section
     * @param $args
     */
    public static function email_domain_field( $args ) {
        $restricted_emails = get_option( 'wppc-restricted-domains' );
        wp_nonce_field( 'wppc-publishing-controls-banned-emails', 'wppc-publishing-controls-banned-emails-nonce' );
        ?>
        <input type="text" name="wppc-restrict-publishing-domains-field" id="wppc-restrict-publishing-domains-field" class="regular-text ltr" value="<?php echo sanitize_text_field( implode( ',', $restricted_emails ) ) ?>">
        <?php
    }

    /**
     * Registers a Settings Section on the Writing Options Admin page
     */
    public static function restrict_email_domains() {
       echo '<p>' . __( 'This section allows an administrator to define domains that should not be allowed to publish content', 'wppc') . '</p>';
       echo '<p>' . __( 'Multiple domains can be listed in comma separated form', 'wppc' ) . '</p>';
    }

    /**
     * Handles the saving of domain options
     *
     * @param $option
     * @param $old
     * @param $new
     * @return bool
     */
    public static function save_section_settings() {
        if( ! wp_verify_nonce( $_POST['wppc-publishing-controls-banned-emails-nonce'], 'wppc-publishing-controls-banned-emails' ) ) {
            return false;
        }

        if( empty( $_POST['wppc-restrict-publishing-domains-field'] ) ) {
            update_option( 'wppc-restricted-domains', false );
        }

        $domains = explode( ',', $_POST['wppc-restrict-publishing-domains-field'] );
        if( ! is_array( $domains ) ) {
            $domains = (array) $domains;
            $domains = array_map( 'trim', $domains );
            $domains = array_map( 'sanitize_text_field', $domains );
        }

        update_option( 'wppc-restricted-domains', $domains );
    }
}