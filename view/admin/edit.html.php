<?php

use Equity\Library\Text;

?>
<div class="widget board">
    <!-- superform -->
    <form action="<?php echo $this['form']['action']; ?>" method="post" enctype="multipart/form-data">
        <dl>
            <?php foreach ($this['form']['fields'] as $Id=>$field) : ?>
                <dt><label for="<?php echo $Id; ?>"><?php echo $field['label']; ?></label></dt>
                <dd><?php switch ($field['type']) {
                    case 'text': ?>
                        <input type="text" id="<?php echo $Id; ?>" name="<?php echo $field['name']; ?>" <?php echo $field['properties']; ?> value="<?php $name = $field['name']; echo $this['data']->$name; ?>" />
                    <?php break;
                    case 'hidden': ?>
                        <input type="hidden" name="<?php echo $field['name']; ?>" <?php echo $field['properties']; ?> value="<?php $name = $field['name']; echo $this['data']->$name; ?>" />
                    <?php break;
                    case 'textarea': ?>
                        <textarea id="<?php echo $Id; ?>" name="<?php echo $field['name']; ?>" <?php echo $field['properties']; ?>><?php $name = $field['name']; echo $this['data']->$name; ?></textarea>
                    <?php break;
                    case 'image':
                         $name = $field['name'];
                        ?>
                        <input type="file" id="<?php echo $Id; ?>" name="<?php echo $field['name']; ?>" <?php echo $field['properties']; ?> value="<?php $name = $field['name']; echo $this['data']->$name; ?>" /> <br />
                        <?php if (!empty($this['data']->$name)) : ?>
                            <img src="<?php echo SRC_URL ?>/image/<?php echo $this['data']->$name; ?>/110/110" alt="<?php echo $field['name']; ?>" /><br />
                            <input type="hidden" name="<?php echo $field['name']; ?>" value="<?php echo $this['data']->$name; ?>" />
                            <input type="submit" name="image-<?php echo $this['data']->$name; ?>-remove" value="Quitar" />
                        <?php endif; ?>
                    <?php break;
                } ?></dd>

            <?php endforeach; ?>
        </dl>
        <input type="submit" name="<?php echo $this['form']['submit']['name']; ?>" value="<?php echo $this['form']['submit']['label']; ?>" />
    </form>
</div>