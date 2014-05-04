function cs(param){console.log((param == undefined)?"Here":param);}
function wait(time, statement){setTimeout(function(){statement()},time);}

(function($){
    $.fn.extend({

        petalHanlder:function(){
            var coverCoord = {w:$('#cover').outerWidth(true),h:$('#cover').outerHeight(true)},
                currentCoord = {x:0,y:0},
                lastCoord = {x:0,y:0},
                timeUnit = 300,


                getPos = function(){
                    lastCoord.x = currentCoord.x;
                    lastCoord.y = currentCoord.y;
                    wait(timeUnit,function(){
                        getPos();
                    });
                },

                hit = function(petalCoord,coord){
                    var newCoord = {};
                    var dist = Math.sqrt(Math.pow(coord.x - lastCoord.x,2) + Math.pow(coord.y - lastCoord.y,2));
                    newCoord.x = -(lastCoord.x - coord.x) + petalCoord.left;
                    newCoord.y = -(lastCoord.y - coord.y) + petalCoord.top;

                    newCoord.x = (newCoord.x < 0)? 0 : newCoord.x > coverCoord.w ? coverCoord.w - 200 : newCoord.x;
                    newCoord.y = (newCoord.y < 0)? 0 : newCoord.y > coverCoord.h ? coverCoord.h - 200 : newCoord.y;

                    newCoord.speed = dist / timeUnit * 2;

                    return newCoord;
                };


            return this.each(function(){
                getPos();
                var canvas = $(this);
                canvas.mousemove(function(e){
                    currentCoord.x = e.pageX;
                    currentCoord.y = e.pageY;
                }).find('.flying-elt').mouseenter(function(e){
                    var thePetal = $(this),
                        coord = hit(thePetal.offset() , {x:e.pageX,y:e.pageY});

                    TweenLite.to(thePetal, coord.speed, {top:coord.y,left:coord.x,ease:"CircIn"});
                });
            });
        },

        documentationRequest:function(){
            return this.each(function() {
                var self = $(this),
                    trigger = self.children('p'),
                    optionsWrapper = self.find('.wpcf7-list-item');

                    trigger.on('click', function(event) {
                        event.preventDefault();
                        $(this).toggleClass('active').siblings('div').slideToggle(300);
                    });

                    optionsWrapper.on('click', function(event) {
                        event.preventDefault();
                        var wrapper = $(this);

                        wrapper.children('span').toggleClass('active')
                            .siblings('input').prop('checked', function(){
                                return wrapper.children('input').prop('checked') ? false : true;
                            });
                    });
            });
        },

        numberOnly:function(){
            return this.each(function() {
                var self = $(this);

                self.on('keyup', function() {

                    var reg = /^\d+$/;
                    if(reg.test(self.val())){
                        self.removeClass('wrong');
                    } else {
                        self.addClass('wrong');
                    };

                    if(self.val().length === 0){
                        self.removeClass('wrong');
                    }

                });


            });
        },

        slider:function(){

            return this.each(function(){
                var self = $(this).addClass('ui-slider'),
                    slidesWrapper = self.find('.slides-wrapper');

                self.update = function(index){
                    var shift = -(index * $(self).width()),
                        item = $($(this).find('.slider-menu>li')[index]).addClass('active'),
                        pxShifted = item.offset().left + (item.width()/2)-7;

                        // 100*200/2000

                    item.siblings().removeClass('active');
                    slidesWrapper.animate({marginLeft:shift},800);
                    this.find('.slider-menu-selector').css({marginLeft:(pxShifted * 100 / parseInt($(window).width())) + '%'});

                    if(parseInt($(window).width()) > 960){
                        self.find('.slider-controller').show();
                        if(index == 0){
                            self.find('.slider-controller-prev').hide();
                        }
                        if(index == slidesWrapper.children().length -1){
                            self.find('.slider-controller-next').hide();
                        }
                    }
                    return this;
                }

                self.update(0).find('.slider-menu>li').on('click',function(){
                    self.update($(this).index());
                });

                self.find('.slider-controller').on('click',function(e){
                    var menuItems = self.find('.slider-menu>li'),
                        index = menuItems.filter('.active').index()+1;

                    index = ($(this).hasClass('slider-controller-prev'))?index-2:index;
                    index = (index >= menuItems.length)?0:index;
                    index = (index < 0)?menuItems.length-1:index;
                    self.update(index);
                    e.preventDefault();
                });
            });
        },

        portraitsCoWorkers:function(){
            return this.each(function() {
                var self = $(this),
                    controllers = self.find('.slider-controller'),
                    sliderWrapper = self.find('#co-workers-portraits');
                    controllers.first().hide();
                    if(sliderWrapper.children().length == 1){
                        controllers.hide();
                    }

                    controllers.on('click', function(e) {
                        e.preventDefault();
                        var firstSlide = sliderWrapper.children(':first'),
                            shift = firstSlide.width(),
                            indexCurrent = sliderWrapper.children('.active').index();

                        if($(e.target).hasClass('slider-controller-next')){
                                indexCurrent++;
                                controllers.show();
                                if(indexCurrent < sliderWrapper.children().length) {
                                    controllers.filter('.slider-controller-next').hide();
                                }
                        } else {
                            controllers.show();
                            if(indexCurrent != 0) {
                                indexCurrent--;
                            } else {
                                controllers.filter('.slider-controller-prev').hide();
                            }
                        }
                        sliderWrapper.children().first().animate({marginLeft:-shift*indexCurrent}, 500);
                    });
            });
        },

        portraits:function(){

            return this.each(function(){
                var self = $(this),
                    portraitsImg = self.find('.portraits-list > li'),
                    portraitsDesc = self.find('.portraits-desc-list > div');

                portraitsImg.on('mouseenter',function(){
                    var index = $(this).index();
                    portraitsDesc.eq(index).addClass('active').siblings().removeClass('active');
                });
            });
        },

        officeContentSlider:function(){
            return this.each(function(){
                var self = $(this),
                    parent = self.parent(),
                    maxColHeight = parent.siblings().height(),
                    subHeight = parent.children('h4').outerHeight() + 65,
                    totalContentHeight = self.children().height(),
                    lectureHeight = maxColHeight - subHeight,
                    controllerNb = (totalContentHeight - (totalContentHeight % lectureHeight)) / lectureHeight +1,
                    sliderController = $('<ul>').addClass('office-content-controller-wrapper');

                    for (var i = controllerNb - 1; i >= 0; i--) {
                        sliderController.prepend($('<li>').addClass(i == 0?'active':'').on('click', function(e) {
                            e.preventDefault();
                            var shift = lectureHeight * $(this).index() - 20;
                            $(this).addClass('active').siblings().removeClass('active');
                            self.children().css({marginTop:-( shift )});
                        }));
                    };
                    self.after(sliderController).height(lectureHeight);
            });
        },

        fixMenu:function(){


            return this.each(function(){
                var self = $(this),
                    menuItem = self.find('a.anchor'),
                    offsetTop = self.offset().top;

                self.on('click',function(){
                    if(parseInt($(window).width()) < 960){
                        self.toggleClass('active');
                    }
                })
                $(window).on('scroll', function(){
                    if(parseInt($(window).width()) > 960){
                        var scrollTop = $(this).scrollTop();


                        menuItem.each(function(){
                            var theItem = $(this);

                            if(scrollTop + 50 > $(theItem.attr('href')).offset().top){
                                menuItem.removeClass('active');
                                theItem.addClass('active');
                            }
                        });

                        if(scrollTop + 100 < $(menuItem.eq(0).attr('href')).offset().top){
                            menuItem.removeClass('active');
                        }

                        if(scrollTop > (offsetTop - 50)){
                            self.addClass('fix-menu');
                        } else {
                            self.removeClass('fix-menu');
                        };

                    }
                })

            });
        },

        contactMsg:function(){


            return this.each(function(){
                $(this).on({
                    focus:function(){
                        if($(this).val() == 'BONJOUR, ...'){
                            $(this).val('BONJOUR, \n\n');
                        }
                    },
                    blur:function() {
                        if($(this).val() == 'BONJOUR, \n\n'){
                            $(this).val('BONJOUR, ...');
                        }
                    }
                });
            });
        }

    });
})(jQuery);



$(document).ready(function(){
    var self = $(this),

        resize = function(e){
            var header = $('header'),
                titleWrapper = header.find('#site-title-wrapper'),
                squareWidth = titleWrapper.height();
            titleWrapper.width(squareWidth).css({left:($(window).width()-squareWidth)/2});
            self.find('.page.fixed-height').css('height', (parseInt($(window).width()) > 960)?  $(window).height() : 'auto');
            self.find('.ui-max-width').width($(window).width());
            self.width(800);

            $('.title-underline').each(function(){
                $(this).css({'margin-left':($(this).parent().width()-80)/2})
            })

            if(parseInt($(window).width()) < 960){
                $('.slides-wrapper').css('margin-left',0);
                $('.co-workers-portraits-slide').css('margin-left','auto');
                $('.slider-controller').hide();
            } else {
                $('.slider-controller.active').show();
            }
        },


        init = function(callaback){
            $(window).on('load ready resize',function(e){
                resize();

                if(e.type == 'load'){
                    callaback();
                }
            }).on('scroll',function(e) {
                e.preventDefault();
                if(self.scrollLeft() !== 0){
                    self.scrollLeft(0);
                };
            })

        };

    init(function(){
        self.find('#loader').fadeOut('300', function() {
           $(this).remove();
           $('body').removeClass('loading');
        });

        // self.find('#office-content-wrapper').officeContentSlider();
        self.find('#co-workers').portraitsCoWorkers();
        self.find('#petals-canvas').petalHanlder();
        self.find('.slider-wrapper').slider();
        // self.find('.portraits').portraits();
        self.find('textarea').contactMsg();
        self.find('[name=phone]').numberOnly();
        self.find('#documentationRequest').documentationRequest();

        self.find('nav').fixMenu().find('a.anchor').click(function(e) {
            e.preventDefault();
            var theLink = $(this);
            self.find('body').animate({scrollTop: $(theLink.attr('href')).offset().top}, 1300);
        });
        setTimeout(function() {
            resize();
            $('#contact').height('auto');
            slideCabinet($('#office-content'));
        }, 1000);
    });
    for(var i = 0;i < $('.rounded img').length;i++){
        round($('.rounded img')[i]);
    }
    function round(el){
        if($(el).width() > $(el).height()){
            $(el).css({'height':$(el).parent().parent().height(),'width':($(el).parent().parent().height()*$(el).width()/$(el).parent().parent().width())});
        }else{
            $(el).css({'width':$(el).parent().parent().width()});
        }
    }
    function slideCabinet(el){
        var count = 141,
        itter = 0;
        var slide = {};
        var facteur = 1;
        slide[0] = '';
        for (var i = 0 ; i < $(el).children().length; i++) {
            if ($(el.children()[i])[0].tagName.toLowerCase() == 'ul') {
                facteur = 3;
            }else{
                facteur = 1;
            }
            if(count < $(window).height()/10*8 && $(window).height()/10*8 > (($(el.children()[i]).height()*facteur) + count + 15) ){
                count += $(el.children()[i]).height()*facteur + 15;
                slide[itter] += '' + $(el).children()[i].outerHTML ;
            }else{
                count = $(el.children()[i]).height()*facteur + 15 + 141;
                itter += 1;
                slide[itter] = '';
                slide[itter] += '' + $(el).children()[i].outerHTML ;
            }
        };
        for (k in slide) {
            var slideIt = '<div class="slide">'+ slide[k] +'</div>';
            $('#cabinet-slides').append(slideIt);
        }
        $('#office-content').css({'display':'none'});
        sliderController = $('<ul>').addClass('office-content-controller-wrapper');
        for (var i = itter ; i >= 0; i--) {
            sliderController.prepend($('<li>').addClass(i == 0?'active':'').on('click', function(e) {
                e.preventDefault();
                var index = $(this).index()+1;
                $('#cabinet-slides .slide').fadeOut(400);
                $('#cabinet-slides .slide:nth-child('+index+')').delay(400).fadeIn(400);
                $(this).addClass('active').siblings().removeClass('active');
            }));
        };
        $('#cabinet-slides').after(sliderController);
    }
    $('.title-underline').each(function(){
        $(this).css({'margin-left':($(this).parent().width()-80)/2})
    })
});