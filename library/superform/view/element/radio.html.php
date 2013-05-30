<?php

use Equity\Core\View;
?>
<label>

    <?php if (isset($this['label'])): ?>
    <?php echo htmlspecialchars($this['label']) ?>
    <?php endif ?>
    
    <input id="<?php echo htmlspecialchars($this['id']) ?>" type="radio" name="<?php echo htmlspecialchars($this['name']) ?>" value="<?php echo htmlspecialchars($this['value']) ?>"<?php if ($this['checked']) echo 'checked="checked"' ?> />
    
</label>

<?php if (!empty($this['children'])): ?>
<div class="<?php if (!$this['checked']) echo 'jshidden ' ?>children" id="<?php echo htmlspecialchars($this['id']) ?>-children">
        <?php echo new View('library/superform/view/elements.html.php', Equity\Library\SuperForm::getChildren($this['children'], $this['level'])) ?>
</div>
<script type="text/javascript">
$(function () {
   $("div.superform input#<?php echo $this['id'] ?>").click(function () {
       
       $(this).closest('li.group').first().find("input[type='radio'][name='<?php echo $this['name'] ?>']").each(function (i, r) {
          try {
              if ('<?php echo $this['id'] ?>' == r.id) {
                  $('div.children#' + r.id + '-children').slideDown(400);
              } else {
                  $('div.children#' + r.id + '-children').slideUp(400);
              }
          } catch (e) {}
       });       
   });
});  
</script>
<?php endif; ?>

<script type="text/javascript">
<?php include __DIR__ . '/radio.js.src.php' ?>
</script>