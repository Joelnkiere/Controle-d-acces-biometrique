<?php
include 'includes/session.php';

$range = $_POST['date_range'];
$ex = explode(' - ', $range);
$from = date('Y-m-d', strtotime($ex[0]));
$to = date('Y-m-d', strtotime($ex[1]));

$sql = "SELECT *, SUM(montant) as montant_total FROM deduction_salaire";
$query = $conn->query($sql);
$drow = $query->fetch_assoc();
$deduction_salaire = $drow['montant_total'];

$from_title = date('d/m/Y', strtotime($ex[0]));
$to_title = date('d/m/Y', strtotime($ex[1]));
$month_year = date('F Y', strtotime($ex[0])); // Mois et année de la période de paie

require_once('../tcpdf/tcpdf.php');  
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
$pdf->SetCreator(PDF_CREATOR);  
$pdf->SetTitle('Bulletin de paie: '.$from_title.' - '.$to_title);  
$pdf->SetHeaderData('', '', '', '');  
$pdf->setPrintHeader(false);  
$pdf->setPrintFooter(false);  
$pdf->SetMargins(15, 20, 15);  
$pdf->SetAutoPageBreak(TRUE, 10);  
$pdf->SetFont('helvetica', '', 10);

$sql = "SELECT *, SUM(nombre_heure) AS total_hr, presence.id_agent AS empid, agent.id_agent AS agent 
        FROM presence 
        LEFT JOIN agent ON agent.id=presence.id_agent 
        LEFT JOIN poste ON poste.id_poste=agent.id_poste 
        WHERE date BETWEEN '$from' AND '$to' 
        GROUP BY presence.id_agent 
        ORDER BY agent.nom ASC, agent.prenom ASC";

$query = $conn->query($sql);
while ($row = $query->fetch_assoc()) {
    $pdf->AddPage();

    $empid = $row['empid'];

    // Récupération des détails des avances sur salaire
    $avance_details = '';
    $avance_total = 0;

    $avance_sql = "SELECT * FROM avance_salaire WHERE id_agent='$empid' AND date_avance BETWEEN '$from' AND '$to'";
    $avance_query = $conn->query($avance_sql);
    while ($avance = $avance_query->fetch_assoc()) {
        $avance_details .= '
            <tr>
                <td>'.$avance['date_avance'].'</td>
                <td>'.number_format($avance['montant'], 2).' CDF</td>
                <td>'.number_format($avance['montant'] / 2850, 2).' USD</td>
            </tr>';
        $avance_total += $avance['montant'];
    }

    // Déductions détaillées
    $deductions_details = '';
    $deduction_total = 0;

    $deductions_sql = "SELECT * FROM deduction_salaire";
    $deductions_query = $conn->query($deductions_sql);
    while ($deduction = $deductions_query->fetch_assoc()) {
        $deductions_details .= '
            <tr>
                <td>'.$deduction['motif'].'</td>
                <td>'.number_format($deduction['montant'], 2).' CDF</td>
                <td>'.number_format($deduction['montant'] / 2850, 2).' USD</td>
            </tr>';
        $deduction_total += $deduction['montant'];
    }

    // Calculs salariaux
	$salaire_base=$row['salaire_parHeure'];
	$salaire_bru = $row['salaire_parHeure'] * $row['total_hr'];
    $total_deduction = $deduction_salaire + $avance_total;
    $net = $salaire_bru - $total_deduction;

    // Contenu du bulletin
    $contents = '
        <style>
            .header-table { font-size: 10px; }
            .details-table { font-size: 10px; margin-bottom: 20px; }
            .salary-table { font-size: 10px; border-collapse: collapse; }
            .salary-table th, .salary-table td { border: 1px solid #000; padding: 5px; }
            h3 { font-size: 12px; text-align: center; }
        </style>
        <table class="header-table" cellpadding="3">
            <tr>
                <td width="30%"><img src="../images/logo.png" width="70"></td>
                <td width="70%" align="center">
                    <h3>BANQUE CENTRALE DU CONGO<br>
                    DIRECTION DES RESSOURCES HUMAINES<br>
                    BULLETIN DE PAIE</h3>
                </td>
            </tr>
        </table>
        <h3>PÉRIODE DE PAIE : '.$from_title.' AU '.$to_title.'</h3>
        <table class="details-table">
            <tr>
                <td width="25%"><b>ID Personnel :</b></td>
                <td width="25%">'.$row['empid'].'</td>
                <td width="25%"><b>Nom et Prénom :</b></td>
                <td width="25%">'.$row['nom'].' '.$row['prenom'].'</td>
            </tr>
            <tr>
                <td><b>Poste :</b></td>
                <td>'.$row['titre'].'</td>
                <td><b>Matricule :</b></td>
                <td>'.$row['id_agent'].'</td>
            </tr>
            <tr>
                <td><b>Situation Familiale :</b></td>
                <td>Célibataire</td>
                <td><b>Sexe :</b></td>
                <td>Masculin</td>
            </tr>
        </table>
        <h3>DETAILS DES HEURES PRESTÉES</h3>
        <table class="salary-table">
            <tr>
                <th width="25%"><b>Libellé</b></th>
                <th width="25%"><b>Nombre d\'heures</b></th>
                <th width="25%"><b>Montant (CDF)</b></th>
				<th width="25%"><b>Montant (USD)</b></th>
            </tr>
			<tr>
                <td>Salaire par Heure</td>
                <td>1 Heure</td>
				<td>'.number_format($salaire_base, 2).' CDF</td>
                <td>'.number_format($salaire_base / 2850, 2).' USD</td>
            </tr>
			<tr>
                <td>Heures travaillées</td>
                <td>'.$row['total_hr'].'</td>
                <td>'.number_format($row['total_hr']* $salaire_base, 2).' CDF</td>
				<td>'.number_format($row['total_hr']* $salaire_base/2850, 2).' USD</td>
            </tr>
			
        </table>
		<h3>AVANCE SUR SALAIRE</h3>
		 <table class="salary-table">
		 <tr>
                <th><b>DATE</b></th>
                <th><b>FRANC CONGOLAIS</b></th>
                <th><b>DOLLARS AMÉRICAINS</b></th>
            </tr>
            '.$avance_details.'
            <tr>
                <td><b>Total des avances</b></td>
                <td><b>'.number_format($avance_total, 2).' CDF</b></td>
                <td><b>'.number_format($avance_total / 2850, 2).' USD</b></td>
            </tr>
        </table>
        
        <h3>DETAILS DES DÉDUCTIONS</h3>
        <table class="salary-table">
            <tr>
                <th width="50%"><b>MOTIF</b></th>
                <th width="25%"><b>FRANC CONGOLAIS</b></th>
                <th width="25%"><b>DOLLARS AMÉRICAINS</b></th>
            </tr>
            '.$deductions_details.'
            <tr>
                <td><b>Total des déductions</b></td>
                <td><b>'.number_format($deduction_total, 2).' CDF</b></td>
                <td><b>'.number_format($deduction_total / 2850, 2).' USD</b></td>
            </tr>
        </table>
        <h3>DETAILS DU SALAIRE</h3>
        <table class="salary-table">
             
            <tr>
                <td><b>Salaire brut</b></td>
                <td><b>'.number_format($salaire_bru, 2).' CDF</b></td>
                <td><b>'.number_format($salaire_bru / 2850, 2).' USD</b></td>
            </tr>
			 <tr>
                <td><b>Net à payer</b></td>
                <td><b>'.number_format($net, 2).' CDF</b></td>
                <td><b>'.number_format($net / 2850, 2).' USD</b></td>
            </tr>
        </table>
       
        <br>
        <p align="right">Fait à Kinshasa, le '.date('d/m/Y').'</p>
        <p align="right">Signature de l\'agent</p>
		<p align="left"><b>NB:</b> 1$ = 2850FC</p>
    ';

    $pdf->writeHTML($contents);
}

$pdf->Output('bulletin_de_paie.pdf', 'I');
?>
