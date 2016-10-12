<?php
/*
Plugin Name: ParticleJS Background
Plugin URI: http://cakewp.com/
Description: TLet\'s add some interactive background to the sections in Divi or Elementor easily using particles.js
Author: Munir Kamal
Version: 1.0
Author URI: http://ingenious-web.com/
*/

//Load ParticleJs file
add_action( 'wp_enqueue_scripts', 'iw_particleJs_enqueue_script' );
function iw_particleJs_enqueue_script() {
  wp_enqueue_script( 'iw_particleJs', plugin_dir_url( __FILE__ ) . '/includes/particles.js', false );
}

/**
 * custom option and settings
 */
//Admin Menu
add_action("admin_menu", "add_iw_particleJs_menu_item");
function add_iw_particleJs_menu_item()
{
    add_menu_page("Particle Background", "Particle Background", "manage_options", "iwParticleJs", "iw_particleJs_settings_page", null, 99);
}

function iw_particleJs_settings_page() {
  ?>
    <div class="wrap">
    <h2>Interactive Background Plugin by Munir Kamal</h2>

    <form method="post" action="options.php">
        <?php settings_fields( 'iw_particleJs_group' ); ?>
        <?php do_settings_sections( 'iw_particleJs_group' ); ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Add Your Json Code here</th>
            <td>
            <textarea id='particlejs' name='particlejs' rows='20' cols='50' type='textarea'><?php echo esc_attr( get_option('particlejs') ); ?></textarea>
            </td>
            </tr>
        </table>
        
        <?php submit_button(); ?>

    </form>
    </div>
  <?php
}

//Admin Settings
add_action( 'admin_init', 'iw_particleJs_settings' );
function iw_particleJs_settings() {
    register_setting( 'iw_particleJs_group', 'particlejs' );
}

/**
 * Output the saved json code
 */

function output_iw_particleJs() {
    ?>
        <script type="text/javascript">
           <?php echo get_option('particlejs'); ?>
        </script>

        <style type="text/css">
            canvas.particles-js-canvas-el {
                position: absolute;
                top: 0;
                left: 0;
            }
        </style>
    <?php
}
add_action('wp_footer', 'output_iw_particleJs');
