(function()
{
    window.captchaChange = function(captchaWrapper)
    {
        $.ajax({
            url: '/local/ajax/captcha-change.php',
            method: 'GET',
            success: function(res)
            {
                if(res != false)
                {
                    if(captchaWrapper[0] !== undefined)
                    {
                        captchaWrapper.find('.captcha-sid').val(res);

                        let newUrl = captchaWrapper.find('.captcha-image').prop('src');
                        newUrl = newUrl.replace(/captcha_sid=.+?&/, 'captcha_sid=' + res + '&');

                        captchaWrapper.find('.captcha-image').prop('src', newUrl);
                    }
                }
            }
        });
    }
})();