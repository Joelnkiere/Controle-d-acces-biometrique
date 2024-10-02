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
        Les Services
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Accueil</a></li>
        <li class="active">Direction</li>
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
            <div class="box-header with-border">
              <a href="#ajouter" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Ajouter</a>
            </div>
            <div class="box-body">
              <table id_service="example1" class="table table-bordered table-striped">
                <thead>
                  <th><b>#</b></th>
                  <th>Service</th>
                  <th>Direction</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
                  $numero=0;
                    $sql = "SELECT *,direction.libelle FROM service INNER JOIN direction on service.id_direction=direction.id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $numero+=1;
                      echo "
                        <tr>
                        <td>".$numero."</td>
                          <td>".$row['nom_service']."</td> 
                          <td>".$row['libelle']."</td>
                         <td>
    <button class='btn btn-primary btn-sm modifier btn-flat pull-right' data-id_service='".$row['id_service']."'><i class='fa fa-edit'></i></button>
    <button class='btn btn-danger btn-sm supprimer btn-flat pull-right' data-id_service='".$row['id_service']."'><i class='fa fa-trash'></i></button>
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
  <?php include 'includes/modale_service.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.modifier').click(function(e){
    e.preventDefault();
    $('#modifier').modal('show');
    var id_service = $(this).data('id_service');
    getRow(id_service);
  });

  $('.supprimer').click(function(e){
    e.preventDefault();
    $('#supprimer').modal('show');
    var id_service = $(this).data('id_service');
    getRow(id_service);
  });
});
function getRow(id_service){
  console.log("ID Service:", id_service); // Vérifiez que l'ID est correct
  $.ajax({
    type: 'POST',
    url: 'ligne_service.php',
    data: {id_service: id_service}, // Assurez-vous que c'est 'id_service'
    dataType: 'json',
    success: function(response){
      console.log("Response:", response); // Vérifiez la réponse
      if(response) { // Vérifiez si la réponse est valide
        $('#serviceid').val(response.id_service);
        $('#modifier_service').val(response.nom_service);
        $('#supprimer_id').val(response.id_service);
        $('#supprimer_service').html(response.nom_service);
        $('#direction_val').val(response.id_direction); // Assurez-vous que cela fonctionne
      } else {
        console.error("No response received or invalid response.");
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error("AJAX Error:", textStatus, errorThrown); // Vérifiez les erreurs AJAX
    }
  });
}


</script>
</body>
</html>
