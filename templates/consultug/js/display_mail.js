
// Защищаем email
// В верстке адреса должны быть с доменом @antispam.ru
// Пример ivanov@antispam.ru
$(document).ready(function() {
    var emailarr = $('.js-email');
    console.dir(emailarr);
    console.dir(emailarr.length);
    var index;
    for (index = 0; index < emailarr.length; ++index) {
        
        $(emailarr[index]).attr("href", $(emailarr[index]).attr("href").replace("antispam","consultug"));
        $(emailarr[index]).html($(emailarr[index]).html().replace("antispam","consultug"));
    }
});
