import Swiper, { Navigation } from 'swiper';

export default class Awards
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
      spaceBetween: 10,
      slidesPerView: 1,
      slidesPerGroup: 1,
      breakpoints: {
        560: {
          slidesPerView: 2,
          slidesPerGroup: 2,
        },
        768: {
          slidesPerView: 3,
          slidesPerGroup: 3,
        },
        960: {
          slidesPerView: 4,
          slidesPerGroup: 4,
        },
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  }
}
