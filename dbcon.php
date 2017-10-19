<?php
/*Da bismo si olakšali život, kreirat ćemo malu datoteku za spajanje na našu bazu 
podataka, koju onda možemo includati na sva mjesta na kojima nam zatreba baratanje sa bazom: */

session_start();
 
$dbhost = "localhost"; // ovo je server host 
$dbname = "knjiznica"; // ime baze
$dbuser = "root"; // username
$dbpass = ""; // password
 
mysql_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error: " . mysql_error());
mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());

/*
Eto, sad imamo kamo smjestiti podatke o našem korisniku i imamo datoteku za spoj na bazu podataka. 
Malo ćemo okrenuti redosljed i prvo napraviti login korisnika. 
Pa kreirajte index.php datoteku i na sam vrh stavite:

?>


