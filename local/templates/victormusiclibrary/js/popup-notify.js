(function()
{
    window.setPopupNotify = function(containerElement, params)
    {
        let headline = params.headlineText !== undefined ? '<div class="popup-notify-headline"><span>' + params.headlineText + '</span><button class="notify-close-button"></button></div>' : '<div class="popup-notify-headline"><button class="notify-close-button"></button></div>';
        
        let popupNotifyElement = document.createElement('div');
        popupNotifyElement.classList.add('popup-notify-wrapper');
        popupNotifyElement.classList.add('animated');
        popupNotifyElement.classList.add('bounceInDown');
        popupNotifyElement.innerHTML = 
        `
        ` + headline + `
        <div class="popup-notify-content">` + params.contentText + `</div>
        `;
        
        let scrollTop = document.body.scrollTop || document.documentElement.scrollTop;

        popupNotifyElement.style.top = scrollTop + params.indentParams.indentPopup + 'px';

        containerElement.append(popupNotifyElement);

        popupNotifyElement = $(popupNotifyElement);

        let mainContentElementCurrentMinHeight = parseFloat(params.indentParams.mainContentElement.css('min-height'));
        
        if(scrollTop >= params.indentParams.contentIndent)
        {
            params.indentParams.mainContentElement.css('min-height', ( popupNotifyElement[0].offsetHeight - params.indentParams.contentIndent ) + 'px');
        }
        else
        {
            params.indentParams.mainContentElement.css('min-height', popupNotifyElement[0].offsetHeight + 'px');
        }

        let closeButton = popupNotifyElement.find('.notify-close-button');

        closeButton.on('click', function()
        {
            popupNotifyElement.addClass('bounceOutUp');
            popupNotifyElement.on('animationend', function()
            {
                params.indentParams.mainContentElement.css('min-height', mainContentElementCurrentMinHeight + 'px');

                $(this).remove();
            });
        });
    };
})();