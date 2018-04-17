<?php
/**
 * Template for radios
 */


get_header(); ?>

<?php
if (have_posts()): while (have_posts()) : the_post();
    $meta = get_post_meta(get_the_ID());
?>
 	<div class="card card-mb">
 		<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
 			<?php the_post_thumbnail('full', [
 				'class' => 'card-img-top',
 			]); ?>
 		<?php endif; ?>
 		<div class="card-body">
 			<main role="main">

 				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

 					<h1 class="post-title"><?php the_title(); ?></h1>

                    <?php echo wp_audio_shortcode([
                        src => $meta['radio-main-stream'][0],
                        autoplay => true,
                        preload => 'auto'
                    ]); ?>

                    <div id="radios-meta">
                        <div class="radios-description">
                            <h2>Description</h2>
                            <?php the_content(); ?>
                        </div>
                        <div class="radios-informations">
                            <h2>Informations</h2>

                            <ul class="list-unstyled">
                                <?php if (!empty($meta['radio-website'][0])): ?>
                                    <li><i class="fa fa-globe"></i> <b>Site web :</b>
                                        <span><?php echo '<a href="'.esc_url($meta['radio-website'][0]).'" title="'.get_the_title().'" target="_blank">'.esc_url($meta['radio-website'][0]).'</a>'; ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($meta['radio-facebook'][0])): ?>
                                    <li><i class="fa fa-facebook-square"></i> <b>Facebook :</b>
                                        <span><?php echo '<a href="'.esc_url($meta['radio-facebook'][0]).'" title="'.get_the_title().'" target="_blank">'.esc_url($meta['radio-facebook'][0]).'</a>'; ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($meta['radio-facebook'][0])): ?>
                                    <li><i class="fa fa-twitter-square"></i> <b>Twitter :</b>
                                        <span><?php echo '<a href="'.esc_url($meta['radio-twitter'][0]).'" title="'.get_the_title().'" target="_blank">'.esc_url($meta['radio-twitter'][0]).'</a>'; ?></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

					<br class="clear">

 					<?php edit_post_link(null, null, null, null, 'btn btn-sm btn-light'); ?>

 				</article>

 			</main>
 		</div>
 	</div>
 	<?php if (comments_open()): ?>
 		<div class="card card-mb" id="comments-section">
 			<div class="card-body">
 				<?php comments_template('', true); ?>
 			</div>
 		</div>
 	<?php endif; ?>
<?php
endwhile; else:
 	echo '<h1>'. _e( 'Sorry, nothing to display.', 'dez-starter' ) . '</h1>';
endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
