<?php
include 'includes/session.php'; 
include 'includes/header.php'; 

// Définir la locale en français pour l'affichage des dates
setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr'); 

// Initialiser les dates par défaut
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d'); // Date de début par défaut : aujourd'hui
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d'); // Date de fin par défaut : aujourd'hui
?>

<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Liste des Abscents</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Abscents</li>
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

      <!-- Table des agents absents -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th>ID Agent</th>
                  <th>Nom Agent</th>
                  <th>Prénom</th>
                </thead>
                <tbody>
                  <?php
                  // Requête pour récupérer les agents absents dans une période donnée
                  $sql = "SELECT a.id, a.id_agent, a.nom, a.prenom 
                          FROM agent a
                          WHERE a.id NOT IN (
                              SELECT p.id_agent 
                              FROM presence p 
                              WHERE p.date BETWEEN '$start_date' AND '$end_date'
                          )
                          ORDER BY a.nom ASC, a.prenom ASC";
                  $query = $conn->query($sql);

                  if ($query->num_rows > 0) {
                      while ($row = $query->fetch_assoc()) {
                          echo "
                              <tr>
                                <td>{$row['id_agent']}</td>
                                <td>{$row['nom']}</td>
                                <td>{$row['prenom']}</td>
                              </tr>
                          ";
                      }
                  } else {
                      echo "<tr><td colspan='3' class='text-center'>Aucun agent absent pour cette période</td></tr>";
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
