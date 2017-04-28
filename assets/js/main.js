$(function () {
	"use strict";

	//Activate tooltips
	$("[data-toggle='tooltip']").tooltip();

	$("[data-toggle='utility-menu']").click(function() {
		$(this).next().slideToggle(300);
		$(this).toggleClass('open');
		return false;
	});

	// Login Page Flipbox control
	$('#toFlip').click(function() {
		loginFlip();
		return false;
	});

	$('#noFlip').click(function() {
		loginFlip();
		return false;
	});

	// Navbar height : Using slimscroll for sidebar
	if ($('body').hasClass('fixed') || $('body').hasClass('only-sidebar')) {
		$('.sidebar').slimScroll({
			height: ($(window).height() - $(".main-header").height()) + "px",
			color: "rgba(0,0,0,0.8)",
			size: "3px"
		});
	}
	else {
		var docHeight = $(document).height();
		$('.main-sidebar').height(docHeight);
	}
});

// Sidenav prototypes
$.pushMenu = {
	activate: function (toggleBtn) {

	//Enable sidebar toggle
	$(toggleBtn).on('click', function (e) {
		e.preventDefault();

		//Enable sidebar push menu
		if ($(window).width() > (767)) {
			if ($("body").hasClass('sidebar-collapse')) {
				$("body").removeClass('sidebar-collapse').trigger('expanded.pushMenu');
			} else {
				$("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
			}
		}
		//Handle sidebar push menu for small screens
		else {
			if ($("body").hasClass('sidebar-open')) {
				$("body").removeClass('sidebar-open').removeClass('sidebar-collapse').trigger('collapsed.pushMenu');
			} else {
				$("body").addClass('sidebar-open').trigger('expanded.pushMenu');
			}
		}
		if ( $('body').hasClass('fixed') && $('body').hasClass('sidebar-mini') && $('body').hasClass('sidebar-collapse')) {
			$('.sidebar').css("overflow","visible");
			$('.main-sidebar').find(".slimScrollDiv").css("overflow","visible");
		}
		if ($('body').hasClass('only-sidebar')) {
			$('.sidebar').css("overflow","visible");
			$('.main-sidebar').find(".slimScrollDiv").css("overflow","visible");
		};
	});

	$(".content-wrapper").click(function () {
		//Enable hide menu when clicking on the content-wrapper on small screens
		if ($(window).width() <= (767) && $("body").hasClass("sidebar-open")) {
			$("body").removeClass('sidebar-open');
		}
	});
	}
};
$.tree = function (menu) {
  var _this = this;
  var animationSpeed = 200;
  $(document).on('click', menu + ' li a', function (e) {
	//Get the clicked link and the next element
	var $this = $(this);
	var checkElement = $this.next();

	//Check if the next element is a menu and is visible
	if ((checkElement.is('.treeview-menu')) && (checkElement.is(':visible'))) {
	  //Close the menu
	  checkElement.slideUp(animationSpeed, function () {
		checkElement.removeClass('menu-open');
		//Fix the layout in case the sidebar stretches over the height of the window
		//_this.layout.fix();
	  });
	  checkElement.parent("li").removeClass("active");
	}
	//If the menu is not visible
	else if ((checkElement.is('.treeview-menu')) && (!checkElement.is(':visible'))) {
	  //Get the parent menu
	  var parent = $this.parents('ul').first();
	  //Close all open menus within the parent
	  var ul = parent.find('ul:visible').slideUp(animationSpeed);
	  //Remove the menu-open class from the parent
	  ul.removeClass('menu-open');
	  //Get the parent li
	  var parent_li = $this.parent("li");

	  //Open the target menu and add the menu-open class
	  checkElement.slideDown(animationSpeed, function () {
		//Add the class active to the parent li
		checkElement.addClass('menu-open');
		parent.find('li.active').removeClass('active');
		parent_li.addClass('active');
	  });
	}
	//if this isn't a link, prevent the page from being redirected
	if (checkElement.is('.treeview-menu')) {
	  e.preventDefault();
	}
  });
};
// Activate sidenav treemenu 
$.tree('.sidebar');
$.pushMenu.activate("[data-toggle='offcanvas']");

function loginFlip () {
	$('.login-box').toggleClass('flipped');
}

// Button Loading Plugin

$.fn.loadingBtn = function( options ) {

	var settings = $.extend({
			text: "Loading"
		}, options );
	this.html('<span class="btn-spinner"></span> ' + settings.text + '');
	this.addClass("disabled");
};

$.fn.loadingBtnComplete = function( options ) {
	var settings = $.extend({
			html: "submit"
		}, options );
	this.html(settings.html);
	this.removeClass("disabled");
};
