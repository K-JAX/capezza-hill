<?php get_header(); ?>

<div id="primary" class="content-area mt-0 pt-0">
    <main id="main" class="site-main">

    <section class="announcement-title-banner">
        <h2 class="formal light">Trusted Counsel - Tested Advocates</h2>
        <hr class="shorter blue mb-3">
    </section>

    <section class="feature-page-links duo-split">
        <?php 
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
            $count++ 
        ?> 
        
            <section class="page-section-link <?php echo $count == 1 ? 'white-txt lightblue-bg' : 'darkgray-txt white-bg' ?> overtint" style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-size: cover;">
                <h3 class="h2"><?php the_title(); ?></h3>
                <hr class="short <?php echo $count == 1 ? 'white' : 'black'; ?> ml-0">
                <p><?php the_excerpt(); ?></p>
                <a <?php echo $count == 1 ? 'class="lightlink-txt"' : ''; ?> href="<?php echo get_permalink(); ?>"><?php echo $linkText; ?> <?php echo capezzahill_get_icon_svg('chevron_right', 26); ?></a>
            </section>
        
        <?php endwhile;
        wp_reset_query();
        ?>
    </section> 

    <section class="posts-section mt-0">
        <section class="announcement-title-banner lightergray-bg mt-0" style="display: inline-block;">
            <h2 class="darkgray-txt light all-caps spaced my-1">Recent cases</h2>
        </section>
        <section class="duo-split">

        <?php
            global $post;
            $args = array('post_type' => 'post', 'posts_per_page' => 2);
            $posts_array = get_posts( $args );

            foreach( $posts_array as $post ) : setup_postdata( $post ); ?>

                <section class="feature-case py-3">
                    <figure class="case-figure beforeafter">
                        <a href="<?php echo the_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url( ); ?>" alt=""></a>
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