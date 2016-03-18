<?php

// Zie ook: http://justintadlock.com/archives/2010/11/08/sidebars-in-wordpress

add_action( 'widgets_init', 'register_theme_sidebars' );
function register_theme_sidebars() {
    register_sidebar(array(
        'name' => __('Basis Sidebar'), 
        'id' => 'sidebar', 
        'description' => __( 'De sidebar.' ), 
        'class' => 'widget', 
        'before_widget' => '<div id="%1$s" class="widget %2$s">', 
        'after_widget' => '</div>', 
        'before_title' => '<h3>', 
        'after_title' => '</h3>'
    ));
}