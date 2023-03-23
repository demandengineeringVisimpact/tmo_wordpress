import Swiper, { Navigation } from 'swiper';

export default class Feed
{
  constructor(el)
  {
    this._el = $(el);
    this.init();
  }

  init()
  {
    const nextEl = this._el.find('.swiper-button-next')[0];
    const prevEl = this._el.find('.swiper-button-prev')[0];

    this.swiper = new Swiper(this._el[0], {
      modules: [Navigation],
      spaceBetween: 32,
      slidesPerView: 1,
      breakpoints: {
        560: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        960: {
          slidesPerView: 4,
        },
      },
      navigation: { nextEl, prevEl },
    });
  }
}
