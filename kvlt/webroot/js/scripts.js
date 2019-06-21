$( document ).ready(function() {

    $('.preload').removeClass('preload');

    $(function() {
            if($('html').hasClass('-ms-')){
                console.log('IE Warning');
               // $('.ie_warning').show();
            }else{
                console.log('not IE');
            }
        });

/*************************************
        Global Elements
*************************************/

    //HEADROOM - HEADER
        $("#header").headroom({
          "offset": 0,
          "tolerance": 25,
        });

    //NAV BUTTONS
    	$('.menu_button').click(function(){
            if($('.body_wrapper').hasClass('active')){
                $(this).removeClass('active');
                $('.body_wrapper').removeClass('active');
                $('nav').removeClass('active');
            }else{
                $(this).addClass('active');
                $('.body_wrapper').addClass('active');
                $('nav').addClass('active');
            }
        });

/*************************************
        PAGES
*************************************/

    /*************************************
            HOME
    *************************************/
        
        var home_hero_swiper = new Swiper('.home_hero_slider', {
            spaceBetween: 200,
        });


/*************************************
        Special Effects
*************************************/
    

    //RANDOM QUOTE SELECTOR
        $(function() {
            var quotes = new Array(
                "The Past is Alive"
               
                ),
            randno = quotes[Math.floor( Math.random() * quotes.length )];
            $('#nav_tagline').html( randno );
        });


    //ALBUM ART CREDIT

    //TYPEWRITER TEXT EFFECT
        const typing = document.querySelectorAll('.typewriter');

        function type(element) {
        
            function randomOpacity() {
                return (Math.floor(Math.random() * 50) + 50)/100;
            }
            
            function randomEms() {
                if (Math.random() > .8) {
                    return (Math.floor(Math.random() * 100) - 50)/800;
                }
                else {
                    return 0;
                }
            }
            
            function wrap(char) {
                return '<span style="opacity:' + randomOpacity() + '; text-shadow:' + randomEms() + 'em ' + randomEms() + 'em currentColor;">' + char + '</span>';
            }
            
            const wrappedText = Array.from(element.textContent).map(wrap);
            
            element.innerHTML = wrappedText.join('');
        
        }
        
        typing.forEach(type);


    

    //ACHIEVEMENT CODE

        /****
         * Example HTML:
         * <a class="button achievement" data-title="Achievement Getter" data-description="You have unlocked you first achievement." data-icon='<i class="fas fa-ring"></i>'>Achievement Get</a>
         * 
         * Icons: https://fontawesome.com/icons?d=gallery&c=gaming-tabletop,halloween,music&m=free 
         * 
         */
        $('.achievement').click(function(){
            var title = $(this).data('title');
            var description = $(this).data('description');
            var icon = $(this).data('icon');
            
            $('#achievement_notification .title').text(title);
            $('#achievement_notification .description').text(description);
            $('#achievement_notification .icon>.inner').html(icon);
            
            $('#achievement_notification').addClass('active');
            setTimeout(function () { 
                    $('#achievement_notification').removeClass('active');
            }, 8000);
             
        });
         







});