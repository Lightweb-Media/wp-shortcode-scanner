<?php

/**
 * Plugin Name:     Shortcode Scanner
 * Plugin URI:      https://lightweb-media.de
 * Description:     Scannt alle vorhanden Shortcodes deiner Wordpress Installation und zeigt diese als Liste unter Einstellungen an.
 * Author:          Sebastian Weiss
 * Author URI:      https://lightweb-media.de
 * Text Domain:     Shortcodes-scanner
 * Version:         1.1.0
 */


if(is_admin())
{
    // Create the Paulund toolbar
    $shortcodes = new View_All_Available_Shortcodes();
}

/**
 * View all available shrotcodes on an admin page
 *
 * @author
 **/
class View_All_Available_Shortcodes
{
    public function __construct()
    {
        $this->Admin();
    }
    /**
     * Create the admin area
     */
    public function Admin(){
        add_action( 'admin_menu', array(&$this,'Admin_Menu') );
    }

    /**
     * Function for the admin menu to create a menu item in the settings tree
     */
    public function Admin_Menu(){
        add_submenu_page(
            'options-general.php',
            'View All Shortcodes',
            'View All Shortcodes',
            'manage_options',
            'view-all-shortcodes',
            array(&$this,'Display_Admin_Page'));
    }

    /**
     * Display the admin page
     */
    public function Display_Admin_Page(){
        global $shortcode_tags;

        ?>
        <div class="wrap">
            <div id="icon-options-general" class="icon32"><br></div>
            <h2>View All Available Shortcodes</h2>
            <div class="section panel">
                <p>This page will display all of the available shortcodes that you can use on your Wordpress blog.</p>
       <ul>
        <?php

            foreach($shortcode_tags as $code => $function)
            {
                ?>
           <li><h3>[<?php echo $code; ?>]</h3></li>
                    <?php $args = array(
    's' => $code
    );
 
$the_query = new WP_Query( $args );
 
if ( $the_query->have_posts() ) {
        echo '<ul>';
    while ( $the_query->have_posts() ) {
    $the_query->the_post(); ?>
    <li><a href="<?php  the_permalink() ?>"><?php the_title(); ?></a></li>
    <?php
    }
        echo '<br></ul>';
} else {
        echo "Sorry no posts found"; 
} ?>
                
                </tr>
                <?php
            }
        ?>
                
        </li>
                
               

        </ul>


            </div>
        </div>
        <?php
    }
} // END class View_All_Available_Shortcodes
