(function($) {
  $(window).load(function() {
    $('.grid').fadeIn('fast');

    $('.grid').masonry({
      itemSelector: '.grid-item',
      columnWidth: '.grid-sizer',
      // gutter: '.gutter-sizer',
      gutter: 20,
      percentPosition: true,
    });

    if ($(window).width() > 960) {
      $(
        '.node-type-program #content .block-views:not(#block-views-program-fields-block-4)'
      ).each(function() {
        var blockHeight = $(this).height();
        var titleMarginTop = blockHeight / 2 - 16;
        $(this)
          .find('h2')
          .css('margin-top', titleMarginTop + 'px');
      });

      // Show and hide the program view types (list view and grid view)
      $('#program-view-filter #programs-list-view').click(function() {
        $('.block-views-programs-filter').hide();
        $('.block-views-programs-grid').hide();
        $('.block-views-programs-list').show();
        $('#program-view-filter #programs-list-view').removeClass(
          'program-view-filter-list'
        );
        $('#program-view-filter #programs-list-view').addClass(
          'program-view-filter-list-selected'
        );
        $('#program-view-filter #programs-grid-view').removeClass(
          'program-view-filter-grid-selected'
        );
        $('#program-view-filter #programs-grid-view').addClass(
          'program-view-filter-grid'
        );
      });

      $('#program-view-filter #programs-grid-view').click(function() {
        $('.block-views-programs-list').hide();
        $('.block-views-programs-grid').show();
        $('.block-views-programs-filter').show();
        $('#program-view-filter #programs-list-view').removeClass(
          'program-view-filter-list-selected'
        );
        $('#program-view-filter #programs-list-view').addClass(
          'program-view-filter-list'
        );
        $('#program-view-filter #programs-grid-view').addClass(
          'program-view-filter-grid-selected'
        );
        $('#program-view-filter #programs-grid-view').removeClass(
          'program-view-filter-grid'
        );
      });
    }

    //	jQuery('#block-menu-block-3 .expanded').each(function(index){
    //		jQuery(this).find('a:first').append('<span class="menuToggle"></span>').parent().find('.menu').toggle();
    //	});
    //
    //	jQuery('#block-menu-block-3 .active-trail a span.menuToggle').addClass('active').parent().parent().find('.menu').toggle();
    //
    //	jQuery('#block-menu-block-3 .expanded a span').click(function(event) {
    //	    jQuery(this).parent().parent().find('ul.menu').toggle();
    //		jQuery(this).toggleClass('active');
    //		event.stopPropagation();
    //		event.preventDefault();
    //	});
  });
})(jQuery);
