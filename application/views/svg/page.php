<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
     version="1.1" width="400px" height="400px">
  <?php $black = 'rgb(0,0,0)'; $red = 'rgb(240,20,20)'; ?>
  <g>
    <rect x="0" y="0" width="400" height="400"
      style="fill:rgb(240,240,240);stroke-width:1;stroke:rgb(0,0,0)" />
    
    <rect x="10" y="10" width="380" height="70"
      style="fill:<?php echo $red ?>;stroke-width:1;stroke:rgb(0,0,0)" />
    
    <a xlink:href="<?php echo "/ccalendar/set/monthly/{$year}/{$month}" ?>" target="_top">
      <text x="200" y="65" font-family="Verdana" font-size="55" fill="<?php echo $black ?>" text-anchor="middle">
        <?php echo $month_name . ' ' . $year ?>
      </text>
    </a>
    
    <text x="200" y="105" font-family="Verdana" font-size="20" text-anchor="middle"
      fill="<?php echo $black ?>">
      <?php echo $day_of_year . '. dzień roku ' ?>
    </text>
    
    <text x="200" y="280" font-family="Verdana" font-size="200" text-anchor="middle"
      fill="<?php echo (isset($holiday) ? $red : $black) ?>">
      <?php echo (int) $day ?>
    </text>
        
    <text x="200" y="310" font-family="Verdana" font-size="30" text-anchor="middle"
      fill="<?php echo (isset($holiday) ? $red : $black) ?>">
      <?php echo $day_name ?>
    </text>
    
    <text x="200" y="380" font-family="Verdana" font-size="20" text-anchor="middle"
      fill="<?php echo $black ?>">
      Imieniny <?php echo $namedays ?>
    </text>

    <?php if(isset($holiday)): ?>
    <text x="200" y="345" font-family="Verdana" font-size="20" text-anchor="middle"
      fill="<?php echo $red ?>">
      <?php echo $holiday ?>
    </text>
    <?php endif; ?>
    
    <?php if(isset($icon_left)): ?>
    <image x="20" y="160" width="128" height="128"
      xlink:href="/web/img/icon/<?php echo $icon_left ?>.png">
        <animateTransform
          attributeName="transform" type="rotate" repeatCount="indefinite" 
          begin="0s" dur="3s" from="0 60 225" to="360 60 225" />
    </image>
    <?php endif; ?>
    
    <?php if(isset($icon_right)): ?>
    <image x="260" y="160" width="128" height="128"
      xlink:href="/web/img/icon/<?php echo $icon_right ?>.png">
        <animateTransform
          attributeName="transform" type="rotate" repeatCount="indefinite" 
          begin="0s" dur="3s" from="360 330 225" to="0 330 225" />
    </image>
    <?php endif; ?>
    
    <?php if(isset($icon_circle)): ?>
      <?php for ($ind = 0; $ind < 5; $ind++): ?>
        <path id="myAniPath" d="M150 0 M75 200 M225 200" />
        <image x="0" y="0" width="128" height="128"
          xlink:href="/web/img/icon/<?php echo $icon_circle ?>.png">
            <animateMotion repeatCount="indefinite" begin="<?php echo $ind ?>" dur="<?php echo mt_rand(2, 10) ?>s" fill="freeze"
              path="M10 0 A15 15 180 0 1 70 140 A15 25 180 0 0 130 130 A15 55 180 0 1 190 120 A15 10 170 0 1 10 150 0 0" />
            <animateTransform
              attributeName="transform" type="rotate" repeatCount="indefinite" 
              begin="0s" dur="<?php echo mt_rand(1,5) ?>s" from="360 64 64" to="0 64 64" />
        </image>
      <?php endfor; ?>
    <?php endif; ?>

  </g>
</svg>
