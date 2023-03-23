import throttle from 'lodash.throttle';
import inRange from 'lodash.inrange';

const SCROLL_DOWN = 'SCROLL_DOWN';
const SCROLL_UP = 'SCROLL_UP';

export default class MajorSolutions
{
  constructor(el)
  {
    this._el = $(el);
    this._cards = this._el.find('.card');
    this._container = $('<div class="major-solutions-container"><div class="wrapper" /></div>');
    this._scrollTop = window.scrollY;
    this._winWidth = window.innerWidth;
    this.init();
  }

  get activeElement()
  {
    return this._activeElement;
  }

  set activeElement(index = 0)
  {
    this._container.find('.card__media')
      .removeClass('active')
      .eq(index)
      .addClass('active');
  }

  get scrollDirection()
  {
    return this._scrollTop < window.scrollY
      ? SCROLL_DOWN
      : SCROLL_UP;
  }

  findActive()
  {
    this._cards.each((i, el) => {
      const clientRect = el.getBoundingClientRect();
      const threshold = window.innerHeight / 4;

      if (inRange(threshold, clientRect.top, clientRect.bottom)) {
        this.activeElement = i;
      }
    })
  }

  onScroll()
  {
    this.findActive();
    this._scrollTop = window.scrollY;
  }

  onResize()
  {
    const winWidth = window.innerWidth;

    if (winWidth != this._winWidth) {
      this.positionContainer();
      this._winWidth = winWidth;
    }
  }

  positionContainer()
  {
    const firstClientRect = $(this._cards[0]).find('.card__media')[0].getBoundingClientRect();
    const lastClientRect = this._cards[this._cards.length - 1].getBoundingClientRect();
    const top = firstClientRect.top + window.scrollY;
    const bottom = lastClientRect.bottom + window.scrollY;
    const left = firstClientRect.left + window.scrollX;
    const height = bottom - top;
    const width = firstClientRect.width;

    this._container.css({ width, height, top, left });
  }

  appendMedia()
  {
    this._cards.each((i, el) => {
      const media = $(el).find('.card__media')
      this._container.children().append(media.clone());
    });
  }

  init()
  {
    window.addEventListener('scroll', throttle($.proxy(this.onScroll, this), 300));
    window.addEventListener('resize', throttle($.proxy(this.onResize, this), 300));
    $('body').append(this._container);
    this.positionContainer();
    this.appendMedia();
    this.activeElement = 0;
    this._cards.addClass('initialized');
  }
}
