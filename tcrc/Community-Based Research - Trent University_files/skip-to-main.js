(function($) {


	$(function() {

		$('a.skip-link').on('click', function(e) {
			// back up a bit so the sticky nav doesn't engage
			var stickyBuffer = 25;
			// grab main content location
			var mainContentY = $('#main-content').offset().top;
			// calculate height of elements we have to compensate for
			var stickyNavHeight = ($('.ribbon-menu').outerHeight() || 0) + ($("#breadcrumb").outerHeight() || 0);
			var drupalAdmin = $('#admin-menu').outerHeight() || 0;

			// scroll to position
			$('html, body').scrollTop(mainContentY - (stickyNavHeight + drupalAdmin) - 25);

			// prevent outline on the main content element while cuing up the next tab focus
			$($(this).attr('href')).css('outline', '0').attr('tabindex', -1).focus();

			e.preventDefault();
		});

	});

})(jQuery);