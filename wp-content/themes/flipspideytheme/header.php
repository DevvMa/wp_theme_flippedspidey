<!DOCTYPE html>
<html <?=language_attributes()?>>
  <head>
    <meta charset="<?=bloginfo('charset')?>"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
  </head>
  <body <?=body_class()?>>
    <header class="site-header">
    <div class="container">
      <h1 class="school-logo-text float-left"><a href="<?=site_url()?>"><strong>Flipped Spidey</strong> University</a></h1>
      <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <ul class="min-list group">
            <li class="<?=(is_page('about-us') or wp_get_post_parent_id(0) == 31 )?"current-menu-item":""?>"><a href="<?=site_url('/about-us')?>">About Us</a></li>
            <li class="<?=get_post_type() == 'program'?"current-menu-item":""?>"><a href="<?=get_post_type_archive_link('program')?>">Programs</a></li>
            <li class="<?=(get_post_type() == 'event' || is_page('past-events'))?"current-menu-item":""?>"><a href="<?=get_post_type_archive_link('event')?>">Events</a></li>
            <li class="<?=(get_post_type() == 'campus')?"current-menu-item":""?>"><a href="<?=get_post_type_archive_link('campus')?>">Campuses</a></li>
            <li class="<?=(get_post_type() == 'post')?"current-menu-item":""?>"><a href="<?=site_url('/blog')?>">Blog</a></li>
          </ul>
        </nav>
        <div class="site-header__util">
          <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
          <a href="#" class="btn btn--small  btn--dark-orange float-left">Sign Up</a>
          <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
      </div>
    </div>
  </header>
