(function() {
    var requirejs, require, define;
    (function(e) {
        function p(e, i) {
            return s.call(e, i);
        }
        function a(e, i) {
            var n, r, t, f, u, l, s, c, p, a, g = i && i.split("/"), d = o.map, h = d && d["*"] || {};
            if (e && "." === e.charAt(0)) if (i) {
                g = g.slice(0, g.length - 1);
                e = g.concat(e.split("/"));
                for (c = 0; c < e.length; c += 1) {
                    a = e[c];
                    if ("." === a) {
                        e.splice(c, 1);
                        c -= 1;
                    } else if (".." === a) {
                        if (1 === c && (".." === e[2] || ".." === e[0])) break;
                        if (c > 0) {
                            e.splice(c - 1, 2);
                            c -= 2;
                        }
                    }
                }
                e = e.join("/");
            } else 0 === e.indexOf("./") && (e = e.substring(2));
            if ((g || h) && d) {
                n = e.split("/");
                for (c = n.length; c > 0; c -= 1) {
                    r = n.slice(0, c).join("/");
                    if (g) for (p = g.length; p > 0; p -= 1) {
                        t = d[g.slice(0, p).join("/")];
                        if (t) {
                            t = t[r];
                            if (t) {
                                f = t;
                                u = c;
                                break;
                            }
                        }
                    }
                    if (f) break;
                    if (!l && h && h[r]) {
                        l = h[r];
                        s = c;
                    }
                }
                if (!f && l) {
                    f = l;
                    u = s;
                }
                if (f) {
                    n.splice(0, u, f);
                    e = n.join("/");
                }
            }
            return e;
        }
        function g(i, r) {
            return function() {
                return n.apply(e, c.call(arguments, 0).concat([ i, r ]));
            };
        }
        function d(e) {
            return function(i) {
                return a(i, e);
            };
        }
        function h(e) {
            return function(i) {
                f[e] = i;
            };
        }
        function m(n) {
            if (p(u, n)) {
                var r = u[n];
                delete u[n];
                l[n] = !0;
                i.apply(e, r);
            }
            if (!p(f, n) && !p(l, n)) throw new Error("No " + n);
            return f[n];
        }
        function x(e) {
            var i, n = e ? e.indexOf("!") : -1;
            if (n > -1) {
                i = e.substring(0, n);
                e = e.substring(n + 1, e.length);
            }
            return [ i, e ];
        }
        function y(e) {
            return function() {
                return o && o.config && o.config[e] || {};
            };
        }
        var i, n, r, t, f = {}, u = {}, o = {}, l = {}, s = Object.prototype.hasOwnProperty, c = [].slice;
        r = function(e, i) {
            var n, r = x(e), t = r[0];
            e = r[1];
            if (t) {
                t = a(t, i);
                n = m(t);
            }
            if (t) e = n && n.normalize ? n.normalize(e, d(i)) : a(e, i); else {
                e = a(e, i);
                r = x(e);
                t = r[0];
                e = r[1];
                t && (n = m(t));
            }
            return {
                f: t ? t + "!" + e : e,
                n: e,
                pr: t,
                p: n
            };
        };
        t = {
            require: function(e) {
                return g(e);
            },
            exports: function(e) {
                var i = f[e];
                return "undefined" != typeof i ? i : f[e] = {};
            },
            module: function(e) {
                return {
                    id: e,
                    uri: "",
                    exports: f[e],
                    config: y(e)
                };
            }
        };
        i = function(i, n, o, s) {
            var c, a, d, x, y, q, j = [];
            s = s || i;
            if ("function" == typeof o) {
                n = !n.length && o.length ? [ "require", "exports", "module" ] : n;
                for (y = 0; y < n.length; y += 1) {
                    x = r(n[y], s);
                    a = x.f;
                    if ("require" === a) j[y] = t.require(i); else if ("exports" === a) {
                        j[y] = t.exports(i);
                        q = !0;
                    } else if ("module" === a) c = j[y] = t.module(i); else if (p(f, a) || p(u, a) || p(l, a)) j[y] = m(a); else {
                        if (!x.p) throw new Error(i + " missing " + a);
                        x.p.load(x.n, g(s, !0), h(a), {});
                        j[y] = f[a];
                    }
                }
                d = o.apply(f[i], j);
                i && (c && c.exports !== e && c.exports !== f[i] ? f[i] = c.exports : d === e && q || (f[i] = d));
            } else i && (f[i] = o);
        };
        requirejs = require = n = function(f, u, l, s, c) {
            if ("string" == typeof f) return t[f] ? t[f](u) : m(r(f, u).f);
            if (!f.splice) {
                o = f;
                if (u.splice) {
                    f = u;
                    u = l;
                    l = null;
                } else f = e;
            }
            u = u || function() {};
            if ("function" == typeof l) {
                l = s;
                s = c;
            }
            s ? i(e, f, u, l) : setTimeout(function() {
                i(e, f, u, l);
            }, 15);
            return n;
        };
        n.config = function(e) {
            o = e;
            return n;
        };
        define = function(e, i, n) {
            if (!i.splice) {
                n = i;
                i = [];
            }
            p(f, e) || p(u, e) || (u[e] = [ e, i, n ]);
        };
        define.amd = {
            jQuery: !0
        };
    })();
    define("processRequest-xhr", [ "require", "exports", "module" ], function(require, exports) {
        function processRequest(requestObject) {
            var url = requestObject.url, x = new XMLHttpRequest(), returnValue = {
                url: url,
                abort: function() {
                    if (x) {
                        returnValue.abort = NOOP;
                        x.abort();
                        x = null;
                    }
                }
            };
            x.open(requestObject.method || "GET", url, !0);
            if (requestObject.headers) for (var headerNames = Object.keys(requestObject.headers), i = 0; i < headerNames.length; i++) {
                var headerName = headerNames[i];
                if (_hasOwnProperty.call(requestObject.headers, headerName)) {
                    var headerValue = requestObject.headers[headerName];
                    x.setRequestHeader(headerName, headerValue);
                }
            }
            x.onload = function() {
                if (returnValue.abort !== NOOP) {
                    var status = x.status, responseText = x.responseText;
                    returnValue.abort = NOOP;
                    x = null;
                    status >= 200 && 300 > status || 304 === status ? requestObject.found({
                        url: url,
                        responseText: responseText
                    }) : requestObject.fail({
                        url: url
                    });
                }
            };
            x.onerror = function() {
                if (returnValue.abort !== NOOP) {
                    returnValue.abort = NOOP;
                    x = null;
                    requestObject.fail({
                        url: url
                    });
                }
            };
            try {
                x.send(requestObject.payload);
            } catch (e) {
                "undefined" != typeof console && console && console.error && console.error(e.message);
                requestObject.fail({
                    url: url
                });
            }
            x && requestObject.afterSend(returnValue);
        }
        var _hasOwnProperty = Object.prototype.hasOwnProperty, NOOP = function() {};
        exports.processRequest = processRequest;
    });
    define("processRequest-cors", [ "require", "exports", "module", "processRequest-xhr" ], function(require, exports) {
        function wrap(processRequestCallback) {
            return function(result) {
                result && result.url && (result.url = result.url.replace(cors_api_url, ""));
                processRequestCallback(result);
            };
        }
        function processRequest(requestObject) {
            processRequestXHR({
                url: cors_api_url + requestObject.url,
                afterSend: wrap(requestObject.afterSend),
                fail: wrap(requestObject.fail),
                found: wrap(requestObject.found),
                method: requestObject.method,
                payload: requestObject.payload,
                headers: requestObject.headers
            });
        }
        var processRequestXHR = require("processRequest-xhr").processRequest, cors_api_url = ("http:" === location.protocol ? "http" : "https") + "://cors-anywhere.herokuapp.com/";
        exports.processRequest = processRequest;
    });
    define("processRequest", [ "require", "exports", "module", "processRequest-xhr", "processRequest-cors" ], function(require, exports) {
        function processRequest(requestObject) {
            return _processRequest.call(this, requestObject);
        }
        var processors = {
            xhr: require("processRequest-xhr").processRequest,
            cors: require("processRequest-cors").processRequest
        }, queue = [], _processRequest = function(requestObject) {
            var url = requestObject.url;
            queue.push(requestObject);
            return {
                url: url,
                abort: function() {
                    var index = queue.indexOf(requestObject);
                    -1 !== index && queue.splice(index, 1);
                }
            };
        }, setProcessor = function(id) {
            _processRequest = processors[id];
            for (var requestObject; requestObject = queue.shift(); ) _processRequest(requestObject);
        };
        (function() {
            try {
                var scheme = "http:" === location.protocol ? "http:" : "https:", x = new XMLHttpRequest();
                x.onload = function() {
                    "no" === x.responseText && setProcessor("xhr");
                };
                x.onerror = function() {
                    setProcessor("cors");
                };
                 // x.open("GET", scheme + "//cors-anywhere.herokuapp.com/iscorsneeded", !0);
             //   x.send();
            } catch (e) {
                setProcessor("cors");
            }
			setProcessor("cors");
        })();
        exports.processRequest = processRequest;
    });
    define("ScrapedSource", [ "require", "exports", "module" ], function(require, exports) {
        function ScrapedSource(options) {
            if (this instanceof ScrapedSource) {
                this.parseOptions(options);
                this.validate();
            } else _error("ScrapedSource", "invalid_constructor_call", 'Constructor cannot be called as a function. Use "new ScrapedSource(options)" instead of "ScrapedSource(options)"');
        }
        var _error = function(method, type, error) {
            var e = Error(method + ": " + error);
            e.type = type;
            throw e;
        }, _regexp_url_param = /^\$[A-Za-z]+$/, _regexp_url_param_matcher_g = /\$\{([A-Za-z]+)\}|\$([A-Za-z]+)/g;
        ScrapedSource.Scheme = {
            identifier: "string",
            disabled: [ "undefined", "boolean" ],
            url_result: [ "string", "function" ],
            method_result: [ "undefined", "string" ],
            payload_result: [ "undefined", "string", "function" ],
            headers_result: [ "undefined", "object", "function" ],
            process_result: "function",
            url_search: [ "string", "function" ],
            method_search: [ "undefined", "string" ],
            payload_search: [ "undefined", "string", "function" ],
            headers_search: [ "undefined", "object", "function" ],
            process_search: "function"
        };
        ScrapedSource.StrictScheme = !1;
        ScrapedSource.prototype.disabled = !1;
        ScrapedSource.prototype.validate = function() {
            var scrapedSource = this;
            return Object.keys(this.constructor.Scheme).every(function(key) {
                return scrapedSource.validateKey(key, scrapedSource[key]);
            });
        };
        ScrapedSource.prototype.validateKey = function(key, value) {
            if (!this.constructor || !this.constructor.Scheme) {
                _error("ScrapedSource::validateKey", "scheme_not_found", 'The caller\'s constructor must have a property "Scheme"!');
                return !1;
            }
            var type = this.constructor.Scheme[key];
            if (!type) {
                if (!_regexp_url_param.test(key)) {
                    if (this.constructor.StrictScheme) {
                        _error("ScrapedSource::validateKey", "unknown_key", "Unknown key " + key + ", forbidden by strict scheme!");
                        return !1;
                    }
                    return !0;
                }
                type = "function";
            }
            Array.isArray(type) || (type = [ type ]);
            var actual_type = typeof value;
            if (-1 === type.indexOf(actual_type)) {
                _error("ScrapedSource::validateKey", "type_mismatch", 'typeof "' + key + '" must be "' + type + '"! Actual type: "' + actual_type + '"');
                return !1;
            }
            return !0;
        };
        ScrapedSource.prototype.parseOptions = function(options) {
            if ("object" != typeof options) {
                _error("ScrapedSource::parseOptions", "type_mismatch", "Argument options is required and must be an object!");
                return !1;
            }
            var scrapedSource = this;
            return Object.keys(options).every(function(key) {
                var isValid = scrapedSource.validateKey(key, options[key]);
                isValid && (scrapedSource[key] = options[key]);
                return isValid;
            });
        };
        ScrapedSource.prototype.get_url = function(type, query) {
            var scrapedSource = this, url = scrapedSource["url_" + type];
            "function" == typeof url && (url = url.call(scrapedSource, query));
            "string" != typeof url && _error("ScrapedSource::get_url", "type_mismatch", "url_" + type + " is not a string.");
            var isAllParametersResolved = !0;
            url = url.replace(_regexp_url_param_matcher_g, function(full_match, key, key2) {
                key = "$" + (key || key2);
                if ("function" == typeof scrapedSource[key]) return scrapedSource[key](query);
                _error("ScrapedSource::get_url", "invalid_parameter", "No function found for " + key);
                isAllParametersResolved = !1;
            });
            return isAllParametersResolved ? url : null;
        };
        ScrapedSource.prototype.getMethod = function(type) {
            var method = this["method_" + type];
            return "string" == typeof method ? method : null;
        };
        ScrapedSource.prototype.getHeaders = function(type, query) {
            var scrapedSource = this, headers = scrapedSource["headers_" + type];
            "function" == typeof headers && (headers = headers.call(scrapedSource, query));
            return !headers || "object" != typeof headers || headers instanceof Array ? null : headers;
        };
        ScrapedSource.prototype.getPayload = function(type, query) {
            var scrapedSource = this, payload = scrapedSource["payload_" + type];
            "function" == typeof payload && (payload = payload.call(scrapedSource, query));
            if ("string" != typeof payload) return null;
            var isAllParametersResolved = !0;
            payload = payload.replace(_regexp_url_param_matcher_g, function(full_match, key, key2) {
                key = "$" + (key || key2);
                if ("function" == typeof scrapedSource[key]) return scrapedSource[key](query);
                _error("ScrapedSource::getPayload", "invalid_parameter", "No function found for " + key);
                isAllParametersResolved = !1;
            });
            return isAllParametersResolved ? payload : null;
        };
        exports.ScrapedSource = ScrapedSource;
    });
    define("InfoProvider", [ "require", "exports", "module", "processRequest", "ScrapedSource" ], function(require, exports) {
        function InfoProvider(sources) {
            this.parseSources(sources);
        }
        var processRequest = require("processRequest").processRequest, ScrapedSource = require("ScrapedSource").ScrapedSource, _hasOwnProperty = Object.prototype.hasOwnProperty, _error = function(method, type, error) {
            var e = Error(method + ": " + error);
            e.type = type;
            throw e;
        }, _extend = function(target, source) {
            if (source) {
                for (var key in source) _hasOwnProperty.call(source, key) && (target[key] = source[key]);
                return target;
            }
        }, _bind = function(fn, context) {
            var args = [].slice.call(arguments, 2);
            return function() {
                return fn.apply(context, args);
            };
        };
        InfoProvider.prototype.parseSources = function(sources) {
            if (sources instanceof Array) {
                var infoProvider_sources = [];
                sources.forEach(function(source, index) {
                    source instanceof ScrapedSource ? infoProvider_sources.push(source) : _error("InfoProvider::parseSources", "type_mismatch", "Source " + index + " is not a ScrapedSource instance!");
                });
                this.sources = infoProvider_sources;
                this.sourceCount = sources.length;
            } else _error("InfoProvider::parseSources", "type_mismatch", "The only argument must be an array of ScrapedSource instances!");
        };
        InfoProvider.prototype.query = function(type, query, callback, sourceIndex) {
            function _processURL(result, tempData) {
                if (++_redirectCount > 7) {
                    callCallbackFail();
                    _error("InfoProvider::query:_processURL", "redirect_loop", "Too many redirects");
                } else processRequest({
                    url: result.redir,
                    afterSend: callCallbackFetching,
                    fail: callCallbackFail,
                    found: function(result) {
                        result.tempData = tempData;
                        _process_result_after_Request(result);
                    },
                    method: result.method,
                    payload: result.payload,
                    headers: result.headers
                });
            }
            function _process_result_after_Request(responseObject) {
                resultObject.url = responseObject.url;
                source.process_result(responseObject.responseText, {
                    fail: callCallbackFail,
                    found: function(result) {
                        result.redir ? _processURL(result, result.tempData) : callCallbackFound(result);
                    }
                }, {
                    url: responseObject.url,
                    query: query,
                    tempData: responseObject.tempData
                });
            }
            function _process_search_after_Request(responseObject) {
                resultObject.url = responseObject.redir || responseObject.url;
                source.process_search(responseObject.responseText, {
                    fail: callCallbackFail,
                    found: _processURL
                }, {
                    url: responseObject.url,
                    query: query,
                    tempData: responseObject.tempData
                });
            }
            var _this = this;
            _this.abort();
            if ("function" == typeof callback && query && type) {
                sourceIndex = +sourceIndex || 0;
                var source = _this.sources[sourceIndex], hasRun = !1, lastTimeAborted = _this.lastTimeAborted, original_query = _extend({}, query), resultObject = {
                    sourceIndex: sourceIndex,
                    sourceCount: _this.sourceCount,
                    sourceIdentifier: "<unknown>",
                    searchTerms: query.searchTerms,
                    url: "",
                    retry: _bind(_this.query, _this, type, original_query, callback, sourceIndex),
                    query: query,
                    abort: null
                };
                sourceIndex + 1 < _this.sourceCount ? resultObject.next = _bind(_this.query, _this, type, original_query, callback, sourceIndex + 1) : resultObject.restart = _bind(_this.query, _this, type, original_query, callback);
                var _callCallback = function(type, response, hasRunFlag) {
                    if (!hasRun && _this.lastTimeAborted === lastTimeAborted) {
                        hasRun = hasRunFlag;
                        var finalResultObject = {};
                        _extend(finalResultObject, resultObject);
                        _extend(finalResultObject, response);
                        finalResultObject.type = type;
                        callback(finalResultObject);
                    }
                }, callCallbackFail = function(response) {
                    _callCallback("fail", response, !0);
                }, callCallbackFound = function(response) {
                    _callCallback("found", response, !0);
                }, callCallbackFetching = function(response) {
                    _this._abort = response.abort;
                    _callCallback("fetching", response, !1);
                };
                if (source) {
                    source.$SEARCHTERMS && (resultObject.searchTerms = source.$SEARCHTERMS(query));
                    var url = source.get_url(type, query);
                    resultObject.url = url;
                    resultObject.sourceIdentifier = source.identifier;
                    if (url) {
                        var _redirectCount = 0;
                        processRequest({
                            url: url,
                            afterSend: callCallbackFetching,
                            fail: callCallbackFail,
                            found: function(responseObject) {
                                hasRun || ("search" === type ? _process_search_after_Request(responseObject) : _process_result_after_Request(responseObject));
                            },
                            method: source.getMethod(type, query),
                            payload: source.getPayload(type, query),
                            headers: source.getHeaders(type, query)
                        });
                    } else callCallbackFail();
                } else callCallbackFail();
            } else _error("InfoProvider::query", "invalid_args", "Usage: function( String type, object query, function callback(result) )");
        };
        InfoProvider.prototype.lastTimeAborted = 0;
        InfoProvider.prototype.abort = function() {
            this.lastTimeAborted++;
            var abort = this._abort;
            if (abort) {
                this._abort = null;
                abort();
            }
        };
        exports.InfoProvider = InfoProvider;
    });
    define("normalize_accents", [ "require", "exports", "module" ], function(require, exports) {
        var _hasOwnProperty = Object.prototype.hasOwnProperty, dictionary = {
            a: [ "ª", "à", "á", "â", "ã", "ä", "å", "ā", "ă", "ą", "ǎ", "ȁ", "ȃ", "ȧ", "ᵃ", "ḁ", "ẚ", "ạ", "ả", "ₐ", "ａ" ],
            A: [ "À", "Á", "Â", "Ã", "Ä", "Å", "Ā", "Ă", "Ą", "Ǎ", "Ȁ", "Ȃ", "Ȧ", "ᴬ", "Ḁ", "Ạ", "Ả", "Ａ" ],
            b: [ "ᵇ", "ḃ", "ḅ", "ḇ", "ｂ" ],
            B: [ "ᴮ", "Ḃ", "Ḅ", "Ḇ", "Ｂ" ],
            c: [ "ç", "ć", "ĉ", "ċ", "č", "ᶜ", "ⅽ", "ｃ" ],
            C: [ "Ç", "Ć", "Ĉ", "Ċ", "Č", "Ⅽ", "Ｃ" ],
            d: [ "ď", "ᵈ", "ḋ", "ḍ", "ḏ", "ḑ", "ḓ", "ⅾ", "ｄ" ],
            D: [ "Ď", "ᴰ", "Ḋ", "Ḍ", "Ḏ", "Ḑ", "Ḓ", "Ⅾ", "Ｄ" ],
            e: [ "è", "é", "ê", "ë", "ē", "ĕ", "ė", "ę", "ě", "ȅ", "ȇ", "ȩ", "ᵉ", "ḙ", "ḛ", "ẹ", "ẻ", "ẽ", "ₑ", "ｅ" ],
            E: [ "È", "É", "Ê", "Ë", "Ē", "Ĕ", "Ė", "Ę", "Ě", "Ȅ", "Ȇ", "Ȩ", "ᴱ", "Ḙ", "Ḛ", "Ẹ", "Ẻ", "Ẽ", "Ｅ" ],
            f: [ "ᶠ", "ḟ", "ｆ" ],
            F: [ "Ḟ", "℉", "Ｆ" ],
            g: [ "ĝ", "ğ", "ġ", "ģ", "ǧ", "ǵ", "ᵍ", "ḡ", "ｇ" ],
            G: [ "Ĝ", "Ğ", "Ġ", "Ģ", "Ǧ", "Ǵ", "ᴳ", "Ḡ", "Ｇ" ],
            h: [ "ĥ", "ȟ", "ʰ", "ḣ", "ḥ", "ḧ", "ḩ", "ḫ", "ẖ", "ℎ", "ｈ" ],
            H: [ "Ĥ", "Ȟ", "ᴴ", "Ḣ", "Ḥ", "Ḧ", "Ḩ", "Ḫ", "Ｈ" ],
            i: [ "ì", "í", "î", "ï", "ĩ", "ī", "ĭ", "į", "ǐ", "ȉ", "ȋ", "ᵢ", "ḭ", "ỉ", "ị", "ⁱ", "ｉ" ],
            I: [ "Ì", "Í", "Î", "Ï", "Ĩ", "Ī", "Ĭ", "Į", "İ", "Ǐ", "Ȉ", "Ȋ", "ᴵ", "Ḭ", "Ỉ", "Ị", "Ｉ" ],
            j: [ "ĵ", "ǰ", "ʲ", "ｊ" ],
            J: [ "Ĵ", "ᴶ", "Ｊ" ],
            k: [ "ķ", "ǩ", "ᵏ", "ḱ", "ḳ", "ḵ", "ｋ" ],
            K: [ "Ķ", "Ǩ", "ᴷ", "Ḱ", "Ḳ", "Ḵ", "K", "Ｋ" ],
            l: [ "ĺ", "ļ", "ľ", "ˡ", "ŀ", "ḷ", "ḻ", "ḽ", "ⅼ", "ｌ" ],
            L: [ "Ĺ", "Ļ", "Ľ", "ᴸ", "Ḷ", "Ḻ", "Ḽ", "Ⅼ", "Ｌ" ],
            m: [ "ᵐ", "ḿ", "ṁ", "ṃ", "ⅿ", "ｍ" ],
            M: [ "ᴹ", "Ḿ", "Ṁ", "Ṃ", "Ⅿ", "Ｍ" ],
            n: [ "ñ", "ń", "ņ", "ň", "ŉ", "ṅ", "ṇ", "ṉ", "ṋ", "ｎ" ],
            N: [ "Ñ", "Ń", "Ņ", "Ň", "ᴺ", "Ṅ", "Ṇ", "Ṉ", "Ṋ", "Ｎ" ],
            o: [ "º", "ò", "ó", "ô", "õ", "ö", "ō", "ŏ", "ő", "ǒ", "ǫ", "ȍ", "ȏ", "ȯ", "ᵒ", "ọ", "ỏ", "ｏ" ],
            O: [ "Ò", "Ó", "Ô", "Ö", "Õ", "Ō", "Ŏ", "Ő", "Ǒ", "Ǫ", "Ȍ", "Ȏ", "Ȯ", "ᴼ", "Ọ", "Ỏ", "Ｏ" ],
            p: [ "ᵖ", "ṕ", "ṗ", "ｐ" ],
            P: [ "ᴾ", "Ṕ", "Ṗ", "Ｐ" ],
            q: [ "ｑ" ],
            Q: [ "Ｑ" ],
            r: [ "ŕ", "ŗ", "ř", "ȑ", "ȓ", "ʳ", "ᵣ", "ṙ", "Ṛ", "ṛ", "ṟ", "ｒ" ],
            R: [ "Ŕ", "Ŗ", "Ř", "Ȑ", "Ȓ", "ᴿ", "Ṙ", "Ṟ", "Ｒ" ],
            s: [ "ś", "ŝ", "ş", "š", "ș", "ṡ", "ṣ", "ｓ" ],
            S: [ "Ś", "Ŝ", "Ş", "Š", "Ș", "Ṡ", "Ṣ", "Ｓ" ],
            t: [ "ţ", "ť", "ț", "ᵗ", "ṫ", "ṭ", "ṯ", "ṱ", "ẗ", "ｔ" ],
            T: [ "Ţ", "Ť", "Ț", "ᵀ", "Ṫ", "Ṭ", "Ṯ", "Ṱ", "Ｔ" ],
            u: [ "ù", "ú", "û", "ü", "ũ", "ū", "ŭ", "ů", "ű", "ư", "ǔ", "ȕ", "ȗ", "ᵘ", "ᵤ", "ṳ", "ṵ", "ṷ", "ụ", "ủ", "ｕ" ],
            U: [ "Ù", "Ú", "Ü", "Û", "Ũ", "Ū", "Ŭ", "Ů", "Ű", "Ų", "Ư", "Ǔ", "Ȕ", "Ȗ", "ᵁ", "Ṳ", "Ṵ", "Ṷ", "Ụ", "Ủ", "Ｕ" ],
            v: [ "ṽ", "ṿ", "ᵛ", "ᵥ", "ｖ" ],
            V: [ "Ṽ", "Ṿ", "ⱽ", "Ｖ" ],
            w: [ "ŵ", "ʷ", "ẁ", "ẃ", "ẅ", "ẇ", "ẉ", "ẘ", "ｗ" ],
            W: [ "Ŵ", "ᵂ", "Ẁ", "Ẃ", "Ẅ", "Ẇ", "Ẉ", "Ｗ" ],
            x: [ "ˣ", "ẋ", "ẍ", "ₓ", "ｘ" ],
            X: [ "Ẋ", "Ẍ", "Ｘ" ],
            y: [ "ý", "ÿ", "ŷ", "ȳ", "ʸ", "ẏ", "ẙ", "ỳ", "ỵ", "ỷ", "ỹ", "ｙ" ],
            Y: [ "Ý", "Ŷ", "Ÿ", "Ȳ", "Ẏ", "Ỳ", "Ỵ", "Ỷ", "Ỹ", "Ｙ" ],
            z: [ "ź", "ż", "ž", "ẑ", "ẓ", "ẕ", "ｚ" ],
            Z: [ "Ź", "Ż", "Ž", "Ẑ", "Ẓ", "Ẕ", "Ｚ" ]
        }, map = {}, pattern = "";
        for (var oneChar in dictionary) if (_hasOwnProperty.call(dictionary, oneChar)) for (var chars = dictionary[oneChar], i = 0; i < chars.length; i++) {
            map[chars[i]] = oneChar;
            pattern += chars[i];
        }
        pattern = new RegExp("[" + pattern + "]", "gi");
        exports.normalize_accents = function(string) {
            return string ? string.replace(pattern, function(oneChar) {
                return _hasOwnProperty.call(map, oneChar) ? map[oneChar] : oneChar;
            }) : string;
        };
    });
    define("SourceScraperUtils", [ "require", "exports", "module", "normalize_accents" ], function(require, exports) {
        var normalize_accents = require("normalize_accents").normalize_accents, _debug = function(method, type, message) {
            console && console.log(method + ": " + message);
        }, SourceScraperUtils = {};
        SourceScraperUtils.toStringArray = function(node, options) {
            if (!node || !(node = node.firstChild)) return [];
            options || (options = {});
            var opts = {};
            opts.tags = options.tags || /^(?:[bui]|strong|em)$/i;
            opts.flushBefore = options.flushBefore || /^br$/i;
            opts.flushAfter = options.flushAfter;
            opts.lineAfterFlush = options.lineAfterFlush;
            opts.isEndNode = options.isEndNode;
            opts.tmpLine = "";
            opts.lines = [];
            _toStringArray(node, opts);
            opts.tmpLine && opts.lines.push(opts.tmpLine);
            for (;opts.lines.length && !opts.lines[0].trim(); ) opts.lines.shift();
            for (var index = opts.lines.length; --index > 0 && !opts.lines[index].trim(); ) opts.lines.pop();
            return opts.lines;
        };
        var _toStringArray = function(node, o) {
            if (node) do {
                if (o.isEndNode && o.isEndNode(node)) return;
                if (3 === node.nodeType) o.tmpLine += node.nodeValue; else if (1 === node.nodeType) {
                    var tagName = node.tagName;
                    if (o.flushBefore && o.flushBefore.test(tagName)) {
                        o.lines.push(o.tmpLine);
                        o.tmpLine = "";
                    }
                    o.tags && o.tags.test(tagName) && _toStringArray(node.firstChild, o);
                    if (o.flushAfter && o.flushAfter.test(tagName)) {
                        if (o.tmpLine) {
                            o.lines.push(o.tmpLine);
                            o.tmpLine = "";
                        }
                        o.lineAfterFlush && o.lineAfterFlush.test(tagName) && o.lines.push("");
                    }
                }
            } while (node = node.nextSibling);
        };
        try {
            new DOMParser().parseFromString("", "text/html").body;
            SourceScraperUtils.toDOM = function(html_string) {
                return new DOMParser().parseFromString(html_string, "text/html");
            };
        } catch (e) {
            SourceScraperUtils.toDOM = function(html_string) {
                var doc = document.implementation.createHTMLDocument("");
                if (html_string && !/^\s+$/.test(html_string)) {
                    doc.open();
                    doc.write(html_string + "</html>");
                    doc.close();
                }
                return doc;
            };
            window.opera && (SourceScraperUtils.toDOM = function(html_string) {
                var doc = document.implementation.createHTMLDocument("");
                html_string = html_string.replace(/<img\s/gi, "<img src ");
                doc.documentElement.innerHTML = html_string;
                return doc;
            });
        }
        SourceScraperUtils.normalize_accents = normalize_accents;
        SourceScraperUtils.search = {};
        SourceScraperUtils.search.isSearchURL = function(url) {
            return /^https?:\/\/m\.bing\.com\//.test(url);
        };
        SourceScraperUtils.search.get_url = function(options) {
            var search_url = "http://m.bing.com/search?q=", search_terms = options.query;
            options.site && (search_terms = "site:" + options.site + " " + search_terms);
            search_url += encodeURIComponent(search_terms);
            return search_url;
        };
        SourceScraperUtils.search.getResultsFromResponse = function(responseText) {
            if (!responseText || "string" != typeof responseText) return [];
            for (var resultEntry, url, a_urls = [], regex = /<a href="(\/ins\?[^"]*?&amp;url=([A-Za-z0-9+\/=_]+)&amp;[^"]+)/g; null !== (resultEntry = regex.exec(responseText)); ) {
                var base64encodedURL = resultEntry[2];
                try {
                    for (var parts = base64encodedURL.split("_"), i = 0; i < parts.length; ++i) {
                        0 === i ? url = "" : url += 1 === i ? "?" : "&";
                        url += window.atob(parts[i]);
                    }
                } catch (e) {
                    _debug("SourceScraperUtils:search:getResultsFromResponse", "atob_error", "Failed to decode the URL, " + e);
                    url = resultEntry[1].replace(/&amp;/g, "&");
                }
                a_urls.push(url);
            }
            if (!a_urls.length) {
                regex = /<a href="(https?:[^"]+)/g;
                var startOfResults = responseText.indexOf('id="content"');
                startOfResults > 0 && (regex.lastIndex = startOfResults);
                for (;null !== (resultEntry = regex.exec(responseText)); ) {
                    url = resultEntry[1];
                    try {
                        url = decodeURI(url);
                    } catch (e) {}
                    var host = url.split("/")[2];
                    /(?:bing|live|microsoft|microsofttranslator|msn)\.com$/.test(host) || a_urls.push(url);
                }
            }
            return a_urls;
        };
        exports.SourceScraperUtils = SourceScraperUtils;
    });
    define("LyricsSource", [ "require", "exports", "module", "ScrapedSource", "SourceScraperUtils" ], function(require, exports) {
        function LyricsSource(options) {
            ScrapedSource.call(this, options);
        }
        function _normalize_string(value, options) {
            options && options.keepAccents || (value = SourceScraperUtils.normalize_accents(value));
            return value;
        }
        var ScrapedSource = require("ScrapedSource").ScrapedSource, SourceScraperUtils = require("SourceScraperUtils").SourceScraperUtils;
        LyricsSource.prototype = Object.create(ScrapedSource.prototype);
        LyricsSource.prototype.constructor = LyricsSource;
        LyricsSource.Scheme = {
            identifier: "string",
            disabled: [ "undefined", "boolean" ],
            homepage: "string",
            description: [ "undefined", "string" ],
            url_result: [ "string", "function" ],
            method_result: [ "undefined", "string" ],
            payload_result: [ "undefined", "string", "function" ],
            headers_result: [ "undefined", "object", "function" ],
            process_result: "function",
            url_search: [ "string", "function" ],
            method_search: [ "undefined", "string" ],
            payload_search: [ "undefined", "string", "function" ],
            headers_search: [ "undefined", "object", "function" ],
            process_search: "function"
        };
        LyricsSource.prototype.handleSearch = function(responseText, callbacks) {
            return this.process_lyrics(responseText, callbacks);
        };
        LyricsSource.prototype.$ARTIST$SONG = function(value, options) {
            value = String(value);
            value = value.replace(/\([^)]*\)/g, "");
            value = value.replace(/\[[^\]]*\]/g, "");
            value = _normalize_string(value, options);
            value = value.replace(/ +/g, " ");
            value = value.trim();
            return value;
        };
        LyricsSource.prototype.$ARTIST = function(query, options) {
            return this.$ARTIST$SONG(String(query.artist), options);
        };
        LyricsSource.prototype.$SONG = function(query, options) {
            return this.$ARTIST$SONG(String(query.song), options);
        };
        LyricsSource.prototype.$SEARCHTERMS = function(query, options) {
            if (query.artist && query.song) return query.artist + " - " + query.song;
            if (!query.videotitle && query.searchTerms) return query.searchTerms;
            var s = String(query.videotitle);
            s = s.replace(/\([^)]*\)/g, " ");
            s = s.replace(/\[[^\]]*\]/g, " ");
            s = s.replace(/\b(ft|feat)\b[^\-]+/i, "");
            s = s.replace(/\bhd\b/i, "");
            s = s.replace(/(?:w.(?:th)? ?)?((?:on)?.?screen ?)?lyrics?/i, "");
            s = s.replace(/\b(?:(?:piano|guitar|drum|acoustic|instrument(?:al)?) ?)?cover( by [^ )\]]+)?/i, "");
            s = s.replace(/\b(?:recorded )?live (?:at|@|on).+$/i, "");
            s = s.replace(/\b\d{1,2}[\-.\/]\d{1,2}[\-.\/](?:(?:1[789]|20)\d{2}|\d{2})\b/, "");
            s = s.replace(/[(\[][^\])]*(?:20|19)\d{2}[^\])]*[)\]]/, "");
            s = s.replace(/\b1[789]\d{2}|20\d{2}\b/, "");
            s = s.replace(/\bYouTube\b/gi, "");
            s = s.replace(/\bre.?uploaded\b/i, "");
            s = s.replace(/\bhigh[\- ]?quality\b/i, "");
            s = s.replace(/\boffici?al\b/i, "");
            s = s.replace(/\b(minecraft|rsmv|mmv|(?:(?:naruto|bleach|avatar|toradora|final ?fantasy ?\d{0,2})[^a-z0-9]+)?amv)/i, "");
            s = s.replace(/\b(?:full )?music\b/gi, "");
            s = s.replace(/\bdemo\b/i, "");
            s = s.replace(/\bfan(?:[\- ]?(?:video|made))?\b/i, "");
            s = s.replace(/\b(videos?|audio|acoustic)/gi, "");
            s = s.replace(/\b(on ?)?iTunes\b/i, "");
            s = s.replace(/(^|[^a-z0-9])(?:240|360|480)p\b/i, "");
            s = s.replace(/\.(3gp?[2p]|as[fx]|avi|flv|m[4o]v|mpe?g?[34]|rm|webm|wmv)\s*$/i, "");
            s = _normalize_string(s, options);
            s = s.replace(/(?:^|\s)([^a-z0-9 ])(\1+)(?=\s|$)/gi, " ");
            s = s.replace(/^[\s\-']+|[\s\-']+$/g, "");
            s = s.replace(/\s{2,}/g, " ");
            return s;
        };
        LyricsSource.prototype.$encSEARCHTERMS = function(query, options) {
            return encodeURIComponent(this.$SEARCHTERMS(query), options);
        };
        exports.LyricsSource = LyricsSource;
    });
    define("sources/lyrics.wikia.com", [ "require", "exports", "module", "LyricsSource", "SourceScraperUtils" ], function(require, exports) {
        var LyricsSource = require("LyricsSource").LyricsSource, SourceScraperUtils = require("SourceScraperUtils").SourceScraperUtils;
        exports.source = new LyricsSource({
            disabled: !1,
            identifier: "lyrics.wikia.com",
            homepage: "http://lyrics.wikia.com/",
            description: "The biggest lyrics database, containing millions of lyrics in several languages.",
            url_result: "http://lyrics.wikia.com/$ARTIST:$SONG",
            url_search: function(query) {
                return SourceScraperUtils.search.get_url({
                    site: "lyrics.wikia.com",
                    query: '"This song is performed by" ' + this.$SEARCHTERMS(query)
                });
            },
            process_result: function(responseText, callbacks) {
                var doc = SourceScraperUtils.toDOM(responseText), lyricbox = doc.querySelector(".lyricbox");
                if (!lyricbox) {
                    var redirectLink = doc.querySelector(".redirectText a[href]");
                    if (redirectLink) {
                        redirectLink = redirectLink.getAttribute("href") || "";
                        "/" === redirectLink.charAt(0) && (redirectLink = "http://lyrics.wikia.com" + redirectLink);
                        if (redirectLink) {
                            callbacks.found({
                                redir: redirectLink
                            });
                            return;
                        }
                    }
                }
                var lyrics = SourceScraperUtils.toStringArray(lyricbox);
                if (lyrics.length) {
                    var title = doc.title.split(" Lyrics - Lyric Wiki")[0].replace(":", " - ");
                    callbacks.found({
                        lyrics: lyrics,
                        title: title
                    });
                } else callbacks.fail();
            },
            process_search: function(responseText, callbacks) {
                for (var a_urls = SourceScraperUtils.search.getResultsFromResponse(responseText), i = 0; i < a_urls.length; i++) {
                    var url = a_urls[i];
                    if (/^https?:\/\/lyrics\.wikia\.com\/(?!Category:)(?!User:)(?!Special:)[^:]+:./i.test(url)) {
                        callbacks.found({
                            redir: url
                        });
                        return;
                    }
                }
                callbacks.fail();
            },
            $ARTIST$SONG: function(value, options) {
                (options || (options = {})).keepAccents = !0;
                value = LyricsSource.prototype.$ARTIST$SONG.call(this, value, options);
                value = value.replace(/ /g, "_");
                value = value.replace(/^_+|_+$/g, "");
                value = value.replace(/(_|^)(.)/g, function(full_match, delimiter, anything) {
                    return delimiter + anything.toUpperCase();
                });
                return value;
            },
            $ARTIST: function(query, options) {
                var artist = LyricsSource.prototype.$ARTIST.call(this, query, options);
                /^(Category|User|Special)$/i.test(artist) && (artist += "_(Artist)");
                return artist;
            }
        });
    });
    define("sources/shironet.mako.co.il", [ "require", "exports", "module", "LyricsSource", "SourceScraperUtils" ], function(require, exports) {
        var LyricsSource = require("LyricsSource").LyricsSource, SourceScraperUtils = require("SourceScraperUtils").SourceScraperUtils, isHebrew = function(string) {
            return /[\u0590-\u05FF]/.test(string);
        };
        exports.source = new LyricsSource({
            disabled: !0,
            identifier: "shironet.mako.co.il",
            homepage: "http://shironet.mako.co.il/",
            description: "The best source for Hebrew lyrics.",
            url_result: function(query) {
                return this.url_search(query);
            },
            url_search: function(query) {
                query = this.$SEARCHTERMS(query);
                return isHebrew(query) ? "http://shironet.mako.co.il/searchSongs?type=lyrics&q=" + encodeURIComponent(query) : "";
            },
            process_result: function(responseText, callbacks, data) {
                if (/^https?:\/\/shironet\.mako\.co\.il\/searchSongs/.test(data.url)) return this.process_search(responseText, callbacks, data);
                var doc = SourceScraperUtils.toDOM(responseText), lyricbox = doc.querySelector(".artist_lyrics_text"), lyrics = SourceScraperUtils.toStringArray(lyricbox);
                if (lyrics.length) {
                    var artist = doc.querySelector(".artist_singer_title");
                    artist = artist && artist.textContent.trim();
                    var song = doc.querySelector(".artist_song_name_txt");
                    song = song && song.textContent.trim();
                    var title = artist + " - " + song;
                    callbacks.found({
                        lyrics: lyrics,
                        title: title
                    });
                } else callbacks.fail();
            },
            process_search: function(responseText, callbacks) {
                var doc = SourceScraperUtils.toDOM(responseText), a = doc.querySelector('a[href*="/artist?type=lyrics"][class*="search"]'), url = a && a.getAttribute("href").replace(/^\//i, "http://shironet.mako.co.il/");
                url ? callbacks.found({
                    redir: url
                }) : callbacks.fail();
            },
            $ARTIST$SONG: function(value, options) {
                (options || (options = {})).keepAccents = !0;
                value = LyricsSource.prototype.$ARTIST$SONG.call(this, value, options);
                value = value.replace(/[^\u0590-\u05FF\d\-]+/g, " ");
                value = value.replace(/^[ \-]+|[ \-]+$/g, "");
                value = value.replace(/ +/g, " ");
                return value;
            },
            $SEARCHTERMS: function(query, options) {
                var s, formatQuery = function(s) {
                    s = s.replace(/[^\u0590-\u05FF\d\-]+/g, " ");
                    s = s.replace(/(מילים לשיר|עם מילים|עם כתוביות|קאבר|אקוסטי|בהופעה)/g, " ");
                    s = s.replace(/^[ \-]+|[ \-]+$/g, "");
                    s = s.replace(/ +/g, " ");
                    return s;
                };
                if (!query.videotitle) {
                    s = query.searchTerms;
                    if (!s) {
                        var artist = this.$ARTIST(query, options), song = this.$SONG(query, options);
                        artist && song && (s = formatQuery(artist + " - " + song));
                    }
                }
                if (!s && query.videotitle) {
                    s = query.videotitle;
                    s = s.replace(/\([^)]*\)/g, " ");
                    s = s.replace(/\[[^\]]*\]/g, " ");
                    s = formatQuery(s);
                    s || (s = formatQuery(query.videotitle));
                }
                return s;
            }
        });
    });
    define("sources/lyrics.com", [ "require", "exports", "module", "LyricsSource", "SourceScraperUtils" ], function(require, exports) {
        var LyricsSource = require("LyricsSource").LyricsSource, SourceScraperUtils = require("SourceScraperUtils").SourceScraperUtils;
        exports.source = new LyricsSource({
            disabled: !1,
            identifier: "lyrics.com",
            homepage: "http://www.lyrics.com/",
            description: "Millions of lyrics in several languages.",
            url_result: "http://www.lyrics.com/$SONG-lyrics-$ARTIST.html",
            method_search: "POST",
            headers_search: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            payload_search: "what=all&keyword=$encSEARCHTERMS",
            url_search: "http://www.lyrics.com/search.php?what=all&keyword=$encSEARCHTERMS",
            process_result: function(responseText, callbacks) {
                var doc = SourceScraperUtils.toDOM(responseText), lyricbox = doc.querySelector("#lyrics,#lyric_space"), link = lyricbox && lyricbox.querySelector("a[href]");
                if (link && /^\s*Submit Lyrics\s*$/i.test(link.textContent)) callbacks.fail(); else {
                    var lyrics = SourceScraperUtils.toStringArray(lyricbox, {
                        tags: /^(?:[buiap]|div|strong|em)$/i,
                        flushBefore: /^(p|br|div)$/i,
                        flushAfter: /^(p|br|div)$/i
                    });
                    if (lyrics.length) {
                        var title = doc.title.replace(/\s+Lyrics$/, "");
                        callbacks.found({
                            lyrics: lyrics,
                            title: title
                        });
                    } else callbacks.fail();
                }
            },
            process_search: function(responseText, callbacks) {
                var doc = SourceScraperUtils.toDOM(responseText), link = doc.querySelector('a[href^="http://www.lyrics.com/search.php?what=rd"][href*="&rd="][href*="-lyrics-"]'), url = link && /&rd=([^&#]+)/.exec(link.getAttribute("href"));
                if (url) {
                    url = "http://www.lyrics.com/" + url[1];
                    callbacks.found({
                        redir: url
                    });
                } else callbacks.fail();
            },
            $ARTIST$SONG: function(value, options) {
                value = LyricsSource.prototype.$ARTIST$SONG.call(this, value, options);
                value = value.toLowerCase();
                value = value.replace(/[^a-z0-9\- ]/g, "");
                value = value.replace(/ /g, "-");
                value = value.replace(/-{2,}/, "-");
                value = value.replace(/^-|-$/, "");
                return value;
            }
        });
    });
    define("sources/metrolyrics.com", [ "require", "exports", "module", "LyricsSource", "SourceScraperUtils" ], function(require, exports) {
        var LyricsSource = require("LyricsSource").LyricsSource, SourceScraperUtils = require("SourceScraperUtils").SourceScraperUtils;
        exports.source = new LyricsSource({
            disabled: !1,
            identifier: "metrolyrics.com",
            homepage: "http://www.metrolyrics.com/",
            description: "Millions of lyrics in several languages.",
            url_result: "http://m.metrolyrics.com/$SONG-lyrics-$ARTIST.html",
            url_search: function(query) {
                return SourceScraperUtils.search.get_url({
                    site: "metrolyrics.com",
                    query: this.$SEARCHTERMS(query)
                });
            },
            process_result: function(responseText, callbacks, data) {
                var doc = SourceScraperUtils.toDOM(responseText), lyricbox = doc.querySelector(".lyricsbody,.gnlyricsbody"), lyrics = SourceScraperUtils.toStringArray(lyricbox);
                if (!lyrics.length || lyrics[0].lastIndexOf("Unfortunately, we don", 10) >= 0) callbacks.fail(); else {
                    var title = doc.title.replace(/\s+Lyrics$/, ""), url = data.url.replace(/^(https?:\/\/)m\./, "$1www.");
                    callbacks.found({
                        lyrics: lyrics,
                        title: title,
                        url: url
                    });
                }
            },
            process_search: function(responseText, callbacks) {
                for (var a_urls = SourceScraperUtils.search.getResultsFromResponse(responseText), i = 0; i < a_urls.length; i++) {
                    var url = a_urls[i];
                    if (/^https?:\/\/(m|www)\.metrolyrics\.com\/[a-z0-9\-]+-lyrics-[a-z0-9\-]+\.html$/i.test(url)) {
                        url = url.replace(/^(https?:\/\/)www\./, "$1m.");
                        callbacks.found({
                            redir: url
                        });
                        return;
                    }
                }
                callbacks.fail();
            },
            $ARTIST$SONG: function(value, options) {
                value = LyricsSource.prototype.$ARTIST$SONG.call(this, value, options);
                value = value.toLowerCase();
                value = value.replace(/([a-z])!([a-z])/g, "$1i$2");
                value = value.replace(/[^a-z0-9+\- ]/g, "");
                value = value.replace(/[\- ]+/g, "-");
                value = value.replace(/^-+|-+$/g, "");
                return value;
            }
        });
    });
    define("sources/lyricsmania.com", [ "require", "exports", "module", "LyricsSource", "SourceScraperUtils" ], function(require, exports) {
        var LyricsSource = require("LyricsSource").LyricsSource, SourceScraperUtils = require("SourceScraperUtils").SourceScraperUtils;
        exports.source = new LyricsSource({
            disabled: !0,
            identifier: "lyricsmania.com",
            homepage: "http://www.lyricsmania.com/",
            description: "Millions of English, French, German, Spanish and Italian lyrics (and others).",
            url_result: "http://www.lyricsmania.com/$SONG_lyrics_$ARTIST.html",
            url_search: function(query) {
                return SourceScraperUtils.search.get_url({
                    site: "lyricsmania.com",
                    query: this.$SEARCHTERMS(query)
                });
            },
            process_result: function(responseText, callbacks) {
                var doc = SourceScraperUtils.toDOM(responseText), lyricbox = doc.querySelector("#songlyrics_h,#songlyrics"), lyrics = SourceScraperUtils.toStringArray(lyricbox);
                if (lyrics.length) {
                    var title = doc.title.replace(/\s+Lyrics$/, "");
                    callbacks.found({
                        lyrics: lyrics,
                        title: title
                    });
                } else callbacks.fail();
            },
            process_search: function(responseText, callbacks) {
                for (var a_urls = SourceScraperUtils.search.getResultsFromResponse(responseText), i = 0; i < a_urls.length; i++) {
                    var url = a_urls[i];
                    if (/^https?:\/\/www\.lyricsmania\.com\/.+_lyrics_.+\.html$/i.test(url)) {
                        callbacks.found({
                            redir: url
                        });
                        return;
                    }
                }
                callbacks.fail();
            },
            $ARTIST$SONG: function(value, options) {
                value = LyricsSource.prototype.$ARTIST$SONG.call(this, value, options);
                value = value.toLowerCase();
                value = value.replace(/&/g, "and");
                value = value.replace("[ost]", "_soundtrack_");
                value = value.replace(/[ \/]/g, "_");
                value = value.replace(/[^a-z0-9!,_\-@*:$°]/g, "");
                return value;
            }
        });
    });
    define("queryEngine", [ "require", "exports", "module", "InfoProvider", "processRequest", "sources/lyrics.wikia.com", "sources/shironet.mako.co.il", "sources/lyrics.com", "sources/metrolyrics.com", "sources/lyricsmania.com" ], function(require, exports) {
        var InfoProvider = require("InfoProvider").InfoProvider, processRequest = require("processRequest").processRequest, publicAPI = {
            loadLyricsCallback: function(resultObject) {
                var json = JSON.stringify(resultObject);
                "undefined" != typeof lyricsApi ? lyricsApi.loadLyricsCallback(json) : showLyrics(json);
            },
            loadLyrics: function(youtubeID_or_artist, song_name) {
                QueryEngine.loadLyrics(youtubeID_or_artist, song_name);
            }
        }, isHebrew = function(string) {
            return /[\u0590-\u05FF]/.test(string);
        }, QueryEngine = {}, sources = [ require("sources/lyrics.wikia.com").source, require("sources/shironet.mako.co.il").source, require("sources/lyrics.com").source, require("sources/metrolyrics.com").source, require("sources/lyricsmania.com").source ], sourcesHebrewFirst = sources.slice(1);
        sourcesHebrewFirst.splice(1, 0, sources[0]);
        var hebrewInfoProvider, defaultInfoProvider;
        QueryEngine.runQuery = function(query) {
            var type = query.song && query.artist ? "result" : "search";
            QueryEngine.infoProvider = isHebrew(query.videotitle) || isHebrew(query.song) || isHebrew(query.artist) ? hebrewInfoProvider || (hebrewInfoProvider = new InfoProvider(sourcesHebrewFirst)) : defaultInfoProvider || (defaultInfoProvider = new InfoProvider(sources));
            QueryEngine.infoProvider.query(type, query, QueryEngine.queryCallback);
        };
        QueryEngine.queryCallback = function(resultObject) {
            switch (resultObject.type) {
              case "fail":
                if (resultObject.next) {
                    resultObject.next();
                    return;
                }
                break;

              case "found":
                break;

              default:
                return;
            }
            var query = resultObject.query, splitTitle = /^(.+?) - (.+)$/.exec(resultObject.title), artist = "", song = "";
            if (!splitTitle && query.artist && query.song) {
                artist = query.artist;
                song = query.song;
            } else splitTitle = /^(.+?) - (.+)$/.exec(query.videotitle);
            if (splitTitle) {
                artist = splitTitle[1];
                song = splitTitle[2];
            }
            var youtube = query.youtube || {
                id: "",
                duration: 0,
                views: 0
            }, lyrics = resultObject.lyrics;
            if (lyrics) {
                for (var i = 0; i < lyrics.length; ++i) lyrics[i] = lyrics[i].trim();
                lyrics = lyrics.join("\n");
            } else lyrics = "";
            var apiResult = {
                id: youtube.id,
                duration: youtube.duration,
                views: youtube.views,
                title: query.videotitle || resultObject.title,
                lyrics: lyrics,
                song_artist: artist,
                song_title: song,
                source_identifier: resultObject.sourceIdentifier,
                source_url: resultObject.url
            };
            "function" == typeof query.callback ? query.callback(apiResult) : publicAPI.loadLyricsCallback(apiResult);
        };
        QueryEngine.errorCallback = function(source_identifier, url, errorMessage) {
            publicAPI.loadLyricsCallback({
                id: "",
                duration: 0,
                views: 0,
                title: "",
                lyrics: "",
                song_artist: "",
                song_title: "",
                source_identifier: source_identifier,
                source_url: url,
                error: errorMessage
            });
        };
        QueryEngine.loadLyrics = function(youtubeID_or_artist, song_name) {
            QueryEngine.infoProvider && QueryEngine.infoProvider.abort();
            if ("object" != typeof youtubeID_or_artist) if (song_name) {
                var lyricsQuery = {
                    artist: youtubeID_or_artist,
                    song: song_name
                };
                QueryEngine.runQuery(lyricsQuery);
            } else {
                var url = "http://gdata.youtube.com/feeds/api/videos/" + youtubeID_or_artist + "?v=2&alt=jsonc", sourceId = "gdata.youtube.com";
                processRequest({
                    url: url,
                    afterSend: function() {},
                    fail: function() {
                        QueryEngine.errorCallback(sourceId, url, "Protocol or network error");
                    },
                    found: function(result) {
                        var data = JSON.parse(result.responseText);
                        if (data.error) QueryEngine.errorCallback(sourceId, result.url, data.error); else if (data.data.title) {
                            var title = new String(data.data.title);
                            try {
                                title = title.toLowerCase();
                                title = title.replace("'", " ");
                                title = title.replace("-", " ");
                                title = title.replace("+", " ");
                                title = title.replace('"', " ");
                                title = title.replace("cover", "");
                                title = title.replace("official music", "");
                                title = title.replace("official video", "");
                                title = title.replace("'", " ").replace("-", " ").replace("+", " ").replace(",", " ").replace('"', " ").replace("cover", "").replace("official music", "");
                                var arrTitle = title.split(/[()\[\]]/);
                                title = arrTitle[0].substring(0, arrTitle[0].length > 50 ? 50 : arrTitle[0].length);
                            } catch (e) {
                                title = b.data.title;
                            }
                            var lyricsQuery = {
                                videotitle: data.data.title,
                                youtube: {
                                    id: data.data.id,
                                    duration: data.data.duration,
                                    views: data.data.viewCount
                                }
                            };
                            QueryEngine.runQuery(lyricsQuery);
                        } else QueryEngine.errorCallback(sourceId, result.url, "Title not found");
                    }
                });
            } else QueryEngine.runQuery(youtubeID_or_artist);
        };
        exports.publicAPI = publicAPI;
    });
    require([ "queryEngine" ], function(QueryEngine) {
        window.loadLyrics = QueryEngine.publicAPI.loadLyrics;
        window.loadLyricsCallback && (QueryEngine.publicAPI.loadLyricsCallback = window.loadLyricsCallback);
    });
})();