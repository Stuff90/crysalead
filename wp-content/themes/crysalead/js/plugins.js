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
                    var thePetal = $(this);
                    var coord = hit(thePetal.offset() , {x:e.pageX,y:e.pageY});
                    TweenLite.to(thePetal, coord.speed, {top:coord.y,left:coord.x,ease:"CircIn"});
                });
            });
        },

        slider:function(){

            return this.each(function(){
                var self = $(this).addClass('ui-slider');
                var slidesWrapper = self.find('.slides-wrapper');

                // slidesWrapper.children().each(function(){
                //     var self = $(this);
                //     var columns = self.children('.slide-column');
                    
                //     columns.each(function(){
                //         // $(this).css({width:(80/columns.length)+'%'});
                //     })
                // });

                self.update = function(index){
                    var shift = -(index * $(self).width());
                    var item = $($(this).find('.slider-menu>li')[index]).addClass('active');
                    item.siblings().removeClass('active');
                    slidesWrapper.animate({marginLeft:shift},800);
                    this.find('.slider-menu-selector').css({marginLeft:item.offset().left + (item.width()/2)-7});
                    return this;
                }

                self.update(0).find('.slider-menu>li').on('click',function(){
                    self.update($(this).index());
                });
                self.find('.slider-controller').on('click',function(){
                    var menuItems = self.find('.slider-menu>li');
                    var index = menuItems.filter('.active').index()+1;
                    index = ($(this).hasClass('slider-controller-prev'))?index-2:index;
                    index = (index >= menuItems.length)?0:index;
                    index = (index < 0)?menuItems.length-1:index;
                    self.update(index);
                    return false;
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
        }

    });
})(jQuery);



$(document).ready(function(){

    $(window).on('load ready resize',function(){
        var header = $('header');
        var titleWrapper = header.find('#site-title-wrapper');
        var squareWidth = titleWrapper.height();
        titleWrapper.width(squareWidth).css({left:($(window).width()-squareWidth)/2});
        $('.page').height($(window).height());
        $('.ui-max-width').width($(window).width());
    }).scroll(function(){
        var menu = $('nav');
        var max = $(this).height() - menu.height();
        if($(this).scrollTop() > max){
            menu.addClass('fix-menu');
        } else {
            menu.removeClass('fix-menu');
        };
    })

    $('#petals-canvas').petalHanlder();
    $('.slider-wrapper').slider();
    $('.portraits').portraits();
    $('nav').find('a').click(function() {
        var self = $(this);
        $('body').animate({scrollTop: $(self.attr('href')).offset().top}, 1300);
        return false;
    });
});