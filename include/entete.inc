<!DOCTYPE html>
<html lang="fr-ca">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="description"
          content="Site de punch."/>
    <title>Punch</title>

    <!--    //bibliothèque de style et js personnel-->
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/table.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->



</head>

<body onload=display_ct();>



<nav class="navbar">
    <div class="container-fluid">
        <div class="navmenu row">
            <div class="menubar text-center col-4 p-0 m-0">
				<span class="openmenu" id="openmenu">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="16">
						<g fill="#ffffff" fill-rule="evenodd">
							<path d="M0 0h24v2H0zM0 7h24v2H0zM0 14h24v2H0z" />
						</g>
					</svg>
				</span>
            </div>
            <div class="brandbar text-center p-0 m-0 col-4">
                <h1><a href="index.php" class="brand">Punch</a></h1>
            </div>
            <div class="userbar col-4 text-center p-0 m-0"><?php if (isset($_SESSION["isConnected"])){
                echo '<a href="function/deconnexion.php" class="btn btn-danger">Déconnexion</a>';
                }?></div>
        </div>
    </div>
</nav>
<section class="navmodal" id="navmodal">
    <div class="container">
		<span class="closemenu" id="closemenu">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
				<path fill="#ffffff" fill-rule="evenodd" d="M17.778.808l1.414 1.414L11.414 10l7.778 7.778-1.414 1.414L10 11.414l-7.778 7.778-1.414-1.414L8.586 10 .808 2.222 2.222.808 10 8.586 17.778.808z" />
			</svg>
		</span>
        <?php if (isset($_SESSION["isConnected"])){
            echo '<div class="navmodal-wrapper">
            <div class="column">
                <h4 class="subtitle">ADMINISTRATION</h4>
                <ul class="menu">
                    <li class="menu-item"><a href="dashboard.php" class="menu-link">Ajout</a></li>
                    <li class="menu-item"><a href="dashboard.php" class="menu-link">Log</a></li>
                    <li class="menu-item"><a href="dashboard.php" class="menu-link">Statistique</a></li>
                    <li class="menu-item"><a href="dashboard.php" class="menu-link">Configuration</a></li>
                </ul>
            </div>
            <div class="column">
                <h4 class="subtitle">FICHE PERSONNELLE</h4>
                <ul class="menu">
                    <li class="menu-item"><a href="dashboard.php?employe=3" class="menu-link">John</a></li>
                    <li class="menu-item"><a href="dashboard.php?employe=4" class="menu-link">Skooma</a></li>
                    <li class="menu-item"><a href="dashboard.php?employe=2" class="menu-link">Masafa56</a></li>
                    <li class="menu-item"><a href="dashboard.php?employe=1" class="menu-link">G.I.JOE</a></li>
                    <li class="menu-item"><a href="dashboard.php?employe=5" class="menu-link">Antoine</a></li>
                </ul>
            </div>

        </div>';
        }
        else{
            echo '<div class="navmodal-wrapper">
            <div class="column">
                <h4 class="subtitle">ADMINISTRATION</h4>
                <ul class="menu">
                    <li class="menu-item"><a href="dashboard.php" data-toggle="modal" data-target="#modalLoginForm" class="menu-link">Tableau de bord</a></li>
                </ul>
            </div>

        </div>';
        }?>

    </div>
</section>
<main>
