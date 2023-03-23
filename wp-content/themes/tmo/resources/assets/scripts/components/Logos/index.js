import Swiper, { Navigation } from 'swiper';

export default class Logos
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
      spaceBetween: 32,
      loop: true,
      slidesPerView: 1,
      breakpoints: {
        376: {
          slidesPerView: 2,
        },
        540: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 4,
        },
        960: {
          slidesPerView: 5,
        },
        1160: {
          slidesPerView: 6,
        },
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  }
}
