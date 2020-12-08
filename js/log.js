$(document).ready(function() {
    var latestVShtml = ''; // variable to store the html
    var interval = 500;  // 1000 = 1 second, 3000 = 3 seconds
    if(localStorage.getItem("last")!==null){
        latestVShtml = localStorage.getItem("last"); // variable to store the html

    }







    function doAjax() {
        $.ajax({

            type: "POST",

            url: "function/last-log.php",

            success: function(html) {
                if (latestVShtml !== html) { // check if html is modified
                    latestVShtml = html; // update with the last instance of the html
                    $("#lastpunch").html(html).show().delay(3500).fadeOut();

                    localStorage.setItem("last", html);


                }


            },
            complete: function (data) {
                // Schedule the next
                setTimeout(doAjax, interval);
            }

        });

    }
    setTimeout(doAjax, interval);


});

