<html lang>
<head>
    <title>Afisare Rezultate</title>
    <style>
        table, th, td
        {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<h1>Afisare Rezultate</h1>
<?php
$p_col1=$_POST['p_col1'];
$p_col1=trim($p_col1);
$p_col2=$_POST['p_col2'];
$p_col2=trim($p_col2);


if (!$p_col1 OR !$p_col2)
{
    echo 'Nu ati introdus criteriul de cautare. Va rog sa incercati din nou.';
    exit;
}

$user = 'student';
$pass = 'student123';
$host = 'localhost';
$db_name = 'nave';
$connect = mysqli_connect($host, $user, $pass, $db_name);

// se verifică dacă a funcţionat conectarea
if ($connect->connect_error) {
    die('Eroare la conectare: ' . $connect->connect_error);
}

// se emite interogarea
//$query = "SELECT c1.tara AS tara1, c2.tara AS tara2 FROM clase c1 JOIN clase c2 ON (c1.clasa > c2.clasa) WHERE c1.".$p_col1."=c2.".$p_col1." AND c1.".$p_col2."=c2.".$p_col2;
$query = "CALL `4b`($p_col1, $p_col2)";
$result = mysqli_query($connect, $query);

// verifică dacă rezultatul este în regulă
if (!$result) {
    die('Interogare gresita: ' . mysqli_error($connect));
}

// se obţine numărul tuplelor returnate
$num_results = mysqli_num_rows($result);

// se afişează fiecare tuplă returnată
echo '<table style="width:100%">
  <tr>
    <th>Nr.crt.</th>
	<th>Tara1</th>
    <th>Tara2</th>

  </tr>';
for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_assoc($result);
    echo '<tr><td>' . ($i + 1) . '</td>';
    echo '<td>' . $row['tara1'] . '</td>';
    echo '<td>' . $row['tara2'] . '</td>';
}
echo '</table>';
// deconectarea de la BD
mysqli_close($connect);
?>
<br>
<a href="Pagina_principala.html">Inapoi la pagina principala!</a>
</body>
</html>
