<?php
include_once('connessionedb.php');
$link=connectdb();
$val=$_POST['menu'];
$sql="SELECT docmaster.* FROM docmaster";
$result=mysqli_query($link,$sql);
$i=1;

while ($row=mysqli_fetch_array($result))
{
    if($i==$val)
    {
        $val1=$row['CodiceAgente'];
        $val2=$row['NumeroDoc'];
        $val3=$row['DataDoc'];
        $val4=$row['Provenienza'];
    }
    $i=$i+1;
}

/*$val1=$_POST['cod_agente'];
$val2=$_POST['numero_doc'];
$val3=$_POST['data_doc'];
$val4=$_POST['provenienza'];*/

$sql1 = "SELECT docnotes.* FROM docnotes WHERE docnotes.CodiceAgente='$val1' AND docnotes.NumeroDoc='$val2' AND docnotes.DataDoc ='$val3' AND docnotes.Provenienza ='$val4'";
$sql2= "SELECT docdetails.* FROM docdetails WHERE docdetails.CodiceAgente='$val1' AND docdetails.NumeroDoc='$val2' AND docdetails.DataDoc ='$val3' AND docdetails.Provenienza ='$val4'";
$result=mysqli_query($link,$sql1);
$result2=mysqli_query($link,$sql2);
mysqli_close($link);
?>

<html>
<head>
    <title>Risultato</title>
    <style>
        table {
            border: 1px solid #000000;
        }
    </style>

</head>
<body>
<h1>Note</h1>
<?php echo $val1," ";echo $val2," ";echo $val3," ";echo $val4; ?>
<table border=1>
    <?php while ($row=mysqli_fetch_array($result)) { ?>
        <tr>
            <td>Nota ordine</td> <td>Indice nota</td>
        </tr>
        <tr>
            <td><?php echo $row['NotaOrdine']; ?></td> <td><?php echo $row['IndiceNota']; ?></td>
        </tr>
    <?php } ?>
</table>
<h1>Dettagli</h1>
<table border=1>
    <tr>
        <td>Codice Articolo</td> <td>Descrizione Prodotto</td>
    </tr>
    <?php while ($row=mysqli_fetch_array($result2)) { ?>
        <tr>
            <td><?php echo $row['CodiceArticolo']; ?></td> <td><?php echo $row['DescrizioneProdotto']; ?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>