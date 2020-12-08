<?php
//$nbdecale est le nombre de semaine décalé, $employe_id est le numéro de l'employé, $conn est la connexion sql
function punchs_semaine($nbdecale, $employe_id)
{
    include("include/configuration.php");
    include("function/calculateurheure.php");

    $tabjours = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];

    $semaine = decalageSemaine($nbdecale);

    $semaineprochaine = date('d.m.Y', strtotime($semaine . ' + 1 week'));
    $semaine = date("Y-m-d", strtotime($semaine));
    $semaineprochaine = date("Y-m-d", strtotime($semaineprochaine));

    $sql_employe_data = "SELECT CONCAT(employes.prenom,' ',employes.nom) AS nom , usagers.image AS image FROM employes
INNER JOIN usagers ON employes.id = usagers.employes_id WHERE employes.id = " . $employe_id . ";";
    $nom = '';
    $image = '';
    $employe_avant = 0;
    $employe_apres = 0;
    $html_result = '<div class="container"><div class="row">';

    $resultat_employe_data = $conn->query($sql_employe_data);
    while ($row = $resultat_employe_data->fetch()) {
        if ($row["image"] == null) {
            $imagedata = "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";
        } else {
            $imagedata = $row["image"];
            $imagedata = base64_encode($imagedata);
        }
        $nom = $row["nom"];
        $image = "<img src=\"data:image/png;base64,$imagedata\" class=\"img-center\" alt=\"rfid\">";
    }

    $id_avant = $employe_id - 1;
    $resultat_employe_avant = $conn->query("SELECT id FROM employes WHERE id = " . $id_avant . ";");
    if ($resultat_employe_avant->rowCount() == 1) {
        $employe_avant = $employe_id - 1;
    }
    $id_apres = $employe_id + 1;
    $resultat_employe_apres = $conn->query("SELECT id FROM employes WHERE id = " . $id_apres . ";");
    if ($resultat_employe_apres->rowCount() == 1) {
        $employe_apres = $employe_id + 1;
    }
    if ($employe_avant != 0) {
        $url = "dashboard.php?employe=" . $employe_avant . "&semaine=" . $nbdecale . "";
        $html_result .= '<div class="col-4 text-center"><br><a class="btn btn-dark" href="' . $url . '"><--</a></div>';
    } else {
        $html_result .= '<div class="col-4"></div>';
    }
    $html_result .= '<div class="col-4 text-center">' . $image . ' <h3>' . $nom . '</h3></div>';
    if ($employe_apres != 0) {
        $url = "dashboard.php?employe=" . $employe_apres . "&semaine=" . $nbdecale . "";
        $html_result .= '<div class="col-4 text-center"><br><a class="btn btn-dark" href="' . $url . '">--></a></div></div>';
    } else {
        $html_result .= '<div class="col-4"></div></div>';
    }

    $total = 0;

    for ($i = 0; $i < 7; $i++) {
        $date = date("Y-m-d", strtotime($semaine . ' + ' . $i . ' day'));
        $total += totalheurejournee($date, $employe_id);
    }
    $urlbefore = "dashboard.php?employe=" . $employe_id . "&semaine=" . ($nbdecale - 1) . "";
    $urlafter = "dashboard.php?employe=" . $employe_id . "&semaine=" . ($nbdecale + 1) . "";
    $html_result .= '<div class="row">';
    $html_result .= '<div class="col-4 text-center"><a class="btn btn-dark" href="' . $urlbefore . '">Semaine d\'avant</a></div>';
    if ($total != 0){
        $html_result .= '<div class="col-4 text-center"><h3>Total d\'heure : ' . to_time($total) . '</h3><h4>Semaine du '.$semaine.'</h4></div>';
    }else{
        $html_result .= '<div class="col-4 text-center"><h3>Total d\'heure : 0h00</h3><h4>Semaine du '.$semaine.'</h4></div>';
    }

    $html_result .= '<div class="col-4 text-center"><a class="btn btn-dark" href="' . $urlafter . '">Semaine d\'après</a></div></div>';

    $tabin = [];
    $tabout = [];
    $html_result .= '
<br>
<table class="unstyledTable">
<thead>
<tr>
<th>Jours</th>
<th>Poinçons d\'entrée</th>
<th>Poinçons de sortie</th>
<th>Total de journée</th>
</tr>
</thead>
<tbody>';
    for ($jour = 0; $jour < 7; $jour++) {
        $date = date('Y-m-d', strtotime($semaine . ' + '. $jour .' day'));
        $sql_in = "SELECT cast(moment as time) AS time from punch where punchtype_id = 1 AND DATE(moment) = '" . $date . "' AND employes_id = " . $employe_id . " ORDER BY moment ASC;";
        $sql_out = "SELECT cast(moment as time) AS time from punch where punchtype_id = 2 AND DATE(moment) = '" . $date . "' AND employes_id = " . $employe_id . " ORDER BY moment ASC;";

        $resultat_punch_in = $conn->query($sql_in);
        $resultat_punch_out = $conn->query($sql_out);
        $videin = false;
        if ($resultat_punch_in->rowCount() < 1){
            $videin = true;
        }
        $videout = false;
        if ($resultat_punch_in->rowCount() < 1){
            $videout = true;
        }

        $html_result .= "<tr>";
        $html_result .= '<td>' . $tabjours[$jour]. '</td>';
        $time = '<td><a class="punch" href="dashboard.php?employe='.$employe_id.'&semaine='.$nbdecale.'&date='.$date.'"><div style="width: 100%; height: 100%">';
        if (!$videin){
            while ($row = $resultat_punch_in->fetch()) {
                $time .= $row['time'] . '<br>';
            }
        }
        else{
            $time .= 'Il n\'y a pas de poinçons ici.';
        }
        $time .= '</div></a></td>';
        $html_result .= $time;

        $time = '<td><a class="punch" href="dashboard.php?employe='.$employe_id.'&semaine='.$nbdecale.'&date='.$date.'"><div style="width: 100%; height: 100%">';
        if (!$videin){
            while ($row = $resultat_punch_out->fetch()) {
                $time .= $row['time'] . '<br>';
            }
        }
        else{
            $time .= 'Il n\'y a pas de poinçons ici.';
        }
        $time .= '</div></a></td>';
        $html_result .= $time;
        if ($resultat_punch_in->rowCount() == 0){
            $html_result .= '<td>0h00</td>';
        }else{
            $html_result .= '<td>'. to_time(totalheurejournee($date,$employe_id)).'</td>';
        }
        $html_result .= "</tr>";
    }




        $html_result .= '</tbody>
</tr>
</table></div>';
        echo $html_result;
    }



