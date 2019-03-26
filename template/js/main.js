/*
	Future Imperfect by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

(function($) {

	var	$window = $(window),
		$body = $('body'),
		$menu = $('#menu'),
		$sidebar = $('#sidebar'),
		$main = $('#main');

	// Breakpoints.
		breakpoints({
			xlarge:   [ '1281px',  '1680px' ],
			large:    [ '981px',   '1280px' ],
			medium:   [ '737px',   '980px'  ],
			small:    [ '481px',   '736px'  ],
			xsmall:   [ null,      '480px'  ]
		});

	// Play initial animations on page load.
		$window.on('load', function() {
			window.setTimeout(function() {
				$body.removeClass('is-preload');
			}, 100);
		});

	// Menu.
		$menu
			.appendTo($body)
			.panel({
				delay: 500,
				hideOnClick: true,
				hideOnSwipe: true,
				resetScroll: true,
				resetForms: true,
				side: 'right',
				target: $body,
				visibleClass: 'is-menu-visible'
			});

	// Intro.
		var $intro = $('#intro');

		// Move to main on <=large, back to sidebar on >large.
			breakpoints.on('<=large', function() {
				$intro.prependTo($main);
			});

			breakpoints.on('>large', function() {
				$intro.prependTo($sidebar);
			});

	// Add tags
	$('.js-add-tag').click((event) => {
		let target = event.target;

		const tagStart = target.getAttribute('data-start-tag');
		const tagEnd = target.getAttribute('data-end-tag');

		let bDouble = tagStart.length && tagEnd.length;
		let textarea = target.parentElement.nextElementSibling;
		let textStart = textarea.selectionStart;
		let textEnd = textarea.selectionEnd;
		let oldText = textarea.value;

		textarea.value = oldText.substring(0, textStart) + (bDouble ? tagStart + oldText.substring(textStart, textEnd) + tagEnd : tagStart) + oldText.substring(textEnd);
		textarea.setSelectionRange(bDouble || textStart === textEnd ? textStart + tagStart.length : textStart, (bDouble ? textEnd : textStart) + tagStart.length);
		textarea.focus();
	});

	// add/remove like
	$('.js-like').on('click', (event) => {
		event.preventDefault();
		let target = event.currentTarget;
		const articleId = $(target).data('articleId');
		let likes = parseInt($(target).html());

		if ($(target).hasClass('js-add-like')) {
			let newLikes = likes + 1;
			$(target).html(newLikes).removeClass('js-add-like').addClass('liked js-remove-like');
			$.post(`article/addLike/${articleId}`);
		}
		else if ($(target).hasClass('js-remove-like')) {
			let newLikes = likes - 1;
			$(target).html(newLikes).removeClass('js-remove-like liked').addClass('js-add-like');
			$.post(`article/removeLike/${articleId}`);
		}
	});

})(jQuery);