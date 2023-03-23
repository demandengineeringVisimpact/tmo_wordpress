export default class Stats
{
  constructor(el)
  {
    this._el = $(el);
    this.init();
  }

  init()
  {
    this._el.find('.stat__title').each((i, el) => {
      const digits = $(el).find('span');

      if (digits.length) {
        digits.prop('Counter', 0).animate({
          Counter: Number(digits.text().replace(/\D/g, '')),
        }, {
          duration: 800,
          easing: 'swing',
          step(val) {
            const formatter = new Intl.NumberFormat('en-US');
            const step = Math.ceil(val);
            digits.text(formatter.format(step));
          },
        });
      }
    });
  }
}
