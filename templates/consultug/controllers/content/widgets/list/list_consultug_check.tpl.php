<?php if ($items){ ?>
<div class="g-bgc_lt_blue">
    <div class="g-w_1170">
      <div class="widget_content_list
                  documentation-main
                  g-pl_10 g-pt_60 g-ta_c">
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
              
              <div class="g-d_ib g-pb_20">
                  <div class="content_list_item diploms_list_item">
                      <?php if ($image) { ?>
                          <div class="photo
                                      g-bgc_white">
                              <a class='fancy' data-fancybox="gallery" href="<?php echo $srcimg; ?>">
                                <?php echo html_image($image, 'big', $item['title']); ?>
                              </a>
                          </div>
                      <?php } ?>
                      <div class="info g-d_ib">
                          <p class="g-pt_10 g-ff_lt g-c_dim_dk_blue g-fz_1_6r g-lh_2_3r">
                                  <?php echo string_short($item[$teaser_field], $teaser_len); ?>
                          </p>
                      </div>
                  </div>
              </div>
          <?php } ?>
      </div>
  </div>
</div>

<?php } ?>