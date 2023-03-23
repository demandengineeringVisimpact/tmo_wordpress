import Swiper, { Autoplay } from 'swiper';

export default class CustomerList
{
  constructor(el)
  {
    this._el = $(el);
    this.init();
  }

  init()
  {
    this.swiper = new Swiper(this._el[0], {
      modules: [Autoplay],
      spaceBetween: 32,
      loop: true,
      slidesPerView: 1,
      breakpoints: {
        480: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 4,
        },
      },
      autoplay: {
        delay: 1500,
      },
    });
  }
}
