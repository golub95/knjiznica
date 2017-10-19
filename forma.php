<?php
header('Content-type: text/plain; charset=windows-1250');
@mySQL_select_db("praksa", @mySQL_connect("localhost", "root",""));

if(isset($_GET["studenti"])){$tip="studenti"; $id=$_GET["studenti"];}
if(isset($_GET["pisac"])){$tip="pisac"; $id=$_GET["pisac"];}
if(isset($_GET["knjige"])){$tip="knjige"; $id=$_GET["knjige"];}

 
  echo "<form method='post'>";      

if($id!='novi'){
$POSTOJECI=@mysql_fetch_array(@mysql_query("select * from $tip where id='$id'"));   
}
       
      if ($tip=="studenti")
      {
       echo "<div> <a href='knjiznica.php' class='odustani1'>&times</a></div>";
       echo "<div><input name='ime'value='$POSTOJECI[ime]' placeholder='Ime studenta'></div>" ;
       echo "<div><input name='prezime' value='$POSTOJECI[prezime]' placeholder='Prezime studenta'></div>" ;     
       echo "<div class='nastavi'><input name='studenti' type='submit' value='Unos' ></div>";
       
                         
      }  
      if ($tip=="knjige")
      {  
      echo "<div> <a href='knjiznica.php' class='odustani1'>&times</a></div>";
	  echo "<div><input name='pisac' value='$POSTOJECI[pisac]' placeholder='Ime Pisca'></div>" ;	
      echo "<div><input name='naziv' value='$POSTOJECI[naziv]' placeholder='Naziv knjige'></div>" ;
	  echo "<div class='nastavi'><input name='knjige' type='submit' value='Unos' ></div>";                 
      } 

        //završi formu
      echo "<input name='id' value='$id' type='hidden'/>";
      echo "</form>";
 ?>
 </body>
 </html>       