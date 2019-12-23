/**
 * masdocs.js
 *
 * Handles all scripts used by the theme
 */
/**
 * Setup anchors for documents
 */

anchors.remove( 'h2, h3, h4, h5, h6' );
var newAnchors = new AnchorJS();
newAnchors.add( '.wedocs-single-content .entry-content > h2, .wedocs-single-content .entry-content > h3, .wedocs-single-content .entry-content > h4, .wedocs-single-content .entry-content > h5, .wedocs-single-content .entry-content > h6' );
console.log( newAnchors.elements );
if ( newAnchors.elements.length > 0 ) {
	generateTableOfContents( newAnchors.elements );
}

function generateTableOfContents( els ) {
	var toc = document.getElementById( 'table-of-contents' ),
		prevLevel = 0,
		root, curr;

	if ( toc === null ) return;

	if ( toc.classList.contains( 'd-none' ) ) {
		toc.classList.remove( 'd-none' );
		toc.classList.add( 'd-block' );
	}

	var closeLevel = function( e, levels ) {
		for (var i = 0; i < levels && e.parentElement && e.parentElement.parentElement; i++) {
			e = e.parentElement.parentElement;
		}
		return e;
	};

	for ( var i = 0; i < els.length; i++ ) {
		var el = els[i],
			tag = el.tagName.toLowerCase(),
			curLevel = parseInt( tag.replace( /[^\d]/i, '' ), 10 ), // get number from h1, h2, h3,... tags
			anchoredElText = el.textContent,
			anchoredElHref = el.querySelector('.anchorjs-link').getAttribute('href'),
			li = getListItem( anchoredElHref, anchoredElText );
			li.classList.add( 'nav-item' );

		if ( curLevel > prevLevel ) {
			if ( ! curr ) {
				root = document.createElement( 'OL' );
				root.appendChild( li );
				root.classList.add( 'nav' );
                root.classList.add( 'flex-column' );
			} else {
				var ul = document.createElement( 'UL' );
				ul.appendChild( li );
				curr.appendChild( ul );
			}
		} else if ( curLevel === prevLevel ) {
			curr.parentElement.appendChild( li );
		} else if ( curLevel < prevLevel ) {
			var ancestor = closeLevel(curr, prevLevel - curLevel);
			ancestor.parentElement.appendChild(li);
		}
		curr = li;
		prevLevel = curLevel;
	}

	toc.appendChild( root );
}

function getListItem( href, text ) {
	var listItem   = document.createElement('LI'),
		anchorItem = document.createElement('A'),
		textNode   = document.createTextNode(text);

	anchorItem.href = href;
	anchorItem.classList.add( 'nav-link' );
	anchorItem.appendChild( textNode );
	listItem.appendChild( anchorItem );
	return listItem;
}

( function( $ ) {
	'use strict';

    $('[data-toggle="tooltip"]').tooltip();

    // Smooth scroll
	// Select all links with hashes
	$('#table-of-contents a[href*="#"]')
  		// Remove links that don't actually link to anything
  		.not('[href="#"]')
  		.not('[href="#0"]')
  		.click( function(event) {
		// On-page links
		if ( location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname ) {
			// Figure out element to scroll to
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			// Does a scroll target exist?
			if (target.length) {
				// Only prevent default if animation is actually gonna happen
				event.preventDefault();

				$('html, body').animate({ scrollTop: target.offset().top }, 1000, function() {
					// Callback after animation
					// Must change focus!
			  		var $target = $(target);
			  		$target.focus();
			  		if ($target.is( ':focus' ) ) { // Checking if the target was focused
						return false;
			  		} else {
						$target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
						$target.focus(); // Set focus again
			  		}
				});
			}
		}
	});

  	$( '.page_item_has_children > a ' ).each( function() {
  		$( this ).append( '<span class="child-indicator"></span>' );
  	});

  	$(document).on( 'click', '.child-indicator', function() {
  		$(this).parent().parent( '.page_item_has_children' ).toggleClass( 'toggled' );
  		return false;
  	});

  	$( document ).on( 'click', '.wedocs-doc-link > a', function() {
  		var $this = $( this ),
  			docsSections = $this.parent().parent().find( '.wedocs-doc-sections' ),
  			$docsSections = $( docsSections );

  		$docsSections.toggleClass( 'toggled' );
  		if ( $docsSections.hasClass( 'toggled' ) ) {
  			$this.text( $this.data( 'toggledText' ) );
  		} else {
  			$this.text( $this.data( 'text' ) );
  		}

  		return false;
  	});

  	$( document ).ready( function() {
  		$( '.current_page_item, .current_page_ancestor' ).each( function() {
  			$( this ).toggleClass( 'toggled' );
  		});
  	});

} )( jQuery );
