<?php
include './include/dati.inc';
include './include/funzioni.inc';
$css = './myStyle.css';

$titolo = "PAGINA COOKIE - Esempio uso cookie e sessioni";
stampa_head($titolo, $css);
// Verifica se il modulo di login è stato inviato
echo "PAGINA COOKIE";

if(isset($_COOKIE['remember_user'])){
    $username = $_COOKIE['remember_user'];
    echo "<h1>Sito personale di " . $utenti[$username]['nome'] . ' ' . $utenti[$username]['cognome'] .
            " (".  $ruoli[$utenti[$username]['ruolo']]. ")</h1>";
    echo "<br /><ul>"
        . "<li><a href = home_session.php>SITO SESSIONI</a></li></ul>";
}
stampa_finehtml();