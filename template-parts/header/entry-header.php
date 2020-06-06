<?php
/**
 * Displays the post header
 */

$discussion = ! is_page() && capezzahill_can_show_post_thumbnail() ? capezzahill_get_discussion_data() : null ?>

<?php the_title( '<h1 class="entry-title all-caps after">', '</h1>' ); ?>

<?php if ( ! is_page() ) : ?>
<div class="entry-meta">
    <?php capezzahill_posted_by(); ?>
    <?php capezzahill_posted_on(); ?>
    <span class="comment-count">
        <?php
        if ( ! empty ( $discusion ) ) {
            capezzahill_discussion_avatars_list( $discussion->authors );
        }
        ?>
        <?php capezzahill_comment_count(); ?>
    </span>
    <?php
    // Edit post link.
        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Post title. Only visible to screen readers. */
                    __( 'Edit <span class="screen-reader-text"></span>', 'capezzahill'),
                    array(
                        'span'  =>  array(
                            'class' =>  array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<span class="edit-link">' . capezzahill_get_icon_svg( 'edit', 16 ),
            '</span>'
        );
    ?>
</div><!-- .entry-meta -->
<?php endif; ?>