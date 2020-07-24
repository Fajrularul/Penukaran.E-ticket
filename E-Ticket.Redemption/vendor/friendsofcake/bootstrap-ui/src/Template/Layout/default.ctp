<?php

use Cake\Core\Configure;

/**
 * Default `html` block.
 */
if (!$this->fetch('html')) {
    $this->start('html');
    printf('<html lang="%s" class="no-js">', Configure::read('App.language'));
    $this->end();
}

/**
 * Default `title` block.
 */
if (!$this->fetch('title')) {
    $this->start('title');
    echo Configure::read('App.title');
    $this->end();
}

/**
 * Default `footer` block.
 */
if (!$this->fetch('tb_footer')) {
    $this->start('tb_footer');
    //printf('&copy;%s %s', date('Y'), Configure::read('App.title'));
    $this->end();
}

/**
 * Default `body` block.
 */
$this->prepend('tb_body_attrs', ' class="' . implode(' ', array($this->request->controller, $this->request->action)) . '" ');
if (!$this->fetch('tb_body_start')) {
    $this->start('tb_body_start');
    echo '<body' . $this->fetch('tb_body_attrs') . '>';
    $this->end();
}
/**
 * Default `flash` block.
 */
if (!$this->fetch('tb_flash')) {
    $this->start('tb_flash');
    if (isset($this->Flash))
        echo $this->Flash->render();
    $this->end();
}
if (!$this->fetch('tb_body_end')) {
    $this->start('tb_body_end');
    echo '</body>';
    $this->end();
}

/**
 * Prepend `meta` block with `author` and `favicon`.
 */
$this->prepend('meta', $this->Html->meta('author', null, array('name' => 'author', 'content' => Configure::read('App.author'))));
$this->prepend('meta', $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon')));

/**
 * Prepend `css` block with TwitterBootstrap and Bootflat stylesheets and append
 * the `$html5Shim`.
 */
$html5Shim =
<<<HTML
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
HTML;
$this->prepend('css', $this->Html->css(['bootstrap/bootstrap2.min']));
$this->prepend('css', $this->Html->css(['sbAdmin/sb-admin-3']));
$this->prepend('css', $this->Html->css(['font-awesome/css/font-awesome.min']));
$this->prepend('css', $this->Html->css(['metisMenu/metisMenu.min']));
$this->prepend('css', $this->Html->css(['bootstrap-datepicker3.min']));
$this->prepend('css', $this->Html->css(['eo']));
$this->prepend('css', $this->Html->css(['eo2']));


$this->append('css', $html5Shim);

$this->prepend('script', $this->Html->script(['jquery/jquery.min', 'bootstrap/bootstrap.min', 'bootstrap-datepicker.min', 'custom']));

?>
<!DOCTYPE html>

<?= $this->fetch('html') ?>

    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $this->Html->charset() ?>

        <title><?= $this->fetch('title') ?></title>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>

     
        

    </head>

    <?php
    echo $this->fetch('tb_body_start');
    ?>
    <div id="wrapper">
    <!-- Navigation -->
    <?php
        $session = $this->request->session();
        $isLoggogedIn = $session->check('loggedUser');

        if($isLoggogedIn)
        {
            $user = $session->read('loggedUser');
    ?>
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
            <div class="navbar-header">
                
                <a href="<?= $this->Url->build('/', true); ?>dashboard">
                    <img src="<?= $this->Url->build('/', true).'img/Stellar Events - White.png'?>" width="140" style="padding-top:5px;padding-left: 5px;">
                </a>
            <button type="button" class="position navbar-toggle" data-toggle="collapse" data-target="#side-menu">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-caret-down fa-2x"></i>
                </button>

            </div>
            
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:white;">
                        <i class="fa fa-user fa-2x"></i>  <i class="fa fa-caret-down fa-1x"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a>Welcome, <?= $user['username'] ?></a>
                        </li>
                        <li><a href="<?= $this->Url->build('/', true); ?>users/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
           
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav collapse" id="side-menu">
                        
                        <li>
                           <a href="<?= $this->Url->build('/', true); ?>dashboard" style="color:white"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <?php
                            if($user['role'] == 'admin')
                            {
                        ?>
                        <li>
                            <a style="color:white" href="<?= $this->Url->build('/', true); ?>events"><i class="fa fa-star fa-fw"></i> Events</a>
                            
                        </li>
                       
                        <li>
                            <a style="color:white" href="<?= $this->Url->build('/', true); ?>tickettypes"><i class="fa fa-ticket fa-fw"></i> Ticket Types</a>
                        </li>
                        <li>
                            <a style="color:white" href="<?= $this->Url->build('/', true); ?>gateareas"><i class="fa fa-home fa-fw"></i> Gate Areas</a>
                        </li>
                        <li>
                            <a style="color:white" href="<?= $this->Url->build('/', true); ?>gates"><i class="fa fa-building fa-fw"></i> Gates</a>
                        </li>
                        <li>
                            <a style="color:white" href="<?= $this->Url->build('/', true); ?>roles"><i class="fa fa-user-md fa-fw"></i> User Roles</a>
                        </li>
                        
                        <?php } ?>

                        <?php
                            if($user['role'] == 'god' || $user['role'] == 'admin')
                            {
                        ?>
                            <li>
                                <a style="color:white" href="<?= $this->Url->build('/', true); ?>tickets"><i class="fa fa-barcode fa-fw"></i> Tickets</a>
                            </li>
                            <li>
                                <a style="color:white" href="<?= $this->Url->build('/', true); ?>users"><i class="fa fa-users fa-fw"></i> Users</a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

    <?php
        }
    echo $this->fetch('tb_flash');
    if($isLoggogedIn)
        echo '<div id="page-wrapper">';
		//echo '<center><img class="img-style" src="'.$this->Url->build('/', true).'img/logo3.png"></center>';
    echo $this->fetch('content');
    if($isLoggogedIn)
        echo '</div>';
    echo $this->fetch('tb_footer');
    echo $this->fetch('script');
    ?>
     </div>
    <?php
    echo $this->fetch('tb_body_end');
    ?>

</html>
