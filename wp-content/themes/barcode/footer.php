
	<footer>

    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/@webcreate/infinite-ajax-scroll@^3.0.0-beta.6/dist/infinite-ajax-scroll.min.js"></script>

    <script>
        jQuery(function($){
            $('#filter').submit(function(){
                var filter = $(this);
                $.ajax({
                    url:'/wp-admin/admin-ajax.php', // обработчик
                    data:filter.serialize(), // данные
                    type:filter.attr('method'), // тип запроса
                    beforeSend:function(xhr){
                        filter.find('button').text('Загружаю...'); // изменяем текст кнопки
                    },
                    success:function(data){
                        filter.find('button').text('Применить фильтр'); // возвращаеи текст кнопки
                        $('#response').html(data);
                    }
                });
                return false;
            });








            // Animation flag
            var alm_is_animating = false;

// Set initial active item
//             document.querySelector('.alm-filter-nav li:first-child').classList.add('active'); // Set initial active state

// Click Event
            function filterClick(){

                // Get parent `<li/>`
                var parent = this.parentNode;
                if(parent.classList.contains('active') && !alm_is_animating){ // Exit if active
                    return false;
                }

                alm_is_animating = true; // Animation flag

                var active = document.querySelector('.alm-filter-nav li.active'); // Get `.active` element
                if(active){
                    active.classList.remove('active');
                }

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
            };




        });



    </script>


</body>
</html>
