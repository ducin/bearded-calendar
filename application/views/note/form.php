<div id="note">
  <span id="note_toggle">Dodaj notatkę...</span>
  <div id="note_form">
    <?php echo form::open('/note/new'); ?>
      <?php echo form::hidden('user_id', $user_id, array(
        'class'=>'validate', 'id' => 'user_id')); ?>
      <?php echo form::hidden('note_date', $date, array(
        'class'=>'validate', 'id' => 'note_date')); ?>
      <?php echo Form::label('description', 'treść'); ?>:
      <?php echo form::input('description', '', array(
          'class'=>'validate', 'id' => 'description')); ?>
      <input type="button" onclick="processNewNote(this.form)" value="Zapisz" />
    </form>
  </div>
</div>
