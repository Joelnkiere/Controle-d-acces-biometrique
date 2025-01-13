<?php
include 'includes/session.php'; 
include 'includes/header.php'; 
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
        Présences des Agents
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Présences</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Formulaire pour choisir la période -->
      <form method="POST" action="">
        <div class="row">
          <div class="col-md-4">
            <label for="start_date">Date de début</label>
            <input type="date" class="form-control" name="start_date" value="<?= isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d') ?>" required>
          </div>
          <div class="col-md-4">
            <label for="end_date">Date de fin</label>
            <input type="date" class="form-control" name="end_date" value="<?= isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d') ?>" required>
          </div>
          <div class="col-md-4">
            <br>
            <button type="submit" class="btn btn-primary btn-sm btn-flat">Filtrer</button>
          </div>
        </div>
      </form>

      <!-- Table des présences -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th>Date</th>
                  <th>ID Agent</th>
                  <th>Nom Agent</th>
                  <th>Heure Entrée</th>
                  <th>Heure Sortie</th>
                </thead>
                <tbody>
                  <?php
                  // Initialiser les dates de période
                  $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d');
                  $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d');

                  // Requête pour sélectionner les présences dans la période
                  $sql = "SELECT *, agent.id_agent AS empid, presence.id AS attid 
                          FROM presence 
                          LEFT JOIN agent ON agent.id = presence.id_agent 
                          WHERE presence.date BETWEEN '$start_date' AND '$end_date' 
                          ORDER BY presence.date ASC, presence.heure_entree ASC";
                  $query = $conn->query($sql);

                  if ($query->num_rows > 0) {
                      while ($row = $query->fetch_assoc()) {
                          echo "
                              <tr>
                                <td>".date('d M, Y', strtotime($row['date']))."</td>
                                <td>{$row['empid']}</td>
                                <td>{$row['nom']} {$row['prenom']}</td>
                                <td>".date('H:i', strtotime($row['heure_entree']))."</td>
                                <td>".date('H:i', strtotime($row['heure_sortie']))."</td>
                              </tr>
                          ";
                      }
                  } else {
                      echo "<tr><td colspan='5' class='text-center'>Aucune présence trouvée pour cette période</td></tr>";
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
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'attendance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.heure_entree);
      $('#edit_time_out').val(response.heure_sortie);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.nom+' '+response.prenom);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.nom+' '+response.prenom);
    }
  });
}
</script>
</body>
</html>
