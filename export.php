<?php 
$connect = mysqli_connect("localhost", "root", "", "bdsona");
$output = '';

if(isset($_POST["submit"]))
{
    $date_MinRes = $_POST['dMinRes'];
    $date_MinRes = trim($date_MinRes);
    
    $date_MaxRes = $_POST['dMaxRes'];
    $date_MaxRes = trim($date_MaxRes);

    $query ="SELECT * FROM users natural join demande natural join reservation natural join vehicule natural join chauffeur where aller_res BETWEEN '$date_MinRes' and '$date_MaxRes' ";

    $result = mysqli_query($connect, $query);
     if(mysqli_num_rows($result) > 0)
     {
        $output .= '
        <table>
        <tr>
            <th>Numero demande</th> 
            <th>Numero reservation</th>
            <th>Nom demandeur</th>
            <th>Prenom demandeur</th>
            <th>Nom vehicule</th>  
            <th>Marque vehicule</th> 
            <th>Immatriculation vehicule</th>
            <th>Nom chauffeur</th>
            <th>Prenom chauffeur</th>
            <th>Date aller</th>
            <th>Date retour</th>
            <th>Kilometrage aller</th>
            <th>Kilometrage retour</th>
            <th>Destination</th>
        </tr>
        ';
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
            <tr>  
                <td>'.$row["id_dmd"].'</td>
                <td>'.$row["id_res"].'</td>
                <td>'.$row["nom"].'</td>
                <td>'.$row["prenom"].'</td>
                <td>'.$row["nom_veh"].'</td>  
                <td>'.$row["mrq_veh"].'</td> 
                <td>'.$row["mat_veh"].'</td>  
                <td>'.$row["nom_chf"].'</td>  
                <td>'.$row["prenom_chf"].'</td>
                <td>'.$row["aller_res"].'</td>  
                <td>'.$row["retour_res"].'</td>
                <td>'.$row["kma_res"].'</td>  
                <td>'.$row["kmr_res"].'</td>
                <td>'.$row["dest_res"].'</td>
            </tr>
            ';
        }
        $output .= '</table>';
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=Réservations.xls');
        echo $output;
     }
}
?>
