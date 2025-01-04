<!-- Add -->
<div class="modal fade" id="ajouter">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Ajouter un poste</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="ajout_poste.php">
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
                  	<label for="nom_poste" class="col-sm-3 control-label">Poste</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="nom_poste" name="nom_poste" required>
                  	</div>
                    
                </div>
                <div class="form-group">
                  	<label for="salaire_parHeure" class="col-sm-3 control-label">Salaire par Heure</label>

                  	<div class="col-sm-9">
                    	<input type="number" class="form-control" id="salaire_parHeure" name="salaire_parHeure" required>
                  	</div>
                    
                </div>
                
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="enregistrer"><i class="fa fa-save"></i> Enregistrer</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<!-- Modal Modifier -->
<div class="modal fade" id="modifier">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Modifier le Poste</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="modifier_poste.php">
            		<input type="hidden" id="serviceid" name="id">
                    
                <div class="form-group">
                    <label for="direction_val" class="col-sm-3 control-label">Direction</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="direction" id="direction_val" required>
                        <option value="" selected>- Sélectionner -</option>
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
                    <label for="modifier_poste" class="col-sm-3 control-label">Poste</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="modifier_poste" name="nom_poste" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="modifier_salaire" class="col-sm-3 control-label">Salaire par Heure</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="modifier_salaire" name="salaire_parHeure" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
            	<button type="submit" class="btn btn-success btn-flat" name="modifier"><i class="fa fa-check-square-o"></i> Modifier</button>
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
            	<h4 class="modal-title"><b>Suppression...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="supprimer_poste.php">
            		<input type="hidden" id="supprimer_id" name="id">
            		<div class="text-center">
	                	<p>SUPPRIMER LE POSTE</p>
	                	<h2 id="supprimer_poste" class="bold"></h2>
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


    <script>

$('.modifier').click(function(e){
    e.preventDefault();
    $('#modifier').modal('show');
    var id_poste = $(this).data('id_poste');
    getRow(id_poste);
    console.log("Modifier clicked for ID:", id_poste); // Ajoutez ceci
});
$('.supprimer').click(function(e){
    e.preventDefault();
    $('#supprimer').modal('show');
    var id_poste = $(this).data('id_poste');
    getRow(id_poste);
    console.log("Supprimer clicked for ID:", id_poste); // Ajoutez ceci
});

    </script> 