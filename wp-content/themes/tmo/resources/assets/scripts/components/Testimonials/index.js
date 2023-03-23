import Swiper, { EffectFade, Pagination } from 'swiper';

export default class Testimonials
{
  constructor(el)
  {
    this._el = $(el);
    this._testimonials = this._el.find('.testimonials');
    this.init();
  }

  init()
  {
    const effect = this._el.hasClass('layout-with_image')
      ? 'fade'
      : 'slide';

    this.swiper = new Swiper(this._testimonials[0], {
      effect,
      modules: [EffectFade, Pagination],
      autoHeight: true,
      centeredSlides: true,
      loop: this._testimonials.find('.swiper-slide').length > 1,
      spaceBetween: 10,
      fadeEffect: {
        crossFade: true,
      },
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,
      },
    });
  }
}
