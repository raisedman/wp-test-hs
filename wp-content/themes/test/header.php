<!doctype html>
<html lang="<?php language_attributes(); ?>">
<head>
  <!--  wp_enqueue_scripts
    wp_enqueue_style
    wp_enqueue_script
    get_stylesheet_uri()
    get_header()
    get_footer()
    wp_head()
    wp_footer()
    language_attributes()
    bloginfio('charset')
    bloginfo('name')
    register_nav_menu()
    wp_nav_menu([
    'theme_location'=>top
    'container'=>null
    ])-->
    <title>Главная</title>
    <meta charset="<?php bloginfo('charset')?>">
    <meta name="viewport" content="width=device-width">
    <?php wp_head();?>
</head>
<body>


<?php dynamic_sidebar('accordeon_top');?>


<div  class="wrapper">
    <div  class="content-wrapper clearfix">
        <header>
            <div class="header-top clearfix">
                <a href="<?php echo home_url(); ?>" class="logo"><?php bloginfo('name')?></a>
                <nav>
                    <div class="menu-button">MENU</div>
                    <?php wp_nav_menu([
                        'theme_location'=>'top',
                        'container'=>null
                    ]);
                    ?>
                </nav>
            </div>

            <?php if(is_active_sidebar('bottom_sidebar')): ?>
            <div  class="header-bottom">
                <?php dynamic_sidebar('bottom_sidebar');?>
            </div>
            <?php endif; ?>
        </header>
