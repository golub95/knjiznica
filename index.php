<html>
<head>
<meta http-equiv='Content-Language' content='hr'>
<meta http-equiv='Content-Type' content='text/html; charset=windows-1250'>
<script src='scw.js' type='text/javascript'></script>
<script src="jquery.js"></script>
<script src="jquery.magnific-popup.js"></script>
<link href="magnific-popup.css" rel="stylesheet" type="text/css">
</head>
</html>
<?php

session_start();
 
$dbhost = "localhost"; // ovo je server host 
$dbname = "knjiznica"; // ime baze
$dbuser = "root"; // username
$dbpass = ""; // password
 
mysql_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error: " . mysql_error());
mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());

 

    
if(isset($_POST["knjige"])){
if($_POST["naziv"]!="")
if($_POST["pisac"]!="")	{
if($_POST["id"]!=''){mysql_query("update knjige set naziv='$_POST[naziv]',pisac='$_POST[pisac]' where id='{$_POST["id"]}'");}
else {mysql_query("insert into knjige set naziv='$_POST[naziv]',pisac='$_POST[pisac]'");}
}}

if(isset($_POST["studenti"])){
if($_POST["ime"]!="")
if($_POST["prezime"]!=""){
if($_POST["id"]!=''){mysql_query("update studenti set ime='$_POST[ime]',prezime='$_POST[prezime]' where id='{$_POST["id"]}'");}
else{mysql_query("insert into studenti set ime='$_POST[ime]',prezime='$_POST[prezime]'");}
}}






if(isset($_POST["azuriraj"])){
if($_POST[datum]=='' )  {
$_POST[datum]= date("d.m.Y.");}
mysql_query("insert into posudbe set 
knjiga='$_POST[knjiga]',
student='$_POST[student]',
datum='$_POST[datum]',
status='$_POST[status]'
");
header("Location: ?posudbe");

}

$knjigeSELECT=@mysql_query("select * from knjige");
$studentiSELECT=@mysql_query("select * from studenti");


echo "<div style='float:left;width:96%;padding:2%;border-bottom:1px solid #ccc;'>";
echo "<form method='post'>";

echo "<select name='knjiga'>";
while($knjiga=@mysql_fetch_array($knjigeSELECT)){
echo "<option value='$knjiga[id]'>$knjiga[naziv] $knjiga[pisac] </option>";}
echo "</select>";

echo "<select name='student'>";
while($student=@mysql_fetch_array($studentiSELECT)){
echo "<option value='$student[id]'>$student[ime] $student[prezime]</option>";}
echo "</select>";

echo "<select name='status'>"; 
echo "<option value='po'>Posudio je</option>";
echo "<option value='vr'>Vratio je</option>";
echo "</select>";

echo "<input name='datum' onclick='scwShow(this,event);' placeholder='Datum' autocomplete='off'/>";

echo "<input type='submit' value='Azuriraj' name='azuriraj' />";

echo "</form>";
echo "</div>";

echo "<div style='float:left;width:96%;padding:2%;border-bottom:1px solid red;'>";
$posudbeUPIT=@mysql_query("select * from posudbe order by id desc");
while($posudbe=@mysql_fetch_array($posudbeUPIT)){
$KnjigaPodaci=mysql_fetch_array(mysql_query("select * from knjige where id='$posudbe[knjiga]desc'"));
$StudentPodaci=mysql_fetch_array(mysql_query("select * from studenti where id='$posudbe[student]desc'"));
if($posudbe["status"]=='po'){$StatusOpis="Posudio/(la)";}else{$StatusOpis="Vratio/(la)";}
echo "{$posudbe["id"]}. <b><i>$StatusOpis</i></b>
<div style='border:2px width:100%; '/div>
Knjiga: <b>$KnjigaPodaci[naziv] $KnjigaPodaci[pisac]</b> 
Student: <b>$StudentPodaci[ime] $StudentPodaci[prezime]</b> 
 $posudbe[datum] <br />";
 }
 
 
 
 

$knjigeUPIT=@mysql_query("select * from knjige order by id desc");

echo "<div style='float:left;width:40%;padding:3%;border-right:1px solid #ccc;'>";
echo "<div><a class='simple-ajax-popup-align-top' href='forma.php?knjige'>Unos nove knjige</a></div><br />";
while($knjiga=@mysql_fetch_array($knjigeUPIT)){
echo "<a class='simple-ajax-popup-align-top' href='forma.php?knjige=$knjiga[id]'> $knjiga[id] $knjiga[naziv] $knjiga[pisac]</a><br />";
}
echo "</div>";


$studentiUPIT=@mysql_query("select * from studenti order by id desc");

echo "<div style='float:left;width:40%;padding:3%;border-right:1px solid #ccc;'>";
echo "<div><a class='simple-ajax-popup-align-top' href='forma.php?studenti'>Unos novog studenta</a></div><br />";
while($student=@mysql_fetch_array($studentiUPIT)){ 
echo "<a class='simple-ajax-popup-align-top' href='forma.php?studenti=$student[id]'>$student[id] $student[ime] $student[prezime]</a><br />";
}
echo "</div>";

echo "</div>";
?> 
<script type="text/javascript">
      $(document).ready(function() {

        $('.simple-ajax-popup-align-top').magnificPopup({
          type: 'ajax',
          alignTop: true,
          overflowY: 'scroll' // as we know that popup content is tall we set scroll overflow by default to avoid jump
        });

        $('.simple-ajax-popup').magnificPopup({
          type: 'ajax'
        });
        
      });
    </script>     