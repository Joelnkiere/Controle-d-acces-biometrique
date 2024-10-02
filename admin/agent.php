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
        Liste Agents
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li>Agents</li>
        <li class="active">Liste Agents</li>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead class="thead-dark">
                  <th>#</th>
                  <th>ID Agent</th>
                  <th>Photo</th>
                  <th>Nom</th>
                  <th>Direction</th>
                  <th>Service</th>
                  <th>Action</th>
                 
                </thead>
                <tbody>
                  <?php
                  $numero=0;
                    $sql = "SELECT *, agent.id AS empid FROM agent LEFT JOIN direction ON direction.id=agent.id_direction LEFT JOIN horaire ON horaire.id=agent.id_horaire LEFT JOIN service ON service.id_service=agent.id_service";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $numero+=1;
                      ?>

                        <tr>
                          <td><b><?=$numero;?></b></td>
                          <td><?php echo $row['id_agent']; ?></td>
                          <td><img src="<?php echo (!empty($row['photo']))? '../images/'.$row['photo']:'../images/profile.jpg'; ?>" width="30px" height="30px"> <a href="#edit_photo" data-toggle="modal" class="pull-right photo" data-id="<?php echo $row['empid']; ?>"><span class="fa fa-edit"></span></a></td>
                          <td><?php echo $row['prenom'].' '.$row['nom']; ?></td>
                          <td><?php echo $row['libelle']; ?></td>
                          <td><?php echo $row['nom_service'];?></td>
                          
                          <td>
                            <button class="btn btn-primary btn-sm detail btn-flat"data-id="<?php echo $row['empid'];?>"><i class="fa fa-eye"></i></button>
                            <button class="btn  btn-sm modifier btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm supprimer btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-trash"></i></button>
                          </td>
                        </tr>
                      <?php
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
  <?php include 'includes/modale_agent.php'; ?>
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

  $('.photo').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});


$('.detail').click(function(e){
  e.preventDefault();
  $('#detail').modal('show');
  var id = $(this).data('id');
  getDetails(id);
});

function getDetails(id){
  $.ajax({
    type: 'POST',
    url: 'ligne_agent.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id_agent').html(response.id_agent);
      $('.nom_agent').html(response.nom);
      $('.prenom_agent').html(response.prenom);
      $('.adresse_agent').html(response.adresse);
      $('.date_naissance_agent').html(response.date_naissance);
      $('.telephone_agent').html(response.telephone);
      $('.sexe_agent').html(response.sexe);
      $('.direction_agent').html(response.libelle);
      $('.service_agent').html(response.nom_service);
      $('.horaire_agent').html(response.heure_entree + ' - ' + response.heure_sortie);
      $('.photo_agent').attr('src', '../images/' + response.photo);
    }
  });
}


function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'ligne_agent.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.empid').val(response.empid);
      $('.id_agent').html(response.id_agent);
      $('.del_employee_name').html(response.prenom + ' ' + response.nom);
      $('#employee_name').html(response.prenom + ' ' + response.nom);
      $('#modifier_prenom').val(response.prenom);
      $('#modifier_nom').val(response.nom);
      $('#modifier_adresse').val(response.adresse);
      $('#modifier_date').val(response.date_naissance); // Assurez-vous que la date est au format correct
      $('#modifier_telephone').val(response.telephone);
      $('#sexe_val').val(response.sexe).html(response.sexe);
      $('#direction_val').val(response.id_direction).html(response.libelle);
      $('#service_val').val(response.id_service).html(response.nom_service);
      $('#horaire_val').val(response.id_horaire).html(response.heure_entree + ' - ' + response.heure_sortie);
    }
  });
}

</script>
</body>
</html>
