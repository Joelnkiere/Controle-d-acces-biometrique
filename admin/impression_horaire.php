<?php
	include 'includes/session.php';

	function generateRow($conn){
		$contents = '';
		
		$sql = "SELECT *, agent.id AS empid FROM agent LEFT JOIN horaire ON horaire.id=agent.id_horaire";

		$query = $conn->query($sql);
		$total = 0;
		while($row = $query->fetch_assoc()){
			$contents .= "
			<tr>
				<td>".$row['nom'].", ".$row['prenom']."</td>
				<td>".$row['id_agent']."</td>
				<td>".date('h:i A', strtotime($row['heure_entree'])).' - '. date('h:i A', strtotime($row['heure_sortie']))."</td>
			</tr>
			";
		}

		return $contents;
	}

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Horaire Agent - Banque Centrale Du Congo');  
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
    $content = '';  
    $content .= '
      	<h2 align="center">Banque Centrale du Congo</h2>
      	<h4 align="center">Horaire Agent</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th width="40%" align="center"><b>Nom Agent</b></th>
                <th width="30%" align="center"><b>ID Agent</b></th>
				<th width="30%" align="center"><b>Horaire</b></th> 
           </tr>  
      ';  
    $content .= generateRow($conn); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('horaire.pdf', 'I');

?>