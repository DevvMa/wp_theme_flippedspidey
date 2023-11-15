<?php

function custom_post_types(){
    register_post_type('event',array(
        'supports' => array('title','editor', 'excerpt'),
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event',
        ),
        'menu_icon' => 'dashicons-calendar'
    ));

    register_post_type('program',array(
        'rewrite' => array('slug' => 'Programs'),
        'has_archive' => true,
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program',
        ),
        'menu_icon' => 'dashicons-awards'
    ));

    register_post_type('professor',array(
        'supports' =>  array('title','editor','thumbnail'),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Professor',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professor',
            'singular_name' => 'Professor',
        ),
        'menu_icon' => 'dashicons-welcome-learn-more'
    ));

    register_post_type('campus',array(
        'supports' =>  array('title','editor','thumbnail'),
        'rewrite' => array('slug' => 'campuses'),
        'has_archive' => true,
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Campuses',
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus',
            'view_item' => 'View Campus',
        ),
        'menu_icon' => 'dashicons-location-alt'
    ));
}

add_action('init', 'custom_post_types');

function change_title_placeholder( $title_placeholder , $post ){
    if ( $post->post_type == 'professor' ) {
        $title_placeholder = 'Enter Professor Name';
    } else if($post->post_type == 'program'){
        $title_placeholder = 'Enter Program Name';
    } else if($post->post_type == 'event'){
        $title_placeholder = 'Enter Event Name';
    } else if($post->post_type == 'campus'){
        $title_placeholder = 'Enter Campus Name';
    }
    return $title_placeholder;
}
add_filter( 'enter_title_here', 'change_title_placeholder', 20, 2 );


add_filter( 'manage_event_posts_columns', 'event_filter_posts_columns' );
function event_filter_posts_columns( $columns ) {
    $columns = array(
        'cb' => $columns['cb'],
        'title' => __( 'Title' ),
        'event_date' => __( 'Event Date' ),
        'date' => __( 'Date Published' )
    );
    return $columns;
}

add_filter( 'manage_program_posts_columns', 'program_filter_posts_columns' );
function program_filter_posts_columns( $columns ) {
    $columns = array(
        'cb' => $columns['cb'],
        'title' => __( 'Title' ),
        'post_content' => __( 'Description' ),
        'date' => __( 'Date Published' )
    );
    return $columns;
}


add_action( 'manage_event_posts_custom_column', 'events_event_column', 10, 2);

function events_event_column( $column, $post_id ) {
    // if ( 'event_date' === $column ) {
        $event_date = get_post_meta( $post_id, 'event_date', true );
    
        if ( ! $event_date ) {
          _e( 'n/a' );  
        } else {
            $event_date = new DateTime($event_date);
            echo $event_date->format('d F Y');
        }
    // }
}

add_action( 'manage_program_posts_custom_column', 'programs_program_column', 10);

function programs_program_column() {
    echo the_content();;
}

add_filter( 'manage_edit-event_sortable_columns', 'events_event_sortable_columns');
function events_event_sortable_columns( $columns ) {
  $columns['event_date'] = 'event_date';
  return $columns;
}
  

?>