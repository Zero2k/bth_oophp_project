var request;

$('.product').each(function (index) {
    $("#product-" + (index + 1)).submit(function(event) {
        // console.log("Submitted: ", event.target[0].value);
        /* MAKE POST REQUEST TO cart/add with ProductId */
        event.preventDefault();

        if (request) {
            request.abort();
        }

        request = $.ajax({
            url: "cart/add",
            type: "post",
            data: {
                productId: event.target[0].value
            }
        });

        request.done(function (response, textStatus, jqXHR){
            // Log a message to the console
            $("#cart-value").html(function(i, val) {
                return +val+1
            });
            console.log("Hooray, it worked!");
        });
    });
});
