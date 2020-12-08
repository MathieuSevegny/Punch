$(document).ready(function() {

    $("#search").keyup(function() {

        var name = $('#search').val();


        if (name === "") {

            $("#employer").html("");

        }

        else {
            $.ajax({

                type: "POST",

                url: "function/search.php",

                data: {
                    recherche: name
                },


                success: function(html) {

                    $("#employer").html(html).show();

                }

            });

        }

    });

});