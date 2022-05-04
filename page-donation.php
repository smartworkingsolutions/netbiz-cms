<?php
/**
 * Template Name: Donation Page
 * The template for displaying donation.
 *
 * @package Netbiz
 */

get_header();
?>

<section class="donation bg-neutral-500 h-[700px] relative">
	<?php
	if ( has_post_thumbnail() ) {
		$thumbnail_id = get_post_thumbnail_id( get_the_id() );
		$image        = df_resize( $thumbnail_id, '', 1920, 700, true, true );

		$thumbnail = printf(
			'<div class="w-full">
				<img class="w-full h-[700px] object-cover" src="%s" alt="%s">
			</div>',
			esc_url( $image['url'] ),
			get_the_title() // phpcs:ignore
		);
	}
	?>
	<div class="container">
		<div class="w-[90%] sm:w-[400px] absolute top-1/2 -translate-y-1/2">

			<ul id="tabs" class="flex">
				<li class="w-full h-16 bg-white cursor-pointer relative active">
					<a class="w-full absolute inset-0 grid place-content-center" href="#one" id="default-tab">One-off</a>
				</li>
				<li class="w-full h-16 bg-white cursor-pointer relative">
					<a class="w-full absolute inset-0 grid place-content-center" href="#monthly">Monthly</a>
				</li>
			</ul>

			<div id="tab-contents" class="bg-theme-color text-dark-section-text p-10">
				<!-- Tab content 1 -->
				<div id="one">
					<form action="index.html" class="grid gap-6">
						<div>
							<h3 class="text-xl font-bold mb-2">How much would you like to donate?</h3>
							<div class="flex space-x-4">
								<button class="w-full h-14 bg-dark-color text-white" data-value="10">£10</button>
								<button class="w-full h-14 bg-white text-dark-color hover:bg-dark-color hover:text-white transition-all" data-value="20">£20</button>
								<button class="w-full h-14 bg-white text-dark-color hover:bg-dark-color hover:text-white transition-all" data-value="50">£50</button>
							</div>
						</div>
						<div>
							<p><strong>Or enter your own amount</strong> (min £1):</p>
							<div class="field-group flex mt-1">
								<span class="w-12 font-bold text-dark-color border-r border-neutral-200 bg-neutral-100 grid place-content-center">£</span>
								<input class="border-0 text-dark-color" type="text" placeholder="Enter amount">
							</div>
						</div>
						<div class="field-group flex flex-col gap-2">
							<p class="text-sm">Choose your payment method</p>
							<button class="button button-white h-12" type="submit">Credit/Debit Card</button>
							<!-- <button class="button button-white flex space-x-1" type="submit"><i class="fab fa-paypal"></i><span>PayPal</span></button> -->
							<button class="button button-white group" type="submit">
								<img class="w-full h-6 object-scale-down group-hover:hidden" src="<?php echo get_template_directory_uri() . '/images/paypal-logo.png'; ?>" alt="Paypal">
								<img class="w-full h-6 object-scale-down hidden group-hover:block" src="<?php echo get_template_directory_uri() . '/images/paypal-logo-white.png'; ?>" alt="Paypal">
							</button>
						</div>
					</form>
					<div class="flex justify-around items-center text-4xl mt-6 opacity-40">
						<i class="fab fa-cc-visa"></i>
						<i class="fab fa-cc-mastercard"></i>
						<i class="fab fa-cc-paypal"></i>
						<i class="fab fa-cc-stripe"></i>
					</div>
				</div>
				<!-- Tab content 2 -->
				<div id="monthly" class="hidden">
					<form action="index.html" class="grid gap-6">
						<div>
							<h3 class="text-xl font-bold mb-2">How much would you like to donate?</h3>
							<div class="flex space-x-4">
								<button class="w-full h-14 bg-dark-color text-white" data-value="10">£10</button>
								<button class="w-full h-14 bg-white text-dark-color hover:bg-dark-color hover:text-white transition-all" data-value="5">£5</button>
								<button class="w-full h-14 bg-white text-dark-color hover:bg-dark-color hover:text-white transition-all" data-value="3">£3</button>
							</div>
						</div>
						<div>
							<p><strong>Or enter your own amount:</strong></p>
							<div class="field-group flex mt-1">
								<span class="w-12 font-bold text-dark-color border-r border-neutral-200 bg-neutral-100 grid place-content-center">£</span>
								<input class="border-0 text-dark-color" type="text" placeholder="Enter amount">
							</div>
						</div>
						<div class="field-group flex flex-col gap-2">
							<p class="text-sm">Choose your payment method</p>
							<button class="button button-white h-12" type="submit">Credit/Debit Card</button>
							<button class="button button-white group" type="submit">
								<img class="w-full h-6 object-scale-down group-hover:hidden" src="<?php echo get_template_directory_uri() . '/images/paypal-logo.png'; ?>" alt="Paypal">
								<img class="w-full h-6 object-scale-down hidden group-hover:block" src="<?php echo get_template_directory_uri() . '/images/paypal-logo-white.png'; ?>" alt="Paypal">
							</button>
						</div>
					</form>
					<div class="flex justify-around items-center text-4xl mt-6 opacity-40">
						<i class="fab fa-cc-visa"></i>
						<i class="fab fa-cc-mastercard"></i>
						<i class="fab fa-cc-paypal"></i>
						<i class="fab fa-cc-stripe"></i>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<?php
/**
 * Loop Templates
 */
$acfp = new acf_flexible_content_to_partials( get_the_ID(), 'templates' );
$acfp->render();

get_footer();
