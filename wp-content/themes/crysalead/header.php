<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!-- <title><?php the_title(); ?></title> -->
        <title>Crysalead</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/reset.css" type="text/css">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">

        <!--
            /* @license
             * MyFonts Webfont Build ID 2527495, 2013-04-11T05:59:18-0400
             * 
             * The fonts listed in this notice are subject to the End User License
             * Agreement(s) entered into by the website owner. All other parties are 
             * explicitly restricted from using the Licensed Webfonts(s).
             * 
             * You may obtain a valid license at the URLs below.
             * 
             * Webfont: Bauer Bodoni Italic by Bitstream
             * URL: http://www.myfonts.com/fonts/bitstream/bauer-bodoni/italic/
             * Copyright: Copyright 1990-2003 Bitstream Inc. All rights reserved.
             * 
             * Webfont: Trend Sans One by Latinotype
             * URL: http://www.myfonts.com/fonts/latinotype/trend/sans-one/
             * Copyright: Copyright (c) 2012 by Daniel Hernandez &amp; Paula nazal. All rights
             * reserved.
             * 
             * 
             * License: http://www.myfonts.com/viewlicense?type=web&buildid=2527495
             * 
             * © 2013 MyFonts Inc
            */

        -->
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/font/MyFontsWebfontsKit.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <header class="page">

            <div id="site-title-wrapper">
                <div>
                    <h3>Crysalead</h3>
                    <?php
                        $args = array( 'post_type' => 'homepagecontent', 'orderby' => 'date', 'order' => 'ASC','posts_per_page' => 1);
                        $home = new WP_Query( $args );
                        while ( $home->have_posts() ) : $home->the_post(); ?>
                            <h1><?php the_title(); ?></h1>
                            <h2><?php echo get_post_meta($post->ID, 'homepagesubtitle', true); ?></h2>
                            <?php
                            break;
                        endwhile;
                    ?>
                </div>
            </div>

            <div id="cover"></div>
            
            <div id="petals-canvas">
                <div class="flying-elt"></div>
                <div class="flying-elt"></div>
                <div class="flying-elt"></div>
                <div class="flying-elt"></div>
                <div class="flying-elt"></div>
                <div class="flying-elt"></div>
                <div class="flying-elt"></div>
                <div class="flying-elt"></div>
            </div>

            <nav id="menu">
                <ul>
                    <li><a href="#office">Le cabinet</a></li>
                    <li><a href="#accompaniment">Notre accompagnement</a></li>
                    <li><a href="#whoareus">Qui sommes-nous ?</a></li>
                    <li><a href="#co-workers">Les collaborateurs</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </header>
<!-- Fin header -->