(function()
{
    window.shopMethods =
    {
        changePrice: function(priceElements, totalPriceElement)
        {
            if(typeof priceElements !== 'number')
            {
                var sumPrices = 0;
                
                priceElements.each(function(i)
                {
                    sumPrices += parseFloat(priceElements.eq(i).text());
                });
                
                totalPriceElement.text(sumPrices);
            }
            else
            {
                totalPriceElement.text(priceElements);
            }
        }
    };
})();