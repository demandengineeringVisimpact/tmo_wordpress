export default class MajorSolutions
{
  constructor(el)
  {
    this._el = $(el);
    this._cards = this._el.find('.card');
    this.init();
  }

  intersecting(entries)
  {
    entries.forEach((entry) => {
      const video = $(entry.target).find('.card__video');
      $(entry.target).toggleClass('hide', !entry.isIntersecting);

      if (video.length) {
        entry.isIntersecting ? video[0].play() : video[0].pause();
      }
    });
  }

  init()
  {
    const threshold = 0.5;
    this._observer = new IntersectionObserver($.proxy(this.intersecting, this), { threshold });
    this._cards.addClass('hide');
    this._cards.each((i, el) => { this._observer.observe(el) });
  }
}
