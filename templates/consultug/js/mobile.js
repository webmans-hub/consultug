
$(document).ready(function() {
//$(window).resize(function() {
 
 //Функция очиски элемента от классов AnyGrid
 //возвращает массив классов
    function clearG(classList){
      
      var newClassList = [];
      var j = 0;
      for (var i = 0; i < classList.length; i++ ){
          console.log(classList[i]);
          if (classList[i] != 'g-col-' + classList[i].match(/\d{1,}/) 
              && classList[i] != 'g-span-' + classList[i].match(/\d{1,}/)
          ){
            console.log(classList[i]);
            newClassList.push(classList[i]);
          }
      } 
      
      return newClassList;
    };
    
    var width = $(window).width();
    console.log(width);
    
    //if (width < 750) {
        // уменьшаем текст у имен сотрудников
        //var ls_name = $(".js-ls-name");
        //console.dir(ls_name);
        //ls_name.removeClass('g-fz_24');
        //ls_name.addClass('g-fz_18');
    //}
    
    //if (width < 498){
        // переносим необходимые документы на новую строку
        /*
        var first = $(".js-first");
        for (var i = 0; i < first.length; i++){
            first[i].classList = clearG(first[i].classList); 
        }
        first.addClass('g-first g-col-2 g-span-11');
        */
        
        // изменяем размер кнопок
        //var but = $(".ps-button-order_report, .ps-button-get_consult");
        //but.css({"width": "95%"});
        
        // 
    //}
    
});
