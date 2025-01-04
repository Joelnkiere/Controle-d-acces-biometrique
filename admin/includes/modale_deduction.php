<!-- Add -->
<div class="modal fade" id="ajouter">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Ajouter une Deduction</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="ajout_deduction.php">
          		  <div class="form-group">
                  	<label for="motif" class="col-sm-3 control-label">Motif</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="motif" name="motif" required>
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
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
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
            	<h4 class="modal-title"><b>Modifier la Deduction</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="modifier_deduction.php">
            		<input type="hidden" class="decid" name="id">
                <div class="form-group">
                    <label for="modifier_motif" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="modifier_motif" name="motif">
                    </div>
                </div>
                <div class="form-group">
                    <label for="modifier_montant" class="col-sm-3 control-label">Montant</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="modifier_montant" name="montant">
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
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
            	<form class="form-horizontal" method="POST" action="supprimer_deduction.php">
            		<input type="hidden" class="decid" name="id">
            		<div class="text-center">
	                	<p>SUPPRIMER LA DEDUCTION</p>
	                	<h2 id="del_deduction" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="supprimer"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


     