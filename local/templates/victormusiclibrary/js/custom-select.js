(function()
{
    window.setCustomSelect = function(button)
    {
        let selectStatus = 'close';
        
        button.on('click', function()
        {
            let thisButton = $(this);
            
            if(selectStatus === 'close')
            {
                thisButton.removeClass('select-close');
                thisButton.addClass('select-open');
                thisButton.parent().css('height', '200px');
                
                selectStatus = 'open';
            }
            else
            {
                thisButton.removeClass('select-open');
                thisButton.addClass('select-close');
                thisButton.parent().css('height', '2rem');
                
                selectStatus = 'close';
            }
        });
        
        let select = button.parent().find('select');
        
        select.on('change', function()
        {
            let thisSelect = $(this);
            let thisButton = thisSelect.parent().find('button');
            let selectedIndex = thisSelect[0].selectedIndex;
            let currentItem = thisSelect.find('option').eq(selectedIndex);
            
            thisSelect.find('option').removeClass('custom-option-active');
            currentItem.addClass('custom-option-active');
            
            thisSelect.parent().css('height', '2rem');
            thisSelect[0].scrollTop = currentItem[0].offsetTop;
            
            thisButton.removeClass('select-open');
            thisButton.addClass('select-close');
            
            selectStatus = 'close';
        });
    };
})();