/**
 * Project      : Total WordPress Theme
 * Description  : Initialize all scripts and add custom js
 * Author       : WPExplorer
 * Theme URI    : http://www.wpexplorer.com
 * Author URI   : http://www.wpexplorer.com
 * License      : Custom
 * License URI  : http://themeforest.net/licenses
 * Version      : 2.0.0
 */

(function($) {
	'use strict';

	var wpexTheme = {

		/**
		 * Define cache var
		 *
		 * @since 2.0.0
		 */
		cache: {},

		/**
		 * Main Function
		 *
		 * @since 2.0.0
		 */
		init: function() {
			this.config();
			this.bindEvents();
		},

		/**
		 * Cache Elements
		 *
		 * @since 2.0.0
		 */
		config: function() {

			this.config = {
				$window                 : $( window ),
				$document               : $( document ),
				$windowWidth            : $( window ).width(),
				$windowHeight           : $( window ).height(),
				$windowTop              : $( window ).scrollTop(),
				$siteHeader             : $( '#site-header' ),
				$siteLogo               : $( '#site-header #site-logo img' ),
				$currentLogo            : $( '#site-header #site-logo img' ).attr( 'src' ),
				$localScrollSpeed       : parseInt( wpexLocalize.localScrollSpeed ),
				$localScrollArray       : this.localScrollLinksArray(),
				$mobileMenuStyle        : $( '#site-navigation-wrap' ).length ? wpexLocalize.mobileMenuStyle : false
			};

		},

		/**
		 * Bind Events
		 *
		 * @since 2.0.0
		 */
		bindEvents: function() {

			// Set self var to use within functions
			var self = this;

			// Update the Cache
			if ( wpexLocalize.hasHeaderOverlay && $( '.overlay-header-logo' ).length ) {
				self.config.$siteLogo    = $( '.overlay-header-logo img' );
				self.config.$currentLogo = self.config.$siteLogo.attr( 'src' );
			}

			// Run on document ready
			this.config.$document.on( 'ready', function() {

				// Run functions
				self.superFish();
				self.megaMenusTop();
				self.megaMenusWidth();
				self.mobileMenu();
				self.navNoClick();
				self.toggleStickyHeader();
				self.hideEditLink();
				self.customMenuWidgetAccordion();
				self.headerSearch();
				self.headerCart();
				self.backTopLink();
				self.smoothCommentScroll();
				self.tipsyTooltips();
				self.customHovers();
				self.toggleBar();
				self.localScrollLinks();
				self.customSelects();
				self.skillbar();
				self.milestone();
				self.owlCarousel();
				self.isotopeGrids();
				self.archiveMasonryGrids();
				self.iLightbox();
				self.wooSelects();
				self.footerRevealLoadShow();

			} );

			// Run on Window Load
			this.config.$window.on( 'load', function() {

				// Run functions
				self.equalHeights();
				self.footerRevealMainMargin();
				self.overlayHeaderTopbarOffset();
				self.fadeIn();
				self.parallax();
				self.cartSearchDropdownsRelocate();
				self.sliderPro();

			} );

			// Run on Window Resize
			this.config.$window.resize( function() {

				// Update config
				self.config.$windowHeight   = self.config.$window.height();
				self.config.$windowWidth    = self.config.$window.width();

				// Run functions
				self.megaMenusWidth();
				self.overlayHeaderTopbarOffset();
				self.toggleStickyHeader();

			} );

			// Run on Scroll
			this.config.$window.scroll( function() {

				// Update config
				self.config.$windowTop = self.config.$window.scrollTop();

				// Run functions
				self.megaMenusTop();
				self.localScrollHighlight();
				self.footerRevealScrollShow();

				// Overlay Header Sticky
				self.stickyHeaderOverlay();

			} );

			// On orientation change
			this.config.$window.on( 'orientationchange',function() {
				self.isotopeGrids();
				self.archiveMasonryGrids();
			} );

			// Scroll to Hash
			window.setTimeout( self.scrollToHash( self ), 500 );
			self.config.$window.on( 'hashchange', function() {
				self.scrollToHash( self );
			} );

			// On Document click
			this.config.$document.click( function() {
				$( '#searchform-dropdown, #searchform-header-replace' ).removeClass( 'show' );
				$( 'a.search-dropdown-toggle' ).parent( 'li' ).removeClass( 'active' );
				$( '#toggle-bar-wrap' ).removeClass( 'active-bar' );
				$( 'a.toggle-bar-btn' ).children( '.fa' ).removeClass( 'fa-minus' ).addClass( 'fa-plus' );
			} );

		},

		/**
		 * Superfish menus
		 *
		 * @since 2.0.0
		 */
		superFish: function() {

			if ( ! $.fn.superfish ) {
				return;
			}

			$( '#site-navigation ul.sf-menu' ).superfish( {
				delay       : wpexLocalize.superfishDelay,
				animation   : {
					opacity : 'show'
				},
				animationOut: {
					opacity : 'hide'
				},
				speed       : wpexLocalize.superfishSpeed,
				speedOut    : wpexLocalize.superfishSpeedOut,
				cssArrows   : false,
				disableHI   : false
			} );


		},

		 /**
		 * MegaMenus Width
		 *
		 * @since 2.0.0
		 */
		megaMenusWidth: function() {

			if ( wpexLocalize.siteHeaderStyle !== 'one' ) {
				return;
			}

			var $siteNavigationWrap         = $( '#site-navigation-wrap' ),
				$headerContainerWidth       = this.config.$siteHeader.find( '.container' ).outerWidth(),
				$navWrapWidth               = $siteNavigationWrap.outerWidth(),
				$siteNavigationWrapPosition = $siteNavigationWrap.css( 'right' ),
				$siteNavigationWrapPosition = parseInt( $siteNavigationWrapPosition );

			if ( 'auto' == $siteNavigationWrapPosition ) {
				$siteNavigationWrapPosition = 0;
			}

			var $megaMenuNegativeMargin = $headerContainerWidth-$navWrapWidth-$siteNavigationWrapPosition;

			$( '#site-navigation-wrap .megamenu > ul' ).css( {
				'width'         : $headerContainerWidth,
				'margin-left'   : -$megaMenuNegativeMargin
			} );

		},

		/**
		 * MegaMenus Top Position
		 *
		 * @since 2.0.0
		 */
		megaMenusTop: function() {

			if ( wpexLocalize.siteHeaderStyle !== 'one' ) {
				return;
			}

			var $navHeight      = $( '#site-navigation-wrap' ).outerHeight(),
				$megaMenuTop    = this.config.$siteHeader.outerHeight() - $navHeight;

			if ( ! $( '#site-navigation' ).hasClass( '.nav-custom-height' ) ) {
				$( '#site-navigation-wrap .megamenu > ul' ).css( {
					'top' : $megaMenuTop/2 + $navHeight
				} );
			}

		},

		/**
		 * Mobile Menu
		 *
		 * @since 2.0.0
		 */
		mobileMenu: function() {

			// Sidr
			if ( 'sidr' == this.config.$mobileMenuStyle && typeof wpexLocalize.sidrSource != 'undefined' ) {

				if ( ! $.fn.sidr ) {
					return;
				}

				// Add sidr
				$( 'a.mobile-menu-toggle, li.mobile-menu-toggle > a' ).sidr( {
					name        : 'sidr-main',
					source      : wpexLocalize.sidrSource,
					side        : wpexLocalize.sidrSide,
					displace    : wpexLocalize.sidrDisplace,
					renaming    : true
				} );

				// Declare useful vars
				var $hasChildren = $( '.sidr-class-dropdown' );

				// Add dropdown toggle (arrow)
				$hasChildren.children( 'a' ).append( '<span class="sidr-class-dropdown-toggle"></span>' );

				// Toggle dropdowns
				$( '.sidr-class-dropdown-toggle' ).on( wpexLocalize.isMobile ? 'touchstart' : 'click', function( event ) {
					event.preventDefault();
					var $toggleParentLink   = $( this ).parent( 'a' ),
						$toggleParentLi     = $toggleParentLink.parent( 'li' ),
						$allParentLis       = $toggleParentLi.parents( 'li' ),
						$dropdown           = $toggleParentLi.children( 'ul' );
					if ( ! $toggleParentLi.hasClass( 'active' ) ) {
						$hasChildren.not( $allParentLis ).removeClass( 'active' ).children( 'ul' ).slideUp( 'fast' );
						$toggleParentLi.addClass( 'active' ).children( 'ul' ).slideDown( 'fast' );
					} else {
						$toggleParentLi.removeClass( 'active' ).children( 'ul' ).slideUp( 'fast' );
					}
				} );
				
				// Close sidr when clicking toggle
				$( 'a.sidr-class-toggle-sidr-close' ).on( wpexLocalize.isMobile ? 'touchstart' : 'click', function( event ) {
					event.preventDefault();
					$( '.sidr-class-menu-item-has-children.active' ).removeClass( 'active' ).children( 'ul' ).hide();
					$.sidr( 'close', 'sidr-main' );
				} );

				// Close sidr when cliking main content
				$( '#outer-wrap' ).click( function() {
					$( '.sidr-class-menu-item-has-children.active' ).removeClass( 'active' ).children( 'ul' ).hide();
					$.sidr( 'close', 'sidr-main' );
				} );

			}

			// Toggle
			else if ( 'toggle' == this.config.$mobileMenuStyle ) {
				
				// Add toggle nav to header
				this.config.$siteHeader.append( '<nav class="mobile-toggle-nav clr"></nav>' );

				// Grab all content from menu and add into mobile-toggle-nav element
				if ( $( '#mobile-menu-alternative' ).length ) {
					var mobileMenuContents = $( '#mobile-menu-alternative .dropdown-menu' ).html();
				} else {
					var mobileMenuContents = $( '#site-navigation .dropdown-menu' ).html();
				}
				$( '.mobile-toggle-nav' ).html( '<ul class="mobile-toggle-nav-ul">' + mobileMenuContents + '</ul>' );

				// Remove all classes inside prepended nav
				$( '.mobile-toggle-nav-ul, .mobile-toggle-nav-ul *' ).children().each( function() {
					var attributes = this.attributes;
					$( this ).removeAttr("style");
				} );

				// Add classes where needed
				$( '.mobile-toggle-nav-ul' ).addClass( 'container' );

				// Main toggle
				$( '.mobile-menu-toggle' ).on( wpexLocalize.isMobile ? 'touchstart' : 'click', function( event ) {
					$( '.mobile-toggle-nav' ).toggle();
					return false;
				} );

				/* Add search
				$( '.mobile-toggle-nav' ).append($( '#mobile-menu-search' )); */
			}

		},

		/**
		 * Prevent clickin on links
		 *
		 * @since 2.0.0
		 */
		navNoClick: function() {

			$( 'li.nav-no-click > a, li.sidr-class-nav-no-click > a' ).live( 'click', function() {
				return false;
			} );

		},

		/**
		 * Sticky Header
		 *
		 * @since 2.0.0
		 */
		toggleStickyHeader: function() {

			// Sanitize
			if ( ! $.fn.sticky || ! wpexLocalize.hasFixedHeader ) {
				return;
			}

			// Destroy sticky
			this.stickyHeader( 'unstick' );

			// Run sticky
			if ( wpexLocalize.hasFixedMobileHeader || ( this.config.$windowWidth >= wpexLocalize.fixedHeaderBreakPoint ) ) {
				this.stickyHeader();
			}
		},

		/**
		 * Sticky Header
		 *
		 * @since 2.0.0
		 */
		stickyHeader: function( event ) {

			if ( ! $.fn.sticky || ! $.fn.unstick ) {
				return;
			}

			var self = this;

			// Descroty sticky
			if ( 'unstick' == event ) {

				$( '#site-header.fixed-scroll' ).unstick();
				$( '.fixed-nav' ).unstick();

			}

			// Add Sticky
			else {

				$( '#site-header.fixed-scroll' ).sticky( {
					topSpacing			: 0,
					getWidthFrom		: '#wrap',
					responsiveWidth		: true,
					shrink				: wpexLocalize.shrinkFixedHeader ? true : false,
					customHeaderLogo	: wpexLocalize.fixedHeaderCustomLogo
				} );

				$( '.fixed-nav' ).sticky( {
					topSpacing		: 0,
					getWidthFrom	: '#wrap',
					responsiveWidth	: true
				} );

			}

		},

		/**
		 * Sticky Header Overlay
		 *
		 * @since 2.0.0
		 */
		stickyHeaderOverlay: function() {

			// Validate
			if ( ! this.config.$siteHeader.length || wpexLocalize.mainLayout !== 'full-width' || ! wpexLocalize.hasFixedHeader || ! wpexLocalize.hasHeaderOverlay ) {
				return;
			};

			// Disable on mobile
			if ( ! wpexLocalize.hasFixedMobileHeader && ( this.config.$windowWidth <= wpexLocalize.fixedHeaderBreakPoint ) ) {
				return;
			}

			var $el = $( '#site-header.fix-overlay-header' );

			// Has topbar
			if ( wpexLocalize.hasTopBar ) {

				if ( this.config.$windowTop > this.config.$siteHeader.outerHeight() ) {
					if (  ! $( $el ).hasClass( 'is-sticky' ) ) {
						$( $el ).addClass( 'is-sticky' );
						/*if ( this.config.$fixedHeaderCustomLogo && this.config.$fixedHeaderCustomLogo !== this.config.$siteLogo.attr( 'src' ) ) {
							this.config.$siteLogo.attr( 'src', this.config.$fixedHeaderCustomLogo );
						}*/
					}
				} else {
					$( $el ).removeClass( 'is-sticky' );
					/*this.config.$siteLogo.attr( 'src', this.config.$currentLogo );*/
				}

			}

			// No topbar
			else {

				if ( this.config.$windowTop > 0 ) {
					if (  ! $( $el ).hasClass( 'is-sticky' ) ) {
						$( $el ).addClass( 'is-sticky' );
					}
				} else {
					$( $el ).removeClass( 'is-sticky' );
				}

			}

		},

		/**
		 * Sticky Header Overlay TopbarOffset
		 *
		 * @since 2.0.0
		 */
		overlayHeaderTopbarOffset: function() {

			if ( ! wpexLocalize.hasFixedHeader || ! wpexLocalize.hasHeaderOverlay || ! wpexLocalize.hasTopBar ) {
				return;
			}

			var $paddingEl = ( wpexLocalize.mainLayout == 'boxed' ) ? $( '#wrap' ) : $( '#outer-wrap' );
			
			$( $paddingEl ).css( {
				'padding-top' : $( '#top-bar-wrap' ).outerHeight()
			} );

			$( '#site-header.overlay-header' ).css( {
				'top' : $( '#top-bar-wrap' ).outerHeight()
			} );

		},

		/**
		 * Header Search
		 *
		 * @since 2.0.0
		 */
		headerSearch: function() {

			// Dropdown
			if ( 'drop_down' == wpexLocalize.headerSeachStyle ) {
				$( 'a.search-dropdown-toggle' ).click( function( event ) {
					$( '#searchform-dropdown' ).toggleClass( 'show' );
					$( '#searchform-dropdown input' ).focus();
					$( this ).parent( 'li' ).toggleClass( 'active' );
					$( 'div#current-shop-items-dropdown' ).removeClass( 'show' );
					$( 'li.wcmenucart-toggle-dropdown' ).removeClass( 'active' );
					return false;
				} );
				$( '#searchform-dropdown' ).click( function( event ) {
					event.stopPropagation();
				} );
			}

			// Overlay Modal
			else if ( 'overlay' == wpexLocalize.headerSeachStyle ) {

				if ( ! $.fn.leanerModal ) {
					return;
				}

				var $searchOverlayToggle = $( 'a.search-overlay-toggle' );

				$searchOverlayToggle.leanerModal( {
					id      : '#searchform-overlay',
					top     : 100,
					overlay : 0.8
				} );

				$searchOverlayToggle.click( function() {
					$( '#site-searchform input' ).focus();
				} );

			}
			
			// Header Replace
			else if ( 'header_replace' == wpexLocalize.headerSeachStyle ) {
				var $headerReplace = $( '#searchform-header-replace' );
				$( 'a.search-header-replace-toggle' ).click( function( event ) {
					$headerReplace.toggleClass( 'show' );
					$headerReplace.find( 'input' ).focus();
					return false;
				} );
				$( '#searchform-header-replace-close' ).click( function() {
					$headerReplace.removeClass( 'show' );
					return false;
				} );
				$headerReplace.click( function( event ) {
					event.stopPropagation();
				} );
			}

		},

		/**
		 * Header Cart
		 *
		 * @since 2.0.0
		 */
		headerCart: function() {

			if ( $( 'a.wcmenucart' ).hasClass( 'go-to-shop' ) ) {
				return;
			}

			// Drop-down
			if ( 'drop-down' == wpexLocalize.wooCartStyle ) {

				// Display cart dropdown
				$( '.toggle-cart-widget' ).click( function( event ) {
					$( '#searchform-dropdown' ).removeClass( 'show' );
					$( 'a.search-dropdown-toggle' ).parent( 'li' ).removeClass( 'active' );
					$( 'div#current-shop-items-dropdown' ).toggleClass( 'show' );
					$( this ).toggleClass( 'active' );
					return false;
				} );

				// Hide cart dropdown
				$( 'div#current-shop-items-dropdown' ).click( function( event ) {
					event.stopPropagation(); 
				} );
				this.config.$document.click( function() {
					$( 'div#current-shop-items-dropdown' ).removeClass( 'show' );
					$( 'li.wcmenucart-toggle-dropdown' ).removeClass( 'active' );
				} );

				// Prevent body scroll on current shop dropdown
				$( '#current-shop-items-dropdown' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
					var e0      = e.originalEvent,
						delta   = e0.wheelDelta || -e0.detail;
					this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
					e.preventDefault();
				} );

			}

			// Modal
			else if ( 'overlay' == wpexLocalize.wooCartStyle ) {

				if ( ! $.fn.leanerModal ) {
					return;
				}

				$( '.toggle-cart-widget' ).leanerModal( {
					id      : '#current-shop-items-overlay',
					top     : 100,
					overlay : 0.8
				} );

			}

		},

		/**
		 * Relocate the cart and search dropdowns for specific header styles
		 *
		 * @since 2.0.0
		 */
		cartSearchDropdownsRelocate: function() {

			// Only needed for specific header styles
			if ( wpexLocalize.siteHeaderStyle !== 'three' && wpexLocalize.siteHeaderStyle !== 'four' ) {
				return;
			}

			// Last menu item offset
			var $lastMenuItem       = $( '#site-navigation .dropdown-menu > li:nth-last-child(1)' ),
				$lastMenuItemOffset = $lastMenuItem.position();

			// Position search dropdown
			var $dropdown           = $( '#searchform-dropdown' ),
				$dropdownPosition   = $lastMenuItemOffset.left - $dropdown.outerWidth() + $lastMenuItem.width();

			$dropdown.css( {
				'right' : 'auto',
				'left'  : $dropdownPosition
			} );

			// Position Woo dropdown
			var $toggleItem = $( '#current-shop-items-dropdown');

			if ( $toggleItem.length ) {

				$dropdown           = $toggleItem;
				$dropdownPosition   = $lastMenuItemOffset.left - $dropdown.outerWidth() + $lastMenuItem.width();

				$dropdown.css( {
					'right' : 'auto',
					'left'  : $dropdownPosition
				} );

			}

		},

		/**
		 * Hide post edit link
		 *
		 * @since 2.0.0
		 */
		hideEditLink: function() {

			$( 'a.hide-post-edit' ).click( function() {
				$( 'div.post-edit' ).hide();
				return false;
			} );

		},

		/**
		 * Custom menu widget toggles
		 *
		 * @since 2.0.0
		 */
		customMenuWidgetAccordion: function() {

			var self = this;

			$( '#main .widget_nav_menu .current-menu-ancestor' ).addClass( 'active' ).children( 'ul' ).show();

			$( 'div#main .widget_nav_menu' ).each( function() {
				var $widgetMenu     = $( this ),
					$hasChildren    = $( this ).find( '.menu-item-has-children' ),
					$allSubs        = $hasChildren.children( '.sub-menu' );
				$hasChildren.each( function() {
					$( this ).addClass( 'parent' );
					var $links = $( this ).children( 'a' );
					$links.on( self.config.$isMobile ? 'touchstart' : 'click', function( event ) {
						event.preventDefault();
						var $linkParent = $( this ).parent( 'li' ),
							$allParents = $linkParent.parents( 'li' );
						if ( ! $linkParent.hasClass( 'active' ) ) {
							$hasChildren.not( $allParents ).removeClass( 'active' ).children( '.sub-menu' ).slideUp( 'fast' );
							$linkParent.addClass( 'active' ).children( '.sub-menu' ).slideDown( 'fast' );
						} else {
							$linkParent.removeClass( 'active' ).children( '.sub-menu' ).slideUp( 'fast' );
						}
					} );
				} );
			} );

		},

		/**
		 * Back to top link
		 *
		 * @since 2.0.0
		 */
		backTopLink: function() {

			var $scrollTopLink = $( 'a#site-scroll-top' );

			this.config.$window.scroll( function() {

				if ( $( this ).scrollTop() > 100 ) {
					$scrollTopLink.addClass( 'show' );
				} else {
					$scrollTopLink.removeClass( 'show' );
				}

			} );

			$scrollTopLink.on( wpexLocalize.isMobile ? 'touchstart' : 'click', function( event ) {
				event.preventDefault();
				$( 'html, body' ).animate( {
					scrollTop : 0
				}, 400 );
			} );

		},

		/**
		 * Smooth Comment Scroll
		 *
		 * @since 2.0.0
		 */
		smoothCommentScroll: function() {

			$( '.single li.comment-scroll a' ).click( function( event ) {
				event.preventDefault();
				$( 'html, body' ).animate( {
					scrollTop: $( this.hash ).offset().top -180
				}, 'normal' );
			} );

		},

		/**
		 * Tooltips
		 *
		 * @since 2.0.0
		 */
		tipsyTooltips: function() {

			if ( ! $.fn.tipsy ) {
				return;
			}

			$( 'a.tooltip-left' ).tipsy( {
				fade    : true,
				gravity : 'e'
			} );

			$( 'a.tooltip-right' ).tipsy( {
				fade    : true,
				gravity : 'w'
			} );

			$( 'a.tooltip-up' ).tipsy( {
				fade    : true,
				gravity : 's'
			} );

			$( 'a.tooltip-down' ).tipsy( {
				fade    : true,
				gravity : 'n'
			} );

		},

		/**
		 * Custom hovers using data attributes
		 *
		 * @since 2.0.0
		 */
		customHovers: function() {

			$( '.wpex-data-hover' ).each( function() {

				var $this           = $( this ),
					$originalBg     = $( this ).css( 'backgroundColor' ),
					$originalColor  = $( this ).css( 'color' ),
					$hoverBg        = $( this ).attr( 'data-hover-background' ),
					$hoverColor     = $( this ).attr( 'data-hover-color' );

				$this.hover( function () {
					if ( CSSStyleDeclaration.prototype.setProperty != undefined ) {
						if ( $hoverBg ) {
							this.style.setProperty( 'background-color', $hoverBg, 'important' );
						}
						if ( $hoverColor ) {
							this.style.setProperty( 'color', $hoverColor, 'important' );
						}
					} else {
						if ( $hoverBg ) {
							$this.css( 'background-color', $hoverBg );
						}
						if ( $hoverColor ) {
							$this.css( 'color', $hoverColor );
						}
					}
				}, function () {
					if ( CSSStyleDeclaration.prototype.setProperty != undefined ) {
						if ( $hoverBg ) {
							this.style.setProperty( 'background-color', $originalBg, 'important' );
						}
						if ( $hoverColor ) {
							this.style.setProperty( 'color', $originalColor, 'important' );
						}
					} else {
						if ( $hoverBg && $originalBg ) {
							$this.css( 'background-color', $originalBg );
						}
						if ( $hoverColor && $originalColor ) {
							$this.css( 'color', $originalColor );
						}
					}
				} );

			} );

		},


		/**
		 * Togglebar toggle
		 *
		 * @since 2.0.0
		 */
		toggleBar: function() {

			$( 'a.open-togglebar' ).on( wpexLocalize.isMobile ? 'touchstart' : 'click', function( event ) {
				$( '.toggle-bar-btn' ).find( '.fa' ).toggleClass( 'fa-plus fa-minus' );
				$( '#toggle-bar-wrap' ).toggleClass( 'active-bar' );
				return false;
			} );

			$( '#toggle-bar-wrap' ).click( function( event ) {
				event.stopPropagation();
			} );

		},

		/**
		 * Skillbar
		 *
		 * @since 2.0.0
		 */
		skillbar: function() {

			$( '.vcex-skillbar' ).each( function() {
				$( this ).find( '.vcex-skillbar-bar' ).animate( {
					width: $( this ).attr( 'data-percent' )
				}, 800 );
			} );

		},

		/**
		 * Milestones
		 *
		 * @since 2.0.0
		 */
		milestone: function() {

			if ( ! $.fn.appear || ! $.fn.countTo ) {
				return;
			}

			$( '.vcex-animated-milestone' ).each( function() {
				$( this ).appear( function() {
					$( this ).find( '.vcex-milestone-time' ).countTo( {
						formatter: function ( value, options ) {
							return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
						},
					} );
				}, {
					accX    : 0,
					accY    : 0
				} );
			} );

		},

		/**
		 * Advanced Parallax
		 *
		 * @since 2.0.0
		 */
		parallax: function() {

			if ( ! $.fn.scrolly2 ) {
				return;
			}

			$( '.parallax-bg' ).each( function() {
				var $this = $( this );
				$this.scrolly2().trigger( 'scroll' );
				$this.css( {
					'opacity' : 1
				} );
			} );

		},

		/**
		 * Local scroll links array
		 *
		 * @since 2.0.0
		 */
		localScrollHeaderOffset: function() {

			if ( ! this.config.$siteHeader.length ) {
				return 0;
			} else if ( $( 'body' ).hasClass( 'shrink-fixed-header' ) ) {
				return wpexLocalize.fixedHeaderHeight;
			} else if ( wpexLocalize.hasHeaderOverlay || this.config.$siteHeader.hasClass( 'fixed-scroll' ) ) {
				return this.config.$siteHeader.outerHeight();
			} else {
				return 0;
			}

		},

		/**
		 * Local scroll links array
		 *
		 * @since 2.0.0
		 */
		localScrollLinksArray: function() {

			var $localScrollLinks   = $( '#site-navigation li.local-scroll' ).children( 'a' ),
				$localScrollArray   = [];

			for ( var i=0; i < $localScrollLinks.length; i++ ) {    
				var $localScrollLink    = $localScrollLinks[i],
					$localScrollLinkRef = $( $localScrollLink ).attr( 'href' );
				if ( $( $localScrollLinkRef ).length ) {
					$localScrollArray.push( $localScrollLinkRef );
				}
			}

			return $localScrollArray;

		},

		/**
		 * Local Scroll link
		 *
		 * @since 2.0.0
		 */
		localScrollLinks: function() {

			var self = this;

			// Local Scroll - Menu
			$( 'li.local-scroll > a, li.sidr-class-local-scroll > a, .vcex-navbar-link.local-scroll' ).click( function() {
				var $target     = $( this.hash ),
					$topOffset  = self.localScrollHeaderOffset();
				if ( $( $target ).length ) {
					$( 'html,body' ).stop( true,true ).animate( {
						scrollTop: $target.offset().top - $topOffset
					}, self.config.$localScrollSpeed );
				}
				if ( $.fn.sidr != undefined && 'sidr' == self.config.$mobileMenuStyle ) {
					$.sidr( 'close', 'sidr-main' );
				} else if ( 'toggle' == self.config.$mobileMenuStyle ) {
					$( '.mobile-toggle-nav' ).hide();
				}
				return false;
			} );

			// Local Scroll Anylink
			$( '.local-scroll-link' ).click( function() {
				var $target     = $( this.hash ),
					$topOffset  = self.localScrollHeaderOffset();
				if ( $( $target ).length ) {
					$( 'html,body' ).stop( true, true ).animate( {
						scrollTop: $target.offset().top - $topOffset
					}, self.config.$localScrollSpeed );
				}
				return false;
			} );

			// LocalScroll Woocommerce Reviews
			$( 'body.single div.entry-summary a.woocommerce-review-link' ).click( function() {
				var $target     = $( this.hash ),
					$topOffset  = self.localScrollHeaderOffset();
				if ( $( $target ).length ) {
					$( 'html,body' ).stop( true, true ).animate( {
						scrollTop: $target.offset().top - $topOffset - 30
					}, 800 );
				}
				return false;
			} );

		},

		/**
		 * Local Scroll Highlight on scroll
		 *
		 * @since 2.0.0
		 */
		localScrollHighlight: function() {

			var $localScrollArray   = this.config.$localScrollArray,
				$windowPos          = this.config.$window.scrollTop(),
				$windowHeight       = this.config.$windowHeight,
				$docHeight          = this.config.$document.height();

			if ( ! wpexLocalize.isMobile ) {
				for ( var i=0; i < $localScrollArray.length; i++ ) {
					var $theID = $localScrollArray[i];
					if ( $( $theID ).length ) {
							var $divPos     = $( $theID ).offset().top - this.config.$siteHeader.outerHeight(),
								$divHeight  = $( $theID ).height();
						if ( $windowPos >= $divPos && $windowPos < ( $divPos + $divHeight ) ) {
							$( "li.local-scroll a[href='" + $theID + "']" ).parent( 'li' ).addClass( 'current-menu-item' );
						} else {
							$( "li.local-scroll a[href='" + $theID + "']" ).parent( 'li' ).removeClass( 'current-menu-item' );
						}
					}
				}
				var $lastLink = $localScrollArray[$localScrollArray.length-1];
				if ( $windowPos + $windowHeight == $docHeight ) {
					$( '.local-scroll.current-menu-item' ).removeClass( 'current-menu-item' );
					$( "li.local-scroll a[href='" + $lastLink + "']" ).parent( 'li' ).addClass( 'current-menu-item' );
				}
			}

		},

		/**
		 * Scroll to Hash
		 *
		 * @since 2.0.0
		 */
		scrollToHash: function( $this ) {

			var $siteHeader = $( '#site-header' ),
				$hash       = location.hash,
				$topOffset  = this.localScrollHeaderOffset();

			if ( $hash.indexOf( 'localscroll-' ) != -1 ) {

				var $target  = $hash.replace( 'localscroll-','' ),
					$speed   = parseInt( wpexLocalize.localScrollSpeed );

				if ( ! $( $target ).length ) {
					return;
				}

				$( 'html,body' ).animate( {
					scrollTop: $( $target ).offset().top
				}, $speed );

			}

		},

		/**
		 * Equal heights function
		 *
		 * @since 2.0.0
		 */
		equalHeights: function() {

			if ( ! $.fn.matchHeight ) {
				return;
			}
			
			$( '.equal-height-column, .match-height-row .match-height-content, .match-height-feature-row .match-height-feature, .equal-height-content, .match-height-grid .match-height-content, .blog-entry-equal-heights .blog-entry-inner' ).matchHeight();

		},

		/**
		 * Footer Reveal Margin
		 *
		 * @since 2.0.0
		 */
		footerRevealMainMargin: function() {

			if ( ! wpexLocalize.hasFooterReveal ) {
				return;
			}

			$( '#wrap' ).css( {
				'margin-bottom': $( '.footer-reveal' ).outerHeight()
			} );

		},

		/**
		 * Footer Reveal Display on Load
		 *
		 * @since 2.0.0
		 */
		footerRevealLoadShow: function() {

			if ( ! wpexLocalize.hasFooterReveal ) {
				return;
			}

			if ( $( window ).height() > $( '#wrap' ).height() ) {
				$( '.footer-reveal' ).show().addClass( 'visible' );
			}

		},

		/**
		 * Footer Reveal Display on Scroll
		 *
		 * @since 2.0.0
		 */
		footerRevealScrollShow: function() {

			// Return if footer reveal is disabled
			if ( ! wpexLocalize.hasFooterReveal ) {
				return;
			}

			// Return if the footer reveal is already visible
			if ( $( '.footer-reveal' ).hasClass( 'visible' ) ) {
				return;
			}

			// Get main element top offset
			var $mainTop = $( '#main' ).offset().top;

			// Show/hide the footer based on the main offset
			if ( this.config.$windowTop > $mainTop ) {
				$( '.footer-reveal' ).show();
			} else {
				$( '.footer-reveal' ).hide();
			}

		},

		/**
		 * Custom Selects
		 *
		 * @since 2.0.0
		 */
		customSelects: function() {

			// Return if the customSelect function doesn't exist
			if ( ! $.fn.customSelect ) {
				return;
			} 
			
			// Add custom Selects to various selects
			$( '.woocommerce-ordering .orderby, #dropdown_product_cat, .widget_categories select, .widget_archive select, #bbp_stick_topic_select, #bbp_topic_status_select, #bbp_destination_topic, .single-product .variations_form .variations select' ).customSelect( {
				customClass : 'theme-select'
			} );

		},

		/**
		 * FadeIn Elements
		 *
		 * @since 2.0.0
		 */
		fadeIn: function() {
			$( '.fade-in-image, .show-on-load' ).addClass( 'no-opacity' );
		},

		/**
		 * OwlCarousel
		 *
		 * @since 2.0.0
		 */
		owlCarousel: function() {

			if ( ! $.fn.owlCarousel ) {
				return;
			}

			$( '.wpex-carousel' ).each( function() {

				var $carousel   = $( this ),
					$rtl        = wpexLocalize.isRTL ? true : false;

				$carousel.owlCarousel( {
					dots            : false,
					lazyLoad        : false,
					rtl             : $rtl,
					items           : $carousel.data( 'items' ),
					slideBy         : $carousel.data( 'slideby' ),
					center          : $carousel.data( 'center' ),
					loop            : $carousel.data( 'loop' ),
					margin          : $carousel.data( 'margin' ),
					nav             : $carousel.data( 'nav' ),
					autoplay        : $carousel.data( 'autoplay' ),
					autoplayTimeout : $carousel.data( 'autoplay-timeout' ),
					navText         : [ '<span class="fa fa-chevron-left"><span>', '<span class="fa fa-chevron-right"></span>' ],
					responsive      : {
						0   : {
							items   : $carousel.data( 'items-mobile-portrait' )
						},
						480 : {
							 items  : $carousel.data( 'items-mobile-landscape' )
						},
						768 : {
							items   : $carousel.data( 'items-tablet' )
						},
						960 : {
							items   : $carousel.data( 'items' )
						}
					}
				} );
			} );

		},

		/**
		 * SliderPro
		 *
		 * @since 2.0.0
		 */
		sliderPro: function() {

			// Return if sliderPro script isn't defined
			if ( ! $.fn.sliderPro ) {
				return;
			}

			// Loop through each slider
			$( '.wpex-slider' ).each( function() {

				// Declare vars
				var $slider = $( this ),
					$data   = $slider.data();

				// Check data and set fallback
				var $animationSpeed             = ( typeof $data.animationSpeed !== 'undefined' ) ? $data.animationSpeed : 600,
					$loop                       = ( typeof $data.loop !== 'undefined' ) ? $data.loop : false,
					$fade                       = ( typeof $data.fade !== 'undefined' ) ? $data.fade : 600,
					$direction                  = ( typeof $data.direction !== 'undefined' ) ? $data.direction : 'horizontal',
					$autoPlay                   = ( typeof $data.autoPlay !== 'undefined' ) ? $data.autoPlay : true,
					$autoPlayDelay              = ( typeof $data.autoPlayDelay !== 'undefined' ) ? $data.autoPlayDelay : 5000,
					$touchSwipe                 = ( typeof $data.touchSwipe !== 'undefined' ) ? $data.touchSwipe : true,
					$buttons                    = ( typeof $data.buttons !== 'undefined' ) ? $data.buttons : true,
					$arrows                     = ( typeof $data.arrows !== 'undefined' ) ? $data.arrows : true,
					$fadeArrows                 = ( typeof $data.fadeArrows !== 'undefined' ) ? $data.fadeArrows : true,
					$shuffle                    = ( typeof $data.shuffle !== 'undefined' ) ? $data.shuffle : false,
					$fullscreen                 = ( typeof $data.fullscreen !== 'undefined' ) ? $data.fullscreen : false,
					$slideDistance              = ( typeof $data.slideDistance !== 'undefined' ) ? $data.slideDistance : 0,
					$heightAnimationDuration    = ( typeof $data.heightAnimationDuration !== 'undefined' ) ? $data.heightAnimationDuration : 500,
					$thumbnailPointer           = ( typeof $data.thumbnailPointer != 'undefined' ) ? $data.thumbnailPointer : false,
					$thumbnailHeight            = ( typeof $data.thumbnailHeight != 'undefined' ) ? $data.thumbnailHeight : 70,
					$thumbnailWidth             = ( typeof $data.thumbnailWidth != 'undefined' ) ? $data.thumbnailWidth : 70,
					$updateHash                 = ( typeof $data.updateHash != 'undefined' ) ? $data.updateHash : false,
					$fadeCaption                = ( typeof $data.fadeCaption != 'undefined' ) ? $data.fadeCaption : true,
					$autoHeight                 = ( typeof $data.autoHeight != 'undefined' ) ? $data.autoHeight : true;

				// Lets show things that were hidden to prevent flash
				$( '.wpex-slider-slide, .wpex-slider-thumbnails' ).css( {
						'opacity'   : 1,
						'display'   : 'block'
				} );

				// Run slider
				$slider.sliderPro( {
					responsive              : true,
					width                   : '100%',
					height                  : '300',
					fade                    : $fade,
					touchSwipe              : $touchSwipe,
					fadeDuration            : $animationSpeed,
					slideAnimationDuration  : $animationSpeed,
					autoHeight              : $autoHeight,
					heightAnimationDuration : $heightAnimationDuration,
					arrows                  : $arrows,
					fadeArrows              : $fadeArrows,
					autoplay                : $autoPlay,
					autoplayDelay           : $autoPlayDelay,
					buttons                 : $buttons,
					shuffle                 : $shuffle,
					orientation             : $direction,
					loop                    : $loop,
					keyboard                : false,
					fullScreen              : $fullscreen,
					slideDistance           : $slideDistance,
					thumbnailHeight         : $thumbnailHeight,
					thumbnailWidth          : $thumbnailWidth,
					thumbnailPointer        : $thumbnailPointer,
					updateHash              : $updateHash,
					thumbnailArrows         : false,
					fadeThumbnailArrows     : false,
					thumbnailTouchSwipe     : true,
					fadeCaption             : $fadeCaption,
					captionFadeDuration     : 500,
					waitForLayers           : true,
					autoScaleLayers         : true,
					forceSize               : 'none',
					thumbnailPosition       : 'bottom',
					reachVideoAction        : 'playVideo',
					leaveVideoAction        : 'pauseVideo',
					endVideoAction          : 'nextSlide',
					init                    : function( event ) {
						$slider.prev( '.wpex-slider-preloaderimg' ).hide();
						if ( $slider.parent( '.gallery-format-post-slider' ) && $( '.blog-masonry-grid' ).length ) {
							setTimeout( function() {
								$( '.blog-masonry-grid' ).isotope( 'layout' );
							}, $heightAnimationDuration + 1 );
						}
					},
					gotoSlideComplete       : function( event ) {
						if ( $slider.parent( '.gallery-format-post-slider' ) && $( '.blog-masonry-grid' ).length ) {
							$( '.blog-masonry-grid' ).isotope( 'layout' );
						}
					}

				} );

			} );

			// WooCommerce: Prevent clicking on Woo entry slider
			$( '.woo-product-entry-slider' ).click( function() {
				return false;
			} );
		   
		},

		/**
		 * Isotope Grids
		 *
		 * @since 2.0.0
		 */
		isotopeGrids: function() {

			if ( ! $.fn.imagesLoaded || ! $.fn.isotope ) {
				return;
			}

			var self = this;

			$( '.vcex-isotope-grid' ).each( function() {

				// Get data
				var $container          = $( this ),
					$transitionDuration = $container.data( 'transition-duration' ),
					$layoutMode         = $container.data( 'layout-mode' ),
					$isOriginLeft       = wpexLocalize.isRTL ? false : true;

				// Sanitize
				$transitionDuration = $transitionDuration ? $transitionDuration : '0.4';
				$layoutMode         = $layoutMode ? $layoutMode : 'masonry';


				// Make sure images are loaded first
				$container.imagesLoaded( function() {

					// Initialize isotope
					$container.isotope( {
						itemSelector        : '.vcex-isotope-entry',
						transformsEnabled   : true,
						isOriginLeft        : $isOriginLeft,
						transitionDuration  : $transitionDuration + 's',
						layoutMode          : $layoutMode
					} );

					// Isotope filter links
					var $filter = $container.prev( 'ul.vcex-filter-links' );

					if ( $filter.length ) {
						var $filterLinks = $filter.find( 'a' );
						$filterLinks.each( function() {
							var $filterableDiv = $( this ).data( 'filter' );
							if ( $filterableDiv !== '*' && ! $container.find($filterableDiv).length ) {
								$( this ).parent().addClass( 'hidden' );
							}
						} );
						$filterLinks.css( { opacity: 1 } );
						$filterLinks.click( function() {
							var selector = $( this ).attr( 'data-filter' );
								$container.isotope( {
									filter: selector
								} );
								$( this ).parents( 'ul' ).find( 'li' ).removeClass( 'active' );
								$( this ).parent( 'li' ).addClass( 'active' );
							return false;
						} );
					}

				} );

			} );

		},

		/**
		 * Isotope Grids
		 *
		 * @since 2.0.0
		 */
		archiveMasonryGrids: function() {

			if ( ! $.fn.imagesLoaded || ! $.fn.isotope ) {
				return;
			}

			// Define vars
			var self                = this,
				$container          = $( '.blog-masonry-grid,div.wpex-row.portfolio-masonry,div.wpex-row.portfolio-no-margins,div.wpex-row.staff-masonry,div.wpex-row.staff-no-margins' ),
				$transitionDuration = $container.data( 'transition-duration' ),
				$layoutMode         = $container.data( 'layout-mode' ),
				$isOriginLeft       = wpexLocalize.isRTL ? false : true;

				// Sanitize
				$transitionDuration = ( typeof $transitionDuration != 'undefined' ) ? $transitionDuration : '0.0';
				$layoutMode         = ( typeof $layoutMode != 'undefined' ) ? $layoutMode : 'masonry';

			// Load isotope after images loaded
			$container.imagesLoaded( function() {
				$container.isotope( {
					itemSelector        : '.isotope-entry',
					transformsEnabled   : true,
					isOriginLeft        : $isOriginLeft,
					transitionDuration  : $transitionDuration + 's'
				} );
			} );
		},

		/**
		 * iLightbox
		 *
		 * @since 2.0.0
		 */
		iLightbox: function() {

			if ( ! $.fn.iLightBox ) {
				return;
			}

			// Lightbox Vars
			wpexLocalize.lightboxArrows     = ( wpexLocalize.lightboxArrows === '1' ) ? true : false;
			wpexLocalize.lightboxThumbnails = ( wpexLocalize.lightboxThumbnails === '1' ) ? true : false;
			wpexLocalize.lightboxFullScreen = ( wpexLocalize.lightboxFullScreen === '1' ) ? true : false;
			wpexLocalize.lightboxMouseWheel = ( wpexLocalize.lightboxMouseWheel === '1' ) ? true : false;
			wpexLocalize.lightboxTitles     = ( wpexLocalize.lightboxTitles === '1' ) ? true : false;

			// Lightbox Standard
			$( '.wpex-lightbox, .wpb_single_image.image-lightbox a' ).each( function() {

				var $this   = $( this ),
					$data   = $this.data(),
					$skin   = ( typeof $data.skin !== 'undefined' ) ? $data.skin : wpexLocalize.lightboxSkin;

				$this.iLightBox( {
					skin        : $skin,
					controls    : {
						fullscreen  : wpexLocalize.lightboxFullScreen
					}
				} );

			} );

			// Lightbox Videos
			$( '.wpex-lightbox-video, .wpb_single_image.video-lightbox a, .wpex-lightbox-autodetect, .wpex-lightbox-autodetect a' ).iLightBox( {
				skin                : wpexLocalize.LightboxSkin,
				path                : 'horizontal',
				smartRecognition    : true,
				show                : {
					title   : wpexLocalize.lightboxTitles
				},
				controls            : {
					fullscreen  : wpexLocalize.lightboxFullScreen,
					mousewheel  : wpexLocalize.lightboxMouseWheel
				}
			} );

			// Lightbox Galleries - NEW since 1.6.0
			$( '.lightbox-group' ).each( function() {

				// Get lightbox data
				var $this       = $( this ),
					$item       = $this.find( 'a.lightbox-group-item' ),
					$data       = $this.data(),
					$skin       = ( typeof $data.skin !== 'undefined' ) ? $data.skin : wpexLocalize.lightboxSkin,
					$path       = ( typeof $data.path !== 'undefined' ) ? $data.path : 'horizontal',
					$arrows     = ( typeof $data.arrows !== 'undefined' ) ? $data.arrows : wpexLocalize.lightboxArrows,
					$thumbnails = ( typeof $data.thumbnails !== 'undefined' ) ? $data.thumbnails : wpexLocalize.lightboxThumbnails;

				// Start up lightbox
				$item.iLightBox( {
					skin        : $skin,
					path        : $path,
					show        : {
						title   : wpexLocalize.lightboxTitles
					},
					controls    : {
						arrows      : $arrows,
						thumbnail   : $thumbnails,
						fullscreen  : wpexLocalize.lightboxFullScreen,
						mousewheel  : wpexLocalize.lightboxMouseWheel
					}
				} );


			} );

			// Lightbox Gallery with custom imgs
			$( '.wpex-lightbox-gallery' ).on( wpexLocalize.isMobile ? 'touchstart' : 'click', function( event ) {
				event.preventDefault();
				var imagesArray = $( this ).data( 'gallery' ).split( ',' );
				if ( imagesArray ) {
					$.iLightBox( imagesArray, {
						skin        : wpexLocalize.lightboxSkin,
						path        : 'horizontal',
						show        : {
							title   : wpexLocalize.lightboxTitles
						},
						controls    : {
							arrows      : wpexLocalize.lightboxArrows,
							thumbnail   : wpexLocalize.lightboxThumbnails,
							fullscreen  : wpexLocalize.lightboxFullScreen,
							mousewheel  : wpexLocalize.lightboxMouseWheel
						}
					} );
				}
			} );

		},

		/**
		 * WooCommerce Selects
		 *
		 * @since 2.0.0
		 */
		wooSelects: function() {

			if ( ! $.fn.select2 ) {
				return;
			}

			$( '#calc_shipping_country' ).select2();


		}


	}; // END wpexTheme

	// Start things up
	wpexTheme.init();

} ) ( jQuery );