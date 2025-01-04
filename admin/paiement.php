<?php include 'includes/session.php'; ?>
<?php
  include '../timezone.php';
  $debut = date('m/d/Y');
  $fin = date('m/d/Y', strtotime('-30 day', strtotime($debut)));
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestion de paie
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Gestion de paie</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Erreur!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Succes!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="pull-right">
                <form method="POST" class="form-inline" id="payForm">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $fin.' - '.$debut; ?>">
                  </div>
                  <button type="button" class="btn btn-success btn-sm btn-flat" id="paiement"><span class="glyphicon glyphicon-print"></span> Paiement</button>
                  <button type="button" class="btn btn-primary btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Bulletin de paie</button>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Nom Agent</th>
                  <th>ID Agent</th>
                  <th>Salaire de base</th>
                  <th>Deduction sur salaire</th>
                  <th>Avance sur salaire</th>
                  <th>Net à Payer</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, SUM(montant) as montant_total FROM deduction_salaire";
                    $query = $conn->query($sql);
                    $drow = $query->fetch_assoc();
                    $deduction = $drow['montant_total'];
  
                    
                    $to = date('Y-m-d');
                    $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode(' - ', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }

                    $sql = "SELECT *, SUM(nombre_heure) AS total_hr, presence.id_agent AS empid FROM presence LEFT JOIN agent ON agent.id=presence.id_agent LEFT JOIN poste ON poste.id_poste=agent.id_poste WHERE date BETWEEN '$from' AND '$to' GROUP BY presence.id_agent ORDER BY agent.nom ASC, agent.prenom ASC";

                    $query = $conn->query($sql);
                    $total = 0;
                    while($row = $query->fetch_assoc()){
                      $empid = $row['empid'];
                      
                      $avance = "SELECT *, SUM(montant) AS montant FROM avance_salaire WHERE id_agent='$empid' AND date_avance BETWEEN '$from' AND '$to'";
                      
                      $caquery = $conn->query($avance);
                      $carow = $caquery->fetch_assoc();
                      $avance_salaire = $carow['montant'];

                      $gross = $row['salaire_parHeure'] * $row['total_hr'];
                      $total_deduction = $deduction + $avance_salaire;
                      $net = $gross - $total_deduction;
                      

                      echo "
                        <tr>
                          <td>".$row['nom'].", ".$row['prenom']."</td>
                          <td>".$row['id_agent']."</td>
                          <td>".$row['salaire_parHeure']."</td>
                          <td>".number_format($deduction, 2)."</td>
                          <td>".number_format($avance_salaire, 2)."</td>
                          <td>".number_format($net, 2)."</td>
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

  $("#reservation").on('change', function(){
    var range = encodeURI($(this).val());
    window.location = 'paiement.php?range='+range;
  });

  $('#paiement').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'generer_paiement.php');
    $('#payForm').submit();
  });

  $('#payslip').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'generer_bulletin.php');
    $('#payForm').submit();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'ligne_poste.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#id_poste').val(response.id);
      $('#modifier_titre').val(response.description);
      $('#modifier_salaire').val(response.salaire_parHeure);
      $('#supprimer_id').val(response.id);
      $('#supprimer_poste').html(response.description);
    }
  });
}


</script>
</body>
</html>
