<?php
include ("include/configuration.php");
include("include/entete.inc");
include("admin/function.php");
include("include/gestion_punch.php");
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="container-fluid">
        <div class="row align-items-center pb-5">

            <?php
//            if (!isset($_SESSION['isConnected'])){
//                echo "Non connecté";
//            }
//            else{
//                totaljournererror(date('Y-m-d',strtotime("-1 days")));
//            }
            if (!isset($_SESSION['isConnected'])){
                echo "<div class='container text-center'><br><br><br><h1 class='text-white'>Non connecté</h1></div>";
            }
            // http://localhost/punch/dashboard.php?employe=1&gestion=1&semaine=0
            //employe -> employe.id
            //gestion -> bool
            //semaine -> (semaine 1 = semaine prochaine) (semaine -1 = semaine derniere)
            else{
                $employe_id = 1;
                $nbdecale = 0;

                if (isset($_GET["employe"]) && is_numeric($_GET["employe"])){
                    $idemploye = $_GET["employe"];

                    $resultat = $conn->query("SELECT id FROM employes WHERE id = ". $idemploye.";");
                    $employe_exist = false;
                    if($resultat->rowCount() == 1)
                    {
                        $employe_exist = true;
                        $employe_id = $idemploye;
                    }

                }
                if (isset($_GET["semaine"]) && is_numeric($_GET["semaine"])){
                    $nbdecale = $_GET["semaine"];

                }

                punchs_semaine($nbdecale,$employe_id);
            }
            ?>
        </div>

    </div>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

    </style>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="closer btn btn-secondary">Close</button>
                    <button type="button" id="saver" class="btn btn-primary save">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>



    <script>

        $( document ).ready(function() {
            var precedant;
            $(document).on('click', '.delete', function() {

                if (confirm("Êtes-vous sure !")){
                    ajaxsupppunch(this.id);

                }
            });
            $(document).on('click', '.closer', function() {
                /*$('.modal-body .row').each(function () {
                    var item = $(this); //this should represent one row
                    var heure = item.find('input:text[name=heure]').val();
                    var date = item.find('input:hidden[name=date]').val();
                    var type = item.find(':selected').val();
                    var idpunch = item.find('input:hidden[name=idpunch]').val();
                    ajaxupdatepunch(idpunch,date,heure,type)

                });*/
                var semaine = getQueryVariable("semaine");
                var employe = getQueryVariable("employe");
                window.location.href = "dashboard.php?employe="+ employe +"&semaine="+semaine;

            });
            $(document).on('click', '.addrow', function() {
                var id = getQueryVariable("employe");
                var date = getQueryVariable("date");

                ajaxaddpunch(id,date);
            });
            $(document).on('click', '.save', function() {
                $('.modal-body .row').each(function () {
                    var item = $(this); //this should represent one row
                    var heure = item.find('input:text[name=heure]').val();
                    var date = item.find('input:hidden[name=date]').val();
                    var type = item.find(':selected').val();
                    var idpunch = item.find('input:hidden[name=idpunch]').val();
                    ajaxupdatepunch(idpunch,date,heure,type)

                });
            });



            $(document).on('input', '.formulaire', function(){

                var presentement = $('.modal-body').html();

                if (presentement === precedant){

                    $(".delete").show();
                    $(".addrow").show();
                    $("#saver").hide();

                }

                else {
                    $(".delete").hide();
                    $(".addrow").hide();
                }

            });
            if (getQueryVariable("date")!== false){



                $('#exampleModal').modal('show');
                var id = getQueryVariable("employe");
                var date = getQueryVariable("date");



                ajaxuserpunchnom(id);
                ajaxuserpunchdate(id,date);

                function ajaxupdatepunch(identifiant, datedu, heure, typepunch) {
                    $.ajax({

                        type: "POST",

                        url: "function/modifierpoicons.php",

                        data: {
                            id: identifiant,
                            moment: datedu,
                            heure: heure,
                            typepunch: typepunch
                        },


                        success: function(html) {

                            ajaxuserpunchdate(id,date);
                        }

                    });


                }
                function ajaxaddpunch(identifiant, date) {
                    $.ajax({

                        type: "POST",

                        url: "function/ajouter_punch.php",

                        data: {
                            id: identifiant,
                            moment: date
                        },


                        success: function(html) {

                            ajaxuserpunchdate(id,date);
                        }

                    });


                }
                function ajaxsupppunch(identifiant) {
                    $.ajax({

                        type: "POST",

                        url: "function/supprimerpunch.php",

                        data: {
                            id: identifiant
                        },


                        success: function(html) {

                            ajaxuserpunchdate(id,date);
                            // $('.modal-body').html(html);

                        }

                    });


                }
                function ajaxuserpunchnom(id) {


                            $.ajax({

                                type: "POST",

                                url: "function/utilisateur_nom.php",

                                data: {
                                    id: id
                                },


                                success: function(html) {

                                    $('.modal-title').html(html);

                                }

                            });




                }
                function ajaxuserpunchdate(id,date) {


                    $.ajax({

                        type: "POST",

                        url: "function/utilisateur_date_punch.php",

                        data: {
                            id: id,
                            date: date
                        },


                        success: function(html) {

                            $('.modal-body').html(html);
                            precedant = html;
                        }

                    });




                }

            }
        });

        function getQueryVariable(variable) {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i=0;i<vars.length;i++) {
                var pair = vars[i].split("=");
                if(pair[0] == variable){return pair[1];}
            }
            return(false);
        }
    </script>
<?php

include("include/pied-de-page.inc");
