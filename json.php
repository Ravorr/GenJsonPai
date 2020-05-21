<?php
        header('Access-Control-Allow-Origin: *');
        include "polacz.php"; //wzór pliku we wpisie "Pełny panel administracyjny MySQLi"
        if ($sql = $baza->prepare( "SELECT DISTINCT towar,nr_faktury FROM faktura ORDER BY ilosc "))
        {
                $sql->execute(); //wykonaj SQL
                $sql->bind_result($ilosc,$nr_faktury);
                while ($sql->fetch())
                  $ilosci[] = array(
                     "nr_faktury" => $nr_faktury,
                     "ilosc" => iconv("ISO-8859-2", "UTF-8", $ilosc)
                   ); //dla każdego nazwiska tworzy 2 pary, nazwiska przekonwertowane do UTF
                $sql->close();
        }
        $baza->close();
        echo json_encode($ilosc, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
