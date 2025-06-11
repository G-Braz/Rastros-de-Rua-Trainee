window.onload = function Carrossel() {
    const swiper = new Swiper('.swiper', {
        slidesPerView: 2,
        spaceBetween: 20,
        direction: "vertical",
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        mousewheel: true,
        loop: true
    });
};