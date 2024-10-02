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
        Presence Des Agents
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Accueil</a></li>
        <li class="active">Presence</li>
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
              <h4><i class='icon fa fa-check'></i> opération reussie!</h4>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th style="font-eweigth:bold;">#</th>
                  <th>Date</th>
                  <th>ID Agent</th>
                  <th>Nom</th>
                  <th>Direction</td>
                  <th>HeureEntrée</th>
                  <th>Heure Sortie</th>
                  
                </thead>
                <tbody>
                  <?php
                  $numero=0;
                    $sql = "SELECT *,direction.libelle, agent.id_agent AS empid, presence.id AS attid FROM presence INNER JOIN agent ON agent.id=presence.id_agent INNER JOIN direction on agent.id_direction=direction.id ORDER BY presence.date DESC, presence.heure_entree DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $numero+=1;
                      $status = ($row['status'])?'<span class="label label-success pull-right">Ponctuel</span>':'<span class="label label-danger pull-right">En retard</span>';
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>$numero</td>
                          <td>".date('d-M, Y', strtotime($row['date']))."</td>
                          <td>".$row['empid']."</td>
                          <td>".$row['prenom'].' '.$row['nom']."</td>
                          <td>".$row['libelle']."</td>
                          <td>".date('h:i', strtotime($row['heure_entree'])).$status."</td>
                          <td>".date('h:i', strtotime($row['heure_sortie']))."</td>
                        <!--  <td>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['attid']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['attid']."'><i class='fa fa-trash'></i> Delete</button>
                          </td>-->
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
  <?php include 'includes/attendance_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  moment.local('fr')
  var momentNow = moment();
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
      $('#employee_name').html(response.prenom+' '+response.nom);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.prenom+' '+response.nom);
    }
  });
}
</script>
</body>
</html>
