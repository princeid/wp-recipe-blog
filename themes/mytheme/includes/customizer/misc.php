<?php

function pd_misc_customizer_section( $wp_customize ){
    $wp_customize->add_setting( 'pd_header_show_search', [
        'default'           =>  'yes',
        'transport'         =>  'postMessage'
    ]);

    $wp_customize->add_setting( 'pd_header_show_cart', [
        'default'           =>  'yes',
        'transport'         =>  'postMessage'
    ]);

    $wp_customize->add_setting( 'pd_footer_copyright_text', [
        'default'           =>  'Copyrights &copy; 2019 All Rights Reserved.',
    ]);

    $wp_customize->add_setting( 'pd_footer_tos_page', [
        'default'           =>  0
    ]);

    $wp_customize->add_setting( 'pd_footer_privacy_page', [
        'default'           =>  0
    ]);

    $wp_customize->add_setting( 'pd_read_more_color', [
        'default'           =>  '#1ABC9C'
    ]);

    $wp_customize->add_setting( 'pd_report_file', [
        'default'           =>  ''
    ]);

    $wp_customize->add_setting( 'pd_show_header_popular_posts', [
        'default'           =>  false
    ]);

    $wp_customize->add_setting( 'pd_popular_posts_widgets_title', [
        'default'           =>  'Breaking News'
    ]);

    $wp_customize->add_section( 'pd_misc_section', [
        'title'             =>  __( 'My Theme Misc Settings', 'mytheme' ),
        'priority'          =>  30,
        'panel'             =>  'mytheme_custom_panel'
    ]);

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'pd_header_show_search_input',
        array(
            'label'         => __( 'Show Search Button in Header', 'mytheme' ),
            'section'       => 'pd_misc_section',
            'settings'      => 'pd_header_show_search',
            'type'          =>  'checkbox',
            'choices'       =>  [
                'yes'       =>  'Yes'
            ]
        )
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'pd_header_show_cart_input',
        array(
            'label'         => __( 'Show Cart Button in Header', 'mytheme' ),
            'section'       => 'pd_misc_section',
            'settings'      => 'pd_header_show_cart',
            'type'          =>  'checkbox',
            'choices'       =>  [
                'yes'       =>  'Yes'
            ]
        )
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'pd_footer_copyright_text_input',
        array(
            'label'         => __( 'Show Search Button in Header', 'mytheme' ),
            'section'       => 'pd_misc_section',
            'settings'      => 'pd_footer_copyright_text',
        )
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'pd_footer_tos_page_input',
        array(
            'label'         => __( 'Footer Tos Page', 'mytheme' ),
            'section'       => 'pd_misc_section',
            'settings'      => 'pd_footer_tos_page',
            'type'          =>  'dropdown-pages'
        )
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'pd_footer_privacy_page_input',
        array(
            'label'         => __( 'Footer Privacy Policy Page', 'mytheme' ),
            'section'       => 'pd_misc_section',
            'settings'      => 'pd_footer_privacy_page',
            'type'          =>  'dropdown-pages'
        )
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'pd_read_more_color_input',
        array(
            'label'         => __( 'Read More Link Color', 'mytheme' ),
            'section'       => 'pd_misc_section',
            'settings'      => 'pd_read_more_color',
        )
    ));

    $wp_customize->add_control( new WP_Customize_Upload_Control(
        $wp_customize,
        'pd_report_file_input',
        array(
            'label'         => __( 'File Report', 'mytheme' ),
            'section'       => 'pd_misc_section',
            'settings'      => 'pd_report_file',
        )
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'pd_show_header_popular_posts_widget_input',
        array(
            'label'         => __( 'Show Header Popular Posts Widget', 'mytheme' ),
            'section'       => 'pd_misc_section',
            'settings'      => 'pd_show_header_popular_posts',
            'type'          =>  'checkbox',
            'choices'       =>  [
                'yes'       =>  __( 'Yes', 'mytheme' )
            ]
        )
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'pd_popular_posts_widget_title_input',
        array(
            'label'         => __( 'Popular Posts Widget Title', 'mytheme' ),
            'section'       => 'pd_misc_section',
            'settings'      => 'pd_popular_posts_widgets_title',
        )
    ));




}