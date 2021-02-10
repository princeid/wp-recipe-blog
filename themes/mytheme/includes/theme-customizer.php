<?php

// $wp_cutomize is an instance of the wp_customize manager class
function pd_customize_register( $wp_customize ){
    pd_social_customizer_section( $wp_customize );
    pd_misc_customizer_section( $wp_customize );

    $wp_customize->add_panel( 'mytheme_custom_panel', [
        'title'         =>  __( 'My Theme Custom Panel', 'mytheme' ),
        'description'   =>  '<p>My Theme Settings</p>',
        'priority'      =>  160
    ]);

    // Modifying Wordpress Customizer Default Section Title
    $wp_customize->get_section( 'title_tagline' )->title    =   'General';
}