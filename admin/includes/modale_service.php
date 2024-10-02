<!-- Add -->
<div class="modal fade" id="ajouter">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Ajouter un service</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="ajout_service.php">
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
                  	<label for="nom_service" class="col-sm-3 control-label">Service</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="nom_service" name="nom_service" required>
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
            	<h4 class="modal-title"><b>Modifier le Service</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="modifier_service.php">
            		<input type="hidden" id="serviceid" name="id">
                    <div class="form-group">
                    <label for="modifier_service" class="col-sm-3 control-label">Service</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="modifier_service" name="nom_service" required>
                    </div>
                </div>
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
            	<form class="form-horizontal" method="POST" action="supprimer_service.php">
            		<input type="hidden" id="supprimer_id" name="id">
            		<div class="text-center">
	                	<p>SUPPRIMER LE SERVICE</p>
	                	<h2 id="supprimer_service" class="bold"></h2>
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
    var id_service = $(this).data('id_service');
    getRow(id_service);
    console.log("Modifier clicked for ID:", id_service); // Ajoutez ceci
});
$('.supprimer').click(function(e){
    e.preventDefault();
    $('#supprimer').modal('show');
    var id_service = $(this).data('id_service');
    getRow(id_service);
    console.log("Supprimer clicked for ID:", id_service); // Ajoutez ceci
});

    </script> 