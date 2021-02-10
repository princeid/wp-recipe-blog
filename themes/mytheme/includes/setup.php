<?php

function pd_setup_theme(){
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'starter-content', [
        // Place the core-defined widget in the sidebar area
        'widgets'                       =>  [
            'pd_sidebar'                =>  [
                'text_business_info', 'search', 'text_about',
            ]
        ],

        // Create the custom image attachments used as post thumbnails for pages.
        'attachments'                   =>  [
            'image-about'               =>  [
                'post_title'            =>  __( 'About', 'mytheme' ),
                'file'                  =>  'assets/images/about/1.jpg', // URL relative to the template directory
            ]
        ],

        // Specify the core-defined pages to create and add custom thumbnails to some of them.
        'posts'                         =>  [
            'home'                      =>  [
                'thumbnail'             =>  '{{image-about}}',
            ],
            'about'                     =>  [
                'thumbnail'             =>  '{{image-about}}',
            ],
            'contact'                   =>  [
                'thumbnail'             =>  '{{image-about}}',
            ],
            'blog'                      =>  [
                'thumbnail'             =>  '{{image-about}}',
            ],
            'homepage-section'          =>  [
                'thumbnail'             =>  '{{image-about}}',
            ],
        ],

        // Default to a static front page and assign the front and posts pages
        'options'                       =>  [
            'show_on_front'             =>  'page',
            'page_on_front'             =>  '{{home}}',
            'page_for_posts'            =>  '{{blog}}',
        ],

        // Set the front page section theme mods to the IDs of the core-registered pages.
        'theme_mods'                    =>  [
            'pd_facebook_handle'        =>  'mytheme',
            'pd_twitter_handle'         =>  'mytheme',
            'pd_instagram_handle'       =>  'mytheme',
            'pd_email'                  =>  'mytheme',
            'pd_phone_number'           =>  'mytheme',
            'pd_header_show_search'     =>  'yes',
            'pd_header_show_cart'       =>  'yes',
        ],

        // Set up nav menus for each of the two areas registered in the theme.
        'nav_menus'                     =>  [
            //Assign a menu to the "top" location
            'primary'                   =>  [
                'name'                  =>  __( 'Primary Menu', 'mytheme' ),
                'items'                 =>  [
                    'link_home', // Link to the home page. Note that the core home page is actually a link in case a static front page is not used.
                    'page_about',
                    'page_blog',
                    'page_contact',
                ]
            ],

            //Assign a menu to the "social" location
            'secondary'                   =>  [
                'name'                  =>  __( 'Secondary Menu', 'mytheme' ),
                'items'                 =>  [
                    'link_home', // Link to the home page. Note that the core home page is actually a link in case a static front page is not used.
                    'page_about',
                    'page_blog',
                    'page_contact',
                ]
            ]
        ]

    ]);


    register_nav_menu( 'primary', __( 'Primary Menu', 'mytheme' ) );
    register_nav_menu( 'secondary', __( 'Secondary Menu', 'mytheme' ) );

// Incomplete. WP QUADS Plugin threw an error "Please disable your browser AdBlocker to resolve problems with WP QUADS ad setup"
    if (function_exists( 'quads_register_ad' )){
        quads_register_ad(array(
            'location' => 'mytheme_header', 
            'description' => 'My Theme Header position'
        ));
    }
}