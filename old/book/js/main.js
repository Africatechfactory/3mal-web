    $(document).ready(function(){
    var swiper = new Swiper('.content_wrapper .swiper-container', {
    effect: 'coverflow',
    spaceBetween: 40,
    centeredSlides: false,
    loop: false,
    grabCursor: true,
    speed: 1500,
    slidesPerView: 'auto',
    coverflowEffect: {
    rotate: 0,
    stretch: 10,
    depth: 250,
    modifier: 0,
    slideShadows : false,
    },
    autoplay: {
    delay: 3500,
    disableOnInteraction: false,
    },
    keyboard: {
        enabled: true,
      },
      pagination: {
        el: '.swiper-pagination',      
		clickable: true,
		dynamicBullets: true,
      },
	  navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },   
    });

    var swiper = new Swiper('.testimonial_wrapper .swiper-container', {
    effect: 'coverflow',
    spaceBetween: 40,
    centeredSlides: false,
    loop: false,
    grabCursor: true,
    speed: 1500,
    slidesPerView: 'auto',
    coverflowEffect: {
    rotate: 0,
    stretch: 10,
    depth: 250,
    modifier: 0,
    slideShadows : false,
    },
    autoplay: {
    delay: 3500,
    disableOnInteraction: false,
    },
    keyboard: {
        enabled: true,
      },
      pagination: {
        el: '.swiper-pagination',      
		clickable: true,
		dynamicBullets: true,
      },
	  navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },   
    });


    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        $('.navbar-collapse').removeClass("show");
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top
            }, 1000);
        }
    });
    });