<?php $core = cmsCore::getInstance(); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php $this->title(); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="robots" content="noindex, nofollow"/>
    
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    
    <?php //$this->addMainCSS("templates/{$this->name}/css/theme-text.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-layout.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-gui.css"); ?>
    <?php //$this->addMainCSS("templates/{$this->name}/css/theme-widgets.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-content.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-modal.css"); ?> 
    
    <?php $this->addMainCSS("templates/{$this->name}/css/jquery.fancybox.min.css"); ?> 
        
    <?php $this->addMainCSS("templates/{$this->name}/css/normalize.css"); ?> 
    <?php $this->addMainCSS("templates/{$this->name}/css/animate.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/global.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/project.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/feedback_list.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/ocenka.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/services.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/accreditation_partners.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/page-history.css"); ?> 
    <?php $this->addMainCSS("templates/{$this->name}/css/page-answers.css"); ?> 
    <?php $this->addMainCSS("templates/{$this->name}/css/page-requisites.css"); ?> 
    <?php $this->addMainCSS("templates/{$this->name}/css/page-arbirtation.css"); ?> 
	  <?php $this->addMainCSS("templates/{$this->name}/css/page-articles.css"); ?>
    
    
	  <?php $this->addMainCSS("templates/{$this->name}/css/project-media.css"); ?>
    
    
        

    
    <?php $this->addMainJS("https://api-maps.yandex.ru/2.1/?load=package.full&amp;lang=ru_RU"); ?>
    <?php $this->addMainJS("https://yandex.st/jquery/2.2.3/jquery.min.js"); ?>
    
    
    <?php $this->addMainJS("templates/{$this->name}/js/jquery.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/jquery-modal.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/core.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/modal.js"); ?>    
    <?php $this->addMainJS("templates/{$this->name}/lib/velocity.min.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/lib/jquery.waypoints.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/lib/inputmask.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/lib/jquery.inputmask.js"); ?>
    
    <?php $this->addMainJS("templates/{$this->name}/lib/fancybox-master/jquery.fancybox.min.js"); ?>
         
    <?php $this->addMainJS("templates/{$this->name}/js/mobile.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/ymaps.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/display_mail.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/script.js"); ?>
    
    <?php if (cmsUser::isLogged()){ ?>
        <?php $this->addMainJS("templates/{$this->name}/js/messages.js"); ?>
    <?php } ?>
    <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/livingston-css3-mediaqueries-js/1.0.0/css3-mediaqueries.min.js"></script>
    <![endif]-->
    <?php $this->head(); ?>
    <meta name="csrf-token" content="<?php echo cmsForm::getCSRFToken(); ?>" />
    <style><?php include('options.css.php'); ?></style>
</head>
<body id="<?php echo $device_type; ?>_device_type">

    <div id="layout1">

        <?php if (!$config->is_site_on){ ?>
            <div id="site_off_notice"><?php printf(ERR_SITE_OFFLINE_FULL, href_to('admin', 'settings', 'siteon')); ?></div>
        <?php } ?>
            
        <?php $this->widgets('super-header', false); ?>                
                <?php $this->widgets('header', false); ?>                
        <!-- Форма установщик расстояния после меню -->
    <div class="m-p-filler-menu
                p-filler-menu 
                g-w_100p">
    </div>
         
        

        <?php if($this->hasWidgetsOn('top')) { ?>            
            <?php $this->widgets('top', false, 'wrapper_plain'); ?>
        <?php } ?>

            <?php
                $messages = cmsUser::getSessionMessages();
                if ($messages){
                    ?>
                    <div class="sess_messages">
                        <?php
                            foreach($messages as $message){
                                echo $message;
                            }
                        ?>
                    </div>
                    <?php
                }
            ?>        
            <?php $this->widgets('left-top'); ?>
            <?php if ($this->isBody()){ ?>
            <div class="g-bgc_lt_blue g-w_100p">
                <div class="g-w_1170">
                <?php $this->body(); ?>
                </div>
            </div>

            <?php } ?>
       
            <?php $this->widgets('left-bottom'); ?>       




        <?php if ($config->debug && cmsUser::isAdmin()){ ?>
            <div id="debug_block">
                <?php $this->renderAsset('ui/debug', array('core' => $core)); ?>
            </div>
        <?php } ?>

                    <?php if ($config->debug && cmsUser::isAdmin()){ ?>
                        <span class="item">
                            <a href="#debug_block" title="<?php echo LANG_DEBUG; ?>" class="ajax-modal"><?php echo LANG_DEBUG; ?></a>
                        </span>
                        <span class="item">
                            Time: <?php echo cmsDebugging::getTime('cms', 4); ?> s
                        </span>
                        <span class="item">
                            Mem: <?php echo round(memory_get_usage(true)/1024/1024, 2); ?> Mb
                        </span>
                    <?php } ?>
                
                    <?php $this->widgets('footer', false, 'wrapper_plain'); ?>


    </div>

</body>
</html>