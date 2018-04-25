<?php
$json = json_decode(file_get_contents('https://www.uni-ulm.de/mensaplan/data/mensaplan.json'));

$date = date("Y-m-d");

header('Content-Type: application/json');

echo "{\"response_type\": \"in_channel\", \"text\": \"\n";
#echo "---";
#echo "#### Essen in der Mensa am ".date("d. m. Y")."\n";
echo "| Mensa | ".$date." |\n";
echo "|:------|:----------|\n";

foreach($json->weeks as $week => $wdata) {
    foreach($wdata->days as $day => $ddata) {
        if ($ddata->date == $date) {
            foreach($ddata->Mensa->meals as $mealId => $meal) {
                echo "| ".$meal->category." | ".$meal->meal." |\n";
            }
        }
    }
}

#echo "---"
echo "\"}\n";
?>
