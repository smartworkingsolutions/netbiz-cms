<?php
/**
 * The ACF template part for displaying Testimonials review form.
 *
 * @package Netbiz
 */

$heading = get_field( 'cpt_testimonials_heading', 'option' );
$desc    = get_field( 'cpt_testimonials_description', 'option' );

$is_submit = isset( $_GET['updated'] ) ? $_GET['updated'] : ''; // phpcs:ignore

if ( $is_submit ) {
	echo '<p class="w-1/2 mx-auto text-center mt-14">Your testimonial has been submitted and will be published after review.</p>';
}
?>

<div class="video-modal-overlay w-full h-full fixed inset-0 z-20 bg-black/30 hidden"></div>
<div class="video-modal video-modal-review bg-white shadow-md w-11/12 xl:w-2/3 px-10 py-12 fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-[9999px] z-30 transition-all">
	<div class="review-form space-y-6">
		<div class="flex justify-between">
			<?php
			if ( $heading ) {
				echo '<h3 class="text-2xl font-bold">' . esc_html( $heading ) . '</h3>';
			}
			?>
			<button class="close w-7 h-7 text-2xl font-bold">X</button>
		</div>
		<?php
		if ( $desc ) {
			echo '<p>' . esc_html( $desc ) . '</p>';
		}
		?>
		<?php
		acf_form(
			[
				'post_id'      => 'new_post',
				'post_title'   => true,
				'post_content' => true,
				'new_post'     => [
					'post_type'   => 'testimonials',
					'post_status' => 'draft',
				],
				'submit_value' => esc_html__( 'Submit', 'netbiz' ),
			]
		);
		?>
	</div>
</div>
