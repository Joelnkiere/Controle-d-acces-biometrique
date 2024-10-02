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

<!-- Modal de modification -->
<!-- Modal de modification -->
<!--<div class="modal fade" id="modifier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier l'agent</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="modifier_form">
          <input type="hidden" class="empid" name="empid">
          
          <div class="form-group">
            <label for="modifier_prenom">Prénom</label>
            <input type="text" class="form-control" id="modifier_prenom" name="modifier_prenom" required>
          </div>
          
          <div class="form-group">
            <label for="modifier_nom">Nom</label>
            <input type="text" class="form-control" id="modifier_nom" name="modifier_nom" required>
          </div>
          
          <div class="form-group">
            <label for="modifier_adresse">Adresse</label>
            <input type="text" class="form-control" id="modifier_adresse" name="modifier_adresse" required>
          </div>
          
          <div class="form-group">
            <label for="modifier_date">Date de naissance</label>
            <input type="date" class="form-control" id="modifier_date" name="modifier_date" required>
          </div>
          
          <div class="form-group">
            <label for="modifier_telephone">Téléphone</label>
            <input type="text" class="form-control" id="modifier_telephone" name="modifier_telephone" required>
          </div>
          
          <div class="form-group">
            <label for="sexe_val">Sexe</label>
            <select class="form-control" name="sexe" id="modifier_sexe">
                        <option selected id="sexe_val"></option>
                        <option value="M">Homme</option>
                        <option value="F">Femme</option>
                      </select>
          </div>
          
          <div class="form-group">
            <label for="direction_val">Direction</label>
            <select class="form-control" name="direction" id="modifier_direction" required>
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
          
          <div class="form-group">
            <label for="service_val">Service</label>
            <select class="form-control" name="service" id="modifier_service" required>
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
          
          <div class="form-group">
            <label for="horaire_val">Horaire</label>
            <select class="form-control" id="modifier_horaire" name="horaire" required>
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
          
          <div class="form-group">
            <label for="modifier_photo">Photo</label>
            <input type="file" class="form-control" id="modifier_photo" name="modifier_photo">
            <small class="form-text text-muted">Choisissez une nouvelle photo si nécessaire.</small>
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" name="modifier" class="btn btn-primary" form="modifier_form">Modifier</button>
      </div>
    </div>
  </div>
</div>-->



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
