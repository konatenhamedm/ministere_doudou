/*!
 * Chart.js
 * http://chartjs.org/
 * Version: 2.7.3
 *
 * Copyright 2018 Chart.js Contributors
 * Released under the MIT license
 * https://github.com/chartjs/Chart.js/blob/master/LICENSE.md
 */
! function (t) {
	if ("object" == typeof exports && "undefined" != typeof module) module.exports = t();
	else if ("function" == typeof define && define.amd) define([], t);
	else {
		("undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : this).Chart = t()
	}
}(function () {
	return function r(o, s, l) {
		function u(e, t) {
			if (!s[e]) {
				if (!o[e]) {
					var n = "function" == typeof require && require;
					if (!t && n) return n(e, !0);
					if (d) return d(e, !0);
					var i = new Error("Cannot find module '" + e + "'");
					throw i.code = "MODULE_NOT_FOUND", i
				}
				var a = s[e] = {
					exports: {}
				};
				o[e][0].call(a.exports, function (t) {
					return u(o[e][1][t] || t)
				}, a, a.exports, r, o, s, l)
			}
			return s[e].exports
		}
		for (var d = "function" == typeof require && require, t = 0; t < l.length; t++) u(l[t]);
		return u
	}({
		1: [function (t, e, n) {
			var r = t(5);

			function i(t) {
				if (t) {
					var e = [0, 0, 0],
						n = 1,
						i = t.match(/^#([a-fA-F0-9]{3})$/i);
					if (i) {
						i = i[1];
						for (var a = 0; a < e.length; a++) e[a] = parseInt(i[a] + i[a], 16)
					} else if (i = t.match(/^#([a-fA-F0-9]{6})$/i)) {
						i = i[1];
						for (a = 0; a < e.length; a++) e[a] = parseInt(i.slice(2 * a, 2 * a + 2), 16)
					} else if (i = t.match(/^rgba?\(\s*([+-]?\d+)\s*,\s*([+-]?\d+)\s*,\s*([+-]?\d+)\s*(?:,\s*([+-]?[\d\.]+)\s*)?\)$/i)) {
						for (a = 0; a < e.length; a++) e[a] = parseInt(i[a + 1]);
						n = parseFloat(i[4])
					} else if (i = t.match(/^rgba?\(\s*([+-]?[\d\.]+)\%\s*,\s*([+-]?[\d\.]+)\%\s*,\s*([+-]?[\d\.]+)\%\s*(?:,\s*([+-]?[\d\.]+)\s*)?\)$/i)) {
						for (a = 0; a < e.length; a++) e[a] = Math.round(2.55 * parseFloat(i[a + 1]));
						n = parseFloat(i[4])
					} else if (i = t.match(/(\w+)/)) {
						if ("transparent" == i[1]) return [0, 0, 0, 0];
						if (!(e = r[i[1]])) return
					}
					for (a = 0; a < e.length; a++) e[a] = d(e[a], 0, 255);
					return n = n || 0 == n ? d(n, 0, 1) : 1, e[3] = n, e
				}
			}

			function a(t) {
				if (t) {
					var e = t.match(/^hsla?\(\s*([+-]?\d+)(?:deg)?\s*,\s*([+-]?[\d\.]+)%\s*,\s*([+-]?[\d\.]+)%\s*(?:,\s*([+-]?[\d\.]+)\s*)?\)/);
					if (e) {
						var n = parseFloat(e[4]);
						return [d(parseInt(e[1]), 0, 360), d(parseFloat(e[2]), 0, 100), d(parseFloat(e[3]), 0, 100), d(isNaN(n) ? 1 : n, 0, 1)]
					}
				}
			}

			function o(t) {
				if (t) {
					var e = t.match(/^hwb\(\s*([+-]?\d+)(?:deg)?\s*,\s*([+-]?[\d\.]+)%\s*,\s*([+-]?[\d\.]+)%\s*(?:,\s*([+-]?[\d\.]+)\s*)?\)/);
					if (e) {
						var n = parseFloat(e[4]);
						return [d(parseInt(e[1]), 0, 360), d(parseFloat(e[2]), 0, 100), d(parseFloat(e[3]), 0, 100), d(isNaN(n) ? 1 : n, 0, 1)]
					}
				}
			}

			function s(t, e) {
				return void 0 === e && (e = void 0 !== t[3] ? t[3] : 1), "rgba(" + t[0] + ", " + t[1] + ", " + t[2] + ", " + e + ")"
			}

			function l(t, e) {
				return "rgba(" + Math.round(t[0] / 255 * 100) + "%, " + Math.round(t[1] / 255 * 100) + "%, " + Math.round(t[2] / 255 * 100) + "%, " + (e || t[3] || 1) + ")"
			}

			function u(t, e) {
				return void 0 === e && (e = void 0 !== t[3] ? t[3] : 1), "hsla(" + t[0] + ", " + t[1] + "%, " + t[2] + "%, " + e + ")"
			}

			function d(t, e, n) {
				return Math.min(Math.max(e, t), n)
			}

			function h(t) {
				var e = t.toString(16).toUpperCase();
				return e.length < 2 ? "0" + e : e
			}
			e.exports = {
				getRgba: i,
				getHsla: a,
				getRgb: function (t) {
					var e = i(t);
					return e && e.slice(0, 3)
				},
				getHsl: function (t) {
					var e = a(t);
					return e && e.slice(0, 3)
				},
				getHwb: o,
				getAlpha: function (t) {
					var e = i(t); {
						if (e) return e[3];
						if (e = a(t)) return e[3];
						if (e = o(t)) return e[3]
					}
				},
				hexString: function (t) {
					return "#" + h(t[0]) + h(t[1]) + h(t[2])
				},
				rgbString: function (t, e) {
					if (e < 1 || t[3] && t[3] < 1) return s(t, e);
					return "rgb(" + t[0] + ", " + t[1] + ", " + t[2] + ")"
				},
				rgbaString: s,
				percentString: function (t, e) {
					if (e < 1 || t[3] && t[3] < 1) return l(t, e);
					var n = Math.round(t[0] / 255 * 100),
						i = Math.round(t[1] / 255 * 100),
						a = Math.round(t[2] / 255 * 100);
					return "rgb(" + n + "%, " + i + "%, " + a + "%)"
				},
				percentaString: l,
				hslString: function (t, e) {
					if (e < 1 || t[3] && t[3] < 1) return u(t, e);
					return "hsl(" + t[0] + ", " + t[1] + "%, " + t[2] + "%)"
				},
				hslaString: u,
				hwbString: function (t, e) {
					void 0 === e && (e = void 0 !== t[3] ? t[3] : 1);
					return "hwb(" + t[0] + ", " + t[1] + "%, " + t[2] + "%" + (void 0 !== e && 1 !== e ? ", " + e : "") + ")"
				},
				keyword: function (t) {
					return c[t.slice(0, 3)]
				}
			};
			var c = {};
			for (var f in r) c[r[f]] = f
		}, {
			5: 5
		}],
		2: [function (t, e, n) {
			var d = t(4),
				i = t(1),
				o = function (t) {
					return t instanceof o ? t : this instanceof o ? (this.valid = !1, this.values = {
						rgb: [0, 0, 0],
						hsl: [0, 0, 0],
						hsv: [0, 0, 0],
						hwb: [0, 0, 0],
						cmyk: [0, 0, 0, 0],
						alpha: 1
					}, void ("string" == typeof t ? (e = i.getRgba(t)) ? this.setValues("rgb", e) : (e = i.getHsla(t)) ? this.setValues("hsl", e) : (e = i.getHwb(t)) && this.setValues("hwb", e) : "object" == typeof t && (void 0 !== (e = t).r || void 0 !== e.red ? this.setValues("rgb", e) : void 0 !== e.l || void 0 !== e.lightness ? this.setValues("hsl", e) : void 0 !== e.v || void 0 !== e.value ? this.setValues("hsv", e) : void 0 !== e.w || void 0 !== e.whiteness ? this.setValues("hwb", e) : void 0 === e.c && void 0 === e.cyan || this.setValues("cmyk", e)))) : new o(t);
					var e
				};
			o.prototype = {
				isValid: function () {
					return this.valid
				},
				rgb: function () {
					return this.setSpace("rgb", arguments)
				},
				hsl: function () {
					return this.setSpace("hsl", arguments)
				},
				hsv: function () {
					return this.setSpace("hsv", arguments)
				},
				hwb: function () {
					return this.setSpace("hwb", arguments)
				},
				cmyk: function () {
					return this.setSpace("cmyk", arguments)
				},
				rgbArray: function () {
					return this.values.rgb
				},
				hslArray: function () {
					return this.values.hsl
				},
				hsvArray: function () {
					return this.values.hsv
				},
				hwbArray: function () {
					var t = this.values;
					return 1 !== t.alpha ? t.hwb.concat([t.alpha]) : t.hwb
				},
				cmykArray: function () {
					return this.values.cmyk
				},
				rgbaArray: function () {
					var t = this.values;
					return t.rgb.concat([t.alpha])
				},
				hslaArray: function () {
					var t = this.values;
					return t.hsl.concat([t.alpha])
				},
				alpha: function (t) {
					return void 0 === t ? this.values.alpha : (this.setValues("alpha", t), this)
				},
				red: function (t) {
					return this.setChannel("rgb", 0, t)
				},
				green: function (t) {
					return this.setChannel("rgb", 1, t)
				},
				blue: function (t) {
					return this.setChannel("rgb", 2, t)
				},
				hue: function (t) {
					return t && (t = (t %= 360) < 0 ? 360 + t : t), this.setChannel("hsl", 0, t)
				},
				saturation: function (t) {
					return this.setChannel("hsl", 1, t)
				},
				lightness: function (t) {
					return this.setChannel("hsl", 2, t)
				},
				saturationv: function (t) {
					return this.setChannel("hsv", 1, t)
				},
				whiteness: function (t) {
					return this.setChannel("hwb", 1, t)
				},
				blackness: function (t) {
					return this.setChannel("hwb", 2, t)
				},
				value: function (t) {
					return this.setChannel("hsv", 2, t)
				},
				cyan: function (t) {
					return this.setChannel("cmyk", 0, t)
				},
				magenta: function (t) {
					return this.setChannel("cmyk", 1, t)
				},
				yellow: function (t) {
					return this.setChannel("cmyk", 2, t)
				},
				black: function (t) {
					return this.setChannel("cmyk", 3, t)
				},
				hexString: function () {
					return i.hexString(this.values.rgb)
				},
				rgbString: function () {
					return i.rgbString(this.values.rgb, this.values.alpha)
				},
				rgbaString: function () {
					return i.rgbaString(this.values.rgb, this.values.alpha)
				},
				percentString: function () {
					return i.percentString(this.values.rgb, this.values.alpha)
				},
				hslString: function () {
					return i.hslString(this.values.hsl, this.values.alpha)
				},
				hslaString: function () {
					return i.hslaString(this.values.hsl, this.values.alpha)
				},
				hwbString: function () {
					return i.hwbString(this.values.hwb, this.values.alpha)
				},
				keyword: function () {
					return i.keyword(this.values.rgb, this.values.alpha)
				},
				rgbNumber: function () {
					var t = this.values.rgb;
					return t[0] << 16 | t[1] << 8 | t[2]
				},
				luminosity: function () {
					for (var t = this.values.rgb, e = [], n = 0; n < t.length; n++) {
						var i = t[n] / 255;
						e[n] = i <= .03928 ? i / 12.92 : Math.pow((i + .055) / 1.055, 2.4)
					}
					return .2126 * e[0] + .7152 * e[1] + .0722 * e[2]
				},
				contrast: function (t) {
					var e = this.luminosity(),
						n = t.luminosity();
					return n < e ? (e + .05) / (n + .05) : (n + .05) / (e + .05)
				},
				level: function (t) {
					var e = this.contrast(t);
					return 7.1 <= e ? "AAA" : 4.5 <= e ? "AA" : ""
				},
				dark: function () {
					var t = this.values.rgb;
					return (299 * t[0] + 587 * t[1] + 114 * t[2]) / 1e3 < 128
				},
				light: function () {
					return !this.dark()
				},
				negate: function () {
					for (var t = [], e = 0; e < 3; e++) t[e] = 255 - this.values.rgb[e];
					return this.setValues("rgb", t), this
				},
				lighten: function (t) {
					var e = this.values.hsl;
					return e[2] += e[2] * t, this.setValues("hsl", e), this
				},
				darken: function (t) {
					var e = this.values.hsl;
					return e[2] -= e[2] * t, this.setValues("hsl", e), this
				},
				saturate: function (t) {
					var e = this.values.hsl;
					return e[1] += e[1] * t, this.setValues("hsl", e), this
				},
				desaturate: function (t) {
					var e = this.values.hsl;
					return e[1] -= e[1] * t, this.setValues("hsl", e), this
				},
				whiten: function (t) {
					var e = this.values.hwb;
					return e[1] += e[1] * t, this.setValues("hwb", e), this
				},
				blacken: function (t) {
					var e = this.values.hwb;
					return e[2] += e[2] * t, this.setValues("hwb", e), this
				},
				greyscale: function () {
					var t = this.values.rgb,
						e = .3 * t[0] + .59 * t[1] + .11 * t[2];
					return this.setValues("rgb", [e, e, e]), this
				},
				clearer: function (t) {
					var e = this.values.alpha;
					return this.setValues("alpha", e - e * t), this
				},
				opaquer: function (t) {
					var e = this.values.alpha;
					return this.setValues("alpha", e + e * t), this
				},
				rotate: function (t) {
					var e = this.values.hsl,
						n = (e[0] + t) % 360;
					return e[0] = n < 0 ? 360 + n : n, this.setValues("hsl", e), this
				},
				mix: function (t, e) {
					var n = this,
						i = t,
						a = void 0 === e ? .5 : e,
						r = 2 * a - 1,
						o = n.alpha() - i.alpha(),
						s = ((r * o == -1 ? r : (r + o) / (1 + r * o)) + 1) / 2,
						l = 1 - s;
					return this.rgb(s * n.red() + l * i.red(), s * n.green() + l * i.green(), s * n.blue() + l * i.blue()).alpha(n.alpha() * a + i.alpha() * (1 - a))
				},
				toJSON: function () {
					return this.rgb()
				},
				clone: function () {
					var t, e, n = new o,
						i = this.values,
						a = n.values;
					for (var r in i) i.hasOwnProperty(r) && (t = i[r], "[object Array]" === (e = {}.toString.call(t)) ? a[r] = t.slice(0) : "[object Number]" === e ? a[r] = t : console.error("unexpected color value:", t));
					return n
				}
			}, o.prototype.spaces = {
				rgb: ["red", "green", "blue"],
				hsl: ["hue", "saturation", "lightness"],
				hsv: ["hue", "saturation", "value"],
				hwb: ["hue", "whiteness", "blackness"],
				cmyk: ["cyan", "magenta", "yellow", "black"]
			}, o.prototype.maxes = {
				rgb: [255, 255, 255],
				hsl: [360, 100, 100],
				hsv: [360, 100, 100],
				hwb: [360, 100, 100],
				cmyk: [100, 100, 100, 100]
			}, o.prototype.getValues = function (t) {
				for (var e = this.values, n = {}, i = 0; i < t.length; i++) n[t.charAt(i)] = e[t][i];
				return 1 !== e.alpha && (n.a = e.alpha), n
			}, o.prototype.setValues = function (t, e) {
				var n, i, a = this.values,
					r = this.spaces,
					o = this.maxes,
					s = 1;
				if (this.valid = !0, "alpha" === t) s = e;
				else if (e.length) a[t] = e.slice(0, t.length), s = e[t.length];
				else if (void 0 !== e[t.charAt(0)]) {
					for (n = 0; n < t.length; n++) a[t][n] = e[t.charAt(n)];
					s = e.a
				} else if (void 0 !== e[r[t][0]]) {
					var l = r[t];
					for (n = 0; n < t.length; n++) a[t][n] = e[l[n]];
					s = e.alpha
				}
				if (a.alpha = Math.max(0, Math.min(1, void 0 === s ? a.alpha : s)), "alpha" === t) return !1;
				for (n = 0; n < t.length; n++) i = Math.max(0, Math.min(o[t][n], a[t][n])), a[t][n] = Math.round(i);
				for (var u in r) u !== t && (a[u] = d[t][u](a[t]));
				return !0
			}, o.prototype.setSpace = function (t, e) {
				var n = e[0];
				return void 0 === n ? this.getValues(t) : ("number" == typeof n && (n = Array.prototype.slice.call(e)), this.setValues(t, n), this)
			}, o.prototype.setChannel = function (t, e, n) {
				var i = this.values[t];
				return void 0 === n ? i[e] : (n === i[e] || (i[e] = n, this.setValues(t, i)), this)
			}, "undefined" != typeof window && (window.Color = o), e.exports = o
		}, {
			1: 1,
			4: 4
		}],
		3: [function (t, e, n) {
			function a(t) {
				var e, n, i = t[0] / 255,
					a = t[1] / 255,
					r = t[2] / 255,
					o = Math.min(i, a, r),
					s = Math.max(i, a, r),
					l = s - o;
				return s == o ? e = 0 : i == s ? e = (a - r) / l : a == s ? e = 2 + (r - i) / l : r == s && (e = 4 + (i - a) / l), (e = Math.min(60 * e, 360)) < 0 && (e += 360), n = (o + s) / 2, [e, 100 * (s == o ? 0 : n <= .5 ? l / (s + o) : l / (2 - s - o)), 100 * n]
			}

			function i(t) {
				var e, n, i = t[0],
					a = t[1],
					r = t[2],
					o = Math.min(i, a, r),
					s = Math.max(i, a, r),
					l = s - o;
				return n = 0 == s ? 0 : l / s * 1e3 / 10, s == o ? e = 0 : i == s ? e = (a - r) / l : a == s ? e = 2 + (r - i) / l : r == s && (e = 4 + (i - a) / l), (e = Math.min(60 * e, 360)) < 0 && (e += 360), [e, n, s / 255 * 1e3 / 10]
			}

			function o(t) {
				var e = t[0],
					n = t[1],
					i = t[2];
				return [a(t)[0], 100 * (1 / 255 * Math.min(e, Math.min(n, i))), 100 * (i = 1 - 1 / 255 * Math.max(e, Math.max(n, i)))]
			}

			function s(t) {
				var e, n = t[0] / 255,
					i = t[1] / 255,
					a = t[2] / 255;
				return [100 * ((1 - n - (e = Math.min(1 - n, 1 - i, 1 - a))) / (1 - e) || 0), 100 * ((1 - i - e) / (1 - e) || 0), 100 * ((1 - a - e) / (1 - e) || 0), 100 * e]
			}

			function l(t) {
				return S[JSON.stringify(t)]
			}

			function u(t) {
				var e = t[0] / 255,
					n = t[1] / 255,
					i = t[2] / 255;
				return [100 * (.4124 * (e = .04045 < e ? Math.pow((e + .055) / 1.055, 2.4) : e / 12.92) + .3576 * (n = .04045 < n ? Math.pow((n + .055) / 1.055, 2.4) : n / 12.92) + .1805 * (i = .04045 < i ? Math.pow((i + .055) / 1.055, 2.4) : i / 12.92)), 100 * (.2126 * e + .7152 * n + .0722 * i), 100 * (.0193 * e + .1192 * n + .9505 * i)]
			}

			function d(t) {
				var e = u(t),
					n = e[0],
					i = e[1],
					a = e[2];
				return i /= 100, a /= 108.883, n = .008856 < (n /= 95.047) ? Math.pow(n, 1 / 3) : 7.787 * n + 16 / 116, [116 * (i = .008856 < i ? Math.pow(i, 1 / 3) : 7.787 * i + 16 / 116) - 16, 500 * (n - i), 200 * (i - (a = .008856 < a ? Math.pow(a, 1 / 3) : 7.787 * a + 16 / 116))]
			}

			function h(t) {
				var e, n, i, a, r, o = t[0] / 360,
					s = t[1] / 100,
					l = t[2] / 100;
				if (0 == s) return [r = 255 * l, r, r];
				e = 2 * l - (n = l < .5 ? l * (1 + s) : l + s - l * s), a = [0, 0, 0];
				for (var u = 0; u < 3; u++)(i = o + 1 / 3 * -(u - 1)) < 0 && i++, 1 < i && i--, r = 6 * i < 1 ? e + 6 * (n - e) * i : 2 * i < 1 ? n : 3 * i < 2 ? e + (n - e) * (2 / 3 - i) * 6 : e, a[u] = 255 * r;
				return a
			}

			function c(t) {
				var e = t[0] / 60,
					n = t[1] / 100,
					i = t[2] / 100,
					a = Math.floor(e) % 6,
					r = e - Math.floor(e),
					o = 255 * i * (1 - n),
					s = 255 * i * (1 - n * r),
					l = 255 * i * (1 - n * (1 - r));
				i *= 255;
				switch (a) {
					case 0:
						return [i, l, o];
					case 1:
						return [s, i, o];
					case 2:
						return [o, i, l];
					case 3:
						return [o, s, i];
					case 4:
						return [l, o, i];
					case 5:
						return [i, o, s]
				}
			}

			function f(t) {
				var e, n, i, a, o = t[0] / 360,
					s = t[1] / 100,
					l = t[2] / 100,
					u = s + l;
				switch (1 < u && (s /= u, l /= u), i = 6 * o - (e = Math.floor(6 * o)), 0 != (1 & e) && (i = 1 - i), a = s + i * ((n = 1 - l) - s), e) {
					default:
					case 6:
					case 0:
						r = n,
							g = a,
							b = s;
						break;
					case 1:
						r = a,
							g = n,
							b = s;
						break;
					case 2:
						r = s,
							g = n,
							b = a;
						break;
					case 3:
						r = s,
							g = a,
							b = n;
						break;
					case 4:
						r = a,
							g = s,
							b = n;
						break;
					case 5:
						r = n,
							g = s,
							b = a
				}
				return [255 * r, 255 * g, 255 * b]
			}

			function m(t) {
				var e = t[0] / 100,
					n = t[1] / 100,
					i = t[2] / 100,
					a = t[3] / 100;
				return [255 * (1 - Math.min(1, e * (1 - a) + a)), 255 * (1 - Math.min(1, n * (1 - a) + a)), 255 * (1 - Math.min(1, i * (1 - a) + a))]
			}

			function p(t) {
				var e, n, i, a = t[0] / 100,
					r = t[1] / 100,
					o = t[2] / 100;
				return n = -.9689 * a + 1.8758 * r + .0415 * o, i = .0557 * a + -.204 * r + 1.057 * o, e = .0031308 < (e = 3.2406 * a + -1.5372 * r + -.4986 * o) ? 1.055 * Math.pow(e, 1 / 2.4) - .055 : e *= 12.92, n = .0031308 < n ? 1.055 * Math.pow(n, 1 / 2.4) - .055 : n *= 12.92, i = .0031308 < i ? 1.055 * Math.pow(i, 1 / 2.4) - .055 : i *= 12.92, [255 * (e = Math.min(Math.max(0, e), 1)), 255 * (n = Math.min(Math.max(0, n), 1)), 255 * (i = Math.min(Math.max(0, i), 1))]
			}

			function v(t) {
				var e = t[0],
					n = t[1],
					i = t[2];
				return n /= 100, i /= 108.883, e = .008856 < (e /= 95.047) ? Math.pow(e, 1 / 3) : 7.787 * e + 16 / 116, [116 * (n = .008856 < n ? Math.pow(n, 1 / 3) : 7.787 * n + 16 / 116) - 16, 500 * (e - n), 200 * (n - (i = .008856 < i ? Math.pow(i, 1 / 3) : 7.787 * i + 16 / 116))]
			}

			function y(t) {
				var e, n, i, a, r = t[0],
					o = t[1],
					s = t[2];
				return a = r <= 8 ? (n = 100 * r / 903.3) / 100 * 7.787 + 16 / 116 : (n = 100 * Math.pow((r + 16) / 116, 3), Math.pow(n / 100, 1 / 3)), [e = e / 95.047 <= .008856 ? e = 95.047 * (o / 500 + a - 16 / 116) / 7.787 : 95.047 * Math.pow(o / 500 + a, 3), n, i = i / 108.883 <= .008859 ? i = 108.883 * (a - s / 200 - 16 / 116) / 7.787 : 108.883 * Math.pow(a - s / 200, 3)]
			}

			function x(t) {
				var e, n = t[0],
					i = t[1],
					a = t[2];
				return (e = 360 * Math.atan2(a, i) / 2 / Math.PI) < 0 && (e += 360), [n, Math.sqrt(i * i + a * a), e]
			}

			function _(t) {
				return p(y(t))
			}

			function k(t) {
				var e, n = t[0],
					i = t[1];
				return e = t[2] / 360 * 2 * Math.PI, [n, i * Math.cos(e), i * Math.sin(e)]
			}

			function w(t) {
				return M[t]
			}
			e.exports = {
				rgb2hsl: a,
				rgb2hsv: i,
				rgb2hwb: o,
				rgb2cmyk: s,
				rgb2keyword: l,
				rgb2xyz: u,
				rgb2lab: d,
				rgb2lch: function (t) {
					return x(d(t))
				},
				hsl2rgb: h,
				hsl2hsv: function (t) {
					var e = t[0],
						n = t[1] / 100,
						i = t[2] / 100;
					return 0 !== i ? [e, 100 * (2 * (n *= (i *= 2) <= 1 ? i : 2 - i) / (i + n)), 100 * ((i + n) / 2)] : [0, 0, 0]
				},
				hsl2hwb: function (t) {
					return o(h(t))
				},
				hsl2cmyk: function (t) {
					return s(h(t))
				},
				hsl2keyword: function (t) {
					return l(h(t))
				},
				hsv2rgb: c,
				hsv2hsl: function (t) {
					var e, n, i = t[0],
						a = t[1] / 100,
						r = t[2] / 100;
					return e = a * r, [i, 100 * (e = (e /= (n = (2 - a) * r) <= 1 ? n : 2 - n) || 0), 100 * (n /= 2)]
				},
				hsv2hwb: function (t) {
					return o(c(t))
				},
				hsv2cmyk: function (t) {
					return s(c(t))
				},
				hsv2keyword: function (t) {
					return l(c(t))
				},
				hwb2rgb: f,
				hwb2hsl: function (t) {
					return a(f(t))
				},
				hwb2hsv: function (t) {
					return i(f(t))
				},
				hwb2cmyk: function (t) {
					return s(f(t))
				},
				hwb2keyword: function (t) {
					return l(f(t))
				},
				cmyk2rgb: m,
				cmyk2hsl: function (t) {
					return a(m(t))
				},
				cmyk2hsv: function (t) {
					return i(m(t))
				},
				cmyk2hwb: function (t) {
					return o(m(t))
				},
				cmyk2keyword: function (t) {
					return l(m(t))
				},
				keyword2rgb: w,
				keyword2hsl: function (t) {
					return a(w(t))
				},
				keyword2hsv: function (t) {
					return i(w(t))
				},
				keyword2hwb: function (t) {
					return o(w(t))
				},
				keyword2cmyk: function (t) {
					return s(w(t))
				},
				keyword2lab: function (t) {
					return d(w(t))
				},
				keyword2xyz: function (t) {
					return u(w(t))
				},
				xyz2rgb: p,
				xyz2lab: v,
				xyz2lch: function (t) {
					return x(v(t))
				},
				lab2xyz: y,
				lab2rgb: _,
				lab2lch: x,
				lch2lab: k,
				lch2xyz: function (t) {
					return y(k(t))
				},
				lch2rgb: function (t) {
					return _(k(t))
				}
			};
			var M = {
				aliceblue: [240, 248, 255],
				antiquewhite: [250, 235, 215],
				aqua: [0, 255, 255],
				aquamarine: [127, 255, 212],
				azure: [240, 255, 255],
				beige: [245, 245, 220],
				bisque: [255, 228, 196],
				black: [0, 0, 0],
				blanchedalmond: [255, 235, 205],
				blue: [0, 0, 255],
				blueviolet: [138, 43, 226],
				brown: [165, 42, 42],
				burlywood: [222, 184, 135],
				cadetblue: [95, 158, 160],
				chartreuse: [127, 255, 0],
				chocolate: [210, 105, 30],
				coral: [255, 127, 80],
				cornflowerblue: [100, 149, 237],
				cornsilk: [255, 248, 220],
				crimson: [220, 20, 60],
				cyan: [0, 255, 255],
				darkblue: [0, 0, 139],
				darkcyan: [0, 139, 139],
				darkgoldenrod: [184, 134, 11],
				darkgray: [169, 169, 169],
				darkgreen: [0, 100, 0],
				darkgrey: [169, 169, 169],
				darkkhaki: [189, 183, 107],
				darkmagenta: [139, 0, 139],
				darkolivegreen: [85, 107, 47],
				darkorange: [255, 140, 0],
				darkorchid: [153, 50, 204],
				darkred: [139, 0, 0],
				darksalmon: [233, 150, 122],
				darkseagreen: [143, 188, 143],
				darkslateblue: [72, 61, 139],
				darkslategray: [47, 79, 79],
				darkslategrey: [47, 79, 79],
				darkturquoise: [0, 206, 209],
				darkviolet: [148, 0, 211],
				deeppink: [255, 20, 147],
				deepskyblue: [0, 191, 255],
				dimgray: [105, 105, 105],
				dimgrey: [105, 105, 105],
				dodgerblue: [30, 144, 255],
				firebrick: [178, 34, 34],
				floralwhite: [255, 250, 240],
				forestgreen: [34, 139, 34],
				fuchsia: [255, 0, 255],
				gainsboro: [220, 220, 220],
				ghostwhite: [248, 248, 255],
				gold: [255, 215, 0],
				goldenrod: [218, 165, 32],
				gray: [128, 128, 128],
				green: [0, 128, 0],
				greenyellow: [173, 255, 47],
				grey: [128, 128, 128],
				honeydew: [240, 255, 240],
				hotpink: [255, 105, 180],
				indianred: [205, 92, 92],
				indigo: [75, 0, 130],
				ivory: [255, 255, 240],
				khaki: [240, 230, 140],
				lavender: [230, 230, 250],
				lavenderblush: [255, 240, 245],
				lawngreen: [124, 252, 0],
				lemonchiffon: [255, 250, 205],
				lightblue: [173, 216, 230],
				lightcoral: [240, 128, 128],
				lightcyan: [224, 255, 255],
				lightgoldenrodyellow: [250, 250, 210],
				lightgray: [211, 211, 211],
				lightgreen: [144, 238, 144],
				lightgrey: [211, 211, 211],
				lightpink: [255, 182, 193],
				lightsalmon: [255, 160, 122],
				lightseagreen: [32, 178, 170],
				lightskyblue: [135, 206, 250],
				lightslategray: [119, 136, 153],
				lightslategrey: [119, 136, 153],
				lightsteelblue: [176, 196, 222],
				lightyellow: [255, 255, 224],
				lime: [0, 255, 0],
				limegreen: [50, 205, 50],
				linen: [250, 240, 230],
				magenta: [255, 0, 255],
				maroon: [128, 0, 0],
				mediumaquamarine: [102, 205, 170],
				mediumblue: [0, 0, 205],
				mediumorchid: [186, 85, 211],
				mediumpurple: [147, 112, 219],
				mediumseagreen: [60, 179, 113],
				mediumslateblue: [123, 104, 238],
				mediumspringgreen: [0, 250, 154],
				mediumturquoise: [72, 209, 204],
				mediumvioletred: [199, 21, 133],
				midnightblue: [25, 25, 112],
				mintcream: [245, 255, 250],
				mistyrose: [255, 228, 225],
				moccasin: [255, 228, 181],
				navajowhite: [255, 222, 173],
				navy: [0, 0, 128],
				oldlace: [253, 245, 230],
				olive: [128, 128, 0],
				olivedrab: [107, 142, 35],
				orange: [255, 165, 0],
				orangered: [255, 69, 0],
				orchid: [218, 112, 214],
				palegoldenrod: [238, 232, 170],
				palegreen: [152, 251, 152],
				paleturquoise: [175, 238, 238],
				palevioletred: [219, 112, 147],
				papayawhip: [255, 239, 213],
				peachpuff: [255, 218, 185],
				peru: [205, 133, 63],
				pink: [255, 192, 203],
				plum: [221, 160, 221],
				powderblue: [176, 224, 230],
				purple: [128, 0, 128],
				rebeccapurple: [102, 51, 153],
				red: [255, 0, 0],
				rosybrown: [188, 143, 143],
				royalblue: [65, 105, 225],
				saddlebrown: [139, 69, 19],
				salmon: [250, 128, 114],
				sandybrown: [244, 164, 96],
				seagreen: [46, 139, 87],
				seashell: [255, 245, 238],
				sienna: [160, 82, 45],
				silver: [192, 192, 192],
				skyblue: [135, 206, 235],
				slateblue: [106, 90, 205],
				slategray: [112, 128, 144],
				slategrey: [112, 128, 144],
				snow: [255, 250, 250],
				springgreen: [0, 255, 127],
				steelblue: [70, 130, 180],
				tan: [210, 180, 140],
				teal: [0, 128, 128],
				thistle: [216, 191, 216],
				tomato: [255, 99, 71],
				turquoise: [64, 224, 208],
				violet: [238, 130, 238],
				wheat: [245, 222, 179],
				white: [255, 255, 255],
				whitesmoke: [245, 245, 245],
				yellow: [255, 255, 0],
				yellowgreen: [154, 205, 50]
			},
				S = {};
			for (var D in M) S[JSON.stringify(M[D])] = D
		}, {}],
		4: [function (t, e, n) {
			var a = t(3),
				r = function () {
					return new u
				};
			for (var i in a) {
				r[i + "Raw"] = function (e) {
					return function (t) {
						return "number" == typeof t && (t = Array.prototype.slice.call(arguments)), a[e](t)
					}
				}(i);
				var o = /(\w+)2(\w+)/.exec(i),
					s = o[1],
					l = o[2];
				(r[s] = r[s] || {})[l] = r[i] = function (i) {
					return function (t) {
						"number" == typeof t && (t = Array.prototype.slice.call(arguments));
						var e = a[i](t);
						if ("string" == typeof e || void 0 === e) return e;
						for (var n = 0; n < e.length; n++) e[n] = Math.round(e[n]);
						return e
					}
				}(i)
			}
			var u = function () {
				this.convs = {}
			};
			u.prototype.routeSpace = function (t, e) {
				var n = e[0];
				return void 0 === n ? this.getValues(t) : ("number" == typeof n && (n = Array.prototype.slice.call(e)), this.setValues(t, n))
			}, u.prototype.setValues = function (t, e) {
				return this.space = t, this.convs = {}, this.convs[t] = e, this
			}, u.prototype.getValues = function (t) {
				var e = this.convs[t];
				if (!e) {
					var n = this.space,
						i = this.convs[n];
					e = r[n][t](i), this.convs[t] = e
				}
				return e
			}, ["rgb", "hsl", "hsv", "cmyk", "keyword"].forEach(function (e) {
				u.prototype[e] = function (t) {
					return this.routeSpace(e, arguments)
				}
			}), e.exports = r
		}, {
			3: 3
		}],
		5: [function (t, e, n) {
			"use strict";
			e.exports = {
				aliceblue: [240, 248, 255],
				antiquewhite: [250, 235, 215],
				aqua: [0, 255, 255],
				aquamarine: [127, 255, 212],
				azure: [240, 255, 255],
				beige: [245, 245, 220],
				bisque: [255, 228, 196],
				black: [0, 0, 0],
				blanchedalmond: [255, 235, 205],
				blue: [0, 0, 255],
				blueviolet: [138, 43, 226],
				brown: [165, 42, 42],
				burlywood: [222, 184, 135],
				cadetblue: [95, 158, 160],
				chartreuse: [127, 255, 0],
				chocolate: [210, 105, 30],
				coral: [255, 127, 80],
				cornflowerblue: [100, 149, 237],
				cornsilk: [255, 248, 220],
				crimson: [220, 20, 60],
				cyan: [0, 255, 255],
				darkblue: [0, 0, 139],
				darkcyan: [0, 139, 139],
				darkgoldenrod: [184, 134, 11],
				darkgray: [169, 169, 169],
				darkgreen: [0, 100, 0],
				darkgrey: [169, 169, 169],
				darkkhaki: [189, 183, 107],
				darkmagenta: [139, 0, 139],
				darkolivegreen: [85, 107, 47],
				darkorange: [255, 140, 0],
				darkorchid: [153, 50, 204],
				darkred: [139, 0, 0],
				darksalmon: [233, 150, 122],
				darkseagreen: [143, 188, 143],
				darkslateblue: [72, 61, 139],
				darkslategray: [47, 79, 79],
				darkslategrey: [47, 79, 79],
				darkturquoise: [0, 206, 209],
				darkviolet: [148, 0, 211],
				deeppink: [255, 20, 147],
				deepskyblue: [0, 191, 255],
				dimgray: [105, 105, 105],
				dimgrey: [105, 105, 105],
				dodgerblue: [30, 144, 255],
				firebrick: [178, 34, 34],
				floralwhite: [255, 250, 240],
				forestgreen: [34, 139, 34],
				fuchsia: [255, 0, 255],
				gainsboro: [220, 220, 220],
				ghostwhite: [248, 248, 255],
				gold: [255, 215, 0],
				goldenrod: [218, 165, 32],
				gray: [128, 128, 128],
				green: [0, 128, 0],
				greenyellow: [173, 255, 47],
				grey: [128, 128, 128],
				honeydew: [240, 255, 240],
				hotpink: [255, 105, 180],
				indianred: [205, 92, 92],
				indigo: [75, 0, 130],
				ivory: [255, 255, 240],
				khaki: [240, 230, 140],
				lavender: [230, 230, 250],
				lavenderblush: [255, 240, 245],
				lawngreen: [124, 252, 0],
				lemonchiffon: [255, 250, 205],
				lightblue: [173, 216, 230],
				lightcoral: [240, 128, 128],
				lightcyan: [224, 255, 255],
				lightgoldenrodyellow: [250, 250, 210],
				lightgray: [211, 211, 211],
				lightgreen: [144, 238, 144],
				lightgrey: [211, 211, 211],
				lightpink: [255, 182, 193],
				lightsalmon: [255, 160, 122],
				lightseagreen: [32, 178, 170],
				lightskyblue: [135, 206, 250],
				lightslategray: [119, 136, 153],
				lightslategrey: [119, 136, 153],
				lightsteelblue: [176, 196, 222],
				lightyellow: [255, 255, 224],
				lime: [0, 255, 0],
				limegreen: [50, 205, 50],
				linen: [250, 240, 230],
				magenta: [255, 0, 255],
				maroon: [128, 0, 0],
				mediumaquamarine: [102, 205, 170],
				mediumblue: [0, 0, 205],
				mediumorchid: [186, 85, 211],
				mediumpurple: [147, 112, 219],
				mediumseagreen: [60, 179, 113],
				mediumslateblue: [123, 104, 238],
				mediumspringgreen: [0, 250, 154],
				mediumturquoise: [72, 209, 204],
				mediumvioletred: [199, 21, 133],
				midnightblue: [25, 25, 112],
				mintcream: [245, 255, 250],
				mistyrose: [255, 228, 225],
				moccasin: [255, 228, 181],
				navajowhite: [255, 222, 173],
				navy: [0, 0, 128],
				oldlace: [253, 245, 230],
				olive: [128, 128, 0],
				olivedrab: [107, 142, 35],
				orange: [255, 165, 0],
				orangered: [255, 69, 0],
				orchid: [218, 112, 214],
				palegoldenrod: [238, 232, 170],
				palegreen: [152, 251, 152],
				paleturquoise: [175, 238, 238],
				palevioletred: [219, 112, 147],
				papayawhip: [255, 239, 213],
				peachpuff: [255, 218, 185],
				peru: [205, 133, 63],
				pink: [255, 192, 203],
				plum: [221, 160, 221],
				powderblue: [176, 224, 230],
				purple: [128, 0, 128],
				rebeccapurple: [102, 51, 153],
				red: [255, 0, 0],
				rosybrown: [188, 143, 143],
				royalblue: [65, 105, 225],
				saddlebrown: [139, 69, 19],
				salmon: [250, 128, 114],
				sandybrown: [244, 164, 96],
				seagreen: [46, 139, 87],
				seashell: [255, 245, 238],
				sienna: [160, 82, 45],
				silver: [192, 192, 192],
				skyblue: [135, 206, 235],
				slateblue: [106, 90, 205],
				slategray: [112, 128, 144],
				slategrey: [112, 128, 144],
				snow: [255, 250, 250],
				springgreen: [0, 255, 127],
				steelblue: [70, 130, 180],
				tan: [210, 180, 140],
				teal: [0, 128, 128],
				thistle: [216, 191, 216],
				tomato: [255, 99, 71],
				turquoise: [64, 224, 208],
				violet: [238, 130, 238],
				wheat: [245, 222, 179],
				white: [255, 255, 255],
				whitesmoke: [245, 245, 245],
				yellow: [255, 255, 0],
				yellowgreen: [154, 205, 50]
			}
		}, {}],
		6: [function (En, jn, t) {
			var e, n;
			e = this, n = function () {
				"use strict";
				var t, a;

				function c() {
					return t.apply(null, arguments)
				}

				function s(t) {
					return t instanceof Array || "[object Array]" === Object.prototype.toString.call(t)
				}

				function l(t) {
					return null != t && "[object Object]" === Object.prototype.toString.call(t)
				}

				function u(t) {
					return void 0 === t
				}

				function d(t) {
					return "number" == typeof t || "[object Number]" === Object.prototype.toString.call(t)
				}

				function h(t) {
					return t instanceof Date || "[object Date]" === Object.prototype.toString.call(t)
				}

				function f(t, e) {
					var n, i = [];
					for (n = 0; n < t.length; ++n) i.push(e(t[n], n));
					return i
				}

				function g(t, e) {
					return Object.prototype.hasOwnProperty.call(t, e)
				}

				function m(t, e) {
					for (var n in e) g(e, n) && (t[n] = e[n]);
					return g(e, "toString") && (t.toString = e.toString), g(e, "valueOf") && (t.valueOf = e.valueOf), t
				}

				function p(t, e, n, i) {
					return De(t, e, n, i, !0).utc()
				}

				function v(t) {
					return null == t._pf && (t._pf = {
						empty: !1,
						unusedTokens: [],
						unusedInput: [],
						overflow: -2,
						charsLeftOver: 0,
						nullInput: !1,
						invalidRonth: null,
						invalidFormat: !1,
						userInvalidated: !1,
						iso: !1,
						parsedDateParts: [],
						meridiem: null,
						rfc2822: !1,
						weekdayMismatch: !1
					}), t._pf
				}

				function b(t) {
					if (null == t._isValid) {
						var e = v(t),
							n = a.call(e.parsedDateParts, function (t) {
								return null != t
							}),
							i = !isNaN(t._d.getTime()) && e.overflow < 0 && !e.empty && !e.invalidRonth && !e.invalidWeekday && !e.weekdayMismatch && !e.nullInput && !e.invalidFormat && !e.userInvalidated && (!e.meridiem || e.meridiem && n);
						if (t._strict && (i = i && 0 === e.charsLeftOver && 0 === e.unusedTokens.length && void 0 === e.bigHour), null != Object.isFrozen && Object.isFrozen(t)) return i;
						t._isValid = i
					}
					return t._isValid
				}

				function y(t) {
					var e = p(NaN);
					return null != t ? m(v(e), t) : v(e).userInvalidated = !0, e
				}
				a = Array.prototype.some ? Array.prototype.some : function (t) {
					for (var e = Object(this), n = e.length >>> 0, i = 0; i < n; i++)
						if (i in e && t.call(this, e[i], i, e)) return !0;
					return !1
				};
				var r = c.momentProperties = [];

				function x(t, e) {
					var n, i, a;
					if (u(e._isAMomentObject) || (t._isAMomentObject = e._isAMomentObject), u(e._i) || (t._i = e._i), u(e._f) || (t._f = e._f), u(e._l) || (t._l = e._l), u(e._strict) || (t._strict = e._strict), u(e._tzm) || (t._tzm = e._tzm), u(e._isUTC) || (t._isUTC = e._isUTC), u(e._offset) || (t._offset = e._offset), u(e._pf) || (t._pf = v(e)), u(e._locale) || (t._locale = e._locale), 0 < r.length)
						for (n = 0; n < r.length; n++) u(a = e[i = r[n]]) || (t[i] = a);
					return t
				}
				var e = !1;

				function _(t) {
					x(this, t), this._d = new Date(null != t._d ? t._d.getTime() : NaN), this.isValid() || (this._d = new Date(NaN)), !1 === e && (e = !0, c.updateOffset(this), e = !1)
				}

				function k(t) {
					return t instanceof _ || null != t && null != t._isAMomentObject
				}

				function w(t) {
					return t < 0 ? Math.ceil(t) || 0 : Math.floor(t)
				}

				function M(t) {
					var e = +t,
						n = 0;
					return 0 !== e && isFinite(e) && (n = w(e)), n
				}

				function o(t, e, n) {
					var i, a = Math.min(t.length, e.length),
						r = Math.abs(t.length - e.length),
						o = 0;
					for (i = 0; i < a; i++)(n && t[i] !== e[i] || !n && M(t[i]) !== M(e[i])) && o++;
					return o + r
				}

				function S(t) {
					!1 === c.suppressDeprecationWarnings && "undefined" != typeof console && console.warn && console.warn("Deprecation warning: " + t)
				}

				function n(a, r) {
					var o = !0;
					return m(function () {
						if (null != c.deprecationHandler && c.deprecationHandler(null, a), o) {
							for (var t, e = [], n = 0; n < arguments.length; n++) {
								if (t = "", "object" == typeof arguments[n]) {
									for (var i in t += "\n[" + n + "] ", arguments[0]) t += i + ": " + arguments[0][i] + ", ";
									t = t.slice(0, -2)
								} else t = arguments[n];
								e.push(t)
							}
							S(a + "\nArguments: " + Array.prototype.slice.call(e).join("") + "\n" + (new Error).stack), o = !1
						}
						return r.apply(this, arguments)
					}, r)
				}
				var i, D = {};

				function C(t, e) {
					null != c.deprecationHandler && c.deprecationHandler(t, e), D[t] || (S(e), D[t] = !0)
				}

				function P(t) {
					return t instanceof Function || "[object Function]" === Object.prototype.toString.call(t)
				}

				function T(t, e) {
					var n, i = m({}, t);
					for (n in e) g(e, n) && (l(t[n]) && l(e[n]) ? (i[n] = {}, m(i[n], t[n]), m(i[n], e[n])) : null != e[n] ? i[n] = e[n] : delete i[n]);
					for (n in t) g(t, n) && !g(e, n) && l(t[n]) && (i[n] = m({}, i[n]));
					return i
				}

				function O(t) {
					null != t && this.set(t)
				}
				c.suppressDeprecationWarnings = !1, c.deprecationHandler = null, i = Object.keys ? Object.keys : function (t) {
					var e, n = [];
					for (e in t) g(t, e) && n.push(e);
					return n
				};
				var I = {};

				function A(t, e) {
					var n = t.toLowerCase();
					I[n] = I[n + "s"] = I[e] = t
				}

				function F(t) {
					return "string" == typeof t ? I[t] || I[t.toLowerCase()] : void 0
				}

				function R(t) {
					var e, n, i = {};
					for (n in t) g(t, n) && (e = F(n)) && (i[e] = t[n]);
					return i
				}
				var L = {};

				function Y(t, e) {
					L[t] = e
				}

				function W(t, e, n) {
					var i = "" + Math.abs(t),
						a = e - i.length;
					return (0 <= t ? n ? "+" : "" : "-") + Math.pow(10, Math.max(0, a)).toString().substr(1) + i
				}
				var N = /(\[[^\[]*\])|(\\)?([Hh]mm(ss)?|Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Qo?|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|kk?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g,
					z = /(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g,
					V = {},
					H = {};

				function B(t, e, n, i) {
					var a = i;
					"string" == typeof i && (a = function () {
						return this[i]()
					}), t && (H[t] = a), e && (H[e[0]] = function () {
						return W(a.apply(this, arguments), e[1], e[2])
					}), n && (H[n] = function () {
						return this.localeData().ordinal(a.apply(this, arguments), t)
					})
				}

				function E(t, e) {
					return t.isValid() ? (e = j(e, t.localeData()), V[e] = V[e] || function (i) {
						var t, a, e, r = i.match(N);
						for (t = 0, a = r.length; t < a; t++) H[r[t]] ? r[t] = H[r[t]] : r[t] = (e = r[t]).match(/\[[\s\S]/) ? e.replace(/^\[|\]$/g, "") : e.replace(/\\/g, "");
						return function (t) {
							var e, n = "";
							for (e = 0; e < a; e++) n += P(r[e]) ? r[e].call(t, i) : r[e];
							return n
						}
					}(e), V[e](t)) : t.localeData().invalidDate()
				}

				function j(t, e) {
					var n = 5;

					function i(t) {
						return e.longDateFormat(t) || t
					}
					for (z.lastIndex = 0; 0 <= n && z.test(t);) t = t.replace(z, i), z.lastIndex = 0, n -= 1;
					return t
				}
				var U = /\d/,
					G = /\d\d/,
					q = /\d{3}/,
					Z = /\d{4}/,
					X = /[+-]?\d{6}/,
					J = /\d\d?/,
					$ = /\d\d\d\d?/,
					K = /\d\d\d\d\d\d?/,
					Q = /\d{1,3}/,
					tt = /\d{1,4}/,
					et = /[+-]?\d{1,6}/,
					nt = /\d+/,
					it = /[+-]?\d+/,
					at = /Z|[+-]\d\d:?\d\d/gi,
					rt = /Z|[+-]\d\d(?::?\d\d)?/gi,
					ot = /[0-9]{0,256}['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFF07\uFF10-\uFFEF]{1,256}|[\u0600-\u06FF\/]{1,256}(\s*?[\u0600-\u06FF]{1,256}){1,2}/i,
					st = {};

				function lt(t, n, i) {
					st[t] = P(n) ? n : function (t, e) {
						return t && i ? i : n
					}
				}

				function ut(t, e) {
					return g(st, t) ? st[t](e._strict, e._locale) : new RegExp(dt(t.replace("\\", "").replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g, function (t, e, n, i, a) {
						return e || n || i || a
					})))
				}

				function dt(t) {
					return t.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&")
				}
				var ht = {};

				function ct(t, n) {
					var e, i = n;
					for ("string" == typeof t && (t = [t]), d(n) && (i = function (t, e) {
						e[n] = M(t)
					}), e = 0; e < t.length; e++) ht[t[e]] = i
				}

				function ft(t, a) {
					ct(t, function (t, e, n, i) {
						n._w = n._w || {}, a(t, n._w, n, i)
					})
				}
				var gt = 0,
					mt = 1,
					pt = 2,
					vt = 3,
					bt = 4,
					yt = 5,
					xt = 6,
					_t = 7,
					kt = 8;

				function wt(t) {
					return Mt(t) ? 366 : 365
				}

				function Mt(t) {
					return t % 4 == 0 && t % 100 != 0 || t % 400 == 0
				}
				B("Y", 0, 0, function () {
					var t = this.year();
					return t <= 9999 ? "" + t : "+" + t
				}), B(0, ["YY", 2], 0, function () {
					return this.year() % 100
				}), B(0, ["YYYY", 4], 0, "year"), B(0, ["YYYYY", 5], 0, "year"), B(0, ["YYYYYY", 6, !0], 0, "year"), A("year", "y"), Y("year", 1), lt("Y", it), lt("YY", J, G), lt("YYYY", tt, Z), lt("YYYYY", et, X), lt("YYYYYY", et, X), ct(["YYYYY", "YYYYYY"], gt), ct("YYYY", function (t, e) {
					e[gt] = 2 === t.length ? c.parseTwoDigitYear(t) : M(t)
				}), ct("YY", function (t, e) {
					e[gt] = c.parseTwoDigitYear(t)
				}), ct("Y", function (t, e) {
					e[gt] = parseInt(t, 10)
				}), c.parseTwoDigitYear = function (t) {
					return M(t) + (68 < M(t) ? 1900 : 2e3)
				};
				var St, Dt = Ct("FullYear", !0);

				function Ct(e, n) {
					return function (t) {
						return null != t ? (Tt(this, e, t), c.updateOffset(this, n), this) : Pt(this, e)
					}
				}

				function Pt(t, e) {
					return t.isValid() ? t._d["get" + (t._isUTC ? "UTC" : "") + e]() : NaN
				}

				function Tt(t, e, n) {
					t.isValid() && !isNaN(n) && ("FullYear" === e && Mt(t.year()) && 1 === t.month() && 29 === t.date() ? t._d["set" + (t._isUTC ? "UTC" : "") + e](n, t.month(), Ot(n, t.month())) : t._d["set" + (t._isUTC ? "UTC" : "") + e](n))
				}

				function Ot(t, e) {
					if (isNaN(t) || isNaN(e)) return NaN;
					var n, i = (e % (n = 12) + n) % n;
					return t += (e - i) / 12, 1 === i ? Mt(t) ? 29 : 28 : 31 - i % 7 % 2
				}
				St = Array.prototype.indexOf ? Array.prototype.indexOf : function (t) {
					var e;
					for (e = 0; e < this.length; ++e)
						if (this[e] === t) return e;
					return -1
				}, B("M", ["MM", 2], "Mo", function () {
					return this.month() + 1
				}), B("MMM", 0, 0, function (t) {
					return this.localeData().monthsShort(this, t)
				}), B("MMMM", 0, 0, function (t) {
					return this.localeData().months(this, t)
				}), A("month", "M"), Y("month", 8), lt("M", J), lt("MM", J, G), lt("MMM", function (t, e) {
					return e.monthsShortRegex(t)
				}), lt("MMMM", function (t, e) {
					return e.monthsRegex(t)
				}), ct(["M", "MM"], function (t, e) {
					e[mt] = M(t) - 1
				}), ct(["MMM", "MMMM"], function (t, e, n, i) {
					var a = n._locale.monthsParse(t, i, n._strict);
					null != a ? e[mt] = a : v(n).invalidRonth = t
				});
				var It = /D[oD]?(\[[^\[\]]*\]|\s)+MMMM?/,
					At = "January_February_March_April_May_June_July_August_September_October_November_December".split("_");
				var Ft = "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_");

				function Rt(t, e) {
					var n;
					if (!t.isValid()) return t;
					if ("string" == typeof e)
						if (/^\d+$/.test(e)) e = M(e);
						else if (!d(e = t.localeData().monthsParse(e))) return t;
					return n = Math.min(t.date(), Ot(t.year(), e)), t._d["set" + (t._isUTC ? "UTC" : "") + "Month"](e, n), t
				}

				function Lt(t) {
					return null != t ? (Rt(this, t), c.updateOffset(this, !0), this) : Pt(this, "Month")
				}
				var Yt = ot;
				var Wt = ot;

				function Nt() {
					function t(t, e) {
						return e.length - t.length
					}
					var e, n, i = [],
						a = [],
						r = [];
					for (e = 0; e < 12; e++) n = p([2e3, e]), i.push(this.monthsShort(n, "")), a.push(this.months(n, "")), r.push(this.months(n, "")), r.push(this.monthsShort(n, ""));
					for (i.sort(t), a.sort(t), r.sort(t), e = 0; e < 12; e++) i[e] = dt(i[e]), a[e] = dt(a[e]);
					for (e = 0; e < 24; e++) r[e] = dt(r[e]);
					this._monthsRegex = new RegExp("^(" + r.join("|") + ")", "i"), this._monthsShortRegex = this._monthsRegex, this._monthsStrictRegex = new RegExp("^(" + a.join("|") + ")", "i"), this._monthsShortStrictRegex = new RegExp("^(" + i.join("|") + ")", "i")
				}

				function zt(t) {
					var e = new Date(Date.UTC.apply(null, arguments));
					return t < 100 && 0 <= t && isFinite(e.getUTCFullYear()) && e.setUTCFullYear(t), e
				}

				function Vt(t, e, n) {
					var i = 7 + e - n;
					return -((7 + zt(t, 0, i).getUTCDay() - e) % 7) + i - 1
				}

				function Ht(t, e, n, i, a) {
					var r, o, s = 1 + 7 * (e - 1) + (7 + n - i) % 7 + Vt(t, i, a);
					return o = s <= 0 ? wt(r = t - 1) + s : s > wt(t) ? (r = t + 1, s - wt(t)) : (r = t, s), {
						year: r,
						dayOfYear: o
					}
				}

				function Bt(t, e, n) {
					var i, a, r = Vt(t.year(), e, n),
						o = Math.floor((t.dayOfYear() - r - 1) / 7) + 1;
					return o < 1 ? i = o + Et(a = t.year() - 1, e, n) : o > Et(t.year(), e, n) ? (i = o - Et(t.year(), e, n), a = t.year() + 1) : (a = t.year(), i = o), {
						week: i,
						year: a
					}
				}

				function Et(t, e, n) {
					var i = Vt(t, e, n),
						a = Vt(t + 1, e, n);
					return (wt(t) - i + a) / 7
				}
				B("w", ["ww", 2], "wo", "week"), B("W", ["WW", 2], "Wo", "isoWeek"), A("week", "w"), A("isoWeek", "W"), Y("week", 5), Y("isoWeek", 5), lt("w", J), lt("ww", J, G), lt("W", J), lt("WW", J, G), ft(["w", "ww", "W", "WW"], function (t, e, n, i) {
					e[i.substr(0, 1)] = M(t)
				});
				B("d", 0, "do", "day"), B("dd", 0, 0, function (t) {
					return this.localeData().weekdaysMin(this, t)
				}), B("ddd", 0, 0, function (t) {
					return this.localeData().weekdaysShort(this, t)
				}), B("dddd", 0, 0, function (t) {
					return this.localeData().weekdays(this, t)
				}), B("e", 0, 0, "weekday"), B("E", 0, 0, "isoWeekday"), A("day", "d"), A("weekday", "e"), A("isoWeekday", "E"), Y("day", 11), Y("weekday", 11), Y("isoWeekday", 11), lt("d", J), lt("e", J), lt("E", J), lt("dd", function (t, e) {
					return e.weekdaysMinRegex(t)
				}), lt("ddd", function (t, e) {
					return e.weekdaysShortRegex(t)
				}), lt("dddd", function (t, e) {
					return e.weekdaysRegex(t)
				}), ft(["dd", "ddd", "dddd"], function (t, e, n, i) {
					var a = n._locale.weekdaysParse(t, i, n._strict);
					null != a ? e.d = a : v(n).invalidWeekday = t
				}), ft(["d", "e", "E"], function (t, e, n, i) {
					e[i] = M(t)
				});
				var jt = "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_");
				var Ut = "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_");
				var Gt = "Su_Mo_Tu_We_Th_Fr_Sa".split("_");
				var qt = ot;
				var Zt = ot;
				var Xt = ot;

				function Jt() {
					function t(t, e) {
						return e.length - t.length
					}
					var e, n, i, a, r, o = [],
						s = [],
						l = [],
						u = [];
					for (e = 0; e < 7; e++) n = p([2e3, 1]).day(e), i = this.weekdaysMin(n, ""), a = this.weekdaysShort(n, ""), r = this.weekdays(n, ""), o.push(i), s.push(a), l.push(r), u.push(i), u.push(a), u.push(r);
					for (o.sort(t), s.sort(t), l.sort(t), u.sort(t), e = 0; e < 7; e++) s[e] = dt(s[e]), l[e] = dt(l[e]), u[e] = dt(u[e]);
					this._weekdaysRegex = new RegExp("^(" + u.join("|") + ")", "i"), this._weekdaysShortRegex = this._weekdaysRegex, this._weekdaysMinRegex = this._weekdaysRegex, this._weekdaysStrictRegex = new RegExp("^(" + l.join("|") + ")", "i"), this._weekdaysShortStrictRegex = new RegExp("^(" + s.join("|") + ")", "i"), this._weekdaysMinStrictRegex = new RegExp("^(" + o.join("|") + ")", "i")
				}

				function $t() {
					return this.hours() % 12 || 12
				}

				function Kt(t, e) {
					B(t, 0, 0, function () {
						return this.localeData().meridiem(this.hours(), this.minutes(), e)
					})
				}

				function Qt(t, e) {
					return e._meridiemParse
				}
				B("H", ["HH", 2], 0, "hour"), B("h", ["hh", 2], 0, $t), B("k", ["kk", 2], 0, function () {
					return this.hours() || 24
				}), B("hmm", 0, 0, function () {
					return "" + $t.apply(this) + W(this.minutes(), 2)
				}), B("hmmss", 0, 0, function () {
					return "" + $t.apply(this) + W(this.minutes(), 2) + W(this.seconds(), 2)
				}), B("Hmm", 0, 0, function () {
					return "" + this.hours() + W(this.minutes(), 2)
				}), B("Hmmss", 0, 0, function () {
					return "" + this.hours() + W(this.minutes(), 2) + W(this.seconds(), 2)
				}), Kt("a", !0), Kt("A", !1), A("hour", "h"), Y("hour", 13), lt("a", Qt), lt("A", Qt), lt("H", J), lt("h", J), lt("k", J), lt("HH", J, G), lt("hh", J, G), lt("kk", J, G), lt("hmm", $), lt("hmmss", K), lt("Hmm", $), lt("Hmmss", K), ct(["H", "HH"], vt), ct(["k", "kk"], function (t, e, n) {
					var i = M(t);
					e[vt] = 24 === i ? 0 : i
				}), ct(["a", "A"], function (t, e, n) {
					n._isPm = n._locale.isPM(t), n._meridiem = t
				}), ct(["h", "hh"], function (t, e, n) {
					e[vt] = M(t), v(n).bigHour = !0
				}), ct("hmm", function (t, e, n) {
					var i = t.length - 2;
					e[vt] = M(t.substr(0, i)), e[bt] = M(t.substr(i)), v(n).bigHour = !0
				}), ct("hmmss", function (t, e, n) {
					var i = t.length - 4,
						a = t.length - 2;
					e[vt] = M(t.substr(0, i)), e[bt] = M(t.substr(i, 2)), e[yt] = M(t.substr(a)), v(n).bigHour = !0
				}), ct("Hmm", function (t, e, n) {
					var i = t.length - 2;
					e[vt] = M(t.substr(0, i)), e[bt] = M(t.substr(i))
				}), ct("Hmmss", function (t, e, n) {
					var i = t.length - 4,
						a = t.length - 2;
					e[vt] = M(t.substr(0, i)), e[bt] = M(t.substr(i, 2)), e[yt] = M(t.substr(a))
				});
				var te, ee = Ct("Hours", !0),
					ne = {
						calendar: {
							sameDay: "[Today at] LT",
							nextDay: "[Tomorrow at] LT",
							nextWeek: "dddd [at] LT",
							lastDay: "[Yesterday at] LT",
							lastWeek: "[Last] dddd [at] LT",
							sameElse: "L"
						},
						longDateFormat: {
							LTS: "h:mm:ss A",
							LT: "h:mm A",
							L: "MM/DD/YYYY",
							LL: "MMMM D, YYYY",
							LLL: "MMMM D, YYYY h:mm A",
							LLLL: "dddd, MMMM D, YYYY h:mm A"
						},
						invalidDate: "Invalid date",
						ordinal: "%d",
						dayOfMonthOrdinalParse: /\d{1,2}/,
						relativeTime: {
							future: "in %s",
							past: "%s ago",
							s: "a few seconds",
							ss: "%d seconds",
							m: "a minute",
							mm: "%d minutes",
							h: "an hour",
							hh: "%d hours",
							d: "a day",
							dd: "%d days",
							M: "a month",
							MM: "%d months",
							y: "a year",
							yy: "%d years"
						},
						months: At,
						monthsShort: Ft,
						week: {
							dow: 0,
							doy: 6
						},
						weekdays: jt,
						weekdaysMin: Gt,
						weekdaysShort: Ut,
						meridiemParse: /[ap]\.?m?\.?/i
					},
					ie = {},
					ae = {};

				function re(t) {
					return t ? t.toLowerCase().replace("_", "-") : t
				}

				function oe(t) {
					var e = null;
					if (!ie[t] && void 0 !== jn && jn && jn.exports) try {
						e = te._abbr, En("./locale/" + t), se(e)
					} catch (t) { }
					return ie[t]
				}

				function se(t, e) {
					var n;
					return t && ((n = u(e) ? ue(t) : le(t, e)) ? te = n : "undefined" != typeof console && console.warn && console.warn("Locale " + t + " not found. Did you forget to load it?")), te._abbr
				}

				function le(t, e) {
					if (null === e) return delete ie[t], null;
					var n, i = ne;
					if (e.abbr = t, null != ie[t]) C("defineLocaleOverride", "use moment.updateLocale(localeName, config) to change an existing locale. moment.defineLocale(localeName, config) should only be used for creating a new locale See http://momentjs.com/guides/#/warnings/define-locale/ for more info."), i = ie[t]._config;
					else if (null != e.parentLocale)
						if (null != ie[e.parentLocale]) i = ie[e.parentLocale]._config;
						else {
							if (null == (n = oe(e.parentLocale))) return ae[e.parentLocale] || (ae[e.parentLocale] = []), ae[e.parentLocale].push({
								name: t,
								config: e
							}), null;
							i = n._config
						}
					return ie[t] = new O(T(i, e)), ae[t] && ae[t].forEach(function (t) {
						le(t.name, t.config)
					}), se(t), ie[t]
				}

				function ue(t) {
					var e;
					if (t && t._locale && t._locale._abbr && (t = t._locale._abbr), !t) return te;
					if (!s(t)) {
						if (e = oe(t)) return e;
						t = [t]
					}
					return function (t) {
						for (var e, n, i, a, r = 0; r < t.length;) {
							for (e = (a = re(t[r]).split("-")).length, n = (n = re(t[r + 1])) ? n.split("-") : null; 0 < e;) {
								if (i = oe(a.slice(0, e).join("-"))) return i;
								if (n && n.length >= e && o(a, n, !0) >= e - 1) break;
								e--
							}
							r++
						}
						return te
					}(t)
				}

				function de(t) {
					var e, n = t._a;
					return n && -2 === v(t).overflow && (e = n[mt] < 0 || 11 < n[mt] ? mt : n[pt] < 1 || n[pt] > Ot(n[gt], n[mt]) ? pt : n[vt] < 0 || 24 < n[vt] || 24 === n[vt] && (0 !== n[bt] || 0 !== n[yt] || 0 !== n[xt]) ? vt : n[bt] < 0 || 59 < n[bt] ? bt : n[yt] < 0 || 59 < n[yt] ? yt : n[xt] < 0 || 999 < n[xt] ? xt : -1, v(t)._overflowDayOfYear && (e < gt || pt < e) && (e = pt), v(t)._overflowWeeks && -1 === e && (e = _t), v(t)._overflowWeekday && -1 === e && (e = kt), v(t).overflow = e), t
				}

				function he(t, e, n) {
					return null != t ? t : null != e ? e : n
				}

				function ce(t) {
					var e, n, i, a, r, o = [];
					if (!t._d) {
						var s, l;
						for (s = t, l = new Date(c.now()), i = s._useUTC ? [l.getUTCFullYear(), l.getUTCMonth(), l.getUTCDate()] : [l.getFullYear(), l.getMonth(), l.getDate()], t._w && null == t._a[pt] && null == t._a[mt] && function (t) {
							var e, n, i, a, r, o, s, l;
							if (null != (e = t._w).GG || null != e.W || null != e.E) r = 1, o = 4, n = he(e.GG, t._a[gt], Bt(Ce(), 1, 4).year), i = he(e.W, 1), ((a = he(e.E, 1)) < 1 || 7 < a) && (l = !0);
							else {
								r = t._locale._week.dow, o = t._locale._week.doy;
								var u = Bt(Ce(), r, o);
								n = he(e.gg, t._a[gt], u.year), i = he(e.w, u.week), null != e.d ? ((a = e.d) < 0 || 6 < a) && (l = !0) : null != e.e ? (a = e.e + r, (e.e < 0 || 6 < e.e) && (l = !0)) : a = r
							}
							i < 1 || i > Et(n, r, o) ? v(t)._overflowWeeks = !0 : null != l ? v(t)._overflowWeekday = !0 : (s = Ht(n, i, a, r, o), t._a[gt] = s.year, t._dayOfYear = s.dayOfYear)
						}(t), null != t._dayOfYear && (r = he(t._a[gt], i[gt]), (t._dayOfYear > wt(r) || 0 === t._dayOfYear) && (v(t)._overflowDayOfYear = !0), n = zt(r, 0, t._dayOfYear), t._a[mt] = n.getUTCMonth(), t._a[pt] = n.getUTCDate()), e = 0; e < 3 && null == t._a[e]; ++e) t._a[e] = o[e] = i[e];
						for (; e < 7; e++) t._a[e] = o[e] = null == t._a[e] ? 2 === e ? 1 : 0 : t._a[e];
						24 === t._a[vt] && 0 === t._a[bt] && 0 === t._a[yt] && 0 === t._a[xt] && (t._nextDay = !0, t._a[vt] = 0), t._d = (t._useUTC ? zt : function (t, e, n, i, a, r, o) {
							var s = new Date(t, e, n, i, a, r, o);
							return t < 100 && 0 <= t && isFinite(s.getFullYear()) && s.setFullYear(t), s
						}).apply(null, o), a = t._useUTC ? t._d.getUTCDay() : t._d.getDay(), null != t._tzm && t._d.setUTCMinutes(t._d.getUTCMinutes() - t._tzm), t._nextDay && (t._a[vt] = 24), t._w && void 0 !== t._w.d && t._w.d !== a && (v(t).weekdayMismatch = !0)
					}
				}
				var fe = /^\s*((?:[+-]\d{6}|\d{4})-(?:\d\d-\d\d|W\d\d-\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?::\d\d(?::\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,
					ge = /^\s*((?:[+-]\d{6}|\d{4})(?:\d\d\d\d|W\d\d\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?:\d\d(?:\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,
					me = /Z|[+-]\d\d(?::?\d\d)?/,
					pe = [
						["YYYYYY-MM-DD", /[+-]\d{6}-\d\d-\d\d/],
						["YYYY-MM-DD", /\d{4}-\d\d-\d\d/],
						["GGGG-[W]WW-E", /\d{4}-W\d\d-\d/],
						["GGGG-[W]WW", /\d{4}-W\d\d/, !1],
						["YYYY-DDD", /\d{4}-\d{3}/],
						["YYYY-MM", /\d{4}-\d\d/, !1],
						["YYYYYYMMDD", /[+-]\d{10}/],
						["YYYYMMDD", /\d{8}/],
						["GGGG[W]WWE", /\d{4}W\d{3}/],
						["GGGG[W]WW", /\d{4}W\d{2}/, !1],
						["YYYYDDD", /\d{7}/]
					],
					ve = [
						["HH:mm:ss.SSSS", /\d\d:\d\d:\d\d\.\d+/],
						["HH:mm:ss,SSSS", /\d\d:\d\d:\d\d,\d+/],
						["HH:mm:ss", /\d\d:\d\d:\d\d/],
						["HH:mm", /\d\d:\d\d/],
						["HHmmss.SSSS", /\d\d\d\d\d\d\.\d+/],
						["HHmmss,SSSS", /\d\d\d\d\d\d,\d+/],
						["HHmmss", /\d\d\d\d\d\d/],
						["HHmm", /\d\d\d\d/],
						["HH", /\d\d/]
					],
					be = /^\/?Date\((\-?\d+)/i;

				function ye(t) {
					var e, n, i, a, r, o, s = t._i,
						l = fe.exec(s) || ge.exec(s);
					if (l) {
						for (v(t).iso = !0, e = 0, n = pe.length; e < n; e++)
							if (pe[e][1].exec(l[1])) {
								a = pe[e][0], i = !1 !== pe[e][2];
								break
							}
						if (null == a) return void (t._isValid = !1);
						if (l[3]) {
							for (e = 0, n = ve.length; e < n; e++)
								if (ve[e][1].exec(l[3])) {
									r = (l[2] || " ") + ve[e][0];
									break
								}
							if (null == r) return void (t._isValid = !1)
						}
						if (!i && null != r) return void (t._isValid = !1);
						if (l[4]) {
							if (!me.exec(l[4])) return void (t._isValid = !1);
							o = "Z"
						}
						t._f = a + (r || "") + (o || ""), Me(t)
					} else t._isValid = !1
				}
				var xe = /^(?:(Mon|Tue|Wed|Thu|Fri|Sat|Sun),?\s)?(\d{1,2})\s(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s(\d{2,4})\s(\d\d):(\d\d)(?::(\d\d))?\s(?:(UT|GMT|[ECMP][SD]T)|([Zz])|([+-]\d{4}))$/;

				function _e(t, e, n, i, a, r) {
					var o = [function (t) {
						var e = parseInt(t, 10); {
							if (e <= 49) return 2e3 + e;
							if (e <= 999) return 1900 + e
						}
						return e
					}(t), Ft.indexOf(e), parseInt(n, 10), parseInt(i, 10), parseInt(a, 10)];
					return r && o.push(parseInt(r, 10)), o
				}
				var ke = {
					UT: 0,
					GMT: 0,
					EDT: -240,
					EST: -300,
					CDT: -300,
					CST: -360,
					MDT: -360,
					MST: -420,
					PDT: -420,
					PST: -480
				};

				function we(t) {
					var e, n, i, a = xe.exec(t._i.replace(/\([^)]*\)|[\n\t]/g, " ").replace(/(\s\s+)/g, " ").replace(/^\s\s*/, "").replace(/\s\s*$/, ""));
					if (a) {
						var r = _e(a[4], a[3], a[2], a[5], a[6], a[7]);
						if (e = a[1], n = r, i = t, e && Ut.indexOf(e) !== new Date(n[0], n[1], n[2]).getDay() && (v(i).weekdayMismatch = !0, !(i._isValid = !1))) return;
						t._a = r, t._tzm = function (t, e, n) {
							if (t) return ke[t];
							if (e) return 0;
							var i = parseInt(n, 10),
								a = i % 100;
							return (i - a) / 100 * 60 + a
						}(a[8], a[9], a[10]), t._d = zt.apply(null, t._a), t._d.setUTCMinutes(t._d.getUTCMinutes() - t._tzm), v(t).rfc2822 = !0
					} else t._isValid = !1
				}

				function Me(t) {
					if (t._f !== c.ISO_8601)
						if (t._f !== c.RFC_2822) {
							t._a = [], v(t).empty = !0;
							var e, n, i, a, r, o, s, l, u = "" + t._i,
								d = u.length,
								h = 0;
							for (i = j(t._f, t._locale).match(N) || [], e = 0; e < i.length; e++) a = i[e], (n = (u.match(ut(a, t)) || [])[0]) && (0 < (r = u.substr(0, u.indexOf(n))).length && v(t).unusedInput.push(r), u = u.slice(u.indexOf(n) + n.length), h += n.length), H[a] ? (n ? v(t).empty = !1 : v(t).unusedTokens.push(a), o = a, l = t, null != (s = n) && g(ht, o) && ht[o](s, l._a, l, o)) : t._strict && !n && v(t).unusedTokens.push(a);
							v(t).charsLeftOver = d - h, 0 < u.length && v(t).unusedInput.push(u), t._a[vt] <= 12 && !0 === v(t).bigHour && 0 < t._a[vt] && (v(t).bigHour = void 0), v(t).parsedDateParts = t._a.slice(0), v(t).meridiem = t._meridiem, t._a[vt] = function (t, e, n) {
								var i;
								if (null == n) return e;
								return null != t.meridiemHour ? t.meridiemHour(e, n) : (null != t.isPM && ((i = t.isPM(n)) && e < 12 && (e += 12), i || 12 !== e || (e = 0)), e)
							}(t._locale, t._a[vt], t._meridiem), ce(t), de(t)
						} else we(t);
					else ye(t)
				}

				function Se(t) {
					var e, n, i, a, r = t._i,
						o = t._f;
					return t._locale = t._locale || ue(t._l), null === r || void 0 === o && "" === r ? y({
						nullInput: !0
					}) : ("string" == typeof r && (t._i = r = t._locale.preparse(r)), k(r) ? new _(de(r)) : (h(r) ? t._d = r : s(o) ? function (t) {
						var e, n, i, a, r;
						if (0 === t._f.length) return v(t).invalidFormat = !0, t._d = new Date(NaN);
						for (a = 0; a < t._f.length; a++) r = 0, e = x({}, t), null != t._useUTC && (e._useUTC = t._useUTC), e._f = t._f[a], Me(e), b(e) && (r += v(e).charsLeftOver, r += 10 * v(e).unusedTokens.length, v(e).score = r, (null == i || r < i) && (i = r, n = e));
						m(t, n || e)
					}(t) : o ? Me(t) : u(n = (e = t)._i) ? e._d = new Date(c.now()) : h(n) ? e._d = new Date(n.valueOf()) : "string" == typeof n ? (i = e, null === (a = be.exec(i._i)) ? (ye(i), !1 === i._isValid && (delete i._isValid, we(i), !1 === i._isValid && (delete i._isValid, c.createFromInputFallback(i)))) : i._d = new Date(+a[1])) : s(n) ? (e._a = f(n.slice(0), function (t) {
						return parseInt(t, 10)
					}), ce(e)) : l(n) ? function (t) {
						if (!t._d) {
							var e = R(t._i);
							t._a = f([e.year, e.month, e.day || e.date, e.hour, e.minute, e.second, e.millisecond], function (t) {
								return t && parseInt(t, 10)
							}), ce(t)
						}
					}(e) : d(n) ? e._d = new Date(n) : c.createFromInputFallback(e), b(t) || (t._d = null), t))
				}

				function De(t, e, n, i, a) {
					var r, o = {};
					return !0 !== n && !1 !== n || (i = n, n = void 0), (l(t) && function (t) {
						if (Object.getOwnPropertyNames) return 0 === Object.getOwnPropertyNames(t).length;
						var e;
						for (e in t)
							if (t.hasOwnProperty(e)) return !1;
						return !0
					}(t) || s(t) && 0 === t.length) && (t = void 0), o._isAMomentObject = !0, o._useUTC = o._isUTC = a, o._l = n, o._i = t, o._f = e, o._strict = i, (r = new _(de(Se(o))))._nextDay && (r.add(1, "d"), r._nextDay = void 0), r
				}

				function Ce(t, e, n, i) {
					return De(t, e, n, i, !1)
				}
				c.createFromInputFallback = n("value provided is not in a recognized RFC2822 or ISO format. moment construction falls back to js Date(), which is not reliable across all browsers and versions. Non RFC2822/ISO date formats are discouraged and will be removed in an upcoming major release. Please refer to http://momentjs.com/guides/#/warnings/js-date/ for more info.", function (t) {
					t._d = new Date(t._i + (t._useUTC ? " UTC" : ""))
				}), c.ISO_8601 = function () { }, c.RFC_2822 = function () { };
				var Pe = n("moment().min is deprecated, use moment.max instead. http://momentjs.com/guides/#/warnings/min-max/", function () {
					var t = Ce.apply(null, arguments);
					return this.isValid() && t.isValid() ? t < this ? this : t : y()
				}),
					Te = n("moment().max is deprecated, use moment.min instead. http://momentjs.com/guides/#/warnings/min-max/", function () {
						var t = Ce.apply(null, arguments);
						return this.isValid() && t.isValid() ? this < t ? this : t : y()
					});

				function Oe(t, e) {
					var n, i;
					if (1 === e.length && s(e[0]) && (e = e[0]), !e.length) return Ce();
					for (n = e[0], i = 1; i < e.length; ++i) e[i].isValid() && !e[i][t](n) || (n = e[i]);
					return n
				}
				var Ie = ["year", "quarter", "month", "week", "day", "hour", "minute", "second", "millisecond"];

				function Ae(t) {
					var e = R(t),
						n = e.year || 0,
						i = e.quarter || 0,
						a = e.month || 0,
						r = e.week || 0,
						o = e.day || 0,
						s = e.hour || 0,
						l = e.minute || 0,
						u = e.second || 0,
						d = e.millisecond || 0;
					this._isValid = function (t) {
						for (var e in t)
							if (-1 === St.call(Ie, e) || null != t[e] && isNaN(t[e])) return !1;
						for (var n = !1, i = 0; i < Ie.length; ++i)
							if (t[Ie[i]]) {
								if (n) return !1;
								parseFloat(t[Ie[i]]) !== M(t[Ie[i]]) && (n = !0)
							}
						return !0
					}(e), this._milliseconds = +d + 1e3 * u + 6e4 * l + 1e3 * s * 60 * 60, this._days = +o + 7 * r, this._months = +a + 3 * i + 12 * n, this._data = {}, this._locale = ue(), this._bubble()
				}

				function Fe(t) {
					return t instanceof Ae
				}

				function Re(t) {
					return t < 0 ? -1 * Math.round(-1 * t) : Math.round(t)
				}

				function Le(t, n) {
					B(t, 0, 0, function () {
						var t = this.utcOffset(),
							e = "+";
						return t < 0 && (t = -t, e = "-"), e + W(~~(t / 60), 2) + n + W(~~t % 60, 2)
					})
				}
				Le("Z", ":"), Le("ZZ", ""), lt("Z", rt), lt("ZZ", rt), ct(["Z", "ZZ"], function (t, e, n) {
					n._useUTC = !0, n._tzm = We(rt, t)
				});
				var Ye = /([\+\-]|\d\d)/gi;

				function We(t, e) {
					var n = (e || "").match(t);
					if (null === n) return null;
					var i = ((n[n.length - 1] || []) + "").match(Ye) || ["-", 0, 0],
						a = 60 * i[1] + M(i[2]);
					return 0 === a ? 0 : "+" === i[0] ? a : -a
				}

				function Ne(t, e) {
					var n, i;
					return e._isUTC ? (n = e.clone(), i = (k(t) || h(t) ? t.valueOf() : Ce(t).valueOf()) - n.valueOf(), n._d.setTime(n._d.valueOf() + i), c.updateOffset(n, !1), n) : Ce(t).local()
				}

				function ze(t) {
					return 15 * -Math.round(t._d.getTimezoneOffset() / 15)
				}

				function Ve() {
					return !!this.isValid() && (this._isUTC && 0 === this._offset)
				}
				c.updateOffset = function () { };
				var He = /^(\-|\+)?(?:(\d*)[. ])?(\d+)\:(\d+)(?:\:(\d+)(\.\d*)?)?$/,
					Be = /^(-|\+)?P(?:([-+]?[0-9,.]*)Y)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)W)?(?:([-+]?[0-9,.]*)D)?(?:T(?:([-+]?[0-9,.]*)H)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)S)?)?$/;

				function Ee(t, e) {
					var n, i, a, r = t,
						o = null;
					return Fe(t) ? r = {
						ms: t._milliseconds,
						d: t._days,
						M: t._months
					} : d(t) ? (r = {}, e ? r[e] = t : r.milliseconds = t) : (o = He.exec(t)) ? (n = "-" === o[1] ? -1 : 1, r = {
						y: 0,
						d: M(o[pt]) * n,
						h: M(o[vt]) * n,
						m: M(o[bt]) * n,
						s: M(o[yt]) * n,
						ms: M(Re(1e3 * o[xt])) * n
					}) : (o = Be.exec(t)) ? (n = "-" === o[1] ? -1 : (o[1], 1), r = {
						y: je(o[2], n),
						M: je(o[3], n),
						w: je(o[4], n),
						d: je(o[5], n),
						h: je(o[6], n),
						m: je(o[7], n),
						s: je(o[8], n)
					}) : null == r ? r = {} : "object" == typeof r && ("from" in r || "to" in r) && (a = function (t, e) {
						var n;
						if (!t.isValid() || !e.isValid()) return {
							milliseconds: 0,
							months: 0
						};
						e = Ne(e, t), t.isBefore(e) ? n = Ue(t, e) : ((n = Ue(e, t)).milliseconds = -n.milliseconds, n.months = -n.months);
						return n
					}(Ce(r.from), Ce(r.to)), (r = {}).ms = a.milliseconds, r.M = a.months), i = new Ae(r), Fe(t) && g(t, "_locale") && (i._locale = t._locale), i
				}

				function je(t, e) {
					var n = t && parseFloat(t.replace(",", "."));
					return (isNaN(n) ? 0 : n) * e
				}

				function Ue(t, e) {
					var n = {
						milliseconds: 0,
						months: 0
					};
					return n.months = e.month() - t.month() + 12 * (e.year() - t.year()), t.clone().add(n.months, "M").isAfter(e) && --n.months, n.milliseconds = +e - +t.clone().add(n.months, "M"), n
				}

				function Ge(i, a) {
					return function (t, e) {
						var n;
						return null === e || isNaN(+e) || (C(a, "moment()." + a + "(period, number) is deprecated. Please use moment()." + a + "(number, period). See http://momentjs.com/guides/#/warnings/add-inverted-param/ for more info."), n = t, t = e, e = n), qe(this, Ee(t = "string" == typeof t ? +t : t, e), i), this
					}
				}

				function qe(t, e, n, i) {
					var a = e._milliseconds,
						r = Re(e._days),
						o = Re(e._months);
					t.isValid() && (i = null == i || i, o && Rt(t, Pt(t, "Month") + o * n), r && Tt(t, "Date", Pt(t, "Date") + r * n), a && t._d.setTime(t._d.valueOf() + a * n), i && c.updateOffset(t, r || o))
				}
				Ee.fn = Ae.prototype, Ee.invalid = function () {
					return Ee(NaN)
				};
				var Ze = Ge(1, "add"),
					Xe = Ge(-1, "subtract");

				function Je(t, e) {
					var n = 12 * (e.year() - t.year()) + (e.month() - t.month()),
						i = t.clone().add(n, "months");
					return -(n + (e - i < 0 ? (e - i) / (i - t.clone().add(n - 1, "months")) : (e - i) / (t.clone().add(n + 1, "months") - i))) || 0
				}

				function $e(t) {
					var e;
					return void 0 === t ? this._locale._abbr : (null != (e = ue(t)) && (this._locale = e), this)
				}
				c.defaultFormat = "YYYY-MM-DDTHH:mm:ssZ", c.defaultFormatUtc = "YYYY-MM-DDTHH:mm:ss[Z]";
				var Ke = n("moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.", function (t) {
					return void 0 === t ? this.localeData() : this.locale(t)
				});

				function Qe() {
					return this._locale
				}

				function tn(t, e) {
					B(0, [t, t.length], 0, e)
				}

				function en(t, e, n, i, a) {
					var r;
					return null == t ? Bt(this, i, a).year : ((r = Et(t, i, a)) < e && (e = r), function (t, e, n, i, a) {
						var r = Ht(t, e, n, i, a),
							o = zt(r.year, 0, r.dayOfYear);
						return this.year(o.getUTCFullYear()), this.month(o.getUTCMonth()), this.date(o.getUTCDate()), this
					}.call(this, t, e, n, i, a))
				}
				B(0, ["gg", 2], 0, function () {
					return this.weekYear() % 100
				}), B(0, ["GG", 2], 0, function () {
					return this.isoWeekYear() % 100
				}), tn("gggg", "weekYear"), tn("ggggg", "weekYear"), tn("GGGG", "isoWeekYear"), tn("GGGGG", "isoWeekYear"), A("weekYear", "gg"), A("isoWeekYear", "GG"), Y("weekYear", 1), Y("isoWeekYear", 1), lt("G", it), lt("g", it), lt("GG", J, G), lt("gg", J, G), lt("GGGG", tt, Z), lt("gggg", tt, Z), lt("GGGGG", et, X), lt("ggggg", et, X), ft(["gggg", "ggggg", "GGGG", "GGGGG"], function (t, e, n, i) {
					e[i.substr(0, 2)] = M(t)
				}), ft(["gg", "GG"], function (t, e, n, i) {
					e[i] = c.parseTwoDigitYear(t)
				}), B("Q", 0, "Qo", "quarter"), A("quarter", "Q"), Y("quarter", 7), lt("Q", U), ct("Q", function (t, e) {
					e[mt] = 3 * (M(t) - 1)
				}), B("D", ["DD", 2], "Do", "date"), A("date", "D"), Y("date", 9), lt("D", J), lt("DD", J, G), lt("Do", function (t, e) {
					return t ? e._dayOfMonthOrdinalParse || e._ordinalParse : e._dayOfMonthOrdinalParseLenient
				}), ct(["D", "DD"], pt), ct("Do", function (t, e) {
					e[pt] = M(t.match(J)[0])
				});
				var nn = Ct("Date", !0);
				B("DDD", ["DDDD", 3], "DDDo", "dayOfYear"), A("dayOfYear", "DDD"), Y("dayOfYear", 4), lt("DDD", Q), lt("DDDD", q), ct(["DDD", "DDDD"], function (t, e, n) {
					n._dayOfYear = M(t)
				}), B("m", ["mm", 2], 0, "minute"), A("minute", "m"), Y("minute", 14), lt("m", J), lt("mm", J, G), ct(["m", "mm"], bt);
				var an = Ct("Minutes", !1);
				B("s", ["ss", 2], 0, "second"), A("second", "s"), Y("second", 15), lt("s", J), lt("ss", J, G), ct(["s", "ss"], yt);
				var rn, on = Ct("Seconds", !1);
				for (B("S", 0, 0, function () {
					return ~~(this.millisecond() / 100)
				}), B(0, ["SS", 2], 0, function () {
					return ~~(this.millisecond() / 10)
				}), B(0, ["SSS", 3], 0, "millisecond"), B(0, ["SSSS", 4], 0, function () {
					return 10 * this.millisecond()
				}), B(0, ["SSSSS", 5], 0, function () {
					return 100 * this.millisecond()
				}), B(0, ["SSSSSS", 6], 0, function () {
					return 1e3 * this.millisecond()
				}), B(0, ["SSSSSSS", 7], 0, function () {
					return 1e4 * this.millisecond()
				}), B(0, ["SSSSSSSS", 8], 0, function () {
					return 1e5 * this.millisecond()
				}), B(0, ["SSSSSSSSS", 9], 0, function () {
					return 1e6 * this.millisecond()
				}), A("millisecond", "ms"), Y("millisecond", 16), lt("S", Q, U), lt("SS", Q, G), lt("SSS", Q, q), rn = "SSSS"; rn.length <= 9; rn += "S") lt(rn, nt);

				function sn(t, e) {
					e[xt] = M(1e3 * ("0." + t))
				}
				for (rn = "S"; rn.length <= 9; rn += "S") ct(rn, sn);
				var ln = Ct("Milliseconds", !1);
				B("z", 0, 0, "zoneAbbr"), B("zz", 0, 0, "zoneName");
				var un = _.prototype;

				function dn(t) {
					return t
				}
				un.add = Ze, un.calendar = function (t, e) {
					var n = t || Ce(),
						i = Ne(n, this).startOf("day"),
						a = c.calendarFormat(this, i) || "sameElse",
						r = e && (P(e[a]) ? e[a].call(this, n) : e[a]);
					return this.format(r || this.localeData().calendar(a, this, Ce(n)))
				}, un.clone = function () {
					return new _(this)
				}, un.diff = function (t, e, n) {
					var i, a, r;
					if (!this.isValid()) return NaN;
					if (!(i = Ne(t, this)).isValid()) return NaN;
					switch (a = 6e4 * (i.utcOffset() - this.utcOffset()), e = F(e)) {
						case "year":
							r = Je(this, i) / 12;
							break;
						case "month":
							r = Je(this, i);
							break;
						case "quarter":
							r = Je(this, i) / 3;
							break;
						case "second":
							r = (this - i) / 1e3;
							break;
						case "minute":
							r = (this - i) / 6e4;
							break;
						case "hour":
							r = (this - i) / 36e5;
							break;
						case "day":
							r = (this - i - a) / 864e5;
							break;
						case "week":
							r = (this - i - a) / 6048e5;
							break;
						default:
							r = this - i
					}
					return n ? r : w(r)
				}, un.endOf = function (t) {
					return void 0 === (t = F(t)) || "millisecond" === t ? this : ("date" === t && (t = "day"), this.startOf(t).add(1, "isoWeek" === t ? "week" : t).subtract(1, "ms"))
				}, un.format = function (t) {
					t || (t = this.isUtc() ? c.defaultFormatUtc : c.defaultFormat);
					var e = E(this, t);
					return this.localeData().postformat(e)
				}, un.from = function (t, e) {
					return this.isValid() && (k(t) && t.isValid() || Ce(t).isValid()) ? Ee({
						to: this,
						from: t
					}).locale(this.locale()).humanize(!e) : this.localeData().invalidDate()
				}, un.fromNow = function (t) {
					return this.from(Ce(), t)
				}, un.to = function (t, e) {
					return this.isValid() && (k(t) && t.isValid() || Ce(t).isValid()) ? Ee({
						from: this,
						to: t
					}).locale(this.locale()).humanize(!e) : this.localeData().invalidDate()
				}, un.toNow = function (t) {
					return this.to(Ce(), t)
				}, un.get = function (t) {
					return P(this[t = F(t)]) ? this[t]() : this
				}, un.invalidAt = function () {
					return v(this).overflow
				}, un.isAfter = function (t, e) {
					var n = k(t) ? t : Ce(t);
					return !(!this.isValid() || !n.isValid()) && ("millisecond" === (e = F(u(e) ? "millisecond" : e)) ? this.valueOf() > n.valueOf() : n.valueOf() < this.clone().startOf(e).valueOf())
				}, un.isBefore = function (t, e) {
					var n = k(t) ? t : Ce(t);
					return !(!this.isValid() || !n.isValid()) && ("millisecond" === (e = F(u(e) ? "millisecond" : e)) ? this.valueOf() < n.valueOf() : this.clone().endOf(e).valueOf() < n.valueOf())
				}, un.isBetween = function (t, e, n, i) {
					return ("(" === (i = i || "()")[0] ? this.isAfter(t, n) : !this.isBefore(t, n)) && (")" === i[1] ? this.isBefore(e, n) : !this.isAfter(e, n))
				}, un.isSame = function (t, e) {
					var n, i = k(t) ? t : Ce(t);
					return !(!this.isValid() || !i.isValid()) && ("millisecond" === (e = F(e || "millisecond")) ? this.valueOf() === i.valueOf() : (n = i.valueOf(), this.clone().startOf(e).valueOf() <= n && n <= this.clone().endOf(e).valueOf()))
				}, un.isSameOrAfter = function (t, e) {
					return this.isSame(t, e) || this.isAfter(t, e)
				}, un.isSameOrBefore = function (t, e) {
					return this.isSame(t, e) || this.isBefore(t, e)
				}, un.isValid = function () {
					return b(this)
				}, un.lang = Ke, un.locale = $e, un.localeData = Qe, un.max = Te, un.min = Pe, un.parsingFlags = function () {
					return m({}, v(this))
				}, un.set = function (t, e) {
					if ("object" == typeof t)
						for (var n = function (t) {
							var e = [];
							for (var n in t) e.push({
								unit: n,
								priority: L[n]
							});
							return e.sort(function (t, e) {
								return t.priority - e.priority
							}), e
						}(t = R(t)), i = 0; i < n.length; i++) this[n[i].unit](t[n[i].unit]);
					else if (P(this[t = F(t)])) return this[t](e);
					return this
				}, un.startOf = function (t) {
					switch (t = F(t)) {
						case "year":
							this.month(0);
						case "quarter":
						case "month":
							this.date(1);
						case "week":
						case "isoWeek":
						case "day":
						case "date":
							this.hours(0);
						case "hour":
							this.minutes(0);
						case "minute":
							this.seconds(0);
						case "second":
							this.milliseconds(0)
					}
					return "week" === t && this.weekday(0), "isoWeek" === t && this.isoWeekday(1), "quarter" === t && this.month(3 * Math.floor(this.month() / 3)), this
				}, un.subtract = Xe, un.toArray = function () {
					var t = this;
					return [t.year(), t.month(), t.date(), t.hour(), t.minute(), t.second(), t.millisecond()]
				}, un.toObject = function () {
					var t = this;
					return {
						years: t.year(),
						months: t.month(),
						date: t.date(),
						hours: t.hours(),
						minutes: t.minutes(),
						seconds: t.seconds(),
						milliseconds: t.milliseconds()
					}
				}, un.toDate = function () {
					return new Date(this.valueOf())
				}, un.toISOString = function (t) {
					if (!this.isValid()) return null;
					var e = !0 !== t,
						n = e ? this.clone().utc() : this;
					return n.year() < 0 || 9999 < n.year() ? E(n, e ? "YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]" : "YYYYYY-MM-DD[T]HH:mm:ss.SSSZ") : P(Date.prototype.toISOString) ? e ? this.toDate().toISOString() : new Date(this.valueOf() + 60 * this.utcOffset() * 1e3).toISOString().replace("Z", E(n, "Z")) : E(n, e ? "YYYY-MM-DD[T]HH:mm:ss.SSS[Z]" : "YYYY-MM-DD[T]HH:mm:ss.SSSZ")
				}, un.inspect = function () {
					if (!this.isValid()) return "moment.invalid(/* " + this._i + " */)";
					var t = "moment",
						e = "";
					this.isLocal() || (t = 0 === this.utcOffset() ? "moment.utc" : "moment.parseZone", e = "Z");
					var n = "[" + t + '("]',
						i = 0 <= this.year() && this.year() <= 9999 ? "YYYY" : "YYYYYY",
						a = e + '[")]';
					return this.format(n + i + "-MM-DD[T]HH:mm:ss.SSS" + a)
				}, un.toJSON = function () {
					return this.isValid() ? this.toISOString() : null
				}, un.toString = function () {
					return this.clone().locale("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ")
				}, un.unix = function () {
					return Math.floor(this.valueOf() / 1e3)
				}, un.valueOf = function () {
					return this._d.valueOf() - 6e4 * (this._offset || 0)
				}, un.creationData = function () {
					return {
						input: this._i,
						format: this._f,
						locale: this._locale,
						isUTC: this._isUTC,
						strict: this._strict
					}
				}, un.year = Dt, un.isLeapYear = function () {
					return Mt(this.year())
				}, un.weekYear = function (t) {
					return en.call(this, t, this.week(), this.weekday(), this.localeData()._week.dow, this.localeData()._week.doy)
				}, un.isoWeekYear = function (t) {
					return en.call(this, t, this.isoWeek(), this.isoWeekday(), 1, 4)
				}, un.quarter = un.quarters = function (t) {
					return null == t ? Math.ceil((this.month() + 1) / 3) : this.month(3 * (t - 1) + this.month() % 3)
				}, un.month = Lt, un.daysInMonth = function () {
					return Ot(this.year(), this.month())
				}, un.week = un.weeks = function (t) {
					var e = this.localeData().week(this);
					return null == t ? e : this.add(7 * (t - e), "d")
				}, un.isoWeek = un.isoWeeks = function (t) {
					var e = Bt(this, 1, 4).week;
					return null == t ? e : this.add(7 * (t - e), "d")
				}, un.weeksInYear = function () {
					var t = this.localeData()._week;
					return Et(this.year(), t.dow, t.doy)
				}, un.isoWeeksInYear = function () {
					return Et(this.year(), 1, 4)
				}, un.date = nn, un.day = un.days = function (t) {
					if (!this.isValid()) return null != t ? this : NaN;
					var e, n, i = this._isUTC ? this._d.getUTCDay() : this._d.getDay();
					return null != t ? (e = t, n = this.localeData(), t = "string" != typeof e ? e : isNaN(e) ? "number" == typeof (e = n.weekdaysParse(e)) ? e : null : parseInt(e, 10), this.add(t - i, "d")) : i
				}, un.weekday = function (t) {
					if (!this.isValid()) return null != t ? this : NaN;
					var e = (this.day() + 7 - this.localeData()._week.dow) % 7;
					return null == t ? e : this.add(t - e, "d")
				}, un.isoWeekday = function (t) {
					if (!this.isValid()) return null != t ? this : NaN;
					if (null == t) return this.day() || 7;
					var e, n, i = (e = t, n = this.localeData(), "string" == typeof e ? n.weekdaysParse(e) % 7 || 7 : isNaN(e) ? null : e);
					return this.day(this.day() % 7 ? i : i - 7)
				}, un.dayOfYear = function (t) {
					var e = Math.round((this.clone().startOf("day") - this.clone().startOf("year")) / 864e5) + 1;
					return null == t ? e : this.add(t - e, "d")
				}, un.hour = un.hours = ee, un.minute = un.minutes = an, un.second = un.seconds = on, un.millisecond = un.milliseconds = ln, un.utcOffset = function (t, e, n) {
					var i, a = this._offset || 0;
					if (!this.isValid()) return null != t ? this : NaN;
					if (null == t) return this._isUTC ? a : ze(this);
					if ("string" == typeof t) {
						if (null === (t = We(rt, t))) return this
					} else Math.abs(t) < 16 && !n && (t *= 60);
					return !this._isUTC && e && (i = ze(this)), this._offset = t, this._isUTC = !0, null != i && this.add(i, "m"), a !== t && (!e || this._changeInProgress ? qe(this, Ee(t - a, "m"), 1, !1) : this._changeInProgress || (this._changeInProgress = !0, c.updateOffset(this, !0), this._changeInProgress = null)), this
				}, un.utc = function (t) {
					return this.utcOffset(0, t)
				}, un.local = function (t) {
					return this._isUTC && (this.utcOffset(0, t), this._isUTC = !1, t && this.subtract(ze(this), "m")), this
				}, un.parseZone = function () {
					if (null != this._tzm) this.utcOffset(this._tzm, !1, !0);
					else if ("string" == typeof this._i) {
						var t = We(at, this._i);
						null != t ? this.utcOffset(t) : this.utcOffset(0, !0)
					}
					return this
				}, un.hasAlignedHourOffset = function (t) {
					return !!this.isValid() && (t = t ? Ce(t).utcOffset() : 0, (this.utcOffset() - t) % 60 == 0)
				}, un.isDST = function () {
					return this.utcOffset() > this.clone().month(0).utcOffset() || this.utcOffset() > this.clone().month(5).utcOffset()
				}, un.isLocal = function () {
					return !!this.isValid() && !this._isUTC
				}, un.isUtcOffset = function () {
					return !!this.isValid() && this._isUTC
				}, un.isUtc = Ve, un.isUTC = Ve, un.zoneAbbr = function () {
					return this._isUTC ? "UTC" : ""
				}, un.zoneName = function () {
					return this._isUTC ? "Coordinated Universal Time" : ""
				}, un.dates = n("dates accessor is deprecated. Use date instead.", nn), un.months = n("months accessor is deprecated. Use month instead", Lt), un.years = n("years accessor is deprecated. Use year instead", Dt), un.zone = n("moment().zone is deprecated, use moment().utcOffset instead. http://momentjs.com/guides/#/warnings/zone/", function (t, e) {
					return null != t ? ("string" != typeof t && (t = -t), this.utcOffset(t, e), this) : -this.utcOffset()
				}), un.isDSTShifted = n("isDSTShifted is deprecated. See http://momentjs.com/guides/#/warnings/dst-shifted/ for more information", function () {
					if (!u(this._isDSTShifted)) return this._isDSTShifted;
					var t = {};
					if (x(t, this), (t = Se(t))._a) {
						var e = t._isUTC ? p(t._a) : Ce(t._a);
						this._isDSTShifted = this.isValid() && 0 < o(t._a, e.toArray())
					} else this._isDSTShifted = !1;
					return this._isDSTShifted
				});
				var hn = O.prototype;

				function cn(t, e, n, i) {
					var a = ue(),
						r = p().set(i, e);
					return a[n](r, t)
				}

				function fn(t, e, n) {
					if (d(t) && (e = t, t = void 0), t = t || "", null != e) return cn(t, e, n, "month");
					var i, a = [];
					for (i = 0; i < 12; i++) a[i] = cn(t, i, n, "month");
					return a
				}

				function gn(t, e, n, i) {
					e = ("boolean" == typeof t ? d(e) && (n = e, e = void 0) : (e = t, t = !1, d(n = e) && (n = e, e = void 0)), e || "");
					var a, r = ue(),
						o = t ? r._week.dow : 0;
					if (null != n) return cn(e, (n + o) % 7, i, "day");
					var s = [];
					for (a = 0; a < 7; a++) s[a] = cn(e, (a + o) % 7, i, "day");
					return s
				}
				hn.calendar = function (t, e, n) {
					var i = this._calendar[t] || this._calendar.sameElse;
					return P(i) ? i.call(e, n) : i
				}, hn.longDateFormat = function (t) {
					var e = this._longDateFormat[t],
						n = this._longDateFormat[t.toUpperCase()];
					return e || !n ? e : (this._longDateFormat[t] = n.replace(/MMMM|MM|DD|dddd/g, function (t) {
						return t.slice(1)
					}), this._longDateFormat[t])
				}, hn.invalidDate = function () {
					return this._invalidDate
				}, hn.ordinal = function (t) {
					return this._ordinal.replace("%d", t)
				}, hn.preparse = dn, hn.postformat = dn, hn.relativeTime = function (t, e, n, i) {
					var a = this._relativeTime[n];
					return P(a) ? a(t, e, n, i) : a.replace(/%d/i, t)
				}, hn.pastFuture = function (t, e) {
					var n = this._relativeTime[0 < t ? "future" : "past"];
					return P(n) ? n(e) : n.replace(/%s/i, e)
				}, hn.set = function (t) {
					var e, n;
					for (n in t) P(e = t[n]) ? this[n] = e : this["_" + n] = e;
					this._config = t, this._dayOfMonthOrdinalParseLenient = new RegExp((this._dayOfMonthOrdinalParse.source || this._ordinalParse.source) + "|" + /\d{1,2}/.source)
				}, hn.months = function (t, e) {
					return t ? s(this._months) ? this._months[t.month()] : this._months[(this._months.isFormat || It).test(e) ? "format" : "standalone"][t.month()] : s(this._months) ? this._months : this._months.standalone
				}, hn.monthsShort = function (t, e) {
					return t ? s(this._monthsShort) ? this._monthsShort[t.month()] : this._monthsShort[It.test(e) ? "format" : "standalone"][t.month()] : s(this._monthsShort) ? this._monthsShort : this._monthsShort.standalone
				}, hn.monthsParse = function (t, e, n) {
					var i, a, r;
					if (this._monthsParseExact) return function (t, e, n) {
						var i, a, r, o = t.toLocaleLowerCase();
						if (!this._monthsParse)
							for (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = [], i = 0; i < 12; ++i) r = p([2e3, i]), this._shortMonthsParse[i] = this.monthsShort(r, "").toLocaleLowerCase(), this._longMonthsParse[i] = this.months(r, "").toLocaleLowerCase();
						return n ? "MMM" === e ? -1 !== (a = St.call(this._shortMonthsParse, o)) ? a : null : -1 !== (a = St.call(this._longMonthsParse, o)) ? a : null : "MMM" === e ? -1 !== (a = St.call(this._shortMonthsParse, o)) ? a : -1 !== (a = St.call(this._longMonthsParse, o)) ? a : null : -1 !== (a = St.call(this._longMonthsParse, o)) ? a : -1 !== (a = St.call(this._shortMonthsParse, o)) ? a : null
					}.call(this, t, e, n);
					for (this._monthsParse || (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = []), i = 0; i < 12; i++) {
						if (a = p([2e3, i]), n && !this._longMonthsParse[i] && (this._longMonthsParse[i] = new RegExp("^" + this.months(a, "").replace(".", "") + "$", "i"), this._shortMonthsParse[i] = new RegExp("^" + this.monthsShort(a, "").replace(".", "") + "$", "i")), n || this._monthsParse[i] || (r = "^" + this.months(a, "") + "|^" + this.monthsShort(a, ""), this._monthsParse[i] = new RegExp(r.replace(".", ""), "i")), n && "MMMM" === e && this._longMonthsParse[i].test(t)) return i;
						if (n && "MMM" === e && this._shortMonthsParse[i].test(t)) return i;
						if (!n && this._monthsParse[i].test(t)) return i
					}
				}, hn.monthsRegex = function (t) {
					return this._monthsParseExact ? (g(this, "_monthsRegex") || Nt.call(this), t ? this._monthsStrictRegex : this._monthsRegex) : (g(this, "_monthsRegex") || (this._monthsRegex = Wt), this._monthsStrictRegex && t ? this._monthsStrictRegex : this._monthsRegex)
				}, hn.monthsShortRegex = function (t) {
					return this._monthsParseExact ? (g(this, "_monthsRegex") || Nt.call(this), t ? this._monthsShortStrictRegex : this._monthsShortRegex) : (g(this, "_monthsShortRegex") || (this._monthsShortRegex = Yt), this._monthsShortStrictRegex && t ? this._monthsShortStrictRegex : this._monthsShortRegex)
				}, hn.week = function (t) {
					return Bt(t, this._week.dow, this._week.doy).week
				}, hn.firstDayOfYear = function () {
					return this._week.doy
				}, hn.firstDayOfWeek = function () {
					return this._week.dow
				}, hn.weekdays = function (t, e) {
					return t ? s(this._weekdays) ? this._weekdays[t.day()] : this._weekdays[this._weekdays.isFormat.test(e) ? "format" : "standalone"][t.day()] : s(this._weekdays) ? this._weekdays : this._weekdays.standalone
				}, hn.weekdaysMin = function (t) {
					return t ? this._weekdaysMin[t.day()] : this._weekdaysMin
				}, hn.weekdaysShort = function (t) {
					return t ? this._weekdaysShort[t.day()] : this._weekdaysShort
				}, hn.weekdaysParse = function (t, e, n) {
					var i, a, r;
					if (this._weekdaysParseExact) return function (t, e, n) {
						var i, a, r, o = t.toLocaleLowerCase();
						if (!this._weekdaysParse)
							for (this._weekdaysParse = [], this._shortWeekdaysParse = [], this._minWeekdaysParse = [], i = 0; i < 7; ++i) r = p([2e3, 1]).day(i), this._minWeekdaysParse[i] = this.weekdaysMin(r, "").toLocaleLowerCase(), this._shortWeekdaysParse[i] = this.weekdaysShort(r, "").toLocaleLowerCase(), this._weekdaysParse[i] = this.weekdays(r, "").toLocaleLowerCase();
						return n ? "dddd" === e ? -1 !== (a = St.call(this._weekdaysParse, o)) ? a : null : "ddd" === e ? -1 !== (a = St.call(this._shortWeekdaysParse, o)) ? a : null : -1 !== (a = St.call(this._minWeekdaysParse, o)) ? a : null : "dddd" === e ? -1 !== (a = St.call(this._weekdaysParse, o)) ? a : -1 !== (a = St.call(this._shortWeekdaysParse, o)) ? a : -1 !== (a = St.call(this._minWeekdaysParse, o)) ? a : null : "ddd" === e ? -1 !== (a = St.call(this._shortWeekdaysParse, o)) ? a : -1 !== (a = St.call(this._weekdaysParse, o)) ? a : -1 !== (a = St.call(this._minWeekdaysParse, o)) ? a : null : -1 !== (a = St.call(this._minWeekdaysParse, o)) ? a : -1 !== (a = St.call(this._weekdaysParse, o)) ? a : -1 !== (a = St.call(this._shortWeekdaysParse, o)) ? a : null
					}.call(this, t, e, n);
					for (this._weekdaysParse || (this._weekdaysParse = [], this._minWeekdaysParse = [], this._shortWeekdaysParse = [], this._fullWeekdaysParse = []), i = 0; i < 7; i++) {
						if (a = p([2e3, 1]).day(i), n && !this._fullWeekdaysParse[i] && (this._fullWeekdaysParse[i] = new RegExp("^" + this.weekdays(a, "").replace(".", "\\.?") + "$", "i"), this._shortWeekdaysParse[i] = new RegExp("^" + this.weekdaysShort(a, "").replace(".", "\\.?") + "$", "i"), this._minWeekdaysParse[i] = new RegExp("^" + this.weekdaysMin(a, "").replace(".", "\\.?") + "$", "i")), this._weekdaysParse[i] || (r = "^" + this.weekdays(a, "") + "|^" + this.weekdaysShort(a, "") + "|^" + this.weekdaysMin(a, ""), this._weekdaysParse[i] = new RegExp(r.replace(".", ""), "i")), n && "dddd" === e && this._fullWeekdaysParse[i].test(t)) return i;
						if (n && "ddd" === e && this._shortWeekdaysParse[i].test(t)) return i;
						if (n && "dd" === e && this._minWeekdaysParse[i].test(t)) return i;
						if (!n && this._weekdaysParse[i].test(t)) return i
					}
				}, hn.weekdaysRegex = function (t) {
					return this._weekdaysParseExact ? (g(this, "_weekdaysRegex") || Jt.call(this), t ? this._weekdaysStrictRegex : this._weekdaysRegex) : (g(this, "_weekdaysRegex") || (this._weekdaysRegex = qt), this._weekdaysStrictRegex && t ? this._weekdaysStrictRegex : this._weekdaysRegex)
				}, hn.weekdaysShortRegex = function (t) {
					return this._weekdaysParseExact ? (g(this, "_weekdaysRegex") || Jt.call(this), t ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex) : (g(this, "_weekdaysShortRegex") || (this._weekdaysShortRegex = Zt), this._weekdaysShortStrictRegex && t ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex)
				}, hn.weekdaysMinRegex = function (t) {
					return this._weekdaysParseExact ? (g(this, "_weekdaysRegex") || Jt.call(this), t ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex) : (g(this, "_weekdaysMinRegex") || (this._weekdaysMinRegex = Xt), this._weekdaysMinStrictRegex && t ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex)
				}, hn.isPM = function (t) {
					return "p" === (t + "").toLowerCase().charAt(0)
				}, hn.meridiem = function (t, e, n) {
					return 11 < t ? n ? "pm" : "PM" : n ? "am" : "AM"
				}, se("en", {
					dayOfMonthOrdinalParse: /\d{1,2}(th|st|nd|rd)/,
					ordinal: function (t) {
						var e = t % 10;
						return t + (1 === M(t % 100 / 10) ? "th" : 1 === e ? "st" : 2 === e ? "nd" : 3 === e ? "rd" : "th")
					}
				}), c.lang = n("moment.lang is deprecated. Use moment.locale instead.", se), c.langData = n("moment.langData is deprecated. Use moment.localeData instead.", ue);
				var mn = Math.abs;

				function pn(t, e, n, i) {
					var a = Ee(e, n);
					return t._milliseconds += i * a._milliseconds, t._days += i * a._days, t._months += i * a._months, t._bubble()
				}

				function vn(t) {
					return t < 0 ? Math.floor(t) : Math.ceil(t)
				}

				function bn(t) {
					return 4800 * t / 146097
				}

				function yn(t) {
					return 146097 * t / 4800
				}

				function xn(t) {
					return function () {
						return this.as(t)
					}
				}
				var _n = xn("ms"),
					kn = xn("s"),
					wn = xn("m"),
					Mn = xn("h"),
					Sn = xn("d"),
					Dn = xn("w"),
					Cn = xn("M"),
					Pn = xn("y");

				function Tn(t) {
					return function () {
						return this.isValid() ? this._data[t] : NaN
					}
				}
				var On = Tn("milliseconds"),
					In = Tn("seconds"),
					An = Tn("minutes"),
					Fn = Tn("hours"),
					Rn = Tn("days"),
					Ln = Tn("months"),
					Yn = Tn("years");
				var Wn = Math.round,
					Nn = {
						ss: 44,
						s: 45,
						m: 45,
						h: 22,
						d: 26,
						M: 11
					};
				var zn = Math.abs;

				function Vn(t) {
					return (0 < t) - (t < 0) || +t
				}

				function Hn() {
					if (!this.isValid()) return this.localeData().invalidDate();
					var t, e, n = zn(this._milliseconds) / 1e3,
						i = zn(this._days),
						a = zn(this._months);
					e = w((t = w(n / 60)) / 60), n %= 60, t %= 60;
					var r = w(a / 12),
						o = a %= 12,
						s = i,
						l = e,
						u = t,
						d = n ? n.toFixed(3).replace(/\.?0+$/, "") : "",
						h = this.asSeconds();
					if (!h) return "P0D";
					var c = h < 0 ? "-" : "",
						f = Vn(this._months) !== Vn(h) ? "-" : "",
						g = Vn(this._days) !== Vn(h) ? "-" : "",
						m = Vn(this._milliseconds) !== Vn(h) ? "-" : "";
					return c + "P" + (r ? f + r + "Y" : "") + (o ? f + o + "M" : "") + (s ? g + s + "D" : "") + (l || u || d ? "T" : "") + (l ? m + l + "H" : "") + (u ? m + u + "M" : "") + (d ? m + d + "S" : "")
				}
				var Bn = Ae.prototype;
				return Bn.isValid = function () {
					return this._isValid
				}, Bn.abs = function () {
					var t = this._data;
					return this._milliseconds = mn(this._milliseconds), this._days = mn(this._days), this._months = mn(this._months), t.milliseconds = mn(t.milliseconds), t.seconds = mn(t.seconds), t.minutes = mn(t.minutes), t.hours = mn(t.hours), t.months = mn(t.months), t.years = mn(t.years), this
				}, Bn.add = function (t, e) {
					return pn(this, t, e, 1)
				}, Bn.subtract = function (t, e) {
					return pn(this, t, e, -1)
				}, Bn.as = function (t) {
					if (!this.isValid()) return NaN;
					var e, n, i = this._milliseconds;
					if ("month" === (t = F(t)) || "year" === t) return e = this._days + i / 864e5, n = this._months + bn(e), "month" === t ? n : n / 12;
					switch (e = this._days + Math.round(yn(this._months)), t) {
						case "week":
							return e / 7 + i / 6048e5;
						case "day":
							return e + i / 864e5;
						case "hour":
							return 24 * e + i / 36e5;
						case "minute":
							return 1440 * e + i / 6e4;
						case "second":
							return 86400 * e + i / 1e3;
						case "millisecond":
							return Math.floor(864e5 * e) + i;
						default:
							throw new Error("Unknown unit " + t)
					}
				}, Bn.asMilliseconds = _n, Bn.asSeconds = kn, Bn.asMinutes = wn, Bn.asHours = Mn, Bn.asDays = Sn, Bn.asWeeks = Dn, Bn.asMonths = Cn, Bn.asYears = Pn, Bn.valueOf = function () {
					return this.isValid() ? this._milliseconds + 864e5 * this._days + this._months % 12 * 2592e6 + 31536e6 * M(this._months / 12) : NaN
				}, Bn._bubble = function () {
					var t, e, n, i, a, r = this._milliseconds,
						o = this._days,
						s = this._months,
						l = this._data;
					return 0 <= r && 0 <= o && 0 <= s || r <= 0 && o <= 0 && s <= 0 || (r += 864e5 * vn(yn(s) + o), s = o = 0), l.milliseconds = r % 1e3, t = w(r / 1e3), l.seconds = t % 60, e = w(t / 60), l.minutes = e % 60, n = w(e / 60), l.hours = n % 24, s += a = w(bn(o += w(n / 24))), o -= vn(yn(a)), i = w(s / 12), s %= 12, l.days = o, l.months = s, l.years = i, this
				}, Bn.clone = function () {
					return Ee(this)
				}, Bn.get = function (t) {
					return t = F(t), this.isValid() ? this[t + "s"]() : NaN
				}, Bn.milliseconds = On, Bn.seconds = In, Bn.minutes = An, Bn.hours = Fn, Bn.days = Rn, Bn.weeks = function () {
					return w(this.days() / 7)
				}, Bn.months = Ln, Bn.years = Yn, Bn.humanize = function (t) {
					if (!this.isValid()) return this.localeData().invalidDate();
					var e, n, i, a, r, o, s, l, u, d, h, c = this.localeData(),
						f = (n = !t, i = c, a = Ee(e = this).abs(), r = Wn(a.as("s")), o = Wn(a.as("m")), s = Wn(a.as("h")), l = Wn(a.as("d")), u = Wn(a.as("M")), d = Wn(a.as("y")), (h = r <= Nn.ss && ["s", r] || r < Nn.s && ["ss", r] || o <= 1 && ["m"] || o < Nn.m && ["mm", o] || s <= 1 && ["h"] || s < Nn.h && ["hh", s] || l <= 1 && ["d"] || l < Nn.d && ["dd", l] || u <= 1 && ["M"] || u < Nn.M && ["MM", u] || d <= 1 && ["y"] || ["yy", d])[2] = n, h[3] = 0 < +e, h[4] = i, function (t, e, n, i, a) {
							return a.relativeTime(e || 1, !!n, t, i)
						}.apply(null, h));
					return t && (f = c.pastFuture(+this, f)), c.postformat(f)
				}, Bn.toISOString = Hn, Bn.toString = Hn, Bn.toJSON = Hn, Bn.locale = $e, Bn.localeData = Qe, Bn.toIsoString = n("toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)", Hn), Bn.lang = Ke, B("X", 0, 0, "unix"), B("x", 0, 0, "valueOf"), lt("x", it), lt("X", /[+-]?\d+(\.\d{1,3})?/), ct("X", function (t, e, n) {
					n._d = new Date(1e3 * parseFloat(t, 10))
				}), ct("x", function (t, e, n) {
					n._d = new Date(M(t))
				}), c.version = "2.22.2", t = Ce, c.fn = un, c.min = function () {
					return Oe("isBefore", [].slice.call(arguments, 0))
				}, c.max = function () {
					return Oe("isAfter", [].slice.call(arguments, 0))
				}, c.now = function () {
					return Date.now ? Date.now() : +new Date
				}, c.utc = p, c.unix = function (t) {
					return Ce(1e3 * t)
				}, c.months = function (t, e) {
					return fn(t, e, "months")
				}, c.isDate = h, c.locale = se, c.invalid = y, c.duration = Ee, c.isMoment = k, c.weekdays = function (t, e, n) {
					return gn(t, e, n, "weekdays")
				}, c.parseZone = function () {
					return Ce.apply(null, arguments).parseZone()
				}, c.localeData = ue, c.isDuration = Fe, c.monthsShort = function (t, e) {
					return fn(t, e, "monthsShort")
				}, c.weekdaysMin = function (t, e, n) {
					return gn(t, e, n, "weekdaysMin")
				}, c.defineLocale = le, c.updateLocale = function (t, e) {
					if (null != e) {
						var n, i, a = ne;
						null != (i = oe(t)) && (a = i._config), (n = new O(e = T(a, e))).parentLocale = ie[t], ie[t] = n, se(t)
					} else null != ie[t] && (null != ie[t].parentLocale ? ie[t] = ie[t].parentLocale : null != ie[t] && delete ie[t]);
					return ie[t]
				}, c.locales = function () {
					return i(ie)
				}, c.weekdaysShort = function (t, e, n) {
					return gn(t, e, n, "weekdaysShort")
				}, c.normalizeUnits = F, c.relativeTimeRounding = function (t) {
					return void 0 === t ? Wn : "function" == typeof t && (Wn = t, !0)
				}, c.relativeTimeThreshold = function (t, e) {
					return void 0 !== Nn[t] && (void 0 === e ? Nn[t] : (Nn[t] = e, "s" === t && (Nn.ss = e - 1), !0))
				}, c.calendarFormat = function (t, e) {
					var n = t.diff(e, "days", !0);
					return n < -6 ? "sameElse" : n < -1 ? "lastWeek" : n < 0 ? "lastDay" : n < 1 ? "sameDay" : n < 2 ? "nextDay" : n < 7 ? "nextWeek" : "sameElse"
				}, c.prototype = un, c.HTML5_FMT = {
					DATETIME_LOCAL: "YYYY-MM-DDTHH:mm",
					DATETIME_LOCAL_SECONDS: "YYYY-MM-DDTHH:mm:ss",
					DATETIME_LOCAL_MS: "YYYY-MM-DDTHH:mm:ss.SSS",
					DATE: "YYYY-MM-DD",
					TIME: "HH:mm",
					TIME_SECONDS: "HH:mm:ss",
					TIME_MS: "HH:mm:ss.SSS",
					WEEK: "YYYY-[W]WW",
					MONTH: "YYYY-MM"
				}, c
			}, "object" == typeof t && void 0 !== jn ? jn.exports = n() : e.moment = n()
		}, {}],
		7: [function (t, e, n) {
			var i = t(30)();
			i.helpers = t(46), t(28)(i), i.Animation = t(22), i.animationService = t(23), i.defaults = t(26), i.Element = t(27), i.elements = t(41), i.Interaction = t(29), i.layouts = t(31), i.platform = t(49), i.plugins = t(32), i.Scale = t(33), i.scaleService = t(34), i.Ticks = t(35), i.Tooltip = t(36), t(24)(i), t(25)(i), t(56)(i), t(54)(i), t(55)(i), t(57)(i), t(58)(i), t(59)(i), t(15)(i), t(16)(i), t(17)(i), t(18)(i), t(19)(i), t(20)(i), t(21)(i), t(8)(i), t(9)(i), t(10)(i), t(11)(i), t(12)(i), t(13)(i), t(14)(i);
			var a = t(50);
			for (var r in a) a.hasOwnProperty(r) && i.plugins.register(a[r]);
			i.platform.initialize(), e.exports = i, "undefined" != typeof window && (window.Chart = i), i.Legend = a.legend._element, i.Title = a.title._element, i.pluginService = i.plugins, i.PluginBase = i.Element.extend({}), i.canvasHelpers = i.helpers.canvas, i.layoutService = i.layouts
		}, {
			10: 10,
			11: 11,
			12: 12,
			13: 13,
			14: 14,
			15: 15,
			16: 16,
			17: 17,
			18: 18,
			19: 19,
			20: 20,
			21: 21,
			22: 22,
			23: 23,
			24: 24,
			25: 25,
			26: 26,
			27: 27,
			28: 28,
			29: 29,
			30: 30,
			31: 31,
			32: 32,
			33: 33,
			34: 34,
			35: 35,
			36: 36,
			41: 41,
			46: 46,
			49: 49,
			50: 50,
			54: 54,
			55: 55,
			56: 56,
			57: 57,
			58: 58,
			59: 59,
			8: 8,
			9: 9
		}],
		8: [function (t, e, n) {
			"use strict";
			e.exports = function (n) {
				n.Bar = function (t, e) {
					return e.type = "bar", new n(t, e)
				}
			}
		}, {}],
		9: [function (t, e, n) {
			"use strict";
			e.exports = function (n) {
				n.Bubble = function (t, e) {
					return e.type = "bubble", new n(t, e)
				}
			}
		}, {}],
		10: [function (t, e, n) {
			"use strict";
			e.exports = function (n) {
				n.Doughnut = function (t, e) {
					return e.type = "doughnut", new n(t, e)
				}
			}
		}, {}],
		11: [function (t, e, n) {
			"use strict";
			e.exports = function (n) {
				n.Line = function (t, e) {
					return e.type = "line", new n(t, e)
				}
			}
		}, {}],
		12: [function (t, e, n) {
			"use strict";
			e.exports = function (n) {
				n.PolarArea = function (t, e) {
					return e.type = "polarArea", new n(t, e)
				}
			}
		}, {}],
		13: [function (t, e, n) {
			"use strict";
			e.exports = function (n) {
				n.Radar = function (t, e) {
					return e.type = "radar", new n(t, e)
				}
			}
		}, {}],
		14: [function (t, e, n) {
			"use strict";
			e.exports = function (n) {
				n.Scatter = function (t, e) {
					return e.type = "scatter", new n(t, e)
				}
			}
		}, {}],
		15: [function (t, e, n) {
			"use strict";
			var i = t(26),
				a = t(41),
				S = t(46);
			i._set("bar", {
				hover: {
					mode: "label"
				},
				scales: {
					xAxes: [{
						type: "category",
						categoryPercentage: .8,
						barPercentage: .9,
						offset: !0,
						gridLines: {
							offsetGridLines: !0
						}
					}],
					yAxes: [{
						type: "linear"
					}]
				}
			}), i._set("horizontalBar", {
				hover: {
					mode: "index",
					axis: "y"
				},
				scales: {
					xAxes: [{
						type: "linear",
						position: "bottom"
					}],
					yAxes: [{
						position: "left",
						type: "category",
						categoryPercentage: .8,
						barPercentage: .9,
						offset: !0,
						gridLines: {
							offsetGridLines: !0
						}
					}]
				},
				elements: {
					rectangle: {
						borderSkipped: "left"
					}
				},
				tooltips: {
					callbacks: {
						title: function (t, e) {
							var n = "";
							return 0 < t.length && (t[0].yLabel ? n = t[0].yLabel : 0 < e.labels.length && t[0].index < e.labels.length && (n = e.labels[t[0].index])), n
						},
						label: function (t, e) {
							return (e.datasets[t.datasetIndex].label || "") + ": " + t.xLabel
						}
					},
					mode: "index",
					axis: "y"
				}
			}), e.exports = function (e) {
				e.controllers.bar = e.DatasetController.extend({
					dataElementType: a.Rectangle,
					initialize: function () {
						var t;
						e.DatasetController.prototype.initialize.apply(this, arguments), (t = this.getMeta()).stack = this.getDataset().stack, t.bar = !0
					},
					update: function (t) {
						var e, n, i = this.getMeta().data;
						for (this._ruler = this.getRuler(), e = 0, n = i.length; e < n; ++e) this.updateElement(i[e], e, t)
					},
					updateElement: function (t, e, n) {
						var i = this,
							a = i.chart,
							r = i.getMeta(),
							o = i.getDataset(),
							s = t.custom || {},
							l = a.options.elements.rectangle;
						t._xScale = i.getScaleForId(r.xAxisID), t._yScale = i.getScaleForId(r.yAxisID), t._datasetIndex = i.index, t._index = e, t._model = {
							datasetLabel: o.label,
							label: a.data.labels[e],
							borderSkipped: s.borderSkipped ? s.borderSkipped : l.borderSkipped,
							backgroundColor: s.backgroundColor ? s.backgroundColor : S.valueAtIndexOrDefault(o.backgroundColor, e, l.backgroundColor),
							borderColor: s.borderColor ? s.borderColor : S.valueAtIndexOrDefault(o.borderColor, e, l.borderColor),
							borderWidth: s.borderWidth ? s.borderWidth : S.valueAtIndexOrDefault(o.borderWidth, e, l.borderWidth)
						}, i.updateElementGeometry(t, e, n), t.pivot()
					},
					updateElementGeometry: function (t, e, n) {
						var i = this,
							a = t._model,
							r = i.getValueScale(),
							o = r.getBasePixel(),
							s = r.isHorizontal(),
							l = i._ruler || i.getRuler(),
							u = i.calculateBarValuePixels(i.index, e),
							d = i.calculateBarIndexPixels(i.index, e, l);
						a.horizontal = s, a.base = n ? o : u.base, a.x = s ? n ? o : u.head : d.center, a.y = s ? d.center : n ? o : u.head, a.height = s ? d.size : void 0, a.width = s ? void 0 : d.size
					},
					getValueScaleId: function () {
						return this.getMeta().yAxisID
					},
					getIndexScaleId: function () {
						return this.getMeta().xAxisID
					},
					getValueScale: function () {
						return this.getScaleForId(this.getValueScaleId())
					},
					getIndexScale: function () {
						return this.getScaleForId(this.getIndexScaleId())
					},
					_getStacks: function (t) {
						var e, n, i = this.chart,
							a = this.getIndexScale().options.stacked,
							r = void 0 === t ? i.data.datasets.length : t + 1,
							o = [];
						for (e = 0; e < r; ++e)(n = i.getDatasetMeta(e)).bar && i.isDatasetVisible(e) && (!1 === a || !0 === a && -1 === o.indexOf(n.stack) || void 0 === a && (void 0 === n.stack || -1 === o.indexOf(n.stack))) && o.push(n.stack);
						return o
					},
					getStackCount: function () {
						return this._getStacks().length
					},
					getStackIndex: function (t, e) {
						var n = this._getStacks(t),
							i = void 0 !== e ? n.indexOf(e) : -1;
						return -1 === i ? n.length - 1 : i
					},
					getRuler: function () {
						var t, e, n = this.getIndexScale(),
							i = this.getStackCount(),
							a = this.index,
							r = n.isHorizontal(),
							o = r ? n.left : n.top,
							s = o + (r ? n.width : n.height),
							l = [];
						for (t = 0, e = this.getMeta().data.length; t < e; ++t) l.push(n.getPixelForValue(null, t, a));
						return {
							min: S.isNullOrUndef(n.options.barThickness) ? function (t, e) {
								var n, i, a, r, o = t.isHorizontal() ? t.width : t.height,
									s = t.getTicks();
								for (a = 1, r = e.length; a < r; ++a) o = Math.min(o, e[a] - e[a - 1]);
								for (a = 0, r = s.length; a < r; ++a) i = t.getPixelForTick(a), o = 0 < a ? Math.min(o, i - n) : o, n = i;
								return o
							}(n, l) : -1,
							pixels: l,
							start: o,
							end: s,
							stackCount: i,
							scale: n
						}
					},
					calculateBarValuePixels: function (t, e) {
						var n, i, a, r, o, s, l = this.chart,
							u = this.getMeta(),
							d = this.getValueScale(),
							h = l.data.datasets,
							c = d.getRightValue(h[t].data[e]),
							f = d.options.stacked,
							g = u.stack,
							m = 0;
						if (f || void 0 === f && void 0 !== g)
							for (n = 0; n < t; ++n)(i = l.getDatasetMeta(n)).bar && i.stack === g && i.controller.getValueScaleId() === d.id && l.isDatasetVisible(n) && (a = d.getRightValue(h[n].data[e]), (c < 0 && a < 0 || 0 <= c && 0 < a) && (m += a));
						return r = d.getPixelForValue(m), {
							size: s = ((o = d.getPixelForValue(m + c)) - r) / 2,
							base: r,
							head: o,
							center: o + s / 2
						}
					},
					calculateBarIndexPixels: function (t, e, n) {
						var i, a, r, o, s, l, u, d, h, c, f, g, m, p, v, b, y, x = n.scale.options,
							_ = "flex" === x.barThickness ? (h = e, f = x, m = (c = n).pixels, p = m[h], v = 0 < h ? m[h - 1] : null, b = h < m.length - 1 ? m[h + 1] : null, y = f.categoryPercentage, null === v && (v = p - (null === b ? c.end - p : b - p)), null === b && (b = p + p - v), g = p - (p - v) / 2 * y, {
								chunk: (b - v) / 2 * y / c.stackCount,
								ratio: f.barPercentage,
								start: g
							}) : (i = e, a = n, l = (r = x).barThickness, u = a.stackCount, d = a.pixels[i], s = S.isNullOrUndef(l) ? (o = a.min * r.categoryPercentage, r.barPercentage) : (o = l * u, 1), {
								chunk: o / u,
								ratio: s,
								start: d - o / 2
							}),
							k = this.getStackIndex(t, this.getMeta().stack),
							w = _.start + _.chunk * k + _.chunk / 2,
							M = Math.min(S.valueOrDefault(x.maxBarThickness, 1 / 0), _.chunk * _.ratio);
						return {
							base: w - M / 2,
							head: w + M / 2,
							center: w,
							size: M
						}
					},
					draw: function () {
						var t = this.chart,
							e = this.getValueScale(),
							n = this.getMeta().data,
							i = this.getDataset(),
							a = n.length,
							r = 0;
						for (S.canvas.clipArea(t.ctx, t.chartArea); r < a; ++r) isNaN(e.getRightValue(i.data[r])) || n[r].draw();
						S.canvas.unclipArea(t.ctx)
					}
				}), e.controllers.horizontalBar = e.controllers.bar.extend({
					getValueScaleId: function () {
						return this.getMeta().xAxisID
					},
					getIndexScaleId: function () {
						return this.getMeta().yAxisID
					}
				})
			}
		}, {
			26: 26,
			41: 41,
			46: 46
		}],
		16: [function (t, e, n) {
			"use strict";
			var i = t(26),
				a = t(41),
				g = t(46);
			i._set("bubble", {
				hover: {
					mode: "single"
				},
				scales: {
					xAxes: [{
						type: "linear",
						position: "bottom",
						id: "x-axis-0"
					}],
					yAxes: [{
						type: "linear",
						position: "left",
						id: "y-axis-0"
					}]
				},
				tooltips: {
					callbacks: {
						title: function () {
							return ""
						},
						label: function (t, e) {
							var n = e.datasets[t.datasetIndex].label || "",
								i = e.datasets[t.datasetIndex].data[t.index];
							return n + ": (" + t.xLabel + ", " + t.yLabel + ", " + i.r + ")"
						}
					}
				}
			}), e.exports = function (t) {
				t.controllers.bubble = t.DatasetController.extend({
					dataElementType: a.Point,
					update: function (n) {
						var i = this,
							t = i.getMeta().data;
						g.each(t, function (t, e) {
							i.updateElement(t, e, n)
						})
					},
					updateElement: function (t, e, n) {
						var i = this,
							a = i.getMeta(),
							r = t.custom || {},
							o = i.getScaleForId(a.xAxisID),
							s = i.getScaleForId(a.yAxisID),
							l = i._resolveElementOptions(t, e),
							u = i.getDataset().data[e],
							d = i.index,
							h = n ? o.getPixelForDecimal(.5) : o.getPixelForValue("object" == typeof u ? u : NaN, e, d),
							c = n ? s.getBasePixel() : s.getPixelForValue(u, e, d);
						t._xScale = o, t._yScale = s, t._options = l, t._datasetIndex = d, t._index = e, t._model = {
							backgroundColor: l.backgroundColor,
							borderColor: l.borderColor,
							borderWidth: l.borderWidth,
							hitRadius: l.hitRadius,
							pointStyle: l.pointStyle,
							rotation: l.rotation,
							radius: n ? 0 : l.radius,
							skip: r.skip || isNaN(h) || isNaN(c),
							x: h,
							y: c
						}, t.pivot()
					},
					setHoverStyle: function (t) {
						var e = t._model,
							n = t._options;
						t.$previousStyle = {
							backgroundColor: e.backgroundColor,
							borderColor: e.borderColor,
							borderWidth: e.borderWidth,
							radius: e.radius
						}, e.backgroundColor = g.valueOrDefault(n.hoverBackgroundColor, g.getHoverColor(n.backgroundColor)), e.borderColor = g.valueOrDefault(n.hoverBorderColor, g.getHoverColor(n.borderColor)), e.borderWidth = g.valueOrDefault(n.hoverBorderWidth, n.borderWidth), e.radius = n.radius + n.hoverRadius
					},
					_resolveElementOptions: function (t, e) {
						var n, i, a, r = this.chart,
							o = r.data.datasets[this.index],
							s = t.custom || {},
							l = r.options.elements.point,
							u = g.options.resolve,
							d = o.data[e],
							h = {},
							c = {
								chart: r,
								dataIndex: e,
								dataset: o,
								datasetIndex: this.index
							},
							f = ["backgroundColor", "borderColor", "borderWidth", "hoverBackgroundColor", "hoverBorderColor", "hoverBorderWidth", "hoverRadius", "hitRadius", "pointStyle", "rotation"];
						for (n = 0, i = f.length; n < i; ++n) h[a = f[n]] = u([s[a], o[a], l[a]], c, e);
						return h.radius = u([s.radius, d ? d.r : void 0, o.radius, l.radius], c, e), h
					}
				})
			}
		}, {
			26: 26,
			41: 41,
			46: 46
		}],
		17: [function (t, e, n) {
			"use strict";
			var i = t(26),
				a = t(41),
				O = t(46);
			i._set("doughnut", {
				animation: {
					animateRotate: !0,
					animateScale: !1
				},
				hover: {
					mode: "single"
				},
				legendCallback: function (t) {
					var e = [];
					e.push('<ul class="' + t.id + '-legend">');
					var n = t.data,
						i = n.datasets,
						a = n.labels;
					if (i.length)
						for (var r = 0; r < i[0].data.length; ++r) e.push('<li><span style="background-color:' + i[0].backgroundColor[r] + '"></span>'), a[r] && e.push(a[r]), e.push("</li>");
					return e.push("</ul>"), e.join("")
				},
				legend: {
					labels: {
						generateLabels: function (l) {
							var u = l.data;
							return u.labels.length && u.datasets.length ? u.labels.map(function (t, e) {
								var n = l.getDatasetMeta(0),
									i = u.datasets[0],
									a = n.data[e],
									r = a && a.custom || {},
									o = O.valueAtIndexOrDefault,
									s = l.options.elements.arc;
								return {
									text: t,
									fillStyle: r.backgroundColor ? r.backgroundColor : o(i.backgroundColor, e, s.backgroundColor),
									strokeStyle: r.borderColor ? r.borderColor : o(i.borderColor, e, s.borderColor),
									lineWidth: r.borderWidth ? r.borderWidth : o(i.borderWidth, e, s.borderWidth),
									hidden: isNaN(i.data[e]) || n.data[e].hidden,
									index: e
								}
							}) : []
						}
					},
					onClick: function (t, e) {
						var n, i, a, r = e.index,
							o = this.chart;
						for (n = 0, i = (o.data.datasets || []).length; n < i; ++n)(a = o.getDatasetMeta(n)).data[r] && (a.data[r].hidden = !a.data[r].hidden);
						o.update()
					}
				},
				cutoutPercentage: 50,
				rotation: -.5 * Math.PI,
				circumference: 2 * Math.PI,
				tooltips: {
					callbacks: {
						title: function () {
							return ""
						},
						label: function (t, e) {
							var n = e.labels[t.index],
								i = ": " + e.datasets[t.datasetIndex].data[t.index];
							return O.isArray(n) ? (n = n.slice())[0] += i : n += i, n
						}
					}
				}
			}), i._set("pie", O.clone(i.doughnut)), i._set("pie", {
				cutoutPercentage: 0
			}), e.exports = function (t) {
				t.controllers.doughnut = t.controllers.pie = t.DatasetController.extend({
					dataElementType: a.Arc,
					linkScales: O.noop,
					getRingIndex: function (t) {
						for (var e = 0, n = 0; n < t; ++n) this.chart.isDatasetVisible(n) && ++e;
						return e
					},
					update: function (n) {
						var i = this,
							t = i.chart,
							e = t.chartArea,
							a = t.options,
							r = a.elements.arc,
							o = e.right - e.left - r.borderWidth,
							s = e.bottom - e.top - r.borderWidth,
							l = Math.min(o, s),
							u = {
								x: 0,
								y: 0
							},
							d = i.getMeta(),
							h = a.cutoutPercentage,
							c = a.circumference;
						if (c < 2 * Math.PI) {
							var f = a.rotation % (2 * Math.PI),
								g = (f += 2 * Math.PI * (f >= Math.PI ? -1 : f < -Math.PI ? 1 : 0)) + c,
								m = Math.cos(f),
								p = Math.sin(f),
								v = Math.cos(g),
								b = Math.sin(g),
								y = f <= 0 && 0 <= g || f <= 2 * Math.PI && 2 * Math.PI <= g,
								x = f <= .5 * Math.PI && .5 * Math.PI <= g || f <= 2.5 * Math.PI && 2.5 * Math.PI <= g,
								_ = f <= -Math.PI && -Math.PI <= g || f <= Math.PI && Math.PI <= g,
								k = f <= .5 * -Math.PI && .5 * -Math.PI <= g || f <= 1.5 * Math.PI && 1.5 * Math.PI <= g,
								w = h / 100,
								M = _ ? -1 : Math.min(m * (m < 0 ? 1 : w), v * (v < 0 ? 1 : w)),
								S = k ? -1 : Math.min(p * (p < 0 ? 1 : w), b * (b < 0 ? 1 : w)),
								D = y ? 1 : Math.max(m * (0 < m ? 1 : w), v * (0 < v ? 1 : w)),
								C = x ? 1 : Math.max(p * (0 < p ? 1 : w), b * (0 < b ? 1 : w)),
								P = .5 * (D - M),
								T = .5 * (C - S);
							l = Math.min(o / P, s / T), u = {
								x: -.5 * (D + M),
								y: -.5 * (C + S)
							}
						}
						t.borderWidth = i.getMaxBorderWidth(d.data), t.outerRadius = Math.max((l - t.borderWidth) / 2, 0), t.innerRadius = Math.max(h ? t.outerRadius / 100 * h : 0, 0), t.radiusLength = (t.outerRadius - t.innerRadius) / t.getVisibleDatasetCount(), t.offsetX = u.x * t.outerRadius, t.offsetY = u.y * t.outerRadius, d.total = i.calculateTotal(), i.outerRadius = t.outerRadius - t.radiusLength * i.getRingIndex(i.index), i.innerRadius = Math.max(i.outerRadius - t.radiusLength, 0), O.each(d.data, function (t, e) {
							i.updateElement(t, e, n)
						})
					},
					updateElement: function (t, e, n) {
						var i = this,
							a = i.chart,
							r = a.chartArea,
							o = a.options,
							s = o.animation,
							l = (r.left + r.right) / 2,
							u = (r.top + r.bottom) / 2,
							d = o.rotation,
							h = o.rotation,
							c = i.getDataset(),
							f = n && s.animateRotate ? 0 : t.hidden ? 0 : i.calculateCircumference(c.data[e]) * (o.circumference / (2 * Math.PI)),
							g = n && s.animateScale ? 0 : i.innerRadius,
							m = n && s.animateScale ? 0 : i.outerRadius,
							p = O.valueAtIndexOrDefault;
						O.extend(t, {
							_datasetIndex: i.index,
							_index: e,
							_model: {
								x: l + a.offsetX,
								y: u + a.offsetY,
								startAngle: d,
								endAngle: h,
								circumference: f,
								outerRadius: m,
								innerRadius: g,
								label: p(c.label, e, a.data.labels[e])
							}
						});
						var v = t._model,
							b = t.custom || {},
							y = O.valueAtIndexOrDefault,
							x = this.chart.options.elements.arc;
						v.backgroundColor = b.backgroundColor ? b.backgroundColor : y(c.backgroundColor, e, x.backgroundColor), v.borderColor = b.borderColor ? b.borderColor : y(c.borderColor, e, x.borderColor), v.borderWidth = b.borderWidth ? b.borderWidth : y(c.borderWidth, e, x.borderWidth), n && s.animateRotate || (v.startAngle = 0 === e ? o.rotation : i.getMeta().data[e - 1]._model.endAngle, v.endAngle = v.startAngle + v.circumference), t.pivot()
					},
					calculateTotal: function () {
						var n, i = this.getDataset(),
							t = this.getMeta(),
							a = 0;
						return O.each(t.data, function (t, e) {
							n = i.data[e], isNaN(n) || t.hidden || (a += Math.abs(n))
						}), a
					},
					calculateCircumference: function (t) {
						var e = this.getMeta().total;
						return 0 < e && !isNaN(t) ? 2 * Math.PI * (Math.abs(t) / e) : 0
					},
					getMaxBorderWidth: function (t) {
						for (var e, n, i = 0, a = this.index, r = t.length, o = 0; o < r; o++) i = (i = i < (e = t[o]._model ? t[o]._model.borderWidth : 0) ? e : i) < (n = t[o]._chart ? t[o]._chart.config.data.datasets[a].hoverBorderWidth : 0) ? n : i;
						return i
					}
				})
			}
		}, {
			26: 26,
			41: 41,
			46: 46
		}],
		18: [function (t, e, n) {
			"use strict";
			var i = t(26),
				a = t(41),
				g = t(46);
			i._set("line", {
				showLines: !0,
				spanGaps: !1,
				hover: {
					mode: "label"
				},
				scales: {
					xAxes: [{
						type: "category",
						id: "x-axis-0"
					}],
					yAxes: [{
						type: "linear",
						id: "y-axis-0"
					}]
				}
			}), e.exports = function (t) {
				function f(t, e) {
					return g.valueOrDefault(t.showLine, e.showLines)
				}
				t.controllers.line = t.DatasetController.extend({
					datasetElementType: a.Line,
					dataElementType: a.Point,
					update: function (t) {
						var e, n, i, a = this,
							r = a.getMeta(),
							o = r.dataset,
							s = r.data || [],
							l = a.chart.options,
							u = l.elements.line,
							d = a.getScaleForId(r.yAxisID),
							h = a.getDataset(),
							c = f(h, l);
						for (c && (i = o.custom || {}, void 0 !== h.tension && void 0 === h.lineTension && (h.lineTension = h.tension), o._scale = d, o._datasetIndex = a.index, o._children = s, o._model = {
							spanGaps: h.spanGaps ? h.spanGaps : l.spanGaps,
							tension: i.tension ? i.tension : g.valueOrDefault(h.lineTension, u.tension),
							backgroundColor: i.backgroundColor ? i.backgroundColor : h.backgroundColor || u.backgroundColor,
							borderWidth: i.borderWidth ? i.borderWidth : h.borderWidth || u.borderWidth,
							borderColor: i.borderColor ? i.borderColor : h.borderColor || u.borderColor,
							borderCapStyle: i.borderCapStyle ? i.borderCapStyle : h.borderCapStyle || u.borderCapStyle,
							borderDash: i.borderDash ? i.borderDash : h.borderDash || u.borderDash,
							borderDashOffset: i.borderDashOffset ? i.borderDashOffset : h.borderDashOffset || u.borderDashOffset,
							borderJoinStyle: i.borderJoinStyle ? i.borderJoinStyle : h.borderJoinStyle || u.borderJoinStyle,
							fill: i.fill ? i.fill : void 0 !== h.fill ? h.fill : u.fill,
							steppedLine: i.steppedLine ? i.steppedLine : g.valueOrDefault(h.steppedLine, u.stepped),
							cubicInterpolationMode: i.cubicInterpolationMode ? i.cubicInterpolationMode : g.valueOrDefault(h.cubicInterpolationMode, u.cubicInterpolationMode)
						}, o.pivot()), e = 0, n = s.length; e < n; ++e) a.updateElement(s[e], e, t);
						for (c && 0 !== o._model.tension && a.updateBezierControlPoints(), e = 0, n = s.length; e < n; ++e) s[e].pivot()
					},
					getPointBackgroundColor: function (t, e) {
						var n = this.chart.options.elements.point.backgroundColor,
							i = this.getDataset(),
							a = t.custom || {};
						return a.backgroundColor ? n = a.backgroundColor : i.pointBackgroundColor ? n = g.valueAtIndexOrDefault(i.pointBackgroundColor, e, n) : i.backgroundColor && (n = i.backgroundColor), n
					},
					getPointBorderColor: function (t, e) {
						var n = this.chart.options.elements.point.borderColor,
							i = this.getDataset(),
							a = t.custom || {};
						return a.borderColor ? n = a.borderColor : i.pointBorderColor ? n = g.valueAtIndexOrDefault(i.pointBorderColor, e, n) : i.borderColor && (n = i.borderColor), n
					},
					getPointBorderWidth: function (t, e) {
						var n = this.chart.options.elements.point.borderWidth,
							i = this.getDataset(),
							a = t.custom || {};
						return isNaN(a.borderWidth) ? !isNaN(i.pointBorderWidth) || g.isArray(i.pointBorderWidth) ? n = g.valueAtIndexOrDefault(i.pointBorderWidth, e, n) : isNaN(i.borderWidth) || (n = i.borderWidth) : n = a.borderWidth, n
					},
					getPointRotation: function (t, e) {
						var n = this.chart.options.elements.point.rotation,
							i = this.getDataset(),
							a = t.custom || {};
						return isNaN(a.rotation) ? isNaN(i.pointRotation) && !g.isArray(i.pointRotation) || (n = g.valueAtIndexOrDefault(i.pointRotation, e, n)) : n = a.rotation, n
					},
					updateElement: function (t, e, n) {
						var i, a, r = this,
							o = r.getMeta(),
							s = t.custom || {},
							l = r.getDataset(),
							u = r.index,
							d = l.data[e],
							h = r.getScaleForId(o.yAxisID),
							c = r.getScaleForId(o.xAxisID),
							f = r.chart.options.elements.point;
						void 0 !== l.radius && void 0 === l.pointRadius && (l.pointRadius = l.radius), void 0 !== l.hitRadius && void 0 === l.pointHitRadius && (l.pointHitRadius = l.hitRadius), i = c.getPixelForValue("object" == typeof d ? d : NaN, e, u), a = n ? h.getBasePixel() : r.calculatePointY(d, e, u), t._xScale = c, t._yScale = h, t._datasetIndex = u, t._index = e, t._model = {
							x: i,
							y: a,
							skip: s.skip || isNaN(i) || isNaN(a),
							radius: s.radius || g.valueAtIndexOrDefault(l.pointRadius, e, f.radius),
							pointStyle: s.pointStyle || g.valueAtIndexOrDefault(l.pointStyle, e, f.pointStyle),
							rotation: r.getPointRotation(t, e),
							backgroundColor: r.getPointBackgroundColor(t, e),
							borderColor: r.getPointBorderColor(t, e),
							borderWidth: r.getPointBorderWidth(t, e),
							tension: o.dataset._model ? o.dataset._model.tension : 0,
							steppedLine: !!o.dataset._model && o.dataset._model.steppedLine,
							hitRadius: s.hitRadius || g.valueAtIndexOrDefault(l.pointHitRadius, e, f.hitRadius)
						}
					},
					calculatePointY: function (t, e, n) {
						var i, a, r, o = this.chart,
							s = this.getMeta(),
							l = this.getScaleForId(s.yAxisID),
							u = 0,
							d = 0;
						if (l.options.stacked) {
							for (i = 0; i < n; i++)
								if (a = o.data.datasets[i], "line" === (r = o.getDatasetMeta(i)).type && r.yAxisID === l.id && o.isDatasetVisible(i)) {
									var h = Number(l.getRightValue(a.data[e]));
									h < 0 ? d += h || 0 : u += h || 0
								}
							var c = Number(l.getRightValue(t));
							return c < 0 ? l.getPixelForValue(d + c) : l.getPixelForValue(u + c)
						}
						return l.getPixelForValue(t)
					},
					updateBezierControlPoints: function () {
						var t, e, n, i, a = this.getMeta(),
							r = this.chart.chartArea,
							o = a.data || [];

						function s(t, e, n) {
							return Math.max(Math.min(t, n), e)
						}
						if (a.dataset._model.spanGaps && (o = o.filter(function (t) {
							return !t._model.skip
						})), "monotone" === a.dataset._model.cubicInterpolationMode) g.splineCurveMonotone(o);
						else
							for (t = 0, e = o.length; t < e; ++t) n = o[t]._model, i = g.splineCurve(g.previousItem(o, t)._model, n, g.nextItem(o, t)._model, a.dataset._model.tension), n.controlPointPreviousX = i.previous.x, n.controlPointPreviousY = i.previous.y, n.controlPointNextX = i.next.x, n.controlPointNextY = i.next.y;
						if (this.chart.options.elements.line.capBezierPoints)
							for (t = 0, e = o.length; t < e; ++t)(n = o[t]._model).controlPointPreviousX = s(n.controlPointPreviousX, r.left, r.right), n.controlPointPreviousY = s(n.controlPointPreviousY, r.top, r.bottom), n.controlPointNextX = s(n.controlPointNextX, r.left, r.right), n.controlPointNextY = s(n.controlPointNextY, r.top, r.bottom)
					},
					draw: function () {
						var t, e = this.chart,
							n = this.getMeta(),
							i = n.data || [],
							a = e.chartArea,
							r = i.length,
							o = 0;
						for (f(this.getDataset(), e.options) && (t = (n.dataset._model.borderWidth || 0) / 2, g.canvas.clipArea(e.ctx, {
							left: a.left,
							right: a.right,
							top: a.top - t,
							bottom: a.bottom + t
						}), n.dataset.draw(), g.canvas.unclipArea(e.ctx)); o < r; ++o) i[o].draw(a)
					},
					setHoverStyle: function (t) {
						var e = this.chart.data.datasets[t._datasetIndex],
							n = t._index,
							i = t.custom || {},
							a = t._model;
						t.$previousStyle = {
							backgroundColor: a.backgroundColor,
							borderColor: a.borderColor,
							borderWidth: a.borderWidth,
							radius: a.radius
						}, a.backgroundColor = i.hoverBackgroundColor || g.valueAtIndexOrDefault(e.pointHoverBackgroundColor, n, g.getHoverColor(a.backgroundColor)), a.borderColor = i.hoverBorderColor || g.valueAtIndexOrDefault(e.pointHoverBorderColor, n, g.getHoverColor(a.borderColor)), a.borderWidth = i.hoverBorderWidth || g.valueAtIndexOrDefault(e.pointHoverBorderWidth, n, a.borderWidth), a.radius = i.hoverRadius || g.valueAtIndexOrDefault(e.pointHoverRadius, n, this.chart.options.elements.point.hoverRadius)
					}
				})
			}
		}, {
			26: 26,
			41: 41,
			46: 46
		}],
		19: [function (t, e, n) {
			"use strict";
			var i = t(26),
				a = t(41),
				_ = t(46);
			i._set("polarArea", {
				scale: {
					type: "radialLinear",
					angleLines: {
						display: !1
					},
					gridLines: {
						circular: !0
					},
					pointLabels: {
						display: !1
					},
					ticks: {
						beginAtZero: !0
					}
				},
				animation: {
					animateRotate: !0,
					animateScale: !0
				},
				startAngle: -.5 * Math.PI,
				legendCallback: function (t) {
					var e = [];
					e.push('<ul class="' + t.id + '-legend">');
					var n = t.data,
						i = n.datasets,
						a = n.labels;
					if (i.length)
						for (var r = 0; r < i[0].data.length; ++r) e.push('<li><span style="background-color:' + i[0].backgroundColor[r] + '"></span>'), a[r] && e.push(a[r]), e.push("</li>");
					return e.push("</ul>"), e.join("")
				},
				legend: {
					labels: {
						generateLabels: function (s) {
							var l = s.data;
							return l.labels.length && l.datasets.length ? l.labels.map(function (t, e) {
								var n = s.getDatasetMeta(0),
									i = l.datasets[0],
									a = n.data[e].custom || {},
									r = _.valueAtIndexOrDefault,
									o = s.options.elements.arc;
								return {
									text: t,
									fillStyle: a.backgroundColor ? a.backgroundColor : r(i.backgroundColor, e, o.backgroundColor),
									strokeStyle: a.borderColor ? a.borderColor : r(i.borderColor, e, o.borderColor),
									lineWidth: a.borderWidth ? a.borderWidth : r(i.borderWidth, e, o.borderWidth),
									hidden: isNaN(i.data[e]) || n.data[e].hidden,
									index: e
								}
							}) : []
						}
					},
					onClick: function (t, e) {
						var n, i, a, r = e.index,
							o = this.chart;
						for (n = 0, i = (o.data.datasets || []).length; n < i; ++n)(a = o.getDatasetMeta(n)).data[r].hidden = !a.data[r].hidden;
						o.update()
					}
				},
				tooltips: {
					callbacks: {
						title: function () {
							return ""
						},
						label: function (t, e) {
							return e.labels[t.index] + ": " + t.yLabel
						}
					}
				}
			}), e.exports = function (t) {
				t.controllers.polarArea = t.DatasetController.extend({
					dataElementType: a.Arc,
					linkScales: _.noop,
					update: function (n) {
						var t, e, i, a = this,
							r = a.getDataset(),
							o = a.getMeta(),
							s = a.chart.options.startAngle || 0,
							l = a._starts = [],
							u = a._angles = [];
						for (a._updateRadius(), o.count = a.countVisibleElements(), t = 0, e = r.data.length; t < e; t++) l[t] = s, i = a._computeAngle(t), s += u[t] = i;
						_.each(o.data, function (t, e) {
							a.updateElement(t, e, n)
						})
					},
					_updateRadius: function () {
						var t = this,
							e = t.chart,
							n = e.chartArea,
							i = e.options,
							a = i.elements.arc,
							r = Math.min(n.right - n.left, n.bottom - n.top);
						e.outerRadius = Math.max((r - a.borderWidth / 2) / 2, 0), e.innerRadius = Math.max(i.cutoutPercentage ? e.outerRadius / 100 * i.cutoutPercentage : 1, 0), e.radiusLength = (e.outerRadius - e.innerRadius) / e.getVisibleDatasetCount(), t.outerRadius = e.outerRadius - e.radiusLength * t.index, t.innerRadius = t.outerRadius - e.radiusLength
					},
					updateElement: function (t, e, n) {
						var i = this,
							a = i.chart,
							r = i.getDataset(),
							o = a.options,
							s = o.animation,
							l = a.scale,
							u = a.data.labels,
							d = l.xCenter,
							h = l.yCenter,
							c = o.startAngle,
							f = t.hidden ? 0 : l.getDistanceFromCenterForValue(r.data[e]),
							g = i._starts[e],
							m = g + (t.hidden ? 0 : i._angles[e]),
							p = s.animateScale ? 0 : l.getDistanceFromCenterForValue(r.data[e]);
						_.extend(t, {
							_datasetIndex: i.index,
							_index: e,
							_scale: l,
							_model: {
								x: d,
								y: h,
								innerRadius: 0,
								outerRadius: n ? p : f,
								startAngle: n && s.animateRotate ? c : g,
								endAngle: n && s.animateRotate ? c : m,
								label: _.valueAtIndexOrDefault(u, e, u[e])
							}
						});
						var v = this.chart.options.elements.arc,
							b = t.custom || {},
							y = _.valueAtIndexOrDefault,
							x = t._model;
						x.backgroundColor = b.backgroundColor ? b.backgroundColor : y(r.backgroundColor, e, v.backgroundColor), x.borderColor = b.borderColor ? b.borderColor : y(r.borderColor, e, v.borderColor), x.borderWidth = b.borderWidth ? b.borderWidth : y(r.borderWidth, e, v.borderWidth), t.pivot()
					},
					countVisibleElements: function () {
						var n = this.getDataset(),
							t = this.getMeta(),
							i = 0;
						return _.each(t.data, function (t, e) {
							isNaN(n.data[e]) || t.hidden || i++
						}), i
					},
					_computeAngle: function (t) {
						var e = this,
							n = this.getMeta().count,
							i = e.getDataset(),
							a = e.getMeta();
						if (isNaN(i.data[t]) || a.data[t].hidden) return 0;
						var r = {
							chart: e.chart,
							dataIndex: t,
							dataset: i,
							datasetIndex: e.index
						};
						return _.options.resolve([e.chart.options.elements.arc.angle, 2 * Math.PI / n], r, t)
					}
				})
			}
		}, {
			26: 26,
			41: 41,
			46: 46
		}],
		20: [function (t, e, n) {
			"use strict";
			var i = t(26),
				a = t(41),
				u = t(46);
			i._set("radar", {
				scale: {
					type: "radialLinear"
				},
				elements: {
					line: {
						tension: 0
					}
				}
			}), e.exports = function (t) {
				t.controllers.radar = t.DatasetController.extend({
					datasetElementType: a.Line,
					dataElementType: a.Point,
					linkScales: u.noop,
					update: function (n) {
						var i = this,
							t = i.getMeta(),
							e = t.dataset,
							a = t.data,
							r = e.custom || {},
							o = i.getDataset(),
							s = i.chart.options.elements.line,
							l = i.chart.scale;
						void 0 !== o.tension && void 0 === o.lineTension && (o.lineTension = o.tension), u.extend(t.dataset, {
							_datasetIndex: i.index,
							_scale: l,
							_children: a,
							_loop: !0,
							_model: {
								tension: r.tension ? r.tension : u.valueOrDefault(o.lineTension, s.tension),
								backgroundColor: r.backgroundColor ? r.backgroundColor : o.backgroundColor || s.backgroundColor,
								borderWidth: r.borderWidth ? r.borderWidth : o.borderWidth || s.borderWidth,
								borderColor: r.borderColor ? r.borderColor : o.borderColor || s.borderColor,
								fill: r.fill ? r.fill : void 0 !== o.fill ? o.fill : s.fill,
								borderCapStyle: r.borderCapStyle ? r.borderCapStyle : o.borderCapStyle || s.borderCapStyle,
								borderDash: r.borderDash ? r.borderDash : o.borderDash || s.borderDash,
								borderDashOffset: r.borderDashOffset ? r.borderDashOffset : o.borderDashOffset || s.borderDashOffset,
								borderJoinStyle: r.borderJoinStyle ? r.borderJoinStyle : o.borderJoinStyle || s.borderJoinStyle
							}
						}), t.dataset.pivot(), u.each(a, function (t, e) {
							i.updateElement(t, e, n)
						}, i), i.updateBezierControlPoints()
					},
					updateElement: function (t, e, n) {
						var i = this,
							a = t.custom || {},
							r = i.getDataset(),
							o = i.chart.scale,
							s = i.chart.options.elements.point,
							l = o.getPointPositionForValue(e, r.data[e]);
						void 0 !== r.radius && void 0 === r.pointRadius && (r.pointRadius = r.radius), void 0 !== r.hitRadius && void 0 === r.pointHitRadius && (r.pointHitRadius = r.hitRadius), u.extend(t, {
							_datasetIndex: i.index,
							_index: e,
							_scale: o,
							_model: {
								x: n ? o.xCenter : l.x,
								y: n ? o.yCenter : l.y,
								tension: a.tension ? a.tension : u.valueOrDefault(r.lineTension, i.chart.options.elements.line.tension),
								radius: a.radius ? a.radius : u.valueAtIndexOrDefault(r.pointRadius, e, s.radius),
								backgroundColor: a.backgroundColor ? a.backgroundColor : u.valueAtIndexOrDefault(r.pointBackgroundColor, e, s.backgroundColor),
								borderColor: a.borderColor ? a.borderColor : u.valueAtIndexOrDefault(r.pointBorderColor, e, s.borderColor),
								borderWidth: a.borderWidth ? a.borderWidth : u.valueAtIndexOrDefault(r.pointBorderWidth, e, s.borderWidth),
								pointStyle: a.pointStyle ? a.pointStyle : u.valueAtIndexOrDefault(r.pointStyle, e, s.pointStyle),
								rotation: a.rotation ? a.rotation : u.valueAtIndexOrDefault(r.pointRotation, e, s.rotation),
								hitRadius: a.hitRadius ? a.hitRadius : u.valueAtIndexOrDefault(r.pointHitRadius, e, s.hitRadius)
							}
						}), t._model.skip = a.skip ? a.skip : isNaN(t._model.x) || isNaN(t._model.y)
					},
					updateBezierControlPoints: function () {
						var a = this.chart.chartArea,
							r = this.getMeta();
						u.each(r.data, function (t, e) {
							var n = t._model,
								i = u.splineCurve(u.previousItem(r.data, e, !0)._model, n, u.nextItem(r.data, e, !0)._model, n.tension);
							n.controlPointPreviousX = Math.max(Math.min(i.previous.x, a.right), a.left), n.controlPointPreviousY = Math.max(Math.min(i.previous.y, a.bottom), a.top), n.controlPointNextX = Math.max(Math.min(i.next.x, a.right), a.left), n.controlPointNextY = Math.max(Math.min(i.next.y, a.bottom), a.top), t.pivot()
						})
					},
					setHoverStyle: function (t) {
						var e = this.chart.data.datasets[t._datasetIndex],
							n = t.custom || {},
							i = t._index,
							a = t._model;
						t.$previousStyle = {
							backgroundColor: a.backgroundColor,
							borderColor: a.borderColor,
							borderWidth: a.borderWidth,
							radius: a.radius
						}, a.radius = n.hoverRadius ? n.hoverRadius : u.valueAtIndexOrDefault(e.pointHoverRadius, i, this.chart.options.elements.point.hoverRadius), a.backgroundColor = n.hoverBackgroundColor ? n.hoverBackgroundColor : u.valueAtIndexOrDefault(e.pointHoverBackgroundColor, i, u.getHoverColor(a.backgroundColor)), a.borderColor = n.hoverBorderColor ? n.hoverBorderColor : u.valueAtIndexOrDefault(e.pointHoverBorderColor, i, u.getHoverColor(a.borderColor)), a.borderWidth = n.hoverBorderWidth ? n.hoverBorderWidth : u.valueAtIndexOrDefault(e.pointHoverBorderWidth, i, a.borderWidth)
					}
				})
			}
		}, {
			26: 26,
			41: 41,
			46: 46
		}],
		21: [function (t, e, n) {
			"use strict";
			t(26)._set("scatter", {
				hover: {
					mode: "single"
				},
				scales: {
					xAxes: [{
						id: "x-axis-1",
						type: "linear",
						position: "bottom"
					}],
					yAxes: [{
						id: "y-axis-1",
						type: "linear",
						position: "left"
					}]
				},
				showLines: !1,
				tooltips: {
					callbacks: {
						title: function () {
							return ""
						},
						label: function (t) {
							return "(" + t.xLabel + ", " + t.yLabel + ")"
						}
					}
				}
			}), e.exports = function (t) {
				t.controllers.scatter = t.controllers.line
			}
		}, {
			26: 26
		}],
		22: [function (t, e, n) {
			"use strict";
			var i = t(27);
			n = e.exports = i.extend({
				chart: null,
				currentStep: 0,
				numSteps: 60,
				easing: "",
				render: null,
				onAnimationProgress: null,
				onAnimationComplete: null
			});
			Object.defineProperty(n.prototype, "animationObject", {
				get: function () {
					return this
				}
			}), Object.defineProperty(n.prototype, "chartInstance", {
				get: function () {
					return this.chart
				},
				set: function (t) {
					this.chart = t
				}
			})
		}, {
			27: 27
		}],
		23: [function (t, e, n) {
			"use strict";
			var i = t(26),
				r = t(46);
			i._set("global", {
				animation: {
					duration: 1e3,
					easing: "easeOutQuart",
					onProgress: r.noop,
					onComplete: r.noop
				}
			}), e.exports = {
				frameDuration: 17,
				animations: [],
				dropFrames: 0,
				request: null,
				addAnimation: function (t, e, n, i) {
					var a, r, o = this.animations;
					for (e.chart = t, i || (t.animating = !0), a = 0, r = o.length; a < r; ++a)
						if (o[a].chart === t) return void (o[a] = e);
					o.push(e), 1 === o.length && this.requestAnimationFrame()
				},
				cancelAnimation: function (e) {
					var t = r.findIndex(this.animations, function (t) {
						return t.chart === e
					}); - 1 !== t && (this.animations.splice(t, 1), e.animating = !1)
				},
				requestAnimationFrame: function () {
					var t = this;
					null === t.request && (t.request = r.requestAnimFrame.call(window, function () {
						t.request = null, t.startDigest()
					}))
				},
				startDigest: function () {
					var t = this,
						e = Date.now(),
						n = 0;
					1 < t.dropFrames && (n = Math.floor(t.dropFrames), t.dropFrames = t.dropFrames % 1), t.advance(1 + n);
					var i = Date.now();
					t.dropFrames += (i - e) / t.frameDuration, 0 < t.animations.length && t.requestAnimationFrame()
				},
				advance: function (t) {
					for (var e, n, i = this.animations, a = 0; a < i.length;) n = (e = i[a]).chart, e.currentStep = (e.currentStep || 0) + t, e.currentStep = Math.min(e.currentStep, e.numSteps), r.callback(e.render, [n, e], n), r.callback(e.onAnimationProgress, [e], n), e.currentStep >= e.numSteps ? (r.callback(e.onAnimationComplete, [e], n), n.animating = !1, i.splice(a, 1)) : ++a
				}
			}
		}, {
			26: 26,
			46: 46
		}],
		24: [function (t, e, n) {
			"use strict";
			var s = t(22),
				l = t(23),
				h = t(26),
				c = t(46),
				a = t(29),
				r = t(31),
				f = t(49),
				g = t(32),
				m = t(34),
				i = t(36);
			e.exports = function (u) {
				function d(t) {
					return "top" === t || "bottom" === t
				}
				u.types = {}, u.instances = {}, u.controllers = {}, c.extend(u.prototype, {
					construct: function (t, e) {
						var n, i, a = this;
						(i = (n = (n = e) || {}).data = n.data || {}).datasets = i.datasets || [], i.labels = i.labels || [], n.options = c.configMerge(h.global, h[n.type], n.options || {}), e = n;
						var r = f.acquireContext(t, e),
							o = r && r.canvas,
							s = o && o.height,
							l = o && o.width;
						a.id = c.uid(), a.ctx = r, a.canvas = o, a.config = e, a.width = l, a.height = s, a.aspectRatio = s ? l / s : null, a.options = e.options, a._bufferedRender = !1, (a.chart = a).controller = a, u.instances[a.id] = a, Object.defineProperty(a, "data", {
							get: function () {
								return a.config.data
							},
							set: function (t) {
								a.config.data = t
							}
						}), r && o ? (a.initialize(), a.update()) : console.error("Failed to create chart: can't acquire context from the given item")
					},
					initialize: function () {
						var t = this;
						return g.notify(t, "beforeInit"), c.retinaScale(t, t.options.devicePixelRatio), t.bindEvents(), t.options.responsive && t.resize(!0), t.ensureScalesHaveIDs(), t.buildOrUpdateScales(), t.initToolTip(), g.notify(t, "afterInit"), t
					},
					clear: function () {
						return c.canvas.clear(this), this
					},
					stop: function () {
						return l.cancelAnimation(this), this
					},
					resize: function (t) {
						var e = this,
							n = e.options,
							i = e.canvas,
							a = n.maintainAspectRatio && e.aspectRatio || null,
							r = Math.max(0, Math.floor(c.getMaximumWidth(i))),
							o = Math.max(0, Math.floor(a ? r / a : c.getMaximumHeight(i)));
						if ((e.width !== r || e.height !== o) && (i.width = e.width = r, i.height = e.height = o, i.style.width = r + "px", i.style.height = o + "px", c.retinaScale(e, n.devicePixelRatio), !t)) {
							var s = {
								width: r,
								height: o
							};
							g.notify(e, "resize", [s]), e.options.onResize && e.options.onResize(e, s), e.stop(), e.update({
								duration: e.options.responsiveAnimationDuration
							})
						}
					},
					ensureScalesHaveIDs: function () {
						var t = this.options,
							e = t.scales || {},
							n = t.scale;
						c.each(e.xAxes, function (t, e) {
							t.id = t.id || "x-axis-" + e
						}), c.each(e.yAxes, function (t, e) {
							t.id = t.id || "y-axis-" + e
						}), n && (n.id = n.id || "scale")
					},
					buildOrUpdateScales: function () {
						var o = this,
							t = o.options,
							s = o.scales || {},
							e = [],
							l = Object.keys(s).reduce(function (t, e) {
								return t[e] = !1, t
							}, {});
						t.scales && (e = e.concat((t.scales.xAxes || []).map(function (t) {
							return {
								options: t,
								dtype: "category",
								dposition: "bottom"
							}
						}), (t.scales.yAxes || []).map(function (t) {
							return {
								options: t,
								dtype: "linear",
								dposition: "left"
							}
						}))), t.scale && e.push({
							options: t.scale,
							dtype: "radialLinear",
							isDefault: !0,
							dposition: "chartArea"
						}), c.each(e, function (t) {
							var e = t.options,
								n = e.id,
								i = c.valueOrDefault(e.type, t.dtype);
							d(e.position) !== d(t.dposition) && (e.position = t.dposition), l[n] = !0;
							var a = null;
							if (n in s && s[n].type === i) (a = s[n]).options = e, a.ctx = o.ctx, a.chart = o;
							else {
								var r = m.getScaleConstructor(i);
								if (!r) return;
								a = new r({
									id: n,
									type: i,
									options: e,
									ctx: o.ctx,
									chart: o
								}), s[a.id] = a
							}
							a.mergeTicksOptions(), t.isDefault && (o.scale = a)
						}), c.each(l, function (t, e) {
							t || delete s[e]
						}), o.scales = s, m.addScalesToLayout(this)
					},
					buildOrUpdateControllers: function () {
						var r = this,
							o = [],
							s = [];
						return c.each(r.data.datasets, function (t, e) {
							var n = r.getDatasetMeta(e),
								i = t.type || r.config.type;
							if (n.type && n.type !== i && (r.destroyDatasetMeta(e), n = r.getDatasetMeta(e)), n.type = i, o.push(n.type), n.controller) n.controller.updateIndex(e), n.controller.linkScales();
							else {
								var a = u.controllers[n.type];
								if (void 0 === a) throw new Error('"' + n.type + '" is not a chart type.');
								n.controller = new a(r, e), s.push(n.controller)
							}
						}, r), s
					},
					resetElements: function () {
						var n = this;
						c.each(n.data.datasets, function (t, e) {
							n.getDatasetMeta(e).controller.reset()
						}, n)
					},
					reset: function () {
						this.resetElements(), this.tooltip.initialize()
					},
					update: function (t) {
						var e, n, i = this;
						if (t && "object" == typeof t || (t = {
							duration: t,
							lazy: arguments[1]
						}), n = (e = i).options, c.each(e.scales, function (t) {
							r.removeBox(e, t)
						}), n = c.configMerge(u.defaults.global, u.defaults[e.config.type], n), e.options = e.config.options = n, e.ensureScalesHaveIDs(), e.buildOrUpdateScales(), e.tooltip._options = n.tooltips, e.tooltip.initialize(), g._invalidate(i), !1 !== g.notify(i, "beforeUpdate")) {
							i.tooltip._data = i.data;
							var a = i.buildOrUpdateControllers();
							c.each(i.data.datasets, function (t, e) {
								i.getDatasetMeta(e).controller.buildOrUpdateElements()
							}, i), i.updateLayout(), i.options.animation && i.options.animation.duration && c.each(a, function (t) {
								t.reset()
							}), i.updateDatasets(), i.tooltip.initialize(), i.lastActive = [], g.notify(i, "afterUpdate"), i._bufferedRender ? i._bufferedRequest = {
								duration: t.duration,
								easing: t.easing,
								lazy: t.lazy
							} : i.render(t)
						}
					},
					updateLayout: function () {
						!1 !== g.notify(this, "beforeLayout") && (r.update(this, this.width, this.height), g.notify(this, "afterScaleUpdate"), g.notify(this, "afterLayout"))
					},
					updateDatasets: function () {
						if (!1 !== g.notify(this, "beforeDatasetsUpdate")) {
							for (var t = 0, e = this.data.datasets.length; t < e; ++t) this.updateDataset(t);
							g.notify(this, "afterDatasetsUpdate")
						}
					},
					updateDataset: function (t) {
						var e = this.getDatasetMeta(t),
							n = {
								meta: e,
								index: t
							};
						!1 !== g.notify(this, "beforeDatasetUpdate", [n]) && (e.controller.update(), g.notify(this, "afterDatasetUpdate", [n]))
					},
					render: function (t) {
						var e = this;
						t && "object" == typeof t || (t = {
							duration: t,
							lazy: arguments[1]
						});
						var n = t.duration,
							i = t.lazy;
						if (!1 !== g.notify(e, "beforeRender")) {
							var a = e.options.animation,
								r = function (t) {
									g.notify(e, "afterRender"), c.callback(a && a.onComplete, [t], e)
								};
							if (a && (void 0 !== n && 0 !== n || void 0 === n && 0 !== a.duration)) {
								var o = new s({
									numSteps: (n || a.duration) / 16.66,
									easing: t.easing || a.easing,
									render: function (t, e) {
										var n = c.easing.effects[e.easing],
											i = e.currentStep,
											a = i / e.numSteps;
										t.draw(n(a), a, i)
									},
									onAnimationProgress: a.onProgress,
									onAnimationComplete: r
								});
								l.addAnimation(e, o, n, i)
							} else e.draw(), r(new s({
								numSteps: 0,
								chart: e
							}));
							return e
						}
					},
					draw: function (t) {
						var e = this;
						e.clear(), c.isNullOrUndef(t) && (t = 1), e.transition(t), e.width <= 0 || e.height <= 0 || !1 !== g.notify(e, "beforeDraw", [t]) && (c.each(e.boxes, function (t) {
							t.draw(e.chartArea)
						}, e), e.scale && e.scale.draw(), e.drawDatasets(t), e._drawTooltip(t), g.notify(e, "afterDraw", [t]))
					},
					transition: function (t) {
						for (var e = 0, n = (this.data.datasets || []).length; e < n; ++e) this.isDatasetVisible(e) && this.getDatasetMeta(e).controller.transition(t);
						this.tooltip.transition(t)
					},
					drawDatasets: function (t) {
						var e = this;
						if (!1 !== g.notify(e, "beforeDatasetsDraw", [t])) {
							for (var n = (e.data.datasets || []).length - 1; 0 <= n; --n) e.isDatasetVisible(n) && e.drawDataset(n, t);
							g.notify(e, "afterDatasetsDraw", [t])
						}
					},
					drawDataset: function (t, e) {
						var n = this.getDatasetMeta(t),
							i = {
								meta: n,
								index: t,
								easingValue: e
							};
						!1 !== g.notify(this, "beforeDatasetDraw", [i]) && (n.controller.draw(e), g.notify(this, "afterDatasetDraw", [i]))
					},
					_drawTooltip: function (t) {
						var e = this.tooltip,
							n = {
								tooltip: e,
								easingValue: t
							};
						!1 !== g.notify(this, "beforeTooltipDraw", [n]) && (e.draw(), g.notify(this, "afterTooltipDraw", [n]))
					},
					getElementAtEvent: function (t) {
						return a.modes.single(this, t)
					},
					getElementsAtEvent: function (t) {
						return a.modes.label(this, t, {
							intersect: !0
						})
					},
					getElementsAtXAxis: function (t) {
						return a.modes["x-axis"](this, t, {
							intersect: !0
						})
					},
					getElementsAtEventForMode: function (t, e, n) {
						var i = a.modes[e];
						return "function" == typeof i ? i(this, t, n) : []
					},
					getDatasetAtEvent: function (t) {
						return a.modes.dataset(this, t, {
							intersect: !0
						})
					},
					getDatasetMeta: function (t) {
						var e = this.data.datasets[t];
						e._meta || (e._meta = {});
						var n = e._meta[this.id];
						return n || (n = e._meta[this.id] = {
							type: null,
							data: [],
							dataset: null,
							controller: null,
							hidden: null,
							xAxisID: null,
							yAxisID: null
						}), n
					},
					getVisibleDatasetCount: function () {
						for (var t = 0, e = 0, n = this.data.datasets.length; e < n; ++e) this.isDatasetVisible(e) && t++;
						return t
					},
					isDatasetVisible: function (t) {
						var e = this.getDatasetMeta(t);
						return "boolean" == typeof e.hidden ? !e.hidden : !this.data.datasets[t].hidden
					},
					generateLegend: function () {
						return this.options.legendCallback(this)
					},
					destroyDatasetMeta: function (t) {
						var e = this.id,
							n = this.data.datasets[t],
							i = n._meta && n._meta[e];
						i && (i.controller.destroy(), delete n._meta[e])
					},
					destroy: function () {
						var t, e, n = this,
							i = n.canvas;
						for (n.stop(), t = 0, e = n.data.datasets.length; t < e; ++t) n.destroyDatasetMeta(t);
						i && (n.unbindEvents(), c.canvas.clear(n), f.releaseContext(n.ctx), n.canvas = null, n.ctx = null), g.notify(n, "destroy"), delete u.instances[n.id]
					},
					toBase64Image: function () {
						return this.canvas.toDataURL.apply(this.canvas, arguments)
					},
					initToolTip: function () {
						var t = this;
						t.tooltip = new i({
							_chart: t,
							_chartInstance: t,
							_data: t.data,
							_options: t.options.tooltips
						}, t)
					},
					bindEvents: function () {
						var e = this,
							n = e._listeners = {},
							i = function () {
								e.eventHandler.apply(e, arguments)
							};
						c.each(e.options.events, function (t) {
							f.addEventListener(e, t, i), n[t] = i
						}), e.options.responsive && (i = function () {
							e.resize()
						}, f.addEventListener(e, "resize", i), n.resize = i)
					},
					unbindEvents: function () {
						var n = this,
							t = n._listeners;
						t && (delete n._listeners, c.each(t, function (t, e) {
							f.removeEventListener(n, e, t)
						}))
					},
					updateHoverStyle: function (t, e, n) {
						var i, a, r, o = n ? "setHoverStyle" : "removeHoverStyle";
						for (a = 0, r = t.length; a < r; ++a)(i = t[a]) && this.getDatasetMeta(i._datasetIndex).controller[o](i)
					},
					eventHandler: function (t) {
						var e = this,
							n = e.tooltip;
						if (!1 !== g.notify(e, "beforeEvent", [t])) {
							e._bufferedRender = !0, e._bufferedRequest = null;
							var i = e.handleEvent(t);
							n && (i = n._start ? n.handleEvent(t) : i | n.handleEvent(t)), g.notify(e, "afterEvent", [t]);
							var a = e._bufferedRequest;
							return a ? e.render(a) : i && !e.animating && (e.stop(), e.render({
								duration: e.options.hover.animationDuration,
								lazy: !0
							})), e._bufferedRender = !1, e._bufferedRequest = null, e
						}
					},
					handleEvent: function (t) {
						var e, n = this,
							i = n.options || {},
							a = i.hover;
						return n.lastActive = n.lastActive || [], "mouseout" === t.type ? n.active = [] : n.active = n.getElementsAtEventForMode(t, a.mode, a), c.callback(i.onHover || i.hover.onHover, [t.native, n.active], n), "mouseup" !== t.type && "click" !== t.type || i.onClick && i.onClick.call(n, t.native, n.active), n.lastActive.length && n.updateHoverStyle(n.lastActive, a.mode, !1), n.active.length && a.mode && n.updateHoverStyle(n.active, a.mode, !0), e = !c.arrayEquals(n.active, n.lastActive), n.lastActive = n.active, e
					}
				}), u.Controller = u
			}
		}, {
			22: 22,
			23: 23,
			26: 26,
			29: 29,
			31: 31,
			32: 32,
			34: 34,
			36: 36,
			46: 46,
			49: 49
		}],
		25: [function (t, e, n) {
			"use strict";
			var s = t(46);
			e.exports = function (t) {
				var r = ["push", "pop", "shift", "splice", "unshift"];

				function o(e, t) {
					var n = e._chartjs;
					if (n) {
						var i = n.listeners,
							a = i.indexOf(t); - 1 !== a && i.splice(a, 1), 0 < i.length || (r.forEach(function (t) {
								delete e[t]
							}), delete e._chartjs)
					}
				}
				t.DatasetController = function (t, e) {
					this.initialize(t, e)
				}, s.extend(t.DatasetController.prototype, {
					datasetElementType: null,
					dataElementType: null,
					initialize: function (t, e) {
						this.chart = t, this.index = e, this.linkScales(), this.addElements()
					},
					updateIndex: function (t) {
						this.index = t
					},
					linkScales: function () {
						var t = this,
							e = t.getMeta(),
							n = t.getDataset();
						null !== e.xAxisID && e.xAxisID in t.chart.scales || (e.xAxisID = n.xAxisID || t.chart.options.scales.xAxes[0].id), null !== e.yAxisID && e.yAxisID in t.chart.scales || (e.yAxisID = n.yAxisID || t.chart.options.scales.yAxes[0].id)
					},
					getDataset: function () {
						return this.chart.data.datasets[this.index]
					},
					getMeta: function () {
						return this.chart.getDatasetMeta(this.index)
					},
					getScaleForId: function (t) {
						return this.chart.scales[t]
					},
					reset: function () {
						this.update(!0)
					},
					destroy: function () {
						this._data && o(this._data, this)
					},
					createMetaDataset: function () {
						var t = this.datasetElementType;
						return t && new t({
							_chart: this.chart,
							_datasetIndex: this.index
						})
					},
					createMetaData: function (t) {
						var e = this.dataElementType;
						return e && new e({
							_chart: this.chart,
							_datasetIndex: this.index,
							_index: t
						})
					},
					addElements: function () {
						var t, e, n = this.getMeta(),
							i = this.getDataset().data || [],
							a = n.data;
						for (t = 0, e = i.length; t < e; ++t) a[t] = a[t] || this.createMetaData(t);
						n.dataset = n.dataset || this.createMetaDataset()
					},
					addElementAndReset: function (t) {
						var e = this.createMetaData(t);
						this.getMeta().data.splice(t, 0, e), this.updateElement(e, t, !0)
					},
					buildOrUpdateElements: function () {
						var a, t, e = this,
							n = e.getDataset(),
							i = n.data || (n.data = []);
						e._data !== i && (e._data && o(e._data, e), t = e, (a = i)._chartjs ? a._chartjs.listeners.push(t) : (Object.defineProperty(a, "_chartjs", {
							configurable: !0,
							enumerable: !1,
							value: {
								listeners: [t]
							}
						}), r.forEach(function (t) {
							var n = "onData" + t.charAt(0).toUpperCase() + t.slice(1),
								i = a[t];
							Object.defineProperty(a, t, {
								configurable: !0,
								enumerable: !1,
								value: function () {
									var e = Array.prototype.slice.call(arguments),
										t = i.apply(this, e);
									return s.each(a._chartjs.listeners, function (t) {
										"function" == typeof t[n] && t[n].apply(t, e)
									}), t
								}
							})
						})), e._data = i), e.resyncElements()
					},
					update: s.noop,
					transition: function (t) {
						for (var e = this.getMeta(), n = e.data || [], i = n.length, a = 0; a < i; ++a) n[a].transition(t);
						e.dataset && e.dataset.transition(t)
					},
					draw: function () {
						var t = this.getMeta(),
							e = t.data || [],
							n = e.length,
							i = 0;
						for (t.dataset && t.dataset.draw(); i < n; ++i) e[i].draw()
					},
					removeHoverStyle: function (t) {
						s.merge(t._model, t.$previousStyle || {}), delete t.$previousStyle
					},
					setHoverStyle: function (t) {
						var e = this.chart.data.datasets[t._datasetIndex],
							n = t._index,
							i = t.custom || {},
							a = s.valueAtIndexOrDefault,
							r = s.getHoverColor,
							o = t._model;
						t.$previousStyle = {
							backgroundColor: o.backgroundColor,
							borderColor: o.borderColor,
							borderWidth: o.borderWidth
						}, o.backgroundColor = i.hoverBackgroundColor ? i.hoverBackgroundColor : a(e.hoverBackgroundColor, n, r(o.backgroundColor)), o.borderColor = i.hoverBorderColor ? i.hoverBorderColor : a(e.hoverBorderColor, n, r(o.borderColor)), o.borderWidth = i.hoverBorderWidth ? i.hoverBorderWidth : a(e.hoverBorderWidth, n, o.borderWidth)
					},
					resyncElements: function () {
						var t = this.getMeta(),
							e = this.getDataset().data,
							n = t.data.length,
							i = e.length;
						i < n ? t.data.splice(i, n - i) : n < i && this.insertElements(n, i - n)
					},
					insertElements: function (t, e) {
						for (var n = 0; n < e; ++n) this.addElementAndReset(t + n)
					},
					onDataPush: function () {
						this.insertElements(this.getDataset().data.length - 1, arguments.length)
					},
					onDataPop: function () {
						this.getMeta().data.pop()
					},
					onDataShift: function () {
						this.getMeta().data.shift()
					},
					onDataSplice: function (t, e) {
						this.getMeta().data.splice(t, e), this.insertElements(t, arguments.length - 2)
					},
					onDataUnshift: function () {
						this.insertElements(0, arguments.length)
					}
				}), t.DatasetController.extend = s.inherits
			}
		}, {
			46: 46
		}],
		26: [function (t, e, n) {
			"use strict";
			var i = t(46);
			e.exports = {
				_set: function (t, e) {
					return i.merge(this[t] || (this[t] = {}), e)
				}
			}
		}, {
			46: 46
		}],
		27: [function (t, e, n) {
			"use strict";
			var g = t(2),
				i = t(46);
			var a = function (t) {
				i.extend(this, t), this.initialize.apply(this, arguments)
			};
			i.extend(a.prototype, {
				initialize: function () {
					this.hidden = !1
				},
				pivot: function () {
					var t = this;
					return t._view || (t._view = i.clone(t._model)), t._start = {}, t
				},
				transition: function (t) {
					var e = this,
						n = e._model,
						i = e._start,
						a = e._view;
					return n && 1 !== t ? (a || (a = e._view = {}), i || (i = e._start = {}), function (t, e, n, i) {
						var a, r, o, s, l, u, d, h, c, f = Object.keys(n);
						for (a = 0, r = f.length; a < r; ++a)
							if (u = n[o = f[a]], e.hasOwnProperty(o) || (e[o] = u), (s = e[o]) !== u && "_" !== o[0]) {
								if (t.hasOwnProperty(o) || (t[o] = s), (d = typeof u) == typeof (l = t[o]))
									if ("string" === d) {
										if ((h = g(l)).valid && (c = g(u)).valid) {
											e[o] = c.mix(h, i).rgbString();
											continue
										}
									} else if ("number" === d && isFinite(l) && isFinite(u)) {
										e[o] = l + (u - l) * i;
										continue
									}
								e[o] = u
							}
					}(i, a, n, t)) : (e._view = n, e._start = null), e
				},
				tooltipPosition: function () {
					return {
						x: this._model.x,
						y: this._model.y
					}
				},
				hasValue: function () {
					return i.isNumber(this._model.x) && i.isNumber(this._model.y)
				}
			}), a.extend = i.inherits, e.exports = a
		}, {
			2: 2,
			46: 46
		}],
		28: [function (t, e, n) {
			"use strict";
			var i = t(2),
				a = t(26),
				g = t(46),
				l = t(34);
			e.exports = function () {
				function d(t, e, n) {
					var i;
					return "string" == typeof t ? (i = parseInt(t, 10), -1 !== t.indexOf("%") && (i = i / 100 * e.parentNode[n])) : i = t, i
				}

				function h(t) {
					return null != t && "none" !== t
				}

				function e(t, e, n) {
					var i = document.defaultView,
						a = g._getParentNode(t),
						r = i.getComputedStyle(t)[e],
						o = i.getComputedStyle(a)[e],
						s = h(r),
						l = h(o),
						u = Number.POSITIVE_INFINITY;
					return s || l ? Math.min(s ? d(r, t, n) : u, l ? d(o, a, n) : u) : "none"
				}
				g.configMerge = function () {
					return g.merge(g.clone(arguments[0]), [].slice.call(arguments, 1), {
						merger: function (t, e, n, i) {
							var a = e[t] || {},
								r = n[t];
							"scales" === t ? e[t] = g.scaleMerge(a, r) : "scale" === t ? e[t] = g.merge(a, [l.getScaleDefaults(r.type), r]) : g._merger(t, e, n, i)
						}
					})
				}, g.scaleMerge = function () {
					return g.merge(g.clone(arguments[0]), [].slice.call(arguments, 1), {
						merger: function (t, e, n, i) {
							if ("xAxes" === t || "yAxes" === t) {
								var a, r, o, s = n[t].length;
								for (e[t] || (e[t] = []), a = 0; a < s; ++a) o = n[t][a], r = g.valueOrDefault(o.type, "xAxes" === t ? "category" : "linear"), a >= e[t].length && e[t].push({}), !e[t][a].type || o.type && o.type !== e[t][a].type ? g.merge(e[t][a], [l.getScaleDefaults(r), o]) : g.merge(e[t][a], o)
							} else g._merger(t, e, n, i)
						}
					})
				}, g.where = function (t, e) {
					if (g.isArray(t) && Array.prototype.filter) return t.filter(e);
					var n = [];
					return g.each(t, function (t) {
						e(t) && n.push(t)
					}), n
				}, g.findIndex = Array.prototype.findIndex ? function (t, e, n) {
					return t.findIndex(e, n)
				} : function (t, e, n) {
					n = void 0 === n ? t : n;
					for (var i = 0, a = t.length; i < a; ++i)
						if (e.call(n, t[i], i, t)) return i;
					return -1
				}, g.findNextWhere = function (t, e, n) {
					g.isNullOrUndef(n) && (n = -1);
					for (var i = n + 1; i < t.length; i++) {
						var a = t[i];
						if (e(a)) return a
					}
				}, g.findPreviousWhere = function (t, e, n) {
					g.isNullOrUndef(n) && (n = t.length);
					for (var i = n - 1; 0 <= i; i--) {
						var a = t[i];
						if (e(a)) return a
					}
				}, g.isNumber = function (t) {
					return !isNaN(parseFloat(t)) && isFinite(t)
				}, g.almostEquals = function (t, e, n) {
					return Math.abs(t - e) < n
				}, g.almostWhole = function (t, e) {
					var n = Math.round(t);
					return n - e < t && t < n + e
				}, g.max = function (t) {
					return t.reduce(function (t, e) {
						return isNaN(e) ? t : Math.max(t, e)
					}, Number.NEGATIVE_INFINITY)
				}, g.min = function (t) {
					return t.reduce(function (t, e) {
						return isNaN(e) ? t : Math.min(t, e)
					}, Number.POSITIVE_INFINITY)
				}, g.sign = Math.sign ? function (t) {
					return Math.sign(t)
				} : function (t) {
					return 0 === (t = +t) || isNaN(t) ? t : 0 < t ? 1 : -1
				}, g.log10 = Math.log10 ? function (t) {
					return Math.log10(t)
				} : function (t) {
					var e = Math.log(t) * Math.LOG10E,
						n = Math.round(e);
					return t === Math.pow(10, n) ? n : e
				}, g.toRadians = function (t) {
					return t * (Math.PI / 180)
				}, g.toDegrees = function (t) {
					return t * (180 / Math.PI)
				}, g.getAngleFromPoint = function (t, e) {
					var n = e.x - t.x,
						i = e.y - t.y,
						a = Math.sqrt(n * n + i * i),
						r = Math.atan2(i, n);
					return r < -.5 * Math.PI && (r += 2 * Math.PI), {
						angle: r,
						distance: a
					}
				}, g.distanceBetweenPoints = function (t, e) {
					return Math.sqrt(Math.pow(e.x - t.x, 2) + Math.pow(e.y - t.y, 2))
				}, g.aliasPixel = function (t) {
					return t % 2 == 0 ? 0 : .5
				}, g.splineCurve = function (t, e, n, i) {
					var a = t.skip ? e : t,
						r = e,
						o = n.skip ? e : n,
						s = Math.sqrt(Math.pow(r.x - a.x, 2) + Math.pow(r.y - a.y, 2)),
						l = Math.sqrt(Math.pow(o.x - r.x, 2) + Math.pow(o.y - r.y, 2)),
						u = s / (s + l),
						d = l / (s + l),
						h = i * (u = isNaN(u) ? 0 : u),
						c = i * (d = isNaN(d) ? 0 : d);
					return {
						previous: {
							x: r.x - h * (o.x - a.x),
							y: r.y - h * (o.y - a.y)
						},
						next: {
							x: r.x + c * (o.x - a.x),
							y: r.y + c * (o.y - a.y)
						}
					}
				}, g.EPSILON = Number.EPSILON || 1e-14, g.splineCurveMonotone = function (t) {
					var e, n, i, a, r, o, s, l, u, d = (t || []).map(function (t) {
						return {
							model: t._model,
							deltaK: 0,
							mK: 0
						}
					}),
						h = d.length;
					for (e = 0; e < h; ++e)
						if (!(i = d[e]).model.skip) {
							if (n = 0 < e ? d[e - 1] : null, (a = e < h - 1 ? d[e + 1] : null) && !a.model.skip) {
								var c = a.model.x - i.model.x;
								i.deltaK = 0 !== c ? (a.model.y - i.model.y) / c : 0
							} !n || n.model.skip ? i.mK = i.deltaK : !a || a.model.skip ? i.mK = n.deltaK : this.sign(n.deltaK) !== this.sign(i.deltaK) ? i.mK = 0 : i.mK = (n.deltaK + i.deltaK) / 2
						}
					for (e = 0; e < h - 1; ++e) i = d[e], a = d[e + 1], i.model.skip || a.model.skip || (g.almostEquals(i.deltaK, 0, this.EPSILON) ? i.mK = a.mK = 0 : (r = i.mK / i.deltaK, o = a.mK / i.deltaK, (l = Math.pow(r, 2) + Math.pow(o, 2)) <= 9 || (s = 3 / Math.sqrt(l), i.mK = r * s * i.deltaK, a.mK = o * s * i.deltaK)));
					for (e = 0; e < h; ++e)(i = d[e]).model.skip || (n = 0 < e ? d[e - 1] : null, a = e < h - 1 ? d[e + 1] : null, n && !n.model.skip && (u = (i.model.x - n.model.x) / 3, i.model.controlPointPreviousX = i.model.x - u, i.model.controlPointPreviousY = i.model.y - u * i.mK), a && !a.model.skip && (u = (a.model.x - i.model.x) / 3, i.model.controlPointNextX = i.model.x + u, i.model.controlPointNextY = i.model.y + u * i.mK))
				}, g.nextItem = function (t, e, n) {
					return n ? e >= t.length - 1 ? t[0] : t[e + 1] : e >= t.length - 1 ? t[t.length - 1] : t[e + 1]
				}, g.previousItem = function (t, e, n) {
					return n ? e <= 0 ? t[t.length - 1] : t[e - 1] : e <= 0 ? t[0] : t[e - 1]
				}, g.niceNum = function (t, e) {
					var n = Math.floor(g.log10(t)),
						i = t / Math.pow(10, n);
					return (e ? i < 1.5 ? 1 : i < 3 ? 2 : i < 7 ? 5 : 10 : i <= 1 ? 1 : i <= 2 ? 2 : i <= 5 ? 5 : 10) * Math.pow(10, n)
				}, g.requestAnimFrame = "undefined" == typeof window ? function (t) {
					t()
				} : window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (t) {
					return window.setTimeout(t, 1e3 / 60)
				}, g.getRelativePosition = function (t, e) {
					var n, i, a = t.originalEvent || t,
						r = t.target || t.srcElement,
						o = r.getBoundingClientRect(),
						s = a.touches;
					i = s && 0 < s.length ? (n = s[0].clientX, s[0].clientY) : (n = a.clientX, a.clientY);
					var l = parseFloat(g.getStyle(r, "padding-left")),
						u = parseFloat(g.getStyle(r, "padding-top")),
						d = parseFloat(g.getStyle(r, "padding-right")),
						h = parseFloat(g.getStyle(r, "padding-bottom")),
						c = o.right - o.left - l - d,
						f = o.bottom - o.top - u - h;
					return {
						x: n = Math.round((n - o.left - l) / c * r.width / e.currentDevicePixelRatio),
						y: i = Math.round((i - o.top - u) / f * r.height / e.currentDevicePixelRatio)
					}
				}, g.getConstraintWidth = function (t) {
					return e(t, "max-width", "clientWidth")
				}, g.getConstraintHeight = function (t) {
					return e(t, "max-height", "clientHeight")
				}, g._calculatePadding = function (t, e, n) {
					return -1 < (e = g.getStyle(t, e)).indexOf("%") ? n / parseInt(e, 10) : parseInt(e, 10)
				}, g._getParentNode = function (t) {
					var e = t.parentNode;
					return e && e.host && (e = e.host), e
				}, g.getMaximumWidth = function (t) {
					var e = g._getParentNode(t);
					if (!e) return t.clientWidth;
					var n = e.clientWidth,
						i = n - g._calculatePadding(e, "padding-left", n) - g._calculatePadding(e, "padding-right", n),
						a = g.getConstraintWidth(t);
					return isNaN(a) ? i : Math.min(i, a)
				}, g.getMaximumHeight = function (t) {
					var e = g._getParentNode(t);
					if (!e) return t.clientHeight;
					var n = e.clientHeight,
						i = n - g._calculatePadding(e, "padding-top", n) - g._calculatePadding(e, "padding-bottom", n),
						a = g.getConstraintHeight(t);
					return isNaN(a) ? i : Math.min(i, a)
				}, g.getStyle = function (t, e) {
					return t.currentStyle ? t.currentStyle[e] : document.defaultView.getComputedStyle(t, null).getPropertyValue(e)
				}, g.retinaScale = function (t, e) {
					var n = t.currentDevicePixelRatio = e || "undefined" != typeof window && window.devicePixelRatio || 1;
					if (1 !== n) {
						var i = t.canvas,
							a = t.height,
							r = t.width;
						i.height = a * n, i.width = r * n, t.ctx.scale(n, n), i.style.height || i.style.width || (i.style.height = a + "px", i.style.width = r + "px")
					}
				}, g.fontString = function (t, e, n) {
					return e + " " + t + "px " + n
				}, g.longestText = function (e, t, n, i) {
					var a = (i = i || {}).data = i.data || {},
						r = i.garbageCollect = i.garbageCollect || [];
					i.font !== t && (a = i.data = {}, r = i.garbageCollect = [], i.font = t), e.font = t;
					var o = 0;
					g.each(n, function (t) {
						null != t && !0 !== g.isArray(t) ? o = g.measureText(e, a, r, o, t) : g.isArray(t) && g.each(t, function (t) {
							null == t || g.isArray(t) || (o = g.measureText(e, a, r, o, t))
						})
					});
					var s = r.length / 2;
					if (s > n.length) {
						for (var l = 0; l < s; l++) delete a[r[l]];
						r.splice(0, s)
					}
					return o
				}, g.measureText = function (t, e, n, i, a) {
					var r = e[a];
					return r || (r = e[a] = t.measureText(a).width, n.push(a)), i < r && (i = r), i
				}, g.numberOfLabelLines = function (t) {
					var e = 1;
					return g.each(t, function (t) {
						g.isArray(t) && t.length > e && (e = t.length)
					}), e
				}, g.color = i ? function (t) {
					return t instanceof CanvasGradient && (t = a.global.defaultColor), i(t)
				} : function (t) {
					return console.error("Color.js not found!"), t
				}, g.getHoverColor = function (t) {
					return t instanceof CanvasPattern ? t : g.color(t).saturate(.5).darken(.1).rgbString()
				}
			}
		}, {
			2: 2,
			26: 26,
			34: 34,
			46: 46
		}],
		29: [function (t, e, n) {
			"use strict";
			var i = t(46);

			function s(t, e) {
				return t.native ? {
					x: t.x,
					y: t.y
				} : i.getRelativePosition(t, e)
			}

			function l(t, e) {
				var n, i, a, r, o;
				for (i = 0, r = t.data.datasets.length; i < r; ++i)
					if (t.isDatasetVisible(i))
						for (a = 0, o = (n = t.getDatasetMeta(i)).data.length; a < o; ++a) {
							var s = n.data[a];
							s._view.skip || e(s)
						}
			}

			function u(t, e) {
				var n = [];
				return l(t, function (t) {
					t.inRange(e.x, e.y) && n.push(t)
				}), n
			}

			function d(t, i, a, r) {
				var o = Number.POSITIVE_INFINITY,
					s = [];
				return l(t, function (t) {
					if (!a || t.inRange(i.x, i.y)) {
						var e = t.getCenterPoint(),
							n = r(i, e);
						n < o ? (s = [t], o = n) : n === o && s.push(t)
					}
				}), s
			}

			function h(t) {
				var a = -1 !== t.indexOf("x"),
					r = -1 !== t.indexOf("y");
				return function (t, e) {
					var n = a ? Math.abs(t.x - e.x) : 0,
						i = r ? Math.abs(t.y - e.y) : 0;
					return Math.sqrt(Math.pow(n, 2) + Math.pow(i, 2))
				}
			}

			function a(i, t, e) {
				var n = s(t, i);
				e.axis = e.axis || "x";
				var a = h(e.axis),
					r = e.intersect ? u(i, n) : d(i, n, !1, a),
					o = [];
				return r.length ? (i.data.datasets.forEach(function (t, e) {
					if (i.isDatasetVisible(e)) {
						var n = i.getDatasetMeta(e).data[r[0]._index];
						n && !n._view.skip && o.push(n)
					}
				}), o) : []
			}
			e.exports = {
				modes: {
					single: function (t, e) {
						var n = s(e, t),
							i = [];
						return l(t, function (t) {
							if (t.inRange(n.x, n.y)) return i.push(t), i
						}), i.slice(0, 1)
					},
					label: a,
					index: a,
					dataset: function (t, e, n) {
						var i = s(e, t);
						n.axis = n.axis || "xy";
						var a = h(n.axis),
							r = n.intersect ? u(t, i) : d(t, i, !1, a);
						return 0 < r.length && (r = t.getDatasetMeta(r[0]._datasetIndex).data), r
					},
					"x-axis": function (t, e) {
						return a(t, e, {
							intersect: !1
						})
					},
					point: function (t, e) {
						return u(t, s(e, t))
					},
					nearest: function (t, e, n) {
						var i = s(e, t);
						n.axis = n.axis || "xy";
						var a = h(n.axis),
							r = d(t, i, n.intersect, a);
						return 1 < r.length && r.sort(function (t, e) {
							var n = t.getArea() - e.getArea();
							return 0 === n && (n = t._datasetIndex - e._datasetIndex), n
						}), r.slice(0, 1)
					},
					x: function (t, e, n) {
						var i = s(e, t),
							a = [],
							r = !1;
						return l(t, function (t) {
							t.inXRange(i.x) && a.push(t), t.inRange(i.x, i.y) && (r = !0)
						}), n.intersect && !r && (a = []), a
					},
					y: function (t, e, n) {
						var i = s(e, t),
							a = [],
							r = !1;
						return l(t, function (t) {
							t.inYRange(i.y) && a.push(t), t.inRange(i.x, i.y) && (r = !0)
						}), n.intersect && !r && (a = []), a
					}
				}
			}
		}, {
			46: 46
		}],
		30: [function (t, e, n) {
			"use strict";
			t(26)._set("global", {
				responsive: !0,
				responsiveAnimationDuration: 0,
				maintainAspectRatio: !0,
				events: ["mousemove", "mouseout", "click", "touchstart", "touchmove"],
				hover: {
					onHover: null,
					mode: "nearest",
					intersect: !0,
					animationDuration: 400
				},
				onClick: null,
				defaultColor: "#a8afc7",
				defaultFontColor: "#a8afc7",
				defaultFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
				defaultFontSize: 12,
				defaultFontStyle: "normal",
				showLines: !0,
				elements: {},
				layout: {
					padding: {
						top: 0,
						right: 0,
						bottom: 0,
						left: 0
					}
				}
			}), e.exports = function () {
				var t = function (t, e) {
					return this.construct(t, e), this
				};
				return t.Chart = t
			}
		}, {
			26: 26
		}],
		31: [function (t, e, n) {
			"use strict";
			var N = t(46);

			function z(t, e) {
				return N.where(t, function (t) {
					return t.position === e
				})
			}

			function V(t, a) {
				t.forEach(function (t, e) {
					return t._tmpIndex_ = e, t
				}), t.sort(function (t, e) {
					var n = a ? e : t,
						i = a ? t : e;
					return n.weight === i.weight ? n._tmpIndex_ - i._tmpIndex_ : n.weight - i.weight
				}), t.forEach(function (t) {
					delete t._tmpIndex_
				})
			}
			e.exports = {
				defaults: {},
				addBox: function (t, e) {
					t.boxes || (t.boxes = []), e.fullWidth = e.fullWidth || !1, e.position = e.position || "top", e.weight = e.weight || 0, t.boxes.push(e)
				},
				removeBox: function (t, e) {
					var n = t.boxes ? t.boxes.indexOf(e) : -1; - 1 !== n && t.boxes.splice(n, 1)
				},
				configure: function (t, e, n) {
					for (var i, a = ["fullWidth", "position", "weight"], r = a.length, o = 0; o < r; ++o) i = a[o], n.hasOwnProperty(i) && (e[i] = n[i])
				},
				update: function (e, n, t) {
					if (e) {
						var i = e.options.layout || {},
							a = N.options.toPadding(i.padding),
							r = a.left,
							o = a.right,
							s = a.top,
							l = a.bottom,
							u = z(e.boxes, "left"),
							d = z(e.boxes, "right"),
							h = z(e.boxes, "top"),
							c = z(e.boxes, "bottom"),
							f = z(e.boxes, "chartArea");
						V(u, !0), V(d, !1), V(h, !0), V(c, !1);
						var g = n - r - o,
							m = t - s - l,
							p = m / 2,
							v = (n - g / 2) / (u.length + d.length),
							b = (t - p) / (h.length + c.length),
							y = g,
							x = m,
							_ = [];
						N.each(u.concat(d, h, c), function (t) {
							var e, n = t.isHorizontal();
							n ? (e = t.update(t.fullWidth ? g : y, b), x -= e.height) : (e = t.update(v, x), y -= e.width), _.push({
								horizontal: n,
								minSize: e,
								box: t
							})
						});
						var k = 0,
							w = 0,
							M = 0,
							S = 0;
						N.each(h.concat(c), function (t) {
							if (t.getPadding) {
								var e = t.getPadding();
								k = Math.max(k, e.left), w = Math.max(w, e.right)
							}
						}), N.each(u.concat(d), function (t) {
							if (t.getPadding) {
								var e = t.getPadding();
								M = Math.max(M, e.top), S = Math.max(S, e.bottom)
							}
						});
						var D = r,
							C = o,
							P = s,
							T = l;
						N.each(u.concat(d), Y), N.each(u, function (t) {
							D += t.width
						}), N.each(d, function (t) {
							C += t.width
						}), N.each(h.concat(c), Y), N.each(h, function (t) {
							P += t.height
						}), N.each(c, function (t) {
							T += t.height
						}), N.each(u.concat(d), function (e) {
							var t = N.findNextWhere(_, function (t) {
								return t.box === e
							}),
								n = {
									left: 0,
									right: 0,
									top: P,
									bottom: T
								};
							t && e.update(t.minSize.width, x, n)
						}), D = r, C = o, P = s, T = l, N.each(u, function (t) {
							D += t.width
						}), N.each(d, function (t) {
							C += t.width
						}), N.each(h, function (t) {
							P += t.height
						}), N.each(c, function (t) {
							T += t.height
						});
						var O = Math.max(k - D, 0);
						D += O, C += Math.max(w - C, 0);
						var I = Math.max(M - P, 0);
						P += I, T += Math.max(S - T, 0);
						var A = t - P - T,
							F = n - D - C;
						F === y && A === x || (N.each(u, function (t) {
							t.height = A
						}), N.each(d, function (t) {
							t.height = A
						}), N.each(h, function (t) {
							t.fullWidth || (t.width = F)
						}), N.each(c, function (t) {
							t.fullWidth || (t.width = F)
						}), x = A, y = F);
						var R = r + O,
							L = s + I;
						N.each(u.concat(h), W), R += y, L += x, N.each(d, W), N.each(c, W), e.chartArea = {
							left: D,
							top: P,
							right: D + y,
							bottom: P + x
						}, N.each(f, function (t) {
							t.left = e.chartArea.left, t.top = e.chartArea.top, t.right = e.chartArea.right, t.bottom = e.chartArea.bottom, t.update(y, x)
						})
					}

					function Y(e) {
						var t = N.findNextWhere(_, function (t) {
							return t.box === e
						});
						if (t)
							if (e.isHorizontal()) {
								var n = {
									left: Math.max(D, k),
									right: Math.max(C, w),
									top: 0,
									bottom: 0
								};
								e.update(e.fullWidth ? g : y, m / 2, n)
							} else e.update(t.minSize.width, x)
					}

					function W(t) {
						t.isHorizontal() ? (t.left = t.fullWidth ? r : D, t.right = t.fullWidth ? n - o : D + y, t.top = L, t.bottom = L + t.height, L = t.bottom) : (t.left = R, t.right = R + t.width, t.top = P, t.bottom = P + x, R = t.right)
					}
				}
			}
		}, {
			46: 46
		}],
		32: [function (t, e, n) {
			"use strict";
			var o = t(26),
				s = t(46);
			o._set("global", {
				plugins: {}
			}), e.exports = {
				_plugins: [],
				_cacheId: 0,
				register: function (t) {
					var e = this._plugins;
					[].concat(t).forEach(function (t) {
						-1 === e.indexOf(t) && e.push(t)
					}), this._cacheId++
				},
				unregister: function (t) {
					var n = this._plugins;
					[].concat(t).forEach(function (t) {
						var e = n.indexOf(t); - 1 !== e && n.splice(e, 1)
					}), this._cacheId++
				},
				clear: function () {
					this._plugins = [], this._cacheId++
				},
				count: function () {
					return this._plugins.length
				},
				getAll: function () {
					return this._plugins
				},
				notify: function (t, e, n) {
					var i, a, r, o, s, l = this.descriptors(t),
						u = l.length;
					for (i = 0; i < u; ++i)
						if ("function" == typeof (s = (r = (a = l[i]).plugin)[e]) && ((o = [t].concat(n || [])).push(a.options), !1 === s.apply(r, o))) return !1;
					return !0
				},
				descriptors: function (t) {
					var e = t.$plugins || (t.$plugins = {});
					if (e.id === this._cacheId) return e.descriptors;
					var i = [],
						a = [],
						n = t && t.config || {},
						r = n.options && n.options.plugins || {};
					return this._plugins.concat(n.plugins || []).forEach(function (t) {
						if (-1 === i.indexOf(t)) {
							var e = t.id,
								n = r[e];
							!1 !== n && (!0 === n && (n = s.clone(o.global.plugins[e])), i.push(t), a.push({
								plugin: t,
								options: n || {}
							}))
						}
					}), e.descriptors = a, e.id = this._cacheId, a
				},
				_invalidate: function (t) {
					delete t.$plugins
				}
			}
		}, {
			26: 26,
			46: 46
		}],
		33: [function (t, e, n) {
			"use strict";
			var x = t(26),
				i = t(27),
				B = t(46),
				a = t(35);

			function _(t) {
				var e, n, i = [];
				for (e = 0, n = t.length; e < n; ++e) i.push(t[e].label);
				return i
			}

			function E(t, e, n) {
				var i = t.getPixelForTick(e);
				return n && (i -= 0 === e ? (t.getPixelForTick(1) - i) / 2 : (i - t.getPixelForTick(e - 1)) / 2), i
			}

			function k(t, e, n) {
				return B.isArray(e) ? B.longestText(t, n, e) : t.measureText(e).width
			}

			function w(t) {
				var e = B.valueOrDefault,
					n = x.global,
					i = e(t.fontSize, n.defaultFontSize),
					a = e(t.fontStyle, n.defaultFontStyle),
					r = e(t.fontFamily, n.defaultFontFamily);
				return {
					size: i,
					style: a,
					family: r,
					font: B.fontString(i, a, r)
				}
			}

			function M(t) {
				return B.options.toLineHeight(B.valueOrDefault(t.lineHeight, 1.2), B.valueOrDefault(t.fontSize, x.global.defaultFontSize))
			}
			x._set("scale", {
				display: !0,
				position: "left",
				offset: !1,
				gridLines: {
					display: !0,
					color: "#e3e7ed",
					lineWidth: 1,
					drawBorder: !0,
					drawOnChartArea: !0,
					drawTicks: !0,
					tickMarkLength: 10,
					zeroLineWidth: 1,
					zeroLineColor: "#e3e7ed",
					zeroLineBorderDash: [],
					zeroLineBorderDashOffset: 0,
					offsetGridLines: !1,
					borderDash: [],
					borderDashOffset: 0
				},
				scaleLabel: {
					display: !1,
					labelString: "",
					lineHeight: 1.2,
					padding: {
						top: 4,
						bottom: 4
					}
				},
				ticks: {
					beginAtZero: !1,
					minRotation: 0,
					maxRotation: 50,
					mirror: !1,
					padding: 0,
					reverse: !1,
					display: !0,
					autoSkip: !0,
					autoSkipPadding: 0,
					labelOffset: 0,
					callback: a.formatters.values,
					minor: {},
					major: {}
				}
			}), e.exports = i.extend({
				getPadding: function () {
					return {
						left: this.paddingLeft || 0,
						top: this.paddingTop || 0,
						right: this.paddingRight || 0,
						bottom: this.paddingBottom || 0
					}
				},
				getTicks: function () {
					return this._ticks
				},
				mergeTicksOptions: function () {
					var t = this.options.ticks;
					for (var e in !1 === t.minor && (t.minor = {
						display: !1
					}), !1 === t.major && (t.major = {
						display: !1
					}), t) "major" !== e && "minor" !== e && (void 0 === t.minor[e] && (t.minor[e] = t[e]), void 0 === t.major[e] && (t.major[e] = t[e]))
				},
				beforeUpdate: function () {
					B.callback(this.options.beforeUpdate, [this])
				},
				update: function (t, e, n) {
					var i, a, r, o, s, l, u = this;
					for (u.beforeUpdate(), u.maxWidth = t, u.maxHeight = e, u.margins = B.extend({
						left: 0,
						right: 0,
						top: 0,
						bottom: 0
					}, n), u.longestTextCache = u.longestTextCache || {}, u.beforeSetDimensions(), u.setDimensions(), u.afterSetDimensions(), u.beforeDataLimits(), u.determineDataLimits(), u.afterDataLimits(), u.beforeBuildTicks(), s = u.buildTicks() || [], u.afterBuildTicks(), u.beforeTickToLabelConversion(), r = u.convertTicksToLabels(s) || u.ticks, u.afterTickToLabelConversion(), i = 0, a = (u.ticks = r).length; i < a; ++i) o = r[i], (l = s[i]) ? l.label = o : s.push(l = {
						label: o,
						major: !1
					});
					return u._ticks = s, u.beforeCalculateTickRotation(), u.calculateTickRotation(), u.afterCalculateTickRotation(), u.beforeFit(), u.fit(), u.afterFit(), u.afterUpdate(), u.minSize
				},
				afterUpdate: function () {
					B.callback(this.options.afterUpdate, [this])
				},
				beforeSetDimensions: function () {
					B.callback(this.options.beforeSetDimensions, [this])
				},
				setDimensions: function () {
					var t = this;
					t.isHorizontal() ? (t.width = t.maxWidth, t.left = 0, t.right = t.width) : (t.height = t.maxHeight, t.top = 0, t.bottom = t.height), t.paddingLeft = 0, t.paddingTop = 0, t.paddingRight = 0, t.paddingBottom = 0
				},
				afterSetDimensions: function () {
					B.callback(this.options.afterSetDimensions, [this])
				},
				beforeDataLimits: function () {
					B.callback(this.options.beforeDataLimits, [this])
				},
				determineDataLimits: B.noop,
				afterDataLimits: function () {
					B.callback(this.options.afterDataLimits, [this])
				},
				beforeBuildTicks: function () {
					B.callback(this.options.beforeBuildTicks, [this])
				},
				buildTicks: B.noop,
				afterBuildTicks: function () {
					B.callback(this.options.afterBuildTicks, [this])
				},
				beforeTickToLabelConversion: function () {
					B.callback(this.options.beforeTickToLabelConversion, [this])
				},
				convertTicksToLabels: function () {
					var t = this.options.ticks;
					this.ticks = this.ticks.map(t.userCallback || t.callback, this)
				},
				afterTickToLabelConversion: function () {
					B.callback(this.options.afterTickToLabelConversion, [this])
				},
				beforeCalculateTickRotation: function () {
					B.callback(this.options.beforeCalculateTickRotation, [this])
				},
				calculateTickRotation: function () {
					var t = this,
						e = t.ctx,
						n = t.options.ticks,
						i = _(t._ticks),
						a = w(n);
					e.font = a.font;
					var r = n.minRotation || 0;
					if (i.length && t.options.display && t.isHorizontal())
						for (var o, s = B.longestText(e, a.font, i, t.longestTextCache), l = s, u = t.getPixelForTick(1) - t.getPixelForTick(0) - 6; u < l && r < n.maxRotation;) {
							var d = B.toRadians(r);
							if (o = Math.cos(d), Math.sin(d) * s > t.maxHeight) {
								r--;
								break
							}
							r++, l = o * s
						}
					t.labelRotation = r
				},
				afterCalculateTickRotation: function () {
					B.callback(this.options.afterCalculateTickRotation, [this])
				},
				beforeFit: function () {
					B.callback(this.options.beforeFit, [this])
				},
				fit: function () {
					var t = this,
						e = t.minSize = {
							width: 0,
							height: 0
						},
						n = _(t._ticks),
						i = t.options,
						a = i.ticks,
						r = i.scaleLabel,
						o = i.gridLines,
						s = i.display,
						l = t.isHorizontal(),
						u = w(a),
						d = i.gridLines.tickMarkLength;
					if (e.width = l ? t.isFullWidth() ? t.maxWidth - t.margins.left - t.margins.right : t.maxWidth : s && o.drawTicks ? d : 0, e.height = l ? s && o.drawTicks ? d : 0 : t.maxHeight, r.display && s) {
						var h = M(r) + B.options.toPadding(r.padding).height;
						l ? e.height += h : e.width += h
					}
					if (a.display && s) {
						var c = B.longestText(t.ctx, u.font, n, t.longestTextCache),
							f = B.numberOfLabelLines(n),
							g = .5 * u.size,
							m = t.options.ticks.padding;
						if (l) {
							t.longestLabelWidth = c;
							var p = B.toRadians(t.labelRotation),
								v = Math.cos(p),
								b = Math.sin(p) * c + u.size * f + g * (f - 1) + g;
							e.height = Math.min(t.maxHeight, e.height + b + m), t.ctx.font = u.font;
							var y = k(t.ctx, n[0], u.font),
								x = k(t.ctx, n[n.length - 1], u.font);
							0 !== t.labelRotation ? (t.paddingLeft = "bottom" === i.position ? v * y + 3 : v * g + 3, t.paddingRight = "bottom" === i.position ? v * g + 3 : v * x + 3) : (t.paddingLeft = y / 2 + 3, t.paddingRight = x / 2 + 3)
						} else a.mirror ? c = 0 : c += m + g, e.width = Math.min(t.maxWidth, e.width + c), t.paddingTop = u.size / 2, t.paddingBottom = u.size / 2
					}
					t.handleMargins(), t.width = e.width, t.height = e.height
				},
				handleMargins: function () {
					var t = this;
					t.margins && (t.paddingLeft = Math.max(t.paddingLeft - t.margins.left, 0), t.paddingTop = Math.max(t.paddingTop - t.margins.top, 0), t.paddingRight = Math.max(t.paddingRight - t.margins.right, 0), t.paddingBottom = Math.max(t.paddingBottom - t.margins.bottom, 0))
				},
				afterFit: function () {
					B.callback(this.options.afterFit, [this])
				},
				isHorizontal: function () {
					return "top" === this.options.position || "bottom" === this.options.position
				},
				isFullWidth: function () {
					return this.options.fullWidth
				},
				getRightValue: function (t) {
					if (B.isNullOrUndef(t)) return NaN;
					if ("number" == typeof t && !isFinite(t)) return NaN;
					if (t)
						if (this.isHorizontal()) {
							if (void 0 !== t.x) return this.getRightValue(t.x)
						} else if (void 0 !== t.y) return this.getRightValue(t.y);
					return t
				},
				getLabelForIndex: B.noop,
				getPixelForValue: B.noop,
				getValueForPixel: B.noop,
				getPixelForTick: function (t) {
					var e = this,
						n = e.options.offset;
					if (e.isHorizontal()) {
						var i = (e.width - (e.paddingLeft + e.paddingRight)) / Math.max(e._ticks.length - (n ? 0 : 1), 1),
							a = i * t + e.paddingLeft;
						n && (a += i / 2);
						var r = e.left + Math.round(a);
						return r += e.isFullWidth() ? e.margins.left : 0
					}
					var o = e.height - (e.paddingTop + e.paddingBottom);
					return e.top + t * (o / (e._ticks.length - 1))
				},
				getPixelForDecimal: function (t) {
					var e = this;
					if (e.isHorizontal()) {
						var n = (e.width - (e.paddingLeft + e.paddingRight)) * t + e.paddingLeft,
							i = e.left + Math.round(n);
						return i += e.isFullWidth() ? e.margins.left : 0
					}
					return e.top + t * e.height
				},
				getBasePixel: function () {
					return this.getPixelForValue(this.getBaseValue())
				},
				getBaseValue: function () {
					var t = this.min,
						e = this.max;
					return this.beginAtZero ? 0 : t < 0 && e < 0 ? e : 0 < t && 0 < e ? t : 0
				},
				_autoSkip: function (t) {
					var e, n, i, a, r = this,
						o = r.isHorizontal(),
						s = r.options.ticks.minor,
						l = t.length,
						u = B.toRadians(r.labelRotation),
						d = Math.cos(u),
						h = r.longestLabelWidth * d,
						c = [];
					for (s.maxTicksLimit && (a = s.maxTicksLimit), o && (e = !1, (h + s.autoSkipPadding) * l > r.width - (r.paddingLeft + r.paddingRight) && (e = 1 + Math.floor((h + s.autoSkipPadding) * l / (r.width - (r.paddingLeft + r.paddingRight)))), a && a < l && (e = Math.max(e, Math.floor(l / a)))), n = 0; n < l; n++) i = t[n], (1 < e && 0 < n % e || n % e == 0 && l <= n + e) && n !== l - 1 && delete i.label, c.push(i);
					return c
				},
				draw: function (S) {
					var D = this,
						C = D.options;
					if (C.display) {
						var o = D.ctx,
							P = x.global,
							T = C.ticks.minor,
							t = C.ticks.major || T,
							O = C.gridLines,
							e = C.scaleLabel,
							I = 0 !== D.labelRotation,
							A = D.isHorizontal(),
							F = T.autoSkip ? D._autoSkip(D.getTicks()) : D.getTicks(),
							s = B.valueOrDefault(T.fontColor, P.defaultFontColor),
							l = w(T),
							u = B.valueOrDefault(t.fontColor, P.defaultFontColor),
							d = w(t),
							R = O.drawTicks ? O.tickMarkLength : 0,
							n = B.valueOrDefault(e.fontColor, P.defaultFontColor),
							i = w(e),
							a = B.options.toPadding(e.padding),
							L = B.toRadians(D.labelRotation),
							Y = [],
							W = D.options.gridLines.lineWidth,
							N = "right" === C.position ? D.left : D.right - W - R,
							z = "right" === C.position ? D.left + R : D.right,
							V = "bottom" === C.position ? D.top + W : D.bottom - R - W,
							H = "bottom" === C.position ? D.top + W + R : D.bottom + W;
						if (B.each(F, function (t, e) {
							if (!B.isNullOrUndef(t.label)) {
								var n, i, a, r, o, s, l, u, d, h, c, f, g, m, p = t.label;
								r = e === D.zeroLineIndex && C.offset === O.offsetGridLines ? (n = O.zeroLineWidth, i = O.zeroLineColor, a = O.zeroLineBorderDash, O.zeroLineBorderDashOffset) : (n = B.valueAtIndexOrDefault(O.lineWidth, e), i = B.valueAtIndexOrDefault(O.color, e), a = B.valueOrDefault(O.borderDash, P.borderDash), B.valueOrDefault(O.borderDashOffset, P.borderDashOffset));
								var v = "middle",
									b = "middle",
									y = T.padding;
								if (A) {
									var x = R + y;
									m = "bottom" === C.position ? (b = I ? "middle" : "top", v = I ? "right" : "center", D.top + x) : (b = I ? "middle" : "bottom", v = I ? "left" : "center", D.bottom - x);
									var _ = E(D, e, O.offsetGridLines && 1 < F.length);
									_ < D.left && (i = "rgba(0,0,0,0)"), _ += B.aliasPixel(n), g = D.getPixelForTick(e) + T.labelOffset, o = l = d = c = _, s = V, u = H, h = S.top, f = S.bottom + W
								} else {
									var k, w = "left" === C.position;
									k = T.mirror ? (v = w ? "left" : "right", y) : (v = w ? "right" : "left", R + y), g = w ? D.right - k : D.left + k;
									var M = E(D, e, O.offsetGridLines && 1 < F.length);
									M < D.top && (i = "rgba(0,0,0,0)"), M += B.aliasPixel(n), m = D.getPixelForTick(e) + T.labelOffset, o = N, l = z, d = S.left, c = S.right + W, s = u = h = f = M
								}
								Y.push({
									tx1: o,
									ty1: s,
									tx2: l,
									ty2: u,
									x1: d,
									y1: h,
									x2: c,
									y2: f,
									labelX: g,
									labelY: m,
									glWidth: n,
									glColor: i,
									glBorderDash: a,
									glBorderDashOffset: r,
									rotation: -1 * L,
									label: p,
									major: t.major,
									textBaseline: b,
									textAlign: v
								})
							}
						}), B.each(Y, function (t) {
							if (O.display && (o.save(), o.lineWidth = t.glWidth, o.strokeStyle = t.glColor, o.setLineDash && (o.setLineDash(t.glBorderDash), o.lineDashOffset = t.glBorderDashOffset), o.beginPath(), O.drawTicks && (o.moveTo(t.tx1, t.ty1), o.lineTo(t.tx2, t.ty2)), O.drawOnChartArea && (o.moveTo(t.x1, t.y1), o.lineTo(t.x2, t.y2)), o.stroke(), o.restore()), T.display) {
								o.save(), o.translate(t.labelX, t.labelY), o.rotate(t.rotation), o.font = t.major ? d.font : l.font, o.fillStyle = t.major ? u : s, o.textBaseline = t.textBaseline, o.textAlign = t.textAlign;
								var e = t.label;
								if (B.isArray(e))
									for (var n = e.length, i = 1.5 * l.size, a = D.isHorizontal() ? 0 : -i * (n - 1) / 2, r = 0; r < n; ++r) o.fillText("" + e[r], 0, a), a += i;
								else o.fillText(e, 0, 0);
								o.restore()
							}
						}), e.display) {
							var r, h, c = 0,
								f = M(e) / 2;
							if (A) r = D.left + (D.right - D.left) / 2, h = "bottom" === C.position ? D.bottom - f - a.bottom : D.top + f + a.top;
							else {
								var g = "left" === C.position;
								r = g ? D.left + f + a.top : D.right - f - a.top, h = D.top + (D.bottom - D.top) / 2, c = g ? -.5 * Math.PI : .5 * Math.PI
							}
							o.save(), o.translate(r, h), o.rotate(c), o.textAlign = "center", o.textBaseline = "middle", o.fillStyle = n, o.font = i.font, o.fillText(e.labelString, 0, 0), o.restore()
						}
						if (O.drawBorder) {
							o.lineWidth = B.valueAtIndexOrDefault(O.lineWidth, 0), o.strokeStyle = B.valueAtIndexOrDefault(O.color, 0);
							var m = D.left,
								p = D.right + W,
								v = D.top,
								b = D.bottom + W,
								y = B.aliasPixel(o.lineWidth);
							A ? (v = b = "top" === C.position ? D.bottom : D.top, v += y, b += y) : (m = p = "left" === C.position ? D.right : D.left, m += y, p += y), o.beginPath(), o.moveTo(m, v), o.lineTo(p, b), o.stroke()
						}
					}
				}
			})
		}, {
			26: 26,
			27: 27,
			35: 35,
			46: 46
		}],
		34: [function (t, e, n) {
			"use strict";
			var i = t(26),
				a = t(46),
				r = t(31);
			e.exports = {
				constructors: {},
				defaults: {},
				registerScaleType: function (t, e, n) {
					this.constructors[t] = e, this.defaults[t] = a.clone(n)
				},
				getScaleConstructor: function (t) {
					return this.constructors.hasOwnProperty(t) ? this.constructors[t] : void 0
				},
				getScaleDefaults: function (t) {
					return this.defaults.hasOwnProperty(t) ? a.merge({}, [i.scale, this.defaults[t]]) : {}
				},
				updateScaleDefaults: function (t, e) {
					this.defaults.hasOwnProperty(t) && (this.defaults[t] = a.extend(this.defaults[t], e))
				},
				addScalesToLayout: function (e) {
					a.each(e.scales, function (t) {
						t.fullWidth = t.options.fullWidth, t.position = t.options.position, t.weight = t.options.weight, r.addBox(e, t)
					})
				}
			}
		}, {
			26: 26,
			31: 31,
			46: 46
		}],
		35: [function (t, e, n) {
			"use strict";
			var l = t(46);
			e.exports = {
				formatters: {
					values: function (t) {
						return l.isArray(t) ? t : "" + t
					},
					linear: function (t, e, n) {
						var i = 3 < n.length ? n[2] - n[1] : n[1] - n[0];
						1 < Math.abs(i) && t !== Math.floor(t) && (i = t - Math.floor(t));
						var a = l.log10(Math.abs(i)),
							r = "";
						if (0 !== t)
							if (Math.max(Math.abs(n[0]), Math.abs(n[n.length - 1])) < 1e-4) {
								var o = l.log10(Math.abs(t));
								r = t.toExponential(Math.floor(o) - Math.floor(a))
							} else {
								var s = -1 * Math.floor(a);
								s = Math.max(Math.min(s, 20), 0), r = t.toFixed(s)
							}
						else r = "0";
						return r
					},
					logarithmic: function (t, e, n) {
						var i = t / Math.pow(10, Math.floor(l.log10(t)));
						return 0 === t ? "0" : 1 === i || 2 === i || 5 === i || 0 === e || e === n.length - 1 ? t.toExponential() : ""
					}
				}
			}
		}, {
			46: 46
		}],
		36: [function (t, e, n) {
			"use strict";
			var i = t(26),
				a = t(27),
				R = t(46);
			i._set("global", {
				tooltips: {
					enabled: !0,
					custom: null,
					mode: "nearest",
					position: "average",
					intersect: !0,
					backgroundColor: "#000",
					titleFontStyle: "bold",
					titleSpacing: 2,
					titleMarginBottom: 6,
					titleFontColor: "#fff",
					titleAlign: "left",
					bodySpacing: 2,
					bodyFontColor: "#fff",
					bodyAlign: "left",
					footerFontStyle: "bold",
					footerSpacing: 2,
					footerMarginTop: 6,
					footerFontColor: "#fff",
					footerAlign: "left",
					yPadding: 6,
					xPadding: 6,
					caretPadding: 2,
					caretSize: 5,
					cornerRadius: 6,
					multiKeyBackground: "#fff",
					displayColors: !0,
					borderColor: "#e3e7ed",
					borderWidth: 0,
					callbacks: {
						beforeTitle: R.noop,
						title: function (t, e) {
							var n = "",
								i = e.labels,
								a = i ? i.length : 0;
							if (0 < t.length) {
								var r = t[0];
								r.xLabel ? n = r.xLabel : 0 < a && r.index < a && (n = i[r.index])
							}
							return n
						},
						afterTitle: R.noop,
						beforeBody: R.noop,
						beforeLabel: R.noop,
						label: function (t, e) {
							var n = e.datasets[t.datasetIndex].label || "";
							return n && (n += ": "), n += t.yLabel
						},
						labelColor: function (t, e) {
							var n = e.getDatasetMeta(t.datasetIndex).data[t.index]._view;
							return {
								borderColor: n.borderColor,
								backgroundColor: n.backgroundColor
							}
						},
						labelTextColor: function () {
							return this._options.bodyFontColor
						},
						afterLabel: R.noop,
						afterBody: R.noop,
						beforeFooter: R.noop,
						footer: R.noop,
						afterFooter: R.noop
					}
				}
			});
			var L = {
				average: function (t) {
					if (!t.length) return !1;
					var e, n, i = 0,
						a = 0,
						r = 0;
					for (e = 0, n = t.length; e < n; ++e) {
						var o = t[e];
						if (o && o.hasValue()) {
							var s = o.tooltipPosition();
							i += s.x, a += s.y, ++r
						}
					}
					return {
						x: Math.round(i / r),
						y: Math.round(a / r)
					}
				},
				nearest: function (t, e) {
					var n, i, a, r = e.x,
						o = e.y,
						s = Number.POSITIVE_INFINITY;
					for (n = 0, i = t.length; n < i; ++n) {
						var l = t[n];
						if (l && l.hasValue()) {
							var u = l.getCenterPoint(),
								d = R.distanceBetweenPoints(e, u);
							d < s && (s = d, a = l)
						}
					}
					if (a) {
						var h = a.tooltipPosition();
						r = h.x, o = h.y
					}
					return {
						x: r,
						y: o
					}
				}
			};

			function c(t, e) {
				var n = R.color(t);
				return n.alpha(e * n.alpha()).rgbaString()
			}

			function o(t, e) {
				return e && (R.isArray(e) ? Array.prototype.push.apply(t, e) : t.push(e)), t
			}

			function s(t) {
				return ("string" == typeof t || t instanceof String) && -1 < t.indexOf("\n") ? t.split("\n") : t
			}

			function Y(t) {
				var e = i.global,
					n = R.valueOrDefault;
				return {
					xPadding: t.xPadding,
					yPadding: t.yPadding,
					xAlign: t.xAlign,
					yAlign: t.yAlign,
					bodyFontColor: t.bodyFontColor,
					_bodyFontFamily: n(t.bodyFontFamily, e.defaultFontFamily),
					_bodyFontStyle: n(t.bodyFontStyle, e.defaultFontStyle),
					_bodyAlign: t.bodyAlign,
					bodyFontSize: n(t.bodyFontSize, e.defaultFontSize),
					bodySpacing: t.bodySpacing,
					titleFontColor: t.titleFontColor,
					_titleFontFamily: n(t.titleFontFamily, e.defaultFontFamily),
					_titleFontStyle: n(t.titleFontStyle, e.defaultFontStyle),
					titleFontSize: n(t.titleFontSize, e.defaultFontSize),
					_titleAlign: t.titleAlign,
					titleSpacing: t.titleSpacing,
					titleMarginBottom: t.titleMarginBottom,
					footerFontColor: t.footerFontColor,
					_footerFontFamily: n(t.footerFontFamily, e.defaultFontFamily),
					_footerFontStyle: n(t.footerFontStyle, e.defaultFontStyle),
					footerFontSize: n(t.footerFontSize, e.defaultFontSize),
					_footerAlign: t.footerAlign,
					footerSpacing: t.footerSpacing,
					footerMarginTop: t.footerMarginTop,
					caretSize: t.caretSize,
					cornerRadius: t.cornerRadius,
					backgroundColor: t.backgroundColor,
					opacity: 0,
					legendColorBackground: t.multiKeyBackground,
					displayColors: t.displayColors,
					borderColor: t.borderColor,
					borderWidth: t.borderWidth
				}
			}

			function r(t) {
				return o([], s(t))
			} (e.exports = a.extend({
				initialize: function () {
					this._model = Y(this._options), this._lastActive = []
				},
				getTitle: function () {
					var t = this._options.callbacks,
						e = t.beforeTitle.apply(this, arguments),
						n = t.title.apply(this, arguments),
						i = t.afterTitle.apply(this, arguments),
						a = [];
					return a = o(a = o(a = o(a, s(e)), s(n)), s(i))
				},
				getBeforeBody: function () {
					return r(this._options.callbacks.beforeBody.apply(this, arguments))
				},
				getBody: function (t, n) {
					var i = this,
						a = i._options.callbacks,
						r = [];
					return R.each(t, function (t) {
						var e = {
							before: [],
							lines: [],
							after: []
						};
						o(e.before, s(a.beforeLabel.call(i, t, n))), o(e.lines, a.label.call(i, t, n)), o(e.after, s(a.afterLabel.call(i, t, n))), r.push(e)
					}), r
				},
				getAfterBody: function () {
					return r(this._options.callbacks.afterBody.apply(this, arguments))
				},
				getFooter: function () {
					var t = this._options.callbacks,
						e = t.beforeFooter.apply(this, arguments),
						n = t.footer.apply(this, arguments),
						i = t.afterFooter.apply(this, arguments),
						a = [];
					return a = o(a = o(a = o(a, s(e)), s(n)), s(i))
				},
				update: function (t) {
					var e, n, i, a, r, o, s, l, u, d, h, c, f, g, m, p, v, b, y, x, _ = this,
						k = _._options,
						w = _._model,
						M = _._model = Y(k),
						S = _._active,
						D = _._data,
						C = {
							xAlign: w.xAlign,
							yAlign: w.yAlign
						},
						P = {
							x: w.x,
							y: w.y
						},
						T = {
							width: w.width,
							height: w.height
						},
						O = {
							x: w.caretX,
							y: w.caretY
						};
					if (S.length) {
						M.opacity = 1;
						var I = [],
							A = [];
						O = L[k.position].call(_, S, _._eventPosition);
						var F = [];
						for (e = 0, n = S.length; e < n; ++e) F.push((p = S[e], b = v = void 0, v = p._xScale, b = p._yScale || p._scale, y = p._index, x = p._datasetIndex, {
							xLabel: v ? v.getLabelForIndex(y, x) : "",
							yLabel: b ? b.getLabelForIndex(y, x) : "",
							index: y,
							datasetIndex: x,
							x: p._model.x,
							y: p._model.y
						}));
						k.filter && (F = F.filter(function (t) {
							return k.filter(t, D)
						})), k.itemSort && (F = F.sort(function (t, e) {
							return k.itemSort(t, e, D)
						})), R.each(F, function (t) {
							I.push(k.callbacks.labelColor.call(_, t, _._chart)), A.push(k.callbacks.labelTextColor.call(_, t, _._chart))
						}), M.title = _.getTitle(F, D), M.beforeBody = _.getBeforeBody(F, D), M.body = _.getBody(F, D), M.afterBody = _.getAfterBody(F, D), M.footer = _.getFooter(F, D), M.x = Math.round(O.x), M.y = Math.round(O.y), M.caretPadding = k.caretPadding, M.labelColors = I, M.labelTextColors = A, M.dataPoints = F, C = function (t, e) {
							var n, i, a, r, o, s = t._model,
								l = t._chart,
								u = t._chart.chartArea,
								d = "center",
								h = "center";
							s.y < e.height ? h = "top" : s.y > l.height - e.height && (h = "bottom");
							var c = (u.left + u.right) / 2,
								f = (u.top + u.bottom) / 2;
							i = "center" === h ? (n = function (t) {
								return t <= c
							}, function (t) {
								return c < t
							}) : (n = function (t) {
								return t <= e.width / 2
							}, function (t) {
								return t >= l.width - e.width / 2
							}), a = function (t) {
								return t + e.width + s.caretSize + s.caretPadding > l.width
							}, r = function (t) {
								return t - e.width - s.caretSize - s.caretPadding < 0
							}, o = function (t) {
								return t <= f ? "top" : "bottom"
							}, n(s.x) ? (d = "left", a(s.x) && (d = "center", h = o(s.y))) : i(s.x) && (d = "right", r(s.x) && (d = "center", h = o(s.y)));
							var g = t._options;
							return {
								xAlign: g.xAlign ? g.xAlign : d,
								yAlign: g.yAlign ? g.yAlign : h
							}
						}(this, T = function (t, e) {
							var n = t._chart.ctx,
								i = 2 * e.yPadding,
								a = 0,
								r = e.body,
								o = r.reduce(function (t, e) {
									return t + e.before.length + e.lines.length + e.after.length
								}, 0);
							o += e.beforeBody.length + e.afterBody.length;
							var s = e.title.length,
								l = e.footer.length,
								u = e.titleFontSize,
								d = e.bodyFontSize,
								h = e.footerFontSize;
							i += s * u, i += s ? (s - 1) * e.titleSpacing : 0, i += s ? e.titleMarginBottom : 0, i += o * d, i += o ? (o - 1) * e.bodySpacing : 0, i += l ? e.footerMarginTop : 0, i += l * h, i += l ? (l - 1) * e.footerSpacing : 0;
							var c = 0,
								f = function (t) {
									a = Math.max(a, n.measureText(t).width + c)
								};
							return n.font = R.fontString(u, e._titleFontStyle, e._titleFontFamily), R.each(e.title, f), n.font = R.fontString(d, e._bodyFontStyle, e._bodyFontFamily), R.each(e.beforeBody.concat(e.afterBody), f), c = e.displayColors ? d + 2 : 0, R.each(r, function (t) {
								R.each(t.before, f), R.each(t.lines, f), R.each(t.after, f)
							}), c = 0, n.font = R.fontString(h, e._footerFontStyle, e._footerFontFamily), R.each(e.footer, f), {
								width: a += 2 * e.xPadding,
								height: i
							}
						}(this, M)), i = M, a = T, r = C, o = _._chart, s = i.x, l = i.y, u = i.caretSize, d = i.caretPadding, h = i.cornerRadius, c = r.xAlign, f = r.yAlign, g = u + d, m = h + d, "right" === c ? s -= a.width : "center" === c && ((s -= a.width / 2) + a.width > o.width && (s = o.width - a.width), s < 0 && (s = 0)), "top" === f ? l += g : l -= "bottom" === f ? a.height + g : a.height / 2, "center" === f ? "left" === c ? s += g : "right" === c && (s -= g) : "left" === c ? s -= m : "right" === c && (s += m), P = {
							x: s,
							y: l
						}
					} else M.opacity = 0;
					return M.xAlign = C.xAlign, M.yAlign = C.yAlign, M.x = P.x, M.y = P.y, M.width = T.width, M.height = T.height, M.caretX = O.x, M.caretY = O.y, _._model = M, t && k.custom && k.custom.call(_, M), _
				},
				drawCaret: function (t, e) {
					var n = this._chart.ctx,
						i = this._view,
						a = this.getCaretPosition(t, e, i);
					n.lineTo(a.x1, a.y1), n.lineTo(a.x2, a.y2), n.lineTo(a.x3, a.y3)
				},
				getCaretPosition: function (t, e, n) {
					var i, a, r, o, s, l, u = n.caretSize,
						d = n.cornerRadius,
						h = n.xAlign,
						c = n.yAlign,
						f = t.x,
						g = t.y,
						m = e.width,
						p = e.height;
					if ("center" === c) s = g + p / 2, l = "left" === h ? (a = (i = f) - u, r = i, o = s + u, s - u) : (a = (i = f + m) + u, r = i, o = s - u, s + u);
					else if (r = (i = "left" === h ? (a = f + d + u) - u : "right" === h ? (a = f + m - d - u) - u : (a = n.caretX) - u, a + u), "top" === c) s = (o = g) - u, l = o;
					else {
						s = (o = g + p) + u, l = o;
						var v = r;
						r = i, i = v
					}
					return {
						x1: i,
						x2: a,
						x3: r,
						y1: o,
						y2: s,
						y3: l
					}
				},
				drawTitle: function (t, e, n, i) {
					var a = e.title;
					if (a.length) {
						n.textAlign = e._titleAlign, n.textBaseline = "top";
						var r, o, s = e.titleFontSize,
							l = e.titleSpacing;
						for (n.fillStyle = c(e.titleFontColor, i), n.font = R.fontString(s, e._titleFontStyle, e._titleFontFamily), r = 0, o = a.length; r < o; ++r) n.fillText(a[r], t.x, t.y), t.y += s + l, r + 1 === a.length && (t.y += e.titleMarginBottom - l)
					}
				},
				drawBody: function (i, a, r, o) {
					var s = a.bodyFontSize,
						e = a.bodySpacing,
						t = a.body;
					r.textAlign = a._bodyAlign, r.textBaseline = "top", r.font = R.fontString(s, a._bodyFontStyle, a._bodyFontFamily);
					var n = 0,
						l = function (t) {
							r.fillText(t, i.x + n, i.y), i.y += s + e
						};
					r.fillStyle = c(a.bodyFontColor, o), R.each(a.beforeBody, l);
					var u = a.displayColors;
					n = u ? s + 2 : 0, R.each(t, function (t, e) {
						var n = c(a.labelTextColors[e], o);
						r.fillStyle = n, R.each(t.before, l), R.each(t.lines, function (t) {
							u && (r.fillStyle = c(a.legendColorBackground, o), r.fillRect(i.x, i.y, s, s), r.lineWidth = 1, r.strokeStyle = c(a.labelColors[e].borderColor, o), r.strokeRect(i.x, i.y, s, s), r.fillStyle = c(a.labelColors[e].backgroundColor, o), r.fillRect(i.x + 1, i.y + 1, s - 2, s - 2), r.fillStyle = n), l(t)
						}), R.each(t.after, l)
					}), n = 0, R.each(a.afterBody, l), i.y -= e
				},
				drawFooter: function (e, n, i, t) {
					var a = n.footer;
					a.length && (e.y += n.footerMarginTop, i.textAlign = n._footerAlign, i.textBaseline = "top", i.fillStyle = c(n.footerFontColor, t), i.font = R.fontString(n.footerFontSize, n._footerFontStyle, n._footerFontFamily), R.each(a, function (t) {
						i.fillText(t, e.x, e.y), e.y += n.footerFontSize + n.footerSpacing
					}))
				},
				drawBackground: function (t, e, n, i, a) {
					n.fillStyle = c(e.backgroundColor, a), n.strokeStyle = c(e.borderColor, a), n.lineWidth = e.borderWidth;
					var r = e.xAlign,
						o = e.yAlign,
						s = t.x,
						l = t.y,
						u = i.width,
						d = i.height,
						h = e.cornerRadius;
					n.beginPath(), n.moveTo(s + h, l), "top" === o && this.drawCaret(t, i), n.lineTo(s + u - h, l), n.quadraticCurveTo(s + u, l, s + u, l + h), "center" === o && "right" === r && this.drawCaret(t, i), n.lineTo(s + u, l + d - h), n.quadraticCurveTo(s + u, l + d, s + u - h, l + d), "bottom" === o && this.drawCaret(t, i), n.lineTo(s + h, l + d), n.quadraticCurveTo(s, l + d, s, l + d - h), "center" === o && "left" === r && this.drawCaret(t, i), n.lineTo(s, l + h), n.quadraticCurveTo(s, l, s + h, l), n.closePath(), n.fill(), 0 < e.borderWidth && n.stroke()
				},
				draw: function () {
					var t = this._chart.ctx,
						e = this._view;
					if (0 !== e.opacity) {
						var n = {
							width: e.width,
							height: e.height
						},
							i = {
								x: e.x,
								y: e.y
							},
							a = Math.abs(e.opacity < .001) ? 0 : e.opacity,
							r = e.title.length || e.beforeBody.length || e.body.length || e.afterBody.length || e.footer.length;
						this._options.enabled && r && (this.drawBackground(i, e, t, n, a), i.x += e.xPadding, i.y += e.yPadding, this.drawTitle(i, e, t, a), this.drawBody(i, e, t, a), this.drawFooter(i, e, t, a))
					}
				},
				handleEvent: function (t) {
					var e, n = this,
						i = n._options;
					return n._lastActive = n._lastActive || [], "mouseout" === t.type ? n._active = [] : n._active = n._chart.getElementsAtEventForMode(t, i.mode, i), (e = !R.arrayEquals(n._active, n._lastActive)) && (n._lastActive = n._active, (i.enabled || i.custom) && (n._eventPosition = {
						x: t.x,
						y: t.y
					}, n.update(!0), n.pivot())), e
				}
			})).positioners = L
		}, {
			26: 26,
			27: 27,
			46: 46
		}],
		37: [function (t, e, n) {
			"use strict";
			var i = t(26),
				a = t(27),
				d = t(46);
			i._set("global", {
				elements: {
					arc: {
						backgroundColor: i.global.defaultColor,
						borderColor: "#fff",
						borderWidth: 2
					}
				}
			}), e.exports = a.extend({
				inLabelRange: function (t) {
					var e = this._view;
					return !!e && Math.pow(t - e.x, 2) < Math.pow(e.radius + e.hoverRadius, 2)
				},
				inRange: function (t, e) {
					var n = this._view;
					if (n) {
						for (var i = d.getAngleFromPoint(n, {
							x: t,
							y: e
						}), a = i.angle, r = i.distance, o = n.startAngle, s = n.endAngle; s < o;) s += 2 * Math.PI;
						for (; s < a;) a -= 2 * Math.PI;
						for (; a < o;) a += 2 * Math.PI;
						var l = o <= a && a <= s,
							u = r >= n.innerRadius && r <= n.outerRadius;
						return l && u
					}
					return !1
				},
				getCenterPoint: function () {
					var t = this._view,
						e = (t.startAngle + t.endAngle) / 2,
						n = (t.innerRadius + t.outerRadius) / 2;
					return {
						x: t.x + Math.cos(e) * n,
						y: t.y + Math.sin(e) * n
					}
				},
				getArea: function () {
					var t = this._view;
					return Math.PI * ((t.endAngle - t.startAngle) / (2 * Math.PI)) * (Math.pow(t.outerRadius, 2) - Math.pow(t.innerRadius, 2))
				},
				tooltipPosition: function () {
					var t = this._view,
						e = t.startAngle + (t.endAngle - t.startAngle) / 2,
						n = (t.outerRadius - t.innerRadius) / 2 + t.innerRadius;
					return {
						x: t.x + Math.cos(e) * n,
						y: t.y + Math.sin(e) * n
					}
				},
				draw: function () {
					var t = this._chart.ctx,
						e = this._view,
						n = e.startAngle,
						i = e.endAngle;
					t.beginPath(), t.arc(e.x, e.y, e.outerRadius, n, i), t.arc(e.x, e.y, e.innerRadius, i, n, !0), t.closePath(), t.strokeStyle = e.borderColor, t.lineWidth = e.borderWidth, t.fillStyle = e.backgroundColor, t.fill(), t.lineJoin = "bevel", e.borderWidth && t.stroke()
				}
			})
		}, {
			26: 26,
			27: 27,
			46: 46
		}],
		38: [function (t, e, n) {
			"use strict";
			var i = t(26),
				a = t(27),
				d = t(46),
				h = i.global;
			i._set("global", {
				elements: {
					line: {
						tension: .4,
						backgroundColor: h.defaultColor,
						borderWidth: 3,
						borderColor: h.defaultColor,
						borderCapStyle: "butt",
						borderDash: [],
						borderDashOffset: 0,
						borderJoinStyle: "miter",
						capBezierPoints: !0,
						fill: !0
					}
				}
			}), e.exports = a.extend({
				draw: function () {
					var t, e, n, i, a = this._view,
						r = this._chart.ctx,
						o = a.spanGaps,
						s = this._children.slice(),
						l = h.elements.line,
						u = -1;
					for (this._loop && s.length && s.push(s[0]), r.save(), r.lineCap = a.borderCapStyle || l.borderCapStyle, r.setLineDash && r.setLineDash(a.borderDash || l.borderDash), r.lineDashOffset = a.borderDashOffset || l.borderDashOffset, r.lineJoin = a.borderJoinStyle || l.borderJoinStyle, r.lineWidth = a.borderWidth || l.borderWidth, r.strokeStyle = a.borderColor || h.defaultColor, r.beginPath(), u = -1, t = 0; t < s.length; ++t) e = s[t], n = d.previousItem(s, t), i = e._view, 0 === t ? i.skip || (r.moveTo(i.x, i.y), u = t) : (n = -1 === u ? n : s[u], i.skip || (u !== t - 1 && !o || -1 === u ? r.moveTo(i.x, i.y) : d.canvas.lineTo(r, n._view, e._view), u = t));
					r.stroke(), r.restore()
				}
			})
		}, {
			26: 26,
			27: 27,
			46: 46
		}],
		39: [function (t, e, n) {
			"use strict";
			var u = t(26),
				i = t(27),
				d = t(46),
				h = u.global.defaultColor;

			function a(t) {
				var e = this._view;
				return !!e && Math.abs(t - e.x) < e.radius + e.hitRadius
			}
			u._set("global", {
				elements: {
					point: {
						radius: 3,
						pointStyle: "circle",
						backgroundColor: h,
						borderColor: h,
						borderWidth: 1,
						hitRadius: 1,
						hoverRadius: 4,
						hoverBorderWidth: 1
					}
				}
			}), e.exports = i.extend({
				inRange: function (t, e) {
					var n = this._view;
					return !!n && Math.pow(t - n.x, 2) + Math.pow(e - n.y, 2) < Math.pow(n.hitRadius + n.radius, 2)
				},
				inLabelRange: a,
				inXRange: a,
				inYRange: function (t) {
					var e = this._view;
					return !!e && Math.abs(t - e.y) < e.radius + e.hitRadius
				},
				getCenterPoint: function () {
					var t = this._view;
					return {
						x: t.x,
						y: t.y
					}
				},
				getArea: function () {
					return Math.PI * Math.pow(this._view.radius, 2)
				},
				tooltipPosition: function () {
					var t = this._view;
					return {
						x: t.x,
						y: t.y,
						padding: t.radius + t.borderWidth
					}
				},
				draw: function (t) {
					var e = this._view,
						n = this._model,
						i = this._chart.ctx,
						a = e.pointStyle,
						r = e.rotation,
						o = e.radius,
						s = e.x,
						l = e.y;
					e.skip || (void 0 === t || n.x >= t.left && 1.01 * t.right >= n.x && n.y >= t.top && 1.01 * t.bottom >= n.y) && (i.strokeStyle = e.borderColor || h, i.lineWidth = d.valueOrDefault(e.borderWidth, u.global.elements.point.borderWidth), i.fillStyle = e.backgroundColor || h, d.canvas.drawPoint(i, a, o, s, l, r))
				}
			})
		}, {
			26: 26,
			27: 27,
			46: 46
		}],
		40: [function (t, e, n) {
			"use strict";
			var i = t(26),
				a = t(27);

			function l(t) {
				return void 0 !== t._view.width
			}

			function r(t) {
				var e, n, i, a, r = t._view;
				if (l(t)) {
					var o = r.width / 2;
					e = r.x - o, n = r.x + o, i = Math.min(r.y, r.base), a = Math.max(r.y, r.base)
				} else {
					var s = r.height / 2;
					e = Math.min(r.x, r.base), n = Math.max(r.x, r.base), i = r.y - s, a = r.y + s
				}
				return {
					left: e,
					top: i,
					right: n,
					bottom: a
				}
			}
			i._set("global", {
				elements: {
					rectangle: {
						backgroundColor: i.global.defaultColor,
						borderColor: i.global.defaultColor,
						borderSkipped: "bottom",
						borderWidth: 0
					}
				}
			}), e.exports = a.extend({
				draw: function () {
					var t, e, n, i, a, r, o, s = this._chart.ctx,
						l = this._view,
						u = l.borderWidth;
					if (o = l.horizontal ? (t = l.base, e = l.x, n = l.y - l.height / 2, i = l.y + l.height / 2, a = t < e ? 1 : -1, r = 1, l.borderSkipped || "left") : (t = l.x - l.width / 2, e = l.x + l.width / 2, a = 1, r = (n = l.y) < (i = l.base) ? 1 : -1, l.borderSkipped || "bottom"), u) {
						var d = Math.min(Math.abs(t - e), Math.abs(n - i)),
							h = (u = d < u ? d : u) / 2,
							c = t + ("left" !== o ? h * a : 0),
							f = e + ("right" !== o ? -h * a : 0),
							g = n + ("top" !== o ? h * r : 0),
							m = i + ("bottom" !== o ? -h * r : 0);
						c !== f && (n = g, i = m), g !== m && (t = c, e = f)
					}
					s.beginPath(), s.fillStyle = l.backgroundColor, s.strokeStyle = l.borderColor, s.lineWidth = u;
					var p = [
						[t, i],
						[t, n],
						[e, n],
						[e, i]
					],
						v = ["bottom", "left", "top", "right"].indexOf(o, 0);

					function b(t) {
						return p[(v + t) % 4]
					} - 1 === v && (v = 0);
					var y = b(0);
					s.moveTo(y[0], y[1]);
					for (var x = 1; x < 4; x++) y = b(x), s.lineTo(y[0], y[1]);
					s.fill(), u && s.stroke()
				},
				height: function () {
					var t = this._view;
					return t.base - t.y
				},
				inRange: function (t, e) {
					var n = !1;
					if (this._view) {
						var i = r(this);
						n = t >= i.left && t <= i.right && e >= i.top && e <= i.bottom
					}
					return n
				},
				inLabelRange: function (t, e) {
					if (!this._view) return !1;
					var n = r(this);
					return l(this) ? t >= n.left && t <= n.right : e >= n.top && e <= n.bottom
				},
				inXRange: function (t) {
					var e = r(this);
					return t >= e.left && t <= e.right
				},
				inYRange: function (t) {
					var e = r(this);
					return t >= e.top && t <= e.bottom
				},
				getCenterPoint: function () {
					var t, e, n = this._view;
					return e = l(this) ? (t = n.x, (n.y + n.base) / 2) : (t = (n.x + n.base) / 2, n.y), {
						x: t,
						y: e
					}
				},
				getArea: function () {
					var t = this._view;
					return t.width * Math.abs(t.y - t.base)
				},
				tooltipPosition: function () {
					var t = this._view;
					return {
						x: t.x,
						y: t.y
					}
				}
			})
		}, {
			26: 26,
			27: 27
		}],
		41: [function (t, e, n) {
			"use strict";
			e.exports = {}, e.exports.Arc = t(37), e.exports.Line = t(38), e.exports.Point = t(39), e.exports.Rectangle = t(40)
		}, {
			37: 37,
			38: 38,
			39: 39,
			40: 40
		}],
		42: [function (t, e, n) {
			"use strict";
			var i = t(43);
			n = e.exports = {
				clear: function (t) {
					t.ctx.clearRect(0, 0, t.width, t.height)
				},
				roundedRect: function (t, e, n, i, a, r) {
					if (r) {
						var o = Math.min(r, a / 2 - 1e-7, i / 2 - 1e-7);
						t.moveTo(e + o, n), t.lineTo(e + i - o, n), t.arcTo(e + i, n, e + i, n + o, o), t.lineTo(e + i, n + a - o), t.arcTo(e + i, n + a, e + i - o, n + a, o), t.lineTo(e + o, n + a), t.arcTo(e, n + a, e, n + a - o, o), t.lineTo(e, n + o), t.arcTo(e, n, e + o, n, o), t.closePath(), t.moveTo(e, n)
					} else t.rect(e, n, i, a)
				},
				drawPoint: function (t, e, n, i, a, r) {
					var o, s, l, u, d, h;
					if (r = r || 0, !e || "object" != typeof e || "[object HTMLImageElement]" !== (o = e.toString()) && "[object HTMLCanvasElement]" !== o) {
						if (!(isNaN(n) || n <= 0)) {
							switch (t.save(), t.translate(i, a), t.rotate(r * Math.PI / 180), t.beginPath(), e) {
								default: t.arc(0, 0, n, 0, 2 * Math.PI),
									t.closePath();
									break;
								case "triangle":
									d = (s = 3 * n / Math.sqrt(3)) * Math.sqrt(3) / 2,
										t.moveTo(-s / 2, d / 3),
										t.lineTo(s / 2, d / 3),
										t.lineTo(0, -2 * d / 3),
										t.closePath();
									break;
								case "rect":
									h = 1 / Math.SQRT2 * n,
										t.rect(-h, -h, 2 * h, 2 * h);
									break;
								case "rectRounded":
									var c = n / Math.SQRT2,
										f = -c,
										g = -c,
										m = Math.SQRT2 * n; this.roundedRect(t, f, g, m, m, .425 * n);
									break;
								case "rectRot":
									h = 1 / Math.SQRT2 * n,
										t.moveTo(-h, 0),
										t.lineTo(0, h),
										t.lineTo(h, 0),
										t.lineTo(0, -h),
										t.closePath();
									break;
								case "cross":
									t.moveTo(0, n),
										t.lineTo(0, -n),
										t.moveTo(-n, 0),
										t.lineTo(n, 0);
									break;
								case "crossRot":
									l = Math.cos(Math.PI / 4) * n,
										u = Math.sin(Math.PI / 4) * n,
										t.moveTo(-l, -u),
										t.lineTo(l, u),
										t.moveTo(-l, u),
										t.lineTo(l, -u);
									break;
								case "star":
									t.moveTo(0, n),
										t.lineTo(0, -n),
										t.moveTo(-n, 0),
										t.lineTo(n, 0),
										l = Math.cos(Math.PI / 4) * n,
										u = Math.sin(Math.PI / 4) * n,
										t.moveTo(-l, -u),
										t.lineTo(l, u),
										t.moveTo(-l, u),
										t.lineTo(l, -u);
									break;
								case "line":
									t.moveTo(-n, 0),
										t.lineTo(n, 0);
									break;
								case "dash":
									t.moveTo(0, 0),
										t.lineTo(n, 0)
							}
							t.fill(), t.stroke(), t.restore()
						}
					} else t.drawImage(e, i - e.width / 2, a - e.height / 2, e.width, e.height)
				},
				clipArea: function (t, e) {
					t.save(), t.beginPath(), t.rect(e.left, e.top, e.right - e.left, e.bottom - e.top), t.clip()
				},
				unclipArea: function (t) {
					t.restore()
				},
				lineTo: function (t, e, n, i) {
					if (n.steppedLine) return "after" === n.steppedLine && !i || "after" !== n.steppedLine && i ? t.lineTo(e.x, n.y) : t.lineTo(n.x, e.y), void t.lineTo(n.x, n.y);
					n.tension ? t.bezierCurveTo(i ? e.controlPointPreviousX : e.controlPointNextX, i ? e.controlPointPreviousY : e.controlPointNextY, i ? n.controlPointNextX : n.controlPointPreviousX, i ? n.controlPointNextY : n.controlPointPreviousY, n.x, n.y) : t.lineTo(n.x, n.y)
				}
			};
			i.clear = n.clear, i.drawRoundedRectangle = function (t) {
				t.beginPath(), n.roundedRect.apply(n, arguments)
			}
		}, {
			43: 43
		}],
		43: [function (t, e, n) {
			"use strict";
			var i, d = {
				noop: function () { },
				uid: (i = 0, function () {
					return i++
				}),
				isNullOrUndef: function (t) {
					return null == t
				},
				isArray: Array.isArray ? Array.isArray : function (t) {
					return "[object Array]" === Object.prototype.toString.call(t)
				},
				isObject: function (t) {
					return null !== t && "[object Object]" === Object.prototype.toString.call(t)
				},
				valueOrDefault: function (t, e) {
					return void 0 === t ? e : t
				},
				valueAtIndexOrDefault: function (t, e, n) {
					return d.valueOrDefault(d.isArray(t) ? t[e] : t, n)
				},
				callback: function (t, e, n) {
					if (t && "function" == typeof t.call) return t.apply(n, e)
				},
				each: function (t, e, n, i) {
					var a, r, o;
					if (d.isArray(t))
						if (r = t.length, i)
							for (a = r - 1; 0 <= a; a--) e.call(n, t[a], a);
						else
							for (a = 0; a < r; a++) e.call(n, t[a], a);
					else if (d.isObject(t))
						for (r = (o = Object.keys(t)).length, a = 0; a < r; a++) e.call(n, t[o[a]], o[a])
				},
				arrayEquals: function (t, e) {
					var n, i, a, r;
					if (!t || !e || t.length !== e.length) return !1;
					for (n = 0, i = t.length; n < i; ++n)
						if (a = t[n], r = e[n], a instanceof Array && r instanceof Array) {
							if (!d.arrayEquals(a, r)) return !1
						} else if (a !== r) return !1;
					return !0
				},
				clone: function (t) {
					if (d.isArray(t)) return t.map(d.clone);
					if (d.isObject(t)) {
						for (var e = {}, n = Object.keys(t), i = n.length, a = 0; a < i; ++a) e[n[a]] = d.clone(t[n[a]]);
						return e
					}
					return t
				},
				_merger: function (t, e, n, i) {
					var a = e[t],
						r = n[t];
					d.isObject(a) && d.isObject(r) ? d.merge(a, r, i) : e[t] = d.clone(r)
				},
				_mergerIf: function (t, e, n) {
					var i = e[t],
						a = n[t];
					d.isObject(i) && d.isObject(a) ? d.mergeIf(i, a) : e.hasOwnProperty(t) || (e[t] = d.clone(a))
				},
				merge: function (t, e, n) {
					var i, a, r, o, s, l = d.isArray(e) ? e : [e],
						u = l.length;
					if (!d.isObject(t)) return t;
					for (i = (n = n || {}).merger || d._merger, a = 0; a < u; ++a)
						if (e = l[a], d.isObject(e))
							for (s = 0, o = (r = Object.keys(e)).length; s < o; ++s) i(r[s], t, e, n);
					return t
				},
				mergeIf: function (t, e) {
					return d.merge(t, e, {
						merger: d._mergerIf
					})
				},
				extend: function (n) {
					for (var t = function (t, e) {
						n[e] = t
					}, e = 1, i = arguments.length; e < i; ++e) d.each(arguments[e], t);
					return n
				},
				inherits: function (t) {
					var e = this,
						n = t && t.hasOwnProperty("constructor") ? t.constructor : function () {
							return e.apply(this, arguments)
						},
						i = function () {
							this.constructor = n
						};
					return i.prototype = e.prototype, n.prototype = new i, n.extend = d.inherits, t && d.extend(n.prototype, t), n.__super__ = e.prototype, n
				}
			};
			(e.exports = d).callCallback = d.callback, d.indexOf = function (t, e, n) {
				return Array.prototype.indexOf.call(t, e, n)
			}, d.getValueOrDefault = d.valueOrDefault, d.getValueAtIndexOrDefault = d.valueAtIndexOrDefault
		}, {}],
		44: [function (t, e, n) {
			"use strict";
			var i = t(43),
				a = {
					linear: function (t) {
						return t
					},
					easeInQuad: function (t) {
						return t * t
					},
					easeOutQuad: function (t) {
						return -t * (t - 2)
					},
					easeInOutQuad: function (t) {
						return (t /= .5) < 1 ? .5 * t * t : -.5 * (--t * (t - 2) - 1)
					},
					easeInCubic: function (t) {
						return t * t * t
					},
					easeOutCubic: function (t) {
						return (t -= 1) * t * t + 1
					},
					easeInOutCubic: function (t) {
						return (t /= .5) < 1 ? .5 * t * t * t : .5 * ((t -= 2) * t * t + 2)
					},
					easeInQuart: function (t) {
						return t * t * t * t
					},
					easeOutQuart: function (t) {
						return -((t -= 1) * t * t * t - 1)
					},
					easeInOutQuart: function (t) {
						return (t /= .5) < 1 ? .5 * t * t * t * t : -.5 * ((t -= 2) * t * t * t - 2)
					},
					easeInQuint: function (t) {
						return t * t * t * t * t
					},
					easeOutQuint: function (t) {
						return (t -= 1) * t * t * t * t + 1
					},
					easeInOutQuint: function (t) {
						return (t /= .5) < 1 ? .5 * t * t * t * t * t : .5 * ((t -= 2) * t * t * t * t + 2)
					},
					easeInSine: function (t) {
						return 1 - Math.cos(t * (Math.PI / 2))
					},
					easeOutSine: function (t) {
						return Math.sin(t * (Math.PI / 2))
					},
					easeInOutSine: function (t) {
						return -.5 * (Math.cos(Math.PI * t) - 1)
					},
					easeInExpo: function (t) {
						return 0 === t ? 0 : Math.pow(2, 10 * (t - 1))
					},
					easeOutExpo: function (t) {
						return 1 === t ? 1 : 1 - Math.pow(2, -10 * t)
					},
					easeInOutExpo: function (t) {
						return 0 === t ? 0 : 1 === t ? 1 : (t /= .5) < 1 ? .5 * Math.pow(2, 10 * (t - 1)) : .5 * (2 - Math.pow(2, -10 * --t))
					},
					easeInCirc: function (t) {
						return 1 <= t ? t : -(Math.sqrt(1 - t * t) - 1)
					},
					easeOutCirc: function (t) {
						return Math.sqrt(1 - (t -= 1) * t)
					},
					easeInOutCirc: function (t) {
						return (t /= .5) < 1 ? -.5 * (Math.sqrt(1 - t * t) - 1) : .5 * (Math.sqrt(1 - (t -= 2) * t) + 1)
					},
					easeInElastic: function (t) {
						var e = 1.70158,
							n = 0,
							i = 1;
						return 0 === t ? 0 : 1 === t ? 1 : (n || (n = .3), e = i < 1 ? (i = 1, n / 4) : n / (2 * Math.PI) * Math.asin(1 / i), -i * Math.pow(2, 10 * (t -= 1)) * Math.sin((t - e) * (2 * Math.PI) / n))
					},
					easeOutElastic: function (t) {
						var e = 1.70158,
							n = 0,
							i = 1;
						return 0 === t ? 0 : 1 === t ? 1 : (n || (n = .3), e = i < 1 ? (i = 1, n / 4) : n / (2 * Math.PI) * Math.asin(1 / i), i * Math.pow(2, -10 * t) * Math.sin((t - e) * (2 * Math.PI) / n) + 1)
					},
					easeInOutElastic: function (t) {
						var e = 1.70158,
							n = 0,
							i = 1;
						return 0 === t ? 0 : 2 == (t /= .5) ? 1 : (n || (n = .45), e = i < 1 ? (i = 1, n / 4) : n / (2 * Math.PI) * Math.asin(1 / i), t < 1 ? i * Math.pow(2, 10 * (t -= 1)) * Math.sin((t - e) * (2 * Math.PI) / n) * -.5 : i * Math.pow(2, -10 * (t -= 1)) * Math.sin((t - e) * (2 * Math.PI) / n) * .5 + 1)
					},
					easeInBack: function (t) {
						return t * t * (2.70158 * t - 1.70158)
					},
					easeOutBack: function (t) {
						return (t -= 1) * t * (2.70158 * t + 1.70158) + 1
					},
					easeInOutBack: function (t) {
						var e = 1.70158;
						return (t /= .5) < 1 ? t * t * ((1 + (e *= 1.525)) * t - e) * .5 : .5 * ((t -= 2) * t * ((1 + (e *= 1.525)) * t + e) + 2)
					},
					easeInBounce: function (t) {
						return 1 - a.easeOutBounce(1 - t)
					},
					easeOutBounce: function (t) {
						return t < 1 / 2.75 ? 7.5625 * t * t : t < 2 / 2.75 ? 7.5625 * (t -= 1.5 / 2.75) * t + .75 : t < 2.5 / 2.75 ? 7.5625 * (t -= 2.25 / 2.75) * t + .9375 : 7.5625 * (t -= 2.625 / 2.75) * t + .984375
					},
					easeInOutBounce: function (t) {
						return t < .5 ? .5 * a.easeInBounce(2 * t) : .5 * a.easeOutBounce(2 * t - 1) + .5
					}
				};
			e.exports = {
				effects: a
			}, i.easingEffects = a
		}, {
			43: 43
		}],
		45: [function (t, e, n) {
			"use strict";
			var o = t(43);
			e.exports = {
				toLineHeight: function (t, e) {
					var n = ("" + t).match(/^(normal|(\d+(?:\.\d+)?)(px|em|%)?)$/);
					if (!n || "normal" === n[1]) return 1.2 * e;
					switch (t = +n[2], n[3]) {
						case "px":
							return t;
						case "%":
							t /= 100
					}
					return e * t
				},
				toPadding: function (t) {
					var e, n, i, a;
					return o.isObject(t) ? (e = +t.top || 0, n = +t.right || 0, i = +t.bottom || 0, a = +t.left || 0) : e = n = i = a = +t || 0, {
						top: e,
						right: n,
						bottom: i,
						left: a,
						height: e + i,
						width: a + n
					}
				},
				resolve: function (t, e, n) {
					var i, a, r;
					for (i = 0, a = t.length; i < a; ++i)
						if (void 0 !== (r = t[i]) && (void 0 !== e && "function" == typeof r && (r = r(e)), void 0 !== n && o.isArray(r) && (r = r[n]), void 0 !== r)) return r
				}
			}
		}, {
			43: 43
		}],
		46: [function (t, e, n) {
			"use strict";
			e.exports = t(43), e.exports.easing = t(44), e.exports.canvas = t(42), e.exports.options = t(45)
		}, {
			42: 42,
			43: 43,
			44: 44,
			45: 45
		}],
		47: [function (t, e, n) {
			e.exports = {
				acquireContext: function (t) {
					return t && t.canvas && (t = t.canvas), t && t.getContext("2d") || null
				}
			}
		}, {}],
		48: [function (t, e, n) {
			"use strict";
			var f = t(46),
				g = "$chartjs",
				m = "chartjs-",
				p = m + "render-monitor",
				v = m + "render-animation",
				b = ["animationstart", "webkitAnimationStart"],
				s = {
					touchstart: "mousedown",
					touchmove: "mousemove",
					touchend: "mouseup",
					pointerenter: "mouseenter",
					pointerdown: "mousedown",
					pointermove: "mousemove",
					pointerup: "mouseup",
					pointerleave: "mouseout",
					pointerout: "mouseout"
				};

			function l(t, e) {
				var n = f.getStyle(t, e),
					i = n && n.match(/^(\d+)(\.\d+)?px$/);
				return i ? Number(i[1]) : void 0
			}
			var i = !! function () {
				var t = !1;
				try {
					var e = Object.defineProperty({}, "passive", {
						get: function () {
							t = !0
						}
					});
					window.addEventListener("e", null, e)
				} catch (t) { }
				return t
			}() && {
				passive: !0
			};

			function y(t, e, n) {
				t.addEventListener(e, n, i)
			}

			function o(t, e, n) {
				t.removeEventListener(e, n, i)
			}

			function x(t, e, n, i, a) {
				return {
					type: t,
					chart: e,
					native: a || null,
					x: void 0 !== n ? n : null,
					y: void 0 !== i ? i : null
				}
			}

			function a(e, t, n) {
				var i, a, r, o, s, l, u, d, h = e[g] || (e[g] = {}),
					c = h.resizer = function (t) {
						var e = document.createElement("div"),
							n = m + "size-monitor",
							i = "position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;";
						e.style.cssText = i, e.className = n, e.innerHTML = '<div class="' + n + '-expand" style="' + i + '"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="' + n + '-shrink" style="' + i + '"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div>';
						var a = e.childNodes[0],
							r = e.childNodes[1];
						e._reset = function () {
							a.scrollLeft = 1e6, a.scrollTop = 1e6, r.scrollLeft = 1e6, r.scrollTop = 1e6
						};
						var o = function () {
							e._reset(), t()
						};
						return y(a, "scroll", o.bind(a, "expand")), y(r, "scroll", o.bind(r, "shrink")), e
					}((r = !(i = function () {
						if (h.resizer) return t(x("resize", n))
					}), o = [], function () {
						o = Array.prototype.slice.call(arguments), a = a || this, r || (r = !0, f.requestAnimFrame.call(window, function () {
							r = !1, i.apply(a, o)
						}))
					}));
				l = function () {
					if (h.resizer) {
						var t = e.parentNode;
						t && t !== c.parentNode && t.insertBefore(c, t.firstChild), c._reset()
					}
				}, u = (s = e)[g] || (s[g] = {}), d = u.renderProxy = function (t) {
					t.animationName === v && l()
				}, f.each(b, function (t) {
					y(s, t, d)
				}), u.reflow = !!s.offsetParent, s.classList.add(p)
			}

			function r(t) {
				var e, n, i, a = t[g] || {},
					r = a.resizer;
				delete a.resizer, n = (e = t)[g] || {}, (i = n.renderProxy) && (f.each(b, function (t) {
					o(e, t, i)
				}), delete n.renderProxy), e.classList.remove(p), r && r.parentNode && r.parentNode.removeChild(r)
			}
			e.exports = {
				_enabled: "undefined" != typeof window && "undefined" != typeof document,
				initialize: function () {
					var t, e, n, i = "from{opacity:0.99}to{opacity:1}";
					e = "@-webkit-keyframes " + v + "{" + i + "}@keyframes " + v + "{" + i + "}." + p + "{-webkit-animation:" + v + " 0.001s;animation:" + v + " 0.001s;}", n = (t = this)._style || document.createElement("style"), t._style || (e = "/* Chart.js */\n" + e, (t._style = n).setAttribute("type", "text/css"), document.getElementsByTagName("head")[0].appendChild(n)), n.appendChild(document.createTextNode(e))
				},
				acquireContext: function (t, e) {
					"string" == typeof t ? t = document.getElementById(t) : t.length && (t = t[0]), t && t.canvas && (t = t.canvas);
					var n = t && t.getContext && t.getContext("2d");
					return n && n.canvas === t ? (function (t, e) {
						var n = t.style,
							i = t.getAttribute("height"),
							a = t.getAttribute("width");
						if (t[g] = {
							initial: {
								height: i,
								width: a,
								style: {
									display: n.display,
									height: n.height,
									width: n.width
								}
							}
						}, n.display = n.display || "block", null === a || "" === a) {
							var r = l(t, "width");
							void 0 !== r && (t.width = r)
						}
						if (null === i || "" === i)
							if ("" === t.style.height) t.height = t.width / (e.options.aspectRatio || 2);
							else {
								var o = l(t, "height");
								void 0 !== r && (t.height = o)
							}
					}(t, e), n) : null
				},
				releaseContext: function (t) {
					var n = t.canvas;
					if (n[g]) {
						var i = n[g].initial;
						["height", "width"].forEach(function (t) {
							var e = i[t];
							f.isNullOrUndef(e) ? n.removeAttribute(t) : n.setAttribute(t, e)
						}), f.each(i.style || {}, function (t, e) {
							n.style[e] = t
						}), n.width = n.width, delete n[g]
					}
				},
				addEventListener: function (r, t, o) {
					var e = r.canvas;
					if ("resize" !== t) {
						var n = o[g] || (o[g] = {});
						y(e, t, (n.proxies || (n.proxies = {}))[r.id + "_" + t] = function (t) {
							var e, n, i, a;
							o((n = r, i = s[(e = t).type] || e.type, a = f.getRelativePosition(e, n), x(i, n, a.x, a.y, e)))
						})
					} else a(e, o, r)
				},
				removeEventListener: function (t, e, n) {
					var i = t.canvas;
					if ("resize" !== e) {
						var a = ((n[g] || {}).proxies || {})[t.id + "_" + e];
						a && o(i, e, a)
					} else r(i)
				}
			}, f.addEvent = y, f.removeEvent = o
		}, {
			46: 46
		}],
		49: [function (t, e, n) {
			"use strict";
			var i = t(46),
				a = t(47),
				r = t(48),
				o = r._enabled ? r : a;
			e.exports = i.extend({
				initialize: function () { },
				acquireContext: function () { },
				releaseContext: function () { },
				addEventListener: function () { },
				removeEventListener: function () { }
			}, o)
		}, {
			46: 46,
			47: 47,
			48: 48
		}],
		50: [function (t, e, n) {
			"use strict";
			e.exports = {}, e.exports.filler = t(51), e.exports.legend = t(52), e.exports.title = t(53)
		}, {
			51: 51,
			52: 52,
			53: 53
		}],
		51: [function (t, e, n) {
			"use strict";
			var u = t(26),
				c = t(41),
				d = t(46);
			u._set("global", {
				plugins: {
					filler: {
						propagate: !0
					}
				}
			});
			var f = {
				dataset: function (t) {
					var e = t.fill,
						n = t.chart,
						i = n.getDatasetMeta(e),
						a = i && n.isDatasetVisible(e) && i.dataset._children || [],
						r = a.length || 0;
					return r ? function (t, e) {
						return e < r && a[e]._view || null
					} : null
				},
				boundary: function (t) {
					var e = t.boundary,
						n = e ? e.x : null,
						i = e ? e.y : null;
					return function (t) {
						return {
							x: null === n ? t.x : n,
							y: null === i ? t.y : i
						}
					}
				}
			};

			function g(t, e, n) {
				var i, a = t._model || {},
					r = a.fill;
				if (void 0 === r && (r = !!a.backgroundColor), !1 === r || null === r) return !1;
				if (!0 === r) return "origin";
				if (i = parseFloat(r, 10), isFinite(i) && Math.floor(i) === i) return "-" !== r[0] && "+" !== r[0] || (i = e + i), !(i === e || i < 0 || n <= i) && i;
				switch (r) {
					case "bottom":
						return "start";
					case "top":
						return "end";
					case "zero":
						return "origin";
					case "origin":
					case "start":
					case "end":
						return r;
					default:
						return !1
				}
			}

			function m(t) {
				var e, n = t.el._model || {},
					i = t.el._scale || {},
					a = t.fill,
					r = null;
				if (isFinite(a)) return null;
				if ("start" === a ? r = void 0 === n.scaleBottom ? i.bottom : n.scaleBottom : "end" === a ? r = void 0 === n.scaleTop ? i.top : n.scaleTop : void 0 !== n.scaleZero ? r = n.scaleZero : i.getBasePosition ? r = i.getBasePosition() : i.getBasePixel && (r = i.getBasePixel()), null != r) {
					if (void 0 !== r.x && void 0 !== r.y) return r;
					if ("number" == typeof r && isFinite(r)) return {
						x: (e = i.isHorizontal()) ? r : null,
						y: e ? null : r
					}
				}
				return null
			}

			function p(t, e, n) {
				var i, a = t[e].fill,
					r = [e];
				if (!n) return a;
				for (; !1 !== a && -1 === r.indexOf(a);) {
					if (!isFinite(a)) return a;
					if (!(i = t[a])) return !1;
					if (i.visible) return a;
					r.push(a), a = i.fill
				}
				return !1
			}

			function y(t) {
				return t && !t.skip
			}

			function x(t, e, n, i, a) {
				var r;
				if (i && a) {
					for (t.moveTo(e[0].x, e[0].y), r = 1; r < i; ++r) d.canvas.lineTo(t, e[r - 1], e[r]);
					for (t.lineTo(n[a - 1].x, n[a - 1].y), r = a - 1; 0 < r; --r) d.canvas.lineTo(t, n[r], n[r - 1], !0)
				}
			}
			e.exports = {
				id: "filler",
				afterDatasetsUpdate: function (t, e) {
					var n, i, a, r, o, s, l, u = (t.data.datasets || []).length,
						d = e.propagate,
						h = [];
					for (i = 0; i < u; ++i) r = null, (a = (n = t.getDatasetMeta(i)).dataset) && a._model && a instanceof c.Line && (r = {
						visible: t.isDatasetVisible(i),
						fill: g(a, i, u),
						chart: t,
						el: a
					}), n.$filler = r, h.push(r);
					for (i = 0; i < u; ++i)(r = h[i]) && (r.fill = p(h, i, d), r.boundary = m(r), r.mapper = (l = void 0, s = (o = r).fill, !(l = "dataset") === s ? null : (isFinite(s) || (l = "boundary"), f[l](o))))
				},
				beforeDatasetDraw: function (t, e) {
					var n = e.meta.$filler;
					if (n) {
						var i = t.ctx,
							a = n.el,
							r = a._view,
							o = a._children || [],
							s = n.mapper,
							l = r.backgroundColor || u.global.defaultColor;
						s && l && o.length && (d.canvas.clipArea(i, t.chartArea), function (t, e, n, i, a, r) {
							var o, s, l, u, d, h, c, f = e.length,
								g = i.spanGaps,
								m = [],
								p = [],
								v = 0,
								b = 0;
							for (t.beginPath(), o = 0, s = f + !!r; o < s; ++o) d = n(u = e[l = o % f]._view, l, i), h = y(u), c = y(d), h && c ? (v = m.push(u), b = p.push(d)) : v && b && (g ? (h && m.push(u), c && p.push(d)) : (x(t, m, p, v, b), v = b = 0, m = [], p = []));
							x(t, m, p, v, b), t.closePath(), t.fillStyle = a, t.fill()
						}(i, o, s, r, l, a._loop), d.canvas.unclipArea(i))
					}
				}
			}
		}, {
			26: 26,
			41: 41,
			46: 46
		}],
		52: [function (t, e, n) {
			"use strict";
			var D = t(26),
				i = t(27),
				C = t(46),
				a = t(31),
				r = C.noop;

			function P(t, e) {
				return t.usePointStyle ? e * Math.SQRT2 : t.boxWidth
			}
			D._set("global", {
				legend: {
					display: !0,
					position: "top",
					fullWidth: !0,
					reverse: !1,
					weight: 1e3,
					onClick: function (t, e) {
						var n = e.datasetIndex,
							i = this.chart,
							a = i.getDatasetMeta(n);
						a.hidden = null === a.hidden ? !i.data.datasets[n].hidden : null, i.update()
					},
					onHover: null,
					labels: {
						boxWidth: 40,
						padding: 10,
						generateLabels: function (n) {
							var t = n.data;
							return C.isArray(t.datasets) ? t.datasets.map(function (t, e) {
								return {
									text: t.label,
									fillStyle: C.isArray(t.backgroundColor) ? t.backgroundColor[0] : t.backgroundColor,
									hidden: !n.isDatasetVisible(e),
									lineCap: t.borderCapStyle,
									lineDash: t.borderDash,
									lineDashOffset: t.borderDashOffset,
									lineJoin: t.borderJoinStyle,
									lineWidth: t.borderWidth,
									strokeStyle: t.borderColor,
									pointStyle: t.pointStyle,
									datasetIndex: e
								}
							}, this) : []
						}
					}
				},
				legendCallback: function (t) {
					var e = [];
					e.push('<ul class="' + t.id + '-legend">');
					for (var n = 0; n < t.data.datasets.length; n++) e.push('<li><span style="background-color:' + t.data.datasets[n].backgroundColor + '"></span>'), t.data.datasets[n].label && e.push(t.data.datasets[n].label), e.push("</li>");
					return e.push("</ul>"), e.join("")
				}
			});
			var o = i.extend({
				initialize: function (t) {
					C.extend(this, t), this.legendHitBoxes = [], this.doughnutMode = !1
				},
				beforeUpdate: r,
				update: function (t, e, n) {
					var i = this;
					return i.beforeUpdate(), i.maxWidth = t, i.maxHeight = e, i.margins = n, i.beforeSetDimensions(), i.setDimensions(), i.afterSetDimensions(), i.beforeBuildLabels(), i.buildLabels(), i.afterBuildLabels(), i.beforeFit(), i.fit(), i.afterFit(), i.afterUpdate(), i.minSize
				},
				afterUpdate: r,
				beforeSetDimensions: r,
				setDimensions: function () {
					var t = this;
					t.isHorizontal() ? (t.width = t.maxWidth, t.left = 0, t.right = t.width) : (t.height = t.maxHeight, t.top = 0, t.bottom = t.height), t.paddingLeft = 0, t.paddingTop = 0, t.paddingRight = 0, t.paddingBottom = 0, t.minSize = {
						width: 0,
						height: 0
					}
				},
				afterSetDimensions: r,
				beforeBuildLabels: r,
				buildLabels: function () {
					var e = this,
						n = e.options.labels || {},
						t = C.callback(n.generateLabels, [e.chart], e) || [];
					n.filter && (t = t.filter(function (t) {
						return n.filter(t, e.chart.data)
					})), e.options.reverse && t.reverse(), e.legendItems = t
				},
				afterBuildLabels: r,
				beforeFit: r,
				fit: function () {
					var i = this,
						t = i.options,
						a = t.labels,
						e = t.display,
						r = i.ctx,
						n = D.global,
						o = C.valueOrDefault,
						s = o(a.fontSize, n.defaultFontSize),
						l = o(a.fontStyle, n.defaultFontStyle),
						u = o(a.fontFamily, n.defaultFontFamily),
						d = C.fontString(s, l, u),
						h = i.legendHitBoxes = [],
						c = i.minSize,
						f = i.isHorizontal();
					if (c.height = f ? (c.width = i.maxWidth, e ? 10 : 0) : (c.width = e ? 10 : 0, i.maxHeight), e)
						if (r.font = d, f) {
							var g = i.lineWidths = [0],
								m = i.legendItems.length ? s + a.padding : 0;
							r.textAlign = "left", r.textBaseline = "top", C.each(i.legendItems, function (t, e) {
								var n = P(a, s) + s / 2 + r.measureText(t.text).width;
								g[g.length - 1] + n + a.padding >= i.width && (m += s + a.padding, g[g.length] = i.left), h[e] = {
									left: 0,
									top: 0,
									width: n,
									height: s
								}, g[g.length - 1] += n + a.padding
							}), c.height += m
						} else {
							var p = a.padding,
								v = i.columnWidths = [],
								b = a.padding,
								y = 0,
								x = 0,
								_ = s + p;
							C.each(i.legendItems, function (t, e) {
								var n = P(a, s) + s / 2 + r.measureText(t.text).width;
								x + _ > c.height && (b += y + a.padding, v.push(y), x = y = 0), y = Math.max(y, n), x += _, h[e] = {
									left: 0,
									top: 0,
									width: n,
									height: s
								}
							}), b += y, v.push(y), c.width += b
						}
					i.width = c.width, i.height = c.height
				},
				afterFit: r,
				isHorizontal: function () {
					return "top" === this.options.position || "bottom" === this.options.position
				},
				draw: function () {
					var h = this,
						c = h.options,
						f = c.labels,
						g = D.global,
						m = g.elements.line,
						p = h.width,
						v = h.lineWidths;
					if (c.display) {
						var b, y = h.ctx,
							x = C.valueOrDefault,
							t = x(f.fontColor, g.defaultFontColor),
							_ = x(f.fontSize, g.defaultFontSize),
							e = x(f.fontStyle, g.defaultFontStyle),
							n = x(f.fontFamily, g.defaultFontFamily),
							i = C.fontString(_, e, n);
						y.textAlign = "left", y.textBaseline = "middle", y.lineWidth = .5, y.strokeStyle = t, y.fillStyle = t, y.font = i;
						var k = P(f, _),
							w = h.legendHitBoxes,
							M = h.isHorizontal();
						b = M ? {
							x: h.left + (p - v[0]) / 2,
							y: h.top + f.padding,
							line: 0
						} : {
							x: h.left + f.padding,
							y: h.top + f.padding,
							line: 0
						};
						var S = _ + f.padding;
						C.each(h.legendItems, function (t, e) {
							var n, i, a, r, o, s = y.measureText(t.text).width,
								l = k + _ / 2 + s,
								u = b.x,
								d = b.y;
							M ? p <= u + l && (d = b.y += S, b.line++, u = b.x = h.left + (p - v[b.line]) / 2) : d + S > h.bottom && (u = b.x = u + h.columnWidths[b.line] + f.padding, d = b.y = h.top + f.padding, b.line++),
								function (t, e, n) {
									if (!(isNaN(k) || k <= 0)) {
										y.save(), y.fillStyle = x(n.fillStyle, g.defaultColor), y.lineCap = x(n.lineCap, m.borderCapStyle), y.lineDashOffset = x(n.lineDashOffset, m.borderDashOffset), y.lineJoin = x(n.lineJoin, m.borderJoinStyle), y.lineWidth = x(n.lineWidth, m.borderWidth), y.strokeStyle = x(n.strokeStyle, g.defaultColor);
										var i = 0 === x(n.lineWidth, m.borderWidth);
										if (y.setLineDash && y.setLineDash(x(n.lineDash, m.borderDash)), c.labels && c.labels.usePointStyle) {
											var a = _ * Math.SQRT2 / 2,
												r = a / Math.SQRT2,
												o = t + r,
												s = e + r;
											C.canvas.drawPoint(y, n.pointStyle, a, o, s)
										} else i || y.strokeRect(t, e, k, _), y.fillRect(t, e, k, _);
										y.restore()
									}
								}(u, d, t), w[e].left = u, w[e].top = d, n = t, i = s, r = k + (a = _ / 2) + u, o = d + a, y.fillText(n.text, r, o), n.hidden && (y.beginPath(), y.lineWidth = 2, y.moveTo(r, o), y.lineTo(r + i, o), y.stroke()), M ? b.x += l + f.padding : b.y += S
						})
					}
				},
				handleEvent: function (t) {
					var e = this,
						n = e.options,
						i = "mouseup" === t.type ? "click" : t.type,
						a = !1;
					if ("mousemove" === i) {
						if (!n.onHover) return
					} else {
						if ("click" !== i) return;
						if (!n.onClick) return
					}
					var r = t.x,
						o = t.y;
					if (r >= e.left && r <= e.right && o >= e.top && o <= e.bottom)
						for (var s = e.legendHitBoxes, l = 0; l < s.length; ++l) {
							var u = s[l];
							if (r >= u.left && r <= u.left + u.width && o >= u.top && o <= u.top + u.height) {
								if ("click" === i) {
									n.onClick.call(e, t.native, e.legendItems[l]), a = !0;
									break
								}
								if ("mousemove" === i) {
									n.onHover.call(e, t.native, e.legendItems[l]), a = !0;
									break
								}
							}
						}
					return a
				}
			});

			function s(t, e) {
				var n = new o({
					ctx: t.ctx,
					options: e,
					chart: t
				});
				a.configure(t, n, e), a.addBox(t, n), t.legend = n
			}
			e.exports = {
				id: "legend",
				_element: o,
				beforeInit: function (t) {
					var e = t.options.legend;
					e && s(t, e)
				},
				beforeUpdate: function (t) {
					var e = t.options.legend,
						n = t.legend;
					e ? (C.mergeIf(e, D.global.legend), n ? (a.configure(t, n, e), n.options = e) : s(t, e)) : n && (a.removeBox(t, n), delete t.legend)
				},
				afterEvent: function (t, e) {
					var n = t.legend;
					n && n.handleEvent(e)
				}
			}
		}, {
			26: 26,
			27: 27,
			31: 31,
			46: 46
		}],
		53: [function (t, e, n) {
			"use strict";
			var _ = t(26),
				i = t(27),
				k = t(46),
				a = t(31),
				r = k.noop;
			_._set("global", {
				title: {
					display: !1,
					fontStyle: "bold",
					fullWidth: !0,
					lineHeight: 1.2,
					padding: 10,
					position: "top",
					text: "",
					weight: 2e3
				}
			});
			var o = i.extend({
				initialize: function (t) {
					k.extend(this, t), this.legendHitBoxes = []
				},
				beforeUpdate: r,
				update: function (t, e, n) {
					var i = this;
					return i.beforeUpdate(), i.maxWidth = t, i.maxHeight = e, i.margins = n, i.beforeSetDimensions(), i.setDimensions(), i.afterSetDimensions(), i.beforeBuildLabels(), i.buildLabels(), i.afterBuildLabels(), i.beforeFit(), i.fit(), i.afterFit(), i.afterUpdate(), i.minSize
				},
				afterUpdate: r,
				beforeSetDimensions: r,
				setDimensions: function () {
					var t = this;
					t.isHorizontal() ? (t.width = t.maxWidth, t.left = 0, t.right = t.width) : (t.height = t.maxHeight, t.top = 0, t.bottom = t.height), t.paddingLeft = 0, t.paddingTop = 0, t.paddingRight = 0, t.paddingBottom = 0, t.minSize = {
						width: 0,
						height: 0
					}
				},
				afterSetDimensions: r,
				beforeBuildLabels: r,
				buildLabels: r,
				afterBuildLabels: r,
				beforeFit: r,
				fit: function () {
					var t = k.valueOrDefault,
						e = this.options,
						n = e.display,
						i = t(e.fontSize, _.global.defaultFontSize),
						a = this.minSize,
						r = k.isArray(e.text) ? e.text.length : 1,
						o = k.options.toLineHeight(e.lineHeight, i),
						s = n ? r * o + 2 * e.padding : 0;
					this.isHorizontal() ? (a.width = this.maxWidth, a.height = s) : (a.width = s, a.height = this.maxHeight), this.width = a.width, this.height = a.height
				},
				afterFit: r,
				isHorizontal: function () {
					var t = this.options.position;
					return "top" === t || "bottom" === t
				},
				draw: function () {
					var t = this.ctx,
						e = k.valueOrDefault,
						n = this.options,
						i = _.global;
					if (n.display) {
						var a, r, o, s = e(n.fontSize, i.defaultFontSize),
							l = e(n.fontStyle, i.defaultFontStyle),
							u = e(n.fontFamily, i.defaultFontFamily),
							d = k.fontString(s, l, u),
							h = k.options.toLineHeight(n.lineHeight, s),
							c = h / 2 + n.padding,
							f = 0,
							g = this.top,
							m = this.left,
							p = this.bottom,
							v = this.right;
						t.fillStyle = e(n.fontColor, i.defaultFontColor), t.font = d, this.isHorizontal() ? (r = m + (v - m) / 2, o = g + c, a = v - m) : (r = "left" === n.position ? m + c : v - c, o = g + (p - g) / 2, a = p - g, f = Math.PI * ("left" === n.position ? -.5 : .5)), t.save(), t.translate(r, o), t.rotate(f), t.textAlign = "center", t.textBaseline = "middle";
						var b = n.text;
						if (k.isArray(b))
							for (var y = 0, x = 0; x < b.length; ++x) t.fillText(b[x], 0, y, a), y += h;
						else t.fillText(b, 0, 0, a);
						t.restore()
					}
				}
			});

			function s(t, e) {
				var n = new o({
					ctx: t.ctx,
					options: e,
					chart: t
				});
				a.configure(t, n, e), a.addBox(t, n), t.titleBlock = n
			}
			e.exports = {
				id: "title",
				_element: o,
				beforeInit: function (t) {
					var e = t.options.title;
					e && s(t, e)
				},
				beforeUpdate: function (t) {
					var e = t.options.title,
						n = t.titleBlock;
					e ? (k.mergeIf(e, _.global.title), n ? (a.configure(t, n, e), n.options = e) : s(t, e)) : n && (a.removeBox(t, n), delete t.titleBlock)
				}
			}
		}, {
			26: 26,
			27: 27,
			31: 31,
			46: 46
		}],
		54: [function (t, e, n) {
			"use strict";
			var i = t(33),
				a = t(34);
			e.exports = function () {
				var t = i.extend({
					getLabels: function () {
						var t = this.chart.data;
						return this.options.labels || (this.isHorizontal() ? t.xLabels : t.yLabels) || t.labels
					},
					determineDataLimits: function () {
						var t, e = this,
							n = e.getLabels();
						e.minIndex = 0, e.maxIndex = n.length - 1, void 0 !== e.options.ticks.min && (t = n.indexOf(e.options.ticks.min), e.minIndex = -1 !== t ? t : e.minIndex), void 0 !== e.options.ticks.max && (t = n.indexOf(e.options.ticks.max), e.maxIndex = -1 !== t ? t : e.maxIndex), e.min = n[e.minIndex], e.max = n[e.maxIndex]
					},
					buildTicks: function () {
						var t = this.getLabels();
						this.ticks = 0 === this.minIndex && this.maxIndex === t.length - 1 ? t : t.slice(this.minIndex, this.maxIndex + 1)
					},
					getLabelForIndex: function (t, e) {
						var n = this.chart.data,
							i = this.isHorizontal();
						return n.yLabels && !i ? this.getRightValue(n.datasets[e].data[t]) : this.ticks[t - this.minIndex]
					},
					getPixelForValue: function (t, e) {
						var n, i = this,
							a = i.options.offset,
							r = Math.max(i.maxIndex + 1 - i.minIndex - (a ? 0 : 1), 1);
						if (null != t && (n = i.isHorizontal() ? t.x : t.y), void 0 !== n || void 0 !== t && isNaN(e)) {
							t = n || t;
							var o = i.getLabels().indexOf(t);
							e = -1 !== o ? o : e
						}
						if (i.isHorizontal()) {
							var s = i.width / r,
								l = s * (e - i.minIndex);
							return a && (l += s / 2), i.left + Math.round(l)
						}
						var u = i.height / r,
							d = u * (e - i.minIndex);
						return a && (d += u / 2), i.top + Math.round(d)
					},
					getPixelForTick: function (t) {
						return this.getPixelForValue(this.ticks[t], t + this.minIndex, null)
					},
					getValueForPixel: function (t) {
						var e = this.options.offset,
							n = Math.max(this._ticks.length - (e ? 0 : 1), 1),
							i = this.isHorizontal(),
							a = (i ? this.width : this.height) / n;
						return t -= i ? this.left : this.top, e && (t -= a / 2), (t <= 0 ? 0 : Math.round(t / a)) + this.minIndex
					},
					getBasePixel: function () {
						return this.bottom
					}
				});
				a.registerScaleType("category", t, {
					position: "bottom"
				})
			}
		}, {
			33: 33,
			34: 34
		}],
		55: [function (t, e, n) {
			"use strict";
			var i = t(26),
				h = t(46),
				a = t(34),
				r = t(35);
			e.exports = function (t) {
				var e = {
					position: "left",
					ticks: {
						callback: r.formatters.linear
					}
				},
					n = t.LinearScaleBase.extend({
						determineDataLimits: function () {
							var o = this,
								s = o.options,
								l = o.chart,
								t = l.data.datasets,
								e = o.isHorizontal();

							function u(t) {
								return e ? t.xAxisID === o.id : t.yAxisID === o.id
							}
							o.min = null, o.max = null;
							var i = s.stacked;
							if (void 0 === i && h.each(t, function (t, e) {
								if (!i) {
									var n = l.getDatasetMeta(e);
									l.isDatasetVisible(e) && u(n) && void 0 !== n.stack && (i = !0)
								}
							}), s.stacked || i) {
								var d = {};
								h.each(t, function (t, e) {
									var i = l.getDatasetMeta(e),
										n = [i.type, void 0 === s.stacked && void 0 === i.stack ? e : "", i.stack].join(".");
									void 0 === d[n] && (d[n] = {
										positiveValues: [],
										negativeValues: []
									});
									var a = d[n].positiveValues,
										r = d[n].negativeValues;
									l.isDatasetVisible(e) && u(i) && h.each(t.data, function (t, e) {
										var n = +o.getRightValue(t);
										isNaN(n) || i.data[e].hidden || (a[e] = a[e] || 0, r[e] = r[e] || 0, s.relativePoints ? a[e] = 100 : n < 0 ? r[e] += n : a[e] += n)
									})
								}), h.each(d, function (t) {
									var e = t.positiveValues.concat(t.negativeValues),
										n = h.min(e),
										i = h.max(e);
									o.min = null === o.min ? n : Math.min(o.min, n), o.max = null === o.max ? i : Math.max(o.max, i)
								})
							} else h.each(t, function (t, e) {
								var i = l.getDatasetMeta(e);
								l.isDatasetVisible(e) && u(i) && h.each(t.data, function (t, e) {
									var n = +o.getRightValue(t);
									isNaN(n) || i.data[e].hidden || (null === o.min ? o.min = n : n < o.min && (o.min = n), null === o.max ? o.max = n : n > o.max && (o.max = n))
								})
							});
							o.min = isFinite(o.min) && !isNaN(o.min) ? o.min : 0, o.max = isFinite(o.max) && !isNaN(o.max) ? o.max : 1, this.handleTickRangeOptions()
						},
						getTickLimit: function () {
							var t, e = this.options.ticks;
							if (this.isHorizontal()) t = Math.min(e.maxTicksLimit ? e.maxTicksLimit : 11, Math.ceil(this.width / 50));
							else {
								var n = h.valueOrDefault(e.fontSize, i.global.defaultFontSize);
								t = Math.min(e.maxTicksLimit ? e.maxTicksLimit : 11, Math.ceil(this.height / (2 * n)))
							}
							return t
						},
						handleDirectionalChanges: function () {
							this.isHorizontal() || this.ticks.reverse()
						},
						getLabelForIndex: function (t, e) {
							return +this.getRightValue(this.chart.data.datasets[e].data[t])
						},
						getPixelForValue: function (t) {
							var e = this.start,
								n = +this.getRightValue(t),
								i = this.end - e;
							return this.isHorizontal() ? this.left + this.width / i * (n - e) : this.bottom - this.height / i * (n - e)
						},
						getValueForPixel: function (t) {
							var e = this.isHorizontal(),
								n = e ? this.width : this.height,
								i = (e ? t - this.left : this.bottom - t) / n;
							return this.start + (this.end - this.start) * i
						},
						getPixelForTick: function (t) {
							return this.getPixelForValue(this.ticksAsNumbers[t])
						}
					});
				a.registerScaleType("linear", n, e)
			}
		}, {
			26: 26,
			34: 34,
			35: 35,
			46: 46
		}],
		56: [function (t, e, n) {
			"use strict";
			var h = t(46),
				i = t(33);
			e.exports = function (t) {
				var e = h.noop;
				t.LinearScaleBase = i.extend({
					getRightValue: function (t) {
						return "string" == typeof t ? +t : i.prototype.getRightValue.call(this, t)
					},
					handleTickRangeOptions: function () {
						var t = this,
							e = t.options.ticks;
						if (e.beginAtZero) {
							var n = h.sign(t.min),
								i = h.sign(t.max);
							n < 0 && i < 0 ? t.max = 0 : 0 < n && 0 < i && (t.min = 0)
						}
						var a = void 0 !== e.min || void 0 !== e.suggestedMin,
							r = void 0 !== e.max || void 0 !== e.suggestedMax;
						void 0 !== e.min ? t.min = e.min : void 0 !== e.suggestedMin && (null === t.min ? t.min = e.suggestedMin : t.min = Math.min(t.min, e.suggestedMin)), void 0 !== e.max ? t.max = e.max : void 0 !== e.suggestedMax && (null === t.max ? t.max = e.suggestedMax : t.max = Math.max(t.max, e.suggestedMax)), a !== r && t.min >= t.max && (a ? t.max = t.min + 1 : t.min = t.max - 1), t.min === t.max && (t.max++, e.beginAtZero || t.min--)
					},
					getTickLimit: e,
					handleDirectionalChanges: e,
					buildTicks: function () {
						var t = this,
							e = t.options.ticks,
							n = t.getTickLimit(),
							i = {
								maxTicks: n = Math.max(2, n),
								min: e.min,
								max: e.max,
								precision: e.precision,
								stepSize: h.valueOrDefault(e.fixedStepSize, e.stepSize)
							},
							a = t.ticks = function (t, e) {
								var n, i, a, r = [];
								if (t.stepSize && 0 < t.stepSize) a = t.stepSize;
								else {
									var o = h.niceNum(e.max - e.min, !1);
									a = h.niceNum(o / (t.maxTicks - 1), !0), void 0 !== (i = t.precision) && (n = Math.pow(10, i), a = Math.ceil(a * n) / n)
								}
								var s = Math.floor(e.min / a) * a,
									l = Math.ceil(e.max / a) * a;
								h.isNullOrUndef(t.min) || h.isNullOrUndef(t.max) || !t.stepSize || h.almostWhole((t.max - t.min) / t.stepSize, a / 1e3) && (s = t.min, l = t.max);
								var u = (l - s) / a;
								u = h.almostEquals(u, Math.round(u), a / 1e3) ? Math.round(u) : Math.ceil(u), a < (i = 1) && (i = Math.pow(10, 1 - Math.floor(h.log10(a))), s = Math.round(s * i) / i, l = Math.round(l * i) / i), r.push(void 0 !== t.min ? t.min : s);
								for (var d = 1; d < u; ++d) r.push(Math.round((s + d * a) * i) / i);
								return r.push(void 0 !== t.max ? t.max : l), r
							}(i, t);
						t.handleDirectionalChanges(), t.max = h.max(a), t.min = h.min(a), e.reverse ? (a.reverse(), t.start = t.max, t.end = t.min) : (t.start = t.min, t.end = t.max)
					},
					convertTicksToLabels: function () {
						this.ticksAsNumbers = this.ticks.slice(), this.zeroLineIndex = this.ticks.indexOf(0), i.prototype.convertTicksToLabels.call(this)
					}
				})
			}
		}, {
			33: 33,
			46: 46
		}],
		57: [function (t, e, n) {
			"use strict";
			var c = t(46),
				i = t(33),
				a = t(34),
				r = t(35);
			e.exports = function (h) {
				var t = {
					position: "left",
					ticks: {
						callback: r.formatters.logarithmic
					}
				},
					e = i.extend({
						determineDataLimits: function () {
							var o = this,
								n = o.options,
								s = o.chart,
								t = s.data.datasets,
								e = o.isHorizontal();

							function l(t) {
								return e ? t.xAxisID === o.id : t.yAxisID === o.id
							}
							o.min = null, o.max = null, o.minNotZero = null;
							var i = n.stacked;
							if (void 0 === i && c.each(t, function (t, e) {
								if (!i) {
									var n = s.getDatasetMeta(e);
									s.isDatasetVisible(e) && l(n) && void 0 !== n.stack && (i = !0)
								}
							}), n.stacked || i) {
								var u = {};
								c.each(t, function (t, e) {
									var a = s.getDatasetMeta(e),
										r = [a.type, void 0 === n.stacked && void 0 === a.stack ? e : "", a.stack].join(".");
									s.isDatasetVisible(e) && l(a) && (void 0 === u[r] && (u[r] = []), c.each(t.data, function (t, e) {
										var n = u[r],
											i = +o.getRightValue(t);
										isNaN(i) || a.data[e].hidden || i < 0 || (n[e] = n[e] || 0, n[e] += i)
									}))
								}), c.each(u, function (t) {
									if (0 < t.length) {
										var e = c.min(t),
											n = c.max(t);
										o.min = null === o.min ? e : Math.min(o.min, e), o.max = null === o.max ? n : Math.max(o.max, n)
									}
								})
							} else c.each(t, function (t, e) {
								var i = s.getDatasetMeta(e);
								s.isDatasetVisible(e) && l(i) && c.each(t.data, function (t, e) {
									var n = +o.getRightValue(t);
									isNaN(n) || i.data[e].hidden || n < 0 || (null === o.min ? o.min = n : n < o.min && (o.min = n), null === o.max ? o.max = n : n > o.max && (o.max = n), 0 !== n && (null === o.minNotZero || n < o.minNotZero) && (o.minNotZero = n))
								})
							});
							this.handleTickRangeOptions()
						},
						handleTickRangeOptions: function () {
							var t = this,
								e = t.options.ticks,
								n = c.valueOrDefault;
							t.min = n(e.min, t.min), t.max = n(e.max, t.max), t.min === t.max && (0 !== t.min && null !== t.min ? (t.min = Math.pow(10, Math.floor(c.log10(t.min)) - 1), t.max = Math.pow(10, Math.floor(c.log10(t.max)) + 1)) : (t.min = 1, t.max = 10)), null === t.min && (t.min = Math.pow(10, Math.floor(c.log10(t.max)) - 1)), null === t.max && (t.max = 0 !== t.min ? Math.pow(10, Math.floor(c.log10(t.min)) + 1) : 10), null === t.minNotZero && (0 < t.min ? t.minNotZero = t.min : t.max < 1 ? t.minNotZero = Math.pow(10, Math.floor(c.log10(t.max))) : t.minNotZero = 1)
						},
						buildTicks: function () {
							var t = this,
								e = t.options.ticks,
								n = !t.isHorizontal(),
								i = {
									min: e.min,
									max: e.max
								},
								a = t.ticks = function (t, e) {
									var n, i, a = [],
										r = c.valueOrDefault,
										o = r(t.min, Math.pow(10, Math.floor(c.log10(e.min)))),
										s = Math.floor(c.log10(e.max)),
										l = Math.ceil(e.max / Math.pow(10, s));
									0 === o ? (n = Math.floor(c.log10(e.minNotZero)), i = Math.floor(e.minNotZero / Math.pow(10, n)), a.push(o), o = i * Math.pow(10, n)) : (n = Math.floor(c.log10(o)), i = Math.floor(o / Math.pow(10, n)));
									for (var u = n < 0 ? Math.pow(10, Math.abs(n)) : 1; a.push(o), 10 == ++i && (i = 1, u = 0 <= ++n ? 1 : u), o = Math.round(i * Math.pow(10, n) * u) / u, n < s || n === s && i < l;);
									var d = r(t.max, o);
									return a.push(d), a
								}(i, t);
							t.max = c.max(a), t.min = c.min(a), e.reverse ? (n = !n, t.start = t.max, t.end = t.min) : (t.start = t.min, t.end = t.max), n && a.reverse()
						},
						convertTicksToLabels: function () {
							this.tickValues = this.ticks.slice(), i.prototype.convertTicksToLabels.call(this)
						},
						getLabelForIndex: function (t, e) {
							return +this.getRightValue(this.chart.data.datasets[e].data[t])
						},
						getPixelForTick: function (t) {
							return this.getPixelForValue(this.tickValues[t])
						},
						_getFirstTickValue: function (t) {
							var e = Math.floor(c.log10(t));
							return Math.floor(t / Math.pow(10, e)) * Math.pow(10, e)
						},
						getPixelForValue: function (t) {
							var e, n, i, a, r, o = this,
								s = o.options.ticks.reverse,
								l = c.log10,
								u = o._getFirstTickValue(o.minNotZero),
								d = 0;
							return t = +o.getRightValue(t), r = s ? (i = o.end, a = o.start, -1) : (i = o.start, a = o.end, 1), n = o.isHorizontal() ? (e = o.width, s ? o.right : o.left) : (e = o.height, r *= -1, s ? o.top : o.bottom), t !== i && (0 === i && (e -= d = c.getValueOrDefault(o.options.ticks.fontSize, h.defaults.global.defaultFontSize), i = u), 0 !== t && (d += e / (l(a) - l(i)) * (l(t) - l(i))), n += r * d), n
						},
						getValueForPixel: function (t) {
							var e, n, i, a, r = this,
								o = r.options.ticks.reverse,
								s = c.log10,
								l = r._getFirstTickValue(r.minNotZero);
							if (i = o ? (n = r.end, r.start) : (n = r.start, r.end), (a = r.isHorizontal() ? (e = r.width, o ? r.right - t : t - r.left) : (e = r.height, o ? t - r.top : r.bottom - t)) !== n) {
								if (0 === n) {
									var u = c.getValueOrDefault(r.options.ticks.fontSize, h.defaults.global.defaultFontSize);
									a -= u, e -= u, n = l
								}
								a *= s(i) - s(n), a /= e, a = Math.pow(10, s(n) + a)
							}
							return a
						}
					});
				a.registerScaleType("logarithmic", e, t)
			}
		}, {
			33: 33,
			34: 34,
			35: 35,
			46: 46
		}],
		58: [function (t, e, n) {
			"use strict";
			var i = t(26),
				_ = t(46),
				a = t(34),
				r = t(35);
			e.exports = function (t) {
				var v = i.global,
					e = {
						display: !0,
						animate: !0,
						position: "chartArea",
						angleLines: {
							display: !0,
							color: "rgba(0, 0, 0, 0.1)",
							lineWidth: 1
						},
						gridLines: {
							circular: !1
						},
						ticks: {
							showLabelBackdrop: !0,
							backdropColor: "rgba(255,255,255,0.75)",
							backdropPaddingY: 2,
							backdropPaddingX: 2,
							callback: r.formatters.linear
						},
						pointLabels: {
							display: !0,
							fontSize: 10,
							callback: function (t) {
								return t
							}
						}
					};

				function b(t) {
					var e = t.options;
					return e.angleLines.display || e.pointLabels.display ? t.chart.data.labels.length : 0
				}

				function y(t) {
					var e = t.options.pointLabels,
						n = _.valueOrDefault(e.fontSize, v.defaultFontSize),
						i = _.valueOrDefault(e.fontStyle, v.defaultFontStyle),
						a = _.valueOrDefault(e.fontFamily, v.defaultFontFamily);
					return {
						size: n,
						style: i,
						family: a,
						font: _.fontString(n, i, a)
					}
				}

				function p(t, e, n, i, a) {
					return t === i || t === a ? {
						start: e - n / 2,
						end: e + n / 2
					} : t < i || a < t ? {
						start: e - n - 5,
						end: e
					} : {
						start: e,
						end: e + n + 5
					}
				}

				function x(t, e, n, i) {
					if (_.isArray(e))
						for (var a = n.y, r = 1.5 * i, o = 0; o < e.length; ++o) t.fillText(e[o], n.x, a), a += r;
					else t.fillText(e, n.x, n.y)
				}

				function s(t) {
					return _.isNumber(t) ? t : 0
				}
				var n = t.LinearScaleBase.extend({
					setDimensions: function () {
						var t = this,
							e = t.options,
							n = e.ticks;
						t.width = t.maxWidth, t.height = t.maxHeight, t.xCenter = Math.round(t.width / 2), t.yCenter = Math.round(t.height / 2);
						var i = _.min([t.height, t.width]),
							a = _.valueOrDefault(n.fontSize, v.defaultFontSize);
						t.drawingArea = e.display ? i / 2 - (a / 2 + n.backdropPaddingY) : i / 2
					},
					determineDataLimits: function () {
						var a = this,
							n = a.chart,
							r = Number.POSITIVE_INFINITY,
							o = Number.NEGATIVE_INFINITY;
						_.each(n.data.datasets, function (t, e) {
							if (n.isDatasetVisible(e)) {
								var i = n.getDatasetMeta(e);
								_.each(t.data, function (t, e) {
									var n = +a.getRightValue(t);
									isNaN(n) || i.data[e].hidden || (r = Math.min(n, r), o = Math.max(n, o))
								})
							}
						}), a.min = r === Number.POSITIVE_INFINITY ? 0 : r, a.max = o === Number.NEGATIVE_INFINITY ? 0 : o, a.handleTickRangeOptions()
					},
					getTickLimit: function () {
						var t = this.options.ticks,
							e = _.valueOrDefault(t.fontSize, v.defaultFontSize);
						return Math.min(t.maxTicksLimit ? t.maxTicksLimit : 11, Math.ceil(this.drawingArea / (1.5 * e)))
					},
					convertTicksToLabels: function () {
						t.LinearScaleBase.prototype.convertTicksToLabels.call(this), this.pointLabels = this.chart.data.labels.map(this.options.pointLabels.callback, this)
					},
					getLabelForIndex: function (t, e) {
						return +this.getRightValue(this.chart.data.datasets[e].data[t])
					},
					fit: function () {
						var t, e;
						this.options.pointLabels.display ? function (t) {
							var e, n, i, a = y(t),
								r = Math.min(t.height / 2, t.width / 2),
								o = {
									r: t.width,
									l: 0,
									t: t.height,
									b: 0
								},
								s = {};
							t.ctx.font = a.font, t._pointLabelSizes = [];
							var l, u, d, h = b(t);
							for (e = 0; e < h; e++) {
								i = t.getPointPosition(e, r), l = t.ctx, u = a.size, d = t.pointLabels[e] || "", n = _.isArray(d) ? {
									w: _.longestText(l, l.font, d),
									h: d.length * u + 1.5 * (d.length - 1) * u
								} : {
									w: l.measureText(d).width,
									h: u
								}, t._pointLabelSizes[e] = n;
								var c = t.getIndexAngle(e),
									f = _.toDegrees(c) % 360,
									g = p(f, i.x, n.w, 0, 180),
									m = p(f, i.y, n.h, 90, 270);
								g.start < o.l && (o.l = g.start, s.l = c), g.end > o.r && (o.r = g.end, s.r = c), m.start < o.t && (o.t = m.start, s.t = c), m.end > o.b && (o.b = m.end, s.b = c)
							}
							t.setReductions(r, o, s)
						}(this) : (t = this, e = Math.min(t.height / 2, t.width / 2), t.drawingArea = Math.round(e), t.setCenterPoint(0, 0, 0, 0))
					},
					setReductions: function (t, e, n) {
						var i = e.l / Math.sin(n.l),
							a = Math.max(e.r - this.width, 0) / Math.sin(n.r),
							r = -e.t / Math.cos(n.t),
							o = -Math.max(e.b - this.height, 0) / Math.cos(n.b);
						i = s(i), a = s(a), r = s(r), o = s(o), this.drawingArea = Math.min(Math.round(t - (i + a) / 2), Math.round(t - (r + o) / 2)), this.setCenterPoint(i, a, r, o)
					},
					setCenterPoint: function (t, e, n, i) {
						var a = this,
							r = a.width - e - a.drawingArea,
							o = t + a.drawingArea,
							s = n + a.drawingArea,
							l = a.height - i - a.drawingArea;
						a.xCenter = Math.round((o + r) / 2 + a.left), a.yCenter = Math.round((s + l) / 2 + a.top)
					},
					getIndexAngle: function (t) {
						return t * (2 * Math.PI / b(this)) + (this.chart.options && this.chart.options.startAngle ? this.chart.options.startAngle : 0) * Math.PI * 2 / 360
					},
					getDistanceFromCenterForValue: function (t) {
						if (null === t) return 0;
						var e = this.drawingArea / (this.max - this.min);
						return this.options.ticks.reverse ? (this.max - t) * e : (t - this.min) * e
					},
					getPointPosition: function (t, e) {
						var n = this.getIndexAngle(t) - Math.PI / 2;
						return {
							x: Math.round(Math.cos(n) * e) + this.xCenter,
							y: Math.round(Math.sin(n) * e) + this.yCenter
						}
					},
					getPointPositionForValue: function (t, e) {
						return this.getPointPosition(t, this.getDistanceFromCenterForValue(e))
					},
					getBasePosition: function () {
						var t = this.min,
							e = this.max;
						return this.getPointPositionForValue(0, this.beginAtZero ? 0 : t < 0 && e < 0 ? e : 0 < t && 0 < e ? t : 0)
					},
					draw: function () {
						var r = this,
							t = r.options,
							o = t.gridLines,
							s = t.ticks,
							l = _.valueOrDefault;
						if (t.display) {
							var u = r.ctx,
								d = this.getIndexAngle(0),
								h = l(s.fontSize, v.defaultFontSize),
								e = l(s.fontStyle, v.defaultFontStyle),
								n = l(s.fontFamily, v.defaultFontFamily),
								c = _.fontString(h, e, n);
							_.each(r.ticks, function (t, e) {
								if (0 < e || s.reverse) {
									var n = r.getDistanceFromCenterForValue(r.ticksAsNumbers[e]);
									if (o.display && 0 !== e && function (t, e, n, i) {
										var a = t.ctx;
										if (a.strokeStyle = _.valueAtIndexOrDefault(e.color, i - 1), a.lineWidth = _.valueAtIndexOrDefault(e.lineWidth, i - 1), t.options.gridLines.circular) a.beginPath(), a.arc(t.xCenter, t.yCenter, n, 0, 2 * Math.PI), a.closePath(), a.stroke();
										else {
											var r = b(t);
											if (0 === r) return;
											a.beginPath();
											var o = t.getPointPosition(0, n);
											a.moveTo(o.x, o.y);
											for (var s = 1; s < r; s++) o = t.getPointPosition(s, n), a.lineTo(o.x, o.y);
											a.closePath(), a.stroke()
										}
									}(r, o, n, e), s.display) {
										var i = l(s.fontColor, v.defaultFontColor);
										if (u.font = c, u.save(), u.translate(r.xCenter, r.yCenter), u.rotate(d), s.showLabelBackdrop) {
											var a = u.measureText(t).width;
											u.fillStyle = s.backdropColor, u.fillRect(-a / 2 - s.backdropPaddingX, -n - h / 2 - s.backdropPaddingY, a + 2 * s.backdropPaddingX, h + 2 * s.backdropPaddingY)
										}
										u.textAlign = "center", u.textBaseline = "middle", u.fillStyle = i, u.fillText(t, 0, -n), u.restore()
									}
								}
							}), (t.angleLines.display || t.pointLabels.display) && function (t) {
								var e = t.ctx,
									n = t.options,
									i = n.angleLines,
									a = n.pointLabels;
								e.lineWidth = i.lineWidth, e.strokeStyle = i.color;
								var r, o, s, l, u = t.getDistanceFromCenterForValue(n.ticks.reverse ? t.min : t.max),
									d = y(t);
								e.textBaseline = "top";
								for (var h = b(t) - 1; 0 <= h; h--) {
									if (i.display) {
										var c = t.getPointPosition(h, u);
										e.beginPath(), e.moveTo(t.xCenter, t.yCenter), e.lineTo(c.x, c.y), e.stroke(), e.closePath()
									}
									if (a.display) {
										var f = t.getPointPosition(h, u + 5),
											g = _.valueAtIndexOrDefault(a.fontColor, h, v.defaultFontColor);
										e.font = d.font, e.fillStyle = g;
										var m = t.getIndexAngle(h),
											p = _.toDegrees(m);
										e.textAlign = 0 === (l = p) || 180 === l ? "center" : l < 180 ? "left" : "right", r = p, o = t._pointLabelSizes[h], s = f, 90 === r || 270 === r ? s.y -= o.h / 2 : (270 < r || r < 90) && (s.y -= o.h), x(e, t.pointLabels[h] || "", f, d.size)
									}
								}
							}(r)
						}
					}
				});
				a.registerScaleType("radialLinear", n, e)
			}
		}, {
			26: 26,
			34: 34,
			35: 35,
			46: 46
		}],
		59: [function (t, e, n) {
			"use strict";
			var y = t(6);
			y = "function" == typeof y ? y : window.moment;
			var o = t(26),
				p = t(46),
				i = t(33),
				a = t(34),
				m = Number.MIN_SAFE_INTEGER || -9007199254740991,
				v = Number.MAX_SAFE_INTEGER || 9007199254740991,
				x = {
					millisecond: {
						common: !0,
						size: 1,
						steps: [1, 2, 5, 10, 20, 50, 100, 250, 500]
					},
					second: {
						common: !0,
						size: 1e3,
						steps: [1, 2, 5, 10, 15, 30]
					},
					minute: {
						common: !0,
						size: 6e4,
						steps: [1, 2, 5, 10, 15, 30]
					},
					hour: {
						common: !0,
						size: 36e5,
						steps: [1, 2, 3, 6, 12]
					},
					day: {
						common: !0,
						size: 864e5,
						steps: [1, 2, 5]
					},
					week: {
						common: !1,
						size: 6048e5,
						steps: [1, 2, 3, 4]
					},
					month: {
						common: !0,
						size: 2628e6,
						steps: [1, 2, 3]
					},
					quarter: {
						common: !1,
						size: 7884e6,
						steps: [1, 2, 3, 4]
					},
					year: {
						common: !0,
						size: 3154e7
					}
				},
				_ = Object.keys(x);

			function b(t, e) {
				return t - e
			}

			function k(t) {
				var e, n, i, a = {},
					r = [];
				for (e = 0, n = t.length; e < n; ++e) a[i = t[e]] || (a[i] = !0, r.push(i));
				return r
			}

			function w(t, e, n, i) {
				var a = function (t, e, n) {
					for (var i, a, r, o = 0, s = t.length - 1; 0 <= o && o <= s;) {
						if (a = t[(i = o + s >> 1) - 1] || null, r = t[i], !a) return {
							lo: null,
							hi: r
						};
						if (r[e] < n) o = i + 1;
						else {
							if (!(a[e] > n)) return {
								lo: a,
								hi: r
							};
							s = i - 1
						}
					}
					return {
						lo: r,
						hi: null
					}
				}(t, e, n),
					r = a.lo ? a.hi ? a.lo : t[t.length - 2] : t[0],
					o = a.lo ? a.hi ? a.hi : t[t.length - 1] : t[1],
					s = o[e] - r[e],
					l = s ? (n - r[e]) / s : 0,
					u = (o[i] - r[i]) * l;
				return r[i] + u
			}

			function M(t, e) {
				var n = e.parser,
					i = e.parser || e.format;
				return "function" == typeof n ? n(t) : "string" == typeof t && "string" == typeof i ? y(t, i) : (t instanceof y || (t = y(t)), t.isValid() ? t : "function" == typeof i ? i(t) : t)
			}

			function S(t, e) {
				if (p.isNullOrUndef(t)) return null;
				var n = e.options.time,
					i = M(e.getRightValue(t), n);
				return i.isValid() ? (n.round && i.startOf(n.round), i.valueOf()) : null
			}

			function D(t) {
				for (var e = _.indexOf(t) + 1, n = _.length; e < n; ++e)
					if (x[_[e]].common) return _[e]
			}

			function C(t, e, n, i) {
				var a, r = i.time,
					o = r.unit || function (t, e, n, i) {
						var a, r, o, s = _.length;
						for (a = _.indexOf(t); a < s - 1; ++a)
							if (o = (r = x[_[a]]).steps ? r.steps[r.steps.length - 1] : v, r.common && Math.ceil((n - e) / (o * r.size)) <= i) return _[a];
						return _[s - 1]
					}(r.minUnit, t, e, n),
					s = D(o),
					l = p.valueOrDefault(r.stepSize, r.unitStepSize),
					u = "week" === o && r.isoWeekday,
					d = i.ticks.major.enabled,
					h = x[o],
					c = y(t),
					f = y(e),
					g = [];
				for (l || (l = function (t, e, n, i) {
					var a, r, o, s = e - t,
						l = x[n],
						u = l.size,
						d = l.steps;
					if (!d) return Math.ceil(s / (i * u));
					for (a = 0, r = d.length; a < r && (o = d[a], !(Math.ceil(s / (u * o)) <= i)); ++a);
					return o
				}(t, e, o, n)), u && (c = c.isoWeekday(u), f = f.isoWeekday(u)), c = c.startOf(u ? "day" : o), (f = f.startOf(u ? "day" : o)) < e && f.add(1, o), a = y(c), d && s && !u && !r.round && (a.startOf(s), a.add(~~((c - a) / (h.size * l)) * l, o)); a < f; a.add(l, o)) g.push(+a);
				return g.push(+a), g
			}
			e.exports = function () {
				var t = i.extend({
					initialize: function () {
						if (!y) throw new Error("Chart.js - Moment.js could not be found! You must include it before Chart.js to use the time scale. Download at https://momentjs.com");
						this.mergeTicksOptions(), i.prototype.initialize.call(this)
					},
					update: function () {
						var t = this.options;
						return t.time && t.time.format && console.warn("options.time.format is deprecated and replaced by options.time.parser."), i.prototype.update.apply(this, arguments)
					},
					getRightValue: function (t) {
						return t && void 0 !== t.t && (t = t.t), i.prototype.getRightValue.call(this, t)
					},
					determineDataLimits: function () {
						var t, e, n, i, a, r, o = this,
							s = o.chart,
							l = o.options.time,
							u = l.unit || "day",
							d = v,
							h = m,
							c = [],
							f = [],
							g = [];
						for (t = 0, n = s.data.labels.length; t < n; ++t) g.push(S(s.data.labels[t], o));
						for (t = 0, n = (s.data.datasets || []).length; t < n; ++t)
							if (s.isDatasetVisible(t))
								if (a = s.data.datasets[t].data, p.isObject(a[0]))
									for (f[t] = [], e = 0, i = a.length; e < i; ++e) r = S(a[e], o), c.push(r), f[t][e] = r;
								else c.push.apply(c, g), f[t] = g.slice(0);
							else f[t] = [];
						g.length && (g = k(g).sort(b), d = Math.min(d, g[0]), h = Math.max(h, g[g.length - 1])), c.length && (c = k(c).sort(b), d = Math.min(d, c[0]), h = Math.max(h, c[c.length - 1])), d = S(l.min, o) || d, h = S(l.max, o) || h, d = d === v ? +y().startOf(u) : d, h = h === m ? +y().endOf(u) + 1 : h, o.min = Math.min(d, h), o.max = Math.max(d + 1, h), o._horizontal = o.isHorizontal(), o._table = [], o._timestamps = {
							data: c,
							datasets: f,
							labels: g
						}
					},
					buildTicks: function () {
						var t, e, n, i, a, r, o, s, l, u, d, h, c = this,
							f = c.min,
							g = c.max,
							m = c.options,
							p = m.time,
							v = [],
							b = [];
						switch (m.ticks.source) {
							case "data":
								v = c._timestamps.data;
								break;
							case "labels":
								v = c._timestamps.labels;
								break;
							case "auto":
							default:
								v = C(f, g, c.getLabelCapacity(f), m)
						}
						for ("ticks" === m.bounds && v.length && (f = v[0], g = v[v.length - 1]), f = S(p.min, c) || f, g = S(p.max, c) || g, t = 0, e = v.length; t < e; ++t) f <= (n = v[t]) && n <= g && b.push(n);
						return c.min = f, c.max = g, c._unit = p.unit || function (t, e, n, i) {
							var a, r, o = y.duration(y(i).diff(y(n)));
							for (a = _.length - 1; a >= _.indexOf(e); a--)
								if (r = _[a], x[r].common && o.as(r) >= t.length) return r;
							return _[e ? _.indexOf(e) : 0]
						}(b, p.minUnit, c.min, c.max), c._majorUnit = D(c._unit), c._table = function (t, e, n, i) {
							if ("linear" === i || !t.length) return [{
								time: e,
								pos: 0
							}, {
								time: n,
								pos: 1
							}];
							var a, r, o, s, l, u = [],
								d = [e];
							for (a = 0, r = t.length; a < r; ++a) e < (s = t[a]) && s < n && d.push(s);
							for (d.push(n), a = 0, r = d.length; a < r; ++a) l = d[a + 1], o = d[a - 1], s = d[a], void 0 !== o && void 0 !== l && Math.round((l + o) / 2) === s || u.push({
								time: s,
								pos: a / (r - 1)
							});
							return u
						}(c._timestamps.data, f, g, m.distribution), c._offsets = (i = c._table, a = b, r = f, o = g, h = d = 0, (s = m).offset && a.length && (s.time.min || (l = 1 < a.length ? a[1] : o, u = a[0], d = (w(i, "time", l, "pos") - w(i, "time", u, "pos")) / 2), s.time.max || (l = a[a.length - 1], u = 1 < a.length ? a[a.length - 2] : r, h = (w(i, "time", l, "pos") - w(i, "time", u, "pos")) / 2)), {
							left: d,
							right: h
						}), c._labelFormat = function (t, e) {
							var n, i, a, r = t.length;
							for (n = 0; n < r; n++) {
								if (0 !== (i = M(t[n], e)).millisecond()) return "MMM D, YYYY h:mm:ss.SSS a";
								0 === i.second() && 0 === i.minute() && 0 === i.hour() || (a = !0)
							}
							return a ? "MMM D, YYYY h:mm:ss a" : "MMM D, YYYY"
						}(c._timestamps.data, p),
							function (t, e) {
								var n, i, a, r, o = [];
								for (n = 0, i = t.length; n < i; ++n) a = t[n], r = !!e && a === +y(a).startOf(e), o.push({
									value: a,
									major: r
								});
								return o
							}(b, c._majorUnit)
					},
					getLabelForIndex: function (t, e) {
						var n = this.chart.data,
							i = this.options.time,
							a = n.labels && t < n.labels.length ? n.labels[t] : "",
							r = n.datasets[e].data[t];
						return p.isObject(r) && (a = this.getRightValue(r)), i.tooltipFormat ? M(a, i).format(i.tooltipFormat) : "string" == typeof a ? a : M(a, i).format(this._labelFormat)
					},
					tickFormatFunction: function (t, e, n, i) {
						var a = this.options,
							r = t.valueOf(),
							o = a.time.displayFormats,
							s = o[this._unit],
							l = this._majorUnit,
							u = o[l],
							d = t.clone().startOf(l).valueOf(),
							h = a.ticks.major,
							c = h.enabled && l && u && r === d,
							f = t.format(i || (c ? u : s)),
							g = c ? h : a.ticks.minor,
							m = p.valueOrDefault(g.callback, g.userCallback);
						return m ? m(f, e, n) : f
					},
					convertTicksToLabels: function (t) {
						var e, n, i = [];
						for (e = 0, n = t.length; e < n; ++e) i.push(this.tickFormatFunction(y(t[e].value), e, t));
						return i
					},
					getPixelForOffset: function (t) {
						var e = this,
							n = e._horizontal ? e.width : e.height,
							i = e._horizontal ? e.left : e.top,
							a = w(e._table, "time", t, "pos");
						return i + n * (e._offsets.left + a) / (e._offsets.left + 1 + e._offsets.right)
					},
					getPixelForValue: function (t, e, n) {
						var i = null;
						if (void 0 !== e && void 0 !== n && (i = this._timestamps.datasets[n][e]), null === i && (i = S(t, this)), null !== i) return this.getPixelForOffset(i)
					},
					getPixelForTick: function (t) {
						var e = this.getTicks();
						return 0 <= t && t < e.length ? this.getPixelForOffset(e[t].value) : null
					},
					getValueForPixel: function (t) {
						var e = this,
							n = e._horizontal ? e.width : e.height,
							i = e._horizontal ? e.left : e.top,
							a = (n ? (t - i) / n : 0) * (e._offsets.left + 1 + e._offsets.left) - e._offsets.right,
							r = w(e._table, "pos", a, "time");
						return y(r)
					},
					getLabelWidth: function (t) {
						var e = this.options.ticks,
							n = this.ctx.measureText(t).width,
							i = p.toRadians(e.maxRotation),
							a = Math.cos(i),
							r = Math.sin(i);
						return n * a + p.valueOrDefault(e.fontSize, o.global.defaultFontSize) * r
					},
					getLabelCapacity: function (t) {
						var e = this.options.time.displayFormats.millisecond,
							n = this.tickFormatFunction(y(t), 0, [], e),
							i = this.getLabelWidth(n),
							a = this.isHorizontal() ? this.width : this.height,
							r = Math.floor(a / i);
						return 0 < r ? r : 1
					}
				});
				a.registerScaleType("time", t, {
					position: "bottom",
					distribution: "linear",
					bounds: "data",
					time: {
						parser: !1,
						format: !1,
						unit: !1,
						round: !1,
						displayFormat: !1,
						isoWeekday: !1,
						minUnit: "millisecond",
						displayFormats: {
							millisecond: "h:mm:ss.SSS a",
							second: "h:mm:ss a",
							minute: "h:mm a",
							hour: "hA",
							day: "MMM D",
							week: "ll",
							month: "MMM YYYY",
							quarter: "[Q]Q - YYYY",
							year: "YYYY"
						}
					},
					ticks: {
						autoSkip: !1,
						source: "auto",
						major: {
							enabled: !1
						}
					}
				})
			}
		}, {
			26: 26,
			33: 33,
			34: 34,
			46: 46,
			6: 6
		}]
	}, {}, [7])(7)
});