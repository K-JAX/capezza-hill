<?php
/**
 * The template for displaying attorney content
 */

 get_header('attorney');
 ?>
    <section id="primary" class="content-area container with-sidebar left pt-0 lightergray-bg">
        <main id="main" class="site-main py-3 mb-5"  data-aos="fade-right" data-aos-duration="500" >
            <div class="mx-3">
            <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                    get_template_part('template-parts/content/content', 'attorney');

                endwhile; // End of the loop.
            ?>
            </div>

        </main><!-- #main -->
        <aside class="sidebar-container"  data-aos="fade-left" data-aos-duration="500" >
            <ul class="bio-list">
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
                    //     echo '<li class="after ' . $defaultActive . '"><h2 class="h3"><a class="bio-button rst block" href="javascript:void(0)" data-target="'. $target .'">' . $item['title'] . '</a></h2></li>';
                    // }
                ?>
                <?php 
                    $count = 0;
                    if (have_rows('bio_repeater')): while (have_rows('bio_repeater')): the_row();
                    $count++; 
                    $defaultActive = $count == 1 ? 'active' : '';
                    $id =strtolower(str_replace(' ', '-', get_sub_field('bio_title')));
                ?>

                <li class="after <?php echo $defaultActive; ?>" >
                    <h2 class="h3">
                        <a class="bio-button rst block" href="javascript:void(0)" data-target="<?php echo $id; ?>"><?php echo get_sub_field('bio_title'); ?></a>
                    </h2>
                </li>
                <?php endwhile; endif; ?>

            </ul>

            <select name="bio-description-select" id="" class="bio-list-dropdown no-print"  >
            <?php 
                    if (have_rows('bio_repeater')): while (have_rows('bio_repeater')): the_row();
                    $count++; 
                    $defaultActive = $count == 1 ? 'active' : '';
                    $id =strtolower(str_replace(' ', '-', get_sub_field('bio_title')));
                ?>
                
                    <option value="<?php echo $id; ?>"><?php echo get_sub_field('bio_title'); ?></option>

                <?php endwhile; endif; ?>
            </select>
            
        </aside>
    </section><!-- #primary -->

<?php
get_footer();