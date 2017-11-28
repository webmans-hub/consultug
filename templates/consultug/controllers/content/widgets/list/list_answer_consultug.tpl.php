<?php if ($items){ ?>
<div class='g-bgc_lt_blue'>
    <div class='g-w_1170'>
      <div class='js-accordion js-answers 
                            g-pl_8p g-pb_40'>
          <?php foreach($items as $item) { ?>                      
              
              <?php
                  $url        = href_to($ctype['name'], $item['slug']) . '.html';
                  $is_private = $item['is_private'] && $hide_except_title && !$item['user']['is_friend'];
                  $image      = (($image_field && !empty($item[$image_field])) ? $item[$image_field] : '');
                  if ($is_private) {
                      if($image_field && !empty($item[$image_field])){
                          $image = default_images('private', 'small');
                      }
                      $url    = '';
                  }   
              ?>
              
              <p class='js-accordion-header 
                              g-cur_p g-pb_20 g-ff_reg g-fz_1_8r g-lh_2_6r g-c_blue'>
                  <?php echo $item['title']; ?>
              </p>
              <p class='js-accordion-content
                              answer-one
                              g-pt_15 g-pb_45 g-ff_lt g-fz_1_4r g-lh_2_1r g-c_dk_blue'>
                  <?php echo string_short($item[$teaser_field], $teaser_len); ?>
              </p>
          <?php } ?>
      </div>
  </div>
</div>

<?php } ?>