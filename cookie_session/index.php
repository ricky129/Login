<?php
session_start();
include './include/dati.inc';
include './include/funzioni.inc';
$css = './styles/myStyle.css';
$titolo = "Esempio uso cookie e sessioni";
stampa_head($titolo, $css);
?>

<h1>ACCESSO SITO RISERVATO</h1>
<div class ="allinea"> 
    <br>
    <form id ="form2" method ="post" action ="home.php">
        USERNAME: <input type="text" name = "username" size="12" maxlength ="68" value="superuser"/><br />
        <br>
        PASSWORD: <input type="password" name = "password" size="12" maxlength ="68" value="pwd1"/><br />
        <br />
                    <input name = "invio" type ="submit" value ="ACCESSO" />
                    </form>

                </div>
                <br /><!-- comment -->
                <a href ="https://www.w3schools.com/html/html_forms.asp" target = _blank>MANUALE FORM w3schools</a>
<?php
    stampa_finehtml();
