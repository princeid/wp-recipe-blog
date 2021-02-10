<?php

function pd_widgets(){
     register_sidebar([
        'name'                =>    __( 'My Theme SideBar', 'mytheme' ),
        'id'                  =>    'pd_sidebar',
        'description'         =>    __( 'Sidebar for the theme Mytheme', 'mytheme' ),
        'before_widget'       =>    '<div id="%1$s" class="widget cleafix %2$s">',
        'after_widget'        =>    '</div>',
        'before_title'        =>    '<h4>',
        'after_title'         =>    '</h4>'    
     ]);
}