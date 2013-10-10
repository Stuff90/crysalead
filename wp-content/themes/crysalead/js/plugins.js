function cs(param){console.log((param == undefined)?"Here":param);}
function wait(time, statement){setTimeout(function(){statement()},time);}

(function($){
    $.fn.extend({

        petalHanlder:function(){
            var currentCoord = {x:0,y:0};
            var lastCoord = {x:0,y:0};
            var timeUnit = 300;

            var getPos = function(){
                lastCoord.x = currentCoord.x;
                lastCoord.y = currentCoord.y;
                wait(timeUnit,function(){
                    getPos();
                });
            };

            var hit = function(petalCoord,coord){
                var newCoord = {};
                var dist = Math.sqrt(Math.pow(coord.x - lastCoord.x,2) + Math.pow(coord.y - lastCoord.y,2));
                newCoord.x = -(lastCoord.x - coord.x) + petalCoord.left;
                newCoord.x = (newCoord.x < 0)? 0 : newCoord.x;
                newCoord.y = -(lastCoord.y - coord.y) + petalCoord.top;
                newCoord.y = (newCoord.y < 0)? 0 : newCoord.y;
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

        slider:function(){

            return this.each(function(){
                var self = $(this).addClass('ui-slider'),
                    slidesWrapper = self.find('.slides-wrapper');

                self.update = function(index){
                    var shift = -(index * $(self).width()),
                        item = $($(this).find('.slider-menu>li')[index]).addClass('active');

                    item.siblings().removeClass('active');
                    slidesWrapper.animate({marginLeft:shift},800);
                    this.find('.slider-menu-selector').css({marginLeft:item.offset().left + (item.width()/2)-7});

                    self.find('.slider-controller').show();
                    if(index == 0){
                        self.find('.slider-controller-prev').hide();
                    }
                    if(index == slidesWrapper.children().length -1){
                        self.find('.slider-controller-next').hide();
                    }
                    return this;
                }

                self.update(0).find('.slider-menu>li').on('click',function(){
                    self.update($(this).index());
                });

                self.find('.slider-controller').on('click',function(){
                    var menuItems = self.find('.slider-menu>li'),
                        index = menuItems.filter('.active').index()+1;

                    index = ($(this).hasClass('slider-controller-prev'))?index-2:index;
                    index = (index >= menuItems.length)?0:index;
                    index = (index < 0)?menuItems.length-1:index;
                    self.update(index);
                    return false;
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

                            console.log(indexCurrent , sliderWrapper.children().length );

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
                        console.log(indexCurrent);
                        console.log(-shift*indexCurrent);
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
                    $(this).addClass('active').siblings().removeClass('active');
                    portraitsDesc.eq(index).addClass('active').siblings().removeClass('active');
                });
            });
        },

        officeContentSlider:function(){
            return this.each(function(){
                var self = $(this),
                    maxHeight = 460,
                    lectureHeight = maxHeight *.8,
                    totalHeight = self.children().height();
                    controllerNb = ( totalHeight - ( totalHeight % lectureHeight )) / lectureHeight + 1, 
                    sliderController = $('<ul>').addClass('office-content-controller-wrapper');

                    for (var i = controllerNb - 1; i >= 0; i--) {
                        sliderController.prepend($('<li>').addClass(i == 0?'active':'').on('click', function(e) {
                            e.preventDefault();
                            $(this).addClass('active').siblings().removeClass('active');
                            self.children().css({marginTop:-( lectureHeight * $(this).index() )});
                        }));
                    };
                    self.after(sliderController).height(maxHeight);
            });
        },

        fixMenu:function(){


            return this.each(function(){
                var self = $(this),
                    offsetTop = self.offset().top;

                $(window).on('scroll', function(){
                    
                    if($(this).scrollTop() > offsetTop){
                        self.addClass('fix-menu');
                    } else {
                        self.removeClass('fix-menu');
                    };

                })

            });
        }

    });
})(jQuery);



$(document).ready(function(){
    var self = $(this),


        init = function(callaback){

            $(window).on('load ready resize',function(e){
                var header = $('header'),
                    titleWrapper = header.find('#site-title-wrapper'), 
                    squareWidth = titleWrapper.height();
                titleWrapper.width(squareWidth).css({left:($(window).width()-squareWidth)/2});
                self.find('.page').height($(window).height());
                self.find('.ui-max-width').width($(window).width());

                if(e.type == 'load'){
                    callaback();
                }
            });

        };

    init(function(){
        self.find('#loader').fadeOut('300', function() {
           $(this).remove();
           $('body').removeClass('loading');
        });

        self.find('#office-content-wrapper').officeContentSlider();
        self.find('#co-workers').portraitsCoWorkers();
        self.find('#petals-canvas').petalHanlder();
        self.find('.slider-wrapper').slider();
        self.find('.portraits').portraits();

        self.find('nav').fixMenu().find('a').click(function() {
            var theLink = $(this);
            self.find('body').animate({scrollTop: $(theLink.attr('href')).offset().top}, 1300);
            return false;
        });
    });
});