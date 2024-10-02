
<?php
if(trim(isset ($_POST['agent'])&& !empty($_POST['agent']))){
    $affichage = array('error'=>false);

    include 'conn.php';
    include 'timezone.php';

    $agent = $_POST['agent'];
    $status = $_POST['status'];

    $req = "SELECT * FROM agent WHERE id_agent = '$agent'";
    $query = $conn->query($req);

    if($query->num_rows > 0){
        $ligne = $query->fetch_assoc();
        $id = $ligne['id'];

        $date_actuelle = date('Y-m-d');

        if($status == 'entrée'){
            $req = "SELECT * FROM presence WHERE id_agent = '$id' AND date = '$date_actuelle' AND heure_entree IS NOT NULL";
            $query = $conn->query($req);
            if($query->num_rows > 0){
                $affichage['error'] = true;
                $affichage['message_code'] = 'already_in'; // Nouveau code pour déjà enregistré
                $affichage['message'] = 'Vous avez déjà enregistré votre arrivée aujourd\'hui.';
            }
            else{
                // updates
                $horaireAgent = $ligne['id_horaire'];
                $heureArrivee = date('H:i:s');
                $req = "SELECT * FROM horaire WHERE id = '$horaireAgent'";
                $squery = $conn->query($req);
                $ligneHoraire = $squery->fetch_assoc();
                $logstatus = ($heureArrivee > $ligneHoraire['heure_entree']) ? 0 : 1;
                
                $req = "INSERT INTO presence (id_agent, date, heure_entree, status) VALUES ('$id', '$date_actuelle', NOW(), '$logstatus')";
                if($conn->query($req)){
                    $affichage['message_code'] = 'success'; // Nouveau code pour succès
                    $affichage['message'] = 'Accès autorisé Pour: '.$ligne['prenom'].' '.$ligne['nom'];
                }
                else{
                    $affichage['error'] = true;
                    $affichage['message'] = $conn->error;
                }
            }
        }
        else{
            $req = "SELECT *, presence.id AS UnAgent FROM presence LEFT JOIN agent ON agent.id=presence.id_agent WHERE presence.id_agent = '$id' AND date = '$date_actuelle'";
            $query = $conn->query($req);
            if($query->num_rows < 1){
                $affichage['error'] = true;
                $affichage['message_code'] = 'error'; // Nouveau code pour erreur
                $affichage['message'] = 'Impossible d\'enregistrer le départ. Aucun enregistrement d\'arrivée trouvé.';
            }
            else{
                $ligne = $query->fetch_assoc();
                if($ligne['heure_sortie'] != '00:00:00'){
                    $affichage['error'] = true;
                    $affichage['message_code'] = 'error'; // Nouveau code pour erreur
                    $affichage['message'] = 'Vous avez déjà enregistré votre départ aujourd\'hui.';
                }
                else{
                    $req = "UPDATE presence SET heure_sortie = NOW() WHERE id = '".$ligne['UnAgent']."'";
                    if($conn->query($req)){
                        $affichage['message_code'] = 'time_out'; // Nouveau code pour sortie autorisée
                        $affichage['message'] = 'Sortie Autorisée Pour: '.$ligne['prenom'].' '.$ligne['nom'];
                        $req = "SELECT * FROM presence WHERE id = '".$ligne['UnAgent']."'";
                        $query = $conn->query($req);
                        $ligneAgent = $query->fetch_assoc();

                        $heure_entree = $ligneAgent['heure_entree'];
                        $heure_sortie = $ligneAgent['heure_sortie'];

                        $req = "SELECT * FROM agent LEFT JOIN horaire ON horaire.id=agent.id_horaire WHERE agent.id = '$id'";
                        $query = $conn->query($req);
                        $ligneHoraire = $query->fetch_assoc();

                        if($ligneHoraire['heure_entree'] > $ligneAgent['heure_entree']){
                            $heure_entree = $ligneHoraire['heure_entree'];
                        }

                        if($ligneHoraire['heure_sortie'] < $ligneAgent['heure_entree']){
                            $heure_sortie = $ligneHoraire['heure_sortie'];
                        }

                        $heure_entree = new DateTime($heure_entree);
                        $heure_sortie = new DateTime($heure_sortie);
                        $interval = $heure_entree->diff($heure_sortie);
                        $heure = $interval->format('%h');
                        $minutes = $interval->format('%i');
                        $minutes = $minutes/60;
                        $int = $heure + $minutes;
                        if($int > 4){
                            $int = $int - 1;
                        }

                        $req = "UPDATE presence SET nombre_heure = '$int' WHERE id = '".$ligne['UnAgent']."'";
                        $conn->query($req);
                    }
                    else{
                        $affichage['error'] = true;
                        $affichage['message'] = $conn->error;
                    }
                }
            }
        }
    }
    else{
        $affichage['error'] = true;
        $affichage['message_code'] = 'error'; // Nouveau code pour erreur
        $affichage['message'] = 'ID employé non trouvé.';
    }
}

echo json_encode($affichage);
?>