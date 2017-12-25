<?php
$tab = array("casio", "chanel", "citizen", "dw", "fossil", "gucci", "ice_watch", "rolex");
$input = filter_input(INPUT_POST, 'input'); ?>
<datalist id="browsers"><?php
if ($input){
    foreach ($tab as $name){ ?>
    <option value="<?= $name ?>"></option>
    <?php } ?>
</datalist>
<?php } 