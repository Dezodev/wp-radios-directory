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

                    <audio class="plyr-simple-radio" src="<?php echo esc_url($meta['radio-main-stream'][0]) ?>" controls preload> </audio>

                    <h2>Description</h2>

 					<?php the_content(); ?>

                    <h2>Informations</h2>

                    <p>
                        <b>Site web :</b>
                        <span><?php echo '<a href="'.esc_url($meta['radio-website'][0]).'" title="'.get_the_title().'" target="_blank">'.esc_url($meta['radio-website'][0]).'</a>'; ?></span>
                    </p>

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
