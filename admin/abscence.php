<?php
// Inclure les fichiers nécessaires
include 'includes/session.php'; 
include 'includes/header.php'; 

// Définir la locale en français pour l'affichage des dates et mois
setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr'); 

// Récupérer la date d'aujourd'hui
$today = date('Y-m-d');
?>

<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Absents du jour
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Absents du jour</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Echec de l'operation!</h4>
              ".$_SESSION['error']." 
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Operation reussie!</h4>
              ".$_SESSION['success']." 
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Date</th>
                  <th>ID Agent</th>
                  <th>Nom Agent</th>
                  <th>Heure Entrée</th>
                  <th>Heure Sortie</th>
                </thead>
                <tbody>
                  <?php
                    // Requête pour récupérer les absents du jour
                    $sql = "SELECT *, agent.id_agent AS empid, presence.id AS attid 
                            FROM presence 
                            LEFT JOIN agent ON agent.id=presence.id_agent 
                            WHERE presence.date = '$today' 
                            AND (presence.heure_entree IS NULL OR presence.heure_sortie IS NULL)";
                    $query = $conn->query($sql);

                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td>".strftime('%d %b, %Y', strtotime($row['date']))."</td>
                          <td>".$row['empid']."</td>
                          <td>".$row['nom'].' '.$row['prenom']."</td>
                          <td>".(is_null($row['heure_entree']) ? 'Non marquée' : strftime('%H:%M', strtotime($row['heure_entree'])))."</td>
                          <td>".(is_null($row['heure_sortie']) ? 'Non marquée' : strftime('%H:%M', strtotime($row['heure_sortie'])))."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>

  <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
