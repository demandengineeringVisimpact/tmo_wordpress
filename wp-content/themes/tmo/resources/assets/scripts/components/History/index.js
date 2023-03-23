import Swiper, { Navigation } from 'swiper';

export default class History
{
  constructor(el)
  {
    this._el = $(el);
    this.init();
  }

  init()
  {
    this.swiper = new Swiper(this._el[0], {
      modules: [Navigation],
      spaceBetween: 0,
      slidesPerView: 'auto',
      centeredSlides: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        960: {
          spaceBetween: 50,
        },
        1200: {
          spaceBetween: 100,
        },
      },
    });
  }
}
