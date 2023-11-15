<?php

function university_custom_callback_rest(){
    register_rest_field('post','authorName', array(
        'get_callback' => function () { return get_the_author();}
    ));
}

add_action('rest_api_init', 'university_custom_callback_rest');

function flippedspidey_enqueue_style() {
    wp_enqueue_script('googleMaps', "//maps.googleapis.com/maps/api/js?key=AIzaSyChz4-LDLOzUGbGaDNnx1wmT24egVlq8pM", NULL, 1.0, true);
    wp_enqueue_style( 'custom_google_font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style( 'font_awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style( 'flippedspidey_style', get_stylesheet_uri());
    wp_enqueue_script('flippedspidey_script', get_theme_file_uri('/js/scripts-bundled.js'), NULL, 1.0, true);
    wp_localize_script('flippedspidey_script', 'universityData', array('root_url'=>get_site_url()));
}

add_action( 'wp_enqueue_scripts', 'flippedspidey_enqueue_style' );

function generate_title_site(){
    register_nav_menu('headernav', 'Header Navigation');
    register_nav_menu('footernav', 'Footer Navigation');
    add_theme_support( 'title-tag');
    add_theme_support( 'post-thumbnails');
    add_image_size('professorLandscape',400,260, true);
    add_image_size('professorPortrait',480,650, true);
    add_image_size('pageBanner',1500,350, true);
}

add_action('after_setup_theme','generate_title_site');

function set_near_event_query($query){
    if(!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()){
        $query->set('posts_per_page', -1);
    }

    if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()){
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }


    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
        $today = date('Ymd');
        $queryParam = array(
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => "ASC",
            'meta_query' => array(
              array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
              )
            )
        );

        foreach($queryParam as $key => $value){
            $query->set($key, $value);
        }
    }
}

add_action('pre_get_posts', 'set_near_event_query');
?>

<?php
function page_banner($args = NULL){
    
    $keys = array('title', 'subtitle', 'photo');
    
    if($args == NULL){
        $args = array('title'=>NULL, 'subtitle' => NULL, 'photo' => NULL);
    } 
    
    foreach($keys as $key){
        !array_key_exists($key, $args)? $args[$key] = NULL:'';
    }

    if(!$args['title']){
        $args['title'] = get_the_title();
    }
    if(!$args['subtitle']){
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if(!$args['photo']){
        if(get_field('page_banner_image')){
            $args['photo'] = get_field('page_banner_image')['sizes']['pageBanner'];
        } else{
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }

    ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?=$args['photo']?>);"></div>
        <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?=$args['title']?></h1>
        <div class="page-banner__intro">
            <p><?=$args['subtitle']?></p>
        </div>
        </div>  
    </div>
    <?php

}

function campusMapKey($api){
    $api['key'] = 'AIzaSyChz4-LDLOzUGbGaDNnx1wmT24egVlq8pM';
    return $api;
}

add_filter('acf/fields/google_map/api', 'campusMapKey');
?>


