<html>
    <head>
        <link type="text/css" rel="stylesheet" href="<?php echo URL::base()."media/css/home/index.css"; ?>">
        <script>
            var ROOT = '<?php echo $base_url ?>';
        </script>
    </head>
    <body>
        <h1>Game of Life</h1>
        <div class="input-container">
            <label>Mentett minták</label>
            <select name="savedPatterns">
                <option value="-1">Kérlek válassz...</option>
                <?php
                foreach ($patterns as $pattern)
                {
                    echo "<option value='$pattern->pat_id'>$pattern->pat_name</option>";
                }
                ?>
            </select>
            <p id="errorMessage"></p>
        </div>
        <div class="input-container">
            <label>Szélesség</label>
            <input name="width" type="text" value="10" />
            <p id="errorMessage"></p>
        </div>
        <div class="input-container">
            <label>Magasság</label>
            <input name="height" type="text" value="10" />
            <p id="errorMessage"></p>
        </div>

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

?>

        <div class="controlButtons">
            <button id="Play">Play</button>
            <button id="Stop">Stop</button>
            <button id="PrevStep">PrevStep</button>
            <button id="NextStep">NextStep</button>
        </div>
        <div class="saveActualPattern">
            <div class="input-container">
                <label>Név</label>
                <input name="patternName" type="text" />
                <p id="errorMessage"></p>
            </div>
            <button id="saveActualPattern">Aktuális mentése</button>
        </div>

        <script type="text/javascript" src="<?php echo URL::base()."media/js/jquery/jquery-3.1.1.min.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo URL::base()."media/js/home/index.js"; ?>"></script>
    </body>
</html>