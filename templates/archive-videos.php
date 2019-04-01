<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cpt-videos
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :
		$columns = 3;
		?>

			<header class="page-header">
				<h1 class="page-title"><?php post_type_archive_title() ?></h1>
				<?php
					// the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="columns-<?php echo esc_attr( $columns ); ?>">
				<ul class="videos">

				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<li
					<?php
					$class = array( 'video' );
					if ( 0 === $wp_query->current_post % $columns || 1 === $columns ) {
						$class[] = 'first';
					} else if ( 0 === ( $wp_query->current_post + 1 ) % $columns ) {
						$class[] = 'last';
					}
					post_class( $class );
					?>
					>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'medium' ); ?>
							<h2><?php the_title(); ?></h2>
						</a>
					</li>

					<?php endwhile; ?>

				</ul>
			</div>

			<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'tannebasscorner_sidebar' );
get_footer();
