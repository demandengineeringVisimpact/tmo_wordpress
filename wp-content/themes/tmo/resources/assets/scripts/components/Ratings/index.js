export default class Ratings
{
  constructor(el)
  {
    this._el = $(el);
    this.init();
    this.inView = false;
    this.ended = false;
  }

  intersecting(entries)
  {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        this.inView = true;
      }
    });
  }

  init()
  {
    const threshold = 0.5;
    this._observer = new IntersectionObserver($.proxy(this.intersecting, this), { threshold });
    this._el.addClass('hide');
    this._observer.observe(this._el[0]);
    $('.block.-hero').on('transitionend', () => {
      this.ended = true;
    });

    const timer = () => {
      setTimeout(() => {
        if (this.inView && this.ended) {
          this._el.removeClass('hide');
        }

        else {
          timer();
        }
      }, 100);
    }

    timer();
  }
}
