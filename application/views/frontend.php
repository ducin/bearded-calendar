<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"     
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo I18n::$lang ?>">
  <head>
    <title><?php echo $title ?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type)), PHP_EOL ?>
<?php foreach ($scripts as $file) echo HTML::script($file), PHP_EOL ?>
  </head>
  <body>
    <div id="container">
      <?php echo $body ?>
      <?php echo View::factory('auth') ?>
    </div>
  </body>
</html>
