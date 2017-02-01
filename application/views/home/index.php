<html>
    <head>
        <link type="text/css" rel="stylesheet" href="<?php echo URL::base()."media/css/home/index.css"; ?>">
        <script>
            var ROOT = '<?php echo $base_url ?>';
        </script>
    </head>
    <body>
<?php
echo "<table id='board' data-boardWidth='$boardWidth' data-boardHeight='$boardHeight'>";
foreach ($board->getCells() as $row)
{
    echo "<tr>";
    foreach ($row as $cell)
    {
        echo "<td class='".($cell->isAlive ? 'isAlive' : '')."' data-x='$cell->x' data-y='$cell->y'></td>";
    }
    echo "</tr>";
}
echo "</table>";
/*
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
}*/

?>

    <div class="controlButtons">
        <button id="Play">Play</button>
        <button id="PrevStep">PrevStep</button>
        <button id="NextStep">NextStep</button>
    </div>
    <script type="text/javascript" src="<?php echo URL::base()."media/js/jquery/jquery-3.1.1.min.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo URL::base()."media/js/home/index.js"; ?>"></script>
    </body>
</html>