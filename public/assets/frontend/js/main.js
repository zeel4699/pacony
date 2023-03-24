(function($)

{
    "use strict";



    /**
    * PRELOADER EFFECT
    * */
    var preloaderWrap = $( '#preloader-wrap' );
    var loaderInner   = preloaderWrap.find( '.preloader-inner' );

    $(window).on("load", function () {
        loaderInner.fadeOut();
        preloaderWrap.delay(350).fadeOut( 'slow' );
    });


    /**
    * BOOTSTRAP TOOLTIP
    * */
    $('[data-toggle="tooltip"]').tooltip();


    /**
    * BOOTSTRAP SCROLLSPY
    * */
    $('body').scrollspy({
        target: '#fixedNavbar',
        offset: 40
    });

    /**
    * SMOOTH SCROLLING
    * */
    $('.menu-link[href*=\\#]').on('click', function(event){
        event.preventDefault();
        $('html,body').animate(
        {
            scrollTop:$(this.hash).offset().top
        },
            1000,
            'easeInOutExpo'
        );
    });

    /**
    * HEADER ( NAVBAR )
    * */
    let header          = $( '.header' );
    let logoTransparent = $( '.logo-transparent' );
    let scrollTopBtn    = $( '.scroll-top-btn' );
    var whatsappScroll  = $( '#whatsappMultipleBtn' );
    var whatsappOnlyScroll   = $( '#whatsappButtonOnly ' );
    let logoNormal      = $( '.logo-normal' );
    let windowWidth     = $( window ).innerWidth();
    let scrollTop       = $( window ).scrollTop();
    let $dropdown       = $( '#nav-menu-wrap .dropdown' );
    let $dropdownToggle = $( '#nav-menu-wrap .dropdown-toggle' );
    let $dropdownMenu   = $( '#nav-menu-wrap .dropdown-menu' );
    let showClass        = 'show';
    var hassLandingHeader = header.hasClass('landing-header');

    if (hassLandingHeader === true){
        $('select').niceSelect();
    }
    $('.language-topbar .dropdown-item').on("click",function(){
        $('#dropdownMenuLink').text($(this).text());
    });

    // When Window On Scroll
    $( window ).on( 'scroll', function(){
        let scrollTop = $( this ).scrollTop();

        if( scrollTop > 85 ) {
            logoTransparent.hide();
            logoNormal.show();
            header.addClass( 'header-shrink' );
            scrollTopBtn.addClass( 'active' );
            whatsappScroll.addClass( 'active' );
            whatsappOnlyScroll.addClass( 'active' );
        }else {
            logoTransparent.show();
            logoNormal.hide();
            header.removeClass( 'header-shrink' );
            scrollTopBtn.removeClass( 'active' );
            whatsappScroll.removeClass( 'active' );
            whatsappOnlyScroll.removeClass( 'active' );
        }
    });

    // The same process is done without page scroll to prevent errors.
    if( scrollTop > 85 ) {
        logoTransparent.hide();
        logoNormal.show();
        header.addClass( 'header-shrink' );
        scrollTopBtn.addClass( 'active' );
        whatsappScroll.addClass( 'active' );
        whatsappOnlyScroll.addClass( 'active' );
    }else {
        logoTransparent.show();
        logoNormal.hide();
        header.removeClass( 'header-shrink' );
        scrollTopBtn.removeClass( 'active' );
        whatsappScroll.removeClass( 'active' );
        whatsappOnlyScroll.removeClass( 'active' );
    }

    // Window On Resize Hover Dropdown
    $( window ).on( 'resize', function() {
        let windowWidth  = $( this ).innerWidth();

        if ( windowWidth > 991 ) {

            $dropdown.on('mouseenter', function(){
                let hasShowClass  =  $( this ).hasClass( showClass );
                if( hasShowClass!==true ){
                    $( this ).addClass( showClass );
                    $( this ).find( $dropdownToggle ).attr( 'aria-expanded', 'true' );
                    $( this ).find( $dropdownMenu ).addClass( showClass );
                }
            });

            $dropdown.on('mouseleave',function(){
                $( this ).removeClass( showClass);
                $( this ).find( $dropdownToggle ).attr( 'aria-expanded', 'false' );
                $( this ).find( $dropdownMenu ).removeClass( showClass );
            });
        }else {
            $dropdown.off( 'mouseenter mouseleave' );
            header.find( '.main-menu' ).collapse( 'hide' );
        }
    });
    // The same process is done without page scroll to prevent errors.
    if ( windowWidth > 991 ) {

        $dropdown.on('mouseenter', function(){
            let hasShowClass  =  $( this ).hasClass( showClass );
            if( hasShowClass!==true ){
                $( this ).addClass( showClass );
                $( this ).find( $dropdownToggle ).attr( 'aria-expanded', 'true' );
                $( this ).find( $dropdownMenu ).addClass( showClass );
            }
        });

        $dropdown.on('mouseleave',function(){
            $( this ).removeClass( showClass);
            $( this ).find( $dropdownToggle ).attr( 'aria-expanded', 'false' );
            $( this ).find( $dropdownMenu ).removeClass( showClass );
        });
    }else {
        $dropdown.off( 'mouseenter mouseleave' );
    }

    scrollTopBtn.on("click", function (e) {
        e.preventDefault();
        $('html, body').animate(
            {
              scrollTop: 0
            },
            1000,
            'easeInOutExpo'
        );
    });

    /**
    * OWL CAROUSEL
    * */
    let landingClientsCarousel  = $( '#landingClientsCarousel' );
    let productListCarousel     = $( '#productListCarousel' );
    let latestBlogCarousel      = $( '#latestBlogCarousel' );
    var hasRtl                  = $("body").hasClass("rtl-mode");
    var heroSlider              = $( '.hero-slider' );

    if (hasRtl===true) {
        landingClientsCarousel.owlCarousel({
            loop:true,
            margin:20,
            dots:false,
            nav:true,
            rtl:true,
            smartSpeed:1000,
            navText: [ "<span class='fa fa-arrow-left'></span>","<span class='fa fa-arrow-right'></span>" ],
            responsive:{
                0:{
                    items:1
                },
                700:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
        });
        productListCarousel.owlCarousel({
            loop:true,
            margin:20,
            dots:false,
            nav:true,
            rtl:true,
            smartSpeed:1000,
            navText: [ "<span class='fa fa-arrow-left'></span>","<span class='fa fa-arrow-right'></span>" ],
            responsive:{
                0:{
                    items:1
                },
                700:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
        });
        latestBlogCarousel.owlCarousel({
            loop:true,
            margin:20,
            dots:false,
            nav:true,
            rtl:true,
            smartSpeed:1000,
            navText: [ "<span class='fa fa-arrow-left'></span>","<span class='fa fa-arrow-right'></span>" ],
            responsive:{
                0:{
                    items:1
                },
                700:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
        });
        heroSlider.owlCarousel({
            loop: true,
            margin:0,
            nav:true,
            rtl:true,
            dots: true,
            autoplay:true,
            autoplayTimeout:3000,
            smartSpeed: 600,
            autoplayHoverPause:true,
            navText: [ "<span class='fa fa-arrow-left'></span>","<span class='fa fa-arrow-right'></span>" ],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items: 1
                }
            }
        });
    } else {
        landingClientsCarousel.owlCarousel({
            loop:true,
            margin:20,
            dots:false,
            nav:true,
            smartSpeed:1000,
            navText: [ "<span class='fa fa-arrow-left'></span>","<span class='fa fa-arrow-right'></span>" ],
            responsive:{
                0:{
                    items:1
                },
                700:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
        });
        productListCarousel.owlCarousel({
            loop:true,
            margin:20,
            dots:false,
            nav:true,
            smartSpeed:1000,
            navText: [ "<span class='fa fa-arrow-left'></span>","<span class='fa fa-arrow-right'></span>" ],
            responsive:{
                0:{
                    items:1
                },
                700:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
        });
        latestBlogCarousel.owlCarousel({
            loop:true,
            margin:20,
            dots:false,
            nav:true,
            smartSpeed:1000,
            navText: [ "<span class='fa fa-arrow-left'></span>","<span class='fa fa-arrow-right'></span>" ],
            responsive:{
                0:{
                    items:1
                },
                700:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
        });
        heroSlider.owlCarousel({
            loop: true,
            margin:0,
            nav:true,
            dots: true,
            autoplay:true,
            autoplayTimeout:3000,
            smartSpeed: 600,
            autoplayHoverPause:true,
            navText: [ "<span class='fa fa-arrow-left'></span>","<span class='fa fa-arrow-right'></span>" ],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items: 1
                }
            }
        });
    }

    /**
    * DATA BG IMG PATH
    * */
    let dataBgItem         = $( '*[data-bg-image-path]' );

    dataBgItem.each( function() {
        let imgPath        = $( this ).attr( 'data-bg-image-path' );
        $( this).css( 'background-image', 'url(' + imgPath + ')' );
    });

    /**
    * WOW JS
    * */
    var wow = new WOW(
            {
            boxClass:     'wow',
            animateClass: 'animated',
            offset:       0,
            mobile:       true,
            live:         true
        }
    )
    wow.init();


    /**
    * Step Form
    * */

    var stepOneSelectItem = $( '.step-one-price-box' );
    var selectionPriceInput = $( 'input[name="selection_price"]' );
    stepOneSelectItem.on( 'click', function() {
        stepOneSelectItem.removeClass( 'active' );
        $( this ).addClass( 'active' );
        selectionPriceInput.val( $( this ).attr( 'data-price-value' ) );
    } );


    /**
     *  Whatsapp Multiple Btn Click
     * */

    var whatsappMultipleBtn = $( '#whatsappMultipleBtn' );
    var whatsappMultipleChat = $( '#whatsappMultipleChat' );

    whatsappMultipleBtn.on( 'click', function(e) {
        whatsappMultipleBtn.toggleClass( 'toggle' );
        whatsappMultipleChat.toggleClass( 'active' );
        e.preventDefault();
    } );


    /**
     * Whatsapp Multiple Click Item
     */

    var wtspTeamMulItemOnline = $( '.wtsp-team-item.online' );
    var whatsappMultipleChatCloseBtn = $( '#whatsappMultipleChatCloseBtn' );

    scrollTopBtn.on("click",function(){
        whatsappMultipleBtn.removeClass( 'toggle' );
        whatsappMultipleChat.removeClass( 'active' );
    });

    wtspTeamMulItemOnline.on( 'click',function() {
        var dataPhoneNumber   = $( this ).attr( 'data-phone-number' );
        var dataText          = $( this ).attr( 'data-text' );

        var WhatsAppUrl = 'https://web.whatsapp.com/send';

        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            WhatsAppUrl = 'https://api.whatsapp.com/send';
        }

        var url         = WhatsAppUrl+'?phone='+dataPhoneNumber+'&text='+dataText;
        var win         = window.open(url, '_blank');
        win.focus();

        whatsappMultipleBtn.toggleClass( 'toggle' );
        whatsappMultipleChat.toggleClass( 'active' );
    } );

    whatsappMultipleChatCloseBtn.on("click",function(){
        whatsappMultipleBtn.removeClass( 'toggle' );
        whatsappMultipleChat.removeClass( 'active' );
    });

    /**
     * Whatsapp Button Only
    */
    var whatsappButtonOnly = $( '#whatsappButtonOnly' );

    whatsappButtonOnly.on( 'click',function() {

        var dataPhoneNumber   = $( this ).attr( 'data-phone-number' );
        var dataText          = $( this ).attr( 'data-text' );

        var WhatsAppUrl = 'https://web.whatsapp.com/send';

        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            WhatsAppUrl = 'https://api.whatsapp.com/send';
        }

        var url         = WhatsAppUrl+'?phone='+dataPhoneNumber+'&text='+dataText;
        var win         = window.open(url, '_blank');
        win.focus();

        e.preventDefault();
    } );


})(jQuery);


