!(function (e) {
    function t(o) {
        if (n[o]) return n[o].exports;
        var i = (n[o] = { i: o, l: !1, exports: {} });
        return e[o].call(i.exports, i, i.exports, t), (i.l = !0), i.exports;
    }
    var n = {};
    (t.m = e),
        (t.c = n),
        (t.i = function (e) {
            return e;
        }),
        (t.d = function (e, n, o) {
            t.o(e, n) ||
                Object.defineProperty(e, n, {
                    configurable: !1,
                    enumerable: !0,
                    get: o,
                });
        }),
        (t.n = function (e) {
            var n =
                e && e.__esModule
                    ? function () {
                          return e.default;
                      }
                    : function () {
                          return e;
                      };
            return t.d(n, "a", n), n;
        }),
        (t.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t);
        }),
        (t.p = ""),
        t((t.s = 2));
})([
    function (e, t, n) {
        "use strict";
        function o(e, t) {
            if (!(e instanceof t))
                throw new TypeError("Cannot call a class as a function");
        }
        function i(e) {
            return (
                (e.indexOf(m) > -1 || e.indexOf("veritrans.co.id") > -1) &&
                (e.indexOf("snap.js") > -1 || e.indexOf("snap.min.js") > -1)
            );
        }
        function r() {
            try {
                if (window.performance && window.performance.getEntries) {
                    for (
                        var e = window.performance.getEntries(),
                            t = null,
                            n = 0;
                        n < e.length;
                        n++
                    ) {
                        if (i(e[n].name)) {
                            t = e[n];
                            break;
                        }
                    }
                    if (t) return t.duration;
                }
            } catch (e) {}
            return null;
        }
        function a(e, t, n, o) {
            return function () {
                if (-1 === n.indexOf(k))
                    throw new Error(
                        "snap." +
                            e +
                            " is not allowed to be called in this state. Invalid state transition from " +
                            k +
                            " to " +
                            o
                    );
                var i = t.apply(null, arguments);
                return (k = o), i;
            };
        }
        function s(e) {
            if (e.origin === m) {
                var t = e.data;
                switch (t.event) {
                    case "hide":
                        x.isVisible() && O.onClose && O.onClose(), P.hide();
                        break;
                    case "queryToken":
                        _ &&
                            (x.postMessage({
                                event: "token",
                                token: _,
                                scriptLoadDuration: r(),
                                snapPayStartedAt: E,
                                options: l(O),
                            }),
                            x.show(),
                            (k = v));
                        break;
                    case "deeplink":
                        var n = t.data;
                        n && window.location.replace(n);
                        break;
                    case "result":
                        var o = t.data,
                            i = String(o.status_code);
                        try {
                            !(function () {
                                "200" === i && O.onSuccess
                                    ? O.onSuccess(o)
                                    : "201" === i && O.onPending
                                    ? O.onPending(o)
                                    : -1 === ["200", "201"].indexOf(i) &&
                                      O.onError
                                    ? O.onError(o)
                                    : o.finish_redirect_url &&
                                      (window.location.href =
                                          o.finish_redirect_url);
                            })();
                        } catch (e) {
                            console.error(e);
                        }
                        P.hide();
                        break;
                    case "debug":
                        break;
                    default:
                        throw new Error("Invalid event data: " + t.event);
                }
            }
        }
        function d(e) {
            return function (t, n) {
                var o = void 0 === n ? "undefined" : f(n);
                if (e !== o) throw new Error(t + " should be of type " + e);
                return !0;
            };
        }
        function c(e, t) {
            if (!e) throw new Error(t + " is required");
        }
        function u(e) {
            for (var t in e)
                if (e.hasOwnProperty(t)) {
                    if (!S[t]) throw new Error("Unsupported option " + t);
                    var n = S[t];
                    n(t, e[t]);
                }
        }
        function l(e) {
            var t = {};
            for (var n in e) "function" != typeof e[n] && (t[n] = e[n]);
            return t;
        }
        var f =
                "function" == typeof Symbol &&
                "symbol" == typeof Symbol.iterator
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
                      },
            h = (function () {
                function e(e, t) {
                    for (var n = 0; n < t.length; n++) {
                        var o = t[n];
                        (o.enumerable = o.enumerable || !1),
                            (o.configurable = !0),
                            "value" in o && (o.writable = !0),
                            Object.defineProperty(e, o.key, o);
                    }
                }
                return function (t, n, o) {
                    return n && e(t.prototype, n), o && e(t, o), t;
                };
            })(),
            p = n(1),
            y = (function (e) {
                return e && e.__esModule ? e : { default: e };
            })(p);
        window.location.origin ||
            (window.location.origin =
                window.location.protocol +
                "//" +
                window.location.hostname +
                (window.location.port ? ":" + window.location.port : ""));
        var m = y.default.snap_host,
            w = y.default.root_path,
            b = void 0,
            g = (function () {
                function e(t) {
                    o(this, e);
                    var n =
                            m +
                            w +
                            "/v1/pay?origin_host=" +
                            window.location.origin +
                            "&digest=8ef13150c09b4f25b3e64262a789dccb984c99c01f6bd6ba152a6d20a1010d2c" +
                            (t ? "&client_key=" + t : "") +
                            "#/",
                        i = document.createElement("iframe");
                    (i.src = n),
                        (i.id = "snap-midtrans"),
                        (i.style.cssText =
                            "display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 999999; border: 0;"),
                        (this.pageUrl = n),
                        (this.clientKey = t),
                        (this.iframe = i),
                        (this.attached = !1);
                }
                return (
                    h(
                        e,
                        [
                            {
                                key: "goHome",
                                value: function () {
                                    return (
                                        (this.iframe.src = this.pageUrl),
                                        this.ensureAttached(),
                                        this
                                    );
                                },
                            },
                            {
                                key: "postMessage",
                                value: function (e) {
                                    return (
                                        this.ensureAttached(),
                                        this.iframe.contentWindow.postMessage(
                                            e,
                                            m
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "hide",
                                value: function () {
                                    return (
                                        (this.iframe.style.display = "none"),
                                        e.setParentStyle(!1),
                                        this.goHome(),
                                        this.detach(),
                                        this
                                    );
                                },
                            },
                            {
                                key: "show",
                                value: function () {
                                    return (
                                        this.ensureAttached(),
                                        (this.iframe.style.display = "block"),
                                        e.setParentStyle(!0),
                                        this
                                    );
                                },
                            },
                            {
                                key: "isVisible",
                                value: function () {
                                    return "none" !== this.iframe.style.display;
                                },
                            },
                            {
                                key: "ensureAttached",
                                value: function () {
                                    this.attached || this.attach();
                                },
                            },
                            {
                                key: "attach",
                                value: function () {
                                    this.attached ||
                                        !document.body ||
                                        ("interactive" !==
                                            document.readyState &&
                                            "complete" !==
                                                document.readyState) ||
                                        ((this.iframe.name =
                                            "popup_" + +new Date()),
                                        document.body.appendChild(this.iframe),
                                        (this.attached = !0));
                                },
                            },
                            {
                                key: "detach",
                                value: function () {
                                    this.attached &&
                                        (this.iframe.parentNode.removeChild(
                                            this.iframe
                                        ),
                                        (this.attached = !1));
                                },
                            },
                        ],
                        [
                            {
                                key: "setParentStyle",
                                value: function (t) {
                                    t
                                        ? (b ||
                                              (b = {
                                                  position: e.isMobile()
                                                      ? document.body.style
                                                            .position
                                                      : null,
                                                  overflow:
                                                      document.body.style
                                                          .overflow,
                                                  width:
                                                      document.body.style.width,
                                                  height:
                                                      document.body.style
                                                          .height,
                                                  pageXOffset:
                                                      window.pageXOffset,
                                                  pageYOffset:
                                                      window.pageYOffset,
                                              }),
                                          (document.body.style.overflow =
                                              "hidden"),
                                          (document.body.style.width = "100vw"),
                                          (document.body.style.height =
                                              "100vh"),
                                          e.isMobile() &&
                                              (document.body.style.position =
                                                  "fixed"),
                                          window.scroll(0, 0))
                                        : b &&
                                          (e.isMobile() &&
                                              (document.body.style.position =
                                                  b.position),
                                          (document.body.style.overflow =
                                              b.overflow),
                                          (document.body.style.width = b.width),
                                          (document.body.style.height =
                                              b.height),
                                          window.scroll(
                                              b.pageXOffset,
                                              b.pageYOffset
                                          ));
                                },
                            },
                            {
                                key: "isMobile",
                                value: function () {
                                    return window.innerWidth < 568;
                                },
                            },
                        ]
                    ),
                    e
                );
            })(),
            v = "PopupInView",
            k = "unInitialized",
            x = void 0,
            _ = void 0,
            E = void 0,
            O = {},
            S = {
                onSuccess: d("function"),
                onPending: d("function"),
                onError: d("function"),
                onClose: d("function"),
                skipOrderSummary: d("boolean"),
                autoCloseDelay: d("number"),
                language: d("string"),
                enabledPayments: (function (e) {
                    return function (t, n) {
                        if (
                            "[object Array]" !==
                            Object.prototype.toString.call(n)
                        )
                            throw new Error(t + " should be an array of " + e);
                        return (
                            n.forEach(function (n) {
                                var o = void 0 === n ? "undefined" : f(n);
                                if (e !== o)
                                    throw new Error(
                                        t + " should be an array of " + e
                                    );
                            }),
                            !0
                        );
                    };
                })("string"),
                skipCustomerDetails: d("boolean"),
                showOrderId: d("boolean"),
                isDemoMode: d("boolean"),
                creditCardNumber: d("string"),
                creditCardCvv: d("string"),
                creditCardExpiry: d("string"),
                customerEmail: d("string"),
                customerPhone: d("string"),
                uiMode: d("string"),
                gopayMode: d("string"),
                selectedPaymentType: d("string"),
            },
            P = {
                show: a(
                    "show",
                    function () {
                        x.show();
                    },
                    ["initialized"],
                    "loading"
                ),
                hide: a(
                    "hide",
                    function () {
                        x.hide(), (_ = null);
                    },
                    ["initialized", "loading", v],
                    "initialized"
                ),
                init: a(
                    "init",
                    function (e) {
                        e ||
                            console.log(
                                'Please add `data-client-key` attribute in the script tag <script type="text/javascript" src="...snap.js" data-client-key="CLIENT-KEY"></script>, Otherwise custom UI confirguration will not take effect'
                            ),
                            (x = new g(e)),
                            x.attach(),
                            window.addEventListener("message", s, !1);
                    },
                    ["unInitialized"],
                    "initialized"
                ),
                pay: a(
                    "pay",
                    function (e, t) {
                        c(e, "snapToken"),
                            (O = t || {}),
                            u(O),
                            (_ = e),
                            (E = +new Date()),
                            x.attach(),
                            x.attached &&
                                x.goHome().postMessage({ event: "notify" });
                    },
                    ["initialized", "loading"],
                    v
                ),
                reset: a(
                    "reset",
                    function () {
                        x && (x.detach(), (x = null)),
                            window.removeEventListener("message", s, !1),
                            (b = void 0),
                            (_ = null);
                    },
                    ["initialized", "unInitialized", "loading", v],
                    "unInitialized"
                ),
            },
            M = (function () {
                for (
                    var e = void 0,
                        t = document.getElementsByTagName("script"),
                        n = 0;
                    n < t.length;
                    n++
                ) {
                    i(t[n].src) && (e = t[n]);
                }
                return e;
            })(),
            C = (M && M.getAttribute("data-client-key")) || "";
        P.init(C),
            (function e() {
                "complete" === document.readyState
                    ? x && x.attach()
                    : setTimeout(e, 100);
            })(),
            (window.snap = P);
    },
    function (e, t) {
        e.exports = {
            snap_host: "https://app.sandbox.midtrans.com",
            root_path: "/snap",
            asset_host: "//d2f3dnusg0rbp7.cloudfront.net",
            asset_path: "/assets",
            environment: "sandbox",
            promo_host: "https://promo.vt-stage.info",
            raygun_api_key: "Elr5MsaP91+6UWD8Z+HLhA==",
            mixpanel_key: "41b784256aa44031eefbc3cbf61dcabc",
            free_mixpanel_key: "4e3a8e10cb012c970cfc8b6d94abc570",
            papi_host: "https://api.sandbox.midtrans.com",
            exbin_host: "https://api.sandbox.midtrans.com",
        };
    },
    function (e, t, n) {
        e.exports = n(0);
    },
]);
