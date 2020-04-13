(function ($) {

    $(document).ready(function () {

        queryAlert();

        window.setInterval(function () {
            queryAlert();
        }, 1000 * 90);

    });

    var guid;

    function queryAlert() {

        const alertURL = "https://" + document.location.hostname + "/sites/all/modules/custom/trent_alertus/alertus.php";

        $.get(alertURL, function (data) {

            if (data) {

                xmlDoc = $.parseXML(data);
                $xml = $(xmlDoc);
                $item = $xml.find("guid");

                if ($item.text() && $item.text() != guid) { // a new alert is available

                    guid = $item.text();

                    $.get(alertURL, {mode: "render"}).done(function (data) {
                        if ($('#alertus-alert').is(':visible')) {
                            $('#alertus-alert').remove();
                        }
                        $(data).prependTo("body").show();
                    });

                } else if (!$item.text()) {

                    if ($('#alertus-alert').is(':visible')) { // no alerts active
                        $('#alertus-alert').remove();
                        guid = "";
                    }

                }
            }

        });

    }

})(jQuery);


