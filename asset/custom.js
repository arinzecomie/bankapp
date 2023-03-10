/*------------------------------------------------------------------
[Master Custom JS] - [Table of contents]
1. Sidebar functionality
2. Megamenu functionality
3. Search functionality
4. SidebarRight functionality
5. Fullscreen functionality
6. Scrollbar sidebar
7. Popover, tooltip
8. Boostrap menu stay on click
9. Calendar
10. webticker
11. select2inputs
12. INPUT FOCUS EFFECTS
13. MAINTENANCE CLOCK
14. DataTable
15. SweetAlert
16. Scroll to top
17. Developer Mode Stuff
18. Range Slider
19. Image loader
20. OWL Carousel
------------------------------------------------------------------- */
jQuery(document).ready(function($){
    "use strict";
    // jQuery('[data-toggle="tooltip"]').tooltip(); 
    // SET CUSTOM background-image 
    jQuery('.data_background').each(function() {
        var bgurl = jQuery(this).attr('data-background');
        jQuery(this).css('background-image', 'url(' + bgurl + ')');
    });
    /*---------------------------------------------*/
    /*--- 1. Sidebar functionality ---*/
    /*---------------------------------------------*/
    /* Sidebar variables */
    var CURRENT_URL = window.location.href.split("#")[0].split("?")[0],
    $BODY = $("body"),
    $MENU_TOGGLE = $("#menu_toggle"),
    $SIDEBAR_MENU = $("#sidebar-menu"),
    $SIDEBAR_FOOTER = $(".sidebar-footer"),
    $LEFT_COL = $(".left_col"),
    $RIGHT_COL = $(".right_col"),
    $NAV_MENU = $(".nav_menu"),
    $FOOTER = $("footer"),
    randNum = function() {
        return Math.floor(21 * Math.random()) + 20
    };
    /* Sidebar function */
    function init_sidebar() {
        var a = function() {
            $RIGHT_COL.css("min-height", $(window).height());
            var a = $BODY.outerHeight(),
                b = $BODY.hasClass("footer_fixed") ? -10 : $FOOTER.height(),
                c = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
                d = a < c ? c : a;
            d -= $NAV_MENU.height() + b, $RIGHT_COL.css("min-height", d)
        };
        $SIDEBAR_MENU.find("a").on("click", function(b) {
            var c = $(this).parent();
            c.is(".active") ? (c.removeClass("active active-sm"), $("ul:first", c).slideUp(function() {
                a()
            })) : (c.parent().is(".child_menu") ? $BODY.is(".nav-sm") && ($SIDEBAR_MENU.find("li").removeClass("active active-sm"), $SIDEBAR_MENU.find("li ul").slideUp()) : ($SIDEBAR_MENU.find("li").removeClass("active active-sm"), $SIDEBAR_MENU.find("li ul").slideUp()), c.addClass("active"), $("ul:first", c).slideDown(function() {
                a()
            }))
        }), $MENU_TOGGLE.on("click", function() {
            $BODY.hasClass("nav-md") ? ($SIDEBAR_MENU.find("li.active ul").hide(), $SIDEBAR_MENU.find("li.active").addClass("active-sm").removeClass("active")) : ($SIDEBAR_MENU.find("li.active-sm ul").show(), $SIDEBAR_MENU.find("li.active-sm").addClass("active").removeClass("active-sm")), $BODY.toggleClass("nav-md nav-sm"), a()
        }), $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent("li").addClass("current-page"), $SIDEBAR_MENU.find("a").filter(function() {
            return this.href === CURRENT_URL
        }).parent("li").addClass("current-page").parents("ul").slideDown(function() {
            a()
        }).parent().addClass("active"), a(), $.fn.mCustomScrollbar && $(".menu_fixed").mCustomScrollbar({
            autoHideScrollbar: !0,
            theme: "minimal",
            mouseWheel: {
                preventDefault: !0
            }
        })
    }
    /* Sidebar toggle icon submenu */
    $(".nav-md .container.body #sidebar-menu ul li , .top_nav .navbar-left li a").on( "click", function() {
        $(this).find('span.fa').toggleClass('fa-angle-down fa-angle-up');
    });
    init_sidebar();
    /*---------------------------------------------*/
    /*--- 2. Megamenu functionality ---*/
    /*---------------------------------------------*/
    //Menu Aim
    
    $.fn.menuAim = function(opts) {
        // Initialize menu-aim for all elements in jQuery collection
        this.each(function() {
            init.call(this, opts);
        });
        return this;
    };
    function init(opts) {
        var $menu = $(this),
            activeRow = null,
            mouseLocs = [],
            lastDelayLoc = null,
            timeoutId = null,
            options = $.extend({
                rowSelector: "> li",
                submenuSelector: "*",
                submenuDirection: "right",
                tolerance: 75,  // bigger = more forgivey when entering submenu
                enter: $.noop,
                exit: $.noop,
                activate: $.noop,
                deactivate: $.noop,
                exitMenu: $.noop
            }, opts);
        var MOUSE_LOCS_TRACKED = 3,  // number of past mouse locations to track
            DELAY = 300;  // ms delay when user appears to be entering submenu
        /**
         * Keep track of the last few locations of the mouse.
         */
        var mousemoveDocument = function(e) {
                mouseLocs.push({x: e.pageX, y: e.pageY});
                if (mouseLocs.length > MOUSE_LOCS_TRACKED) {
                    mouseLocs.shift();
                }
            };
        /**
         * Cancel possible row activations when leaving the menu entirely
         */
        var mouseleaveMenu = function() {
                if (timeoutId) {
                    clearTimeout(timeoutId);
                }
                // If exitMenu is supplied and returns true, deactivate the
                // currently active row on menu exit.
                if (options.exitMenu(this)) {
                    if (activeRow) {
                        options.deactivate(activeRow);
                    }
                    activeRow = null;
                }
            };
        /**
         * Trigger a possible row activation whenever entering a new row.
         */
        var mouseenterRow = function() {
                if (timeoutId) {
                    // Cancel any previous activation delays
                    clearTimeout(timeoutId);
                }
                options.enter(this);
                possiblyActivate(this);
            },
            mouseleaveRow = function() {
                options.exit(this);
            };
        /*
         * Immediately activate a row if the user clicks on it.
         */
        var clickRow = function() {
                activate(this);
            };
        /**
         * Activate a menu row.
         */
        var activate = function(row) {
                if (row === activeRow) {
                    return;
                }
                if (activeRow) {
                    options.deactivate(activeRow);
                }
                options.activate(row);
                activeRow = row;
            };
        var possiblyActivate = function(row) {
                var delay = activationDelay();
                if (delay) {
                    timeoutId = setTimeout(function() {
                        possiblyActivate(row);
                    }, delay);
                } else {
                    activate(row);
                }
            };
        var activationDelay = function() {
                if (!activeRow || !$(activeRow).is(options.submenuSelector)) {
                    return 0;
                }
                var offset = $menu.offset(),
                    upperLeft = {
                        x: offset.left,
                        y: offset.top - options.tolerance
                    },
                    upperRight = {
                        x: offset.left + $menu.outerWidth(),
                        y: upperLeft.y
                    },
                    lowerLeft = {
                        x: offset.left,
                        y: offset.top + $menu.outerHeight() + options.tolerance
                    },
                    lowerRight = {
                        x: offset.left + $menu.outerWidth(),
                        y: lowerLeft.y
                    },
                    loc = mouseLocs[mouseLocs.length - 1],
                    prevLoc = mouseLocs[0];
                if (!loc) {
                    return 0;
                }
                if (!prevLoc) {
                    prevLoc = loc;
                }
                if (prevLoc.x < offset.left || prevLoc.x > lowerRight.x ||
                    prevLoc.y < offset.top || prevLoc.y > lowerRight.y) {
                    return 0;
                }
                if (lastDelayLoc &&
                        loc.x === lastDelayLoc.x && loc.y === lastDelayLoc.y) {
                    return 0;
                }
                function slope(a, b) {
                    return (b.y - a.y) / (b.x - a.x);
                };
                var decreasingCorner = upperRight,
                    increasingCorner = lowerRight;
                if (options.submenuDirection === "left") {
                    decreasingCorner = lowerLeft;
                    increasingCorner = upperLeft;
                } else if (options.submenuDirection === "below") {
                    decreasingCorner = lowerRight;
                    increasingCorner = lowerLeft;
                } else if (options.submenuDirection === "above") {
                    decreasingCorner = upperLeft;
                    increasingCorner = upperRight;
                }
                var decreasingSlope = slope(loc, decreasingCorner),
                    increasingSlope = slope(loc, increasingCorner),
                    prevDecreasingSlope = slope(prevLoc, decreasingCorner),
                    prevIncreasingSlope = slope(prevLoc, increasingCorner);
                if (decreasingSlope < prevDecreasingSlope &&
                        increasingSlope > prevIncreasingSlope) {
                    lastDelayLoc = loc;
                    return DELAY;
                }
                lastDelayLoc = null;
                return 0;
            };
        /**
         * Hook up initial menu events
         */
        $menu
            .mouseleave(mouseleaveMenu)
            .find(options.rowSelector)
                .mouseenter(mouseenterRow)
                .mouseleave(mouseleaveRow)
                .click(clickRow);
            $(document).mousemove(mousemoveDocument);
    };
    //Menu Aim
    //Megamenu main
    //open/close mega-navigation
    $('.megamenu-dropdown-trigger').on('click', function(event){
        event.preventDefault();
        toggleNav();
    });
    $(window).on('mouseup',function(e) {
        var container = $(".megamenu-dropdown-trigger, .megamenu-dropdown");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $('.megamenu-dropdown').removeClass('dropdown-is-active');
            $('.megamenu-dropdown-trigger').removeClass('dropdown-is-active');
        }
    });
    //close meganavigation
    $('.megamenu-dropdown .megamenu-close').on('click', function(event){
        event.preventDefault();
        toggleNav();
    });
    //on mobile - open submenu
    $('.has-children').children('a').on('click', function(event){
        //prevent default clicking on direct children of .has-children 
        event.preventDefault();
        var selected = $(this);
        selected.next('ul').removeClass('is-hidden').end().parent('.has-children').parent('ul').addClass('move-out');
    });
    //on desktop - differentiate between a user trying to hover over a dropdown item vs trying to navigate into a submenu's contents
    var submenuDirection = ( !$('.megamenu-dropdown-wrapper').hasClass('open-to-left') ) ? 'right' : 'left';
    $('.megamenu-dropdown-content').menuAim({
        activate: function(row) {
            $(row).children().addClass('is-active').removeClass('fade-out');
            if( $('.megamenu-dropdown-content .fade-in').length === 0 ) $(row).children('ul').addClass('fade-in');
        },
        deactivate: function(row) {
            $(row).children().removeClass('is-active');
            if( $('li.has-children:hover').length === 0 || $('li.has-children:hover').is($(row)) ) {
                $('.megamenu-dropdown-content').find('.fade-in').removeClass('fade-in');
                $(row).children('ul').addClass('fade-out')
            }
        },
        exitMenu: function() {
            $('.megamenu-dropdown-content').find('.is-active').removeClass('is-active');
            return true;
        },
        submenuDirection: submenuDirection,
    });
    //submenu items - go back link
    $('.go-back').on('click', function(){
        var selected = $(this),
            visibleNav = $(this).parent('ul').parent('.has-children').parent('ul');
        selected.parent('ul').addClass('is-hidden').parent('.has-children').parent('ul').removeClass('move-out');
    }); 
    function toggleNav(){
        var navIsVisible = ( !$('.megamenu-dropdown').hasClass('dropdown-is-active') ) ? true : false;
        $('.megamenu-dropdown').toggleClass('dropdown-is-active', navIsVisible);
        $('.megamenu-dropdown-trigger').toggleClass('dropdown-is-active', navIsVisible);
        if( !navIsVisible ) {
            $('.megamenu-dropdown').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(){
                $('.has-children ul').addClass('is-hidden');
                $('.move-out').removeClass('move-out');
                $('.is-active').removeClass('is-active');
            }); 
        }
    }
    //IE9 placeholder fallback
    //credits http://www.hagenburger.net/BLOG/HTML5-Input-Placeholder-Fix-With-jQuery.html
    if(!Modernizr.input.placeholder){
        $('[placeholder]').focus(function() {
            var input = $(this);
            if (input.val() === input.attr('placeholder')) {
                input.val('');
            }
        }).blur(function() {
            var input = $(this);
            if (input.val() === '' || input.val() === input.attr('placeholder')) {
                input.val(input.attr('placeholder'));
            }
        }).blur();
        $('[placeholder]').parents('form').submit(function() {
            $(this).find('[placeholder]').each(function() {
                var input = $(this);
                if (input.val() === input.attr('placeholder')) {
                    input.val('');
                }
            })
        });
    }
    //Megamenu main
    /*---------------------------------------------*/
    /*--- 3. Search functionality ---*/
    /*---------------------------------------------*/
    if ($('.search').length) {
        var mainContainer = document.querySelector('.search-wrap'),
            openCtrl = document.getElementById('btn-search'),
            closeCtrl = document.getElementById('btn-search-close'),
            searchContainer = document.querySelector('.search'),
            inputSearch = searchContainer.querySelector('.search__input');
        function initSearch() {
            initEventsSearch(); 
        }
        function initEventsSearch() {
            openCtrl.addEventListener('click', openSearch);
            closeCtrl.addEventListener('click', closeSearch);
            document.addEventListener('keyup', function(ev) {
                // escape key.
                if( ev.keyCode === 27 ) {
                    closeSearch();
                }
            });
        }
        function openSearch() {
            mainContainer.classList.add('main-wrap--move');
            searchContainer.classList.add('search--open');
            setTimeout(function() {
                inputSearch.focus();
            }, 600);
        }
        function closeSearch() {
            mainContainer.classList.remove('main-wrap--move');
            searchContainer.classList.remove('search--open');
            inputSearch.blur();
            inputSearch.value = '';
        }
        initSearch();
    }
    /*---------------------------------------------*/
    /*--- 4. SidebarRight functionality ---*/
    /*---------------------------------------------*/
    var SidebarMenuEffects = (function() {
    function hasParentClass(e, classname) {
        if (e === document) return !1;
        if (classie.has(e, classname)) {
            return !0
        }
        return e.parentNode && hasParentClass(e.parentNode, classname)
    }
    function mobilecheck() {
        var check = !1;
        (function(a) {
            if (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = !0
        })(navigator.userAgent || navigator.vendor || window.opera);
        return check
    }
    function initSidebarRight() {
        var container = document.getElementById('st-container'),
            buttons = Array.prototype.slice.call(document.querySelectorAll('#st-trigger-effects > .trigger-sidebar')),
            eventtype = mobilecheck() ? 'touchstart' : 'click',
            resetMenu = function() {
                classie.remove(container, 'st-menu-open')
            },
            bodyClickFn = function(evt) {
                if (!hasParentClass(evt.target, 'st-menu')) {
                    resetMenu();
                    document.removeEventListener(eventtype, bodyClickFn)
                }
            };
        buttons.forEach(function(el, i) {
            var effect = el.getAttribute('data-effect');
            el.addEventListener(eventtype, function(ev) {
                ev.stopPropagation();
                ev.preventDefault();
                container.className = 'st-container';
                classie.add(container, effect);
                setTimeout(function() {
                    classie.add(container, 'st-menu-open')
                }, 25);
                document.addEventListener(eventtype, bodyClickFn)
            })
        })
    }
    initSidebarRight()
    })();
    $('.close-sidebar').on('click', function() {
        $('.st-container').removeClass('st-menu-open');
    })
    /*---------------------------------------------*/
    /*--- 5. Fullscreen functionality ---*/
    /*---------------------------------------------*/
    if ($('#btnFullscreen').length) {
        function toggleFullscreen(elem) {
          elem = elem || document.documentElement;
          if (!document.fullscreenElement && !document.mozFullScreenElement &&
            !document.webkitFullscreenElement && !document.msFullscreenElement) {
            if (elem.requestFullscreen) {
              elem.requestFullscreen();
            } else if (elem.msRequestFullscreen) {
              elem.msRequestFullscreen();
            } else if (elem.mozRequestFullScreen) {
              elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {
              elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }
          } else {
            if (document.exitFullscreen) {
              document.exitFullscreen();
            } else if (document.msExitFullscreen) {
              document.msExitFullscreen();
            } else if (document.mozCancelFullScreen) {
              document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
              document.webkitExitFullscreen();
            }
          }
        }
        document.getElementById('btnFullscreen').addEventListener('click', function() {
          toggleFullscreen();
        });
    }
    
    /*---------------------------------------------*/
    /*--- 6. Scrollbar sidebar ---*/
    /*---------------------------------------------*/
    // Disable body scroll when hover the sidebar navigation
    
    $(".scroll-view").on({
        mouseenter: function () {
            $("body").css("overflow","hidden");
        },
        mouseleave: function () {
             $("body").css("overflow","auto");
        }
    });
    $('.left_col').scrollbar();

    var FF = !(window.mozInnerScreenX == null);

    if(FF) {
        if(navigator.platform.indexOf('Mac')>=0){
            $('body .left_col').css("overflow","scroll");
        }
    }
    /*---------------------------------------------*/
    /*--- 7. Popover, tooltip ---*/
    /*---------------------------------------------*/
    $('[data-toggle="popover"]').popover(); 
    $('[data-toggle="tooltip"]').tooltip(); 
    /*---------------------------------------------*/
    /*--- 8. Boostrap menu stay on click ---*/
    /*---------------------------------------------*/
    $('.dropdown-menu-1 .dropdown-menu').on({
        "click":function(e){
          e.stopPropagation();
        }
    });
    /*---------------------------------------------*/
    /*--- 9. Calendar ---*/
    /*---------------------------------------------*/
    if ($('#calendar').length) {
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
          },
          defaultDate: '2018-02-12',
          buttonIcons: false, // show the prev/next text
          weekNumbers: true,
          navLinks: true, // can click day/week names to navigate views
          editable: true,
          eventLimit: true, // allow "more" link when too many events
          events: [
            {
              title: 'All Day Event',
              start: '2018-02-01',
              description: 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.'
            },
            {
              title: 'Long Event',
              start: '2018-02-07',
              end: '2018-02-10'
            },
            {
              id: 999,
              title: 'Repeating Event',
              start: '2018-02-09T16:00:00'
            },
            {
              id: 999,
              title: 'Repeating Event',
              start: '2018-02-16T16:00:00'
            },
            {
              title: 'Conference',
              start: '2018-02-11',
              end: '2018-02-13'
            },
            {
              title: 'Meeting',
              start: '2018-02-12T10:30:00',
              end: '2018-02-12T12:30:00'
            },
            {
              title: 'Lunch',
              start: '2018-02-12T12:00:00'
            },
            {
              title: 'Meeting',
              start: '2018-02-12T14:30:00'
            },
            {
              title: 'Happy Hour',
              start: '2018-02-12T17:30:00'
            },
            {
              title: 'Dinner',
              start: '2018-02-12T20:00:00'
            },
            {
              title: 'Birthday Party',
              start: '2018-02-13T07:00:00'
            },
            {
              title: 'Click for Google',
              url: 'http://google.com/',
              start: '2018-02-28'
            }
          ],
            eventRender: function(event, element) {
            element.qtip({
                content: event.description
            });
            }
        });
    }
    /*---------------------------------------------*/
    /*--- 10. webticker ---*/
    /*---------------------------------------------*/ 
    if ($('#webticker-dark-icons').length) {   
        $("#webticker-dark-icons").webTicker({
            height:'auto', 
            duplicate:true, 
            startEmpty:false, 
            rssfrequency:5
        });
    }
    if ($('#webticker-dark1').length) {   
        $("#webticker-dark1").webTicker({
            height:'auto', 
            duplicate:true, 
            startEmpty:false, 
            rssfrequency:5
        });
    }
    if ($('#webticker-dark2').length) {   
        $("#webticker-dark2").webTicker({
            height:'auto', 
            duplicate:true,
            startEmpty:false, 
            rssfrequency:5,
            direction: 'right'
        });
    }
    if ($('#webticker-dark3').length) {   
        $("#webticker-dark3").webTicker({
            height:'auto', 
            startEmpty:false, 
            rssfrequency:5
        });
    }
    if ($('#webticker-white1').length) {   
        $("#webticker-white1").webTicker({
            height:'auto', 
            duplicate:true,
            startEmpty:false, 
            rssfrequency:5,
            direction: 'right'
        });
    }
    if ($('#webticker-white-icons').length) {   
        $("#webticker-white-icons").webTicker({
            height:'auto', 
            duplicate:true,
            startEmpty:false, 
            rssfrequency:5,
        });
    }
    if ($('#webticker-white2').length) {   
        $("#webticker-white2").webTicker({
            height:'auto', 
            duplicate:true,
            startEmpty:false, 
            rssfrequency:5,
        });
    }
    if ($('#webticker-white3').length) {   
        $("#webticker-white3").webTicker({
            height:'auto', 
            duplicate:true,
            startEmpty:false, 
            rssfrequency:5,
            direction: 'right'
        });
    }
    /*---------------------------------------------*/
    /*--- 10. Depth Chart page --- sellorders ---*/
    /*---------------------------------------------*/ 
    if ($('.table-sellorders').length) {
        setRandomClass();
        setInterval(function () {
            setRandomClass();
        },1000);
        function setRandomClass() {
            var tbody = $(".table-sellorders table tbody");
            var items = tbody.find("tr");
            var number = items.length;
            var random1 = Math.floor((Math.random() * number));
            var random2 = Math.floor((Math.random() * number));
            items.removeClass("special");
            items.eq(random1).addClass("special");
            items.eq(random2).addClass("special");
        }
    }
    if ($('.table-buyorders').length) {
        setRandomClass1();
        setInterval(function () {
            setRandomClass1();
        },1000);
        function setRandomClass1() {
            var tbody = $(".table-buyorders table tbody");
            var items = tbody.find("tr");
            var number = items.length;
            var random1 = Math.floor((Math.random() * number));
            var random2 = Math.floor((Math.random() * number));
            items.removeClass("special");
            items.eq(random1).addClass("special");
            items.eq(random2).addClass("special");
        }
    }
    /*---------------------------------------------*/
    /*--- 11. select2inputs ---*/
    /*---------------------------------------------*/ 
    if ($('.coins-exchange').length) {
       $('.coins-exchange').select2();
    }
    if ($('.money-exchange').length) {
       $('.money-exchange').select2();
    }
    /*---------------------------------------------*/
    /*--- 12. INPUT FOCUS EFFECTS ---*/
    /*---------------------------------------------*/ 
    (function() {
      // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
      if (!String.prototype.trim) {
        (function() {
          // Make sure we trim BOM and NBSP
          var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
          String.prototype.trim = function() {
            return this.replace(rtrim, '');
          };
        })();
      }
      [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
        // in case the input is already filled..
        if( inputEl.value.trim() !== '' ) {
          classie.add( inputEl.parentNode, 'input--filled' );
        }
        // events:
        inputEl.addEventListener( 'focus', onInputFocus );
        inputEl.addEventListener( 'blur', onInputBlur );
      } );
      function onInputFocus( ev ) {
        classie.add( ev.target.parentNode, 'input--filled' );
      }
      function onInputBlur( ev ) {
        if( ev.target.value.trim() === '' ) {
          classie.remove( ev.target.parentNode, 'input--filled' );
        }
      }
    })();
    // 13. MAINTENANCE CLOCK
    function crypticCountdown() {
        var clock;
        var clockDate = jQuery(".countdownv2").attr('data-count-down');
        // Grab the current date
        var currentDate = new Date();
        // Grab the date inserted by user
        var inserted_date = new Date(clockDate);
        // Calculate the difference in seconds between the future and current date
        var diff = inserted_date.getTime() / 1000 - currentDate.getTime() / 1000;
        // Instantiate a coutdown FlipClock
        clock = jQuery(".countdownv2").FlipClock(diff, {
            clockFace: "DailyCounter",
            countdown: true
        });
    }
    if ($('.countdownv2').length) {   
        crypticCountdown();
    }
    /*---------------------------------------------*/
    /*--- 14. Datatables init ---*/
    /*---------------------------------------------*/
    if ($('#dataTable_crypto').length) {   
        jQuery('#dataTable_crypto').DataTable( {
            "pageLength": 20
        } );
    }
    if ($('#user_table').length) {   
        jQuery('#user_table').DataTable( {
            "pageLength": 5,
            "pagingType": "full_numbers"
        });
    }
    if ($('#data-tables-markets').length) {
        jQuery('#data-tables-markets').DataTable();
    }
    if ($('#trade-history').length) { 
        $('#trade-history').DataTable();
    }
    function cryptic_timeline(){
        var timelineBlocks=$('.cd-timeline-block'),
        offset=0.8;
        hideBlocks(timelineBlocks, offset);
        $(window).on('scroll', function(){
            (!window.requestAnimationFrame)
            ? setTimeout(function(){ showBlocks(timelineBlocks, offset); }, 100)
            : window.requestAnimationFrame(function(){ showBlocks(timelineBlocks, offset); });
        });
        function hideBlocks(blocks, offset){
            blocks.each(function(){
                ($(this).offset().top > $(window).scrollTop()+$(window).height()*offset)&&$(this).find('.cd-timeline-img, .cd-timeline-content, .cd-date, .timeline_item_title, .timeline_item_content').addClass('is-hidden');
            });
        }
        function showBlocks(blocks, offset){
            blocks.each(function(){
                ($(this).offset().top <=$(window).scrollTop()+$(window).height()*offset&&$(this).find('.cd-timeline-img').hasClass('is-hidden'))&&$(this).find('.cd-timeline-img, .cd-timeline-content, .cd-date, .timeline_item_title, .timeline_item_content').removeClass('is-hidden').addClass('bounce-in');
            });
        }
    }
    if ($('.cd-timeline-block').length) {   
        cryptic_timeline();
    }
    /*---------------------------------------------*/
    /*--- 15. SweetAlert ---*/
    /*---------------------------------------------*/
    $(".sweetalert1").on('click',function() {
        swal("Hello world!");
    });
    $(".sweetalert2").on('click',function() {
        swal("Here's the title!", "...and here's the text!");
    });
    $(".sweetalert3").on('click',function() {
        swal("Good job!", "You clicked the button!", "success");
    });
    $(".sweetalert41").on('click',function() {
        swal({
          title: "Good job!",
          text: "You clicked the button!",
          icon: "success",
        });
    });
    $(".sweetalert42").on('click',function() {
        swal({
          title: "Good job!",
          text: "You clicked the button!",
          icon: "success",
          button: "Aww yiss!",
        });
    });
    $(".sweetalert5").on('click',function() {
        swal("Click on either the button or outside the modal.")
        .then((value) => {
          swal(`The returned value is: ${value}`);
        });
    });
    $(".sweetalert6").on('click',function() {
        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Poof! Your imaginary file has been deleted!", {
              icon: "success",
            });
          } else {
            swal("Your imaginary file is safe!");
          }
        });
    });
    $(".sweetalert7").on('click',function() {
        swal("A wild Pikachu appeared! What do you want to do?", {
          buttons: {
            cancel: "Run away!",
            catch: {
              text: "Throw Pok????ball!",
              value: "catch",
            },
            defeat: true,
          },
        })
        .then((value) => {
          switch (value) {
         
            case "defeat":
              swal("Pikachu fainted! You gained 500 XP!");
              break;
         
            case "catch":
              swal("Gotcha!", "Pikachu was caught!", "success");
              break;
         
            default:
              swal("Got away safely!");
          }
        });
    });
    $(".sweetalert8").on('click',function() {
        swal({
          text: 'Search for a movie. e.g. "La La Land".',
          content: "input",
          button: {
            text: "Search!",
            closeModal: false,
          },
        })
        .then(name => {
          if (!name) throw null;
         
          return fetch(`https://itunes.apple.com/search?term=${name}&entity=movie`);
        })
        .then(results => {
          return results.json();
        })
        .then(json => {
          const movie = json.results[0];
         
          if (!movie) {
            return swal("No movie was found!");
          }
         
          const name = movie.trackName;
          const imageURL = movie.artworkUrl100;
         
          swal({
            title: "Top result:",
            text: name,
            icon: imageURL,
          });
        })
        .catch(err => {
          if (err) {
            swal("Oh noes!", "The AJAX request failed!", "error");
          } else {
            swal.stopLoading();
            swal.close();
          }
        });
    });
    $(".sweetalert9").on('click',function() {
        swal("Write something here:", {
          content: "input",
        })
        .then((value) => {
          swal(`You typed: ${value}`);
        });
    }); 
    $(".sweetalert31").on('click',function() {
        swal("Done!", "Your informations was added!", "success");
    });
    /*---------------------------------------------*/
    /*--- 16. Scroll to top ---*/
    /*---------------------------------------------*/
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
          $('.scrollToTop').fadeIn();
        } else {
          $('.scrollToTop').fadeOut();
        }
    });
    $('.scrollToTop').on('click',function() {
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });
    /*---------------------------------------------*/
    /*--- 17. Developer Mode Stuff ---*/
    /*---------------------------------------------*/
    if (jQuery("body").hasClass("developer-mode")) {
        console.log('Developer Mode: ON');
        // Current Site Url
        var thispage_outside = jQuery(location).attr('href');
        thispage_outside  = thispage_outside .substr(0, thispage_outside .lastIndexOf("/"));
        // NIGHT MODE SWITCHER
        jQuery( ".button-night-mode .btn-toggle" ).on( "click", function() {
            var nightModeBtn = jQuery( this );
            if (nightModeBtn.hasClass('active')) {
            	jQuery('body').removeClass('night-mood-background');
            	console.log('Night Mode: OFF');
            }else{
            	jQuery('body').addClass('night-mood-background');
                jQuery("head").append('<link href="'+thispage_outside+'/assets/css/night-mode.css" rel="stylesheet">');
            	console.log('Night Mode: ON');
            }
        });
        // MENU SWICHER
        jQuery( ".button-menu-right .btn-toggle" ).on( "click", function() {
            var menuRightBtn = jQuery( this );
            if (menuRightBtn.hasClass('active')) {
                jQuery('body').removeClass('move_menu_right');
                console.log('Menu Right: OFF');
            }else{
                jQuery('body').addClass('move_menu_right');
                console.log('Menu Right: ON');
            }
        });
        // START AJAX get file content
        jQuery.ajax({
            url: thispage_outside+"/assets/plugins/mt-skin-switcher/skin-switcher.html", 
            context: document.body,
            success: function(response) {
                // Add HTML
                jQuery("body").append(response);
                // console.log('Success'+response);
                // Current Site Url
                var thispage = jQuery(location).attr('href');
                thispage  = thispage .substr(0, thispage .lastIndexOf("/"));
                // Get website url
                // console.log(thispage);
                jQuery("head").append('<link href="'+thispage+'/assets/plugins/mt-skin-switcher/skin-switcher.css" rel="stylesheet">');
                // jQuery("body").append('<script src="https://modeltheme.com/html-templates/cryptic/assets/plugins/mt-skin-switcher/skin-switcher.js"></script>');
                // Current Skin url
                var currectLinkHref = jQuery('#ui-current-skin').attr('href');
                currectLinkHref  = currectLinkHref .substr(0, currectLinkHref .lastIndexOf("/"));
                // SKIN SWITCHER
                jQuery( ".colors_buttons > span" ).on( "click", function() {
                    var newSkinName = jQuery( this ).attr('data-skin');
                    var newSkinCssHref = currectLinkHref+'/'+newSkinName;
                    
                    // SET THE NEW STYLE
                    jQuery('#ui-current-skin').attr("href", newSkinCssHref);
                    jQuery(".colors_buttons > span").removeClass('currentStyle');
                    jQuery( this ).addClass('currentStyle');
                    // LOG
                    // console.log( 'New Skin Applied: '+jQuery( this ).attr('data-skin') );
                });
                // SIDEBAR OPENER
                jQuery(".panel_button .toggle_sidebar").click(function(){
                    jQuery("div#panel").animate({
                        right: "0px"
                    }, "fast");
                    jQuery(".panel_button").animate({
                        right: "300px"
                    }, "fast");
                    jQuery(".panel_button").toggle();
                }); 
                jQuery(".hide_button.hide_button").click(function(){
                    jQuery("#panel").animate({
                        right: "-300px"
                    }, "fast");
                    jQuery(".panel_button").animate({
                        right: "0px"
                    }, "fast");
                    jQuery(".panel_button").toggle();
                });
                if (jQuery("body").hasClass("developer-mode move_menu_right")) {
                    // SIDEBAR OPENER-LEFT
                    jQuery(".move_menu_right #demopanel .panel_button .toggle_sidebar").click(function(){
                        console.log("pannel but");
                        jQuery("#demopanel div#panel").animate({
                            left: "0px"
                        }, "fast");
                        jQuery("#demopanel .panel_button").animate({
                            left: "300px"
                        }, "fast");
                        jQuery("#demopanel .panel_button").toggle();
                    }); 
                    jQuery(".move_menu_right #demopanel .hide_button.hide_button").click(function(){
                         console.log("pannel but123234");
                        jQuery(".move_menu_right #demopanel #panel").animate({
                            left: "-300px"
                        }, "fast");
                        jQuery(".move_menu_right #demopanel .panel_button").animate({
                            left: "0px"
                        }, "fast");
                        jQuery(".move_menu_right #demopanel .panel_button").toggle();
                    });
                }
                // ==============================================================================
                // GOOGLE ANALYTICS
                // ==============================================================================
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
                ga('create', 'UA-116847160-1', 'auto');
                ga('send', 'pageview');


                // ==============================================================================
                // SKIN SWITCHER --> BACKGROUND CHANGER
                // ==============================================================================
                jQuery('.data_background').each(function() {
                    var bgurl = jQuery(this).attr('data-background');
                    jQuery(this).css('background-image', 'url(' + bgurl + ')');
                });

                jQuery( ".nav_imgs_buttons > .data_background" ).on( "click", function() {
                    // SET THE NEW STYLE
                    jQuery('.nav_imgs_buttons > .data_background').removeClass('currentStyle');
                    jQuery(this).addClass('currentStyle');
                    // ADD BODY CLASS
                    var classesToRemove = [
                                    "menu-background-img01", 
                                    "menu-background-img02", 
                                    "menu-background-img03",
                                    "menu-background-img04",
                                    "menu-background-img05",
                                    "menu-background-img06",
                                    "menu-background-img07",
                                    ];
                    var newBgImg = jQuery(this).attr('data-bg-class');
                    jQuery('body').removeClass(classesToRemove.join(' '));
                    jQuery('body').addClass(newBgImg);
                });

                
            },
            error: function(response){
                console.log('Error'+response);
            }
        });
    }
    if (jQuery("body").hasClass("developer-mode move_menu_right")) {
        console.log('Menu Left: ON');
        // START AJAX get file content
        jQuery.ajax({
            url: thispage_outside+"/assets/plugins/mt-skin-switcher-left/skin-switcher.html", 
            context: document.body,
            success: function(response) {
                // Add HTML
                jQuery("body").append(response);
                // console.log('Success'+response);
                // Current Site Url
                var thispage = jQuery(location).attr('href');
                thispage  = thispage .substr(0, thispage .lastIndexOf("/"));
                // Get website url
                // console.log(thispage);
                jQuery("head").append('<link href="'+thispage+'/assets/plugins/mt-skin-switcher-left/skin-switcher.css" rel="stylesheet">');
                // jQuery("body").append('<script src="https://modeltheme.com/html-templates/cryptic/assets/plugins/mt-skin-switcher/skin-switcher.js"></script>');
                // Current Skin url
                var currectLinkHref = jQuery('#ui-current-skin').attr('href');
                currectLinkHref  = currectLinkHref .substr(0, currectLinkHref .lastIndexOf("/"));
                // SKIN SWITCHER
                jQuery( ".colors_buttons > span" ).on( "click", function() {
                    var newSkinName = jQuery( this ).attr('data-skin');
                    var newSkinCssHref = currectLinkHref+'/'+newSkinName;
                    
                    // SET THE NEW STYLE
                    jQuery('#ui-current-skin').attr("href", newSkinCssHref);
                    jQuery(".colors_buttons > span").removeClass('currentStyle');
                    jQuery( this ).addClass('currentStyle');
                    // LOG
                    // console.log( 'New Skin Applied: '+jQuery( this ).attr('data-skin') );
                });

                // SIDEBAR OPENER-LEFT
                jQuery(".move_menu_right #demopanel .panel_button .toggle_sidebar").click(function(){
                    jQuery(".move_menu_right #demopanel div#panel").animate({
                        left: "0px"
                    }, "fast");
                    jQuery(".move_menu_right #demopanel .panel_button").animate({
                        left: "300px"
                    }, "fast");
                    jQuery(".move_menu_right #demopanel .panel_button").toggle();
                }); 
                jQuery(".move_menu_right #demopanel .hide_button.hide_button").click(function(){
                    jQuery(".move_menu_right #demopanel #panel").animate({
                        left: "-300px"
                    }, "fast");
                    jQuery(".move_menu_right #demopanel .panel_button").animate({
                        left: "0px"
                    }, "fast");
                    jQuery(".move_menu_right #demopanel .panel_button").toggle();
                });


                // ==============================================================================
                // SKIN SWITCHER --> BACKGROUND CHANGER
                // ==============================================================================
                jQuery('.data_background').each(function() {
                    var bgurl = jQuery(this).attr('data-background');
                    jQuery(this).css('background-image', 'url(' + bgurl + ')');
                });

                jQuery( ".nav_imgs_buttons > .data_background" ).on( "click", function() {
                    // SET THE NEW STYLE
                    jQuery('.nav_imgs_buttons > .data_background').removeClass('currentStyle');
                    jQuery(this).addClass('currentStyle');
                    // ADD BODY CLASS
                    var classesToRemove = [
                                    "menu-background-img01", 
                                    "menu-background-img02", 
                                    "menu-background-img03",
                                    "menu-background-img04",
                                    "menu-background-img05",
                                    "menu-background-img06",
                                    "menu-background-img07",
                                    ];
                    var newBgImg = jQuery(this).attr('data-bg-class');
                    jQuery('body').removeClass(classesToRemove.join(' '));
                    jQuery('body').addClass(newBgImg);
                });

                
            },
            error: function(response){
                console.log('Error'+response);
            }
        });
    }
});
/*---------------------------------------------*/
/*--- 18. Range Slider ---*/
/*---------------------------------------------*/

 $(function () {
    if ($('#range_default').length) {
        $("#range_default").ionRangeSlider();
    }
    if ($('#range_min-max').length) {
        $("#range_min-max").ionRangeSlider({
            min: 100,
            max: 1000,
            from: 550
        });
    }
    if ($('#range_prefix').length) {
        $("#range_prefix").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: 200,
            to: 800,
            prefix: "$"
        });
    }
    if ($('#range_range').length) {
        $("#range_range").ionRangeSlider({
            type: "double",
            grid: true,
            min: -1000,
            max: 1000,
            from: -500,
            to: 500
        });
    }
    if ($('#range_step').length) {
        $("#range_step").ionRangeSlider({
            type: "double",
            grid: true,
            min: -1000,
            max: 1000,
            from: -500,
            to: 500,
            step: 250
        });
    }
    if ($('#range_range_step').length) {
        $("#range_range_step").ionRangeSlider({
            type: "double",
            grid: true,
            min: -12.8,
            max: 12.8,
            from: -3.2,
            to: 3.2,
            step: 0.1
        });
    }
    if ($('#range_custom_nr').length) {
        $("#range_custom_nr").ionRangeSlider({
            type: "double",
            grid: true,
            from: 1,
            to: 5,
            values: [0, 10, 100, 1000, 10000, 100000, 1000000]
        });
    }
    if ($('#range_custom_val').length) {
        $("#range_custom_val").ionRangeSlider({
            grid: true,
            from: 5,
            values: [
                "zero", "one",
                "two", "three",
                "four", "five",
                "six", "seven",
                "eight", "nine",
                "ten"
            ]
        });
    }
    if ($('#range_custom_str').length) {
        $("#range_custom_str").ionRangeSlider({
            grid: true,
            from: 3,
            values: [
                "January", "February", "March",
                "April", "May", "June",
                "July", "August", "September",
                "October", "November", "December"
            ]
        });
    }
    if ($('#range_no_prettify').length) {
        $("#range_no_prettify").ionRangeSlider({
            grid: true,
            min: 1000,
            max: 1000000,
            from: 100000,
            step: 1000,
            prettify_enabled: false
        });
    }
    if ($('#range_prettify').length) {
        $("#range_prettify").ionRangeSlider({
            grid: true,
            min: 1000,
            max: 1000000,
            from: 200000,
            step: 1000,
            prettify_enabled: true
        });
    }
    if ($('#range_like_prettify').length) {
        $("#range_like_prettify").ionRangeSlider({
            grid: true,
            min: 1000,
            max: 1000000,
            from: 300000,
            step: 1000,
            prettify_enabled: true,
            prettify_separator: "."
        });
    }
    if ($('#range_prefix_1').length) {
        $("#range_prefix_1").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 10000,
            from: 1000,
            step: 9000,
            prefix: "$"
        });
    }
    if ($('#range_post').length) {
        $("#range_post").ionRangeSlider({
            type: "single",
            grid: true,
            min: -90,
            max: 90,
            from: 0,
            postfix: "????"
        });
    }
    if ($('#range_extra').length) {
        $("#range_extra").ionRangeSlider({
            grid: true,
            min: 18,
            max: 70,
            from: 30,
            prefix: "Age ",
            max_postfix: "+"
        });
    }
    if ($('#range_use').length) {
        $("#range_use").ionRangeSlider({
            type: "double",
            min: 100,
            max: 200,
            from: 145,
            to: 155,
            prefix: "Weight: ",
            postfix: " million pounds",
            decorate_both: true
        });
    }
    if ($('#range_no_use').length) {
        $("#range_no_use").ionRangeSlider({
            type: "double",
            min: 100,
            max: 200,
            from: 145,
            to: 155,
            prefix: "Weight: ",
            postfix: " million pounds",
            decorate_both: false
        });
    }
    if ($('#range_use_own').length) {
        $("#range_use_own").ionRangeSlider({
            type: "double",
            min: 100,
            max: 200,
            from: 148,
            to: 152,
            prefix: "Weight: ",
            postfix: " million pounds",
            values_separator: " ???????? "
        });
    }
    if ($('#range_use_to').length) {
        $("#range_use_to").ionRangeSlider({
            type: "double",
            min: 100,
            max: 200,
            from: 148,
            to: 152,
            prefix: "Range: ",
            postfix: " light years",
            decorate_both: false,
            values_separator: " to "
        });
    }
    if ($('#range_hide_all').length) {
        $("#range_hide_all").ionRangeSlider({
            type: "double",
            min: 1000,
            max: 2000,
            from: 1200,
            to: 1800,
            hide_min_max: true,
            hide_from_to: true,
            grid: false
        });
    }
    if ($('#range_hide_up').length) {
        $("#range_hide_up").ionRangeSlider({
            type: "double",
            min: 1000,
            max: 2000,
            from: 1200,
            to: 1800,
            hide_min_max: true,
            hide_from_to: true,
            grid: true
        });
    }
    if ($('#range_hide_down').length) {
        $("#range_hide_down").ionRangeSlider({
            type: "double",
            min: 1000,
            max: 2000,
            from: 1200,
            to: 1800,
            hide_min_max: false,
            hide_from_to: true,
            grid: false
        });
    }
    if ($('#range_hide').length) {
        $("#range_hide").ionRangeSlider({
            type: "double",
            min: 1000,
            max: 2000,
            from: 1200,
            to: 1800,
            hide_min_max: true,
            hide_from_to: false,
            grid: false
        });
    }
});
/*---------------------------------------------*/
/*--- 19. Image loader ---*/
/*---------------------------------------------*/

$(function() {
    if ($('#container').length) {
        $('#container').on('dragover', function(e) {
            e.preventDefault();
            $(this).addClass('file-over');
            //$('svg path').show();
        });
        $('#container').on('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('file-over');
        });
        $('#container').on('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('file-over').stop(true, true).css({
              background:'#fff'
            });
            $('.progress').toggleClass('complete');
            $('#image-holder').addClass('move');
        });
    
        var dropzone = document.getElementById("container");
      
        FileReaderJS.setupDrop(dropzone, {
            readAsDefault: "DataURL",
            on: {
            load: function(e, file) {
                var img = document.getElementById("image-holder");
                img.onload = function() {
                  document.getElementById("image-holder").appendChild(document.createTextNode(img));
                };
                img.src = e.target.result;
            }
        }
      });
    }
});
/*---------------------------------------------*/
/*--- 20. OWL Carousel ---*/
/*---------------------------------------------*/

"function"!==typeof Object.create&&(Object.create=function(f){function g(){}g.prototype=f;return new g});
(function(f,g,k){var l={init:function(a,b){this.$elem=f(b);this.options=f.extend({},f.fn.owlCarousel.options,this.$elem.data(),a);this.userOptions=a;this.loadContent()},loadContent:function(){function a(a){var d,e="";if("function"===typeof b.options.jsonSuccess)b.options.jsonSuccess.apply(this,[a]);else{for(d in a.owl)a.owl.hasOwnProperty(d)&&(e+=a.owl[d].item);b.$elem.html(e)}b.logIn()}var b=this,e;"function"===typeof b.options.beforeInit&&b.options.beforeInit.apply(this,[b.$elem]);"string"===typeof b.options.jsonPath?
(e=b.options.jsonPath,f.getJSON(e,a)):b.logIn()},logIn:function(){this.$elem.data("owl-originalStyles",this.$elem.attr("style"));this.$elem.data("owl-originalClasses",this.$elem.attr("class"));this.$elem.css({opacity:0});this.orignalItems=this.options.items;this.checkBrowser();this.wrapperWidth=0;this.checkVisible=null;this.setVars()},setVars:function(){if(0===this.$elem.children().length)return!1;this.baseClass();this.eventTypes();this.$userItems=this.$elem.children();this.itemsAmount=this.$userItems.length;
this.wrapItems();this.$owlItems=this.$elem.find(".owl-item");this.$owlWrapper=this.$elem.find(".owl-wrapper");this.playDirection="next";this.prevItem=0;this.prevArr=[0];this.currentItem=0;this.customEvents();this.onStartup()},onStartup:function(){this.updateItems();this.calculateAll();this.buildControls();this.updateControls();this.response();this.moveEvents();this.stopOnHover();this.owlStatus();!1!==this.options.transitionStyle&&this.transitionTypes(this.options.transitionStyle);!0===this.options.autoPlay&&
(this.options.autoPlay=5E3);this.play();this.$elem.find(".owl-wrapper").css("display","block");this.$elem.is(":visible")?this.$elem.css("opacity",1):this.watchVisibility();this.onstartup=!1;this.eachMoveUpdate();"function"===typeof this.options.afterInit&&this.options.afterInit.apply(this,[this.$elem])},eachMoveUpdate:function(){!0===this.options.lazyLoad&&this.lazyLoad();!0===this.options.autoHeight&&this.autoHeight();this.onVisibleItems();"function"===typeof this.options.afterAction&&this.options.afterAction.apply(this,
[this.$elem])},updateVars:function(){"function"===typeof this.options.beforeUpdate&&this.options.beforeUpdate.apply(this,[this.$elem]);this.watchVisibility();this.updateItems();this.calculateAll();this.updatePosition();this.updateControls();this.eachMoveUpdate();"function"===typeof this.options.afterUpdate&&this.options.afterUpdate.apply(this,[this.$elem])},reload:function(){var a=this;g.setTimeout(function(){a.updateVars()},0)},watchVisibility:function(){var a=this;if(!1===a.$elem.is(":visible"))a.$elem.css({opacity:0}),
g.clearInterval(a.autoPlayInterval),g.clearInterval(a.checkVisible);else return!1;a.checkVisible=g.setInterval(function(){a.$elem.is(":visible")&&(a.reload(),a.$elem.animate({opacity:1},200),g.clearInterval(a.checkVisible))},500)},wrapItems:function(){this.$userItems.wrapAll('<div class="owl-wrapper">').wrap('<div class="owl-item"></div>');this.$elem.find(".owl-wrapper").wrap('<div class="owl-wrapper-outer">');this.wrapperOuter=this.$elem.find(".owl-wrapper-outer");this.$elem.css("display","block")},
baseClass:function(){var a=this.$elem.hasClass(this.options.baseClass),b=this.$elem.hasClass(this.options.theme);a||this.$elem.addClass(this.options.baseClass);b||this.$elem.addClass(this.options.theme)},updateItems:function(){var a,b;if(!1===this.options.responsive)return!1;if(!0===this.options.singleItem)return this.options.items=this.orignalItems=1,this.options.itemsCustom=!1,this.options.itemsDesktop=!1,this.options.itemsDesktopSmall=!1,this.options.itemsTablet=!1,this.options.itemsTabletSmall=
!1,this.options.itemsMobile=!1;a=f(this.options.responsiveBaseWidth).width();a>(this.options.itemsDesktop[0]||this.orignalItems)&&(this.options.items=this.orignalItems);if(!1!==this.options.itemsCustom)for(this.options.itemsCustom.sort(function(a,b){return a[0]-b[0]}),b=0;b<this.options.itemsCustom.length;b+=1)this.options.itemsCustom[b][0]<=a&&(this.options.items=this.options.itemsCustom[b][1]);else a<=this.options.itemsDesktop[0]&&!1!==this.options.itemsDesktop&&(this.options.items=this.options.itemsDesktop[1]),
a<=this.options.itemsDesktopSmall[0]&&!1!==this.options.itemsDesktopSmall&&(this.options.items=this.options.itemsDesktopSmall[1]),a<=this.options.itemsTablet[0]&&!1!==this.options.itemsTablet&&(this.options.items=this.options.itemsTablet[1]),a<=this.options.itemsTabletSmall[0]&&!1!==this.options.itemsTabletSmall&&(this.options.items=this.options.itemsTabletSmall[1]),a<=this.options.itemsMobile[0]&&!1!==this.options.itemsMobile&&(this.options.items=this.options.itemsMobile[1]);this.options.items>this.itemsAmount&&
!0===this.options.itemsScaleUp&&(this.options.items=this.itemsAmount)},response:function(){var a=this,b,e;if(!0!==a.options.responsive)return!1;e=f(g).width();a.resizer=function(){f(g).width()!==e&&(!1!==a.options.autoPlay&&g.clearInterval(a.autoPlayInterval),g.clearTimeout(b),b=g.setTimeout(function(){e=f(g).width();a.updateVars()},a.options.responsiveRefreshRate))};f(g).resize(a.resizer)},updatePosition:function(){this.jumpTo(this.currentItem);!1!==this.options.autoPlay&&this.checkAp()},appendItemsSizes:function(){var a=
this,b=0,e=a.itemsAmount-a.options.items;a.$owlItems.each(function(c){var d=f(this);d.css({width:a.itemWidth}).data("owl-item",Number(c));if(0===c%a.options.items||c===e)c>e||(b+=1);d.data("owl-roundPages",b)})},appendWrapperSizes:function(){this.$owlWrapper.css({width:this.$owlItems.length*this.itemWidth*2,left:0});this.appendItemsSizes()},calculateAll:function(){this.calculateWidth();this.appendWrapperSizes();this.loops();this.max()},calculateWidth:function(){this.itemWidth=Math.round(this.$elem.width()/
this.options.items)},max:function(){var a=-1*(this.itemsAmount*this.itemWidth-this.options.items*this.itemWidth);this.options.items>this.itemsAmount?this.maximumPixels=a=this.maximumItem=0:(this.maximumItem=this.itemsAmount-this.options.items,this.maximumPixels=a);return a},min:function(){return 0},loops:function(){var a=0,b=0,e,c;this.positionsInArray=[0];this.pagesInArray=[];for(e=0;e<this.itemsAmount;e+=1)b+=this.itemWidth,this.positionsInArray.push(-b),!0===this.options.scrollPerPage&&(c=f(this.$owlItems[e]),
c=c.data("owl-roundPages"),c!==a&&(this.pagesInArray[a]=this.positionsInArray[e],a=c))},buildControls:function(){if(!0===this.options.navigation||!0===this.options.pagination)this.owlControls=f('<div class="owl-controls"/>').toggleClass("clickable",!this.browser.isTouch).appendTo(this.$elem);!0===this.options.pagination&&this.buildPagination();!0===this.options.navigation&&this.buildButtons()},buildButtons:function(){var a=this,b=f('<div class="owl-buttons"/>');a.owlControls.append(b);a.buttonPrev=
f("<div/>",{"class":"owl-prev",html:a.options.navigationText[0]||""});a.buttonNext=f("<div/>",{"class":"owl-next",html:a.options.navigationText[1]||""});b.append(a.buttonPrev).append(a.buttonNext);b.on("touchstart.owlControls mousedown.owlControls",'div[class^="owl"]',function(a){a.preventDefault()});b.on("touchend.owlControls mouseup.owlControls",'div[class^="owl"]',function(b){b.preventDefault();f(this).hasClass("owl-next")?a.next():a.prev()})},buildPagination:function(){var a=this;a.paginationWrapper=
f('<div class="owl-pagination"/>');a.owlControls.append(a.paginationWrapper);a.paginationWrapper.on("touchend.owlControls mouseup.owlControls",".owl-page",function(b){b.preventDefault();Number(f(this).data("owl-page"))!==a.currentItem&&a.goTo(Number(f(this).data("owl-page")),!0)})},updatePagination:function(){var a,b,e,c,d,g;if(!1===this.options.pagination)return!1;this.paginationWrapper.html("");a=0;b=this.itemsAmount-this.itemsAmount%this.options.items;for(c=0;c<this.itemsAmount;c+=1)0===c%this.options.items&&
(a+=1,b===c&&(e=this.itemsAmount-this.options.items),d=f("<div/>",{"class":"owl-page"}),g=f("<span></span>",{text:!0===this.options.paginationNumbers?a:"","class":!0===this.options.paginationNumbers?"owl-numbers":""}),d.append(g),d.data("owl-page",b===c?e:c),d.data("owl-roundPages",a),this.paginationWrapper.append(d));this.checkPagination()},checkPagination:function(){var a=this;if(!1===a.options.pagination)return!1;a.paginationWrapper.find(".owl-page").each(function(){f(this).data("owl-roundPages")===
f(a.$owlItems[a.currentItem]).data("owl-roundPages")&&(a.paginationWrapper.find(".owl-page").removeClass("active"),f(this).addClass("active"))})},checkNavigation:function(){if(!1===this.options.navigation)return!1;!1===this.options.rewindNav&&(0===this.currentItem&&0===this.maximumItem?(this.buttonPrev.addClass("disabled"),this.buttonNext.addClass("disabled")):0===this.currentItem&&0!==this.maximumItem?(this.buttonPrev.addClass("disabled"),this.buttonNext.removeClass("disabled")):this.currentItem===
this.maximumItem?(this.buttonPrev.removeClass("disabled"),this.buttonNext.addClass("disabled")):0!==this.currentItem&&this.currentItem!==this.maximumItem&&(this.buttonPrev.removeClass("disabled"),this.buttonNext.removeClass("disabled")))},updateControls:function(){this.updatePagination();this.checkNavigation();this.owlControls&&(this.options.items>=this.itemsAmount?this.owlControls.hide():this.owlControls.show())},destroyControls:function(){this.owlControls&&this.owlControls.remove()},next:function(a){if(this.isTransition)return!1;
this.currentItem+=!0===this.options.scrollPerPage?this.options.items:1;if(this.currentItem>this.maximumItem+(!0===this.options.scrollPerPage?this.options.items-1:0))if(!0===this.options.rewindNav)this.currentItem=0,a="rewind";else return this.currentItem=this.maximumItem,!1;this.goTo(this.currentItem,a)},prev:function(a){if(this.isTransition)return!1;this.currentItem=!0===this.options.scrollPerPage&&0<this.currentItem&&this.currentItem<this.options.items?0:this.currentItem-(!0===this.options.scrollPerPage?
this.options.items:1);if(0>this.currentItem)if(!0===this.options.rewindNav)this.currentItem=this.maximumItem,a="rewind";else return this.currentItem=0,!1;this.goTo(this.currentItem,a)},goTo:function(a,b,e){var c=this;if(c.isTransition)return!1;"function"===typeof c.options.beforeMove&&c.options.beforeMove.apply(this,[c.$elem]);a>=c.maximumItem?a=c.maximumItem:0>=a&&(a=0);c.currentItem=c.owl.currentItem=a;if(!1!==c.options.transitionStyle&&"drag"!==e&&1===c.options.items&&!0===c.browser.support3d)return c.swapSpeed(0),
!0===c.browser.support3d?c.transition3d(c.positionsInArray[a]):c.css2slide(c.positionsInArray[a],1),c.afterGo(),c.singleItemTransition(),!1;a=c.positionsInArray[a];!0===c.browser.support3d?(c.isCss3Finish=!1,!0===b?(c.swapSpeed("paginationSpeed"),g.setTimeout(function(){c.isCss3Finish=!0},c.options.paginationSpeed)):"rewind"===b?(c.swapSpeed(c.options.rewindSpeed),g.setTimeout(function(){c.isCss3Finish=!0},c.options.rewindSpeed)):(c.swapSpeed("slideSpeed"),g.setTimeout(function(){c.isCss3Finish=!0},
c.options.slideSpeed)),c.transition3d(a)):!0===b?c.css2slide(a,c.options.paginationSpeed):"rewind"===b?c.css2slide(a,c.options.rewindSpeed):c.css2slide(a,c.options.slideSpeed);c.afterGo()},jumpTo:function(a){"function"===typeof this.options.beforeMove&&this.options.beforeMove.apply(this,[this.$elem]);a>=this.maximumItem||-1===a?a=this.maximumItem:0>=a&&(a=0);this.swapSpeed(0);!0===this.browser.support3d?this.transition3d(this.positionsInArray[a]):this.css2slide(this.positionsInArray[a],1);this.currentItem=
this.owl.currentItem=a;this.afterGo()},afterGo:function(){this.prevArr.push(this.currentItem);this.prevItem=this.owl.prevItem=this.prevArr[this.prevArr.length-2];this.prevArr.shift(0);this.prevItem!==this.currentItem&&(this.checkPagination(),this.checkNavigation(),this.eachMoveUpdate(),!1!==this.options.autoPlay&&this.checkAp());"function"===typeof this.options.afterMove&&this.prevItem!==this.currentItem&&this.options.afterMove.apply(this,[this.$elem])},stop:function(){this.apStatus="stop";g.clearInterval(this.autoPlayInterval)},
checkAp:function(){"stop"!==this.apStatus&&this.play()},play:function(){var a=this;a.apStatus="play";if(!1===a.options.autoPlay)return!1;g.clearInterval(a.autoPlayInterval);a.autoPlayInterval=g.setInterval(function(){a.next(!0)},a.options.autoPlay)},swapSpeed:function(a){"slideSpeed"===a?this.$owlWrapper.css(this.addCssSpeed(this.options.slideSpeed)):"paginationSpeed"===a?this.$owlWrapper.css(this.addCssSpeed(this.options.paginationSpeed)):"string"!==typeof a&&this.$owlWrapper.css(this.addCssSpeed(a))},
addCssSpeed:function(a){return{"-webkit-transition":"all "+a+"ms ease","-moz-transition":"all "+a+"ms ease","-o-transition":"all "+a+"ms ease",transition:"all "+a+"ms ease"}},removeTransition:function(){return{"-webkit-transition":"","-moz-transition":"","-o-transition":"",transition:""}},doTranslate:function(a){return{"-webkit-transform":"translate3d("+a+"px, 0px, 0px)","-moz-transform":"translate3d("+a+"px, 0px, 0px)","-o-transform":"translate3d("+a+"px, 0px, 0px)","-ms-transform":"translate3d("+
a+"px, 0px, 0px)",transform:"translate3d("+a+"px, 0px,0px)"}},transition3d:function(a){this.$owlWrapper.css(this.doTranslate(a))},css2move:function(a){this.$owlWrapper.css({left:a})},css2slide:function(a,b){var e=this;e.isCssFinish=!1;e.$owlWrapper.stop(!0,!0).animate({left:a},{duration:b||e.options.slideSpeed,complete:function(){e.isCssFinish=!0}})},checkBrowser:function(){var a=k.createElement("div");a.style.cssText="  -moz-transform:translate3d(0px, 0px, 0px); -ms-transform:translate3d(0px, 0px, 0px); -o-transform:translate3d(0px, 0px, 0px); -webkit-transform:translate3d(0px, 0px, 0px); transform:translate3d(0px, 0px, 0px)";
a=a.style.cssText.match(/translate3d\(0px, 0px, 0px\)/g);this.browser={support3d:null!==a&&1===a.length,isTouch:"ontouchstart"in g||g.navigator.msMaxTouchPoints}},moveEvents:function(){if(!1!==this.options.mouseDrag||!1!==this.options.touchDrag)this.gestures(),this.disabledEvents()},eventTypes:function(){var a=["s","e","x"];this.ev_types={};!0===this.options.mouseDrag&&!0===this.options.touchDrag?a=["touchstart.owl mousedown.owl","touchmove.owl mousemove.owl","touchend.owl touchcancel.owl mouseup.owl"]:
!1===this.options.mouseDrag&&!0===this.options.touchDrag?a=["touchstart.owl","touchmove.owl","touchend.owl touchcancel.owl"]:!0===this.options.mouseDrag&&!1===this.options.touchDrag&&(a=["mousedown.owl","mousemove.owl","mouseup.owl"]);this.ev_types.start=a[0];this.ev_types.move=a[1];this.ev_types.end=a[2]},disabledEvents:function(){this.$elem.on("dragstart.owl",function(a){a.preventDefault()});this.$elem.on("mousedown.disableTextSelect",function(a){return f(a.target).is("input, textarea, select, option")})},
gestures:function(){function a(a){if(void 0!==a.touches)return{x:a.touches[0].pageX,y:a.touches[0].pageY};if(void 0===a.touches){if(void 0!==a.pageX)return{x:a.pageX,y:a.pageY};if(void 0===a.pageX)return{x:a.clientX,y:a.clientY}}}function b(a){"on"===a?(f(k).on(d.ev_types.move,e),f(k).on(d.ev_types.end,c)):"off"===a&&(f(k).off(d.ev_types.move),f(k).off(d.ev_types.end))}function e(b){b=b.originalEvent||b||g.event;d.newPosX=a(b).x-h.offsetX;d.newPosY=a(b).y-h.offsetY;d.newRelativeX=d.newPosX-h.relativePos;
"function"===typeof d.options.startDragging&&!0!==h.dragging&&0!==d.newRelativeX&&(h.dragging=!0,d.options.startDragging.apply(d,[d.$elem]));(8<d.newRelativeX||-8>d.newRelativeX)&&!0===d.browser.isTouch&&(void 0!==b.preventDefault?b.preventDefault():b.returnValue=!1,h.sliding=!0);(10<d.newPosY||-10>d.newPosY)&&!1===h.sliding&&f(k).off("touchmove.owl");d.newPosX=Math.max(Math.min(d.newPosX,d.newRelativeX/5),d.maximumPixels+d.newRelativeX/5);!0===d.browser.support3d?d.transition3d(d.newPosX):d.css2move(d.newPosX)}
function c(a){a=a.originalEvent||a||g.event;var c;a.target=a.target||a.srcElement;h.dragging=!1;!0!==d.browser.isTouch&&d.$owlWrapper.removeClass("grabbing");d.dragDirection=0>d.newRelativeX?d.owl.dragDirection="left":d.owl.dragDirection="right";0!==d.newRelativeX&&(c=d.getNewPosition(),d.goTo(c,!1,"drag"),h.targetElement===a.target&&!0!==d.browser.isTouch&&(f(a.target).on("click.disable",function(a){a.stopImmediatePropagation();a.stopPropagation();a.preventDefault();f(a.target).off("click.disable")}),
a=f._data(a.target,"events").click,c=a.pop(),a.splice(0,0,c)));b("off")}var d=this,h={offsetX:0,offsetY:0,baseElWidth:0,relativePos:0,position:null,minSwipe:null,maxSwipe:null,sliding:null,dargging:null,targetElement:null};d.isCssFinish=!0;d.$elem.on(d.ev_types.start,".owl-wrapper",function(c){c=c.originalEvent||c||g.event;var e;if(3===c.which)return!1;if(!(d.itemsAmount<=d.options.items)){if(!1===d.isCssFinish&&!d.options.dragBeforeAnimFinish||!1===d.isCss3Finish&&!d.options.dragBeforeAnimFinish)return!1;
!1!==d.options.autoPlay&&g.clearInterval(d.autoPlayInterval);!0===d.browser.isTouch||d.$owlWrapper.hasClass("grabbing")||d.$owlWrapper.addClass("grabbing");d.newPosX=0;d.newRelativeX=0;f(this).css(d.removeTransition());e=f(this).position();h.relativePos=e.left;h.offsetX=a(c).x-e.left;h.offsetY=a(c).y-e.top;b("on");h.sliding=!1;h.targetElement=c.target||c.srcElement}})},getNewPosition:function(){var a=this.closestItem();a>this.maximumItem?a=this.currentItem=this.maximumItem:0<=this.newPosX&&(this.currentItem=
a=0);return a},closestItem:function(){var a=this,b=!0===a.options.scrollPerPage?a.pagesInArray:a.positionsInArray,e=a.newPosX,c=null;f.each(b,function(d,g){e-a.itemWidth/20>b[d+1]&&e-a.itemWidth/20<g&&"left"===a.moveDirection()?(c=g,a.currentItem=!0===a.options.scrollPerPage?f.inArray(c,a.positionsInArray):d):e+a.itemWidth/20<g&&e+a.itemWidth/20>(b[d+1]||b[d]-a.itemWidth)&&"right"===a.moveDirection()&&(!0===a.options.scrollPerPage?(c=b[d+1]||b[b.length-1],a.currentItem=f.inArray(c,a.positionsInArray)):
(c=b[d+1],a.currentItem=d+1))});return a.currentItem},moveDirection:function(){var a;0>this.newRelativeX?(a="right",this.playDirection="next"):(a="left",this.playDirection="prev");return a},customEvents:function(){var a=this;a.$elem.on("owl.next",function(){a.next()});a.$elem.on("owl.prev",function(){a.prev()});a.$elem.on("owl.play",function(b,e){a.options.autoPlay=e;a.play();a.hoverStatus="play"});a.$elem.on("owl.stop",function(){a.stop();a.hoverStatus="stop"});a.$elem.on("owl.goTo",function(b,e){a.goTo(e)});
a.$elem.on("owl.jumpTo",function(b,e){a.jumpTo(e)})},stopOnHover:function(){var a=this;!0===a.options.stopOnHover&&!0!==a.browser.isTouch&&!1!==a.options.autoPlay&&(a.$elem.on("mouseover",function(){a.stop()}),a.$elem.on("mouseout",function(){"stop"!==a.hoverStatus&&a.play()}))},lazyLoad:function(){var a,b,e,c,d;if(!1===this.options.lazyLoad)return!1;for(a=0;a<this.itemsAmount;a+=1)b=f(this.$owlItems[a]),"loaded"!==b.data("owl-loaded")&&(e=b.data("owl-item"),c=b.find(".lazyOwl"),"string"!==typeof c.data("src")?
b.data("owl-loaded","loaded"):(void 0===b.data("owl-loaded")&&(c.hide(),b.addClass("loading").data("owl-loaded","checked")),(d=!0===this.options.lazyFollow?e>=this.currentItem:!0)&&e<this.currentItem+this.options.items&&c.length&&this.lazyPreload(b,c)))},lazyPreload:function(a,b){function e(){a.data("owl-loaded","loaded").removeClass("loading");b.removeAttr("data-src");"fade"===d.options.lazyEffect?b.fadeIn(400):b.show();"function"===typeof d.options.afterLazyLoad&&d.options.afterLazyLoad.apply(this,
[d.$elem])}function c(){f+=1;d.completeImg(b.get(0))||!0===k?e():100>=f?g.setTimeout(c,100):e()}var d=this,f=0,k;"DIV"===b.prop("tagName")?(b.css("background-image","url("+b.data("src")+")"),k=!0):b[0].src=b.data("src");c()},autoHeight:function(){function a(){var a=f(e.$owlItems[e.currentItem]).height();e.wrapperOuter.css("height",a+"px");e.wrapperOuter.hasClass("autoHeight")||g.setTimeout(function(){e.wrapperOuter.addClass("autoHeight")},0)}function b(){d+=1;e.completeImg(c.get(0))?a():100>=d?g.setTimeout(b,
100):e.wrapperOuter.css("height","")}var e=this,c=f(e.$owlItems[e.currentItem]).find("img"),d;void 0!==c.get(0)?(d=0,b()):a()},completeImg:function(a){return!a.complete||"undefined"!==typeof a.naturalWidth&&0===a.naturalWidth?!1:!0},onVisibleItems:function(){var a;!0===this.options.addClassActive&&this.$owlItems.removeClass("active");this.visibleItems=[];for(a=this.currentItem;a<this.currentItem+this.options.items;a+=1)this.visibleItems.push(a),!0===this.options.addClassActive&&f(this.$owlItems[a]).addClass("active");
this.owl.visibleItems=this.visibleItems},transitionTypes:function(a){this.outClass="owl-"+a+"-out";this.inClass="owl-"+a+"-in"},singleItemTransition:function(){var a=this,b=a.outClass,e=a.inClass,c=a.$owlItems.eq(a.currentItem),d=a.$owlItems.eq(a.prevItem),f=Math.abs(a.positionsInArray[a.currentItem])+a.positionsInArray[a.prevItem],g=Math.abs(a.positionsInArray[a.currentItem])+a.itemWidth/2;a.isTransition=!0;a.$owlWrapper.addClass("owl-origin").css({"-webkit-transform-origin":g+"px","-moz-perspective-origin":g+
"px","perspective-origin":g+"px"});d.css({position:"relative",left:f+"px"}).addClass(b).on("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend",function(){a.endPrev=!0;d.off("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend");a.clearTransStyle(d,b)});c.addClass(e).on("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend",function(){a.endCurrent=!0;c.off("webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend");a.clearTransStyle(c,e)})},clearTransStyle:function(a,
b){a.css({position:"",left:""}).removeClass(b);this.endPrev&&this.endCurrent&&(this.$owlWrapper.removeClass("owl-origin"),this.isTransition=this.endCurrent=this.endPrev=!1)},owlStatus:function(){this.owl={userOptions:this.userOptions,baseElement:this.$elem,userItems:this.$userItems,owlItems:this.$owlItems,currentItem:this.currentItem,prevItem:this.prevItem,visibleItems:this.visibleItems,isTouch:this.browser.isTouch,browser:this.browser,dragDirection:this.dragDirection}},clearEvents:function(){this.$elem.off(".owl owl mousedown.disableTextSelect");
f(k).off(".owl owl");f(g).off("resize",this.resizer)},unWrap:function(){0!==this.$elem.children().length&&(this.$owlWrapper.unwrap(),this.$userItems.unwrap().unwrap(),this.owlControls&&this.owlControls.remove());this.clearEvents();this.$elem.attr("style",this.$elem.data("owl-originalStyles")||"").attr("class",this.$elem.data("owl-originalClasses"))},destroy:function(){this.stop();g.clearInterval(this.checkVisible);this.unWrap();this.$elem.removeData()},reinit:function(a){a=f.extend({},this.userOptions,
a);this.unWrap();this.init(a,this.$elem)},addItem:function(a,b){var e;if(!a)return!1;if(0===this.$elem.children().length)return this.$elem.append(a),this.setVars(),!1;this.unWrap();e=void 0===b||-1===b?-1:b;e>=this.$userItems.length||-1===e?this.$userItems.eq(-1).after(a):this.$userItems.eq(e).before(a);this.setVars()},removeItem:function(a){if(0===this.$elem.children().length)return!1;a=void 0===a||-1===a?-1:a;this.unWrap();this.$userItems.eq(a).remove();this.setVars()}};f.fn.owlCarousel=function(a){return this.each(function(){if(!0===
f(this).data("owl-init"))return!1;f(this).data("owl-init",!0);var b=Object.create(l);b.init(a,this);f.data(this,"owlCarousel",b)})};f.fn.owlCarousel.options={items:5,itemsCustom:!1,itemsDesktop:[1199,4],itemsDesktopSmall:[979,3],itemsTablet:[768,2],itemsTabletSmall:!1,itemsMobile:[479,1],singleItem:!1,itemsScaleUp:!1,slideSpeed:200,paginationSpeed:800,rewindSpeed:1E3,autoPlay:!1,stopOnHover:!1,navigation:!1,navigationText:["prev","next"],rewindNav:!0,scrollPerPage:!1,pagination:!0,paginationNumbers:!1,
responsive:!0,responsiveRefreshRate:200,responsiveBaseWidth:g,baseClass:"owl-carousel",theme:"owl-theme",lazyLoad:!1,lazyFollow:!0,lazyEffect:"fade",autoHeight:!1,jsonPath:!1,jsonSuccess:!1,dragBeforeAnimFinish:!0,mouseDrag:!0,touchDrag:!0,addClassActive:!1,transitionStyle:!1,beforeUpdate:!1,afterUpdate:!1,beforeInit:!1,afterInit:!1,beforeMove:!1,afterMove:!1,afterAction:!1,startDragging:!1,afterLazyLoad:!1}})(jQuery,window,document);
jQuery( document ).ready(function() {
     /*Begin: Testimonials slider*/
         jQuery(".testimonials02-container").owlCarousel({
          navigation      : true, // Show next and prev buttons
          pagination      : false,
          autoPlay        : false,
          slideSpeed      : 700,
          paginationSpeed : 700,
          singleItem      : true,
          navigationText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
        });
        /*End: Testimonials slider*/

});
