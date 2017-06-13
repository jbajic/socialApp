$(document).ready(function () {

    $('.likeUnlike').click(function () {
        var statusId = $(this).attr('data-param');
        var iElement = $(this);
        var elementClass;
        if (iElement.parent().parent()  .hasClass('status')) {
            console.log("status assass");
            elementClass = 'status';
        } else {
            console.log("reply  assass");
            elementClass = 'reply';
        }

        console.log(statusId);
        if ($(this).hasClass('blackIcon')) {
            console.log("black");
            $.ajax({
                url: myUrl + 'status/like',
                dataType: 'json',
                data: {
                    'id': statusId
                },
                type: 'post'
            }).done(function (data) {
                var responseStatus = data.status;
                console.log("response" + responseStatus);
                switch (responseStatus) {
                    case 1:
                        iElement.removeClass('blackIcon').addClass('blueIcon');
                        var elementCount = iElement.parent().parent().find('#' + elementClass + 'Count' + statusId);
                        var number = Number(elementCount.text());
                        console.log("text" + elementCount.text());
                        console.log(elementCount);
                        console.log("laidda" + number);
                        console.log('#' + elementClass + 'Count' + statusId);
                        number++;
                        elementCount.text(number);
                        new Noty({
                            text: 'You have liked the status :) !',
                            type: "success",
                            timeout: 3000,
                            layout: "bottomRight"
                        }).show();
                        break;
                    case 0:
                        new Noty({
                            text: 'Something went wrong, sorry!',
                            type: "error",
                            timeout: 3000,
                            layout: "bottomRight"
                        }).show();
                        break;
                    case 3:
                        new Noty({
                            text: 'Does that comment exists?',
                            type: "error",
                            timeout: 3000,
                            layout: "bottomRight"
                        }).show();
                        break;
                }
                console.log('stauts: ' + data.status);
            }).fail(function (data) {
                new Noty({
                    text: 'Something is wrong with the server, please try again later',
                    type: "error",
                    timeout: 3000,
                    layout: "bottomRight"
                }).show();
            });
        } else {
            $.ajax({
                url: myUrl + 'status/unlike',
                dataType: 'json',
                data: {
                    'id': statusId
                },
                type: 'post'
            }).done(function (data) {
                var responseStatus = data.status;
                switch (responseStatus) {
                    case 1:
                        iElement.removeClass('blueIcon').addClass('blackIcon');
                        var elementCount = iElement.parent().parent().find('#' + elementClass + 'Count' + statusId);
                        var number = Number(elementCount.text());
                        console.log("text" + elementCount.text());
                        console.log(elementCount);
                        console.log("laidda" + number);
                        console.log('#' + elementClass + 'Count' + statusId);
                        number--;
                        elementCount.text(number);
                        new Noty({
                            text: 'You have disliked the status :( !',
                            type: "warning",
                            timeout: 3000,
                            layout: "bottomRight"
                        }).show();
                        break;
                    case 0:
                        new Noty({
                            text: 'Something went wrong, sorry!',
                            type: "error",
                            timeout: 3000,
                            layout: "bottomRight"
                        }).show();
                        break;
                    case 3:
                        new Noty({
                            text: 'Does that comment exists?',
                            type: "error",
                            timeout: 3000,
                            layout: "bottomRight"
                        }).show();
                        break;
                }
                console.log('stauts: ' + data.status);
            }).fail(function (data) {
                new Noty({
                    text: 'Something is wrong with the server, please try again later',
                    type: "error",
                    timeout: 3000,
                    layout: "bottomRight"
                }).show();
            });
        }
    });

});