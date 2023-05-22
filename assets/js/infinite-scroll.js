( function ( $ ) {
	var initPostsInfiniteScroll = function() {
		if ( 'undefined' == typeof colormagInfiniteScrollParams ) {
			return;
		}

		var infiniteScrollParams = colormagInfiniteScrollParams,
			paginationContainer  = $( '.tg-infinite-pagination' ),
			postsContainer       = $( '.tg-infinite-scroll-container' ),
			infiniteScrollEvent  = infiniteScrollParams['infiniteScrollEvent'];

		if (
			! paginationContainer.length ||
			! postsContainer.length ||
			! paginationContainer.find( '.next' ).length ||
			paginationContainer.infinitescroll
		) {
			return;
		}

		paginationContainer.infinitescroll = new InfiniteScroll( '.tg-infinite-scroll-container', {
			path: '.next',
			checkLastPage: '.next',
			append: '.tg-infinite-scroll-container .post',
			button: 'button' === infiniteScrollEvent ? '.tg-load-more-btn' : null,
			outlayer: null,
			scrollThreshold: 'scroll' === infiniteScrollEvent ? 500 : false,
			onInit: function() {
				var loadMore = paginationContainer.find( '.tg-load-more' );

				this.on( 'load', function() {
					loadMore.removeClass( 'loading' );
				} );

				this.on( 'request', function() {
					loadMore.addClass( 'loading' );
				} );

				this.on( 'last', function() {
					loadMore.find( '.tg-all-post-loaded-text' ).css( 'display', 'block' );
				} );
			}
		} );
	}

	var initAutoLoadNextPost = function() {
		if ( 'undefined' == typeof colormagInfiniteScrollParams ) {
			return;
		}

		var autoLoadNextPostParams = colormagInfiniteScrollParams,
			paginationContainer    = $( '.tg-infinite-pagination' ),
			postContainer          = $( '.tg-autoload-posts' ),
			autoloadEvent          = autoLoadNextPostParams['autoLoadEvent'];

		if (
			! postContainer.length ||
			! paginationContainer.find( '.next' ).length ||
			paginationContainer.infinitescroll
		) {
			return;
		}

		paginationContainer.infinitescroll = new InfiniteScroll( '.tg-autoload-posts', {
			path: function() {
				var next = paginationContainer.find( 'a[data-index="' + ( this.pageIndex + 1 ) + '"]' );
				if ( ! next.length ) {
					this.canLoad = false;
				}
				return next.attr( 'href' );
			},
			append: '.tg-autoload-posts .tg-post',
			button: 'button' === autoloadEvent ? '.tg-load-more-btn' : null,
			outlayer: null,
			scrollThreshold: 'scroll' === autoloadEvent ? 500 : false,
			onInit: function() {
				var loadMore = paginationContainer.find( '.tg-load-more' );

				this.on( 'load', function() {
					loadMore.removeClass( 'loading' );
				} );

				this.on( 'request', function() {
					loadMore.addClass( 'loading' );
				} );

				this.on( 'last', function() {
					loadMore.hide();
				} );
			}
		} );
	}

	$( window ).on( 'load', function() {
		initPostsInfiniteScroll();
		initAutoLoadNextPost();
	} );
} )( jQuery );
