<?php
include_once('connessionedb.php');
$link=connectdb();
$sql1 = "SELECT docmaster.* FROM docmaster";
$result=mysqli_query($link,$sql1);
mysqli_close($link);
?>
<html>
<head>
    <title>Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<h1>Svolgimento punto 1</h1>
<p>Riempi il menù a tendina</p>

<form action="sito.php" method="POST">

    <fieldset>
        <label>Seleziona</label>
        <select id="menu" name="menu" onchange="update()">
            <?php
            $i=0;
            while ($row=mysqli_fetch_array($result)) {
                $val1=$row['CodiceAgente'];
                $val2=$row['NumeroDoc'];
                $val3=$row['DataDoc'];
                $val4=$row['Provenienza'];
                $i=$i+1;
                echo "<option value=$i> Codice Agente: $val1 | Numero Doc: $val2 | Data Doc: $val3 | Provenienza: $val4</option>";
            }
            ?>
        </select>
    </fieldset>

    <!--<input type="hidden" name="cod_agente" value=<?php echo $val1 ?>>
    <input type="hidden" name="numero_doc" value=<?php echo $val2 ?>>
    <input type="hidden" name="data_doc" value=<?php echo $val3 ?>>
    <input type="hidden" name="provenienza" value=<?php echo $val4 ?>>-->

    <input type="submit" value="Salva" />
</form>
</body>
</html>