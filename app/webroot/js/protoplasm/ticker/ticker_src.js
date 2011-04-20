if (typeof Protoplasm == 'undefined')
	throw('protoplasm.js not loaded, could not intitialize ticker');
if (typeof Control == 'undefined') Control = {};

/**
 * class Control.Ticker
 * 
 * Creates a scrolling ticker (for stock quotes, etc) out of a series
 * of elements.
**/
Control.TickerBase = Class.create({

	initialize: function(element, generator, options) {

		this.options = Object.extend({
			'interval': 10,
			'step': 1
			}, options || {});

		this.element = $(element);
		this.generator = generator;

		this.element.style.overflow = 'hidden';
		this.scroller = new Element('div');
		this.element.appendChild(this.scroller);

		this.active = 0;
		this.offset = 0;

		this.start();
	},

	start: function() {
		this.timer = setInterval(function() { this.scroll(this.options.step); }.bind(this),
			this.options.interval);
	},

	scroll: function(pixels) {
		var items = this.generator();
		var first = scroller.firstChild;
		var last = scroller.childNodes[scroller.childNodes.length-1];
	},

	stop: function() {
		if (this.timer) {
			clearInterval(this.timer);
			this.timer = null;
		}
	}

});

Control.Ticker = Class.create(Control.TickerBase, {
	initialize: function($super, element, options) {
		var items = $(element).childElements();
		items.invoke('hide');
		$super(element, function() {
			// Re-clone in case contents changed.
			// Not sure how efficient this is.
			return items.invoke('clone', true);
		}, options);
}
});

Protoplasm.register('ticker', Control.Ticker);
