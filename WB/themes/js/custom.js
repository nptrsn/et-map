jQuery(document).ready(function() {

boolean foundContainer = false;


$ = jQuery.noConflict();


	replaceVideo();

// Sticky Header
var nav = $('#header-nav');
$(window).scroll(function() {
	if($(this).scrollTop() > 100) {
		nav.css({
			position: 'fixed',
			top: '0',
			left: '50%',
			margin: '-1px 0 0 -525px',
			width: '1050px',
			background: '#fff',
		});
	} else {
		nav.css({
			position: 'relative',
			left: '0',
			float: 'left',
			margin: 'auto',
			width: '1050px'
		});
	}
});




var themeRoot = "http://wab.pureawesome.com/wp-content/themes/wab";

/**
 * Namespacing 
 * All method start with "init" will be automatically called at start.
 */
var wab = {}

wab.initBrowserDecetion = function() 
{
    var userAgent = navigator.userAgent.toLowerCase();
    $.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase()); 
    
    // Is this a version of IE?
    if($.browser.msie) {
        $('body').addClass('browserIE');
        
        // Add the version number
        $('body').addClass('browserIE' + $.browser.version.substring(0,1));
    }
    
    // Is this a version of Chrome?
    if($.browser.chrome) {
    
        $('body').addClass('browserChrome');
        
        //Add the version number
        userAgent = userAgent.substring(userAgent.indexOf('chrome/') +7);
        userAgent = userAgent.substring(0,1);
        $('body').addClass('browserChrome' + userAgent);
        
        // If it is chrome then jQuery thinks it's safari so we have to tell it it isn't
        $.browser.safari = false;
    }
    
    // Is this a version of Safari?
    if($.browser.safari) {
        $('body').addClass('browserSafari');
        
        // Add the version number
        userAgent = userAgent.substring(userAgent.indexOf('version/') +8);
        userAgent = userAgent.substring(0,1);
        $('body').addClass('browserSafari' + userAgent);
    }
    
    // Is this a version of Mozilla?
    if($.browser.mozilla) {
        
        //Is it Firefox?
        if(navigator.userAgent.toLowerCase().indexOf('firefox') != -1){
            $('body').addClass('browserFirefox');
            
            // Add the version number
            userAgent = userAgent.substring(userAgent.indexOf('firefox/') +8);
            userAgent = userAgent.substring(0,1);
            $('body').addClass('browserFirefox' + userAgent);
        }
        // If not then it must be another Mozilla
        else{
            $('body').addClass('browserMozilla');
        }
    }
    
    // Is this a version of Opera?
    if($.browser.opera) {
        $('body').addClass('browserOpera');
    } 
    
} // end of _initBrowserDecetion

/*
 * Columnize content using Columnizer jQuery Plugin
 */
wab.initColumnizer = function() 
{
    var $content = $("#main .entry-content");
    var $columnsWrapper = $(".col-wrap");
    var $body = $("body");
    
    // init columnizer
  //  if( themeRoot.length < 1 || $columnsWrapper.length === 0 ) return;
    
    if ( $body.hasClass("browserFirefox") || $body.hasClass("browserSafari") || $body.hasClass("browserChrome") ) {
        
        $columnsWrapper.each(function(){
            $this = $(this);
            
            if($this.has(".col-3")) {
                $this.css({
                    "-moz-column-count": "3",
                    "-moz-column-gap": "20px",
                    "-moz-column-fill": "auto",
                    "-webkit-column-fill" :"auto",
                    "-webkit-column-count": "3",
                    "-webkit-column-gap": "20px",
                    "column-fill": "auto",
    				
                    "text-align": "justify"
                });
            } else if($this.has(".col-2")) {
                $this.css({
                    "-moz-column-count": "2",
                    "-moz-column-gap": "20px",
                    "-webkit-column-count": "2",
                    "-webkit-column-gap": "20px",
                    "text-align": "justify"
                });
            }
        });
    } else {
        
        $.getScript(themeRoot+"/js/jquery.columnizer.js", function() {
            $(".col-2", $content).columnize({ columns: 2, lastNeverTallest: true });
            $(".col-3", $content).columnize({ columns: 3, lastNeverTallest: true });
           
            $(".col-wrap .col", $content).wrapInner("<div class=\"inner hyphenate\" />");
        });
        
         // init hyphenator 
        $.getScript(themeRoot+"/js/hyphenator.js", function() {
            Hyphenator.run();
        });
    }
}

/*
 * Pager object
 */
 
 
 
wab.pager = function($container) {
    var self = this;
    self.currentPage = 0;
    
    var duration = 1200;
    var $inner = null;
    var $pages = [];
    var $paginator = null;
    
    function init() {
        $pages = $container.find(".page").css("float", "left");
        $inner = $container.wrapInner("<div class=\"inner\" />").find(" > .inner:first");
        
        $container.css({"overflow": "hidden", "height": "600px"}); //$($pages[0]).height()
        $inner.width( getPagesTotalWidth() );

        
        constructPaginator();
        
        // change container's the height
        // $container.animate({"height" : $pages.height()+50+"px"}, duration, "easeOutQuart");
    }
    
    function constructPaginator() {
        // construct paginator
        if (foundContainer == false) {
            $paginator = $('<div class="pagination" />').insertAfter($container);
            foundContainer = true;
        }
        
       
        

        
       
        
        var $numbers = $('<span class="page-number-container">Page: </span>').appendTo($paginator);
        for( var i = 1; i <= $pages.length; i++ ) {
            $('<a title="Move to page '+i+'" href="#" class="page-number" data-page="'+i+'">'+i+'</a>').appendTo($numbers).click(self.moveTo);
        }
        
        enableButtons();
    }
    
    self.moveTo = function(e) {
        var $this = $(this);
        var toPage = $this.data("page") - 1; // 0 based
        
        var $currPage = $($pages[self.currentPage]);
        var $nextPage = $($pages[toPage]);
        
        // move the page
        $inner.animate({
            "marginLeft" : toPage * $currPage.width() * -1 +"px"
        }, duration, "easeOutQuart");
        
        // set the new page as the current page
        self.currentPage = toPage;
        
        enableButtons();
        
        return false;
    }

    // enable/disable paginator's button if needed
    function enableButtons() {
        $next = $paginator.find(".next-page");
        $prev = $paginator.find(".previous-page");
        
        if( self.currentPage === 0 ) { // is first page
            $prev.addClass('disabled').removeData("page");
        } else {
            $prev.removeClass('disabled').data("page", self.currentPage);
        }
        
        if( self.currentPage === $pages.length-1 ) { // is last page
            $next.addClass('disabled').removeData("page");
        } else {
            $next.removeClass('disabled').data("page", self.currentPage+2);
        }
        
        $paginator.find(".page-number-container:first a").removeClass("current-page");
        $paginator.find(".page-number-container:first a:eq("+self.currentPage+")").addClass('current-page');
    }
    
    function getPagesTotalWidth() {
        var totalWidth = 0;
        
        $pages.each(function(){
            var width = $(this).width();
            totalWidth += width;
            $(this).width(width);
        });
        
        return totalWidth;
    }
    
    // run!
    init();
}

wab.initPager = function()
{
    var $containers = $("#main .entry-content > .pages-container");
    
    if( $containers.length === 0 ) return;
    
    // containers
    $containers.each(function() {
        var pager = new wab.pager($(this));
    });
}

$(function() {
    // start initial the page
    var namespace = wab;
    
    for(method in namespace) {
        // skip if not start with _init
        if(method.toString().substring(0,4) !== 'init') continue;
        
        // call method
        namespace[method.toString()]();
    }
});

function log(o) {
    if(console.log) console.log(o);
}

// ease out effect
jQuery.easing.easeOutQuart = function (x, t, b, c, d) { 
    return -c * ((t=t/d-1)*t*t*t - 1) + b; 
};








function replaceVideo(){
	$('a.video').append('<span/>');
	$('a.video').click(function(){
		var link = $(this);
		var href=link.attr('href');
		var iframe_html = ''
		if (href.indexOf('vimeo') != -1) {
			iframe_html = '<iframe src="http://player.vimeo.com/video/'+href.split('/').pop()+'?title=0&amp;byline=0&amp;portrait=0&autoplay=1" width="700" height="386" frameborder="0"></iframe>';
		} else if (href.indexOf('youtube') != -1) {
			var youtube_params = href.match(/\?v=([^&]*)/).pop();
			iframe_html = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="700" height="386" src="http://www.youtube.com/embed/'+youtube_params+'?rel=0&autoplay=1" frameborder="0"></iframe>';
		} else {
			iframe_html = link.data('embed');
		}
		link.replaceWith(iframe_html);
		return false;
	})
}




});