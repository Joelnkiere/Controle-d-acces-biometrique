<?php include 'includes/session.php'; ?>
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
        Avance sur salaire
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li>Agent</li>
        <li class="active">Avance sur salaire</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> échec de l'operation!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> operation reussie!</h4>
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
              <a href="#ajouter" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Ajouter</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Date</th>
                  <th>ID Agent</th>
                  <th>Nom</th>
                  <th>Montant</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, avance_salaire.id AS caid, agent.id_agent AS empid FROM avance_salaire LEFT JOIN agent ON agent.id=avance_salaire.id_agent ORDER BY date_avance DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".date('d M, Y', strtotime($row['date_avance']))."</td>
                          <td>".$row['empid']."</td>
                          <td>".$row['nom'].' '.$row['prenom']."</td>
                          <td>".number_format($row['montant'], 2)."</td>
                          <td>
                            <button class='btn btn-primary btn-sm modifier btn-flat pull-right' data-id='".$row['caid']."'><i class='fa fa-edit'></i></button>
                            <button class='btn btn-danger btn-sm supprimer btn-flat pull-right' data-id='".$row['caid']."'><i class='fa fa-trash'></i></button>
                          </td>
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
  <?php include 'includes/modale_avance_salaire.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.modifier').click(function(e){
    e.preventDefault();
    $('#modifier').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.supprimer').click(function(e){
    e.preventDefault();
    $('#supprimer').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'ligne_avance_salaire.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      console.log(response);
      $('.date').html(response.date_avance);
      $('.nom_agent').html(response.nom+' '+response.prenom);
      $('.caid').val(response.caid);
      $('#modifier_montant').val(response.montant);
    }
  });
}
</script>
</body>
</html>
