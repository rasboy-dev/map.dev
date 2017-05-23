<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!-- Loading Yandex Map API modules -->
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script type="text/javascript">
        ymaps.ready(function() {
            var myMap = new ymaps.Map('myMap', {
               // центр и коэффициент масштабирования однозначно
               // определяют область картографирования
                center: [55.76, 37.64],
                zoom: 4
            });
            //myMap.behaviors.enable('ruler');
            
            var myGeoObject = new ymaps.GeoObject({
                // Тип геометрии - точка.
                type: 'Point',
                // Координаты точки.
                coordinates: [55.8, 37.8]
            });
            myMap.geoObjects.add(myGeoObject);
            
            var myPlacemark = new  ymaps.Placemark([55.8, 37.6]);
            myMap.geoObjects.add(myPlacemark);

            var myCollection = new ymaps.GeoObjectCollection ({},
                // Все объекты коллекции можно будет перемещать с помощью мыши.
                { geoObjectDraggable: true }
            );
            myCollection.add(myGeoObject);
            myCollection.add(myPlacemark);
            myMap.geoObjects.add(myCollection);

            ymaps.geocode('деревня Ивановка').then(
            // Геокодер возвращает результаты в виде коллекции
                function (res) {
                    myMap.geoObjects.add(res.geoObjects.get(7));
                })

            var data = {
              balloonContent: 'Hello Yandex!',
              hintContent: 'Метка',
              iconContent: '1'
            },
            options = {
                balloonHasCloseButton: true
            },
            myPlacemark = new ymaps.Placemark([48, 40], data, options);
            // Добавление объекта на карту
            myMap.geoObjects.add(myPlacemark);

            myMap.hint.open([55.76, 37.38],
              'Кто <em>поднимается</em> в гору?'
            );

            var myPlacemark = new ymaps.Placemark(
              [55.7, 37.6],
              { iconContent: 'Пользуйтесь пресетами' },
              // Иконка будет зеленой и растянется под iconContent
              { preset: 'islands#greenStretchyIcon' }
            );
            myMap.geoObjects.add(myPlacemark);
        });
    </script>
</head>
<body>
    <div id="myMap" style="width:100%;height:400px"></div>


</body>
</html>