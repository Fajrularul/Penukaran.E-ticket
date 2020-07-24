<!-- File: src/Template/Usersales/login.ctp -->
<?= $this->Html->css('login.css'); ?>
<?= $this->Flash->render('auth') ?>
<div class = "container">
        <div class="wrapper">
            <?= $this->Form->create(null, ['class' => 'form-signin']) ?>
                <h3 class="form-signin-heading"> Sign In</h3>
                <hr class="colorgraph"><br>

                <?= $this->Form->input('username', ['label' => false, 'placeholder' => 'Username', 'required' => '', 'autofocus' => '']) ?>
                <?= $this->Form->input('password', ['label' => false, 'placeholder' => 'Password', 'required' => '']) ?>
                <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>            

                <?= $this->Form->end() ?>
        </div>
    </div>