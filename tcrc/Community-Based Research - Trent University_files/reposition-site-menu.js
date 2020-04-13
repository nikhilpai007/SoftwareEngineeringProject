/*
 * Reposition the Site Menu, accomodating the 50 million ways of generating
 * a site menu (block IDs, Context module, etc, etc, etc.).  Striving for
 * consistency with D8 here.
 */
(function($) {
  var repositionSiteMenu = function() {
    var menu = $('#highlighted .block-menu-block');
    // var applyTemplate = !menu.hasClass('ribbon-menu');
    var applyTemplate = menu.attr('ribbonized') === undefined;

    // pull the ribbon menu out of the highlighted region so it can sticky
    // properly
    menu
      .insertAfter('#highlighted')
      .addClass('ribbon-menu site-menu sticky-top')
      .attr('role', 'navigation')
      .attr('aria-labelledby', 'site-title');

    // menu is one of the permutations driven by an installation profile /
    // Context module / etc and requires a little coercion to conform...
    if (applyTemplate) {
      menu
        .find('h2')
        .attr('id', 'site-title')
        .addClass('navbar-brand')
        .wrap("<div class='site-menu-branding'></div>")
        .before(
          '<img src="/sites/all/themes/trent/images/crest.png" alt="Trent University" class="site-crest">'
        )
        .css('visibility', 'visible');
    }

    // reposition subtitle
    var subtitle = $('#highlighted #site-subtitle');
    if (subtitle.length) {
      menu.prepend(subtitle);
    }
  };

  $(function() {
    repositionSiteMenu();
  });
})(jQuery);
