$(function() {

    $(document).on('click', '[href="#replyForm"]', function () {
        if ($(this).attr('aria-expanded') == 'true')
        {
            $('html, body').animate({scrollTop: $(this).offset().top}, 500);
        }
    });

    $(document).on('click', '[data-action="next-step"]', function () {
        var $stepCard = $(this).parents(".card");
        $stepCard.removeClass('error');
        $stepCard.addClass('done');
    });

    $(document).on('click', '[data-action="prev-step"]', function () {
        var $stepCard = $('[data-step-id="' + $(this).attr('data-target') + '"]');
        $stepCard.removeClass('error');
        $stepCard.removeClass('done');
    });

});

function allRequestsMapInit(dataUrl)
{
    var myMap;
    var placemarkCollections = {};
    var placemarkList = {};
    var shopList = [];

    function init() {

        // Создаем карту
        myMap = new ymaps.Map("map", {
            center: [56, 37],
            zoom: 8,
            controls: [],
            zoomMargin: [20]
        });

        for (var i = 0; i < shopList.length; i++) {

            // Добавляем название города в выпадающий список
            $('select#cities').append('<option value="' + i + '">' + shopList[i].cityName + '</option>');

            // Создаём коллекцию меток для города
            var cityCollection = new ymaps.GeoObjectCollection();

            for (var c = 0; c < shopList[i].shops.length; c++) {
                var shopInfo = shopList[i].shops[c];

                var ballonContent = [];
                for (var j = 0; j < shopInfo.requests.length; j++)
                {
                    ballonContent.push("<strong>" + shopInfo.requests[j].name + "</strong>" + "<p>" + shopInfo.requests[j].description + "</p>");
                }

                var shopPlacemark = new ymaps.Placemark(
                    shopInfo.coordinates,
                    {
                        hintContent: shopInfo.address + " (" + shopInfo.requests.length + ")",
                        balloonContent: ballonContent.join("<hr>")
                    },
                    {
                        iconLayout: 'default#image',
                        iconImageHref: '/template/app/img/auchan_icon.png',
                        iconImageSize: [30, 42],
                        iconImageOffset: [-5, -38]
                    }
                );

                if (!placemarkList[i]) placemarkList[i] = {};
                placemarkList[i][c] = shopPlacemark;

                // Добавляем метку в коллекцию
                cityCollection.add(shopPlacemark);

            }

            placemarkCollections[i] = cityCollection;

            // Добавляем коллекцию на карту
            myMap.geoObjects.add(cityCollection);

        }

        $('select#cities').trigger('change');
        $("#cityShop").fadeIn(500);
    }

    $.ajax({
        url: dataUrl
    }).done(function(data) {
        shopList = data;
        ymaps.ready(init);
    });

    // Переключение города
    $(document).on('change', $('select#city'), function () {
        var cityId = $('select#cities').val();

        // Масштабируем и выравниваем карту так, чтобы были видны метки для выбранного города
        myMap.setBounds(placemarkCollections[cityId].getBounds(), {checkZoomRange:true}).then(function(){
            if(myMap.getZoom() > 15) myMap.setZoom(15); // Если значение zoom превышает 15, то устанавливаем 15.
        });

        $('#shops').html('');
        $(".all-requests__list").mCustomScrollbar("destroy");
        $('.all-requests__list.requests-list').html('');
        for (var c = 0; c < shopList[cityId].shops.length; c++) {
            $('#shops').append('<li class="list-group-item" value="' + c + '">' + shopList[cityId].shops[c].address + ' (' + shopList[cityId].shops[c].requests.length + ')' + '</li>');
            for (var i = 0; i < shopList[cityId].shops[c].requests.length; i++)
            {
                $('.all-requests__list.requests-list').append('<div class="col-12 py-2 requests-list__item">' +
                    '<h4>' + shopList[cityId].shops[c].requests[i].name + '</h4>' +
                    '<p>' + shopList[cityId].shops[c].requests[i].description + '</p>' +
                    '<a class="btn btn-outline-primary float-right" href="/request/' + shopList[cityId].shops[c].requests[i].id + '">Ответить на заявку</a>' +
                    '<div class="clearfix"></div>' +
                    '</div>');
            }
        }
        $(".all-requests__list").mCustomScrollbar();
    });

    // Клик на адрес
    $(document).on('click', '#shops li', function () {

        var cityId = $('select#cities').val();
        var shopId = $(this).val();

        $("#shops li").removeClass("active");
        $(this).addClass("active");

        myMap.setBounds(placemarkCollections[cityId].getBounds(), {checkZoomRange:true}).then(function(){
            if(myMap.getZoom() > 15) myMap.setZoom(15); // Если значение zoom превышает 15, то устанавливаем 15.
            placemarkList[cityId][shopId].balloon.open();
        });
    });
}

function detailRequestMap(mapData)
{
    var myMap;

    function init() {

        // Создаем карту
        myMap = new ymaps.Map("map", {
            center: [56, 37],
            zoom: 8,
            controls: [],
            zoomMargin: [20]
        });

        var cityCollection = new ymaps.GeoObjectCollection();

        var ballonContent = [];
        ballonContent.push("<strong>" + mapData.name + "</strong>" + "<p>" + mapData.description + "</p>");

        var shopPlacemark = new ymaps.Placemark(
            mapData.coordinates,
            {
                hintContent: mapData.address,
                balloonContent: ballonContent.join("<hr>")
            },
            {
                iconLayout: 'default#image',
                iconImageHref: '/template/app/img/auchan_icon.png',
                iconImageSize: [30, 42],
                iconImageOffset: [-5, -38]
            }
        );
        // Добавляем метку в коллекцию
        cityCollection.add(shopPlacemark);
        // Добавляем коллекцию на карту
        myMap.geoObjects.add(cityCollection);

        // Масштабируем и выравниваем карту так, чтобы были видны метки для выбранного города
        myMap.setBounds(cityCollection.getBounds(), {checkZoomRange:true}).then(function(){
            if(myMap.getZoom() > 15) myMap.setZoom(15); // Если значение zoom превышает 15, то устанавливаем 15.
            cityCollection.balloon.open();
        });
    }

    ymaps.ready(init);
}

function newRequestLoadData(dataUrl) {
    var mapData = [];

    $.ajax({
        url: dataUrl
    }).done(function(data) {
        mapData = data;
        $('#city').html('');
        $('#shop').html('');

        for(var i = 0; i < data.length; i++)
        {
            $('#city').append('<option value="' + i + '">' + data[i].cityName + '</option>');
        }

        for(var i = 0; i < data[0].shops.length; i++)
        {
            $('#shop').append('<option>' + data[0].shops[i].address + '</option>');
        }
    });

    $(document).on('change', '#city[name="city"]', function () {
        var $shops = $('#shop[name="shop"]'),
            curCity = $(this).val();

        if (typeof(mapData[curCity]) != "undefined")
        {
            $shops.html('');
            for(var i = 0; i < mapData[curCity].shops.length; i++)
            {
                $('#shop').append('<option>' + mapData[curCity].shops[i].address + '</option>');
            }
        }
    });
}
