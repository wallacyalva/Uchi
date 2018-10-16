$(document).ready(function () {
    // activate Nestable for list 1
    $('#nestable_list_1').nestable({
        group: 1
    })
            .on('change', updateOutput);

    // activate Nestable for list 2
    $('#nestable_list_2').nestable({
        group: 1
    })
            .on('change', updateOutput);

    // output initial serialised data
    updateOutput($('#nestable_list_1').data('output', $('#nestable_list_1_output')));
    updateOutput($('#nestable_list_2').data('output', $('#nestable_list_2_output')));

//    $('#nestable_list_menu').on('click', function (e) {
//        var target = $(e.target),
//            action = target.data('action');
//        if (action === 'expand-all') {
//            $('.dd').nestable('expandAll');
//        }
//        if (action === 'collapse-all') {
//            $('.dd').nestable('collapseAll');
//        }
//    });

    $('#nestable_list_3').nestable();

    function updateOutput(e) {
        var list = e.length ? e : $(e.target),
                output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    }

    $('.dd').nestable('collapseAll');
    $("#nestable_list_1").fadeIn();
});

//$(document).on('click', ".btn1", function (ev) {
//    var userId = $(this).attr("data-id");
//    if (userId && userId != 0) {
//        $.ajax({
//            type: "POST",
//            url: baseUrl + "network/newLinearLevel",
//            data: {
//                search: userId,
//            },
//            cache: false,
//            beforeSend: function (xhr) {
//            },
//            success: function (response) {
//                var content = $.parseJSON(response);
//                var submembers = content;
//                if (typeof content.error === "undefined") {
//                    $.each(submembers, function (key, submember) {
//                        var olSubmember = '<div class="dd-list" id="' + submember.id + '"></div>';
//                console.log(submember.id);
//                        var divMember = '<div class="dd-item" data-id="' + submember.id + '"><button data-action="collapse" type="button"  type="button" style="display: block;">Expand</button><div class="dd-handle">' + submember.username + '</div>' + olSubmember + '</div>';
//                        $("#" + userId).append(divMember);
//                    });
////                    for (i = 0; i < 8; i++) {
////                        var olSubmember = '<ol class="dd-list" id="list-' + submembers.id + '"></ol>';
////                        var divMember = '<li class="dd-item" data-id="' + submembers.id + '"><div class="dd-handle">' + submembers.username + '</div>' + olSubmember + '</li>';
////                        $("#" + userId).append(divMember);
////                    }
//                }
//            },
//            error: function (response) {
//            }
//        });
//    }
//});

function loadMoreLinear(id) {
    var userId = id;
    console.log(userId);
    if (userId && userId != 0) {
        $.ajax({
            type: "POST",
            url: baseUrl + "network/newLinearLevel",
            data: {
                search: userId,
            },
            cache: false,
            beforeSend: function (xhr) {
            },
            success: function (response) {
                var submembers = $.parseJSON(response);
                $("#" + userId).html("");
                if (typeof submembers.error === "undefined") {
                    $.each(submembers, function (key, submember) {
                        var olSubmember = '<ol class="dd-list" id="' + submember.id + '"></ol>';
                        console.log(submember.id, submember.members.length);
                        var enableButtons = "";
                        if(submember.members.length !== 0){
                            enableButtons = '<button data-action="collapse" type="button" data-id="' + submember.id + '" style="display: none; padding-bottom: 12px;"></button><button data-action="expand" data-id="' + submember.id + '" onclick="loadMoreLinear(' + submember.id + ')" type="button" style="display: block; padding-bottom: 12px;"></button>';
                        }
                        var divMember = '<li class="dd-item" data-id="' + submember.id + '">' + enableButtons + '<div class="dd-handle">' + submember.username + '</div>' + olSubmember + '</li>';
                        $("#" + userId).append(divMember);
                    });
                }
            },
            error: function (response) {
            }
        });
    }
}