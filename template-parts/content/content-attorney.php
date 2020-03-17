<?php
/**
 * Content created from the attorney
 */
?>
<article id="post<?php the_ID(); ?>" <?php post_class(); ?>>
 
    <div id="entry-content">
        <?php
        $meta = get_post_meta( get_the_ID(), '', true );
        ?>

        <div><?php capezzahill_all_the_meta( $meta ); ?></div>
    </div>
    <footer class="entry-footer">
        <?php capezzahill_entry_footer(); ?>
    </footer>

</article>