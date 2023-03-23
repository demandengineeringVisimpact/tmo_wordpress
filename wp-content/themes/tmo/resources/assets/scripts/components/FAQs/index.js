export default class FAQs
{
  constructor(el)
  {
    this._el = $(el);
    this.init();
  }

  init()
  {
    this._el.find('.faq__answer').hide();
    this._el.on('click', '.faq__question', $.proxy(this.toggle, this));
    this._el.addClass('initialized');
  }

  toggle(e)
  {
    const question = $(e.currentTarget);
    const answer = question.next();
    const toggled = answer.is(':visible');
    console.log(question, answer, toggled)
    question.toggleClass('is-open', !toggled);
    answer.slideToggle(!toggled);
  }
}
