jQuery(document).ready(function() {

    // Mobile menu
    // Grab HTML Elements
	const btnWrap = document.querySelector(".mobile-menu-wrapper");
	const btn = document.querySelector("button.mobile-menu-button");
	const menu = document.querySelector(".mobile-menu");
    const overlay = document.querySelector(".overlay");
    const close = document.querySelector(".mobile-menu .close");

	// Search box
	btn.addEventListener("click", () => {
	    btnWrap.classList.toggle("menu-open");
	    menu.classList.toggle("slide-close");
	    overlay.classList.toggle("hidden");
	});
	overlay.addEventListener("click", () => {
        btnWrap.classList.toggle("menu-open");
	    menu.classList.toggle("slide-close");
	    overlay.classList.toggle("hidden");
	});
	close.addEventListener("click", () => {
        btnWrap.classList.toggle("menu-open");
	    menu.classList.toggle("slide-close");
	    overlay.classList.toggle("hidden");
	});

	jQuery('.hero-slider').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		dots: true,
		// prevArrow: '<span class="left-arrow"><i class="far fa-angle-left"></i></span>',
		// nextArrow: '<span class="right-arrow"><i class="far fa-angle-right"></i></span>',
	});

	// Modal
	jQuery(".open-modal").click(function(e) {
        e.preventDefault();

		jQuery("#modal").removeClass("-translate-y-[999px]");
		jQuery("#modal").addClass("-translate-y-1/2");
	    jQuery(".modal-overlay").removeClass("hidden");
        
    });
	jQuery(".modal-overlay, #modal .close").click(function(e) {
        e.preventDefault();

		jQuery("#modal").addClass("-translate-y-[999px]");
		jQuery("#modal").removeClass("-translate-y-1/2");
	    jQuery(".modal-overlay").addClass("hidden");
        
    });

	// Video Gallery Modal
	jQuery(".open-modal").click(function(e) {
        e.preventDefault();

		var targetModal = jQuery(this).data('modal');
		jQuery(".video-modal-"+targetModal).removeClass("-translate-y-[9999px]");
		jQuery(".video-modal-"+targetModal).addClass("-translate-y-1/2");
		jQuery(".video-modal-overlay").removeClass("hidden");
        
    });
	jQuery(".video-modal-overlay, .video-modal .close").click(function(e) {
        e.preventDefault();

		jQuery(".video-modal").addClass("-translate-y-[9999px]");
		jQuery(".video-modal").removeClass("-translate-y-1/2");
	    jQuery(".video-modal-overlay").addClass("hidden");
        
    });

    // redirect
    jQuery(".animate-redirect a[href^='#']").click(function(e) {
        e.preventDefault();

        var position = jQuery(jQuery(this).attr("href")).offset().top;

        jQuery("body, html").animate({
            scrollTop: position
        }, 1000);
    });

	// nav cloned in side-menu
	jQuery(".main-nav ul.parent")
	.clone()
	.removeClass()
	.addClass('flex flex-col text-xl font-bold text-right space-y-8')
	.appendTo('nav.clone');
	// remove link and dropdown classes
	jQuery("nav.clone ul.sub-menu, nav.clone li a")
	.removeClass();
	// add space into child items
	jQuery("nav.clone ul ul")
	.addClass('mt-4 space-y-4');
	// add button into nav cloned div
	jQuery(".header-button a")
	.clone()
	.removeClass()
	.addClass('flex flex-col text-xl font-bold text-right mt-8')
	.appendTo('nav.clone');

	// Testimonials Slider
	jQuery('.testimonials .item-wrap').slick({
		dots: true,
		arrows: false,
	});

	jQuery('.slider-full').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		asNavFor: '.carousel'
	});
	jQuery('.carousel').slick({
		slidesToShow: 6,
		slidesToScroll: 1,
		asNavFor: '.slider-full',
		focusOnSelect: true
	});

	// Article Slider
	jQuery('.article-slider').slick({
		dots: true,
		arrows: false,
	});

});

jQuery(document).ready(function() {
	
	const submitIcon = jQuery(".search-icon button");
	const closeIcon = jQuery(".search-box .close");
	const inputBox = jQuery(".search-form .search-input");
	const searchBox = jQuery(".search-box");
	let isOpen = false;
	
	submitIcon.click(function(e) {
		if (!isOpen) {
			e.preventDefault();
			inputBox.focus();
			searchBox.addClass("search-box-open");
			isOpen = true;
		} else {
			inputBox.focusout();
			searchBox.removeClass("search-box-open");
			isOpen = false;
		}
	});
	closeIcon.click(function(e) {
		searchBox.removeClass("search-box-open");
		isOpen = false;
	});

	submitIcon.mouseup(function() {
		return false;
	});
	searchBox.mouseup(function() {
		return false;
	});
	jQuery(document).mouseup(function() {
		if (isOpen) {
			inputBox.focusout();
			searchBox.removeClass("search-box-open");
			isOpen = false;
		}
	});
	
});