/**
 * scripts.js
 *
 * Handles behaviour of the theme
 */

/**
 * Global Helper Functions
 */

// Get Breakpoint set in main.css (at the end)
function reenGetCSSBreakpoint() {
    return window.getComputedStyle(document.querySelector('body'), ':before')
        .getPropertyValue('content')
        .replace(/\"/g, '');
}

// Checks if selected Breakpoint matches current
function reenCSSBreakpoint(bp) {
    return reenGetCSSBreakpoint() === bp && true;
}

// Checks if Breakpoint has switched e.g. on Resize
var reenSwitchedBreakpoint = (function() {
    var lastBreakpoint;
    return function() {
        if (reenGetCSSBreakpoint() !== lastBreakpoint) {
            lastBreakpoint = reenGetCSSBreakpoint();
            return true;
        } else return false;
    }
})();

// Debounce/Delay Window Resize Function for better Resize Performance
function reenDebounce(func, wait, immediate) {
    var timeout,
        wait = wait || 100; // Default Delay 100ms
    return function() {
        var context = this,
            args = arguments,
            later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            },
            callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    }
}

// Scroll Up / Scroll to Top Function
! function(a, b, c) {
    a.fn.reenScrollUp = function(b) {
        a.data(c.body, "scrollUp") || (a.data(c.body, "scrollUp", !0), a.fn.reenScrollUp.init(b))
    }, a.fn.reenScrollUp.init = function(d) {
        var e = a.fn.reenScrollUp.settings = a.extend({}, a.fn.reenScrollUp.defaults, d),
            f = e.scrollTitle ? e.scrollTitle : e.scrollText,
            g = a("<a/>", {
                id: e.scrollName,
                href: "#top"
                /*,
                                title: f*/
            }).appendTo("body");
        e.scrollImg || g.html(e.scrollText), g.css({
            display: "none",
            position: "fixed",
            zIndex: e.zIndex
        }), e.activeOverlay && a("<div/>", {
            id: e.scrollName + "-active"
        }).css({
            position: "absolute",
            top: e.scrollDistance + "px",
            width: "100%",
            borderTop: "1px dotted" + e.activeOverlay,
            zIndex: e.zIndex
        }).appendTo("body"), scrollEvent = a(b).scroll(function() {
            switch (scrollDis = "top" === e.scrollFrom ? e.scrollDistance : a(c).height() - a(b).height() - e.scrollDistance, e.animation) {
                case "fade":
                    a(a(b).scrollTop() > scrollDis ? g.fadeIn(e.animationInSpeed) : g.fadeOut(e.animationOutSpeed));
                    break;
                case "slide":
                    a(a(b).scrollTop() > scrollDis ? g.slideDown(e.animationInSpeed) : g.slideUp(e.animationOutSpeed));
                    break;
                default:
                    a(a(b).scrollTop() > scrollDis ? g.show(0) : g.hide(0))
            }
        }), g.click(function(b) {
            b.preventDefault(), a("html, body").animate({
                scrollTop: 0
            }, e.scrollSpeed, e.easingType)
        })
    }, a.fn.reenScrollUp.defaults = {
        scrollName: "scrollUp",
        scrollDistance: 300,
        scrollFrom: "top",
        scrollSpeed: 300,
        easingType: "linear",
        animation: "fade",
        animationInSpeed: 200,
        animationOutSpeed: 200,
        scrollText: "Scroll to top",
        scrollTitle: !1,
        scrollImg: !1,
        activeOverlay: !1,
        zIndex: 2147483647
    }, a.fn.reenScrollUp.destroy = function(d) {
        a.removeData(c.body, "scrollUp"), a("#" + a.fn.reenScrollUp.settings.scrollName).remove(), a("#" + a.fn.reenScrollUp.settings.scrollName + "-active").remove(), a.fn.jquery.split(".")[1] >= 7 ? a(b).off("scroll", d) : a(b).unbind("scroll", d)
    }, a.reenScrollUp = a.fn.reenScrollUp
}(jQuery, window, document);

(function($, window) {

    /*===================================================================================*/
    /*  DROPDOWN ON HOVER (NAVIGATION)
    /*===================================================================================*/

    $(document).ready(function() {

        function reenDropdownHover() {
            $('.dropdown, .dropdown-submenu').addClass('hover');
            $(document).on({
                mouseenter: function() {
                    $('.open').removeClass('open');
                    $(this).addClass('open').find('.dropdown-toggle').removeAttr('data-toggle');
                },
                mouseleave: function() {
                    $(this).removeClass('open').find('.dropdown-toggle').attr('data-toggle', 'dropdown');
                }
            }, '.dropdown.hover');

            $(document).on({
                mouseleave: function() {
                    $(this).removeClass('open');
                }
            }, '.dropdown-submenu.hover.open');
        }

        function dropdownPress() {
            $('.dropdown, .dropdown-submenu').removeClass('hover');
        }

        $('.dropdown-submenu [data-toggle=dropdown]').click(function(event) {
            $(this).parent()
                .siblings('.open').removeClass('open')
                .find('.open').removeClass('open');
            $(this).parent()
                .toggleClass('open')
                .find('.open').removeClass('open');
            event.preventDefault();
            event.stopPropagation();
        });

        if (reenCSSBreakpoint('md')) {
            reenDropdownHover();
            var reenDropdownHoverActive = true;
        } else var reenDropdownHoverActive = false;

        $(window).resize(reenDebounce(function() {
            if (reenCSSBreakpoint('md') && !reenDropdownHoverActive) {
                reenDropdownHover();
                reenDropdownHoverActive = true;
            } else if (reenCSSBreakpoint('xs') && reenDropdownHoverActive) {
                dropdownPress();
                reenDropdownHoverActive = false;
            }
        }));

    });


    /*===================================================================================*/
    /*  SMOOTH MAIN CONTENT REVEAL
    /*===================================================================================*/

    $(document).ready(function() {
        $('main').addClass('js-reveal');
    });


    /*===================================================================================*/
    /*  AOS — ANIMATE ON SCROLL
    /*===================================================================================*/

    $(document).ready(function() {

        // Settings
        var reenAosEnable = true, // ------------------------------------------------   Turn on/off AOS
            reenAosMobileDisable = false, // -----------------------------------------------    Turn on/off AOS on Mobile
            reenAosContainer = 'main', // ----------------------------------------------    Container (e.g. 'body' [with Footer] or '#main'/'main' [without Footer])
            reenAosItems = '[class*="col-"]:not(.reen-form-group):not(.rgb-single-column.no-aos), .isotope .item, .posts .post', // -----   Add/remove Elements to be animated
            reenAosAnimation = 'fade-up'; // -------------------------------------------    Animation type (More on: https://github.com/michalsnik/aos)

        AOS.init({
            offset: 120, // ----------------------------------------------------------- Default: 120
            duration: 500, // -----------------------------------------------------------   Default: 400
            easing: 'ease-out-cubic', // ---------------------------------------------- Default: 'ease'
            delay: 0, // -------------------------------------------------------------  Default: 0
            once: true, // ----------------------------------------------------------   Default: false
            disable: !reenAosEnable, // ----------------------------------------------------    Default: false (Set above)
            startEvent: 'DOMContentLoaded' // --------------------------------------------- Default: 'DOMContentLoaded'
        });

        function reenEnableAOS() {
            $(reenAosContainer + ' ' + reenAosItems).attr({
                'data-aos': reenAosAnimation
            });
            disableAOS($(reenAosContainer + ' .collapsed').parents(reenAosContainer + ' > *').next().find(reenAosItems), true);
            reenAosEnabled = true;
        }

        function disableAOS(aosItem, stayEnabled) {
            aosItem.removeAttr('data-aos');
            reenAosEnabled = stayEnabled || false;
        }

        if (reenAosEnable && (!reenAosMobileDisable || reenCSSBreakpoint('md')))
            reenEnableAOS();
        else
            reenAosEnabled = false;

        $(window).resize(reenDebounce(function() {
            if (reenAosEnable && !reenAosEnabled && (!reenAosMobileDisable || reenCSSBreakpoint('md'))) {
                reenEnableAOS();
                $(reenAosContainer + ' ' + reenAosItems).addClass('aos-animate');
            } else if (reenAosEnabled && reenAosMobileDisable && reenCSSBreakpoint('xs'))
                disableAOS($(reenAosItems));
        }));

        $('a[data-filter]').click(function() {
            if (reenAosEnabled)
                disableAOS($(reenAosItems));
        });

    });


    /*===================================================================================*/
    /*  FIXED NAVIGATION (BOOTSTRAP AFFIX)
    /*===================================================================================*/
    $(document).ready(function() {

        if( typeof reen_options !== 'undefined' && reen_options.enableStickyHeader ) {
            var reenAffixElementDesktop         = '.navbar-collapse',
                reenAffixElementDesktopHeight   = reenAffixElementDesktop,
                reenAffixElementDesktopOffset   = '.navbar-header',
                reenAffixElementMobile          = '.navbar',
                reenAffixElementMobileHeight    = '.navbar-header',
                reenAffixElementMobileNav       = '.navbar-nav',
                reenAffixElementMobileNavBtn    = '.navbar-toggler',
                reenBodyScrollDisableClass      = 'body-scroll-disabled';
            
            function reenAffixNav(el, elHeight, elOffset) {
                $(window).off('.affix');
                $('.affix, .affix-top').unwrap();
                $(reenAffixElementDesktop + ', ' + reenAffixElementMobile)
                    .removeData('bs.affix')
                    .removeClass('affix affix-top');

                $(el).affix({ offset: { top: $(elOffset).outerHeight(true) || 0 } });

                $('.affix, .affix-top')
                    .wrap('<div class="affix-wrapper"></div>')
                    .parent().css('min-height', $(elHeight).outerHeight(true) || 0);
            }
            
            $(window).resize(reenDebounce(function () {
                if (reenCSSBreakpoint('md')) {
                    if (reenSwitchedBreakpoint()) {
                        $(reenAffixElementMobileNav).css('height', '');
                        reenAffixNav(reenAffixElementDesktop, reenAffixElementDesktopHeight, reenAffixElementDesktopOffset);
                        if ($(reenAffixElementDesktop).hasClass('show')) {
                            reenEnableSelectedScroll(false, reenAffixElementMobileNav);
                            $('html').removeClass(reenBodyScrollDisableClass);
                        }
                    }
                }
                else if (reenCSSBreakpoint('xs')) {
                    if (reenSwitchedBreakpoint()) {
                        reenAffixNav(reenAffixElementMobile, reenAffixElementMobileHeight);
                        if ($(reenAffixElementDesktop).hasClass('show')) {
                            reenEnableSelectedScroll(true, reenAffixElementMobileNav);
                            $('html').addClass(reenBodyScrollDisableClass);
                        }
                    }
                    $(reenAffixElementMobileNav).css('height', window.innerHeight - $(reenAffixElementMobileHeight).outerHeight(true) || 0);
                }
            })).resize();

            $(reenAffixElementDesktop).on('show.bs.collapse', function(){
                reenEnableSelectedScroll(true, reenAffixElementMobileNav);
                $('html').addClass(reenBodyScrollDisableClass);
            });

            $(reenAffixElementDesktop).on('hide.bs.collapse', function(){
                reenEnableSelectedScroll(false, reenAffixElementMobileNav);
                $('html').removeClass(reenBodyScrollDisableClass);
            });
        }

    });


    /*===================================================================================*/
    /*  HEADER RESIZE
    /*===================================================================================*/
    $(document).ready(function() {

        // Settings
        var reenTopHeaderHeight     = $('.navbar-header').outerHeight(true), // ------- Get Height of Element that is not fixed and not being changed — used for Delay before Element starts changing
            reenObjectStyles        = {
                navbarPadTop    : { // -------------------------------------------- Custom Element/Object Name — type what you want
                    element     : '.navbar .navbar-collapse', // ------------------ CSS Class of Element that is being changed
                    style       : 'padding-top', // ------------------------------- CSS Style that is being changed
                    start       : 'currentValueFromCSS', // ----------------------- Change from e.g. 30 (Pixels) — if a String/Text is entered then the current Value from CSS File is being taken
                    end         : 0, // ------------------------------------------- Change to e.g. 0 (Pixels)
                    distance    : 300, // ----------------------------------------- Element is being resized for e.g. 300 (Pixels) scrolled
                    delay       : reenTopHeaderHeight // ------------------------------ Delay before Element starts changing e.g. 50 (Pixels)
                },
                navbarPadBot    : {
                    element     : '.navbar .navbar-collapse',
                    style       : 'padding-bottom',
                    start       : 'currentValueFromCSS',
                    end         : 0,
                    distance    : 300,
                    delay       : reenTopHeaderHeight
                },
                navbarLogoH     : {
                    element     : '.navbar-brand img',
                    style       : 'height',
                    start       : 'currentValueFromCSS',
                    end         : 20,
                    distance    : 300,
                    delay       : reenTopHeaderHeight
                }
            },
            scrolledFromTop     = 0,
            running             = false;
        
        function reenInitialize() {
            $.each(reenObjectStyles, function(obj, prop) {
                prop.start              = typeof prop.start === 'string' ? parseInt($(prop.element).css(prop.style), 10) : prop.start;
                prop.maxChange          = prop.start - prop.end;
                prop.scrollRatio        = prop.maxChange / prop.distance;
                prop.animTriggered      = false;
                prop.animFinished       = false;
                $(prop.element).addClass('animate');
            });
        }
        
        function destroy() {
            $.each(reenObjectStyles, function(obj, prop) {
                $(prop.element)
                    .css(prop.style, '')
                    .removeClass('animate animate-after');
            });
        }

        function reenResizeHeader() {
            scrolledFromTop     = $(document).scrollTop();
            running             = false;
            $.each(reenObjectStyles, function(obj, prop) {
                if (scrolledFromTop > prop.delay) {
                    if (!prop.animTriggered) prop.animTriggered = true;
                    prop.scrolled = scrolledFromTop - prop.delay;
                    if (prop.scrolled <= prop.distance) {
                        prop.currentChange = prop.start - prop.scrolled * prop.scrollRatio.toFixed(2);
                        $(prop.element).css(prop.style, prop.currentChange + 'px');
                        if (prop.animFinished) {
                            prop.animFinished = false;
                            $(prop.element).removeClass('animate-after');
                        }
                    }
                    else if (!prop.animFinished) {
                        prop.animFinished = true;
                        $(prop.element)
                            .css(prop.style, prop.end + 'px')
                            .addClass('animate-after');
                    }
                }
                else if (prop.animTriggered) {
                    prop.animTriggered = false;
                    $(prop.element).css(prop.style, prop.start + 'px');
                }
            });
        }

        if (reenCSSBreakpoint('md')) {
            reenInitialize();
            var reenInitializedResizeHeader = true;
        }
        else var reenInitializedResizeHeader = false;
        
        $(window).resize(reenDebounce(function () {
            if (reenCSSBreakpoint('md') && !reenInitializedResizeHeader) {
                reenInitialize();
                reenResizeHeader();
                reenInitializedResizeHeader = true;
            }
            else if (reenCSSBreakpoint('xs') && reenInitializedResizeHeader) {
                destroy();
                reenInitializedResizeHeader = false;
            }
        }));
        
        $(window).scroll(function () {
            if (reenCSSBreakpoint('md') && !running) window.requestAnimationFrame(reenResizeHeader);
            running = true;
        });

    });


    /*===================================================================================*/
    /*  OWL CAROUSEL
    /*===================================================================================*/

    $(document).ready(function() {

        var reenDragging = true;
        var reenOwlElementID = "#owl-main";

        function reenFadeInReset() {
            if (!reenDragging) {
                $(reenOwlElementID + " .caption .fadeIn-1, " + reenOwlElementID + " .caption .fadeIn-2, " + reenOwlElementID + " .caption .fadeIn-3").stop().delay(800).animate({
                    opacity: 0
                }, {
                    duration: 400,
                    easing: "easeInCubic"
                });
            } else {
                $(reenOwlElementID + " .caption .fadeIn-1, " + reenOwlElementID + " .caption .fadeIn-2, " + reenOwlElementID + " .caption .fadeIn-3").css({
                    opacity: 0
                });
            }
        }

        function reenFadeInDownReset() {
            if (!reenDragging) {
                $(reenOwlElementID + " .caption .fadeInDown-1, " + reenOwlElementID + " .caption .fadeInDown-2, " + reenOwlElementID + " .caption .fadeInDown-3").stop().delay(800).animate({
                    opacity: 0,
                    top: "-15px"
                }, {
                    duration: 400,
                    easing: "easeInCubic"
                });
            } else {
                $(reenOwlElementID + " .caption .fadeInDown-1, " + reenOwlElementID + " .caption .fadeInDown-2, " + reenOwlElementID + " .caption .fadeInDown-3").css({
                    opacity: 0,
                    top: "-15px"
                });
            }
        }

        function reenFadeInUpReset() {
            if (!reenDragging) {
                $(reenOwlElementID + " .caption .fadeInUp-1, " + reenOwlElementID + " .caption .fadeInUp-2, " + reenOwlElementID + " .caption .fadeInUp-3").stop().delay(800).animate({
                    opacity: 0,
                    top: "15px"
                }, {
                    duration: 400,
                    easing: "easeInCubic"
                });
            } else {
                $(reenOwlElementID + " .caption .fadeInUp-1, " + reenOwlElementID + " .caption .fadeInUp-2, " + reenOwlElementID + " .caption .fadeInUp-3").css({
                    opacity: 0,
                    top: "15px"
                });
            }
        }

        function reenFadeInLeftReset() {
            if (!reenDragging) {
                $(reenOwlElementID + " .caption .fadeInLeft-1, " + reenOwlElementID + " .caption .fadeInLeft-2, " + reenOwlElementID + " .caption .fadeInLeft-3").stop().delay(800).animate({
                    opacity: 0,
                    left: "15px"
                }, {
                    duration: 400,
                    easing: "easeInCubic"
                });
            } else {
                $(reenOwlElementID + " .caption .fadeInLeft-1, " + reenOwlElementID + " .caption .fadeInLeft-2, " + reenOwlElementID + " .caption .fadeInLeft-3").css({
                    opacity: 0,
                    left: "15px"
                });
            }
        }

        function reenFadeInRightReset() {
            if (!reenDragging) {
                $(reenOwlElementID + " .caption .fadeInRight-1, " + reenOwlElementID + " .caption .fadeInRight-2, " + reenOwlElementID + " .caption .fadeInRight-3").stop().delay(800).animate({
                    opacity: 0,
                    left: "-15px"
                }, {
                    duration: 400,
                    easing: "easeInCubic"
                });
            } else {
                $(reenOwlElementID + " .caption .fadeInRight-1, " + reenOwlElementID + " .caption .fadeInRight-2, " + reenOwlElementID + " .caption .fadeInRight-3").css({
                    opacity: 0,
                    left: "-15px"
                });
            }
        }

        function reenFadeIn() {
            $(reenOwlElementID + " .active .caption .fadeIn-1").stop().delay(500).animate({
                opacity: 1
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(reenOwlElementID + " .active .caption .fadeIn-2").stop().delay(700).animate({
                opacity: 1
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(reenOwlElementID + " .active .caption .fadeIn-3").stop().delay(1000).animate({
                opacity: 1
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
        }

        function reenFadeInDown() {
            $(reenOwlElementID + " .active .caption .fadeInDown-1").stop().delay(500).animate({
                opacity: 1,
                top: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(reenOwlElementID + " .active .caption .fadeInDown-2").stop().delay(700).animate({
                opacity: 1,
                top: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(reenOwlElementID + " .active .caption .fadeInDown-3").stop().delay(1000).animate({
                opacity: 1,
                top: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
        }

        function reenFadeInUp() {
            $(reenOwlElementID + " .active .caption .fadeInUp-1").stop().delay(500).animate({
                opacity: 1,
                top: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(reenOwlElementID + " .active .caption .fadeInUp-2").stop().delay(700).animate({
                opacity: 1,
                top: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(reenOwlElementID + " .active .caption .fadeInUp-3").stop().delay(1000).animate({
                opacity: 1,
                top: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
        }

        function reenFadeInLeft() {
            $(reenOwlElementID + " .active .caption .fadeInLeft-1").stop().delay(500).animate({
                opacity: 1,
                left: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(reenOwlElementID + " .active .caption .fadeInLeft-2").stop().delay(700).animate({
                opacity: 1,
                left: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(reenOwlElementID + " .active .caption .fadeInLeft-3").stop().delay(1000).animate({
                opacity: 1,
                left: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
        }

        function reenFadeInRight() {
            $(reenOwlElementID + " .active .caption .fadeInRight-1").stop().delay(500).animate({
                opacity: 1,
                left: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(reenOwlElementID + " .active .caption .fadeInRight-2").stop().delay(700).animate({
                opacity: 1,
                left: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
            $(reenOwlElementID + " .active .caption .fadeInRight-3").stop().delay(1000).animate({
                opacity: 1,
                left: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            });
        }

        function reenHeroCarouselOptions( currentObj ) {
            const reenDefaultCarouselOptions = {
                animateIn: 'fadeIn',
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                nav: true,
                dots: true,
                items: 1,
                loop: true,
                navRewind: true,
                addClassActive: true,
                lazyLoad: true,
                stagePadding: 0,
                rtl: $('body,html').hasClass('rtl'),
                //navText: ["<i class='icon-left-open-mini'></i>", "<i class='icon-right-open-mini'></i>"],
                navText: $('body,html').hasClass('rtl') ? ["<i class='icon-right-open-mini'></i>", "<i class='icon-left-open-mini'></i>" ] : ["<i class='icon-left-open-mini'></i>", "<i class='icon-right-open-mini'></i>"],
            }

            const reenCarouselJson = currentObj.attr('data-owl-carousel');

            const reenCurrentCarouselOptions = reenCarouselJson !== undefined ? JSON.parse(reenCarouselJson) : {};

            return {
                ...reenDefaultCarouselOptions,
                ...reenCurrentCarouselOptions,
                onInitialize: function() {
                    reenFadeIn();
                    reenFadeInDown();
                    reenFadeInUp();
                    reenFadeInLeft();
                    reenFadeInRight();
                },

                onInitialized: function() {
                    reenFadeIn();
                    reenFadeInDown();
                    reenFadeInUp();
                    reenFadeInLeft();
                    reenFadeInRight();
                },

                onResize: function() {
                    reenFadeIn();
                    reenFadeInDown();
                    reenFadeInUp();
                    reenFadeInLeft();
                    reenFadeInRight();
                },

                onResized: function() {
                    reenFadeIn();
                    reenFadeInDown();
                    reenFadeInUp();
                    reenFadeInLeft();
                    reenFadeInRight();
                },

                onRefresh: function() {
                    reenFadeIn();
                    reenFadeInDown();
                    reenFadeInUp();
                    reenFadeInLeft();
                    reenFadeInRight();
                },

                onRefreshed: function() {
                    reenFadeIn();
                    reenFadeInDown();
                    reenFadeInUp();
                    reenFadeInLeft();
                    reenFadeInRight();
                },

                onUpdate: function() {
                    reenFadeIn();
                    reenFadeInDown();
                    reenFadeInUp();
                    reenFadeInLeft();
                    reenFadeInRight();
                },

                onUpdated: function() {
                    reenFadeIn();
                    reenFadeInDown();
                    reenFadeInUp();
                    reenFadeInLeft();
                    reenFadeInRight();
                },

                onDrag: function() {
                    reenDragging = true;
                },

                onTranslate: function() {
                    reenFadeIn();
                    reenFadeInDown();
                    reenFadeInUp();
                    reenFadeInLeft();
                    reenFadeInRight();
                },
                onTranslated: function() {
                    reenFadeIn();
                    reenFadeInDown();
                    reenFadeInUp();
                    reenFadeInLeft();
                    reenFadeInRight();
                },

                onTo: function() {
                    reenFadeIn();
                    reenFadeInDown();
                    reenFadeInUp();
                    reenFadeInLeft();
                    reenFadeInRight();
                },

                onChanged: function() {
                    reenFadeInReset();
                    reenFadeInDownReset();
                    reenFadeInUpReset();
                    reenFadeInLeftReset();
                    reenFadeInRightReset();
                    reenDragging = false;
                }
            }
        }

        $(reenOwlElementID).each(function(index) {
            if( $(this).hasClass('owl-loaded') ) {
                $(this).find('.owl-nav, .owl-dots').unwrap();
            }
            $(this).owlCarousel(reenHeroCarouselOptions($(this)));
        });

        $('#transitionType li a').click(function() {

            $('#transitionType li a').removeClass('active');
            $(this).addClass('active');

            var reenNewValue = $(this).attr('data-animation');

            if( reenNewValue ) {
                $(reenOwlElementID).find('.owl-nav, .owl-dots').unwrap();
                $(reenOwlElementID).trigger('destroy.owl.carousel');
                $(reenOwlElementID).html($(reenOwlElementID).find('.owl-stage-outer').html()).removeClass('owl-loaded');
                $(reenOwlElementID).owlCarousel({ ...reenHeroCarouselOptions($(this)), animateIn: reenNewValue });
                $(reenOwlElementID).find('.owl-nav, .owl-dots').wrapAll("<div class='owl-controls'></div>");
                $(reenOwlElementID).trigger('next.owl.carousel');
                $(reenOwlElementID).trigger('prev.owl.carousel');
            }

            return false;

        });

        if ($(reenOwlElementID).hasClass("owl-one-item")) {
            $(reenOwlElementID + ".owl-one-item").data('owlCarousel').destroy();
        }

        $(reenOwlElementID + ".owl-one-item").owlCarousel({
            singleItem: true,
            navigation: false,
            pagination: false
        });

        var reenCarousel = $('.owl-carousel');

        reenCarousel.each(function(index) {
            const reenDefaultCarouselOptions = {
                autoplay: false,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                nav: true,
                dots: true,
                rewind: true,
                items: 1,
                mouseDrag: false,
                rtl: $('body,html').hasClass('rtl'),
                navText: $('body,html').hasClass('rtl') ? ["<i class='icon-right-open-mini'></i>", "<i class='icon-left-open-mini'></i>" ] : ["<i class='icon-left-open-mini'></i>", "<i class='icon-right-open-mini'></i>"],

            }

            const reenCarouselJson = $(this).attr('data-owl-carousel');
            const reenCurrentCarouselOptions = reenCarouselJson !== undefined ? JSON.parse(reenCarouselJson) : {};
            const reenNewCarouselOptions = {
                ...reenDefaultCarouselOptions,
                ...reenCurrentCarouselOptions
            }
            $(this).owlCarousel(reenNewCarouselOptions);
            $(this).find('.owl-nav, .owl-dots').wrapAll("<div class='owl-controls'></div>");
        });

        $(".slider-next").click(function() {
            owl.trigger('owl.next');
        })

        $(".slider-prev").click(function() {
            owl.trigger('owl.prev');
        })

    });

    /*===================================================================================*/
    /*  ISOTOPE PORTFOLIO
    /*===================================================================================*/

    $(document).ready(function() {

        var $reenContainer = $('.items');

        $reenContainer.imagesLoaded(function() {
            $reenContainer.isotope({
                itemSelector: '.item'
            });
        });

        var reenResizeTimer;

        function resizeFunction() {
            $reenContainer.isotope();
        }

        $(window).resize(function() {
            clearTimeout(reenResizeTimer);
            reenResizeTimer = setTimeout(resizeFunction, 100);
        });

        $('a.panel-toggle.collapsed').click(function() {
            clearTimeout(reenResizeTimer);
            reenResizeTimer = setTimeout(resizeFunction, 100);
        });

        $('.portfolio .filter li a').click(function() {

            $('.portfolio .filter li a').removeClass('active');
            $(this).addClass('active');

            var reenSelector = $(this).attr('data-filter');

            $reenContainer.isotope({
                filter: reenSelector
            });

            return false;

        });

    });


    /*===================================================================================*/
    /*  ISOTOPE BLOG
    /*===================================================================================*/

    $(document).ready(function() {

        var $reenContainer = $('.posts');

        $reenContainer.imagesLoaded(function() {
            $reenContainer.isotope({
                itemSelector: '.post'
            });
        });

        var reenResizeTimer;

        function resizeFunction() {
            $reenContainer.isotope();
        }

        $(window).resize(function() {
            clearTimeout(reenResizeTimer);
            reenResizeTimer = setTimeout(resizeFunction, 100);
        });

        $('.format-filter li a, .format-wrapper a').click(function() {

            var reenSelector = $(this).attr('data-filter');

            $reenContainer.isotope({
                filter: reenSelector
            });

            $('.format-filter li a').removeClass('active');
            $('.format-filter li a[data-filter="' + reenSelector + '"]').addClass('active');

            $('html, body').animate({
                scrollTop: $('.format-filter').offset().top - 130
            }, 600);

            return false;

        });

    });


    /*===================================================================================*/
    /*  TABS
    /*===================================================================================*/

    $(document).ready(function() {

        $('.tabs.tabs-reasons').easytabs({
            cycle: 1500
        });

        $('.tabs.tabs-top, .tabs.tabs-circle-top, .tabs.tabs-2-big-top, .tabs.tabs-side').easytabs({
            animationSpeed: 200,
            updateHash: false
        });

    });


    /*===================================================================================*/
    /*  ACCORDION (FOR ISOTOPE HEIGHT CALCULATION)
    /*===================================================================================*/

    $(document).ready(function() {
        if ($('.panel-group .portfolio').length > 0) {
            $('.panel-group .collapse.show').collapse({
                toggle: true
            });
        }
    });

    /*===================================================================================*/
    /*  Initialize GO TO TOP / SCROLL UP
    /*===================================================================================*/

    $(document).ready(function() {

        if( typeof reen_options !== 'undefined' && reen_options.enableScrollUp ) {
            $.reenScrollUp({
                scrollName: "scrollUp", // Element ID
                scrollDistance: 700, // Distance from top/bottom before showing element (px)
                scrollFrom: "top", // "top" or "bottom"
                scrollSpeed: 1000, // Speed back to top (ms)
                easingType: "easeInOutCubic", // Scroll to top easing (see http://easings.net/)
                animation: "fade", // Fade, slide, none
                animationInSpeed: 200, // Animation in speed (ms)
                animationOutSpeed: 200, // Animation out speed (ms)
                scrollText: "<i class='icon-up-open-mini'></i>", // Text for element, can contain HTML
                scrollTitle: " ", // Set a custom <a> title if required. Defaults to scrollText
                scrollImg: 0, // Set true to use image
                activeOverlay: 0, // Set CSS color to display scrollUp active point, e.g "#00FFFF"
                zIndex: 1001 // Z-Index for the overlay
            });
        }

    });


    /*===================================================================================*/
    /*  ANIMATED / SMOOTH SCROLL TO ANCHOR
    /*===================================================================================*/

    $(document).ready(function() {

        $("a.scroll-to").click(function() {

            if ($(window).width() > 1024) {
                var reenNavbarHeight = 45;
            } else {
                var reenNavbarHeight = 0;
            }

            if ($(this).attr('data-anchor-offset') !== undefined) {
                var reenAnchorOffset = $(this).attr('data-anchor-offset');
            } else {
                var reenAnchorOffset = 0;
            }

            $("html, body").animate({
                scrollTop: $($(this).attr("href")).offset().top - reenNavbarHeight - reenAnchorOffset + "px"
            }, {
                duration: 1000,
                easing: "easeInOutCubic"
            });
            return false;
        });

        // Close/collapse mobile navbar accordion if anchor link inside is pressed

        $(".navbar-nav").find(".scroll-to").on("click", function(event) {
            event.stopPropagation();
            event.stopImmediatePropagation();
            $(".navbar-collapse.show").collapse("hide");
        });

    });


    /*===================================================================================*/
    /*  SCROLL SPY
    /*===================================================================================*/

    $(document).ready(function() {
        $('body').scrollspy({
            target: '.navbar-collapse',
            offset: 50
        })
    });


    /*===================================================================================*/
    /*  IMAGE HOVER
    /*===================================================================================*/

    $(document).ready(function() {
        $('.icon-overlay a').prepend('<span class="icn-more"></span>');
    });


    /*===================================================================================*/
    /*  MODALS
    /*===================================================================================*/

    $('.modal').on('hidden.bs.modal', function() {
        $('.video-container iframe').attr("src", $(".video-container iframe").attr("src"));
    });


    /*===================================================================================*/
    /*  DATA REL
    /*===================================================================================*/

    $(document).ready(function() {
        $('a[data-rel]').each(function() {
            $(this).attr('rel', $(this).data('rel'));
        });
    });


    /*===================================================================================*/
    /*  TOOLTIP
    /*===================================================================================*/

    $(document).ready(function() {
        if ($("[data-rel=tooltip]").length) {
            $("[data-rel=tooltip]").tooltip();
        }
    });


    /*===================================================================================*/
    /*  CONVERTING iOS SAFARI VIEWPORT UNITS (BUGGY) INTO PIXELS
    /*===================================================================================*/

    $(document).ready(function () {
        window.viewportUnitsBuggyfill.init();
    });


    /*===================================================================================*/
    /*  Initialize Tooltip
    /*===================================================================================*/
    if ($("[rel=tooltip]").length) {
        $("[rel=tooltip]").tooltip();
    }

    /*===================================================================================*/
    /*  Initialize Owl carousel
    /*===================================================================================*/
    $('[data-ride="owl-carousel"]').each(function() {
        var $reenOwlElement = $(this),
            reenOwlCarouselParams = $reenOwlElement.data('owlparams');
        $reenOwlElement.owlCarousel(reenOwlCarouselParams);
    });

})(jQuery, window, document);