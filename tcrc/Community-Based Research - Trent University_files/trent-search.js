(function ($) {
  $(document).ready(function () {

    $("#trent-search-button").click(function () {
      if ($('#search-box').val() == "") {
        alert("Please enter text in the search field");
      } else {
        window.location.href = "https://www.trentu.ca/search/google/" + $("#search-box").val();
      }
    });

    $("#search-box").keypress(function (e) {
      if (e.which == 13) {
        if ($('#search-box').val() == "") {
          alert("Please enter text in the search field");
        } else {
          window.location.href = "https://www.trentu.ca/search/google/" + this.value;
        }
      }
    });

    $("#search-box").click(function () {
      $("#search-box").val("");
    });

    $("#button-expand-search").click(function () {
      $("#trent-search").slideToggle("fast", function () {
      });
      $("#search-box").focus();
    });

  });

})(jQuery);