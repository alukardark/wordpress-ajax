<?php
get_header();
?>

    <div class="contacts">
        <div class="contacts__top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Как нас найти</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="contacts__content">
            <div class="contacts__map" id="map"></div>


            <div class="contacts__col">
                <div class="contacts__col-wrap">
                    <a href="tel:<?=get_field('settings-tel', 94)?>" class="contacts__tel"><?=get_field('settings-tel', 94)?></a>

                    <div class="contacts__address">
                        <?=get_field('settings-address', 94)?>
                    </div>
                    <a href="mailto:<?=get_field('settings-email', 94)?>" class="contacts__email"><?=get_field('settings-email', 94)?></a>


                    <div class="contacts__time-work">
                        <div class="contacts__time-work-title">
                            Время работы ресторана
                        </div>
                        <div class="contacts__time-work-row">
                            <div>ПН-ЧТ:</div>
                            <div><?=get_field('settings-work-time-1', 94)?></div>
                        </div>
                        <div class="contacts__time-work-row">
                            <div>ПТ:</div>
                            <div><?=get_field('settings-work-time-2', 94)?></div>
                        </div>
                        <div class="contacts__time-work-row">
                            <div>СБ:</div>
                            <div><?=get_field('settings-work-time-3', 94)?></div>
                        </div>
                        <div class="contacts__time-work-row">
                            <div>ВС:</div>
                            <div><?=get_field('settings-work-time-4', 94)?></div>
                        </div>
                    </div>

                    <ul class="contacts__soc">
                        <? if(get_field('settings-inst', 94)){ ?>
                            <li><a href="<?=get_field('settings-inst', 94)?>" class="contacts__soc--inst  btn-default waves-effect waves-light"></a></li>
                        <? } ?>
                        <? if(get_field('settings-facebook', 94)){ ?>
                            <li><a href="<?=get_field('settings-facebook', 94)?>" class="contacts__soc--facebook  btn-default waves-effect waves-light"></a></li>
                        <? } ?>
                        <? if(get_field('settings-tripadvisor', 94)){ ?>
                            <li><a href="<?=get_field('settings-tripadvisor', 94)?>" class="contacts__soc--tripadvisor  btn-default waves-effect waves-light"></a></li>
                        <? } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>


    <script>
        function init() {

            document.querySelector('#map').getAttribute('marker')


            let myMap = new ymaps.Map('map', {
                    center: [55.910541, 37.725108],
                    zoom: 15,
                    controls: []
                }),

                myPlacemark1 = new ymaps.Placemark([55.910541, 37.725108], {
                    balloonContent: ''
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: "<?=get_template_directory_uri() ?>./img/map-marker.svg",
                    iconImageSize: [70, 86],
                    iconImageOffset: [-35, -86],
                });


            myMap.geoObjects.add(myPlacemark1);

            if (window.matchMedia('(max-width: 991px)').matches) {
                myMap.behaviors.disable('scrollZoom');
            }
        }

        ymaps.ready(init);
    </script>

<?php
get_footer();
