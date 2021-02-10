<?php

function pd_social_customizer_section( $wp_customize ){
    $wp_customize->add_setting( 'pd_facebook_handle', [
        'default'           =>  ''
    ] );

    $wp_customize->add_section( 'pd_social_section', [
        'title'             =>  __( 'My Theme Social Settings', 'mytheme' ),
        'priority'          =>  30,
        'panel'             =>  'mytheme_custom_panel'
    ] );

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'pd_social_facebook_input',
        array(
            'label'         => __( 'Facebook Handle', 'mytheme' ),
            'section'       => 'pd_social_section',
            'settings'      => 'pd_facebook_handle'
        )
    ) );
}







// function ju_social_customizer_section( $wp_customize ){
// 	$wp_customize->add_setting( 'ju_facebook_handle', array(
// 		'default'                   =>  '',
// 	));

// 	$wp_customize->add_setting( 'ju_twitter_handle', array(
// 		'default'                   =>  '',
// 	));

// 	$wp_customize->add_setting( 'ju_instagram_handle', array(
// 		'default'                   =>  '',
// 	));

// 	$wp_customize->add_setting( 'ju_email', array(
// 		'default'                   =>  '',
// 	));

// 	$wp_customize->add_setting( 'ju_phone_number', array(
// 		'default'                   =>  '',
// 	));

// 	$wp_customize->add_section( 'ju_social_section', array(
// 		'title'                     =>  __( 'Udemy Social Settings', 'udemy' ),
// 		'priority'                  =>  30,
// 		'panel'                     =>  'udemy'
// 	));

// 	$wp_customize->add_control(new WP_Customize_Control(
// 		$wp_customize,
// 		'ju_social_facebook_input',
// 		array(
// 			'label'                 =>  __( 'Facebook Handle', 'theme_name' ),
// 			'section'               => 'ju_social_section',
// 			'settings'              => 'ju_facebook_handle',
// 			'type'                  =>  'text'
// 		)
// 	));

// 	$wp_customize->add_control(new WP_Customize_Control(
// 		$wp_customize,
// 		'ju_social_twitter_input',
// 		array(
// 			'label'                 =>  __( 'Twitter Handle', 'theme_name' ),
// 			'section'               => 'ju_social_section',
// 			'settings'              => 'ju_twitter_handle',
// 			'type'                  =>  'text'
// 		)
// 	));

// 	$wp_customize->add_control(new WP_Customize_Control(
// 		$wp_customize,
// 		'ju_social_instagram_input',
// 		array(
// 			'label'                 =>  __( 'Instagram Handle', 'theme_name' ),
// 			'section'               => 'ju_social_section',
// 			'settings'              => 'ju_instagram_handle',
// 			'type'                  =>  'text'
// 		)
// 	));

// 	$wp_customize->add_control(new WP_Customize_Control(
// 		$wp_customize,
// 		'ju_social_email_input',
// 		array(
// 			'label'                 =>  __( 'Email', 'theme_name' ),
// 			'section'               => 'ju_social_section',
// 			'settings'              => 'ju_email',
// 			'type'                  =>  'text'
// 		)
// 	));

// 	$wp_customize->add_control(new WP_Customize_Control(
// 		$wp_customize,
// 		'ju_social_phone_number_input',
// 		array(
// 			'label'                 =>  __( 'Phone Number', 'theme_name' ),
// 			'section'               => 'ju_social_section',
// 			'settings'              => 'ju_phone_number',
// 			'type'                  =>  'text'
// 		)
// 	));
// }