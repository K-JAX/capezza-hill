/**
 * Touch & Keyboard navigation.
 *
 * Contains handlers for touch devices and keyboard navigation.
 */

(function() {

	/**
	 * Debounce
	 *
	 * @param {Function} func
	 * @param {number} wait
	 * @param {boolean} immediate
	 */
	function debounce(func, wait, immediate) {
		'use strict';

		var timeout;
		wait      = (typeof wait !== 'undefined') ? wait : 20;
		immediate = (typeof immediate !== 'undefined') ? immediate : true;

		return function() {

			var context = this, args = arguments;
			var later = function() {
				timeout = null;

				if (!immediate) {
					func.apply(context, args);
				}
			};

			var callNow = immediate && !timeout;

			clearTimeout(timeout);
			timeout = setTimeout(later, wait);

			if (callNow) {
				func.apply(context, args);
			}
		};
	}

	/**
	 * Add class
	 *
	 * @param {Object} el
	 * @param {string} cls
	 */
	function addClass(el, cls) {
		if ( ! el.className.match( '(?:^|\\s)' + cls + '(?!\\S)') ) {
			el.className += ' ' + cls;
		}
	}

	/**
	 * Delete class
	 *
	 * @param {Object} el
	 * @param {string} cls
	 */
	function deleteClass(el, cls) {
		el.className = el.className.replace( new RegExp( '(?:^|\\s)' + cls + '(?!\\S)' ),'' );
	}

	/**
	 * Has class?
	 *
	 * @param {Object} el
	 * @param {string} cls
	 *
	 * @returns {boolean} Has class
	 */
	function hasClass(el, cls) {

		if ( el.className.match( '(?:^|\\s)' + cls + '(?!\\S)' ) ) {
			return true;
		}
	}

	/**
	 * Toggle Aria Expanded state for screenreaders
	 *
	 * @param {Object} ariaItem
	 */
	function toggleAriaExpandedState( ariaItem ) {
		'use strict';

		var ariaState = ariaItem.getAttribute('aria-expanded');

		if ( ariaState === 'true' ) {
			ariaState = 'false';
		} else {
			ariaState = 'true';
		}

		ariaItem.setAttribute('aria-expanded', ariaState);
	}

	/**
	 * Open sub-menu
	 *
	 * @param {Object} currentSubMenu
	 */
	function openSubMenu( currentSubMenu ) {
		'use strict';
		// Update classes
		// classList.add is not supported in IE11
		if (currentSubMenu.parentElement.classList.contains('off-canvas') == false){
			currentSubMenu.parentElement.className += ' off-canvas';
		};
		if (currentSubMenu.parentElement.lastElementChild.classList.contains('expanded-true') == false){
			currentSubMenu.parentElement.lastElementChild.className += ' expanded-true';
		};
		var menuItem     = getCurrentParent( currentSubMenu, '.menu-item' );
		var menuItemAria = menuItem.querySelector('button[aria-expanded]');
		if (menuItemAria.classList.contains('submenu-expanded') == false){
			menuItemAria.className += ' submenu-expanded';
		}
		// Update aria-expanded state
		toggleAriaExpandedState( currentSubMenu );
	}

	/**
	 * Close sub-menu
	 *
	 * @param {Object} currentSubMenu
	 */
	function closeSubMenu( currentSubMenu ) {
		'use strict';

		var menuItem     = getCurrentParent( currentSubMenu, '.menu-item' ); // this.parentNode
		var menuItemAria = menuItem.querySelector('button[aria-expanded]');

		var subMenu      = currentSubMenu.closest('.link-dropdown');

		// If this is in a sub-sub-menu, go back to parent sub-menu
		if ( getCurrentParent( currentSubMenu, 'ul' ).classList.contains( 'sub-menu' ) ) {

			console.log('yes its a sub sub');
			console.log(subMenu);
			// Update classes
			// classList.remove is not supported in IE11
			menuItem.className = menuItem.className.replace( 'off-canvas', '' );
			subMenu.className  = subMenu.className.replace( 'expanded-true', '' );
			menuItem.lastElementChild.className = menuItem.lastElementChild.className.replace( 'expanded-true', '' );

			// Update aria-expanded and :focus states
			toggleAriaExpandedState( menuItemAria );

		// Or else close all sub-menus
		} else {

			// Update classes
			// classList.remove is not supported in IE11
			menuItem.className = menuItem.className.replace( 'off-canvas', '' );
			menuItem.lastElementChild.className = menuItem.lastElementChild.className.replace( 'expanded-true', '' );

			// Update aria-expanded and :focus states
			toggleAriaExpandedState( menuItemAria );
		}
	}

	/**
	 * Find first ancestor of an element by selector
	 *
	 * @param {Object} child
	 * @param {String} selector
	 * @param {String} stopSelector
	 */
	function getCurrentParent( child, selector, stopSelector ) {

		var currentParent = null;

		while ( child ) {

			if ( child.matches(selector) ) {

				currentParent = child;
				break;

			} else if ( stopSelector && child.matches(stopSelector) ) {

				break;
			}

			child = child.parentElement;
		}

		return currentParent;
	}

	/**
	 * Remove all off-canvas states
	 */
	function removeAllFocusStates() {
		'use strict';

		var siteBranding            = document.getElementsByClassName( 'site-branding' )[0];
		var getFocusedElements      = siteBranding.querySelectorAll(':hover, :focus, :focus-within');
		var getFocusedClassElements = siteBranding.querySelectorAll('.is-focused');
		var i;
		var o;

		for ( i = 0; i < getFocusedElements.length; i++) {
			getFocusedElements[i].blur();
		}

		for ( o = 0; o < getFocusedClassElements.length; o++) {
			deleteClass( getFocusedClassElements[o], 'is-focused' );
		}
	}

	/**
	 * Matches polyfill for IE11
	 */
	if (!Element.prototype.matches) {
		Element.prototype.matches = Element.prototype.msMatchesSelector;
	}

	/**
	 * Toggle `focus` class to allow sub-menu access on touch screens.
	 */
	function toggleSubmenuDisplay() {

		// function to be called whether touch event or click event
		function handleInteraction ( event ) {
			
			if ( event.target.matches('a') ) {

				var url = event.target.getAttribute( 'href' ) ? event.target.getAttribute( 'href' ) : '';

				// Open submenu if url is #
				if ( '#' === url && event.target.nextSibling.matches('.submenu-expand') ) {
					
					openSubMenu( event.target );
				}
			}

			var simulateClick = function (elem) {
				// Create our event (with options)
				var evt = new MouseEvent('click', {
					bubbles: true,
					cancelable: true,
					view: window
				});
				// If cancelled, don't dispatch our event
				var canceled = !elem.dispatchEvent(evt);
			};
			
			if ( event.target.matches('.mobile-search') ){
					// prevent default function
					event.preventDefault();

					// grab the form elements
					searchform = getCurrentParent( event.target, '.search-form');
					label = event.target.previousElementSibling;
					searchInput = label.lastElementChild ;
					
					
					// add active class to the field for user interaction if its the first click
					if (!searchform.matches('.active')){
						searchform.className += ' active';
						return;
					} else if ( searchInput.value == ''){
						return;
					}
					
					// then trigger the click
					simulateClick( event.target )
					
					
			// conditional to remove class if user clicks elsewhere
			} else if (!event.target.matches('.search-field')) {
				searchform = document.querySelector('.search-form');
				searchform.className = searchform.className.replace('active', '');
			};

			// Check if .submenu-expand is touched
			if ( event.target.matches('.submenu-expand')  ) {
				openSubMenu(event.target);
			// } else if ( event.target.matches('a') && event.target.parentElement.classList.contains('menu-item-has-children') ) {
			// 	openSubMenu(event.target);
			
			// Check if child of .submenu-expand is touched
			} else if ( null != getCurrentParent( event.target, '.submenu-expand' ) &&
								getCurrentParent( event.target, '.submenu-expand' ).matches( '.submenu-expand' ) && !getCurrentParent( event.target, '.submenu-expand' ).matches( '.submenu-expanded' ) ) {
				openSubMenu( getCurrentParent( event.target, '.submenu-expand' ) );

			} else if ( null !== getCurrentParent( event.target, '.submenu-expand' ) && 
								getCurrentParent( event.target, '.submenu-expand' ).matches( '.submenu-expanded' ) ) {
				deleteClass(getCurrentParent( event.target, '.submenu-expand' ), 'submenu-expanded');
				closeSubMenu( event.target );
			}

			// Prevent default mouse/focus events
			removeAllFocusStates();
		}
		
		document.addEventListener('touchstart', handleInteraction, false);
		document.addEventListener('click', handleInteraction, false);
		// document.addEventListener('mouseover', handleInteraction, false);
		// document.addEventListener('mouseleave', function(){ console.log('mouse left tee hee') }, false);

		var submenus = document.querySelectorAll('.menu-item-has-children');
		// console.log(submenus);

		submenus.forEach(item => {
			var removing;
			item.addEventListener('mouseover', function(){
				clearTimeout(removing);
				button = item.querySelectorAll('.link-dropdown')[0];

				openSubMenu(button);
			});
			item.addEventListener('mouseleave', function(){
				removing = setTimeout(function(){
					button = item.querySelectorAll('.link-dropdown')[0];
	
					closeSubMenu(button);

				}, 125);
			});			
		})
		
		document.addEventListener('touchend', function(event) {

			
			var mainNav = getCurrentParent( event.target, '.main-navigation' );

			if ( null != mainNav && hasClass( mainNav, '.main-navigation' ) ) {
				// Prevent default mouse events
				event.preventDefault();

			} else if (
				event.target.matches('.submenu-expand') ||
				null != getCurrentParent( event.target, '.submenu-expand' ) &&
				getCurrentParent( event.target, '.submenu-expand' ).matches( '.submenu-expand' ) ) {
					// Prevent default mouse events
					event.preventDefault();
			}

			// Prevent default mouse/focus events
			removeAllFocusStates();

		}, false);

		document.addEventListener('focus', function(event) {

			if ( event.target.matches('.main-navigation > div > ul > li a') ) {

				// Remove Focused elements in sibling div
				var currentDiv        = getCurrentParent( event.target, 'div', '.main-navigation' );
				var currentDivSibling = currentDiv.previousElementSibling === null ? currentDiv.nextElementSibling : currentDiv.previousElementSibling;
				var focusedElement    = currentDivSibling.querySelector( '.is-focused' );
				var focusedClass      = 'is-focused';
				var prevLi            = getCurrentParent( event.target, '.main-navigation > div > ul > li', '.main-navigation' ).previousElementSibling;
				var nextLi            = getCurrentParent( event.target, '.main-navigation > div > ul > li', '.main-navigation' ).nextElementSibling;

				if ( null !== focusedElement && null !== hasClass( focusedElement, focusedClass ) ) {
					deleteClass( focusedElement, focusedClass );
				}

				// Add .is-focused class to top-level li
				if ( getCurrentParent( event.target, '.main-navigation > div > ul > li', '.main-navigation' ) ) {
					addClass( getCurrentParent( event.target, '.main-navigation > div > ul > li', '.main-navigation' ), focusedClass );
				}

				// Check for previous li
				if ( prevLi && hasClass( prevLi, focusedClass ) ) {
					deleteClass( prevLi, focusedClass );
				}

				// Check for next li
				if ( nextLi && hasClass( nextLi, focusedClass ) ) {
					deleteClass( nextLi, focusedClass );
				}
			}

		}, true);

		document.addEventListener('click', function(event) {

			// Remove all focused menu states when clicking outside site branding
			if ( event.target !== document.getElementsByClassName( 'site-branding' )[0] ) {
				removeAllFocusStates();
			} else {
				// nothing
			}

		}, false);
	}

	/**
	 * Run our sub-menu function as soon as the document is `ready`
	 */
	document.addEventListener( 'DOMContentLoaded', function() {
		toggleSubmenuDisplay();
	});

	/**
	 * Run our sub-menu function on selective refresh in the customizer
	 */
	document.addEventListener( 'customize-preview-menu-refreshed', function( e, params ) {
		if ( 'top-right' === params.wpNavMenuArgs.theme_location ) {
			toggleSubmenuDisplay();
		}
	});

	/**
	 * Run our sub-menu function every time the window resizes
	 */
	var isResizing = false;
	window.addEventListener( 'resize', function() {
		isResizing = true;
		debounce( function() {
			if ( isResizing ) {
				return;
			}

			toggleSubmenuDisplay();
			isResizing = false;

		}, 150 );
	} );



// tweak the expansion behavior of search on mobile menus

		// init function
		function activateSearch( event ){
	
			// query select the search
			// var search = document.querySelectorAll('.is-mobile');
			// event.preventDefault();
			
			// check condition for the is-mobile class based on resize
				// prevent default function
					// add active class to the field for user interaction

					// conditional to remove class if user clicks elsewhere

					// then trigger the click
				}
	
		// call the function
		activateSearch();
})();