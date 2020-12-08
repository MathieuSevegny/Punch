</main>
<script type="text/javascript">
    function display_c() {
        var refresh = 1000; // Refresh rate in milli seconds
        mytime = setTimeout('display_ct()', refresh)
    }

    function display_ct() {
        var x = new Date();
        var minute = x.getMinutes();
        if (minute.toString().length < 2) {
            minute = ("0" + x.getMinutes())
        }
        var hour = x.getHours();
        if (hour.toString().length < 2){
            hour = ("0" + x.getHours())
        }
        var time = (hour + "  :  " + minute);
        document.getElementById('ct').innerHTML = time;
        display_c();
    }
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    var error = urlParams.get('error');
    if (error === '1'){
        alert("Mauvais mot de passe !");
        // Hide the div
        $("#lastpunch").hide();

        // Show the div in 5s
        // $("#lead_form").delay(5000).fadeIn(500);
    }
    if (error === '5'){
        alert("Vous ne disposez pas des droits pour accéder au tableau de bord.");
        // Hide the div
        $("#lastpunch").hide();

        // Show the div in 5s
        // $("#lead_form").delay(5000).fadeIn(500);
    }

</script>
<script  type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script  type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script src="js/recherche.js"></script>
<script src="js/log.js"></script>
<script  src="js/navbar.js"></script>
</body>
</html>

