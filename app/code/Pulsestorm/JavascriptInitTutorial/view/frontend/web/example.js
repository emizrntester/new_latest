define([], function(){
    /*alert("A simple RequireJS module");
    return {};   */ 

    var mageJsComponent = function(config, node)
    {       
        console.log(config);
        console.log(node);
        //alert(config);
    };

    return mageJsComponent;
}); 
