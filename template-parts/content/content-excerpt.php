<?php
/**
 * Template part for displaying post archives and search results
 */

 ?>

 <article id="post-<?php the_ID(); ?>" <?php post_class('my-3'); ?>>
    <header class="entry-header">
        <?php
        if ( is_sticky() && is_home() && ! is_paged() ) {
            printf( '<span class="stick-post">%s</span>', _x( 'Featured', 'post', 'capezzahill' ) );
        }
        the_title( sprintf('<h2 class="entry-title mt-0 mb-1"><a href="%s" class="informal navy-txt" rel="bookmark"><b>', esc_url( get_permalink() ) ), '</b></a></h2>');
        ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_excerpt(); ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php capezzahill_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-${ID} -->