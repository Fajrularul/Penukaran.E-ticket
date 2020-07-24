<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        <?= $cakeDescription ?>
    </title>

    <?= $this->Html->charset() ?>
    <?= $this->Html->meta('icon') ?>
    <?php
        echo $this->Html->css('bootstrap/bootstrap.css');
        echo $this->Html->css('login.css');

        echo $this->Html->script(['jquery/jquery.js', 'bootstrap/bootstrap.js']);

    ?>
</head>
<body>
    <div class = "container">
        <div class="wrapper">
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create(null, ['class' => 'form-signin']) ?>
                <h3 class="form-signin-heading"> Please Sign In</h3>
                <hr class="colorgraph"><br>

                <?= $this->Form->input('username', ['label' => false, 'placeholder' => 'Username', 'required' => '', 'autofocus' => '']) ?>
                <?= $this->Form->input('password', ['label' => false, 'placeholder' => 'Username', 'required' => '']) ?>
                <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>            

                <?= $this->Form->end() ?>
        </div>
    </div>

</body>
</html>
