<!-- Add -->
<div class="modal fade" id="ajouter">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Ajout Agent</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="ajout_agent.php" enctype="multipart/form-data">
          		  <div class="form-group">
                  	<label for="prenom" class="col-sm-3 control-label">Prenom</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="prenom" name="prenom" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="nom" class="col-sm-3 control-label">Nom</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="nom" name="nom" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="adresse" class="col-sm-3 control-label">Adresse</label>

                  	<div class="col-sm-9">
                      <textarea class="form-control" name="adresse" id="adresse"></textarea>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="datepicker_add" class="col-sm-3 control-label">Date de naissance</label>

                  	<div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="date_naissance">
                      </div>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="telephone" class="col-sm-3 control-label">Telephone</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="telephone" name="telephone">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sexe" class="col-sm-3 control-label">Sexe</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="sexe" id="sexe" required>
                        <option value="" selected>- Selectionner -</option>
                        <option value="M">Homme</option>
                        <option value="F">Femmme</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="direction" class="col-sm-3 control-label">Direction</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="direction" id="direction" required>
                        <option value="" selected>- Selectionner -</option>
                        <?php
                          $sql = "SELECT * FROM direction";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['libelle']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="service" class="col-sm-3 control-label">Service</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="service" id="service" required>
                        <option value="" selected>- Selectionner -</option>
                        <?php
                          $sql = "SELECT * FROM service";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option data-direction='".$srow['id_direction']."' value='".$srow['id_service']."'>".$srow['nom_service']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="poste" class="col-sm-3 control-label">Poste</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="poste" id="poste" required>
                        <option value="" selected>- Selectionner -</option>
                        <?php
                          $sql = "SELECT * FROM poste";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id_poste']."'>".$prow['titre']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="horaire" class="col-sm-3 control-label">Horaire</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="horaire" name="horaire" required>
                        
                        <?php
                          $sql = "SELECT * FROM horaire";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['heure_entree'].' - '.$srow['heure_sortie']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" name="photo" id="photo">
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="enregistrer"><i class="fa fa-save"></i> Enregistrer</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

 
<div class="modal fade" id="modifier">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="id_agent"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="modifier_agent.php">
            		<input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="modifier_prenom" class="col-sm-3 control-label">prenom</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="modifier_prenom" name="prenom">
                    </div>
                </div>
                <div class="form-group">
                    <label for="modifier_nom" class="col-sm-3 control-label">Nom</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="modifier_nom" name="nom">
                    </div>
                </div>
                <div class="form-group">
                    <label for="modifier_adresse" class="col-sm-3 control-label">Adresse</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="adresse" id="modifier_adresse"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="modifier_date" class="col-sm-3 control-label">Date Naissance</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="date" class="form-control" id="modifier_date" name="date_naissance">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="modifier_telephone" class="col-sm-3 control-label">Telephone</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="modifier_telephone" name="telephone">
                    </div>
                </div>
                <div class="form-group">
                    <label for="modifier_sexe" class="col-sm-3 control-label">Sexe</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="sexe" id="modifier_sexe">
                        <option selected id="sexe_val"></option>
                        <option value="M">Homme</option>
                        <option value="F">Femme</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="modifier_direction" class="col-sm-3 control-label">Direction</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="direction" id="modifier_direction">
                        <option selected id="direction_val"></option>
                        <?php
                          $sql = "SELECT * FROM direction";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['libelle']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="modifier_service" class="col-sm-3 control-label">Service</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="service" id="modifier_service">
                        <option selected id="service_val"></option>
                        <?php
                          $sql = "SELECT * FROM service";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option data-direction='".$srow['id_direction']."' value='".$srow['id_service']."'>".$srow['nom_service']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="modifier_poste" class="col-sm-3 control-label">Poste</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="poste" id="modifier_poste">
                        <option selected id="poste_val"></option>
                        <?php
                          $sql = "SELECT * FROM poste";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id_poste']."'>".$prow['titre']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="modifier_horaire" class="col-sm-3 control-label">Horaire</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="modifier_horaire" name="horaire">
                        <option selected id="horaire_val"></option>
                        <?php
                          $sql = "SELECT * FROM horaire";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['heure_entree'].' - '.$srow['heure_sortie']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
            	<button type="submit" class="btn btn-success btn-flat" name="modifier"><i class="fa fa-check-square-o"></i>Modifier</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="supprimer">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="id_agent"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="supprimer_agent.php">
            		<input type="hidden" class="empid" name="id">
            		<div class="text-center">
	                	<p>Voulez-vous supprimez definitivement?</p>
	                	<h2 class="bold del_employee_name"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="supprimer"><i class="fa fa-trash"></i> Supprimer</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="del_employee_name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="modifier_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Modifier</button>
              </form>
            </div>
        </div>
    </div>
</div>  

<!-- detail -->
 <!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Détails de l'agent</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <img src="" alt="Photo de l'agent" class="img-thumbnail photo_agent rounded-circle" width="150" height="150">
          </div>
          <div class="col-md-8">
            <p><strong>ID Agent:</strong> <span class="id_agent"></span></p>
            <p><strong>Nom:</strong> <span class="nom_agent"></span></p>
            <p><strong>Prénom:</strong> <span class="prenom_agent"></span></p>
            <p><strong>Adresse:</strong> <span class="adresse_agent"></span></p>
            <p><strong>Date de naissance:</strong> <span class="date_naissance_agent"></span></p>
            <p><strong>Téléphone:</strong> <span class="telephone_agent"></span></p>
            <p><strong>Sexe:</strong> <span class="sexe_agent"></span></p>
            <p><strong>Direction:</strong> <span class="direction_agent"></span></p>   
            <p><strong>Service:</strong> <span class="service_agent"></span></p>
            <p><strong>Poste:</strong> <span class="poste_agent"></span></p>
            <p><strong>Horaire:</strong> <span class="horaire_agent"></span></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
<style>
.rounded-circle {
  border-radius: 50%;
}

.modal-body p {
  font-size: 1.2em; /* Augmente la taille de la police */
}

</style>

<!-- Modal pour imprimer la carte -->
<div id="printCardModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document"> <!-- Modal large -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Impression de la Carte de Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #F2F5FA; padding: 5;">
                <!-- Ajout d'un max-width et max-height pour que la carte ne dépasse pas le modal -->
                <div id="cardContent" style="width: 100%; max-width: 600px; height: 100%; max-height: 350px; poste: relative; background-color: white; margin: 0 auto; border: 1px solid #ccc;">

                    <!-- Bandeau supérieur avec le logo et l'en-tête -->
                    <div style="background-color: #1E4597; color: white; padding: 10px; text-align: center;">
                        <img src="../images/logo.png" alt="Logo Alpha-Romeo" style="width: 80px; vertical-align: middle;">
                        <h2 style="display: inline-block; margin-left: 10px;">BANQUE CENTRALE DU CONGO</h2>
                    </div>

                    <!-- Section principale avec la photo et les informations -->
                    <div style="display: flex; padding: 10px; align-items: center;">
                        <!-- Photo de l'agent -->
                        <div style="flex: 1; text-align: center;">
                            <img id="agentPhoto" src="" alt="Photo Agent" style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #1E4597; margin: 1px;">
                            
                            <!--<canvas id="agentBarcode" style="width: 120px; height: 50px;"></canvas>-->
                            <div id="agentQRCode" style="width: 50px; height: 50px; margin: 1px;"></div>
                        </div>

                        <!-- Informations de l'agent -->
                        <div style="flex: 2;">
                            <h3 style="margin: 0; color: #1E4597; font-weight: bold;"><strong>Matricule: </strong><span class="id_agent"></span></h3>
                            <p style="line-height: 1.2; margin: 2px 0;"><strong>Nom:</strong> <span class="nom_agent"></span></p>
                            
                            <p style="margin: 2px 0; line-height: 1.2;"><strong>Adresse:</strong> <span class="adresse_agent"></span></p>
                            <p style="margin: 2px 0; line-height: 1.2;"><strong>Date de naissance:</strong> <span class="date_naissance_agent"></span></p>
                            <p style="margin: 2px 0; line-height: 1.2;"><strong>Téléphone:</strong> <span class="telephone_agent"></span></p>
                            <p style="margin: 2px 0; line-height: 1.2;"><strong>Sexe:</strong> <span class="sexe_agent"></span></p>
                            <p style="margin: 2px 0; line-height: 1.2;"><strong>Direction:</strong> <span class="direction_agent"></span></p>   
                            <p style="margin: 2px 0; line-height: 1.2;"><strong>Service:</strong> <span class="service_agent"></span></p>
                            <p style="margin: 2px 0; line-height: 1.2;"><strong>Poste:</strong> <span class="poste_agent"></span></p>
                        </div>
                    </div>

                    <!-- Bandeau inférieur avec les informations de contact -->
                    <div style="background-color: #1E4597; color: white; padding: 10px; text-align: center; width: 100%; box-sizing: border-box;">
                        <p style="margin: 0;">Contact: +243 825930444 | Email: aromeoofficiel@gmail.com</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="printCardButton">Imprimer</button>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="empreinte">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><b>Enregistrement de l'empreinte digitale</b></h4>
      </div>
      <div class="modal-body text-center">
        <!-- Zone pour l'empreinte 
        <div class="fingerprint-container">
        <!-- <div id="fingerprint-progress" class="fingerprint"></div> --
          <i class="fa fa-fingerprint fingerprint-icon"></i>
        </div>
        <p id="status" class="text-info mt-3">Placez votre doigt sur le capteur...</p>

        <form class="form-horizontal" method="POST" action="ajout_empreinte.php">
          <input type="hidden" id="empreinte_empid" name="id">

          <div class="form-group">
           
            <div class="col-sm-9">
            <input type="hidden" id="fingerprint-data" name="empreinte" value="">
            </div>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
        <button type="submit" class="btn btn-primary btn-flat" id="save-fingerprint" name="enregistrer"><i class="fa fa-save"></i> Enregistrer</button>
      </div>

      
    </div>
  </div>
</div> -->




<!-- Styles pour l'impression afin de conserver le design -->

<div class="modal fade" id="empreinte">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><b>Ajouter une empreinte digitale</b></h4>
      </div>
      <div class="modal-body text-center">
      <div class="fingerprint-container">
        <!-- <div id="fingerprint-progress" class="fingerprint"></div> -->
          <i class="fa fa-fingerprint fingerprint-icon"></i>
        </div>
        <p id="status" class="text-info mt-3">Placez votre doigt sur le capteur...</p>

        <form class="form-horizontal" method="POST" action="ajout_empreinte.php">
          <input type="hidden" id="empreinte_empid" name="id">

          <div class="form-group">
            <label for="empreinte" class="col-sm-3 control-label">Empreinte</label>
            <div class="col-sm-9">
              <input type="hidden" class="form-control" id="empreinte" name="empreinte">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">
          <i class="fa fa-close"></i> Annuler
        </button>
        <button type="submit" class="btn btn-primary btn-flat" name="enregistrer">
          <i class="fa fa-save"></i> Enregistrer
        </button>
      </div>
    </div>
  </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printCardModal, #printCardModal * {
            visibility: visible;
        }
        #printCardModal {
            poste: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #cardContent {
            border: 1px solid #ccc;
            background-color: white;
        }
    }

   

    .fingerprint-container {
  width: 150px;
  height: 150px;
  margin: 20px auto;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 5px solid #003366; /* Cercle bleu */
  border-radius: 50%; /* Cercle parfait */
  background-color: #f5f5f5; /* Fond gris clair */
}

.fingerprint-icon {
  font-size: 80px; /* Taille de l'icône */
  color: #003366; /* Couleur de l'icône */
  animation: pulse 2s infinite; /* Animation pulsante */
}

#status {
  font-size: 16px;
  color: #666;
}

/* Animation pulsante pour simuler une lecture */
@keyframes pulse {
  0% {
    transform: scale(1);
    opacity: 1;
  }
  50% {
    transform: scale(1.1);
    opacity: 0.7;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

</style>
<script>
// $(document).ready(function () {
//   let progress = 0;

//   // Simulation de la progression
//   function startFingerprintScan() {
//     progress = 0;
//     $('#status').text('Placez votre doigt sur le capteur...');
//     $('#fingerprint-progress').removeClass('completed');
//     let interval = setInterval(() => {
//       progress += 10; // Augmente la progression par 10%

//       if (progress >= 100) {
//         clearInterval(interval);
//         $('#fingerprint-progress').addClass('completed');
//         $('#status').text('Empreinte capturée avec succès!');
//         $('#save-fingerprint').prop('disabled', false);
//       } else {
//         $('#fingerprint-progress').css(
//           'background',
//           `conic-gradient(#003366 ${progress}%, #ccc ${progress}%)`
//         );
//       }
//     }, 500); // Intervalle de 500 ms pour simuler la progression
//   }

//   // Initialisation lors de l'ouverture du modal
//   $('#empreinte').on('show.bs.modal', function () {
//     $('#save-fingerprint').prop('disabled', true); // Désactive le bouton jusqu'à la fin
//     startFingerprintScan();
//   });

//   // Gérer le bouton "Enregistrer"
//   $('#save-fingerprint').click(function () {
//     alert('Empreinte enregistrée!'); // Ajoutez ici la logique d'enregistrement côté serveur
//     $('#empreinte').modal('hide');
//   });
// });

// document.getElementById('save-fingerprint').addEventListener('click', function () {
//   const statusElement = document.getElementById('status');
//   const fingerprintIcon = document.querySelector('.fingerprint-icon');

//   // Simuler un processus d'enregistrement avec un délai
//   statusElement.textContent = 'Enregistrement en cours...';
//   statusElement.classList.remove('text-info');
//   statusElement.classList.add('text-warning');

//   setTimeout(() => {
//     statusElement.textContent = 'Empreinte enregistrée avec succès !';
//     statusElement.classList.remove('text-warning');
//     statusElement.classList.add('text-success');

//     fingerprintIcon.style.color = 'green'; // Changer la couleur de l'icône pour indiquer la réussite
//     fingerprintIcon.style.animation = 'none'; // Arrêter l'animation
//   }, 3000); // Simule un délai de 3 secondes
// });

document.getElementById('save-fingerprint').addEventListener('click', function () {
  const statusElement = document.getElementById('status');
  const fingerprintIcon = document.querySelector('.fingerprint-icon');
  const fingerprintInput = document.getElementById('fingerprint-data');

  // Simuler un processus d'enregistrement
  statusElement.textContent = 'Enregistrement en cours...';
  statusElement.classList.remove('text-info');
  statusElement.classList.add('text-warning');

  setTimeout(() => {
    // Simuler une empreinte générée
    const fingerprintSample = 'empreinte123456'; // Exemple d'empreinte générée

    // Mettre à jour le champ invisible avec l'empreinte
    fingerprintInput.value = fingerprintSample;

    // Mise à jour du statut
    statusElement.textContent = 'Empreinte enregistrée avec succès !';
    statusElement.classList.remove('text-warning');
    statusElement.classList.add('text-success');

    // Indiquer la réussite visuellement
    fingerprintIcon.style.color = 'green';
    fingerprintIcon.style.animation = 'none';
  }, 3000); // Délai de simulation de 3 secondes
});


</script>