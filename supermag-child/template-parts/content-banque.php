<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AcmeThemes
 * @subpackage Supermag
 */
global $supermag_customizer_all_values;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    $isTop = get_the_ID() == 41 ? 'brilliant' : '';
    ?>
    <div class='package <?php echo $isTop; ?>'>
        <div class='name'>
            <header class="entry-header">
                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                <?php if ( 'post' === get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php supermag_posted_on(); ?>
                </div><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->
        </div>

        <!--post thumbnal options-->
        <div>
            <?php
            if( has_post_thumbnail() ):
                $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
            else:
                $image_url[0] = get_template_directory_uri().'/assets/img/no-image-500-280.png';
            endif;
            ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
            </a>
        </div><!-- .post-thumb-->

        <hr />
        <ul>
            <li>
                <strong>2</strong>
                Cartes de cr&eacute;dit
            </li>
            <li>
                <strong>6</strong>
                Alertes automatiques
            </li>
            <li>
                <strong>Unlimited</strong>
                d&eacute;couvert
            </li>

        </ul>
        <hr />
        <div>
            <button type="button" class="btn btn-default btn-lg btn-warning">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                <a href="<?php the_permalink(); ?> ">
                    <?php _e('D&eacute;tails', 'supermag'); ?>
                </a>
            </button>
            <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'supermag' ),
                'after'  => '</div>',
            ) );
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php supermag_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    </div>
</article><!-- #post-## -->
