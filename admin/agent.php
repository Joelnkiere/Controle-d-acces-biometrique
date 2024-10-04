<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style> </style>
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
        <li class="actif">Liste Agents</li>
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
                          <button class="btn btn-info btn-sm print-card btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-print"></i></button>
                            <button class="btn btn-primary btn-sm detail btn-flat"data-id="<?php echo $row['empid'];?>"><i class="fa fa-eye"></i></button>
                            <button class="btn  btn-sm modifier btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm supprimer btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-trash"></i></button>
                            <button class="btn toggle-status btn-flat <?php echo ($row['status'] == 'actif') ? 'btn-success' : 'btn-danger'; ?>" data-id="<?php echo $row['empid']; ?>" data-status="<?php echo $row['status']; ?>">
        <i class="fa <?php echo ($row['status'] == 'actif') ? 'fa-toggle-on' : 'fa-toggle-off'; ?>"></i>
    </button>
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

$('.toggle-status').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var status = $(this).data('status');
    
    // Changer l'état
    var newStatus = (status == 'actif') ? 'inactif' : 'actif';
    
    $.ajax({
        type: 'POST',
        url: 'toggle_agent_status.php', // Le fichier PHP qui gère la mise à jour
        data: {id: id, status: newStatus},
        dataType: 'json',
        success: function(response){
            if(response.success){
                // Mettre à jour l'icône et le statut du bouton
                if(newStatus == 'actif'){
                    $('.toggle-status[data-id="'+id+'"] i').removeClass('fa-toggle-off').addClass('fa-toggle-on');
                    $('.toggle-status[data-id="'+id+'"]').data('status', 'actif');
                    $('.toggle-status[data-id="'+id+'"]').removeClass('btn-danger').addClass('btn-success'); // Changer la couleur en vert
                } else {
                    $('.toggle-status[data-id="'+id+'"] i').removeClass('fa-toggle-on').addClass('fa-toggle-off');
                    $('.toggle-status[data-id="'+id+'"]').data('status', 'inactif');
                    $('.toggle-status[data-id="'+id+'"]').removeClass('btn-success').addClass('btn-danger'); // Changer la couleur en rouge
                }
            } else {
                alert('Erreur lors de la mise à jour du statut.');
            }
        }
    });
});


</script>





<script src="../bower_components/moment/qrcode.js"></script> <!-- Le fichier que tu auras téléchargé -->



<script>
     
    function generateQRCode(agentData) {
        // Convertir les informations de l'agent en chaîne JSON
        const agentInfo = JSON.stringify({
          id: agentData.id_agent,
            nom: agentData.nom,
            prenom: agentData.prenom,
            adresse: agentData.adresse,
            telephone: agentData.telephone_agent,
            sexe: agentData.sexe_agent,
            direction: agentData.direction_agent,
            service: agentData.service_agent,
            date_naissance: agentData.date_naissance_agent
            
        });

        // Générer le QR code dans le div "agentQRCode"
        new QRCode(document.getElementById("agentQRCode"), {
            text: agentInfo,
            width: 70,
            height: 70
        });
    }

    $('.print-card').click(function(e){
        e.preventDefault();
        var id = $(this).data('id');

        // Récupérer les détails de l'agent
        $.ajax({
            type: 'POST',
            url: 'ligne_agent.php',
            data: {id: id},
            dataType: 'json',
            success: function(response){
              $('#agentPhoto').attr('src', '../images/' + response.photo);
                $('.id_agent').html(response.id_agent);
                $('.nom_agent').html(response.nom +' '+ response.prenom);
                $('.adresse_agent').html(response.adresse);
                $('.date_naissance_agent').html(response.date_naissance);
                $('.telephone_agent').html(response.telephone);
                $('.sexe_agent').html(response.sexe);
                $('.direction_agent').html(response.libelle);
                $('.service_agent').html(response.nom_service);
                $('.horaire_agent').html(response.heure_entree + ' - ' + response.heure_sortie);

                // Générer le QR code avec toutes les informations de l'agent
                generateQRCode(response);

                // Afficher le modal
                $('#printCardModal').modal('show');
            }
        });
    });

    // Fonction pour imprimer la carte
    $('#printCardButton').click(function(){
        var printContents = document.getElementById('cardContent').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    });
</script>
</body>
</html>
