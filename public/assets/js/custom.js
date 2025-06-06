(() => {
    function e(o) {
        return (e =
            "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
                ? function (e) {
                      return typeof e;
                  }
                : function (e) {
                      return e &&
                          "function" == typeof Symbol &&
                          e.constructor === Symbol &&
                          e !== Symbol.prototype
                          ? "symbol"
                          : typeof e;
                  })(o);
    }
    !(function (o) {
        "use strict";
        o(window).on("load", function (e) {
            o("#global-loader").fadeOut("slow");
        }),
            o(document).on("click", ".fullscreen-button", function () {
                o("html").addClass("fullscreen-content"),
                    (void 0 !== document.fullScreenElement &&
                        null === document.fullScreenElement) ||
                    (void 0 !== document.msFullscreenElement &&
                        null === document.msFullscreenElement) ||
                    (void 0 !== document.mozFullScreen &&
                        !document.mozFullScreen) ||
                    (void 0 !== document.webkitIsFullScreen &&
                        !document.webkitIsFullScreen)
                        ? document.documentElement.requestFullScreen
                            ? document.documentElement.requestFullScreen()
                            : document.documentElement.mozRequestFullScreen
                            ? document.documentElement.mozRequestFullScreen()
                            : document.documentElement.webkitRequestFullScreen
                            ? document.documentElement.webkitRequestFullScreen(
                                  Element.ALLOW_KEYBOARD_INPUT
                              )
                            : document.documentElement.msRequestFullscreen &&
                              document.documentElement.msRequestFullscreen()
                        : (o("html").removeClass("fullscreen-content"),
                          document.cancelFullScreen
                              ? document.cancelFullScreen()
                              : document.mozCancelFullScreen
                              ? document.mozCancelFullScreen()
                              : document.webkitCancelFullScreen
                              ? document.webkitCancelFullScreen()
                              : document.msExitFullscreen &&
                                document.msExitFullscreen());
            }),
            o(".cover-image").each(function () {
                var r = o(this).attr("data-image-src");
                "undefined" !== e(r) &&
                    !1 !== r &&
                    o(this).css("background", "url(" + r + ") center center");
            }),
            o(document).ready(function () {
                o("a[data-theme]").on("click", function () {
                    o("head link#theme").attr("href", o(this).data("theme")),
                        o(this)
                            .toggleClass("active")
                            .siblings()
                            .removeClass("active");
                }),
                    o("a[data-effect]").on("click", function () {
                        o("head link#effect").attr(
                            "href",
                            o(this).data("effect")
                        ),
                            o(this)
                                .toggleClass("active")
                                .siblings()
                                .removeClass("active");
                    });
            }),
            o('[data-toggle="tooltip"]').tooltip(),
            o('[data-toggle="tooltip-primary"]').tooltip({
                template:
                    '<div class="tooltip tooltip-primary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
            }),
            o('[data-toggle="tooltip-secondary"]').tooltip({
                template:
                    '<div class="tooltip tooltip-secondary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
            }),
            o('[data-toggle="popover"]').popover(),
            o('[data-popover-color="head-primary"]').popover({
                template:
                    '<div class="popover popover-head-primary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
            }),
            o('[data-popover-color="head-secondary"]').popover({
                template:
                    '<div class="popover popover-head-secondary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
            }),
            o('[data-popover-color="primary"]').popover({
                template:
                    '<div class="popover popover-primary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
            }),
            o('[data-popover-color="secondary"]').popover({
                template:
                    '<div class="popover popover-secondary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
            }),
            o(document).on("click", function (e) {
                o('[data-toggle="popover"],[data-original-title]').each(
                    function () {
                        o(this).is(e.target) ||
                            0 !== o(this).has(e.target).length ||
                            0 !== o(".popover").has(e.target).length ||
                            ((
                                (
                                    o(this)
                                        .popover("hide")
                                        .data("bs.popover") || {}
                                ).inState || {}
                            ).click = !1);
                    }
                );
            }),
            o(".modal-effect").on("click", function (e) {
                e.preventDefault();
                var r = o(this).attr("data-effect");
                o("#modaldemo8").addClass(r);
            }),
            o("#modaldemo8").on("hidden.bs.modal", function (e) {
                o(this).removeClass(function (e, o) {
                    return (o.match(/(^|\s)effect-\S+/g) || []).join(" ");
                });
            }),
            o(window).on("scroll", function (e) {
                o(this).scrollTop() > 0
                    ? o("#back-to-top").fadeIn("slow")
                    : o("#back-to-top").fadeOut("slow");
            }),
            o("#back-to-top").on("click", function (e) {
                return o("html, body").animate({ scrollTop: 0 }, 600), !1;
            }),
            o(".chart-circle").length &&
                o(".chart-circle").each(function () {
                    var e = o(this);
                    e.circleProgress({
                        fill: { color: e.attr("data-color") },
                        size: e.height(),
                        startAngle: (-Math.PI / 4) * 2,
                        emptyFill: "#e5e9f2",
                        lineCap: "round",
                    });
                }),
            o(".chart-circle-primary").length &&
                o(".chart-circle-primary").each(function () {
                    var e = o(this);
                    e.circleProgress({
                        fill: { color: e.attr("data-color") },
                        size: e.height(),
                        startAngle: (-Math.PI / 4) * 2,
                        emptyFill: "rgba(51, 102, 255, 0.4)",
                        lineCap: "round",
                    });
                }),
            o(".chart-circle-secondary").length &&
                o(".chart-circle-secondary").each(function () {
                    var e = o(this);
                    e.circleProgress({
                        fill: { color: e.attr("data-color") },
                        size: e.height(),
                        startAngle: (-Math.PI / 4) * 2,
                        emptyFill: "rgba(254, 127, 0, 0.4)",
                        lineCap: "round",
                    });
                }),
            o(".chart-circle-success").length &&
                o(".chart-circle-success").each(function () {
                    var e = o(this);
                    e.circleProgress({
                        fill: { color: e.attr("data-color") },
                        size: e.height(),
                        startAngle: (-Math.PI / 4) * 2,
                        emptyFill: "rgba(13, 205, 148, 0.5)",
                        lineCap: "round",
                    });
                }),
            o(".chart-circle-warning").length &&
                o(".chart-circle-warning").each(function () {
                    var e = o(this);
                    e.circleProgress({
                        fill: { color: e.attr("data-color") },
                        size: e.height(),
                        startAngle: (-Math.PI / 4) * 2,
                        emptyFill: "rgba(247, 40, 74, 0.4)",
                        lineCap: "round",
                    });
                }),
            o(".chart-circle-danger").length &&
                o(".chart-circle-danger").each(function () {
                    var e = o(this);
                    e.circleProgress({
                        fill: { color: e.attr("data-color") },
                        size: e.height(),
                        startAngle: (-Math.PI / 4) * 2,
                        emptyFill: "rgba(247, 40, 74, 0.4)",
                        lineCap: "round",
                    });
                }),
            o(document).on("click", "[data-toggle='search']", function (e) {
                var r = o("body");
                r.hasClass("search-gone")
                    ? (r.addClass("search-gone"), r.removeClass("search-show"))
                    : (r.removeClass("search-gone"), r.addClass("search-show"));
            });
        var r = function () {
            o(window).outerWidth() <= 1024
                ? (o("body").addClass("sidebar-gone"),
                  o(document)
                      .off("click", "body")
                      .on("click", "body", function (e) {
                          (o(e.target).hasClass("sidebar-show") ||
                              o(e.target).hasClass("search-show")) &&
                              (o("body").removeClass("sidebar-show"),
                              o("body").addClass("sidebar-gone"),
                              o("body").removeClass("search-show"));
                      }))
                : o("body").removeClass("sidebar-gone");
        };
        r(), o(window).resize(r);
        var a = "div.card";
        o('[data-toggle="card-remove"]').on("click", function (e) {
            return o(this).closest(a).remove(), e.preventDefault(), !1;
        }),
            o('[data-toggle="card-collapse"]').on("click", function (e) {
                return (
                    o(this).closest(a).toggleClass("card-collapsed"),
                    e.preventDefault(),
                    !1
                );
            }),
            o('[data-toggle="card-fullscreen"]').on("click", function (e) {
                return (
                    o(this)
                        .closest(a)
                        .toggleClass("card-fullscreen")
                        .removeClass("card-collapsed"),
                    e.preventDefault(),
                    !1
                );
            }),
            o(document).on("change", ".file-browserinput", function () {
                var e = o(this),
                    r = e.get(0).files ? e.get(0).files.length : 1,
                    a = e.val().replace(/\\/g, "/").replace(/.*\//, "");
                e.trigger("fileselect", [r, a]);
            }),
            o(".file-browserinput").on("fileselect", function (e, r, a) {
                var l = o(this).parents(".input-group").find(":text"),
                    t = r > 1 ? r + " files selected" : a;
                l.length ? l.val(t) : t;
            }),
            o(".thumb").on("click", function () {
                o(this).hasClass("active") ||
                    (o(".thumb.active").removeClass("active"),
                    o(this).addClass("active"));
            }),
            o("#background-left1").on("click", function () {
                return (
                    o("body").addClass("light-mode"),
                    o("body").removeClass("gradient-hormenu"),
                    o("body").removeClass("dark-mode"),
                    o("body").removeClass("color-header"),
                    o("body").removeClass("dark-header"),
                    o("body").removeClass("dark-menu"),
                    o("body").removeClass("gradient-menu"),
                    o("body").removeClass("gradient-header"),
                    o("body").removeClass("color-menu"),
                    !1
                );
            }),
            o("#background-left2").on("click", function () {
                return (
                    o("body").addClass("dark-mode"),
                    o("body").removeClass("light-mode"),
                    o("body").removeClass("light-menu"),
                    o("body").removeClass("color-menu"),
                    o("body").removeClass("dark-header"),
                    o("body").removeClass("color-header"),
                    o("body").removeClass("light-header"),
                    o("body").removeClass("dark-menu"),
                    o("body").removeClass("light-hormenu"),
                    o("body").removeClass("gradient-hormenu"),
                    o("body").removeClass("gradient-menu"),
                    !1
                );
            }),
            o("#background1").on("click", function () {
                return (
                    o("body").addClass("light-header"),
                    o("body").removeClass("color-header"),
                    o("body").removeClass("dark-header"),
                    o("body").removeClass("gradient-header"),
                    !1
                );
            }),
            o("#background2").on("click", function () {
                return (
                    o("body").addClass("color-header"),
                    o("body").removeClass("light-header"),
                    o("body").removeClass("dark-header"),
                    o("body").removeClass("gradient-header"),
                    !1
                );
            }),
            o("#background3").on("click", function () {
                return (
                    o("body").addClass("dark-header"),
                    o("body").removeClass("color-header"),
                    o("body").removeClass("light-header"),
                    o("body").removeClass("gradient-header"),
                    !1
                );
            }),
            o("#background11").on("click", function () {
                return (
                    o("body").addClass("gradient-header"),
                    o("body").removeClass("dark-header"),
                    o("body").removeClass("color-header"),
                    o("body").removeClass("light-header"),
                    !1
                );
            }),
            o("#background4").on("click", function () {
                return (
                    o("body").addClass("light-menu"),
                    o("body").removeClass("color-menu"),
                    o("body").removeClass("dark-menu"),
                    o("body").removeClass("gradient-menu"),
                    o("body").removeClass("light-hormenu"),
                    o("body").removeClass("dark-hormenu"),
                    o("body").removeClass("color-hormenu"),
                    !1
                );
            }),
            o("#background5").on("click", function () {
                return (
                    o("body").addClass("color-menu"),
                    o("body").removeClass("light-menu"),
                    o("body").removeClass("dark-menu"),
                    o("body").removeClass("gradient-menu"),
                    o("body").removeClass("light-hormenu"),
                    o("body").removeClass("dark-hormenu"),
                    o("body").removeClass("color-hormenu"),
                    !1
                );
            }),
            o("#background6").on("click", function () {
                return (
                    o("body").addClass("dark-menu"),
                    o("body").removeClass("color-menu"),
                    o("body").removeClass("light-menu"),
                    o("body").removeClass("gradient-menu"),
                    o("body").removeClass("light-hormenu"),
                    o("body").removeClass("dark-hormenu"),
                    o("body").removeClass("dark-hormenu"),
                    !1
                );
            }),
            o("#background10").on("click", function () {
                return (
                    o("body").addClass("gradient-menu"),
                    o("body").removeClass("color-menu"),
                    o("body").removeClass("light-menu"),
                    o("body").removeClass("dark-menu"),
                    o("body").removeClass("light-hormenu"),
                    o("body").removeClass("dark-hormenu"),
                    o("body").removeClass("dark-hormenu"),
                    !1
                );
            }),
            o("#background7").on("click", function () {
                return (
                    o("body").addClass("light-hormenu"),
                    o("body").removeClass("color-hormenu"),
                    o("body").removeClass("dark-hormenu"),
                    o("body").removeClass("gradient-hormenu"),
                    o("body").removeClass("dark-menu"),
                    o("body").removeClass("color-menu"),
                    o("body").removeClass("light-menu"),
                    o("body").removeClass("gradient-menu"),
                    !1
                );
            }),
            o("#background8").on("click", function () {
                return (
                    o("body").addClass("color-hormenu"),
                    o("body").removeClass("light-hormenu"),
                    o("body").removeClass("dark-hormenu"),
                    o("body").removeClass("gradient-hormenu"),
                    o("body").removeClass("dark-menu"),
                    o("body").removeClass("color-menu"),
                    o("body").removeClass("light-menu"),
                    o("body").removeClass("gradient-menu"),
                    !1
                );
            }),
            o("#background9").on("click", function () {
                return (
                    o("body").addClass("dark-hormenu"),
                    o("body").removeClass("color-hormenu"),
                    o("body").removeClass("light-hormenu"),
                    o("body").removeClass("gradient-hormenu"),
                    o("body").removeClass("dark-menu"),
                    o("body").removeClass("color-menu"),
                    o("body").removeClass("light-menu"),
                    o("body").removeClass("gradient-menu"),
                    !1
                );
            }),
            o("#background13").on("click", function () {
                return (
                    o("body").addClass("gradient-hormenu"),
                    o("body").removeClass("dark-hormenu"),
                    o("body").removeClass("color-hormenu"),
                    o("body").removeClass("light-hormenu"),
                    o("body").removeClass("dark-menu"),
                    o("body").removeClass("color-menu"),
                    o("body").removeClass("light-menu"),
                    o("body").removeClass("gradient-menu"),
                    !1
                );
            });
    })(jQuery);
})();
