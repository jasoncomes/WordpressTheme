/*!
Waypoints - 4.0.0
Copyright © 2011-2015 Caleb Troughton
Licensed under the MIT license.
https://github.com/imakewebthings/waypoints/blob/master/licenses.txt
*/
!function(){"use strict";function t(o){if(!o)throw new Error("No options passed to Waypoint constructor");if(!o.element)throw new Error("No element option passed to Waypoint constructor");if(!o.handler)throw new Error("No handler option passed to Waypoint constructor");this.key="waypoint-"+e,this.options=t.Adapter.extend({},t.defaults,o),this.element=this.options.element,this.adapter=new t.Adapter(this.element),this.callback=o.handler,this.axis=this.options.horizontal?"horizontal":"vertical",this.enabled=this.options.enabled,this.triggerPoint=null,this.group=t.Group.findOrCreate({name:this.options.group,axis:this.axis}),this.context=t.Context.findOrCreateByElement(this.options.context),t.offsetAliases[this.options.offset]&&(this.options.offset=t.offsetAliases[this.options.offset]),this.group.add(this),this.context.add(this),i[this.key]=this,e+=1}var e=0,i={};t.prototype.queueTrigger=function(t){this.group.queueTrigger(this,t)},t.prototype.trigger=function(t){this.enabled&&this.callback&&this.callback.apply(this,t)},t.prototype.destroy=function(){this.context.remove(this),this.group.remove(this),delete i[this.key]},t.prototype.disable=function(){return this.enabled=!1,this},t.prototype.enable=function(){return this.context.refresh(),this.enabled=!0,this},t.prototype.next=function(){return this.group.next(this)},t.prototype.previous=function(){return this.group.previous(this)},t.invokeAll=function(t){var e=[];for(var o in i)e.push(i[o]);for(var n=0,r=e.length;r>n;n++)e[n][t]()},t.destroyAll=function(){t.invokeAll("destroy")},t.disableAll=function(){t.invokeAll("disable")},t.enableAll=function(){t.invokeAll("enable")},t.refreshAll=function(){t.Context.refreshAll()},t.viewportHeight=function(){return window.innerHeight||document.documentElement.clientHeight},t.viewportWidth=function(){return document.documentElement.clientWidth},t.adapters=[],t.defaults={context:window,continuous:!0,enabled:!0,group:"default",horizontal:!1,offset:0},t.offsetAliases={"bottom-in-view":function(){return this.context.innerHeight()-this.adapter.outerHeight()},"right-in-view":function(){return this.context.innerWidth()-this.adapter.outerWidth()}},window.Waypoint=t}(),function(){"use strict";function t(t){window.setTimeout(t,1e3/60)}function e(t){this.element=t,this.Adapter=n.Adapter,this.adapter=new this.Adapter(t),this.key="waypoint-context-"+i,this.didScroll=!1,this.didResize=!1,this.oldScroll={x:this.adapter.scrollLeft(),y:this.adapter.scrollTop()},this.waypoints={vertical:{},horizontal:{}},t.waypointContextKey=this.key,o[t.waypointContextKey]=this,i+=1,this.createThrottledScrollHandler(),this.createThrottledResizeHandler()}var i=0,o={},n=window.Waypoint,r=window.onload;e.prototype.add=function(t){var e=t.options.horizontal?"horizontal":"vertical";this.waypoints[e][t.key]=t,this.refresh()},e.prototype.checkEmpty=function(){var t=this.Adapter.isEmptyObject(this.waypoints.horizontal),e=this.Adapter.isEmptyObject(this.waypoints.vertical);t&&e&&(this.adapter.off(".waypoints"),delete o[this.key])},e.prototype.createThrottledResizeHandler=function(){function t(){e.handleResize(),e.didResize=!1}var e=this;this.adapter.on("resize.waypoints",function(){e.didResize||(e.didResize=!0,n.requestAnimationFrame(t))})},e.prototype.createThrottledScrollHandler=function(){function t(){e.handleScroll(),e.didScroll=!1}var e=this;this.adapter.on("scroll.waypoints",function(){(!e.didScroll||n.isTouch)&&(e.didScroll=!0,n.requestAnimationFrame(t))})},e.prototype.handleResize=function(){n.Context.refreshAll()},e.prototype.handleScroll=function(){var t={},e={horizontal:{newScroll:this.adapter.scrollLeft(),oldScroll:this.oldScroll.x,forward:"right",backward:"left"},vertical:{newScroll:this.adapter.scrollTop(),oldScroll:this.oldScroll.y,forward:"down",backward:"up"}};for(var i in e){var o=e[i],n=o.newScroll>o.oldScroll,r=n?o.forward:o.backward;for(var s in this.waypoints[i]){var a=this.waypoints[i][s],l=o.oldScroll<a.triggerPoint,h=o.newScroll>=a.triggerPoint,p=l&&h,u=!l&&!h;(p||u)&&(a.queueTrigger(r),t[a.group.id]=a.group)}}for(var c in t)t[c].flushTriggers();this.oldScroll={x:e.horizontal.newScroll,y:e.vertical.newScroll}},e.prototype.innerHeight=function(){return this.element==this.element.window?n.viewportHeight():this.adapter.innerHeight()},e.prototype.remove=function(t){delete this.waypoints[t.axis][t.key],this.checkEmpty()},e.prototype.innerWidth=function(){return this.element==this.element.window?n.viewportWidth():this.adapter.innerWidth()},e.prototype.destroy=function(){var t=[];for(var e in this.waypoints)for(var i in this.waypoints[e])t.push(this.waypoints[e][i]);for(var o=0,n=t.length;n>o;o++)t[o].destroy()},e.prototype.refresh=function(){var t,e=this.element==this.element.window,i=e?void 0:this.adapter.offset(),o={};this.handleScroll(),t={horizontal:{contextOffset:e?0:i.left,contextScroll:e?0:this.oldScroll.x,contextDimension:this.innerWidth(),oldScroll:this.oldScroll.x,forward:"right",backward:"left",offsetProp:"left"},vertical:{contextOffset:e?0:i.top,contextScroll:e?0:this.oldScroll.y,contextDimension:this.innerHeight(),oldScroll:this.oldScroll.y,forward:"down",backward:"up",offsetProp:"top"}};for(var r in t){var s=t[r];for(var a in this.waypoints[r]){var l,h,p,u,c,d=this.waypoints[r][a],f=d.options.offset,w=d.triggerPoint,y=0,g=null==w;d.element!==d.element.window&&(y=d.adapter.offset()[s.offsetProp]),"function"==typeof f?f=f.apply(d):"string"==typeof f&&(f=parseFloat(f),d.options.offset.indexOf("%")>-1&&(f=Math.ceil(s.contextDimension*f/100))),l=s.contextScroll-s.contextOffset,d.triggerPoint=y+l-f,h=w<s.oldScroll,p=d.triggerPoint>=s.oldScroll,u=h&&p,c=!h&&!p,!g&&u?(d.queueTrigger(s.backward),o[d.group.id]=d.group):!g&&c?(d.queueTrigger(s.forward),o[d.group.id]=d.group):g&&s.oldScroll>=d.triggerPoint&&(d.queueTrigger(s.forward),o[d.group.id]=d.group)}}return n.requestAnimationFrame(function(){for(var t in o)o[t].flushTriggers()}),this},e.findOrCreateByElement=function(t){return e.findByElement(t)||new e(t)},e.refreshAll=function(){for(var t in o)o[t].refresh()},e.findByElement=function(t){return o[t.waypointContextKey]},window.onload=function(){r&&r(),e.refreshAll()},n.requestAnimationFrame=function(e){var i=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||t;i.call(window,e)},n.Context=e}(),function(){"use strict";function t(t,e){return t.triggerPoint-e.triggerPoint}function e(t,e){return e.triggerPoint-t.triggerPoint}function i(t){this.name=t.name,this.axis=t.axis,this.id=this.name+"-"+this.axis,this.waypoints=[],this.clearTriggerQueues(),o[this.axis][this.name]=this}var o={vertical:{},horizontal:{}},n=window.Waypoint;i.prototype.add=function(t){this.waypoints.push(t)},i.prototype.clearTriggerQueues=function(){this.triggerQueues={up:[],down:[],left:[],right:[]}},i.prototype.flushTriggers=function(){for(var i in this.triggerQueues){var o=this.triggerQueues[i],n="up"===i||"left"===i;o.sort(n?e:t);for(var r=0,s=o.length;s>r;r+=1){var a=o[r];(a.options.continuous||r===o.length-1)&&a.trigger([i])}}this.clearTriggerQueues()},i.prototype.next=function(e){this.waypoints.sort(t);var i=n.Adapter.inArray(e,this.waypoints),o=i===this.waypoints.length-1;return o?null:this.waypoints[i+1]},i.prototype.previous=function(e){this.waypoints.sort(t);var i=n.Adapter.inArray(e,this.waypoints);return i?this.waypoints[i-1]:null},i.prototype.queueTrigger=function(t,e){this.triggerQueues[e].push(t)},i.prototype.remove=function(t){var e=n.Adapter.inArray(t,this.waypoints);e>-1&&this.waypoints.splice(e,1)},i.prototype.first=function(){return this.waypoints[0]},i.prototype.last=function(){return this.waypoints[this.waypoints.length-1]},i.findOrCreate=function(t){return o[t.axis][t.name]||new i(t)},n.Group=i}(),function(){"use strict";function t(t){this.$element=e(t)}var e=window.jQuery,i=window.Waypoint;e.each(["innerHeight","innerWidth","off","offset","on","outerHeight","outerWidth","scrollLeft","scrollTop"],function(e,i){t.prototype[i]=function(){var t=Array.prototype.slice.call(arguments);return this.$element[i].apply(this.$element,t)}}),e.each(["extend","inArray","isEmptyObject"],function(i,o){t[o]=e[o]}),i.adapters.push({name:"jquery",Adapter:t}),i.Adapter=t}(),function(){"use strict";function t(t){return function(){var i=[],o=arguments[0];return t.isFunction(arguments[0])&&(o=t.extend({},arguments[1]),o.handler=arguments[0]),this.each(function(){var n=t.extend({},o,{element:this});"string"==typeof n.context&&(n.context=t(this).closest(n.context)[0]),i.push(new e(n))}),i}}var e=window.Waypoint;window.jQuery&&(window.jQuery.fn.waypoint=t(window.jQuery)),window.Zepto&&(window.Zepto.fn.waypoint=t(window.Zepto))}();
/**
 * Collapsible List - Accordian, Horizontal Tab, Vertical Tab
 *
 */
(function($) {

  if ($('.collapsible').length) {

    // Open First Item for each list
    $('.collapsible').each(function() {

      var $definitionList = $(this);

      if (!$definitionList.find('.collapsible-title.is-active').length) {
        $definitionList.find('.collapsible-title').eq(0).addClass('is-active');
      }

    });

    // Expand/Collapse
    $('.collapsible').on('click', '.collapsible-title', function() {

      var $title = $(this);

      if ($title.parents('.collapsible').hasClass('type-accordion')) {
        $title.toggleClass('is-active');
      } else {
        $title.addClass('is-active').siblings('.collapsible-title').removeClass('is-active');
      }

    });

    // Expand All -- Accordion Style Only
    $('.js-collapsible-expand-all').on('click', function(ev) {

      ev.preventDefault();
      $(this).parents('.collapsible-controls')
        .next('.type-accordion')
        .find('.collapsible-title')
        .addClass('is-active');

    });

    // Collapse All -- Accordion Style Only
    $('.js-collapsible-collapse-all').on('click', function(ev) {

      ev.preventDefault();
      $(this).parents('.collapsible-controls')
        .next('.type-accordion')
        .find('.collapsible-title')
        .removeClass('is-active');

    });

  }

})(jQuery);
/**
 * Progress Bar
 */
(function($) {

  if ($('.progress-bar').length) {

    $(document).on('ready', function() {

      // Variables
      var $progressBar = $('.progress-bar'),
        max, value;

      // Progress Bar Build
      var progressBar = function() {
        var winHeight = $(window).height(),
          docHeight = $(document).height();

        max = docHeight - winHeight;
        value = $(window).scrollTop();
        $progressBar.attr('max', max);
        $progressBar.attr('value', value);
      };

      // Jump To On Click
      $($progressBar).click(function(ev) {
        var x = ev.pageX - $(this).offset().left;
        var clickedValue = x * this.max / this.offsetWidth;
        var jumpPosition = Math.floor(clickedValue);
        $('html, body').animate({scrollTop: jumpPosition}, 1000);
      });

      // Initial, Scroll & Window Resize Function Call
      progressBar();
      $(document).on('scroll', progressBar);
      $(window).on('resize', progressBar);

    });

  }

})(jQuery);
/**
 * Sub Navigation
 */
(function($) {

  // Sticky Navigation
  if ($('.nav-sticky').length) {

    $('.nav-sticky').waypoint({
      handler: function(direction) {
        if (direction == 'down') {
          $('body').addClass('is-active-sticky');
        } else {
          $('body').removeClass('is-active-sticky');
        }
      }
    });

  }

  // Subnavigation + Waypoints
  if ($('[data-waypoint]').length && $('.nav-sub').length) {

    $('[data-waypoint]').waypoint({
      handler: function(direction) {

        // Navigational Item
        var $navTrigger = $('[href="#' + $(this.element).attr('data-waypoint') + '"]');

        // Remove: Is Active
        $('.nav-sub a.is-active').removeClass('is-active');

        if (direction == 'down') {

          $navTrigger.addClass('is-active');
          $('.js-label').text($navTrigger.text());

        } else {

          // Previous: Navigational Item
          var $prevTrigger = $navTrigger.closest('li').prev('li').find('a');

          if ($prevTrigger.length) {
            $prevTrigger.addClass('is-active');
            $('.js-label').text($prevTrigger.text());
          } else {
            $('.js-label').text('Quickly View Page Content');
          }

        }

      },
      offset: $('.nav-sticky').height() + 15
    });

  }

})(jQuery);
/**
 * Tables - Add data-titles to table cells for mobile
 */
(function($) {

  // Content Tables Only.
  var $tables = $('.entry-content table');

  // Return if not correct window size or if no tables.
  if (!$tables.length) {
    return;
  }

  $tables.each(function(){
    var $table = $(this);
    var $thead = $table.find('thead');
    var $tbody = $table.find('tbody');
    var headText  = [];
    var headCount = 0;

    // Return if no header or body.
    if (!$thead.length || !$tbody.length) {
      return;
    }

    // Table class for styling(if applicable).
    $table.addClass('table-data');

    // th titles.
    $thead.find('th').each(function() {
      var $header = $(this);
      var $text   = $(this).text();
      var colspan = $header[0].hasAttribute('colspan') && $header.attr('colspan') > 1 ? $header.attr('colspan') : 0;

      // Header to array.
      headText[headCount] = $text;

      // th title colspans.
      if (colspan) {
        for (var j = 1; j < colspan; j++) {
          headCount++;
          headText[headCount] = $text;
        }
      }

      // Increment Count
      headCount++;
    });

    // td data attributes.
    $tbody.each(function() {
      $(this).find('tr').each(function() {
        var cellCount = 0;

        $(this).find('th, td').each(function(i) {
          var $cell   = $(this);
          var colspan = $cell[0].hasAttribute('colspan') && $cell.attr('colspan') > 1 ? $cell.attr('colspan') : 0;

          // Add header as data-title.
          $cell.attr('data-title', headText[cellCount]);

          // th title colspans.
          if (colspan) {
            var dataTitleCount = 1;

            for (var j = 1; j < colspan; j++) {
              dataTitleCount++;
              cellCount++;
              
              // If Same Title, skip
              if (headText[cellCount] == headText[cellCount - 1]) {
                dataTitleCount--;
                continue;
              }

              // Add additional titles.
              $cell.attr('data-title-' + dataTitleCount, headText[cellCount]);
            }
          }

          // Increment Count
          cellCount++;
        });
      });
    });

  });

})(jQuery);
/**
 * Triggers: JS Collapse All, JS Expand All, JS Toggle, JS Scroll to, etc
 */
(function($) {

  // Event: Collapse All in Collections
  $('body').on('click', '.js-collapse-all', function() {
    var $this = $(this);
    var $parent = $this.parents('.js-children-toggle');

    $this.text('Collapsed').prop('disabled', true);
    $this.siblings('.js-expand-all').text('Expand All').prop('disabled', false);
    $parent.removeClass('is-expanded-all').addClass('is-collapsed-all');
    $parent.find('.js-target').removeClass('is-active');
  });


  // Event: Expand All in Collections
  $('body').on('click', '.js-expand-all', function() {
    var $this = $(this);
    var $parent = $this.parents('.js-children-toggle');

    $this.text('Expanded').prop('disabled', true);
    $this.siblings('.js-collapse-all').text('Collapse All').prop('disabled', false);
    $parent.removeClass('is-collapsed-all').addClass('is-expanded-all');
    $parent.find('.js-target').addClass('is-active');
  });


  // Event: JS Toggle
  $('body').on('click', '.js-toggle', function() {
    var $this = $(this);

    // If toggles body class using data-bodyclass
    if ($this.attr('data-bodyclass')) {
      $('body').toggleClass($this.data('bodyclass'));
    }

    // Toggle closest .js-target
    $this.closest('.js-target').toggleClass('is-active');
  });


  // Event: Scroll To
  var jumpTo = function(waypoint) {
    var id = waypoint.substr(1);
    var $waypoint = $('#' + id).length ? $('#' + id) : $('[data-waypoint="' + id + '"]');

    if ($waypoint.length) {
      $('body').removeClass('is-active-subnav');
      $('html, body').animate({ scrollTop: $waypoint.offset().top - ($('.nav-sticky-fixed').height() + 15) }, 1000);
    }
  }


  // Existing Hash
  if (window.location.hash.length !== 0) {
    jumpTo(window.location.hash);
  }


  // Scroll To Click
  $('body').on('click', 'a[href^="#"]', function() {
    jumpTo($(this).attr('href'));
  });


  // Event: Sub Navigation - Mouse Leave Trigger
  $('.js-rollout-subnav').on('mouseleave', function() {
    $('body').removeClass('is-active-subnav');
  });


  // Event: Mobile Submenu Children
  $('html').on('click', '.is-active-mobile .menu-item-has-children > a', function(ev) {
    ev.preventDefault();
    $(this).parent('.menu-item-has-children').toggleClass('is-active');
  });

})(jQuery);


/**
 * Rankings Heights
 */
(function($) {

  if ($('.rankings').length) {

    var $ranking_rows = $('.rankings .title');

    // Set Ranking Heights
    var setRankHeights = function() {
      $ranking_rows.each(function(index) {
        var maxHeight = Math.max.apply(null, $(this).map(function() { return $(this).outerHeight(); }).get());
        $(this).siblings().not('.content').outerHeight(maxHeight);
      });
    };

    // Initial & Window Resize Function Call
    setRankHeights();
    $(window).on('resize', setRankHeights);

  }

})(jQuery);

