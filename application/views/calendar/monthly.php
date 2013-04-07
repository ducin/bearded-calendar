<img src="/web/img/months/<?php echo manager_tools::getLeadingZeroes($month) ?>.jpg" alt="<?php echo $month_name ?>" />
<div id="calendar">
  <table cellspacing="0">

    <caption>
      <a href="<?php echo "/ccalendar/prev_month/monthly" ?>">&larr;</a>
      <?php echo $month_name ?>
      <a href="<?php echo "/ccalendar/next_month/monthly" ?>">&rarr;</a>
      <a href="<?php echo "/ccalendar/set/monthly/{$year_prev}" ?>">&larr;</a>
      <?php echo $year ?>
      <a href="<?php echo "/ccalendar/set/monthly/{$year_next}" ?>">&rarr;</a>
    </caption>

    <colgroup>
      <col class="Mon" />
      <col class="Tue" />
      <col class="Wed" />
      <col class="Thu" />
      <col class="Fri" />
      <col class="Sat" />
      <col class="Sun" />
      <col class="Week" />
    </colgroup>

    <thead>
      <tr>
        <?php foreach ($day_labels as $day_label): ?>
          <th><?php echo $day_label ?></th>
        <?php endforeach; ?>
        <th class="week">#</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($calendar_data as $week => $week_data): ?>
        <tr class="day">
          <?php foreach ($week_data as $weekday_ind => $day_data): ?>
            <td class="day<?php if ($day_data['month'] != $month) echo ' different_month' ?>">
              <div>
                <a href="<?php echo "/ccalendar/set/daily/{$day_data['date']}" ?>"
                  class="number<?php if (isset($day_data['holidays'])) echo ' holiday' ?>">
                  <?php echo $day_data['day'] ?>
                </a>
              </div>
              
              <div class="additional">
                <?php if (isset($day_data['holidays'])): ?>
                  <div class="holiday"><?php echo $day_data['holidays'] ?></div>
                <?php endif; ?>
                <div><?php echo $day_data['namedays'] ?></div>
                <?php echo View::factory('note/list')->bind('notes', $day_data['notes']) ?>
              </div>
            </td>
          <?php endforeach; ?>
          <td class="week">
            <span class="number">
              <?php echo $week ?>
            </span>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>
