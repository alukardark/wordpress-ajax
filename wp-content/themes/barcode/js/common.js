$(window).on('load', function () {
    $('.basket__order-btn.submit').click(function(e){
        e.preventDefault();
        $(this).addClass('loading');
        $('.wpcf7-form').submit();
    });
});

function isEmpty(obj) {
    for (let key in obj) {
        return false;
    }
    return true;
}

var $val = '';
var $curBasket = '';
var $idProduct = '';
var $totalSumProduct = '';
var $countProduct = '';
var $basket = {};
var $product = {};

function basketAdd(){
    $('.basket-add').click(function (e) {
        e.preventDefault();
        $('.add-basket-message').addClass('active');

        setTimeout(function () {
            $('.add-basket-message').removeClass('active');
        }, 1000);

        $idProduct = $(this).parents('.product-card').attr('data-id');

        if(Cookies.get('products')){
            $product = JSON.parse(Cookies.get('products'));
        }


        if ($product[$idProduct]) {
            $product[$idProduct]++;
        } else {
            $product[$idProduct] = 1;
        }

        Cookies.set('products', JSON.stringify($product), {expires: 7});

        $val = $(this).parents('.product-card').find('.price').text();

        $val = parseInt($val.replace(/[^\d]/g, ''));

        $curBasket = $('.header .cur-basket').text();

        $curBasket = parseInt($curBasket.replace(/[^\d]/g, ''));

        $curBasket = $curBasket + $val;

        $curBasket = String($curBasket).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
        Cookies.set('basketSum', JSON.stringify($curBasket), {expires: 7});

        $('.cur-basket').html(JSON.parse(Cookies.get('basketSum')));


        console.log(Cookies.get('basketSum'));
        console.log(Cookies.get('products'));
    });
}

jQuery(document).ready(function ($) {


    if ($('#map').length > 0) {
        $('.footer').addClass('position-absolute');
    }
    if ($('#main-menu').length > 0) {
        $('.header').addClass('absolute');
        $('.header__nav').addClass('d-none');
        $('.header').removeClass('header--black');
        $('.footer').addClass('position-absolute');
    }


    var thisImg = '';
    $('a[data-img]').mouseenter(function () {
        $('a[data-img]').removeClass('active');
        $(this).addClass('active');

        thisImg = $(this).attr('data-img');

        $('li[data-img]').removeClass('active');

        $('li[data-img="' + thisImg + '"]').addClass('active');
    });



    // if ($('#bm').length > 0) {
    //     var animation = bodymovin.loadAnimation({
    //         container: document.getElementById('bm'),
    //         renderer: 'svg',
    //         loop: false,
    //         autoplay: true,
    //         path: directory_uri.stylesheet_directory_uri+'/data.json'
    //     });
    // }

    $('.menu__nav a').click(function (e) {
        e.preventDefault();
        $("html, body").animate({scrollTop: 0}, 500);
        return false;
    });


    basketAdd();


    if (Cookies.get('basketSum')) {
        $('.cur-basket').html(JSON.parse(Cookies.get('basketSum')));
    }


    // basket
    if ($('.basket').length > 0 && Cookies.get('products')) {
        $product = JSON.parse(Cookies.get('products'));
        for (var prop in $product) {
            $('.basket__product[data-id="' + prop + '"]').find('.basket__product-count').text($product[prop]);
        }
        $('.basket__product').each(function () {
            $countProduct = $(this).find('.basket__product-count').text();
            $val = $(this).find('.basket__product-price').text();
            $val = parseInt($val.replace(/[^\d]/g, ''));
            $totalSumProduct = $val * $countProduct;
            $totalSumProduct = String($totalSumProduct).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
            $(this).find('.basket__product-price-total span').html($totalSumProduct);
        });

        var thisId = '';

        $('.basket__product-plus').click(function () {
            thisId = $(this).parents('.basket__product').attr('data-id');
            $product[thisId]++;
            $countProduct = $(this).parents('.basket__product').find('.basket__product-count');


            $countProduct.text($product[thisId]);
            Cookies.set('products', JSON.stringify($product), {expires: 7});

            $val = $(this).parents('.basket__product').find('.basket__product-price').text();
            $val = parseInt($val.replace(/[^\d]/g, ''));

            $curBasket = $('.header .cur-basket').text();
            $curBasket = parseInt($curBasket.replace(/[^\d]/g, ''));
            $curBasket = $curBasket + $val;
            $curBasket = String($curBasket).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
            Cookies.set('basketSum', JSON.stringify($curBasket), {expires: 7});
            $('.cur-basket').html($curBasket);


            $totalSumProduct = $val * $countProduct.text();
            $totalSumProduct = String($totalSumProduct).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
            $(this).parents('.basket__product').find('.basket__product-price-total span').html($totalSumProduct);
        });

        $('.basket__product-minus').click(function () {
            thisId = $(this).parents('.basket__product').attr('data-id');

            $product[thisId]--;
            $countProduct = $(this).parents('.basket__product').find('.basket__product-count');
            $countProduct.text($product[thisId]);
            if ($product[thisId] <= 0) {


                var $this = $(this);
                setTimeout(function () {
                    $this.parents('.basket__product').addClass('animate__animated animate__fadeOutLeft');
                }, 100);
                setTimeout(function () {
                    $this.parents('.basket__product').remove();
                }, 500);

                delete $product[thisId];
            }

            $countProduct = $(this).parents('.basket__product').find('.basket__product-count');
            $countProduct.text($product[thisId]);
            Cookies.set('products', JSON.stringify($product), {expires: 7});

            $val = $(this).parents('.basket__product').find('.basket__product-price').text();
            $val = parseInt($val.replace(/[^\d]/g, ''));
            $curBasket = $('.header .cur-basket').text();
            $curBasket = parseInt($curBasket.replace(/[^\d]/g, ''));
            $curBasket = $curBasket - $val;
            $curBasket = String($curBasket).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
            Cookies.set('basketSum', JSON.stringify($curBasket), {expires: 7});
            $('.cur-basket').html($curBasket);

            $totalSumProduct = $val * $countProduct.text();
            $totalSumProduct = String($totalSumProduct).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
            $(this).parents('.basket__product').find('.basket__product-price-total span').html($totalSumProduct);


            if (isEmpty($product)) {
                Cookies.remove('products');
                $('.basket__article').addClass('animate__animated animate__fadeOutLeft');
                $('.basket__aside').addClass('animate__animated animate__fadeOutRight');
                $('.basket__remove-btn').addClass('animate__animated animate__fadeOutRight');
                setTimeout(function () {
                    $('.basket__article').remove();
                    $('.basket__aside').remove();
                    $('.basket__empty').addClass('active animate__animated animate__fadeInUpCustom');
                }, 500);
            }
        });

        $('.basket__product-remove').click(function () {
            thisId = $(this).parents('.basket__product').attr('data-id');

            $val = $(this).parents('.basket__product').find('.basket__product-price-total span').text();
            $val = parseInt($val.replace(/[^\d]/g, ''));

            $curBasket = $('.header .cur-basket').text();
            $curBasket = parseInt($curBasket.replace(/[^\d]/g, ''));
            $curBasket = $curBasket - $val;
            $curBasket = String($curBasket).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
            Cookies.set('basketSum', JSON.stringify($curBasket), {expires: 7});
            $('.cur-basket').html($curBasket);


            delete $product[thisId];

            var $this = $(this);
            $this.parents('.basket__product').addClass('animate__animated animate__fadeOutLeft');
            setTimeout(function () {
                $this.parents('.basket__product').remove();
            }, 600);

            Cookies.set('products', JSON.stringify($product), {expires: 7});


            if (isEmpty($product)) {
                Cookies.remove('products');
                $('.basket__article').addClass('animate__animated animate__fadeOutLeft');
                $('.basket__aside').addClass('animate__animated animate__fadeOutRight');
                $('.basket__remove-btn').addClass('animate__animated animate__fadeOutRight');
                setTimeout(function () {
                    $('.basket__article').remove();
                    $('.basket__aside').remove();
                    $('.basket__empty').addClass('active animate__animated animate__fadeInUpCustom');
                }, 500);
            }
        });

        $('.basket__remove-btn').click(function () {
            $(this).addClass('hidden');
            $('.basket__product').addClass('animate__animated animate__fadeOutLeft');
            setTimeout(function () {
                $('.basket__product').remove();
            }, 500);


            Cookies.set('basketSum', JSON.stringify('0'), {expires: 7});
            $('.cur-basket').html('0');

            $product = null;
            Cookies.remove('products');

            $('.basket__article').addClass('animate__animated animate__fadeOutLeft');
            $('.basket__aside').addClass('animate__animated animate__fadeOutRight');
            $('.basket__remove-btn').addClass('animate__animated animate__fadeOutRight');
            setTimeout(function () {
                $('.basket__article').remove();
                $('.basket__aside').remove();
                $('.basket__empty').addClass('active animate__animated animate__fadeInUpCustom');
            }, 500);


        });


    }

    $('.basket__persons-plus').click(function () {
        var $personsInput = $(this).parent('.basket__form-box').find('input');
        var $personsCount = $personsInput.val();
        $personsCount++;
        $personsInput.val($personsCount);
    });

    $('.basket__persons-minus').click(function () {
        var $personsInput = $(this).parent('.basket__form-box').find('input');
        var $personsCount = $personsInput.val();
        if ($personsCount > 1) {
            $personsCount--;
        } else {
            $personsCount = 1;
        }
        $personsInput.val($personsCount);
    });


    console.log(Cookies.get('products'));







    //add delivery
    var $totalPrice = $('.cur-basket-and-delivery').text();
        $totalPrice = parseInt($totalPrice.replace(/[^\d]/g, ''));

    var $deliveryPrice = $('.delivery-price').text();
    $deliveryPrice = parseInt($deliveryPrice.replace(/[^\d]/g, ''));

    $totalPrice = $totalPrice+$deliveryPrice;
    $totalPrice = String($totalPrice).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');

    $('.cur-basket-and-delivery').text($totalPrice);



});


document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( '5' == event.detail.contactFormId ) {
        Cookies.remove('basketSum');
        Cookies.remove('products');

        $('.basket__article').addClass('animate__animated animate__fadeOutLeft');
        $('.basket__aside').addClass('animate__animated animate__fadeOutRight');
        $('.basket__back-btn').addClass('animate__animated animate__fadeOutRight');

        setTimeout(function () {
            $('.basket').addClass('basket--succes');
            $('.basket__article').remove();
            $('.basket__aside').remove();
            $('.basket__succes').addClass('active animate__animated animate__fadeInUpCustom');
            $('.cur-basket').html('0')
        }, 500);
    }
}, false );

document.addEventListener( 'wpcf7submit', function( event ) {
    if ( '5' == event.detail.contactFormId ) {
        $('.basket__order-btn.submit').removeClass('loading');
    }
}, false );



window.almComplete = function (alm) {
    basketAdd();

    if (Cookies.get('basketSum')) {
        $('.cur-basket').html(JSON.parse(Cookies.get('basketSum')));
    }

    var tiltSettings = [
        {},
        {
            movement: {
                imgWrapper: {
                    translation: {x: 10, y: 10, z: 30},
                    rotation: {x: 0, y: -10, z: 0},
                    reverseAnimation: {duration: 200, easing: 'easeOutQuad'}
                },
                lines: {
                    translation: {x: 10, y: 10, z: [0, 70]},
                    rotation: {x: 0, y: 0, z: -2},
                    reverseAnimation: {duration: 2000, easing: 'easeOutExpo'}
                },
                caption: {
                    rotation: {x: 0, y: 0, z: 2},
                    reverseAnimation: {duration: 200, easing: 'easeOutQuad'}
                },
                overlay: {
                    translation: {x: 10, y: -10, z: 0},
                    rotation: {x: 0, y: 0, z: 2},
                    reverseAnimation: {duration: 2000, easing: 'easeOutExpo'}
                },
                shine: {
                    translation: {x: 100, y: 100, z: 0},
                    reverseAnimation: {duration: 200, easing: 'easeOutQuad'}
                }
            }
        },
        {
            movement: {
                imgWrapper: {
                    rotation: {x: -5, y: 10, z: 0},
                    reverseAnimation: {duration: 900, easing: 'easeOutCubic'}
                },
                caption: {
                    translation: {x: 30, y: 30, z: [0, 40]},
                    rotation: {x: [0, 15], y: 0, z: 0},
                    reverseAnimation: {duration: 1200, easing: 'easeOutExpo'}
                },
                overlay: {
                    translation: {x: 10, y: 10, z: [0, 20]},
                    reverseAnimation: {duration: 1000, easing: 'easeOutExpo'}
                },
                shine: {
                    translation: {x: 100, y: 100, z: 0},
                    reverseAnimation: {duration: 900, easing: 'easeOutCubic'}
                }
            }
        },
        {
            movement: {
                imgWrapper: {
                    rotation: {x: -5, y: 10, z: 0},
                    reverseAnimation: {duration: 50, easing: 'easeOutQuad'}
                },
                caption: {
                    translation: {x: 20, y: 20, z: 0},
                    reverseAnimation: {duration: 200, easing: 'easeOutQuad'}
                },
                overlay: {
                    translation: {x: 5, y: -5, z: 0},
                    rotation: {x: 0, y: 0, z: 6},
                    reverseAnimation: {duration: 1000, easing: 'easeOutQuad'}
                },
                shine: {
                    translation: {x: 50, y: 50, z: 0},
                    reverseAnimation: {duration: 50, easing: 'easeOutQuad'}
                }
            }
        },
        {
            movement: {
                imgWrapper: {
                    translation: {x: 0, y: -8, z: 0},
                    rotation: {x: 3, y: 3, z: 0},
                    reverseAnimation: {duration: 1200, easing: 'easeOutExpo'}
                },
                lines: {
                    translation: {x: 15, y: 15, z: [0, 15]},
                    reverseAnimation: {duration: 1200, easing: 'easeOutExpo'}
                },
                overlay: {
                    translation: {x: 0, y: 8, z: 0},
                    reverseAnimation: {duration: 600, easing: 'easeOutExpo'}
                },
                caption: {
                    translation: {x: 10, y: -15, z: 0},
                    reverseAnimation: {duration: 900, easing: 'easeOutExpo'}
                },
                shine: {
                    translation: {x: 50, y: 50, z: 0},
                    reverseAnimation: {duration: 1200, easing: 'easeOutExpo'}
                }
            }
        },
        {
            movement: {
                lines: {
                    translation: {x: -5, y: 5, z: 0},
                    reverseAnimation: {duration: 1000, easing: 'easeOutExpo'}
                },
                caption: {
                    translation: {x: 15, y: 15, z: 0},
                    rotation: {x: 0, y: 0, z: 3},
                    reverseAnimation: {duration: 1500, easing: 'easeOutElastic', elasticity: 700}
                },
                overlay: {
                    translation: {x: 15, y: -15, z: 0},
                    reverseAnimation: {duration: 500, easing: 'easeOutExpo'}
                },
                shine: {
                    translation: {x: 50, y: 50, z: 0},
                    reverseAnimation: {duration: 500, easing: 'easeOutExpo'}
                }
            }
        },
        {
            movement: {
                imgWrapper: {
                    translation: {x: 5, y: 5, z: 0},
                    reverseAnimation: {duration: 800, easing: 'easeOutQuart'}
                },
                caption: {
                    translation: {x: 10, y: 10, z: [0, 50]},
                    reverseAnimation: {duration: 1000, easing: 'easeOutQuart'}
                },
                shine: {
                    translation: {x: 50, y: 50, z: 0},
                    reverseAnimation: {duration: 800, easing: 'easeOutQuart'}
                }
            }
        },
        {
            movement: {
                lines: {
                    translation: {x: 40, y: 40, z: 0},
                    reverseAnimation: {duration: 1500, easing: 'easeOutElastic'}
                },
                caption: {
                    translation: {x: 20, y: 20, z: 0},
                    rotation: {x: 0, y: 0, z: -5},
                    reverseAnimation: {duration: 1000, easing: 'easeOutExpo'}
                },
                overlay: {
                    translation: {x: -30, y: -30, z: 0},
                    rotation: {x: 0, y: 0, z: 3},
                    reverseAnimation: {duration: 750, easing: 'easeOutExpo'}
                },
                shine: {
                    translation: {x: 100, y: 100, z: 0},
                    reverseAnimation: {duration: 750, easing: 'easeOutExpo'}
                }
            }
        }];
    function init() {
        var idx = 0;
        [].slice.call(document.querySelectorAll('a.tilter')).forEach(function (el, pos) {
            // idx = pos%2 === 0 ? idx+1 : idx;
            new TiltFx(el, tiltSettings[idx - 1]);
        });
    }
    // Preload all images.
    if (document.querySelector('.menu__article')) {
        imagesLoaded(document.querySelector('#article'), {background: '.menu__item-img'}, function (img) {
            document.body.classList.remove('loading');
            init();
        });
    }


    if(document.querySelector('.menu__list')){
        document.querySelectorAll('.menu__item--hidden').forEach(function (el) {
            el.parentNode.removeChild(el);
        });
        var element = document.querySelector('.menu__list .alm-listing>div:last-of-type');
        var newElement = document.createElement('div');
        newElement.className = 'menu__item menu__item--hidden';
        var newElement2 = document.createElement('div');
        newElement2.className = 'menu__item menu__item--hidden';
        var elementParent = element.parentNode;
        elementParent.insertBefore(newElement, element.nextSibling);
        elementParent.insertBefore(newElement2, element.nextSibling);
    }
    if(document.querySelector('.news__list')){
        document.querySelectorAll('.news__item--hidden').forEach(function (el) {
            el.parentNode.removeChild(el);
        });
        var element = document.querySelector('.news__list .alm-listing>div:last-of-type');
        var newElement = document.createElement('div');
        newElement.className = 'news__item news__item--hidden';
        var newElement2 = document.createElement('div');
        newElement2.className = 'news__item news__item--hidden';
        var elementParent = element.parentNode;
        elementParent.insertBefore(newElement, element.nextSibling);
        elementParent.insertBefore(newElement2, element.nextSibling);
    }

};






jQuery(function($){
    // Animation flag
    var alm_is_animating = false;

// Set initial active item
//             document.querySelector('.alm-filter-nav li:first-child').classList.add('active'); // Set initial active state
    if(document.querySelector('.clickable')){
        document.querySelector('.clickable li:first-child').classList.add('active'); // Set initial active state
    }





    // Click Event
    function filterClick(){



        // Get parent `<li/>`
        var parent = this.parentNode;
        if(parent.classList.contains('active') && !alm_is_animating){ // Exit if active
            return false;
        }

        if(parent.parentNode.classList.contains('clickable')){
            if(document.querySelector('.menu__nav li.active')){
                document.querySelector('.menu__nav li.active').classList.remove('active');
            }
        }

        alm_is_animating = true; // Animation flag

        // var active = document.querySelector('.alm-filter-nav li.active'); // Get `.active` element
        // if(active){
        //     active.classList.remove('active');
        // }

        this.parentNode.parentNode.querySelectorAll('li').forEach(function (el) {
            el.classList.remove('active');
        });



        parent.classList.add('active'); // Add active class

        // Set filters
        var transition = 'fade';
        var speed = 250;
        var data  = this.dataset;

        // Call core Ajax Load More `filter` function
        ajaxloadmore.filter(transition, speed, data);
    }

    // Event Handlers
    var filter_buttons = document.querySelectorAll('.alm-filter-nav li a');
    if(filter_buttons){
        [].forEach.call(filter_buttons, function(button) {
            button.addEventListener('click', filterClick);
        });
    }



    // Callback
    window.almFilterComplete = function(){
        alm_is_animating = false; // Clear animation flag
        if(document.querySelector('.menu__list')){
            document.querySelector('.menu__list').classList.remove('menu-empty');
        }
        if(document.querySelector('.news__list')){
            document.querySelector('.news__list').classList.remove('news-empty');
        }

    };
    // If empty
    window.almEmpty = function (alm) {
        if(document.querySelector('.menu__list')){
            document.querySelector('.menu__list').classList.add('menu-empty');
        }
        if(document.querySelector('.news__list')){
            document.querySelector('.news__list').classList.add('news-empty');
        }

    };




});



