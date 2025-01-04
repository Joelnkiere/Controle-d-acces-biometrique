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
        Deduction sur salaire
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Deduction</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
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
                  <th>Description</th>
                  <th>Montant</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM deduction_salaire";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td>".$row['motif']."</td>
                          <td>".number_format($row['montant'], 2)."</td>
                          <td>
                            <button class='btn btn-primary btn-sm modifier btn-flat pull-right' data-id='".$row['id']."'><i class='fa fa-edit'></i></button>
                            <button class='btn btn-danger btn-sm supprimer btn-flat pull-right' data-id='".$row['id']."'><i class='fa fa-trash'></i></button>
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
  <?php include 'includes/modale_deduction.php'; ?>
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
    url: 'ligne_deduction.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.decid').val(response.id);
      $('#modifier_motif').val(response.motif);
      $('#modifier_montant').val(response.montant);
      $('#supprimer_deduction').html(response.motif);
    }
  });
}
</script>
</body>
</html>
