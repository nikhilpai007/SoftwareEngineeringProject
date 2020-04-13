(function($) {
  $(function() {
    let $siteMenuContainer = $('body');
    let $siteMenu =
      $('.ribbon-menu').length > 0
        ? $('.ribbon-menu')
        : $('#highlighted .block-menu-block');
    let $highlighted = $('#highlighted');
    let $menuSlider = $('.menu-slider'); // parent wrapper
    let maxMenuHeight = 80;

    $menuSlider.scroll(function() {
      // we absolutely rely upon the #highlighted element to determine when to
      // kick in sticky-ness and handle it with position: fixed, etc.
      if ($menuSlider.scrollTop() >= $highlighted.height() - maxMenuHeight) {
        $siteMenuContainer.addClass('sticky-menu');
      } else {
        $siteMenuContainer.removeClass('sticky-menu');
      }
    });

    //
    // Try to make the ribbon menu work better for sites with lots of menu
    // items or content by shrinking down the font.  Not an issue for XL displays
    // - just around the mobile breakpoint.  Handled in CSS.
    //
    function shrinkMenu() {
      var itemsWidth = $siteMenu.find('ul.menu').width();

      if (itemsWidth > $(window).width() / 2) {
        $siteMenu.addClass('site-menu-small');
      } else {
        $siteMenu.removeClass('site-menu-small');
      }
    }

    $(window).on('resize', function() {
      shrinkMenu();
    });

    shrinkMenu();
  });
})(jQuery);
