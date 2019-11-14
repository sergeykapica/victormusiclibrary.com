$(window).ready(function()
{
    var wrapperSlider = $('.wrapper-slider');

    var Slider =
    {
        sliderNavigationWrapper: $('.slider-navigation-wrapper'),
        wrapperSliderItem: $('.wrapper-slider-item'),
        init: function()
        {
            var thisSliderScope = this;

            thisSliderScope.wrapperSliderItem.each(function(i)
            {
                var imageSegments;
                var currentElement;

                imageSegments = thisSliderScope.wrapperSliderItem.eq(i).find('.photo-segment');
                imageSegments.addClass('animated');
                imageSegments.addClass('faster');

                if(thisSliderScope.wrapperSliderItem.eq(i).hasClass('fadeInLeft') || thisSliderScope.wrapperSliderItem.eq(i).hasClass('fadeIn'))
                {
                    imageSegments.each(function(k)
                    {
                        currentElement = ( k + 1 ) % 11;

                        if(currentElement == 1)
                        {
                            imageSegments.eq(k).addClass('microdelay-02s');
                        }
                        else if(currentElement == 2)
                        {
                            imageSegments.eq(k).addClass('microdelay-04s');
                        }
                        else if(currentElement == 3)
                        {
                            imageSegments.eq(k).addClass('microdelay-06s');
                        }
                        else if(currentElement == 4)
                        {
                            imageSegments.eq(k).addClass('microdelay-08s');
                        }
                        else if(currentElement == 5)
                        {
                            imageSegments.eq(k).addClass('microdelay-1s');
                        }
                        else if(currentElement == 6)
                        {
                            imageSegments.eq(k).addClass('microdelay-102s');
                        }
                        else if(currentElement == 7)
                        {
                            imageSegments.eq(k).addClass('microdelay-104s');
                        }
                        else if(currentElement == 8)
                        {
                            imageSegments.eq(k).addClass('microdelay-106s');
                        }
                        else if(currentElement == 9)
                        {
                            imageSegments.eq(k).addClass('microdelay-108s');
                        }
                        else if(currentElement == 10)
                        {
                            imageSegments.eq(k).addClass('microdelay-2s');
                        }
                        else if(currentElement == 0)
                        {
                            imageSegments.eq(k).addClass('microdelay-202s');
                        }
                    });
                }
                else if(thisSliderScope.wrapperSliderItem.eq(i).hasClass('shiftToStart'))
                {
                    imageSegments.each(function(k)
                    {
                        currentElement = ( k + 1 ) % 23;

                        switch(currentElement)
                        {
                            case 1:
                                imageSegments.eq(k).addClass('shift-delay-01');
                            break;

                            case 2:
                                imageSegments.eq(k).addClass('shift-delay-02');
                            break;

                            case 3:
                                imageSegments.eq(k).addClass('shift-delay-03');
                            break;

                            case 4:
                                imageSegments.eq(k).addClass('shift-delay-04');
                            break;

                            case 5:
                                imageSegments.eq(k).addClass('shift-delay-05');
                            break;

                            case 6:
                                imageSegments.eq(k).addClass('shift-delay-06');
                            break;

                            case 7:
                                imageSegments.eq(k).addClass('shift-delay-07');
                            break;

                            case 8:
                                imageSegments.eq(k).addClass('shift-delay-08');
                            break;

                            case 9:
                                imageSegments.eq(k).addClass('shift-delay-09');
                            break;

                            case 10:
                                imageSegments.eq(k).addClass('shift-delay-1');
                            break;

                            case 11:
                                imageSegments.eq(k).addClass('shift-delay-101');
                            break;

                            case 12:
                                imageSegments.eq(k).addClass('shift-delay-102');
                            break;

                            case 13:
                                imageSegments.eq(k).addClass('shift-delay-103');
                            break;

                            case 14:
                                imageSegments.eq(k).addClass('shift-delay-104');
                            break;

                            case 15:
                                imageSegments.eq(k).addClass('shift-delay-105');
                            break;

                            case 16:
                                imageSegments.eq(k).addClass('shift-delay-106');
                            break;

                            case 17:
                                imageSegments.eq(k).addClass('shift-delay-107');
                            break;

                            case 18:
                                imageSegments.eq(k).addClass('shift-delay-108');
                            break;

                            case 19:
                                imageSegments.eq(k).addClass('shift-delay-109');
                            break;

                            case 20:
                                imageSegments.eq(k).addClass('shift-delay-110');
                            break;

                            case 21:
                                imageSegments.eq(k).addClass('shift-delay-111');
                            break;

                            case 22:
                                imageSegments.eq(k).addClass('shift-delay-112');
                            break;

                            case 0:
                                imageSegments.eq(k).addClass('shift-delay-113');
                            break;
                        }
                    });
                }

                if(thisSliderScope.wrapperSliderItem.eq(i).hasClass('fadeInLeft'))
                {
                    imageSegments.addClass('fadeInLeft');
                }
                else if(thisSliderScope.wrapperSliderItem.eq(i).hasClass('fadeIn'))
                {
                    imageSegments.addClass('fadeIn');
                }
                else if(thisSliderScope.wrapperSliderItem.eq(i).hasClass('shiftToStart'))
                {
                    imageSegments.addClass('shiftToStart');
                }
            });

            thisSliderScope.sliderNavigationWrapper.on('click', function(e)
            {
                var target = $(e.target);

                if(target.hasClass('slider-navigation-item'))
                {
                    thisSliderScope.goToSlide(thisSliderScope, target.attr('data-slide-id'));
                    thisSliderScope.sliderNavigationWrapper.find('.navigation-item-active').removeClass('navigation-item-active');
                    target.addClass('navigation-item-active');
                }
            }); 

            var elementEndAnimation = $('.element-end-animation');

            elementEndAnimation.on('animationend', function()
            { 
                if($(this).hasClass('element-end-animation'))
                {
                    if(thisSliderScope.prevSlide === undefined)
                    {
                        if(thisSliderScope.currentSlider !== undefined && thisSliderScope.currentSlider[0] !== undefined && thisSliderScope.currentSlider.prev()[0] !== undefined)
                        {
                            thisSliderScope.currentSlider.prev().hide();
                        }
                        else
                        {
                            thisSliderScope.wrapperSliderItem.eq(thisSliderScope.wrapperSliderItem.length - 1).hide();
                        }
                    }
                    else
                    {
                        $('.wrapper-slider-item').not(thisSliderScope.currentSlider).css({
                            'z-index': 1,
                            'display': 'none'
                        });
                    }
                } 
            });
        },

        slideShow: function()
        {
            var duration = 5000;
            var thisSliderScope = this;

            (function()
            {
                var calledFunction = arguments.callee;

                setTimeout(function()
                {
                    thisSliderScope.goToSlide(thisSliderScope);

                    calledFunction();
                }, duration);
            })();
        },

        goToSlide: function(thisSliderScope, slideID = false)
        {
            if(slideID === false)
            {
                if(thisSliderScope.currentSlider === undefined)
                {
                    thisSliderScope.currentSlider = thisSliderScope.wrapperSliderItem.eq(0).next();
                }
                else
                {
                    thisSliderScope.currentSlider = thisSliderScope.currentSlider.next();

                    if(thisSliderScope.currentSlider[0] === undefined)
                    {
                        thisSliderScope.currentSlider = thisSliderScope.wrapperSliderItem.eq(0);
                    }
                }

                if(thisSliderScope.currentSlider.prev()[0] !== undefined)
                {
                    thisSliderScope.currentSlider.prev().css('z-index', 1);
                }
                else
                {
                    thisSliderScope.wrapperSliderItem.eq(thisSliderScope.wrapperSliderItem.length - 1).css('z-index', 1);
                }

                thisSliderScope.currentSlider.css('z-index', 2);
                thisSliderScope.currentSlider.show();
            }
            else
            { 
                if(thisSliderScope.currentSlider === undefined)
                {
                    thisSliderScope.currentSlider = thisSliderScope.wrapperSliderItem.eq(0);
                }

                thisSliderScope.currentSlider.css('z-index', 1);

                thisSliderScope.prevSlide = thisSliderScope.currentSlider;

                thisSliderScope.currentSlider = thisSliderScope.wrapperSliderItem.eq(slideID);

                thisSliderScope.currentSlider.css('z-index', 2);
                thisSliderScope.currentSlider.show();
            }
        }
    };

    Slider.init();
    //Slider.slideShow();
});