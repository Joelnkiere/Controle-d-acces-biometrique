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
        Horaire
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li>Agent</li>
        <li class="active">Horaire</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Erreur de l'operation!</h4>
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
              <a href="impression_horaire.php" class="btn btn-primary btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Imprimer</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>ID Agent</th>
                  <th>Nom</th>
                  <th>Horaire</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, agent.id AS empid FROM agent LEFT JOIN horaire ON horaire.id=agent.id_horaire";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td>".$row['id_agent']."</td>
                          <td>".$row['nom'].' '.$row['prenom']."</td>
                          <td>".date('h:i A', strtotime($row['heure_entree'])).' - '.date('h:i A', strtotime($row['heure_sortie']))."</td>
                          <td>
                            <button class='btn btn-primary btn-sm modifier btn-flat pull-right' data-id='".$row['empid']."'><i class='fa fa-edit'></i></button>
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
  <?php include 'includes/modale_horaire_agent.php'; ?>
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
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'line_horaire_agent.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.nom_agent').html(response.nom+' '+response.prenom);
      $('#horaire_val').val(response.id_horaire);
      $('#horaire_val').html(response.heure_entree+' '+response.heure_sortie);
      $('#empid').val(response.empid);
    }
  });
}
</script>
</body>
</html>
