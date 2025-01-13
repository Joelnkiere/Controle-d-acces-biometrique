<?php
include 'includes/session.php'; 
include 'includes/header.php'; 

// Définir la locale en français pour l'affichage des dates et mois
setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr'); 

// Initialiser les dates par défaut (mois en cours)
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-01'); // Premier jour du mois
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-t'); // Dernier jour du mois
?>

<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Heures Prestées des Agents</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Heures Prestées</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Formulaire pour choisir la période -->
      <form method="POST" action="">
        <div class="row">
          <div class="col-md-4">
            <label for="start_date">Date de début</label>
            <input type="date" class="form-control" name="start_date" value="<?= $start_date ?>" required>
          </div>
          <div class="col-md-4">
            <label for="end_date">Date de fin</label>
            <input type="date" class="form-control" name="end_date" value="<?= $end_date ?>" required>
          </div>
          <div class="col-md-4">
            <br>
            <button type="submit" class="btn btn-primary btn-sm btn-flat">Filtrer</button>
          </div>
        </div>
      </form>

      <!-- Table des agents et heures prestées -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th>ID Agent</th>
                  <th>Nom Agent</th>
                  <th>Heures Prestées</th>
                </thead>
                <tbody>
                  <?php
                  // Requête pour récupérer les agents avec le total des heures prestées
                  $sql = "SELECT a.id_agent, a.prenom, a.nom, SUM(p.nombre_heure) AS total_heure 
                          FROM agent a 
                          LEFT JOIN presence p ON a.id = p.id_agent 
                          WHERE p.date BETWEEN '$start_date' AND '$end_date' 
                          GROUP BY a.id_agent, a.prenom, a.nom 
                          ORDER BY a.nom ASC, a.prenom ASC";
                  $query = $conn->query($sql);

                  if ($query->num_rows > 0) {
                      while ($row = $query->fetch_assoc()) {
                        $total_hours = $row['total_heure'] ? round($row['total_heure']) : 0;
                          echo "
                              <tr>
                                <td>{$row['id_agent']}</td>
                                <td>{$row['prenom']} {$row['nom']}</td>
                                <td>{$total_hours} heures</td>
                              </tr>
                          ";
                      }
                  } else {
                      echo "<tr><td colspan='3' class='text-center'>Aucun agent trouvé ou aucune heure prestée pour cette période</td></tr>";
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
