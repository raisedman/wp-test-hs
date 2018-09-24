<?php

//add_filter('show_admin_bar','__return_false');


add_action('wp_enqueue_scripts','jq');

function jq(){
    wp_enqueue_script('jQuery',get_template_directory_uri().'/assets/js/jquery.js');
    wp_enqueue_script('jQueryUI',get_template_directory_uri().'/assets/js/jqueryui/jquery-ui.js');
}

add_action('wp_enqueue_scripts','some');

function some(){
    wp_enqueue_style('test-main', get_stylesheet_uri());
    wp_enqueue_script('test-script-main',get_template_directory_uri().'/assets/js/script.js');

}
add_action('after_setup_theme','test_after_setup');

function test_after_setup(){

    register_nav_menu('top','Для шапки');
    register_nav_menu('footer','Для подвала');

}

add_action('widgets_init','sidebar_right');
function sidebar_right(){
    register_sidebar([
        'name'=>'Боковая панель',
        'description'=>'Правый сайдбар',
        'id'=>'right_sidebar',
        'before_widget'=>'<div class="widget %2$s">',
        'after_widget'=>"</div>"
    ]);
    register_sidebar([
        'name'=>'Header sidebar',
        'description'=>'header_bottom_sidebar',
        'id'=>'bottom_sidebar',
        'before_widget'=>'<div class="widget %2$s">',
        'after_widget'=>"</div>\n"
    ]);
}


add_action('wp_footer','myfunc');
add_action('wp_head','myfunc');
function myfunc(){

}


