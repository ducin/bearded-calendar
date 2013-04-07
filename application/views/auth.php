<div class="buttons">

<?php if (isset($login)): ?>
  <?php if ($login == 'success'): ?>
    <div>Poprawnie zalogowano.</div>
  <?php elseif ($login == 'error'): ?>
    <div style="color:red;">Błędne hasło lub login.</div>
  <?php endif ?>
  <br />
<?php endif ?>

<?php if ($user !== null): ?>
  <span>Witaj, <?php echo $user ?>! <a href="/logout">wyloguj</a></span>
<?php else: ?>
  <?php echo form::open('/login'); ?>
    <?php echo Form::label('username', 'login'); ?>:
      <?php echo form::input('username', 'Wpisz login...',array(
        'size' => 10, 'class'=>'validate','id'=>'username',
        'onclick' => "if(this.value=='Wpisz login...') this.value='';",
        'onblur' => "if(this.value=='') this.value='Wpisz login...';")); ?>
    <?php echo Form::label('password', 'hasło'); ?>:
      <?php echo form::password('password', '',array('size' => 10, 'class'=>'validate','id'=>'password')); ?>
    <input type="submit" value="Zaloguj" />
  </form>
<?php if(!empty($errors)){
    foreach($errors as $error){
        echo $error.'<br>';
    }
} ?>
<?php endif; ?>

<a href="#" onclick="window.print(); return false;">drukuj kalendarz</a>
  
<?php echo View::factory('valid') ?>
</div>
