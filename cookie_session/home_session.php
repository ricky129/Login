<?php
include './include/dati.inc';
include './include/funzioni.inc';
$css = './myStyle.css';

// Inizializza la sessione
session_start(); 

$titolo = "PAGINA SESSIONI - Esempio uso cookie e sessioni";
stampa_head($titolo, $css);
// Verifica se il modulo di login è stato inviato
echo "PAGINA SESSIONI";
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
    echo "<h1>Sito personale di " . $_SESSION['nome'] . ' ' .$_SESSION['cognome'] . " (". $ruoli[$_SESSION['ruolo']]. ")</h1>";
    echo "<br /><ul>"
        . "<li><a href = home_cookie.php>SITO COOKIE</a></li></ul>";
}
stampa_finehtml();
                