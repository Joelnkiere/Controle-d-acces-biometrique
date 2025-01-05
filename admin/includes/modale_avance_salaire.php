<!-- Add -->
<div class="modal fade" id="ajouter">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Ajouter une avance de salaire</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="ajout_avance_salaire.php">
          		  
				<div class="form-group">
                    <label for="agent" class="col-sm-3 control-label">Agent</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="agent" id="agent" required>
                        <option value="" selected>- Selectionner -</option>
                        <?php
                          $sql = "SELECT * FROM agent";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            echo "
                              <option value='".$row['id_agent']."'>".$row['nom']." ".$row['prenom']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
				
                <div class="form-group">
                    <label for="montant" class="col-sm-3 control-label">Montant</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="montant" name="montant" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="ajouter"><i class="fa fa-save"></i> Enregistrer</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="modifier">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="date"></span> - <span class="nom_agent"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="modifier_avance_salaire.php">
            		<input type="hidden" class="caid" name="id">
                <div class="form-group">
                    <label for="modifier_montant" class="col-sm-3 control-label">Montant</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="modifier_montant" name="montant" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
            	<button type="submit" class="btn btn-success btn-flat" name="modifier"><i class="fa fa-check-square-o"></i> Update</button>
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
            	<h4 class="modal-title"><b><span class="date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="supprimer_avance_salaire.php">
            		<input type="hidden" class="caid" name="id">
            		<div class="text-center">
	                	<p>ANNULER L'AVANCE SUR SALAIRE</p>
	                	<h2 class="nom_agent bold"></h2>
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


     