<?php if (isset($notes)): ?>
  <hr />
  <ul>
    <?php foreach ($notes as $note_id => $note_description): ?>
      <li>
        <?php echo $note_description ?>
        <a href="/cnote/delete/<?php echo $note_id ?>">
          <img src="/web/img/cross.png" />
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
  <?php
 endif ?>
