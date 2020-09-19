<?php

/*
 * Plugin Name: My First Amazing Plugin
 * Description: This plugin will change your life
 */

//herhangi bir post type content ni değştrcz

add_filter('the_content', 'amazingContentEdits');

function amazingContentEdits($content) {
    $content = $content . '<p>This is from my newly cretaed plugin</p>';

    return $content;
}

//plugin ile shortcode oluştruma, bunu istenilen yerde user [programCount] olrk kullanlck
add_shortcode('programCount', 'programCountFunction');

function programCountFunction() {


}