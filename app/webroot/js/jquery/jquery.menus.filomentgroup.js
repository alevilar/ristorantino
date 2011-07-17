/*-------------------------------------------------------------------- 
Scripts for creating and manipulating custom menus based on standard <ul> markup
Version: 1.0, 01.18.2008

By: Maggie Costello Wachs (maggie@filamentgroup.com) and Scott Jehl (scott@filamentgroup.com)
	http://www.filamentgroup.com
	* reference article: http://www.filamentgroup.com/lab/jquery_ipod_style_drilldown_menu/
		
Copyright (c) 2008 Filament Group
Licensed under GPL (http://www.opensource.org/licenses/gpl-license.php)

Dependencies:
	jQuery library
	position.jQuery.js
	utilities.js
--------------------------------------------------------------------*/

/* Parameters: 
@settings: see notes below
@positionOpts: // the orientation of the menu relative to the link that calls it
	posX: 'left', 
	posY: 'bottom',
	offsetX: 0,
	offsetY: 0,
	directionH: 'right',
	directionV: 'down', 
	detectH: true, // do horizontal collision detection
	detectV: true, // do vertical collision detection
	linkToFront: false // make the caller link appear over the menu (visual effect)
*/

function Menu(caller, settings) {
	var settings = jQuery.extend({
		content: null, // markup string to be inserted into the menu
		positionOpts: null, // see alternate options above -- must be passed in object notation, i.e., { offsetX: 10 }
		width: 160, // width of menu container
		maxHeight: 200, // max height of menu (if a drilldown: height does not include breadcrumb)
		showSpeed: 500, // show/hide speed in milliseconds
		callerOnState: 'btnMenuOn', // class to change the appearance of the link when the menu is showing
		itemHover: 'hover', // class for menu option hover state
		altClasses: null, // any additional classes for the menu container, separated by spaces
		crossSpeed: 300, // cross-fade speed for multi-level menus
		selectCategories: false, // false = selecting a category will navigate you to the next level until you reach a leaf node; true = each category is an accepted value in addition to leaf node
		nextMenuLink: 'nextLevel', // class to identify the link used in the multi-level menu to show the next level -- include the preceding "."
		topLinkText: 'All'
	}, settings);
	
	var menuLink = $(caller);
	var menu = $('<div class="menuContainer">'+settings.content+'</div>');
	var menuOpen = false;
	
	if (settings.selectCategories) {
		menu.find('li:has(ul)').each(function(){
			$(this).find('a:first').after('<a href="#" class="'+settings.nextMenuLink+'">View next level &gt;</a>');
		});
	};
	
	this.create = function(){		
		if (settings.content) {
		
			menu.css({
				position: 'absolute', 
				top: 0, 
				left: '-9999px'
			});
			
			if (settings.altClasses) { menu.addClass(settings.altClasses); };
			if (menuLink.width() > menu.width()) { menu.css({ width: menuLink.width() }); };
			
			menu.appendTo('body').setRandomId({ attribute: 'menuid' }).css({ width: settings.width }).find('ul:first').addClass('menu').css({ position: 'relative' });
			
			// close all open menus			
			$('*[menuid]').parent().trigger('click');					
						
			if (settings.callerOnState) { menuLink.addClass(settings.callerOnState); };
			
			// if there are multiple levels, create a drilldown menu
			if (menu.children('ul').size() > 0) { this.drilldown(menu, settings); };			
			
			menu.positionObject(menuLink, settings.positionOpts).hide().slideDown(settings.showSpeed).find('.menu:eq(0)').css({ visibility: 'visible' });
			
			menuOpen = true;		
			
			// assign events to menu & child items
			menu.parent().click(this.kill);
			$(document).click(this.kill);
			
			if (settings.itemHover) {
				menu.find('li').hover(
					function(){
						$(this).siblings().removeClass(settings.itemHover);
						$(this).addClass(settings.itemHover);
					},
					function(){ $(this).removeClass(settings.itemHover); }
				);
			};	// end if (settings.itemHover) 
			
			//click events when categories are accepted values
			var that = this;
			if (settings.selectCategories) {				
				$('.ddMenu li a').not('.'+settings.nextMenuLink).click(function(){
					alert('You chose '+$(this).text());
					that.kill();
					return false;
					//other actions could go here
				});
			}
			else {
				$('.ddMenu li a').not('.menuIndicator').click(function(){
					alert('You chose '+$(this).text());
					that.kill();
					return false;
					//other actions could go here
				});
			};			
			
		}; // end if (settings.content) 
	}; // end this.create()
	
	this.kill = function(){
		menu.parent().remove();
		if (menuLink.is('.'+settings.callerOnState)) { menuLink.removeClass(settings.callerOnState); };
		menuOpen = false;
	};
	
	return this;	
};


Menu.prototype.drilldown = function(menu, settings) {
	var breadcrumb = $('<ul class="ddBreadcrumb clearfix" style="display: none;"></ul>');
	var ddmenu = $('<div class="ddMenu"></div>');
	
	menu.css({ overflow: 'hidden' }).children().eq(0).wrap(ddmenu);
	menu.prepend(breadcrumb);
	
	var listHeights = [];
	menu.find('.ddMenu').find('ul').each(function(i){
	 	listHeights[i] = $(this).height();	 
	 });
	listHeights.sort(sortBigToSmall);
	menu.find('.ddMenu').find('ul').css({ height: listHeights[0] });
	
	// apply scrollbar to the menu if it exceeds max height
	if (listHeights[0] > settings.maxHeight) {
		menu.find('.ddMenu').addClass('scrollNeeded').css({ height: settings.maxHeight, overflow: 'auto', 'overflow-x': 'hidden' }).find('ul').css({ width: (settings.width-15).pxToEm()});
	}
	else {
		menu.find('.ddMenu').css({ height: listHeights[0] }).find('ul').css({ width: settings.width });
	};
	
	menu.find('.ddMenu li a').each(function(){
		if (!$(this).next().is('.'+settings.nextMenuLink)) {
			$(this).addClass('singleLink');
		};
	});
	
	var showNextLevel = function(el) {
		var thisLink = $(el);
		var thisList = $(el).parents('ul:eq(0)');
		var nextList = $(el).next();
		var thisListId = thisList.attr('id');
		
		//add all categories link
		if (breadcrumb.find('li').size()<1){
			var allCrumb = $('<li class="all"><a href="#">'+settings.topLinkText+'</a></li>');
			allCrumb.click(function(){
				menu.find('ul').not('ul.menu, .ddBreadcrumb').css({ visibility: 'hidden' });
				breadcrumb.empty().hide();
				return false;		
			});
			breadcrumb.append(allCrumb);
		};		
		
		var addNewCrumb = function() {
			var crumbText;
			if (thisLink.prev().is('a')) { crumbText = thisLink.prev().html(); }
			else { crumbText = thisLink.html(); };
		
			var newCrumb = $('<li class="currentCrumb" style="display: none;"><a href="javascript://" class="crumb">'+crumbText+'</a></li>');
			$('.currentCrumb').removeClass('currentCrumb');
			breadcrumb.append(newCrumb);
			newCrumb.show();

			newCrumb.find('a').click(function(){
				if($(this).parent().is('.currentCrumb')){
					alert('You chose '+$(this).text());
					//$('.menuBtn').children(':last').text($(this).text());
					menu.kill();
					//other actions could go here
					return false;
				}
				else {
					nextList.find('ul').css({ visibility: 'hidden' });									
					$(this).parent().nextAll().css({ visibility: 'hidden' }).slideUp(settings.crossSpeed, function(){$(this).remove();});
					$(this).parent().addClass('currentCrumb');
					return false;
				}
			});
		};
		
		// if the breadcrumb container is hidden, show it and add the first crumb
		if (breadcrumb.css('display') == 'none') {
			breadcrumb.slideDown();
			addNewCrumb();
		}
		else { addNewCrumb(); };
		
		// show the next list
		nextList.css({
			visibility: 'visible',
			left: settings.width
		}).animate({ left: 0 }, settings.crossSpeed);
	};
	// end showNextLevel
	
	// when category links are not selectable (only link to next level)
	if (!settings.selectCategories) {
		menu.find('.ddMenu li a').each(function(){
			if ($(this).next().is('ul')) { 
				$(this).addClass('menuIndicator').click(function(){
					showNextLevel(this);
					return false;
				});
			};
		});
	};	
	
	menu.find('.'+settings.nextMenuLink).click(function(){
		showNextLevel(this);
		return false;
	});		
};