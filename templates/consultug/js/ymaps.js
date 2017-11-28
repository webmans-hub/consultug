

$(document).ready(function() {
   //проверяем наличие элемента map
    if ($('.map').length > 0){
        ymaps.ready(init);
    }
});


var myMap,
	bigMap = false;

// создаем карту
function init () {
	myMap = new ymaps.Map('map', {
	center: [45.0254,38.9063],
	zoom: 17,
  controls: []
	});
  
  myMap.behaviors.disable('scrollZoom');
  myMap.behaviors.disable('drag');

	//создаем метки
	myPlacemarkKrasnodar = new ymaps.Placemark([45.0258, 38.9067], { 
		hintContent: 'Консалтин-Юг', 
		balloonContent: 'Компания по оценке любого вида иммущества' 
		});

	myPlacemarkTuapse = new ymaps.Placemark([44.101687, 39.080137], { 
		hintContent: 'Консалтин-Юг', 
		balloonContent: 'Компания по оценке любого вида иммущества' 
		});
		
	// добавляем метки
	myMap.geoObjects.add(myPlacemarkKrasnodar);
	myMap.geoObjects.add(myPlacemarkTuapse);
}

 //обработчик события клика на городе карты
 function cityClick(event){
		
		/*
		находим первый элемент у которого есть калсс map-city-active
		понимаем что по нашей логике он всегда будет один
		*/
		var elementClass = $('.map-city-active')[0].classList;
		
		//удаляем клас map-city-active у элемента
		elementClass.remove('map-city-active');
		
		//добавляем класс map-city-active нажатому элементу
		var el = $(event.currentTarget)[0];
		el.classList.add('map-city-active');
		
		var elCityAddr = $('.js-map-сity_addr')[0];
		
		//меняем адрес
		if (el.classList.contains('js-map-city_krasnodar')){
			elCityAddr.innerHTML = "350089,<br/> г. Краснодар,<br/> Рождественская набережная д 3,<br/> подъезд 5, офис 92";
			 myMap.setCenter([45.0254,38.9063]);
		}
		else{
			elCityAddr.innerHTML = "352800,<br/>Туапсинский район,<br/> г. Туапсе,<br/> ул. Шаумяна, д. 9";
			 myMap.setCenter([44.101687, 39.080137]);
		}
	}
	
$(document).ready(function(){
	$('.js-map-city').bind('click', cityClick);
});