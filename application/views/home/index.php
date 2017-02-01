<html>
    <head>
        <link type="text/css" rel="stylesheet" href="<?php echo URL::base()."media/css/home/index.css"; ?>">
    </head>
    <body>
<?php
echo "<table border='1'>";
foreach ($board->getCells() as $row)
{
    echo "<tr>";
    foreach ($row as $cell)
    {
        echo "<td style='background-color: ".($cell->isAlive ? '#000000' : '#ffffff')."'></td>";
    }
    echo "</tr>";
}
echo "</table>";

if ($board2) {
    echo "<table border='1'>";
    foreach ($board2->getCells() as $row) {
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td style='background-color: ".($cell->isAlive ? '#000000' : '#ffffff')."'></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

?>

    <div class="controlButtons">
        <button id="Play">Play</button>
        <button id="PrevStep">PrevStep</button>
        <button id="NextStep">NextStep</button>
    </div>
    </body>
</html>