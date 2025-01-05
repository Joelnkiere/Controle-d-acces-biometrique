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

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Bulletin de paie: '.$from_title.' - '.$to_title);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage(); 
    $contents = '';

	$sql = "SELECT *, SUM(nombre_heure) AS total_hr, presence.id_agent AS empid, agent.id_agent AS agent FROM presence LEFT JOIN agent ON agent.id=presence.id_agent LEFT JOIN poste ON poste.id=agent.id_poste WHERE date BETWEEN '$from' AND '$to' GROUP BY presence.id_agent ORDER BY agent.nom ASC, agent.prenom ASC";

	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){
		$empid = $row['empid'];
                      
      	$casql = "SELECT *, SUM(montant) AS montant_avance FROM avance_salaire WHERE id_agent='$empid' AND date_avance BETWEEN '$from' AND '$to'";
      
      	$caquery = $conn->query($casql);
      	$carow = $caquery->fetch_assoc();
      	$avance_salaire = $carow['montant_avance'];

		$salaire_bru = $row['salaire_parHeure'] * $row['total_hr'];
		$total_deduction = $deduction_salaire + $avance_salaire;
  		$net = $salaire_bru - $total_deduction;

		$contents .= '
			<h2 align="center">Banque Centrale du Congo</h2>
			<h4 align="center">'.$from_title." - ".$to_title.'</h4>
			<table cellspacing="0" cellpadding="3">  
    	       	<tr>  
            		<td width="25%" align="right">Nom Agent: </td>
                 	<td width="25%"><b>'.$row['prenom']." ".$row['nom'].'</b></td>
				 	<td width="25%" align="right">Salaire par Heure: </td>
                 	<td width="25%" align="right">'.number_format($row['salaire_parHeure'], 2).'</td>
    	    	</tr>
    	    	<tr>
    	    		<td width="25%" align="right">ID Agent: </td>
				 	<td width="25%">'.$row['agent'].'</td>   
				 	<td width="25%" align="right">Total Heures prestées: </td>
				 	<td width="25%" align="right">'.number_format($row['total_hr'], 2).'</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Salaire Brut: </b></td>
				 	<td width="25%" align="right"><b>'.number_format(($row['salaire_parHeure']*$row['total_hr']), 2).'</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">Deduction: </td>
				 	<td width="25%" align="right">'.number_format($deduction_salaire, 2).'</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">Avance Sur Salaire: </td>
				 	<td width="25%" align="right">'.number_format($avance_salaire, 2).'</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Deduction Totale:</b></td>
				 	<td width="25%" align="right"><b>'.number_format($total_deduction, 2).'</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>salaire Net:</b></td>
				 	<td width="25%" align="right"><b>'.number_format($net, 2).'</b></td> 
    	    	</tr>
    	    </table>
    	    <br><hr>
		';
	}
    $pdf->writeHTML($contents);  
    $pdf->Output('bulletion_de_paie.pdf', 'I');

?>