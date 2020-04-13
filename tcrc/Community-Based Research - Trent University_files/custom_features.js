(function ($) {

  Drupal.behaviors.customFeatures = {
    attach: function() {

      $("table").wrap("<div class='table-responsive'></div>");
      $( ".page-courses #main .view-filters" ).prepend( "<div class='browse-by-program'>Browse by Program</div>" );
      $('.field-name-field-transcript-file').detach().insertAfter('.field-name-body .fluid-width-video-wrapper');
      $('.field-name-field-transcript-file .file a').attr('target','_blank');

    }
  };
  
})(jQuery);
