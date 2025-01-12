<?php
include 'includes/session.php'; 
include 'includes/header.php'; 

// Définir la locale en français pour l'affichage des dates et mois
setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr'); 

// Initialiser les dates
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-01'); // Par défaut, premier jour du mois
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-t'); // Par défaut, dernier jour du mois

// Calcul des heures prestées pour chaque agent dans la période donnée
function get_total_hours($agent_id, $start_date, $end_date, $conn) {
    // Requête pour obtenir les heures d'entrée et de sortie dans la période
    $sql = "SELECT p.heure_entree, p.heure_sortie 
            FROM presence p 
            WHERE p.id_agent = '$agent_id' 
            AND p.date BETWEEN '$start_date' AND '$end_date' 
            AND p.heure_sortie != '00:00:00'";
    $query = $conn->query($sql);
    
    $total_hours = 0;
    
    while ($row = $query->fetch_assoc()) {
        // Calcul de la différence entre l'heure d'entrée et l'heure de sortie
        $time_in = strtotime($row['heure_entree']);
        $time_out = strtotime($row['heure_sortie']);
        if ($time_in && $time_out) {
            $total_hours += ($time_out - $time_in) / 3600; // Convertir la différence en heures
        }
    }
    return number_format($total_hours, 2);
}
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
        Heures Prestées des Agents
      </h1>
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
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>ID Agent</th>
                  <th>Nom Agent</th>
                  <th>Heures Prestées</th>
                </thead>
                <tbody>
                  <?php
                    // Récupérer tous les agents
                    $sql_agents = "SELECT id_agent, prenom, nom FROM agent";
                    $query_agents = $conn->query($sql_agents);
                    
                    while ($agent = $query_agents->fetch_assoc()) {
                        // Récupérer le total des heures prestées pour chaque agent
                        $total_hours = get_total_hours($agent['id_agent'], $start_date, $end_date, $conn);
                        echo "
                            <tr>
                              <td>{$agent['id_agent']}</td>
                              <td>{$agent['prenom']} {$agent['nom']}</td>
                              <td>{$total_hours} heures</td>
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
