/*
    ФОРМА ОБРАТНОГО ЗВОНКА
    #_FEEDBACK
*/
//Красиво прячем форму заказа при закрытии
$(document).ready(function() {
       $('.p-feedback-main').find('img').click(
        function()
        {
           // прячем main
           $('.p-feedback-main').velocity(
                      { 
                        scale: 0
                      },
                      { 
                        duration: 800,
                        display: "none"
                      });
            //через несколько секунд прячем задний фон          
            setTimeout(function() { 
                $('.p-feedback-bg').velocity(
                      { 
                        opacity: 0
                      },
                      { 
                        duration: 300,
                        display: "none"
                      });

            }, 300);          
            
        }
    );
});

// Показываем форму заказа
$(document).ready(function() {
   $('.js-form-show').click(
        function()
        {
           // Показываем main  
           
           //очищаем сообщение 
           $('.js-feedback-form-mes').html('');
           
           var $button_click = $('.p-feedback-form-button');
           
           
           $('.p-feedback-bg, .p-feedback-main').velocity(
                      { 
                        opacity: 1,
                        scale: 1
                      },
                      { 
                        duration: 500,
                        display: "block"
                      }); 
            if ($(this).hasClass('p-button-get_call')){
                $button_click.val('Заказать звонок');
            }
            else if ($(this).hasClass('p-button-order_report')){
                $button_click.val('Заказать отчет об оценке со скидкой 5%');
            }
            else if ($(this).hasClass('p-button-get_consult')){
                $button_click.val('Заказать бесплатную консультацию');
            }
            else{
                $button_click.val('Кнопка в арбитражке');
            }
        }
    ); 
});

/*подключаем маску для номера телефона
  проверяем форму перед отправкой
*/

$(document).ready(function() {
	$(".p-feedback-phone").inputmask({"mask": "+7 (999) 999-99-99"});
});



/*
    МЕНЮ
    #_HEADER-MENU
*/

// прилипание меню во время скрола вверх
$(document).ready(function() {
    
    var lastScrollTop = 0;
    
    var header = $(".js-sw-menu");
    
    $(window).scroll(function(event){
       
       var st = $(this).scrollTop();
       
       if (st > lastScrollTop){ 
        header.css({
                        "position": "absolute",
                        "top": "-80px"
                    });
       } else if (st < lastScrollTop - 15) {
        header.css({
                        "position": "fixed",
                        "top": "0",
                        "transition": "all 0.5s"
                    });
       }
       
       if (lastScrollTop < 400){
        header.css({
                        "position": "absolute",
                        "top": "0",
                    });  
       }
       lastScrollTop = st;
    });
});

//третье меню подсвечиваем иконки
$(document).ready(function(){
    //наведение
    $('.js-menu-third>li').mouseover(
        function()
        {
            var img = $(this).find('img');
            var p = $(this).find('p');
            img.attr("src", img.attr("src").replace("_b","_w"));
            p.toggleClass('g-c_dk_blue g-c_white');
            
        }
        )
    //потеря фокуса
    $('.js-menu-third>li').mouseout(
        function()
        {
            var img = $(this).find('img');
            var p = $(this).find('p');
            img.attr("src", img.attr("src").replace("_w","_b"));
            p.toggleClass('g-c_dk_blue g-c_white');
        }
        )
});

//показываем третье меню при клике во втором меню
$(document).ready(function(){
    $('.js-header-menu-second>li').click(
        function()
        {
            var menu_third = $(this).find('.js-menu-third');
            $('.js-menu-third').not(menu_third).slideUp('fast');
            menu_third.slideToggle('fast');
        }
    );
    
    $('.js-menu-third').mouseleave(
        function()
        {
            $(this).slideToggle('fast');
        }
    );
});


/*
    МОБИЛЬНОЕ МЕНЮ
*/
//Аккордион мобильног меню
$(document).ready(function(){
    //Скрываем все области контента аккордиона
    $('.js-accordion.p-mobile-second-menu').find('.js-accordion-content').hide();
    
    //Аккордеон
    $('.js-accordion.p-mobile-second-menu').find('.js-accordion-header').click(
        function()
        {
            var next = $(this).next();
            next.slideToggle('fast');
            $('.js-accordion.p-mobile-second-menu .js-accordion-content').not(next).slideUp('fast');
            
            //определяем картинку текущего нажатого элемента
            var elImg = $(this).find('img');
            //удаляем у всех элементов кроме нажатого класс ps-services-img_rotate
            $('.js-accordion.p-mobile-second-menu .p-mobile-second-menu-img').not(elImg).removeClass('p-mobile-second-menu-img_rotate');
            
            elImg.toggleClass('p-mobile-second-menu-img_rotate');
        }
    );
});

//закрываем мобильное меню
$(document).ready(function() {
       $('.js-mobile-button').click(
       
        function()
        {
           // прячем main
           $('.js-mobile-bg').velocity(
            "slideUp", { delay: 200, duration: 200 }
            );
        }
    );
});

//Открываем мобильное меню
$(document).ready(function() {
       $('.js-p-header-button-menu').click(
       
        function()
        {
            
           // прячем main
           $('.js-mobile-bg').velocity(
            "slideDown", { delay: 200, duration: 200 }
            );            
        }
    );
});




/*
    ПОПУЛЯРНЫЕ УСЛУГИ
    #_POPULAR_SERVICES
*/

//Акордион для популярных услуг
$(document).ready(function(){
    //Скрываем все области контента аккордиона
    $('.js-accordion.ps-services').find('.js-accordion-content').hide();
    
    //Аккордеон
    $('.js-accordion.ps-services').find('.js-accordion-header').click(
        function()
        {
            var next = $(this).next();
            next.slideToggle('fast');
            $('.js-accordion.ps-services .js-accordion-content').not(next).slideUp('fast');
            
            //определяем картинку текущего нажатого элемента
            var elImg = $(this).find('img');
            //удаляем у всех элементов кроме нажатого класс ps-services-img_rotate
            $('.ps-services-img').not(elImg).removeClass('ps-services-img_rotate');
            
            elImg.toggleClass('ps-services-img_rotate');
        }
    );
});



/*
    ВОПРОС-ОТВЕТ
    #_ANSWERS
*/

// Акордион для вопросов-ответ
$(document).ready(function(){
    //Скрываем все области контента аккордиона
    $('.js-accordion.js-answers').find('.js-accordion-content').hide();
    
    //Аккордеон
    $('.js-accordion.js-answers').find('.js-accordion-header').click(
        function()
        {
            var next = $(this).next();
            next.slideToggle('fast');
            
            $('.js-accordion.js-answers .js-accordion-content').not(next).slideUp('fast');
            //return false;
        }
    );
});



/*
    ПРЕИМУЩЕСТВА
    #_ABOUT_COMPANY
*/

//анимация блока преимуществ
$(document).ready(function() {
	
    var el = $('.js-ac-one');
	
    el.waypoint(function(dir){
        
        if ( dir === 'down'){

            el.removeClass('g-v_h fadeOutDown');
            el.addClass('animated fadeInUp'); 
        }   
        },{
            offset: '95%'
        });
    /*el.waypoint(function(dir){
        
        if ( dir === 'up'){
            console.log('2');
            el.removeClass('fadeInUp');
            el.addClass('fadeOutDown');
        }    
        },{
            offset: '95%'
        });
    el.waypoint(function(dir){
        if ( dir === 'down'){
            console.log('3');
            el.removeClass('fadeInUp');
            el.addClass('fadeOutDown'); 
        }
        },{
            offset: '-10%'
        });
    el.waypoint(function(dir){
        if ( dir === 'up'){
            console.log('4');
            el.removeClass('g-v_h fadeOutDown');
            el.addClass('fadeInUp');
        }
        },{
            offset: '10%'
        });
        */
});



/*
    БАНКИ ПАРТНЕРЫ
    #_TRUST_US
*/

//банки партнеры
$(document).ready(function(){
    //наведение
    $('.js-table-banks').find('img').mouseover(
        function()
        {
            $(this).attr("src", $(this).attr("src").replace("_blue","_color"));

        }
    );
    //потеря фокуса
    $('.js-table-banks').find('img').mouseout(
        function()
        {
            $(this).attr("src", $(this).attr("src").replace("_color","_blue"));
        }
    );
});




/*
    ДАННЫЕ КАРТЫ
    #_MAP_INFO
*/

//анимация блока контактной информации карты
$(document).ready(function() {
	
    var el = $('.js-map-content');
	var width = $(window).width();
    
    if (width >= 960){
        
        el.waypoint(function(dir){
        
        if ( dir === 'down'){
            el.velocity({
                        "top": "-25px"
                    }, { duration: 2000 });
        }   
        },{
            offset: '80%'
        });
        el.waypoint(function(dir){
        
        if ( dir === 'up'){
            el.velocity({
                        "top": "-70px"
                    }, { duration: 2000 });
        }    
        },{
            offset: '60%'
        });
    }
        
});


/*
    БАНЕР В СТАТЬЕ
    #_BANNER
*/
/* останавливаем в нужном месте.
    Элемент перед которым останавливаем указывается в переменную elstop
*/
/*
$(document).ready(function() {
	
    var baner =  $('.js-p-banner-main');
    
    if (baner.length > 0){
        var elstop = $('.js-baner-stop');
        console.dir(elstop);
        var w = $(window).width(); 
        
        var parentSize = elstop['outerHeight']();
        var parentPos = elstop.offset().top;
        var banerSize = baner['outerHeight']();
        
        console.log('w = '+ w);
        console.log('parentSize = '+ parentSize);
        console.log('parentPos = '+ parentPos);
        console.log('banerSize = '+ banerSize);
        console.log('TOP= '+ elstop[0].offsetTop);
          
        if (w >= 960){
            elstop.waypoint(function(dir){
                console.log('tut!!!!');
                if ( dir === 'down'){
                    baner.css({
                                "position": "absolute",
                                "top": parentPos - 360 - 30 + 'px'
                            });
                } 
            },{
                offset: 360 + 90 + 'px' 
            }    
            );        
            
            elstop.waypoint(function(dir){
            
                if ( dir === 'up'){
                    baner.css({
                                "position": "fixed",
                                "top": '80px'
                            });
                }    
            },{
                offset: 360 + 90 + 'px' 
            }    
            );
        }
    }
});
 */
/*
    КНОПКА ЗАКАЗАТЬ ЗВОНОК
*/
/*
$(document).ready(function() {
	
    var baner =  $('.js-button-get_call-cover');
    var elstop = $('.js-baner-stop');
    
    var h = $(window).height();
    
    var parentSize = elstop['outerHeight']();
    var parentPos = elstop.offset()['top'];
    var banerSize = baner['outerHeight']();
    
    console.log('parentSize2 = '+ parentSize);
    console.log('parentPos2 = '+ parentPos);
    console.log('banerSize2 = '+ banerSize);
      

        elstop.waypoint(function(dir){
          console.log('triggerPoint ' + this.triggerPoint); 
            if ( dir === 'down'){
                baner.css({
                            "position": "absolute",
                            "top": parentPos - banerSize + 10 + 'px'
                        });
            } 
        },{
            offset: parentPos + 'px' 
        }    
        );        
        
        elstop.waypoint(function(dir){
        
            if ( dir === 'up'){
                baner.css({
                            "position": "fixed",
                            "top": h - 45 + 'px'
                        });
            }    
        },{
            offset: banerSize + 100 +  'px' 
        }    
        );
});
*/
