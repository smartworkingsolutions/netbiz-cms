<?php
/**
 * The ACF template part for displaying Glossary posts
 *
 * @package Netbiz
 */

$heading = get_field( 'glossary_heading', 'option' );
$desc    = get_field( 'glossary_description', 'option' );
?>

<section class="glossary my-16">
	<div class="container">

		<?php
		if ( $heading ) {
			echo '<h2 class="text-4.5xl font-bold mb-8 leading-none sm:leading-normal">' . wp_kses_post( $heading ) . '</h2>';
		}
		if ( $desc ) {
			echo '<p>' . wp_kses_post( $desc ) . '</p>';
		}
		?>

		<div class="grid grid-cols-1 lg:grid-cols-2 items-start gap-10 mt-14">

		<!-- left -->
		<div class="accordion grid grid-cols-1 gap-10">
			<?php
			foreach ( range( 'A', 'M' ) as $letter ) {
				get_post_by_letter( $letter );
			}
			?>
		</div>

		<!-- right -->
		<div class="accordion grid grid-cols-1 gap-10">
			<?php
			foreach ( range( 'N', 'Z' ) as $letter ) {
				get_post_by_letter( $letter );
			}
			?>
		</div>

		</div>

	</div>
</section>
