(function()
{
    let oOtherFunctions =
    {
        setTabs: function(buttons, tabs, callback)
        {
            buttons.on('click', function()
            {
                let thisButton = $(this);
                buttons.removeClass('tab-button-active');
                thisButton.addClass('tab-button-active');
                
                var idOfTab = thisButton.attr('data-id');
                
                tabs.removeClass('tab-open');
                tabs.addClass('tab-close');
                $('#' + idOfTab).addClass('tab-open');
                
                if(callback !== undefined)
                {
                    callback($('#' + idOfTab));
                }
            });
        },
        
        checkSelectCheckbox: function(checkboxInputs)
        {
            let checkedStatus = false;
            
            checkboxInputs.each(function(i)
            {
                if(checkboxInputs.eq(i).prop('checked'))
                {
                   checkedStatus = true;
                }
            });
            
            return checkedStatus;
        },
        
        findParentFromChildren: function(children, parent)
        {
            let parentClassName = parent[0].className;
            let findParent = children;
            
            while(!findParent.hasClass(parentClassName))
            {
                findParent = findParent.parent();
            }
            
            return findParent;
        }
    };
    
    window.oOtherFunctions = oOtherFunctions;
})();