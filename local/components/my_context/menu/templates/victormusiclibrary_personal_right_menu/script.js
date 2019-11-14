$(window).ready(function()
{
    var hasSubmenu = $('.has-submenu');
    var headSubmenuWrapper = $('.head-submenu-wrapper');
    var submenuTimeout;
    var durationTimeout = 2000;
    
    hasSubmenu.hover(
    function()
    {
        var thisButton = $(this);
        var submenu = thisButton.parent().find('.head-submenu-wrapper');
        
        if(submenu[0] !== undefined)
        {
            if(submenuTimeout !== undefined)
            {
                clearTimeout(submenuTimeout);
                submenuTimeout = undefined;
            }
                
            submenu.css('opacity', 1);
        }
    },
    function()
    {
        var thisButton = $(this);
        var submenu = thisButton.parent().find('.head-submenu-wrapper');
        
        submenuTimeout = setTimeout(function()
        {
            submenu.css('opacity', 0);
        }, durationTimeout);
    });
    
    headSubmenuWrapper.hover(
    function()
    {
        if(submenuTimeout !== undefined)
        {
            clearTimeout(submenuTimeout);
            submenuTimeout = undefined;
        }
    },
    function()
    {
        var submenu = $(this);
        
        submenuTimeout = setTimeout(function()
        {
            submenu.css('opacity', 0);
        }, durationTimeout);
    });
});