<?php

?>
<select name="<?php echo htmlspecialchars($this['name']) ?>" id="<?php echo htmlspecialchars($this['name']) ?>_editor"<?php if (isset($this['class'])) echo ' class="' . htmlspecialchars($this['class']) . '"'?>>
    <?php foreach ($this['options'] as $option): ?>
    <option value="<?php echo $option ?>" <?php if ($option == $this['value'] || $option['value'] == $this['value']) echo ' selected="selected"' ?> ><?php echo $option ?></option>
    <?php endforeach ?>
</select>
<script type="text/javascript">
<?php include __DIR__ . '/select.js.src.php' ?>
</script>

