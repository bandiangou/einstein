/**
 * Created by jackdeng on 3/27 0027.
 */

(function(){
    "use strict";

    $('.active').parent().parent().addClass('nav-active');

    jQuery('.menu > li > a').click(function(){
        var parent = jQuery(this).parent();
        var sub = parent.find('> ul');

        if(!jQuery('body').hasClass('left-side-collapsed')){
            if(sub.is(':visible')){
                sub.slideUp(200,function(){
                    parent.removeClass('nav-active');
                    jQuery('.main').css({height:''});
                    mainContentHeightAdjust();
                });
            }else{
                visibleSubMenuClose();
                parent.addClass('nav-active');
                sub.slideDown(200, function() {
                    mainContentHeightAdjust();
                });
            }
        }

        return false;
    });

    function visibleSubMenuClose(){
        jQuery('.menu > li').each(function(){
            var t = jQuery(this);
            if(t.hasClass('nav-active')){
                t.find('> ul').slideUp(200,function(){
                    t.removeClass('nav-active');
                });
            }
        });
    }

    function mainContentHeightAdjust(){
        var docHeight = jQuery(document).height();
        if(docHeight > jQuery('.main').height()){
            jQuery('.main').height(docHeight);
        }
    }




})(jQuery);