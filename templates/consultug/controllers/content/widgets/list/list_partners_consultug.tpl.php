<?php if ($items){ ?>
<div class='g-bgc_white'>
    <div class='g-w_1170'>
      <div class="g-pl_8p g-pr_8p g-pb_40 g-ta_c">
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
                  
                  $srcimg = html_image_src($image, 'original', true);      
              ?>
              <div class='partners-one
                          g-d_ib g-va_t g-ta_c g-pr_30 g-bxz_bb g-bdrs_5 g-pt_30 g-pl_5 g-pr_5' >
                  <div class='partners-logo g-pb_20'>
                      <a class='g-ta_c' href="<?php echo $item['outurl']  ?>">
                          <?php echo html_image($image, 'big', $item['title']); ?>
                      </a>
                  </div>
                  <div class="partners-info">
                      <p class="g-pt_10 g-pb_30 g-ff_lt g-c_dim_dk_blue g-fz_1_4r g-lh_2_1r">
                              <?php echo string_short($item[$teaser_field], $teaser_len); ?>
                      </p>
                  </div>
              </div> 
          <?php } ?>
      </div>
  </div>
</div>

<?php } ?>