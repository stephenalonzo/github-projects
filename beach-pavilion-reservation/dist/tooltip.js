/*
 Copyright (C) Federico Zivolo 2019
 Distributed under the MIT License (license terms are at http://opensource.org/licenses/MIT).
 */
 import a from '../../../assets/js/popper.min.js';

 function b(a) {
     return a && '[object Function]' === {}.toString.call(a)
 }
 var c = Object.assign || function (a) {
     for (var b, c = 1; c < arguments.length; c++)
         for (var d in b = arguments[c], b) Object.prototype.hasOwnProperty.call(b, d) && (a[d] = b[d]);
     return a
 };
 const d = {
     container: !1,
     delay: 0,
     html: !1,
     placement: 'top',
     title: '',
     template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
     trigger: 'hover focus',
     offset: 0,
     arrowSelector: '.tooltip-arrow, .tooltip__arrow',
     innerSelector: '.tooltip-inner, .tooltip__inner'
 };
 class e {
     constructor(a, b) {
         f.call(this), b = c({}, d, b), a.jquery && (a = a[0]), this.reference = a, this.options = b;
         const e = 'string' == typeof b.trigger ? b.trigger.split(' ').filter((a) => -1 !== ['click', 'hover', 'focus'].indexOf(a)) : [];
         this._isOpen = !1, this._popperOptions = {}, this._setEventListeners(a, e, b)
     }
     _create(a, b, c, d) {
         const e = window.document.createElement('div');
         e.innerHTML = b.trim();
         const f = e.childNodes[0];
         f.id = `tooltip_${Math.random().toString(36).substr(2,10)}`, f.setAttribute('aria-hidden', 'false');
         const g = e.querySelector(this.options.innerSelector);
         return this._addTitleContent(a, c, d, g), f
     }
     _addTitleContent(a, c, d, e) {
         1 === c.nodeType || 11 === c.nodeType ? d && e.appendChild(c) : b(c) ? this._addTitleContent(a, c.call(a), d, e) : d ? e.innerHTML = c : e.textContent = c
     }
     _show(b, d) {
         if (this._isOpen && !this._isOpening) return this;
         if (this._isOpen = !0, this._tooltipNode) return this._tooltipNode.style.visibility = 'visible', this._tooltipNode.setAttribute('aria-hidden', 'false'), this.popperInstance.update(), this;
         const e = b.getAttribute('title') || d.title;
         if (!e) return this;
         const f = this._create(b, d.template, e, d.html);
         b.setAttribute('aria-describedby', f.id);
         const g = this._findContainer(d.container, b);
         return this._append(f, g), this._popperOptions = c({}, d.popperOptions, {
             placement: d.placement
         }), this._popperOptions.modifiers = c({}, this._popperOptions.modifiers, {
             arrow: c({}, this._popperOptions.modifiers && this._popperOptions.modifiers.arrow, {
                 element: d.arrowSelector
             }),
             offset: c({}, this._popperOptions.modifiers && this._popperOptions.modifiers.offset, {
                 offset: d.offset || this._popperOptions.modifiers && this._popperOptions.modifiers.offset && this._popperOptions.modifiers.offset.offset || d.offset
             })
         }), d.boundariesElement && (this._popperOptions.modifiers.preventOverflow = {
             boundariesElement: d.boundariesElement
         }), this.popperInstance = new a(b, f, this._popperOptions), this._tooltipNode = f, this
     }
     _hide() {
         return this._isOpen ? (this._isOpen = !1, this._tooltipNode.style.visibility = 'hidden', this._tooltipNode.setAttribute('aria-hidden', 'true'), this) : this
     }
     _dispose() {
         return this._events.forEach(({
             func: a,
             event: b
         }) => {
             this.reference.removeEventListener(b, a)
         }), this._events = [], this._tooltipNode && (this._hide(), this.popperInstance.destroy(), !this.popperInstance.options.removeOnDestroy && (this._tooltipNode.parentNode.removeChild(this._tooltipNode), this._tooltipNode = null)), this
     }
     _findContainer(a, b) {
         return 'string' == typeof a ? a = window.document.querySelector(a) : !1 === a && (a = b.parentNode), a
     }
     _append(a, b) {
         b.appendChild(a)
     }
     _setEventListeners(a, b, c) {
         const d = [],
             e = [];
         b.forEach((a) => {
             'hover' === a ? (d.push('mouseenter'), e.push('mouseleave')) : 'focus' === a ? (d.push('focus'), e.push('blur')) : 'click' === a ? (d.push('click'), e.push('click')) : void 0
         }), d.forEach((b) => {
             const d = (b) => {
                 !0 === this._isOpening || (b.usedByTooltip = !0, this._scheduleShow(a, c.delay, c, b))
             };
             this._events.push({
                 event: b,
                 func: d
             }), a.addEventListener(b, d)
         }), e.forEach((b) => {
             const d = (b) => {
                 !0 === b.usedByTooltip || this._scheduleHide(a, c.delay, c, b)
             };
             this._events.push({
                 event: b,
                 func: d
             }), a.addEventListener(b, d), 'click' === b && c.closeOnClickOutside && document.addEventListener('mousedown', (b) => {
                 if (this._isOpening) {
                     const c = this.popperInstance.popper;
                     a.contains(b.target) || c.contains(b.target) || d(b)
                 }
             }, !0)
         })
     }
     _scheduleShow(a, b, c) {
         this._isOpening = !0;
         const d = b && b.show || b || 0;
         this._showTimeout = window.setTimeout(() => this._show(a, c), d)
     }
     _scheduleHide(a, b, c, d) {
         this._isOpening = !1;
         const e = b && b.hide || b || 0;
         window.clearTimeout(this._showTimeout), window.setTimeout(() => {
             if (!1 !== this._isOpen && document.body.contains(this._tooltipNode)) {
                 if ('mouseleave' === d.type) {
                     const e = this._setTooltipNodeEvent(d, a, b, c);
                     if (e) return
                 }
                 this._hide(a, c)
             }
         }, e)
     }
     _updateTitleContent(a) {
         if ('undefined' == typeof this._tooltipNode) return void('undefined' != typeof this.options.title && (this.options.title = a));
         const b = this._tooltipNode.querySelector(this.options.innerSelector);
         this._clearTitleContent(b, this.options.html, this.reference.getAttribute('title') || this.options.title), this._addTitleContent(this.reference, a, this.options.html, b), this.options.title = a, this.popperInstance.update()
     }
     _clearTitleContent(a, b, c) {
         1 === c.nodeType || 11 === c.nodeType ? b && a.removeChild(c) : b ? a.innerHTML = '' : a.textContent = ''
     }
 }
 var f = function () {
     this.show = () => this._show(this.reference, this.options), this.hide = () => this._hide(), this.dispose = () => this._dispose(), this.toggle = () => this._isOpen ? this.hide() : this.show(), this.updateTitleContent = (a) => this._updateTitleContent(a), this._events = [], this._setTooltipNodeEvent = (a, b, c, d) => {
         const e = a.relatedreference || a.toElement || a.relatedTarget,
             f = (c) => {
                 const e = c.relatedreference || c.toElement || c.relatedTarget;
                 this._tooltipNode.removeEventListener(a.type, f), b.contains(e) || this._scheduleHide(b, d.delay, d, c)
             };
         return !!this._tooltipNode.contains(e) && (this._tooltipNode.addEventListener(a.type, f), !0)
     }
 };
 export default e;
 //# sourceMappingURL=tooltip.min.js.map