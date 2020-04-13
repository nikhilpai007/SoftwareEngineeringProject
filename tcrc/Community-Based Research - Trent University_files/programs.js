(function ($) {
    $(document).ready(function () {

        /**
         * Decide which academic programs to show or hide depending on what program level is selected by default
         * This is useful when the back button is pressed etc...
         */
        if ($('input[type=radio][name=academic-level]:checked').val() === "graduate") {
            $('#graduate-programs').show();
            $('#undergraduate-programs').hide();
        } else {
            $('#graduate-programs').hide();
            $('#undergraduate-programs').show();
        }

        /**
         * Decide which academic programs to show or hide depending on what program level is selected
         */
        $('input[type=radio][name=academic-level]').change(function () {
            if (this.value == "graduate") {
                $('#graduate-programs').show();
                $('#undergraduate-programs').hide();
            } else {
                $('#graduate-programs').hide();
                $('#undergraduate-programs').show();
            }
        });

        $("#graduate-programs,#undergraduate-programs").change(function () {
            if (this.value != "0") {
                window.location.href = this.value;
            }
        });

    });
})(jQuery);
