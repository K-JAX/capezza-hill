<?php
/**
 * Displays the sidebar on contact page
 */
?>
<div class="sidebar pb-3">
    <h2 class="title-banner text-center">Spotlight</h2>
    <?php 
    $args = array(
        'posts_per_page'    => 3
    );
    query_posts( $args );
    if ( have_posts() ) : ?>
    <ul class="featured-posts mt-3 px-3 list-none">
        <?php while( have_posts() ): the_post(); ?>
        <li class="h6 my-4 after bold"><a class="informal rst hover-underline lightblue-txt" href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></li>
        <?php endwhile; ?>
    </ul>
    <?php endif; ?>
</div>