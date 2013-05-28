<?php


use Goteo\Library\Text;

$entrepreneur = $this['data']['entrepreneur'] ?>

<div class="support task">
    
    
    <div class="title"><strong><?php echo htmlspecialchars($entrepreneur->role) ?>: <?php echo htmlspecialchars($entrepreneur->name)  ?></strong></div>
    
    <div class="description"><?php echo htmlspecialchars($entrepreneur->bios) ?></div>
    
    <input type="submit" class="edit" name="entrepreneur-<?php echo $entrepreneur->id ?>-edit" value="<?php echo Text::get('regular-edit') ?>" />
    <input type="submit" class="remove weak" name="entrepreneur-<?php echo $entrepreneur->id ?>-remove" value="<?php echo Text::get('form-remove-button') ?>" />
</div>

    

    