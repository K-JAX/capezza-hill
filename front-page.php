<?php get_header(); ?>

<div id="primary" class="content-area mt-0 pt-0">
    <main id="main" class="site-main">

    <section class="announcement-title-banner">
        <h2 class="formal light">Trusted Counsel - Tested Advocates</h2>
        <hr class="shorter blue mb-3">
    </section>

        <!-- <?php 
        $args = array(
                    'post_type' => 'page',
                    'order' => 'ASC',
                    'orderby' => 'menu_order',
                    'meta_query' => array(
                            array(
                                'key' => 'capezzahill_featured_page',
                                'value' => '1'
                            )
                        )
                );
        
        $page_query = new WP_Query($args);?>
        
        <?php while ($page_query->have_posts()) : $page_query->the_post(); 
            $linkText = get_post_meta(get_the_ID(), 'capezzahill_feature_link_text', true) !== '' ? get_post_meta(get_the_ID(), 'capezzahill_feature_link_text', true) : 'See more';
            $count++; 
        ?> 
        
            <section class="page-section-link split-section half-height <?php echo $count == 1 ? 'white-txt lightblue-bg' : 'darkgray-txt white-bg' ?> overtint" style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-size: cover; background-position: center;">
                <div class="feature-text inner-contain">
                    <h3 class="h2"><?php the_title(); ?></h3>
                    <hr class="short <?php echo $count == 1 ? 'white' : 'black'; ?> ml-0">
                    <p><?php the_excerpt(); ?></p>
                    <a <?php echo $count == 1 ? 'class="lightlink-txt"' : ''; ?> href="<?php echo get_permalink(); ?>"><?php echo $linkText; ?> <?php echo capezzahill_get_icon_svg('chevron_right', 26); ?></a>
                </div>
            </section>
        
        <?php endwhile;
        wp_reset_query();
        ?> -->

        <?php 
        if( have_rows('featured_page_controls') ): ?>
        <section class="feature-page-links duo-split">

        <?php while( have_rows('featured_page_controls') ): the_row();
                $postObj = get_sub_field('featured_post_type_object');
                $title  = $postObj ?  get_the_title($postObj->ID) : 'nothin';
                $thumb = $postObj ? get_the_post_thumbnail_url( $postObj->ID ) : the_post_thumbnail_url();
                $description = $postObj ? get_the_excerpt($postObj->ID) : 'nothin';
                $linkText = get_post_meta($postObj->ID, 'capezzahill_feature_link_text', true) !== '' ? get_post_meta($postObj->ID, 'capezzahill_feature_link_text', true) : 'See more';
                $linkColor = get_sub_field('link_color') ? get_sub_field('link_color') : '#0077B6';
            ?>
            <section class="page-section-link split-section half-height overtint" style="background-image: url(<?php echo $thumb; ?>); background-color:<?php echo the_sub_field('background_color'); ?>; background-size: cover; background-position: center; color: <?php echo the_sub_field('foreground_color'); ?>;">
                <div class="inner-contain">
                <?php
                    if(get_sub_field( 'has_archive_posts' ) == 'post' ){ 
                        $archive = get_sub_field('archive_name') ? get_sub_field('archive_name') : 'shabowza';
                        $subLinks = get_posts([
                            'post_type'     =>  $archive,
                            'post_status'   =>  'publish',
                            'numberposts'   =>  -1
                        ]);
                        function displaySubz($subz, $linkColor) {
                            foreach($subz as $subLink){
                                    $output .= '<li><a href="' . get_permalink($subLink->ID) . '" style="color: ' . $linkColor . ';" alt=" ' . $subLink->post_excerpt . '" >' . capezzahill_get_icon_svg('person', 22) . ' ' . $subLink->post_title . '</a></li>';
                            }
                            return $output;
                        }
                        $link = $postObj ? 
                            '<nav class="feature-page-subnav">
                                <a href="' . get_permalink( $postObj->ID ) .'" style="color: ' . $linkColor . ';" >' . $linkText . ' ' . capezzahill_get_icon_svg('chevron_right', 26) . '</a>
                                <ul class="subnav">' . 
                                displaySubz($subLinks, $linkColor)
                                 . 
                                '</ul>
                            </nav>
                            '
                            : 'no-link';
                    } else{
                        $link = $postObj ? 
                            '<a href="' . get_permalink( $postObj->ID ) . '" style="color: ' . $linkColor . ';" >' . $linkText . ' ' . capezzahill_get_icon_svg('chevron_right', 26) . '</a>'
                            : 'no-link';
                    }
                ?>
                
                <h3><?php echo $title; ?></h3>
                <hr class="short white ml-0" />
                <p><?php echo $description; ?></p>
                <!-- <a style="color: <?php echo $linkColor; ?>" href="<?php echo $link; ?>"><?php echo $linkText; ?> <?php echo capezzahill_get_icon_svg('chevron_right', 26); ?></a> -->
                <?php echo _e($link); ?>
                </div>
            </section>
            
        <?php endwhile; ?> 
        </section> 

        <?php endif; ?>
        

    <section class="posts-section mt-0">
        <section class="announcement-title-banner lightergray-bg mt-0">
            <h2 class="darkgray-txt light all-caps spaced my-1">Recent cases</h2>
        </section>
        <section class="duo-split">

        <?php
            global $post;
            $args = array('post_type' => 'post', 'posts_per_page' => 2);
            $posts_array = get_posts( $args );
            $count = 0;
            foreach( $posts_array as $post ) : setup_postdata( $post ); 
            $count++; ?>
    
                <section class="feature-case split-section py-3">
                    <figure class="case-figure  relative before after inner-contain">
                        <a href="<?php echo the_permalink(); ?>">
                            <?php echo has_post_thumbnail() ? the_post_thumbnail('medium') : '<img src="' . get_template_directory_uri() . '/assets/images/case-placeholder-image.jpg" />' ?>
                        </a>
                        <figcaption>
                            <a href="<?php echo the_permalink(); ?>" class='rst hover-underline darkgray-txt'>
                                <p><?php the_title(); ?></p>
                            </a>
                        </figcaption>
                    </figure>
                </section>
            <?php endforeach;
                wp_reset_postdata();
            ?>
        </section>
    </section>
    
    </main><!-- #main -->
</div>

<?php get_footer(); ?>