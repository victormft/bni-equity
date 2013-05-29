<?php

use Equity\Library\Text,
    Equity\Core\View;

$bodyClass = 'review';

$user = $_SESSION['user'];

include 'view/prologue.html.php';
include 'view/header.html.php';

/*
 *
 <img src="<?php echo $user->avatar->getLink(75, 75, true); ?>" /><br />
                    <em><?php echo $user->name; ?></em>
 *
 */

?>

        <div id="sub-header">
            <div>
                <h2>
                    <?php echo 'Mi panel de revisor / ' . $this['menu'][$this['section']]['label']; ?></h2>
            </div>
        </div>

        <?php  echo new View ('view/review/menu.html.php', $this) ?>

<?php if(isset($_SESSION['messages'])) { include 'view/header/message.html.php'; } ?>

        <div id="main">


            <?php if (!empty($this['message'])) : ?>
                <div class="widget">
                    <?php if (empty($this['section']) && empty($this['option'])) : ?>
                        <h2 class="title">Bienvenid@</h2>
                    <?php endif; ?>
                    <p><?php echo $this['message']; ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($this['errors'])) {
                echo implode(',',$this['errors']);
            } ?>

            <?php if (!empty($this['success'])) {
                echo implode(',',$this['success']);
            } ?>

            <?php if (!empty($this['section']) && !empty($this['option'])) {
                echo new View ('view/review/'.$this['section'].'/'.$this['option'].'.html.php', $this);
            } ?>

        </div>
<?php
include 'view/footer.html.php';
include 'view/epilogue.html.php';
