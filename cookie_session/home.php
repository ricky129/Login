<?php
include './include/funzioni.inc';
include './include/dati.inc';

$titolo = 'Home Page BF Drinks';
$css = './styles/myStyle.css';
$script = './scripts/controlloErrori.js';
stampa_head($titolo, $css);
include_script($script);

// Inizializza la sessione
session_start(); 
stampa_head($titolo, $css);
// Verifica se il modulo di login è stato inviato
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    // Ottieni le credenziali inserite dall'utente
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    //print_r($utenti[$username]);
     if (isset($utenti[$username]) && ($utenti[$username]['password'] == $password)){
        // Credenziali corrette, autentica l'utente utilizzando una variabile di sessione
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['nome'] = $utenti[$username]['nome'];
        $_SESSION['cognome'] = $utenti[$username]['cognome'];
        $_SESSION['ruolo'] = $utenti[$username]['ruolo'];
        // Imposta un cookie per ricordare l'utente per un giorno
        setcookie('remember_user', $username, time() + (24 * 60 * 60));

?>
<link rel="stylesheet" href="styles/myStyle.css"/>
<link rel="scr" href="url"/>

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
    
    else
        echo "<h1>CREDENZIALI ERRATE: TORNA ALLA PAGINA DI LOGIN</h1>";
}
