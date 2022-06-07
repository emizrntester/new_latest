define(['jquery'], function(jQuery){
    return function(originalWidget){
        jQuery.widget('mage.dropdownDialog',jQuery['mage']['dropdownDialog'],{
            open:function(){                    
                //our new code here
                console.log("I opened a dropdown!");

                //call parent open for original functionality
                return this._super();              

            }
        });                                
        return jQuery['mage']['dropdownDialog'];
    };
});
