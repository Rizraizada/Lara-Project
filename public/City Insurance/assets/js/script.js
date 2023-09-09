/* -----------------------------------------------------------------------------



File:           JS Core
Version:        1.0
Last change:    00/00/00 
-------------------------------------------------------------------------------- */
(function() {

	"use strict";

	var Insurin = {
		init: function() {
			this.Basic.init();  
		},

		Basic: {
			init: function() {

				this.preloader();
				this.BackgroundImage();
				this.Animation();
				this.StickyHeader();
				this.MobileMenu();
				this.searchPopUp();
				this.scrollTop();
				this.counterUp();
				this.BannerOne();
				this.SliderTwo();
				this.bannerParalax();
				this.CircleProgress();
				this.TestimonialSlider1();
				this.SponsorSlider1();
				this.BlogSilder();
				this.ServiceSLider();
				this.ProjectFilterJS();
				this.PortfolioSlider();
				this.PortfolioSlider3();
				this.TestimonialSlider2();
				this.TestimonialSlider3();
				this.InTeamCarouselSlider();
				this.TestimonialSlider33();
				this.Serviceslider4();
				this.TeamSliderTwo();
				this.SkillProgress();
				this.MainSliderSix();
				this.TextScroll();
				this.LimitRange();
				this.PriceRangeHandle();
				this.ServiceSVSlider();
				this.SponsorSVSlider();
				this.ServiceSVSlider2();
				this.ServiceSVSlider3();
				this.TestimonialSVSlider();
				this.TeamSVSlider();
				this.BlogSVSlider();
				
				
				
			},
			preloader: function (){
				jQuery(window).on('load', function(){
					jQuery('#preloader').fadeOut('slow',function(){jQuery(this).remove();});
				})
			},
			BackgroundImage: function (){
				$('[data-background]').each(function() {
					$(this).css('background-image', 'url('+ $(this).attr('data-background') + ')');
				});
				$(document).ready(function() {
					$('.in-select select').niceSelect();
				});
			},
			Animation: function (){
				if($('.wow').length){
					var wow = new WOW(
					{
						boxClass:     'wow',
						animateClass: 'animated',
						offset:       0,
						mobile:       true,
						live:         true
					}
					);
					wow.init();
				}
			},
			StickyHeader: function (){
				jQuery(window).on('scroll', function() {
					if (jQuery(window).scrollTop() > 250) {
						jQuery('.in-header-section').addClass('sticky-on')
					} else {
						jQuery('.in-header-section').removeClass('sticky-on')
					}
				});
				jQuery(document).ready(function (o) {
					0 < o(".navSidebar-button").length &&
					o(".navSidebar-button").on("click", function (e) {
						e.preventDefault(), e.stopPropagation(), o(".info-group").addClass("isActive");
					}),
					0 < o(".close-side-widget").length &&
					o(".close-side-widget").on("click", function (e) {
						e.preventDefault(), o(".info-group").removeClass("isActive");
					}),
					o(".xs-sidebar-widget").on("click", function (e) {
						e.stopPropagation();
					})
				});
				
			},
			MobileMenu: function (){
				$('.open_mobile_menu').on("click", function() {
					$('.mobile_menu_wrap').toggleClass("mobile_menu_on");
				});
				$('.open_mobile_menu').on('click', function () {
					$('body').toggleClass('mobile_menu_overlay_on');
				});
				if($('.mobile_menu li.dropdown ul').length){
					$('.mobile_menu li.dropdown').append('<div class="dropdown-btn"><span class="far fa-arrow-right"></span></div>');
					$('.mobile_menu li.dropdown .dropdown-btn').on('click', function() {
						$(this).prev('ul').slideToggle(500);
					});
				}
				$(".dropdown-btn").on("click", function () {
					$(this).toggleClass("toggle-open");
				});
			},
			scrollTop: function (){
				$(window).on("scroll", function() {
					if ($(this).scrollTop() > 200) {
						$('.scrollup').fadeIn();
					} else {
						$('.scrollup').fadeOut();
					}
				});

				$('.scrollup').on("click", function()  {
					$("html, body").animate({
						scrollTop: 0
					}, 800);
					return false;
				});
				jQuery('.video_box').magnificPopup({
					disableOn: 200,
					type: 'iframe',
					mainClass: 'mfp-fade',
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false,
				});
				$('.zoom-gallery').magnificPopup({
					delegate: 'a',
					type: 'image',
					closeOnContentClick: false,
					closeBtnInside: false,
					mainClass: 'mfp-with-zoom mfp-img-mobile',
					gallery: {
						enabled: true
					},
					zoom: {
						enabled: true,
						duration: 300, 
						opener: function(element) {
							return element.find('img');
						}
					}
				});
			},
			counterUp: function (){
				$('.counter').counterUp({
					delay: 15,
					time: 1500,
				});
			},
			searchPopUp: function (){
				$('.search-btn').on('click', function() {
					$('.search-body').toggleClass('search-open');
				});
			},
			ProjectFilterJS: function (){
				var $grid = $('.grid').imagesLoaded( function() {
					$grid.masonry({
						percentPosition: true,
						itemSelector: '.grid-item',
						columnWidth: '.grid-sizer'
					}); 
				});
				var $grid = $(".grid").isotope({
					itemSelector: ".grid-item",
					layoutMode: "fitRows"
				});
				var filterFns = {
					numberGreaterThan50: function() {
						var number = $(this)
						.find(".number")
						.text();
						return parseInt(number, 10) > 50;
					},
					ium: function() {
						var name = $(this)
						.find(".name")
						.text();
						return name.match(/ium$/);
					}
				};
				$(".button-group").on("click", "button", function() {
					var filterValue = $(this).attr("data-filter");
					filterValue = filterFns[filterValue] || filterValue;
					$grid.isotope({ filter: filterValue });
				});

				$(".button-group").each(function(i, buttonGroup) {
					var $buttonGroup = $(buttonGroup);
					$buttonGroup.on("click", "button", function() {
						$buttonGroup.find(".is-checked").removeClass("is-checked");
						$(this).addClass("is-checked");
					});
				});
			},
			SliderTwo: function (){
				var	tpj = jQuery;
				if(window.RS_MODULES === undefined) window.RS_MODULES = {};
				if(RS_MODULES.modules === undefined) RS_MODULES.modules = {};
				RS_MODULES.modules["revslider141"] = {once: RS_MODULES.modules["revslider141"]!==undefined ? RS_MODULES.modules["revslider141"].once : undefined, init:function() {
					window.revapi14 = window.revapi14===undefined || window.revapi14===null || window.revapi14.length===0  ? document.getElementById("rev_slider_14_1") : window.revapi14;
					if(window.revapi14 === null || window.revapi14 === undefined || window.revapi14.length==0) { window.revapi14initTry = window.revapi14initTry ===undefined ? 0 : window.revapi14initTry+1; if (window.revapi14initTry<20) requestAnimationFrame(function() {RS_MODULES.modules["revslider141"].init()}); return;}
					window.revapi14 = jQuery(window.revapi14);
					if(window.revapi14.revolution==undefined){ revslider_showDoubleJqueryError("rev_slider_14_1"); return;}
					revapi14.revolutionInit({
						revapi:"revapi14",
						DPR:"dpr",
						sliderLayout:"fullwidth",
						visibilityLevels:"1240,1024,778,480",
						gridwidth:"1170,1024,778,480",
						gridheight:"965,768,600,400",
						spinner:"spinner8",
						perspective:600,
						perspectiveType:"global",
						spinnerclr:"#0164eb",
						editorheight:"965,768,600,400",
						responsiveLevels:"1240,1024,778,480",
						progressBar:{disableProgressBar:true},
						navigation: {
							wheelCallDelay:1000,
							onHoverStop:false,
							arrows: {
								enable:true,
								tmp:"<div class=\"tp-title-wrap\">  	<div class=\"tp-arr-imgholder\"></div> </div>",
								style:"zeus",
								hide_onmobile:true,
								hide_under:"1024px",
								left: {
									h_offset:30
								},
								right: {
									h_offset:30
								}
							}
						},
						viewPort: {
							global:false,
							globalDist:"-200px",
							enable:false
						},
						fallbacks: {
							allowHTML5AutoPlayOnAndroid:true
						},
					});

				}} 

			},
			BannerOne: function (){
				var	tpj = jQuery;
					if(window.RS_MODULES === undefined) window.RS_MODULES = {};
					if(RS_MODULES.modules === undefined) RS_MODULES.modules = {};
					RS_MODULES.modules["revslider241"] = {once: RS_MODULES.modules["revslider241"]!==undefined ? RS_MODULES.modules["revslider241"].once : undefined, init:function() {
						window.revapi24 = window.revapi24===undefined || window.revapi24===null || window.revapi24.length===0  ? document.getElementById("rev_slider_24_1") : window.revapi24;
						if(window.revapi24 === null || window.revapi24 === undefined || window.revapi24.length==0) { window.revapi24initTry = window.revapi24initTry ===undefined ? 0 : window.revapi24initTry+1; if (window.revapi24initTry<20) requestAnimationFrame(function() {RS_MODULES.modules["revslider241"].init()}); return;}
						window.revapi24 = jQuery(window.revapi24);
						if(window.revapi24.revolution==undefined){ revslider_showDoubleJqueryError("rev_slider_24_1"); return;}
						revapi24.revolutionInit({
								revapi:"revapi24",
								DPR:"dpr",
								sliderLayout:"fullwidth",
								visibilityLevels:"1240,1024,778,480",
								gridwidth:"1170,1024,778,480",
								gridheight:"810,690,520,350",
								spinner:"spinner3",
								perspective:600,
								perspectiveType:"global",
								editorheight:"810,690,520,350",
								responsiveLevels:"1240,1024,778,480",
								progressBar:{disableProgressBar:true},
								navigation: {
									onHoverStop:false
								},
								parallax: {
									levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,30],
									type:"scroll",
									origo:"slidercenter",
									speed:0
								},
								scrolleffect: {
									set:true,
									multiplicator:1.3,
									multiplicator_layers:1.3
								},
								sbtimeline: {
									set:true,
									ease:"power3.inOut"
								},
								viewPort: {
									global:false,
									globalDist:"-200px",
									enable:false
								},
								fallbacks: {
									allowHTML5AutoPlayOnAndroid:true
								},
						});
						
					}} 
					if (window.RS_MODULES.checkMinimal!==undefined) { window.RS_MODULES.checkMinimal();};
					var	tpj = jQuery;
					if(window.RS_MODULES === undefined) window.RS_MODULES = {};
					if(RS_MODULES.modules === undefined) RS_MODULES.modules = {};
					RS_MODULES.modules["revslider151"] = {once: RS_MODULES.modules["revslider151"]!==undefined ? RS_MODULES.modules["revslider151"].once : undefined, init:function() {
						window.revapi15 = window.revapi15===undefined || window.revapi15===null || window.revapi15.length===0  ? document.getElementById("rev_slider_15_1") : window.revapi15;
						if(window.revapi15 === null || window.revapi15 === undefined || window.revapi15.length==0) { window.revapi15initTry = window.revapi15initTry ===undefined ? 0 : window.revapi15initTry+1; if (window.revapi15initTry<20) requestAnimationFrame(function() {RS_MODULES.modules["revslider151"].init()}); return;}
						window.revapi15 = jQuery(window.revapi15);
						if(window.revapi15.revolution==undefined){ revslider_showDoubleJqueryError("rev_slider_15_1"); return;}
						revapi15.revolutionInit({
								revapi:"revapi15",
								DPR:"dpr",
								sliderLayout:"fullwidth",
								visibilityLevels:"1240,1024,778,480",
								gridwidth:"1170,1024,778,480",
								gridheight:"800,700,650,450",
								perspective:600,
								perspectiveType:"global",
								editorheight:"800,700,650,450",
								responsiveLevels:"1240,1024,778,480",
								progressBar:{disableProgressBar:true},
								navigation: {
									wheelCallDelay:1000,
									onHoverStop:false,
									arrows: {
										enable:true,
										tmp:"<div class=\"tp-title-wrap\">  	<div class=\"tp-arr-imgholder\"></div> </div>",
										style:"zeus",
										left: {
											v_align:"bottom",
											h_offset:60,
											v_offset:60
										},
										right: {
											v_align:"bottom",
											h_offset:60,
											v_offset:60
										}
									}
								},
								parallax: {
									levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,30],
									type:"scroll",
									origo:"slidercenter",
									speed:0
								},
								viewPort: {
									global:false,
									globalDist:"-200px",
									enable:false
								},
								fallbacks: {
									allowHTML5AutoPlayOnAndroid:true
								},
						});
						
					}} 
					if (window.RS_MODULES.checkMinimal!==undefined) { window.RS_MODULES.checkMinimal();};
			},
			bannerParalax: function (){
				jQuery('.jarallax').jarallax({
					speed: 0.5,
				});
			},
			CircleProgress: function (){
				if($('.count-box').length){
					$('.count-box').appear_c(function(){
						var $t = $(this),
						n = $t.find(".count-text").attr("data-stop"),
						r = parseInt($t.find(".count-text").attr("data-speed"), 10);
						if (!$t.hasClass("counted")) {
							$t.addClass("counted");
							$({
								countNum: $t.find(".count-text").text()
							}).animate({
								countNum: n
							}, {
								duration: r,
								easing: "linear",
								step: function() {
									$t.find(".count-text").text(Math.floor(this.countNum));
								},
								complete: function() {
									$t.find(".count-text").text(this.countNum);
								}
							});
						}
					},{accY: 0});
				};
				if($('.dial').length){
					$('.dial').appear_c(function(){
						var elm = $(this);
						var color = elm.attr('data-fgColor');  
						var perc = elm.attr('value'); 
						var thickness = elm.attr('thickness');  
						elm.knob({ 
							'value': 0, 
							'min':0,
							'max':100,
							'skin':'tron',
							'readOnly':true,
							'thickness': .25,
							'dynamicDraw': true,
							'displayInput':false
						});
						$({value: 0}).animate({ value: perc }, {
							duration: 4500,
							easing: 'swing',
							progress: function () { elm.val(Math.ceil(this.value)).trigger('change');
						}
					});
					},{accY: 0});
				}
			},
			TestimonialSlider1: function (){
				$('.in-testimonial-slider').slick({
					arrow: false,
					dots: true,
					slidesToShow: 1,
					autoplay: false,
					slidesToScroll: 1,
				});
				$('.in-testimonial-slider-4').slick({
					arrow: false,
					dots: true,
					slidesToShow: 1,
					autoplay: false,
					slidesToScroll: 1,
				});
			},
			MainSliderSix: function (){
				$('.ins-slider-area-six').slick({
					arrow: false,
					dots: true,
					slidesToShow: 1,
					fade: true,
					autoplay: false,
					slidesToScroll: 1,
					prevArrow: ".main-left_arrow",
					nextArrow: ".main-right_arrow",
				});
				var	tpj = jQuery;
				if(window.RS_MODULES === undefined) window.RS_MODULES = {};
				if(RS_MODULES.modules === undefined) RS_MODULES.modules = {};
				RS_MODULES.modules["revslider201"] = {once: RS_MODULES.modules["revslider201"]!==undefined ? RS_MODULES.modules["revslider201"].once : undefined, init:function() {
					window.revapi20 = window.revapi20===undefined || window.revapi20===null || window.revapi20.length===0  ? document.getElementById("rev_slider_20_1") : window.revapi20;
					if(window.revapi20 === null || window.revapi20 === undefined || window.revapi20.length==0) { window.revapi20initTry = window.revapi20initTry ===undefined ? 0 : window.revapi20initTry+1; if (window.revapi20initTry<20) requestAnimationFrame(function() {RS_MODULES.modules["revslider201"].init()}); return;}
					window.revapi20 = jQuery(window.revapi20);
					if(window.revapi20.revolution==undefined){ revslider_showDoubleJqueryError("rev_slider_20_1"); return;}
					revapi20.revolutionInit({
						revapi:"revapi20",
						DPR:"dpr",
						visibilityLevels:"1240,1024,778,480",
						gridwidth:"1300,1024,778,480",
						gridheight:"540,540,500,280",
						maxHeight:"540px",
						perspective:600,
						perspectiveType:"global",
						editorheight:"540,540,500,280",
						responsiveLevels:"1240,1024,778,480",
						progressBar:{disableProgressBar:true},
						navigation: {
							wheelCallDelay:1000,
							onHoverStop:false,
							bullets: {
								enable:true,
								tmp:"",
								style:"hermes",
								h_align:"right",
								h_offset:30,
								v_offset:30,
								container:"layergrid"
							}
						},
						viewPort: {
							global:false,
							globalDist:"-200px",
							enable:false
						},
						fallbacks: {
							allowHTML5AutoPlayOnAndroid:true
						},
					});

				}} 
				if (window.RS_MODULES.checkMinimal!==undefined) { window.RS_MODULES.checkMinimal();};
				var	tpj = jQuery;
				if(window.RS_MODULES === undefined) window.RS_MODULES = {};
				if(RS_MODULES.modules === undefined) RS_MODULES.modules = {};
				RS_MODULES.modules["revslider211"] = {once: RS_MODULES.modules["revslider211"]!==undefined ? RS_MODULES.modules["revslider211"].once : undefined, init:function() {
					window.revapi21 = window.revapi21===undefined || window.revapi21===null || window.revapi21.length===0  ? document.getElementById("rev_slider_21_1") : window.revapi21;
					if(window.revapi21 === null || window.revapi21 === undefined || window.revapi21.length==0) { window.revapi21initTry = window.revapi21initTry ===undefined ? 0 : window.revapi21initTry+1; if (window.revapi21initTry<20) requestAnimationFrame(function() {RS_MODULES.modules["revslider211"].init()}); return;}
					window.revapi21 = jQuery(window.revapi21);
					if(window.revapi21.revolution==undefined){ revslider_showDoubleJqueryError("rev_slider_21_1"); return;}
					revapi21.revolutionInit({
						revapi:"revapi21",
						DPR:"dpr",
						sliderLayout:"fullwidth",
						visibilityLevels:"1240,1024,778,480",
						gridwidth:"950,1024,778,480",
						gridheight:"960,960,700,380",
						perspective:600,
						perspectiveType:"global",
						editorheight:"960,960,700,380",
						responsiveLevels:"1240,1024,778,480",
						progressBar:{disableProgressBar:true},
						navigation: {
							wheelCallDelay:1000,
							onHoverStop:false,
							bullets: {
								enable:true,
								tmp:"",
								style:"hephaistos",
								h_align:"left",
								v_align:"center",
								h_offset:15,
								v_offset:0,
								direction:"vertical",
								space:10
							}
						},
						viewPort: {
							global:false,
							globalDist:"-200px",
							enable:false
						},
						fallbacks: {
							allowHTML5AutoPlayOnAndroid:true
						},
					});
					
				}}
				if (window.RS_MODULES.checkMinimal!==undefined) { window.RS_MODULES.checkMinimal();};
				var	tpj = jQuery;
				if(window.RS_MODULES === undefined) window.RS_MODULES = {};
				if(RS_MODULES.modules === undefined) RS_MODULES.modules = {};
				RS_MODULES.modules["revslider231"] = {once: RS_MODULES.modules["revslider231"]!==undefined ? RS_MODULES.modules["revslider231"].once : undefined, init:function() {
					window.revapi23 = window.revapi23===undefined || window.revapi23===null || window.revapi23.length===0  ? document.getElementById("rev_slider_23_1") : window.revapi23;
					if(window.revapi23 === null || window.revapi23 === undefined || window.revapi23.length==0) { window.revapi23initTry = window.revapi23initTry ===undefined ? 0 : window.revapi23initTry+1; if (window.revapi23initTry<20) requestAnimationFrame(function() {RS_MODULES.modules["revslider231"].init()}); return;}
					window.revapi23 = jQuery(window.revapi23);
					if(window.revapi23.revolution==undefined){ revslider_showDoubleJqueryError("rev_slider_23_1"); return;}
					revapi23.revolutionInit({
						revapi:"revapi23",
						DPR:"dpr",
						sliderLayout:"fullwidth",
						visibilityLevels:"1240,1024,778,480",
						gridwidth:"1170,1024,778,480",
						gridheight:"960,768,680,500",
						perspective:600,
						perspectiveType:"global",
						editorheight:"960,768,680,500",
						responsiveLevels:"1240,1024,778,480",
						progressBar:{disableProgressBar:true},
						navigation: {
							wheelCallDelay:1000,
							onHoverStop:false,
							arrows: {
								enable:true,
								style:"custom",
								hide_onmobile:true,
								hide_under:778,
								left: {
									container:"layergrid",
									h_align:"right",
									v_align:"bottom",
									h_offset:-40
								},
								right: {
									container:"layergrid",
									v_align:"bottom",
									h_offset:-40,
									v_offset:45
								}
							}
						},
						viewPort: {
							global:false,
							globalDist:"-200px",
							enable:false
						},
						fallbacks: {
							allowHTML5AutoPlayOnAndroid:true
						},
					});

				}}
				if (window.RS_MODULES.checkMinimal!==undefined) { window.RS_MODULES.checkMinimal();};
			},
			TestimonialSlider2: function (){
				$('.in-team-slider').slick({
					arrow: true,
					dots: false,
					slidesToShow: 1,
					infinite: false,
					autoplay: false,
					slidesToScroll: 1,
					prevArrow: ".team_left_arrow",
					nextArrow: ".team_right_arrow",
				});
				$('.ins-testimonial-slider-for').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
					asNavFor: '.ins-testimonial-slider-nav'
				});
				$('.ins-testimonial-slider-nav').slick({
					slidesToShow: 3,
					slidesToScroll: 1,
					infinite: true,
					vertical:true,
					asNavFor: '.ins-testimonial-slider-for',
					dots: false,
					focusOnSelect: true,
					responsive: [
					{
						breakpoint: 770,
						settings: {
							vertical: false,
						}
					},
					]
				});
			},
			TestimonialSlider33: function (){
				$('.in-testimonial-slider-2').slick({
					arrow: true,
					dots: false,
					slidesToShow: 1,
					autoplay: false,
					infinite: false,
					slidesToScroll: 1,
					prevArrow: ".testi_left_arrow",
					nextArrow: ".testi_right_arrow",
				});
			},
			SponsorSlider1: function (){
				$('.in-sponsor-slider').slick({
					arrow: false,
					dots: false,
					loop: true,
					infinite: true,
					slidesToShow: 5,
					autoplay: true,
					slidesToScroll: 1,
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 5,
							slidesToScroll: 1,
							infinite: true,
						}
					},
					{
						breakpoint: 1000,
						settings: {
							slidesToShow: 4,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 800,
						settings: {
							slidesToShow: 4,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					}

					]
				});
				$('.ins-sponsor-slider').slick({
					arrow: false,
					dots: false,
					loop: true,
					infinite: true,
					slidesToShow: 6,
					autoplay: true,
					slidesToScroll: 1,
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 5,
							slidesToScroll: 1,
							infinite: true,
						}
					},
					{
						breakpoint: 1000,
						settings: {
							slidesToShow: 4,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 800,
						settings: {
							slidesToShow: 4,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					}

					]
				});
				$('.ins-sponsor-slider-six').slick({
					arrow: false,
					dots: false,
					loop: true,
					infinite: true,
					slidesToShow: 6,
					autoplay: true,
					slidesToScroll: 1,
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 5,
							slidesToScroll: 1,
							infinite: true,
						}
					},
					{
						breakpoint: 1000,
						settings: {
							slidesToShow: 4,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 800,
						settings: {
							slidesToShow: 4,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					}

					]
				});
			},
			BlogSilder: function (){
				$('.in-blog-slide').slick({
					arrow: false,
					dots: true,
					loop: true,
					infinite: true,
					slidesToShow: 3,
					autoplay: true,
					slidesToScroll: 1,
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: false,
						}
					},
					{
						breakpoint: 1000,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 800,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}

					]
				});
			},
			TestimonialSlider3: function (){
				$('.in-testimonial-slider-3').slick({
					arrow: false,
					dots: true,
					loop: true,
					infinite: true,
					slidesToShow: 3,
					autoplay: true,
					slidesToScroll: 1,
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: false,
						}
					},
					{
						breakpoint: 1000,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 800,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}

					]
				});
			},
			InTeamCarouselSlider: function (){
				$('.in-team-carousel-slider').slick({
					arrow: false,
					dots: true,
					loop: true,
					infinite: true,
					slidesToShow: 3,
					autoplay: true,
					slidesToScroll: 1,
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: false,
						}
					},
					{
						breakpoint: 1000,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 800,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}

					]
				});
			},
			Serviceslider4: function (){
				$('.in-service-vertical-slider').slick({
					arrow: false,
					dots: true,
					loop: true,
					infinite: true,
					slidesToShow: 3,
					autoplay: true,
					vertical: true,
					slidesToScroll: 2,
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 2,
							infinite: false,
						}
					},
					{
						breakpoint: 1000,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 800,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}

					]
				});
			},
			ServiceSLider: function (){
				$('.in-service-slider').slick({
					arrow: false,
					dots: false,
					loop: true,
					infinite: true,
					autoplaySpeed: 2000,
					slidesToShow: 3,
					autoplay: true,
					slidesToScroll: 1,
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: false,
						}
					},
					{
						breakpoint: 1000,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 800,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint:  600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}

					]
				});
			},
			PortfolioSlider3: function (){
				$('.in-portfolio-slider-3').slick({
					arrow: false,
					dots: false,
					loop: true,
					infinite: true,
					slidesToShow: 4,
					autoplay: true,
					slidesToScroll: 1,
					responsive: [
					{
						breakpoint: 1600,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: false,
						}
					},
					{
						breakpoint: 1100,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							infinite: false,
						}
					},
					{
						breakpoint: 1000,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 800,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint:  600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}

					]
				});
			},
			PortfolioSlider: function (){
				$('.in-portfolio-slider-2').slick({
					arrow: false,
					dots: true,
					infinite: false,
					slidesToShow: 4,
					slidesToScroll: 1,
					variableWidth: true,
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							infinite: true,
						}
					},
					{
						breakpoint: 1000,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 800,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							variableWidth: false,
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							variableWidth: false,
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							variableWidth: false,
						}
					},
					{
						breakpoint: 400,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							variableWidth: false,
						}
					},
					{
						breakpoint: 300,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							variableWidth: false,
						}
					}

					]
				});
				$('.in-portfolio-slider-2_1').slick({
					arrow: false,
					dots: true,
					infinite: false,
					slidesToShow: 5,
					slidesToScroll: 1,
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 4,
							slidesToScroll: 1,
							infinite: true,
						}
					},
					{
						breakpoint: 1000,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 800,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							variableWidth: false,
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
							variableWidth: false,
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							variableWidth: false,
						}
					},
					{
						breakpoint: 400,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							variableWidth: false,
						}
					},
					{
						breakpoint: 300,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							variableWidth: false,
						}
					}

					]
				});
			},
			TeamSliderTwo: function (){
				$('.in-team-slider-2').slick({
					arrow: false,
					dots: true,
					loop: true,
					infinite: false,
					slidesToShow: 2,
					autoplay: false,
					slidesToScroll: 1,
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: false,
						}
					},
					{
						breakpoint: 1000,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 800,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}

					]
				});
			},
			SkillProgress: function (){
				if ($(".progress-bar").length) {
					var $progress_bar = $('.progress-bar');
					$progress_bar.appear();
					$(document.body).on('appear', '.progress-bar', function() {
						var current_item = $(this);
						if (!current_item.hasClass('appeared')) {
							var percent = current_item.data('percent');
							current_item.css('width', percent + '%').addClass('appeared').parent().append('<span>' + percent + '%' + '</span>');
						}
						
					});
				};
				if($('.quantity-input-2').length) {
					$('.quantity-input-2').inputarrow({
						renderNext: function(input) {
							return $('<span class="custom-next">+</span>').insertAfter(input);
						},
						renderPrev: function(input) {
							return $('<span class="custom-prev">-</span>').insertBefore(input);
						},
						disabledClassName: 'custom-disabled'
					});
				};
			},
			TextScroll: function (){
				$('.ins-text-scroll').marquee({
					speed: 50,
					gap: 20,
					delayBeforeStart: 0,
					direction: 'left',
					duplicated: true,
					pauseOnHover: true,
					startVisible:true,
				});
				$('.ins-text-scroll-2').marquee({
					speed: 70,
					gap: 20,
					delayBeforeStart: 0,
					direction: 'right',
					duplicated: true,
					pauseOnHover: true,
					startVisible:true,
				});
				$('.ins-limit-img-scroll').marquee({
					speed: 10,
					gap: 20,
					delayBeforeStart: 0,
					direction: 'right',
					duplicated: true,
					pauseOnHover: true,
					startVisible:true,
				});
				$('.category-scroll').marquee({
					speed: 70,
					gap: 20,
					delayBeforeStart: 0,
					direction: 'up',
					duplicated: true,
					pauseOnHover: true,
					startVisible:true,
				});
				$('.ins-feature-scroll-item-area1').marquee({
					speed: 30,
					gap: 20,
					delayBeforeStart: 0,
					direction: 'left',
					duplicated: true,
					pauseOnHover: true,
					startVisible:true,
				});
				$('.ins-feature-scroll-item-area2').marquee({
					speed: 30,
					gap: 20,
					delayBeforeStart: 0,
					direction: 'right',
					duplicated: true,
					pauseOnHover: true,
					startVisible:true,
				});
				$('.ins-testimonial-scroller-six').marquee({
					speed: 30,
					gap: 20,
					delayBeforeStart: 0,
					direction: 'left',
					duplicated: true,
					pauseOnHover: true,
					startVisible:true,
				});
			},
			LimitRange: function (){$("#slider").roundSlider({
				sliderType: "min-range",
				width: 10,
				radius: 280,
				startAngle: 330,
				endAngle: "+240",
				animation: false,

				svgMode: true,
				pathColor: "#E4E4E4",
				rangeColor: "#056251",
				borderWidth: 0,
				handleSize: "+30",
				handleShape: "dot",
				handleColor: "#FFB966",
				tooltipColor: "inherit",
				value: 40
			});
			$("#slider_2").roundSlider({
				sliderType: "min-range",
				width: 10,
				radius: 280,
				startAngle: 330,
				endAngle: "+240",
				animation: false,

				svgMode: true,
				pathColor: "#E4E4E4",
				rangeColor: "#056251",
				borderWidth: 0,
				handleSize: "+30",
				handleShape: "dot",
				handleColor: "#FFB966",
				tooltipColor: "inherit",
				value: 50
			});
			$("#slide_3").roundSlider({
				sliderType: "min-range",
				width: 10,
				radius: 280,
				startAngle: 330,
				endAngle: "+240",
				animation: false,

				svgMode: true,
				pathColor: "#E4E4E4",
				rangeColor: "#056251",
				borderWidth: 0,
				handleSize: "+30",
				handleShape: "dot",
				handleColor: "#FFB966",
				tooltipColor: "inherit",
				value: 30
			});
			$("#slider_4").roundSlider({
				sliderType: "min-range",
				width: 10,
				radius: 280,
				startAngle: 330,
				endAngle: "+240",
				animation: false,

				svgMode: true,
				pathColor: "#E4E4E4",
				rangeColor: "#056251",
				borderWidth: 0,
				handleSize: "+30",
				handleShape: "dot",
				handleColor: "#FFB966",
				tooltipColor: "inherit",
				value: 60
			});

		},
		PriceRangeHandle: function (){
			if ($("#slider-range").length) {
				$( "#slider-range" ).slider({
					range: true,
					min: 0,
					max: 3000,
					values: [ 0, 1500 ],
					slide: function( event, ui ) {
						$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
					}
				});
			};
			if ($("#amount").length) {
				$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
					" - $" + $( "#slider-range" ).slider( "values", 1 ) );
			};
			$('.q-count').prop('disabled', true);
			$(document).on('click','.plus',function(){
				$('.q-count').val(parseInt($('.q-count').val()) + 1 );
			});
			$(document).on('click','.minus',function(){
				$('.q-count').val(parseInt($('.q-count').val()) - 1 );
				if ($('.q-count').val() == 0) {
					$('.q-count').val(1);
				}
			});
		},
		ServiceSVSlider: function (){
			$('.in-sv-service-slider').slick({
				arrow: false,
				dots: true,
				loop: true,
				infinite: true,
				slidesToShow: 4,
				autoplay: false,
				slidesToScroll: 1,
				variableWidth: true,
				prevArrow: ".ser_sv_left_arrow",
				nextArrow: ".ser_sv_right_arrow",
				responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						infinite: false,
					}
				},
				{
					breakpoint: 1000,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 800,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 500,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}

				]
			});
			var ltn__active_item = $('.in-sv-insurance-type-item')
			ltn__active_item.mouseover(function() {
				ltn__active_item.removeClass('active');
				$(this).addClass('active');
			});
},
		SponsorSVSlider: function (){
			$('.in-sv-sponsor-slider').slick({
				arrow: false,
				dots: false,
				loop: true,
				infinite: true,
				slidesToShow: 4,
				autoplay: true,
				slidesToScroll: 1,
				responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1,
						infinite: true,
					}
				},
				{
					breakpoint: 1000,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 800,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 500,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}

				]
			});
		},
		SkillProgress: function (){
			if ($(".progress-bar").length) {
				var $progress_bar = $('.progress-bar');
				$progress_bar.appear();
				$(document.body).on('appear', '.progress-bar', function() {
					var current_item = $(this);
					if (!current_item.hasClass('appeared')) {
						var percent = current_item.data('percent');
						current_item.css('width', percent + '%').addClass('appeared').parent().append('<span>' + percent + '%' + '</span>');
					}

				});
			};
		},
		ServiceSVSlider2: function (){
			$('.in-sv-service-slider-2').slick({
				arrow: true,
				dots: false,
				loop: true,
				infinite: true,
				slidesToShow: 4,
				autoplay: false,
				slidesToScroll: 1,
				prevArrow: ".ser_sv_left_arrow_2",
				nextArrow: ".ser_sv_right_arrow_2",
				responsive: [
				{
					breakpoint: 1210,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						infinite: false,
					}
				},
				{
					breakpoint: 1000,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 800,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 500,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					}
				}

				]
			});
		},
		ServiceSVSlider3: function (){
			$('.in-sv-service-slider-3').slick({
				arrow: true,
				dots: false,
				loop: true,
				infinite: false,
				slidesToShow: 4,
				autoplay: true,
				slidesToScroll: 1,
				variableWidth: true,
				responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						infinite: false,
					}
				},
				{
					breakpoint: 1000,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 800,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 500,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}

				]
			});
		},
		TestimonialSVSlider: function (){
			$('.in-sv-team-testimonial-slider').slick({
				arrow: false,
				dots: true,
				loop: true,
				infinite: true,
				slidesToShow: 1,
				autoplay: false,
				slidesToScroll: 1,
			});
		},
		TeamSVSlider: function (){
			$('.in-sv-team-slider').slick({
				arrow: true,
				dots: false,
				loop: false,
				infinite: false,
				slidesToShow: 3,
				autoplay: false,
				slidesToScroll: 1,
				variableWidth: true,
				prevArrow: ".team_sv_left_arrow_2",
				nextArrow: ".team_sv_right_arrow_2",
				responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						infinite: false,
					}
				},
				{
					breakpoint: 1000,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 800,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						variableWidth: false,
					}
				},
				{
					breakpoint: 500,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						variableWidth: false,
					}
				}

				]
			});
		},
		BlogSVSlider: function (){
			$('.in-sv-blog-slider').slick({
				arrow: true,
				dots: false,
				loop: false,
				infinite: false,
				slidesToShow: 3,
				autoplay: false,
				slidesToScroll: 1,
				prevArrow: ".blg_sv_left_arrow_2",
				nextArrow: ".blg_sv_right_arrow_2",
				responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						infinite: false,
					}
				},
				{
					breakpoint: 1000,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 800,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 500,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}

				]
			});
		},
	}
}
jQuery(document).ready(function (){
	Insurin.init();
});

})();