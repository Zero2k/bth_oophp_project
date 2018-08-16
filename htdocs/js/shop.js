$('.product').each(function (index) {
    $("#product-" + (index + 1)).submit(function(e){
        console.log("Submitted: ", e.target[0].value);
        /* MAKE POST REQUEST TO cart/add with ProductId */
        e.preventDefault();
    });
});
