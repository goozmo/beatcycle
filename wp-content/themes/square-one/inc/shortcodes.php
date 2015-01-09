<?php
/**
 * Square One Shortcodes
 *
 * @package Square One
 */



/*
*********************************************************
Div plugin by Bill Erikson. update as needed.
*********************************************************
*/

/* Open Div */ 
add_shortcode('div', 'squareone_div_shortcode');
function squareone_div_shortcode($atts) {
    extract(shortcode_atts(array('class' => '', 'id' => '' ), $atts));
    $return = '<div';
    if (!empty($class)) $return .= ' class="'.$class.'"';
    if (!empty($id)) $return .= ' id="'.$id.'"';
    $return .= '>';
    return $return;
}

/* Close Div */
add_shortcode('end-div', 'squareone_end_div_shortcode');
function squareone_end_div_shortcode($atts) {
    return '</div>';
}

/*
*********************************************************
Button Shortcodes
*********************************************************
*/

/* button */
function squareone_button_primary( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link'  => '#',
    'target'    => '',
    ), $atts));


    $target = ($target == 'blank') ? ' target="_blank"' : '';

    $out = '<a' .$target. ' class="button' . '" href="' .$link. '"><span>' .do_shortcode($content). '</span></a>';

    return $out;
}
add_shortcode('button_primary', 'squareone_button_primary');


/* button */
function squareone_button_secondary( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link'  => '#',
    'target'    => '',
    ), $atts));


    $target = ($target == 'blank') ? ' target="_blank"' : '';

    $out = '<a' .$target. ' class="button secondary' . '" href="' .$link. '"><span>' .do_shortcode($content). '</span></a>';

    return $out;
}
add_shortcode('button_secondary', 'squareone_button_secondary');


/* button */
function squareone_button_success( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link'  => '#',
    'target'    => '',
    ), $atts));


    $target = ($target == 'blank') ? ' target="_blank"' : '';

    $out = '<a' .$target. ' class="button success' . '" href="' .$link. '"><span>' .do_shortcode($content). '</span></a>';

    return $out;
}
add_shortcode('button_success', 'squareone_button_success');


/*
*********************************************************
Grid Shortcodes
*********************************************************
*/



// row shortcode
function sq_shortcode_row($atts, $content = null){
    return '<div class="row">'.do_shortcode($content).'</div>';
}
add_shortcode("row", "sq_shortcode_row");


// column (grid) shortcode
add_shortcode("col", "sq_shortcode_column");
function sq_shortcode_column($params,$content=null){
    extract(shortcode_atts(array(
        'medium' => '', 
        'large' => '', 
        'small' => '',
        'centered' => '',
    ), $params));
    return '<div class="columns '.$centered.'-centered small-'.$small.' medium-'.$medium.' large-'.$large.'">'.do_shortcode($content).'</div>';
}

