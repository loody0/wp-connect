( function( $ ) {

    $( function() {
        $( window ).load( function() {
            responsiveSidebarActivity();
            customScroll();
        } );
        $( window ).resize( function() {
            responsiveHeader();
            responsiveSidebarActivity();
            responsivePostBox();
        } );
        $( window ).resize();

        // post timeline
        $( "body" ).on( "click", ".post-footer-icon .icon-comment", function() {
            $( this ).parents( '.post-panel' ).next( '.comment-panel' ).slideToggle( 300 );
        } );
        $( "body" ).on( "click", ".post-footer-icon", function() {
            $( this ).toggleClass( 'active' );
        } );
        // end post timeline

        // wow
        new WOW( {
            animateClass: 'wow-animated',
            callback: function( box ) {
                voteBar( box );
            }
        } ).init();
        // end wow

        // votebar animated
        function voteBar( box ) {
            var box = $( box );
            if ( box.hasClass( 'post-vote' ) ) {
                box.find( '.vote-item-bar' ).addClass( 'animated voteBar' );
            }
        }
        // end votebar animated

        /*
         * responsive header
         */
        function responsiveHeader() {
            var __body = $( "body" );
            var __siteHeader = $( '#site-header' );
            var __siteNavbar = $( '#site-navbar' );

            var __pageWrapper = $( '.page-wrap' );
            var __pageOverlay = $( '.page-overlay' );

            var __siteMenuSide = $( '#side-menu-wrap' );

            var __navbarSideLeft = $( '#side-left' );
            var __navbarSideRight = $( '#side-right' );

            var _hSiteNavbar = __siteNavbar.outerHeight();

            var _sw = window.innerWidth;

            var __siteNavbar = $( '#site-navbar' );
            
            /*
             * navbar fixed only >768px
             */
            if ( _sw < 768 ) {
                __siteNavbar.removeClass( 'navbar-fixed-top' );
                __pageWrapper.removeClass( 'fixed-navbar' );
            } else {
                __siteNavbar.addClass( 'navbar-fixed-top' );
                __pageWrapper.addClass( 'fixed-navbar' );
            }
            
            /*
             * site-menu responsive
             */
            __siteHeader.removeClass( 'header-resp-1' );
            __siteHeader.removeClass( 'header-resp-2' );
            __siteMenuSide.removeClass( 'open' );
            _sw = window.innerWidth;
            _hSiteNavbar = __siteNavbar.outerHeight();
            if ( _hSiteNavbar > 85 ) {
                __siteHeader.addClass( 'header-resp-1' );
                _hSiteNavbar = __siteNavbar.outerHeight();
                _hSiteNavbar = __siteNavbar.outerHeight();
                if ( _hSiteNavbar > 85 ) {
                    __siteHeader.removeClass( 'header-resp-1' );
                    __siteHeader.addClass( 'header-resp-2' );
                    _hSiteNavbar = __siteNavbar.outerHeight();
                    if ( _hSiteNavbar > 85 ) {
                        __siteHeader.addClass( 'header-resp-1' );
                    }
                }
            }
            
            
            __body.off( "click", "#site-menu-bar" );
            __body.on( "click", "#site-menu-bar", function() {
                __body.toggleClass( 'side-opened' );
                __siteMenuSide.toggleClass( 'open' );
                __pageWrapper.toggleClass( 'open-left' );
                __pageOverlay.toggleClass( 'active' );
            } );

            __body.off( "click", ".page-overlay" );
            __body.on( "click", ".page-overlay", function() {
                __body.removeClass( 'side-opened' );
                __pageOverlay.removeClass( 'active' );
                __pageWrapper.removeClass( 'open-left' );
                __pageWrapper.removeClass( 'open-right' );
                __siteMenuSide.removeClass( 'open' );
                __navbarSideRight.removeClass( 'open' );
                __navbarSideLeft.removeClass( 'open' );
            } );

            __body.off( "click", "#side-right-bar" );
            __body.on( "click", "#side-right-bar", function() {
                __body.toggleClass( 'side-opened' );
                __pageWrapper.toggleClass( 'open-right' );
                __pageOverlay.toggleClass( 'active' );
                __navbarSideRight.toggleClass( 'open' );
            } );

            __body.off( "click", "#side-left-bar" );
            __body.on( "click", "#side-left-bar", function() {
                __body.toggleClass( 'side-opened' );
                __pageWrapper.toggleClass( 'open-left' );
                __pageOverlay.toggleClass( 'active' );
                __navbarSideLeft.toggleClass( 'open' );
            } );
        }
        /*
         * end responsive header
         */

        // sidebar activity
        function responsiveSidebarActivity() {
            var _width = $( '.site-sidebar .sidebar-col-1' ).width();
            $( '.site-sidebar .sidebar-activity-chat' ).width( _width );
        }
        // end sidebar activity

        // side left top
        $( "body" ).on( "click", ".side-left .side-left-top .side-left-top-toggle", function() {
            var _target = $( $( this ).data( 'target' ) );
            $( this ).parents( ".side-left-top" ).find( ".side-left-top-dropdown" ).not( _target ).slideUp( 300 );
            _target.slideToggle( 300 );
        } );
        // end side left top

        /*
         * post box responsive
         */
        function responsivePostBox() {
            var __navTabsMoreDM = $( '.post-box .nav-tabs li.more ul' );
            var __navTabs = $( '.post-box .nav-tabs' );
            var __navTabsMore = $( '.post-box .nav-tabs li.more' );
            var __navTabsLi = $( '.post-box .nav-tabs li:not(.more)' ).add( '.post-box .nav-tabs li.more ul li' );
            $.fn.reverse = function() {
                return this.pushStack( this.get().reverse() );
            };
            // get back li from more button to navTabs
            __navTabsMoreDM.children( 'li' ).each( function() {
                $( this ).appendTo( __navTabs );
                __navTabsMore.appendTo( __navTabs );
            } );

            var _navTabs_height = __navTabs.height();
            if ( _navTabs_height > 45 ) {
                __navTabsMore.show();
                __navTabsLi.reverse().each( function( index ) {
                    _navTabs_height = __navTabs.height();
                    if ( _navTabs_height > 45 ) {
                        $( this ).prependTo( __navTabsMoreDM );
                    }
                } );
            } else {
                __navTabsMore.hide();
            }
        }
        /*
         * end post box responsive
         */

        // custom scroll
        function customScroll() {
            $( '.cn-custom-scroll' ).mCustomScrollbar( {
                theme: "dark-2",
                scrollEasing: "linear",
                scrollInertia: 200,
            } );

            $( '.cn-custom-scroll-inner' ).bind( 'mousewheel DOMMouseScroll', function( e ) {
                var e0 = e.originalEvent,
                        delta = e0.wheelDelta || -e0.detail;

                this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
                e.preventDefault();
            } );
        }
        // end custom scroll

        // messages
        $( "body" ).on( "click", "#messages-main .messages-list .message-item", function() {
            $( this ).siblings( ".message-item" ).removeClass( 'active' );
            $( this ).addClass( 'active' );
            $( '#messages-main' ).addClass( 'open' );
            $( '#messages-main .conversation-cont' ).addClass( 'open' );
        } );
        $( "body" ).on( "click", "#messages-main .conversation-cont .close-conversation", function() {
            $( "#messages-main .messages-list .message-item" ).removeClass( 'active' );
            $( '#messages-main' ).removeClass( 'open' );
            $( '#messages-main .conversation-cont' ).removeClass( 'open' );

        } );
        // end messages

        // chat window
        $( "body" ).on( "click", ".chat-window .chat-window-header", function() {
            $( this ).parent( '.chat-window' ).toggleClass( 'min' );
            $( this ).parent( '.chat-window' ).toggleClass( 'open' );
        } );
        // end chat window

    } );

    //    ajax page loader
    $( function() {
        var link = location.pathname;
        var i = 0;
        if ( Modernizr.history ) {
            $( "body" ).on( "click", "a.ajax-page", function() {
                var href_ = $( this ).attr( "href" );
                var href = $( this ).data( "target" );
                history.pushState( null, null, href_ );
                loadPage( href_ );

                return false;
            } );
            $( window ).bind( "popstate", function( ev ) {
                if ( window.location.href.split( "#" ).length != 1 ) {
                    //hash
                    return;
                }
                var link = location.href;
                window.location = link;
            } );
        }

        function loadPage( url ) {
            var bar = $( '.page-progress-bar' );
            var overlay = $( '.page-progress-overlay' );
            var jqXHR = null;
            jqXHR = $.ajax( {
                xhr: function()
                {
                    var xhr = new window.XMLHttpRequest();
                    //Upload progress
                    xhr.upload.addEventListener( "progress", function( evt ) {
                        if ( evt.lengthComputable ) {
                            var percentComplete = evt.loaded / evt.total;
                            //Do something with upload progress
                        }
                    }, false );
                    //Download progress
                    xhr.addEventListener( "progress", function( evt ) {
                        if ( evt.lengthComputable ) {
                            var percentComplete = evt.loaded / evt.total;
                            //Do something with download progress
                            var barWidth = Math.round( percentComplete * 100 );
                            bar.animate( {
                                width: barWidth + '%'
                            }, 300, function() {
                            } );
                        } else {
                            var barWidth = 30;
                            bar.animate( {
                                width: barWidth + '%'
                            }, 200);
                        }
                    }, false );
                    return xhr;
                },
                type: 'POST',
                url: url,
                dataType: 'html',
                beforeSend: function() {
                    bar.show( 0 );
                    overlay.show( 0 );
                }

            } )
                    .done( function( data ) {
                        $( "#page-wrap" ).replaceWith( $( data ).filter( '#page-wrap' ) );
                        document.title = $( data ).filter( 'title' ).text();
                        bar.animate( {
                            width: '100%'
                        }, 200, function(){
                            bar.hide( 0 ).width( 0 );
                            overlay.fadeOut( 300 );
                        });
                        $( window ).resize();
                        $( window ).load();
                    } )
                    .fail( function( jqXHR, status ) {

                    } );
        }

    } );

}( jQuery ) );
