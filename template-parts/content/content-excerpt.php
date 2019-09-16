<?php
/**
 * Template part for displaying post archives and search results
 */

 ?>

 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if ( is_sticky() && is_home() && ! is_paged() ) {
            printf( '<span class="stick-post">%s</span>', _x( 'Featured', 'post', 'capezzahill' ) );
        }
        the_title( sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>');
        ?>
    </header><!-- .entry-header -->

    <?php capezzahill_post_thumbnail(); ?>

    <div class="entry-content">
        <?php the_excerpt(); ?>
    </div><!-- .entry-content -->
3
    <footer class="entry-footer">
        <?php capezzahill_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-${ID} -->