<html>
    <head>
        <title>CATALOGO PRODOTTI</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" type="text/css" href="../styles/myStyle.css">
    </head>
    <body>

        <h1 class="header">Il nostro catalogo dei prodotti</h1>

        <div class="topnav">
            <ul>
                <li><a href="../home.php">HOME</a></li>
                <li><a href="../pages/chi_siamo.html">CHI SIAMO</a></li>
                <li><a href="../pages/organigramma.html">ORGANIGRAMMA</a></li>
                <li><a href="https://docs.google.com/document/d/1P19mnaMvYSd0aeM-bNHawe6aXZkFh1jB5sdIKbmEBLk/edit?usp=sharing">DIARIO DI BORDO</a></li>
            </ul>
        </div>
        <table>
            <tr>
                <th>Nome</th>
                <th>Linea</th>
                <th>Gusto</th>
                <th>Gassata</th>
                <th>Acquistata</th>
                <th>Calorie</th>
                <th>Collaborazione</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../include/funzioni.inc';
            include '../include/dati.inc';

            foreach ($prodotti as $prodotto) {
                echo "<tr>";
                echo "<td>" . $prodotto['nome'] . "</td>";
                echo "<td>" . $prodotto['linea'] . "</td>";
                echo "<td>" . implode(', ', $prodotto['gusto']) . "</td>";
                echo "<td>" . $prodotto['gassata'] . "</td>";
                echo "<td>" . implode(', ', $prodotto['acquistata']) . "</td>";
                echo "<td>" . $prodotto['calorie'] . "</td>";
                echo "<td>" . $prodotto['collab'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
