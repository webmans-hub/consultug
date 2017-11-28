<?php $this->addMainCSS("templates/{$this->name}/css/layout_writeme.css"); ?>

<div id="wdg_write_<?php echo $side; ?>">
	
	<div class="button_pop"></div>

	<div class="write_me">

		<form id="write_form" enctype="multipart/form-data" method="post">
			
			<input type="text" name="name" placeholder="<?php echo LANG_WD_WRITEME_EMAIL_FORM_NAME; ?>" value="">
			<input type="text" name="phone" placeholder="<?php echo LANG_WD_WRITEME_EMAIL_FORM_PHONE; ?>" value="">
			<input type="text" name="mail" placeholder="<?php echo LANG_WD_WRITEME_EMAIL_FORM_MAIL; ?>" value="">
			<input type="text" name="subject" placeholder="<?php echo LANG_WD_WRITEME_EMAIL_FORM_SUBJECT; ?>" value="">
			<textarea name="message" placeholder="<?php echo LANG_WD_WRITEME_EMAIL_FORM_MESSAGE; ?>"></textarea>
			<input type="hidden" name="tomail" value="<?php echo $mail.",".$copy_mail; ?>">
			<input class="btn_write" type="submit" name="send" value="<?php echo LANG_WD_WRITEME_EMAIL_FORM_SEND; ?>">
			<div id="notice"></div>
			
		</form>

	</div>

</div>

<script>
	$(document).ready(function(){
		var show = 0;
		$('.button_pop').on('click', function(){
			if(show == 0){
				$('#wdg_write_right').addClass('form_visible'); 
				$('#wdg_write_left').addClass('form_visible'); 
				show = 1;
			}else{
				if(show == 1)
				$('#wdg_write_right').removeClass('form_visible');
				$('#wdg_write_left').removeClass('form_visible'); 	
				show = 0;			
			}
		});
	});

	
	$(function(){

        var field = new Array(<?php echo $required; ?>);
                
        $("#write_form").submit(function(e) {   
            var error=0;
            $("form").find(":input").each(function() {
                for(var i=0;i<field.length;i++){
                    if($(this).attr("name")==field[i]){ 
                        
                        if(!$(this).val()){
                            $(this).css('border', 'red 1px solid');
                            error=1;                                                         
                        }
                        else{
                            $(this).css('border', '#469afa 1px solid');
                        }
                        
                    }               
                }
           })
           
            if(error==0){ 
					var mess = $('#write_form').serializeArray();
					
					e.preventDefault();
					$.ajax({
					  url: "/ajax/sender.php",
					  type: "POST",
					  data: mess, 
					  success: function(response) {
						if(response == 1){
							$('#notice').empty();
							$('#notice').html('<?php echo LANG_WD_WRITEME_EMAIL_SUCCESS; ?>').css({'color': 'green', 'font-weight': 'bold'});
							$('#write_form')[0].reset();
						}else{
							if(response == 0)
							$('#notice').empty();
							$('#notice').html('<?php echo LANG_WD_WRITEME_EMAIL_ERROR; ?>');
						}
					  },
					  error: function(response) {
						
					 }
					});
            }
            else{
            if(error==1) var err_text = "<?php echo LANG_WD_WRITEME_EMAIL_NO_VALIDATE; ?>";
            $("#notice").html(err_text).css({'color': 'red', 'font-weight': 'bold'}); 
            $("#notice").fadeIn("slow"); 
            return false;
            }
            
            
                
        })
    });
	
	
</script>
