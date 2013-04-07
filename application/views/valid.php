<div id="valid">
  <a href="http://validator.w3.org/check?uri=referer">
    <img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="Valid XHTML 1.0 Transitional" height="31" width="88" />
  </a>

  <a href="http://jigsaw.w3.org/css-validator/check/referer">
    <img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Poprawny CSS!" />
  </a>

  <?php if ($mode == 'daily'): ?>
  <a href="http://validator.w3.org/check?uri=<?php echo $_SERVER['HTTP_HOST'].'/page.svg' ?>">
    <img src="http://www.w3.org/Icons/valid-svg11-blue" alt="Valid SVG 1.1" height="31" width="88" />
  </a>
  <?php endif; ?>
</div>
