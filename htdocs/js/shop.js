var request;

$('.product').each(function (index, value) {
    $("#" + value.id).submit(function(event) {
        event.preventDefault();
        
        if (request) {
            request.abort();
        }
        
        request = $.ajax({
            url: "cart/add",
            type: "post",
            datatype: "html",
            data: {
                productId: event.target[0].value,
                requestType: "ajax"
            }
        });

        request.done(function (response, textStatus, jqXHR){
            // Log a message to the console
            $("#cart-value").html(function(i, val) {
                return +val+1
            });
            console.log("Hooray, it worked!");
        });

        request.fail(function (data) {
            console.log(data.statusText);
        })
    });
});
