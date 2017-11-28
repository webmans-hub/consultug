<!-- Форма обратной связи -->
<div class='p-feedback-bg
                g-pos_f g-d_n g-w_100p g-h_100p'>
        <div class='p-feedback-main
                    g-bgc_white g-bdrs_5'>
            <div class='g-d_b g-ta_r'>
                <img class='g-cur_p g-bxz_bb g-d_ib g-pt_15 g-pr_15 g-pb_15 g-pl_15' src='/upload/consultug/ico_form_closed.png' alt='иконка закрыть'>
            </div>
			
            <p class='js-feedback-form-mes g-pl_10 g-pr_10 g-ff_lt g-fz_14 g-lh_19 g-c_blue'>
            
            </p>
            <form action='#'>
				<input class='js-input-clear
                              p-feedback-url' 
							  name='feedback-url' type='hidden' value="<?php echo $_SERVER['REQUEST_URI']; ?>" >
                                <input class='p-feedback-form-button' name='feedback-form-button' type='hidden'>
                <input class='js-input-clear
                              p-feedback-name
                              g-pl_10 g-bd_n g-ff_lt g-fz_16 g-c_dk_blue' name='feedback-name' type='text' placeholder='Как вас зовут'>


                <input class='js-input-clear
                              p-feedback-phone
                              g-pl_10 g-bd_n g-ff_lt g-fz_16 g-c_dk_blue' name='feedback-phone' type='tel' placeholder='Ваш номер телефона'>
                <br/>                
                <input class='js-feedback-form
                              p-feedback-button
                              g-pb_10 g-pt_10 g-bgc_white g-ff_lt g-fz_14 g-c_blue' type='button' name='but' value='Перезвоните мне' />
            </form>
            <p class='g-fz_10 g-pl_15 g-ff_lt g-pr_15 g-pt_20 g-pb_45'>
                Нажимая кнопку «Перезвоните мне» Вы соглашаетесь с
                <a href='/pages/politika-konfidencialnosti.html'>условиями хранения персональных данных.</a>
            </p>
        </div>
    </div> 
    
	<script>
		$(document).ready(function(){ 
			$('.js-feedback-form').click(function(){
                              
                //проверяем форму перед отправкой
                var phone = $(".p-feedback-phone").val(),
                    name  = $(".p-feedback-name").val(),
                    regexphone = /\+7 \(\d{3}\) \d{3}\-\d{2}\-\d{2}/,
                    regexname = /[a-zA-Zа-яёА-ЯЁ]{2,20}$/;
                
                
                if (name.search(regexname) == -1){
                    alert("Имя может быть от 2-х до 20 символов!");
                    return false;
                }
                
                if (phone.search(regexphone) == -1){
                    alert("Укажите правильный номер телефона!");
                    return false;
                }
                
                //если все хорошо отправляем email
				$.ajax({ 
					url: '<?php echo href_to('feedback','ajax_add_handling');?>', 
					data: 'feedback-name='+$('.p-feedback-name').val()+'&feedback-phone='+$('.p-feedback-phone').val()+'&feedback-url='+$('.p-feedback-url').val()+'&feedback-form-button='+$('.p-feedback-form-button').val(), 
					cache: false, 
					success: function(arr){ 
						$('.js-feedback-form-mes').html(name+', благодарим за обращение.<br /> Скоро с Вами свяжется наш специалист.');
                        $(".p-feedback-phone").val('');
                        $(".p-feedback-name").val('');
                        
					} 
				});

                return true;
			}); 			
		});
	</script
