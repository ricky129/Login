<?php
/* funzione che stampa la testata html
 */

function isAdmin(){
    if($_SESSION['ruolo']  == 'admin')
        echo $string;
    /*else
        echo 'Devi essere admin!';*/
}

function stampa_head($titolo, $css, $classebody = '') {
    echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\">
        <title>$titolo</title>";
    if (!empty($css))
        echo "<link rel=\"stylesheet\" href=\"$css\">";

    echo "
    </head>
    <body class = \"$classebody\">";
}

//ho splittato le due funzioni perché nell'index non serve a nulla torna_home_page()   
function stampa_finehtml() {
    echo "</body></html>";
}

function include_script($script) {
    echo "<script src='$script'></script>";
}

function torna_home_page() {
    echo "<div><a href = \"index.php\">TORNA ALL'INDICE</a></div>";
}

//array: gusti, classi
function stampa_prodotti($prodotti) {
    echo "<link rel=\"stylesheet\" href=\"./styles/myStyle.css\">";
    $method = $_SERVER['REQUEST_METHOD'];
    echo "<table border = 1 align = \"center\"><tr><th>N.</th><th>NOME</th><th>LINEA</th><th>GUSTO</th><th>TIPO MISCELA</th><th>ACQUISTATA DA</th><th>CALORIE</th><th>COLLABORAZIONE</th>";
    if ($_SESSION['ruolo'] == 'admin'){echo "<th>IMMAGINE PRODOTTO</th></tr>";}
    else
        echo '</tr>';
    $n = 0;

    foreach ($prodotti as $i => $info_prodotto) {
        $n++;
        echo "<tr><td>$n</td>";
        echo "<td>$info_prodotto[nome]</td>"
        . "<td class=\"link\"><a href = \"cercaProdotti.php?linea=$info_prodotto[linea]\" >$info_prodotto[linea]</a></td>";

        $gusto = $info_prodotto['gusto'];
        $stringa_gusto = '';
        for ($j = 0; $j < count($gusto); $j++) {
            if ($j != count($gusto) - 1) {
                $stringa_gusto .= "$gusto[$j], ";
            } else {
                $stringa_gusto .= "$gusto[$j]";
            }
        }//gestione del gusto (array interno)
        echo"<td>$stringa_gusto</td>" .
                "<td class=\"link\"><a href = \"cercaProdotti.php?gassata=$info_prodotto[gassata]\" >$info_prodotto[gassata]</a></td>";
        $classi = $info_prodotto['acquistata'];
        $stringa_classi = '';
        for ($j = 0; $j < count($classi); $j++) {
            if ($j != count($classi) - 1) {
                $stringa_classi .= "$classi[$j], ";
            } else {
                $stringa_classi .= "$classi[$j]";
            }
        }//gestione delle classi (array interno)

        
        echo "<td>$stringa_classi</td>"
        . "<td>$info_prodotto[calorie]</td>"
        . "<td>$info_prodotto[collab]</td>";
        if (!file_exists("images\\" . $info_prodotto['nome'] . ".jpg")) {
            if ($method == 'POST') {
                echo "<td><form method = \"post\" action = \"caricaImmagine.php\"  enctype=\"multipart/form-data\">
                    <input type = \"hidden\" name = \"indice\" value = \"$info_prodotto[indice]\"  accept=\"image/*\"/>
                    <input type = \"file\" name= \"fileprodotto\" />
                    <input type = \"submit\" name= \"carica\" value = \"Carica\" />
                    </form>
                    </td>";
            } else {
                echo "<td><form method = \"get\" action = \"caricaImmagine.php\"  enctype=\"multipart/form-data\">
                    <input type = \"hidden\" name = \"indice\" value = \"$info_prodotto[indice]\" accept=\"image/*\"/>
                    <input type = \"file\" name= \"fileprodotto\" />
                    <input type = \"submit\" name= \"carica\" value = \"Carica\" />
                    </form>
                    </td>";
                }
        } else {
            echo "<td><a href = \"dettagliProdotto.php?indice=$info_prodotto[indice]\" >Info Prodotto</a></td>\n";
        }
    }
    
        
//tabella stampata in modo completo
    echo "</table>";
}

function calorie_inferiori($prodotti, $valore_calorie) {
    $risultati = array();

    foreach ($prodotti as $dettaglioProdotto) {
        if (isset($dettaglioProdotto['calorie']) && $dettaglioProdotto['calorie'] <= $valore_calorie) {
            $risultati[] = $dettaglioProdotto;
        }
    }
    
    return $risultati;
}


function stampa_bfdrinks() {
    include './include/funzioni.inc';
    include './include/dati.inc';

    $titolo = 'Home Page BF Drinks';
    $css = './styles/myStyle.css';
    $script = './scripts/controlloErrori.js';
    stampa_head($titolo, $css);
    include_script($script);
    ?>

    <header>
        <div class=".container-home">
            <div class="header">
                <h1>BF Drinks</h1>
            </div>
        </div>


    </header>

    <!--
        Menu di ricerca 
        (chi siamo, organigramma aziendale, catalogo prodotti → linea light e linea strong
    -->
    <div class="topnav">
        <ul>
            <li><a href="./pages/chi_siamo.html">CHI SIAMO</a></li>
            <li><a href="./pages/organigramma.html">ORGANIGRAMMA</a></li>
            <li><a href="pages/catalogo_prodotti.php">CATALOGO PRODOTTI</a></li>
            <li><a href="https://docs.google.com/document/d/1P19mnaMvYSd0aeM-bNHawe6aXZkFh1jB5sdIKbmEBLk/edit?usp=sharing">DIARIO DI BORDO</a></li>
        </ul>
    </div>

    <form id="form1" method="post" action="cercaProdotti.php">
        <div class="container">

            <div class="item">
                <div class="element">
                    <span class="titolo-item">Nome bibita </span><input type="text" name="nome" size="40">
                </div> 

                <div class="element">    
                    <span class="titolo-item">Linea </span>
                    <input type="radio" name="linea" value="light"><label>Light</label>
                    <input type="radio" name="linea" value="strong"><label>Strong</label>
                </div>

                <div class="element">    
                    <span class="titolo-item">Liscia o gassata </span>
                    <input type="radio" name="gassata" value="Liscia"><label>Liscia</label>
                    <input type="radio" name="gassata" value="Gassata"><label>Gassata </label>
                </div>

                <div class="element">    
                    <span class="titolo-item">Gusti </span>
                    <select name='gusto' value='Scegli gusto'>
                        <option value="">Scegli gusto</option>
                        <?php
                        for ($i = 0; $i < count($gusti); $i++) {
                            echo"<option value=\"$gusti[$i]\">$gusti[$i]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="item">
                <div class="element"> 
                    <span class="titolo-item">Acquistata dalla classe</span><br>
                    <?php
                    for ($i = 0; $i < count($classi); $i++) {
                        echo "<input type=\"checkbox\" name=\"acquistata\" value=\"$classi[$i]\"><span>$classi[$i] </span>";
                    }
                    ?>
                </div>

                <div class="element"> 
                    <span class="titolo-item">Calorie </span>
                    <input type="number" id="calorie" name="calorie" oninput="controllaNumero()">
                </div>

                <div class="element"> 
                    <span class="titolo-item">Collaborazioni </span>
                    <select name='collab' value='Scegli collaborazione'>
                        <?php
                        echo "<option value=\"\">Scegli collaborazione</option>";
                        echo "<option value=\"#N/D\">Nessuna</option>"; //aggiunta opzione per i prod senza collab
                        for ($i = 0; $i < count($collab); $i++) {
                            echo"<option value=\"$collab[$i]\">$collab[$i]</option>";
                        }
                        ?>
                </select>
            </div>
        </div>
    </div>
    <div class="button">
        <input type="submit" value="Invio">
        <input type="reset" value="Reset">
    </div>
</form>
<br>


<footer>
    <div id="banner">
        <div class="scrolling-text">
            Dal Belluzzi per il Belluzzi, BF Drinks ti fa stare attento ad ogni lezione!
        </div>
    </div>
</footer>
<?php
}