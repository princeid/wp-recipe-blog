<?php

function r_activate_plugin() {
    // e.g: 5.8 < 5.0
    if( version_compare( get_bloginfo('version'), '5.0', '<' ) ){
        wp_die( __( "You must update wordpress to use this plugin.", 'recipe' ) ); //__ means  text domain
    }

    recipe_init();
    flush_rewrite_rules();

    global $wpdb;
    $createSQL                                  =   "CREATE TABLE `" . $wpdb->prefix . "recipe_ratings` (
        `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `recipe_id` bigint(20) unsigned NOT NULL,
        `rating` float(3,2) unsigned NOT NULL,
        `user_ip` varchar(50) NOT NULL
        ) ENGINE=InnoDB " . $wpdb->get_charset_collate() . ";";

    
    require( ABSPATH . "/wp-admin/includes/upgrade.php" );
    dbDelta( $createSQL ); // used for executiing queries that modify the database

    // Scheduling our cron job
    // "r_daily_recipe_hook" is a custom hook
    wp_schedule_event( time(), 'daily', 'r_daily_recipe_hook' );

    // Using the options API
    $recipe_opts                                =   get_option( 'r_opts' );     

    // 1 means No, 2 means Yes
    if( !$recipe_opts ){
        $opts                                   =   [
            'rating_login_required'             =>  1,
            'recipe_submission_login_required'  =>  1
        ];

        add_option( 'r_opts', $opts );
    }

    global $wp_roles;
    add_role(
        'recipe_author',
        __( 'Recipe Author', 'recipe' ),
        [
            'read'                              =>  true,
            'edit_posts'                        =>  true,
            'upload_files'                      =>  true
        ]
    );

}