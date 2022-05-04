<?php
/**
 * All custom actions here.
 *
 * @package Netbiz
 */

defined( 'WPINC' ) || exit;

/**
 * Enquiry form class
 */
Class contactforms_enquiry_form { // phpcs:ignore

	/**
	 * WHO GETS THIS EMAIL? CAN BE COMMA SEPARATED LIST.
	 */
	public function emails() {
		// return "david@netbizgroup.co.uk,arran@netbizgroup.co.uk,sajid@netbizgroup.co.uk";.
		return get_contact_form_emails( 'enquiry_form' );
	}

	/**
	 * DO WE SEND AN AUTO RESPONDER TO THE "FOUND EMAIL"? (LEAVE BLANK TO DISABLE).
	 */
	public function autoresponder() {
		$html = '
			<p>Hi {title} {name},</p>
			<p>Thank you for your enquiry.</p>
			<p>A member of our team will be in touch soon.</p>
		';
		return $html;
	}

	/**
	 * Main form.
	 */
	public function form() {

		// SET UP THE FORM.
		$pb = new contactforms_postback();

		$inner_html = '';

		// KEEP THIS IN - IF THERE IS AN ISSUE WITH MAILCHIMP, IT WILL SHOW A MESSAGE.
		foreach ( $pb->ga( 'errors' ) as $form_error ) {
			$inner_html .= '<p style="color: red;">' . $form_error . '</p>';
		}

		// [SIMPLE TEXT FIELDS - START].
		$inner_html .= '
		<div class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-9 mt-10">

			<div class="form-group flex flex-col">
				<input id="f_name" type="text" name="f_name" placeholder="First Name" required />
			</div>

			<div class="form-group flex flex-col">
				<input id="l_name" type="text" name="l_name" placeholder="Last Name" required />
			</div>

			<div class="form-group flex flex-col">
				<input id="email" type="email" name="email" placeholder="Email address" required />
			</div>

			<div class="form-group flex flex-col">
				<input id="contact_number" type="tel" name="contact_number" placeholder="Contact Number" />
			</div>

		</div>

		<div class="form-group flex flex-col mt-10">
			<textarea name="help_message" cols="30" rows="6" placeholder="Your enquiry" required></textarea>
		</div>
		';

		// [RECAPTCHA - START]
		$inner_html .= '<p class="mt-8">';
		// SIZE CAN BE COMPACT OR NORMAL (SNAPS TO COMPACT - SEE JS - WHEN WINDOW < 800PX WIDE).
		$inner_html .= do_shortcode( "[contactforms_recaptcha size='normal']" );
		$inner_html .= '</p>';
		// [RECAPTCHA - END]

		// THIS CLASS HIDES THE SUBMIT BUTTON UNTIL RECAPTCHA IS COMPLETED (SAVES MISSING IT).
		$inner_html .= "<div class='js-wait-for-recaptcha'>";
		$inner_html .= '
			<div class="flex flex-col items-end mt-10">
				<button type="submit" class="button button-border">Submit</button>
			</div>
		';
		$inner_html .= '</div>';

		return $inner_html;
	}
}

/**
 * Apply form class
 */
Class contactforms_apply_form { // phpcs:ignore

	/**
	 * WHO GETS THIS EMAIL? CAN BE COMMA SEPARATED LIST.
	 */
	public function emails() {
		// return "david@netbizgroup.co.uk,arran@netbizgroup.co.uk,sajid@netbizgroup.co.uk";.
		return get_contact_form_emails( 'apply_form' );
	}

	/**
	 * DO WE SEND AN AUTO RESPONDER TO THE "FOUND EMAIL"? (LEAVE BLANK TO DISABLE).
	 */
	public function autoresponder() {
		$html = '
			<p>Hi {title} {name},</p>
			<p>Thank you for your enquiry.</p>
			<p>A member of our team will be in touch soon.</p>
		';
		return $html;
	}

	/**
	 * Main form.
	 */
	public function form() {

		// SET UP THE FORM.
		$pb = new contactforms_postback();

		$inner_html = '';

		// KEEP THIS IN - IF THERE IS AN ISSUE WITH MAILCHIMP, IT WILL SHOW A MESSAGE.
		foreach ( $pb->ga( 'errors' ) as $form_error ) {
			$inner_html .= '<p style="color: red;">' . $form_error . '</p>';
		}

		// [SIMPLE TEXT FIELDS - START].
		$inner_html .= '
		<div class="w-full grid grid-cols-1 gap-y-10 mt-10">

			<div class="form-group flex flex-col">
				<label for="name">Name</label>
				<input id="name" type="text" name="name" placeholder="John" required />
			</div>

			<div class="form-group flex flex-col">
				<label for="email">Email Address</label>
				<input id="email" type="text" name="email" placeholder="example@company.com" required />
			</div>

			<div class="form-group flex flex-col">
				<label for="contact_number">Mobile Number</label>
				<input id="contact_number" type="tel" name="contact_number" placeholder="1800 222 333" />
			</div>

		</div>

		<div class="w-full mt-10">
			<label class="block"> Upload your CV:</label>
			<input class="block w-full px-2 py-2 text-base font-normal bg-white bg-clip-padding transition ease-in-out focus:bg-white focus:ring-theme-color focus:outline-none" type="file" id="CVFile" name="attachment[]">
		</div>

		<div class="form-group flex flex-col mt-10">
			<textarea name="help_message" cols="30" rows="5" placeholder="How can we help?" required></textarea>
		</div>

		<div class="flex items-center mt-10">
			<div class="flex items-center">
			<input id="terms" aria-describedby="terms" type="checkbox" class="w-6 h-6 bg-transparent rounded-full border-2 border-dark-section-text text-dark-color focus:ring-0 focus:ring-offset-0 focus:outline-none" required>
			</div>
			<div class="ml-5">
			<label for="terms">We are committed to preserving your privacy, view our <a href="#" class=" text-dark-section-text underline">Privacy Policy</a></label>
			</div>
		</div>
		';

		// [RECAPTCHA - START]
		$inner_html .= '<p class="mt-8">';
		// SIZE CAN BE COMPACT OR NORMAL (SNAPS TO COMPACT - SEE JS - WHEN WINDOW < 800PX WIDE).
		$inner_html .= do_shortcode( "[contactforms_recaptcha size='normal']" );
		$inner_html .= '</p>';
		// [RECAPTCHA - END]

		// THIS CLASS HIDES THE SUBMIT BUTTON UNTIL RECAPTCHA IS COMPLETED (SAVES MISSING IT).
		$inner_html .= "<div class='js-wait-for-recaptcha'>";
		$inner_html .= '
			<button type="submit" class="button button-border mt-10 w-full">Submit</button>
		';
		$inner_html .= '</div>';

		return $inner_html;
	}
}
