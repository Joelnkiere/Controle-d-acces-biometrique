<!-- Edit -->
<div class="modal fade" id="modifier">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="nom_agent"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="modifier_horaire_agent.php">
            		<input type="hidden" id="empid" name="id">
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
            	<button type="submit" class="btn btn-success btn-flat" name="modifier"><i class="fa fa-check-square-o"></i> Modifier</button>
            	</form>
          	</div>
        </div>
    </div>
</div>