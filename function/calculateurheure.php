<?php
//$date (Y-m-a) , $employe_id est le numéro de l'employé et $conn est la connexion sql
function totalheurejournee($date, $employe_id){
    include ("include/configuration.php");

    $sql_in = "SELECT cast(moment as time) AS time from punch where punchtype_id = 1 AND DATE(moment) = '".$date."' AND employes_id = ".$employe_id." ORDER BY moment ASC;";
    $sql_out = "SELECT cast(moment as time) AS time from punch where punchtype_id = 2 AND DATE(moment) = '".$date."' AND employes_id = ".$employe_id." ORDER BY moment ASC;";
    $resultat_in = $conn->query($sql_in);
    $resultat_out = $conn->query($sql_out);
    $nbin = $resultat_in->rowCount();
    $nbout = $resultat_out->rowCount();
    $nb = 0;
    $result = '';
    if($nbin > $nbout){
        $nb = $nbout;
    }
    else {
        $nb = $nbin;
    }
    for ($i = 0; $i < $nb; $i++){
        $intime = $resultat_in->fetch();
        $outtime = $resultat_out->fetch();
        $in = strtotime($intime["time"]);
        $out = strtotime($outtime["time"]);
        $total += ($out - $in)/3600;;
    }
    return $total;
}

function to_time($float){
    $intpart = floor( $float );
    $fraction = $float - $intpart;
    $minutes = $fraction * 60;
    $textminutes = floor($minutes);
    if ($textminutes == 0)
    {
        $textminutes = '00';
    }
    else if ($textminutes < 10){
        $textminutes =  '0' . $textminutes;
    }
    return $intpart . "h". $textminutes;
}

function decalageSemaine($nbdecale){
    date_default_timezone_set("US/Eastern");
    $semaine = date('d.m.Y', strtotime('last Sunday'));

    if ($nbdecale < 0) {
        $semaine = date('d.m.Y', strtotime($semaine . ' - ' . abs($nbdecale) . ' week'));
    } else if ($nbdecale > 0) {
        $semaine = date('d.m.Y', strtotime($semaine . ' + ' . abs($nbdecale) . ' week'));
    }
    return $semaine;
}
