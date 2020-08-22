<?php
/**
 * Content created from the attorney
 */
?>
<article id="post<?php the_ID(); ?>" <?php post_class(); ?>>
 
    <div id="entry-content" class="relative py-3">
    <?php 
        // $meta_loop = array(
        //     'about'      => get_field('about_fields'),
        //     'services'   => get_field('services_fields'),
        //     'industries' => get_field('industries_fields'),
        //     'education'  => get_field('education_fields')
        // );
        // foreach($meta_loop as $item){
        //     $count++;
        //     $defaultActive = $count == 1 ? 'active' : '';
        //     $target = strtolower(str_replace( ' ', '-', $item['title'] ));
        //     echo _('<div id="'. $target .'" class="bio-description-section relative ' . $defaultActive . '"><h2 class="h3">' . $item['title'] . '</h2><hr class="shorter blue left" /><div class="my-3">'. $item['description'] .'</div></div>');
        // }
    ?>

    <?php 
        if (have_rows('bio_repeater')): while (have_rows('bio_repeater')): the_row();
            $count++;
            $defaultActive = $count == 1 ? 'active' : '';
            $id =strtolower(str_replace(' ', '-', get_sub_field('bio_title')));
    ?>

    <!-- echo _('<div id="'. $target .'" class="bio-description-section relative ' . $defaultActive . '"><h2 class="h3">' . $item['title'] . '</h2><hr class="shorter blue left" /><div class="my-3">'. $item['description'] .'</div></div>');     -->

    <div id="<?php echo $id; ?>" class="bio-description-section relative <?php echo $defaultActive; ?>" >

        <h2 class="h3"><?php echo get_sub_field('bio_title'); ?></h2>
        <hr class="shorter blue left" />
        <div class="my-3"><?php echo get_sub_field('bio_description'); ?></div>
            
    </div>

    <?php endwhile; endif; ?>
    
    </div>
    <footer class="entry-footer">
        <?php capezzahill_entry_footer(); ?>
    </footer>

</article>