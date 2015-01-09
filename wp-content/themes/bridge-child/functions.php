<?php


// enqueue the child theme stylesheet

Function wp_schools_enqueue_scripts() {
wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
wp_enqueue_style( 'childstyle' );
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);

/* Load WooCommerce Functions */
require( get_stylesheet_directory() . '/woocommerce-functions.php' );


/* disable Easy Pricing Tables updates
function easy_price_filter_plugin_updates( $value ) {
    unset( $value->response['easy-pricing-tables/pricing-table-plugin.php'] );
    return $value;
 }
 add_filter( 'site_transient_update_plugins', 'easy_price_filter_plugin_updates' );

 //disable Simple Credits updates
function simple_credits_filter_plugin_updates( $value ) {
    unset( $value->response['simple-credits/configuration.php'] );
    return $value;
 }
 add_filter( 'site_transient_update_plugins', 'simple_credits_filter_plugin_updates' ); */



/** changing default wordpres email settings */ 
add_filter('wp_mail_from_name', 'new_mail_from_name');
 
function new_mail_from_name($old) {
 return 'Beat Cycle';
}

if ( function_exists('register_sidebar') )
    register_sidebar( array(
   'name' => __( 'Login Widget Area'),
   'id' => 'loginwidget',
   'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
   'before_widget' => '<aside id="%1$s" class="widget %2$s">',
   'after_widget' => "</aside>",
   'before_title' => '<h3 class="widget-title">',
   'after_title' => '</h3>',
   ) );


/* Open Div */ 
add_shortcode('div', 'be_div_shortcode');
function be_div_shortcode($atts) {
	extract(shortcode_atts(array('class' => '', 'id' => '' ), $atts));
	$return = '<div';
	if (!empty($class)) $return .= ' class="'.$class.'"';
	if (!empty($id)) $return .= ' id="'.$id.'"';
	$return .= '>';
	return $return;
}

/* Close Div */
add_shortcode('end-div', 'be_end_div_shortcode');
function be_end_div_shortcode($atts) {
	return '</div>';
}

//Dashboard widget
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'Training Videos', 'custom_dashboard_help');
}

function custom_dashboard_help() {
echo '<ul>
        <li><h4><a href="https://www.youtube.com/watch?v=8IsEVQ2FQ1c&feature=youtu.be" target="_blank">Cancelling Orders From the Backend</a></h4><p>In this video, we will go over how to cancel and restock and order from the backend of your site.</p></li>
         <li><h4><a href="https://youtu.be/gomdMfr6T60" target="_blank">Adding New Classes to the Schedule</a></h4><p>In this video, we go over how to add classes to the schedule.</p></li>
         <li><h4><a href="https://www.youtube.com/watch?v=7_2ia54dmWk&feature=youtu.be" target="_blank">Adding a Video BG to the Homepage</a></h4><p>A quick screencast on how to upload a video background to replace the image on the homepage.</p></li>
    </ul>
';
}




 //1. Add a new form element...
    add_action('register_form','myplugin_register_form');
    function myplugin_register_form (){
        $waiver_initials = ( isset( $_POST['waiver_initials'] ) ) ? $_POST['waiver_initials']: '';
        ?>
        <p>
            <label for="waiver_initials"><?php _e('Enter Your Initials to Sign Waiver','mydomain') ?><br />
                <input type="text" name="waiver_initials" id="waiver_initials" class="input" value="<?php echo esc_attr(stripslashes($waiver_initials)); ?>" size="25" /></label>
        </p>
        <?php
    }

    //2. Add validation. In this case, we make sure waiver_initials is required.
    add_filter('registration_errors', 'myplugin_registration_errors', 10, 3);
    function myplugin_registration_errors ($errors, $sanitized_user_login, $user_email) {

        if ( empty( $_POST['waiver_initials'] ) )
            $errors->add( 'waiver_initials_error', __('<strong>ERROR</strong>: You must sign the waiver.','mydomain') );

        return $errors;
    }

    //3. Finally, save our extra registration user meta.
    add_action('user_register', 'myplugin_user_register');
    function myplugin_user_register ($user_id) {
        if ( isset( $_POST['waiver_initials'] ) )
            update_user_meta($user_id, 'waiver_initials', $_POST['waiver_initials']);
    }

    /**
 * Show custom user profile fields
 * @param  obj $user The user object.
 * @return void
 */
function numediaweb_custom_user_profile_fields($user) {
?>

<label><h4>Cycling Waiver</h4></label>
<div class="waiver">CONSENT, RELEASE OF LIABILITY, ASSUMPTION OF RISK, WAIVER OF CLAIMS & INDEMNIFICATION AGREEMENT Notice – By signing this document you may be waiving certain legal rights, including the right to sue. In consideration of being allowed to use the facilities, participate in classes, receive instruction and/or training (group and/or personal) and participate in other activities (collectively the “Activities”) provided by Beat Fitness Group, LLC, d/b/a Beat Cycle (the “Host”), the Participant, and the Participant’s parent(s) or legal guardian(s) if the Participant is a minor, do hereby agree, to the fullest extent permitted by law, as follows: TO CONSENT TO USE OF MY LIKENESS. I hereby consent to the recording, use and reuse by Host and/or its licensees, assigns, parents, subsidiaries or affiliated entities and each of the respective employees, agents, officers and directors (collectively “Releasees”) of my voice, name, picture, portrait, image, video or photograph actions, likeness, appearance and biographical material (i.e., collectively “Likeness”) in any and all media now known or hereafter devised, worldwide in perpetuity, in or in connection with the promotion and exploitation of Host and its designees (in any form or media) thereof. I agree that Releasees may use all or any part of my Likeness, and may alter or modify it regardless of whether or not I am recognizable. I specifically agree that Releasees shall have full exclusive ownership of any video, photographs, images, pictures, recordings, portraits or similar, taken of me herein (“Material”) and I shall have no rights whatsoever to the Material. I waive any right to inspect or approve the finished product, including written copy, which may be created in connection therewith, and I waive any right to royalties or other compensation arising from the use of the Materials. I further waive all moral rights in the Materials. I further grant Releasees the right to reproduce, use, exhibit, display, broadcast and distribute and create derivative works of the Material and my Likeness in any and all media now known or hereafter devised worldwide, in perpetuity. I understand that neither Host nor Releasees make any representation that such Material will or will not be used in any way. TO WAIVE ALL CLAIMS that they have or may have against the Host arising out of the Participant’s participation in the Activities or the use of any equipment provided by the Host (“Equipment”), including while receiving instruction and/or training; 2) TO ASSUME ALL RISKS of participating in the Activities and using the Equipment, even those caused by the negligent acts or conduct of the Host, its owners, affiliates, operators, employees, agents, and/or officers. The Participant understands that there are inherent risks of participating in the Activities and using the Equipment, which may be both foreseen and unforeseen and include serious physical injury and death; 3) TO RELEASE the Host, its owners, affiliates, operators, employees, agents, and officers from all liability for any loss, damage, injury, death, or expense that the Participant (or his/her next of kin) may suffer, arising out of his/her participation in the Activities and/or use of the Equipment, including while receiving instruction and/or training or any claims in connection with any medical decisions made by, or actions taken by, the Host with respect to the Participant in the event of any injury. The Participant specifically understands that they are releasing any and all claims that arise or may arise from any negligent acts or conduct of the Host, its owners, affiliates, operators, employees, agents, and/or officers, to the fullest extent permitted by law. However, nothing in this Agreement shall be construed as a release for conduct that is found to constitute gross negligence or intentional conduct; and 4) TO INDEMNIFY the Host, its owners, affiliates, operators, employees, agents, and/or officers, from all liability for any loss, damage, injury, death, or expense that the Participant (or his/her next of kin) may suffer, arising out of participation in the Activities and/or use of the Equipment, including while receiving instruction and/or training. Personal Responsibility I am aware that the risk of injury from participating in the Activities may be significant, including the potential for permanent paralysis and/or death, and while particular rules, equipment, and personal discipline may reduce this risk, the risk of serious injury does exist. I understand that the use of common sense can reduce the risk of injury. The Participant and his/her parent(s) or legal guardian(s), if applicable, certify that Participant has no physical or mental condition that precludes him/her from participating in the Activities and that he/she is not participating against medical advice. Participant is responsible for notifying the Host of any changes to Participant’s health, which could affect Participant’s ability to exercise in a reasonably safe and healthy manner. The Participant understands that Participant’s participation in the Activities is voluntary and further understands that they have the opportunity to inspect the Host’s Equipment and facilities before any participation. If I observe any unusual hazard(s) or condition(s) during my presence at the facility or participation in the Activities, I will immediately remove myself from participation and bring such hazard(s) and/or condition(s) to the attention of Host personnel. The Participant understands that Participant is obligated to follow the rules of the Activities and that he/she can minimize his/her risk of injury by doing so and through the exercise of common sense and by being aware of his/her surroundings. If, while participating in the Activities, the Participant observes any unusual hazard or condition, which they believe jeopardizes Participant’s personal safety or that of others, Participant will remove Participant from participation in the Activities and immediately bring said hazard or condition to the attention of the Host. To the extent that any portion of this Agreement is deemed to be invalid under the law of the applicable jurisdiction, the remaining portions of the Agreement shall remain binding and available for use by the Host and its counsel in any proceeding. This Agreement shall be governed by and interpreted in accordance with the laws of the State of Colorado without reference to any provisions that would require the application of the law of a different jurisdiction. The parties agree that any and all disputes or controversies arising under or relating to this Release shall be resolved by binding confidential arbitration in Denver, Colorado. I HAVE READ AND UNDERSTAND THIS AGREEMENT AND I AM AWARE THAT BY SIGNING THIS AGREEMENT I MAY BE WAIVING CERTAIN LEGAL RIGHTS, INCLUDING THE RIGHT TO SUE. I, THE UNDERSIGNED, AM AT LEAST 18 YEARS OF AGE OR, IF I AM UNDER 18 YEARS OF AGE, MY PARENT OR GUARDIAN HAS SIGNED BELOW.
</div>
<label for="tc_travel_map"><h4>Cycling Waiver Initials:</label>
    <?php echo esc_attr( get_the_author_meta( 'waiver_initials', $user->ID ) ); ?>     <?php echo esc_attr( get_the_author_meta( 'waiver_sign', $user->ID ) ); ?></h4>
    
<?php
}
add_action('show_user_profile', 'numediaweb_custom_user_profile_fields');
add_action('edit_user_profile', 'numediaweb_custom_user_profile_fields');

