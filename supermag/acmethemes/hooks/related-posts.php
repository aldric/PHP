<?php
/**
 * Display related posts from same category
 *
 * @since supermag 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('supermag_related_post_below') ) :

    function supermag_related_post_below( $post_id ) {

        global $supermag_customizer_all_values;
        if( 0 == $supermag_customizer_all_values['supermag-show-related'] ){
            return;
        }
        $categories = get_the_category( $post_id );
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }
            ?>
            <h2 class="widget-title">
                <?php _e('Related posts', 'supermag'); ?>
            </h2>
            <ul class="featured-entries-col featured-entries featured-col-posts featured-related-posts">
                <?php
                $supermag_cat_post_args = array(
                    'category__in' => $category_ids,
                    'post__not_in' => array($post_id),
                    'post_type' => 'post',
                    'posts_per_page'      => 3,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true
                );
                $supermag_featured_query = new WP_Query($supermag_cat_post_args);

                while ( $supermag_featured_query->have_posts() ) : $supermag_featured_query->the_post();
                    $supermag_sidebar_no_thumbnail = 'no-image-500-280.png';
                    ?>
                    <li class="acme-col-3">
                        <figure class="widget-image">
                            <?php
                            if ( has_post_thumbnail() ):
                                $post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                            else:
                                $post_thumb[0] = get_template_directory_uri() . '/assets/img/'.$supermag_sidebar_no_thumbnail;
                            endif;
                            ?>
                            <a href="<?php the_permalink()?>">
                                <img src="<?php echo esc_url( $post_thumb[0] ); ?>" alt="<?php esc_attr( the_title_attribute() ); ?>" title="<?php esc_attr(the_title_attribute()); ?>" />
                            </a>
                        </figure>
                        <div class="featured-desc">
                            <div class="above-entry-meta">
                                <?php
                                $archive_year  = get_the_date('Y');
                                $archive_month = get_the_date('m');
                                $archive_day   = get_the_date('d');
                                ?>
                                <span>
                                    <a href="<?php echo esc_url(get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
                                        <i class="fa fa-calendar"></i>
                                        <?php echo esc_html( get_the_date('F d, Y') ); ?>
                                    </a>
                                </span>
                                <span>
                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>">
                                        <i class="fa fa-user"></i>
                                        <?php echo esc_html( get_the_author() ); ?>
                                    </a>
                                </span>
                                <span>
                                    <?php comments_popup_link( '<i class="fa fa-comment"></i>0', '<i class="fa fa-comment"></i>1', '<i class="fa fa-comment"></i>%' );?>
                                </span>
                            </div>
                            <a href="<?php the_permalink()?>">
                                <h4 class="title">
                                    <?php the_title(); ?>
                                </h4>
                            </a>
                            <?php
                            $content = supermag_words_count( get_the_excerpt() );
                            echo '<div class="details">'. esc_html( $content ).'</div>';
                            ?>
                            <div class="below-entry-meta">
                                <?php supermag_list_category(); ?>
                            </div>
                        </div>
                    </li>
                    <?php
                endwhile;
                wp_reset_query();
                ?>
            </ul>
            <div class="clearfix"></div>
            <?php
        }
    }

endif;

add_action( 'supermag_related_posts', 'supermag_related_post_below', 10, 1 );