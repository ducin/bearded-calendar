<div id="calendar">
  <object
    data="/page.svg" type="image/svg+xml"
    id="daily" class="center">
  </object>
</div>

<div class="note_list">
  <?php echo View::factory('note/list')->bind('notes', $notes) ?>
  <?php if (isset($user_id)): ?>
    <?php echo View::factory('note/form')->bind('date', $date)->bind('user_id', $user_id) ?>
  <?php endif; ?>
  <hr />
</div>
