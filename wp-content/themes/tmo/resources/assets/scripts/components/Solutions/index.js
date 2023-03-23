export default class Solutions
{
  constructor(el)
  {
    this._el = $(el);
    this.init();
  }

  intersecting(entries)
  {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        this._el.addClass('show');
        this._el.removeClass('hide');
        this._el.on('transitionend', () => {
          this._el.removeClass('show')
        })
      }
    });
  }

  init()
  {
    const threshold = 0.5;
    this._observer = new IntersectionObserver($.proxy(this.intersecting, this), { threshold });
    this._el.addClass('hide');
    this._observer.observe(this._el[0]);
  }
}
