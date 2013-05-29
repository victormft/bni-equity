<?php

use Equity\Core\View,
    Equity\Library\Text,
    Equity\Model\Project\Account;

$project = $this['project'];

if (!$project instanceof  Equity\Model\Project) {
    return;
}

$accounts = Account::get($project->id);

?>
<!--
<div class="widget projects">
    <h2 class="title">Acuerdo</h2>
</div>
-->

<div class="widget projects">
    <h2 class="title">Cuentas bancarias del proyecto</h2>
<form method="post" action="<?php echo SITE_URL ?>/dashboard/projects/contract/save" >
    <input type="hidden" name="project" value="<?php echo $project->id; ?>" />
<p>
    <label for="bank-account">Cuenta bancaria:</label><br />
    <input type="text" id="bank-account" name="bank" value="<?php echo $accounts->bank; ?>" style="width:350px;" />
</p>

<p>
    <label for="paypal-account">Cuenta PayPal:</label><br />
    <input type="text" id="paypal-account" name="paypal" value="<?php echo $accounts->paypal; ?>" style="width:350px;" />
</p>

<input type="submit" name="save" value="<?php echo Text::get('form-apply-button') ?>" />
</form>
</div>
