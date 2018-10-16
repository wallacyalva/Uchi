var matrixCode = 0;
$(document).ready(function () {
    console.log("ready!");
    loadMatrixType();
});

$(document).on('click', "#10", function (ev) {
    matrixCode = 0;
    loadMatrixType();
});

$(document).on('click', "#20", function (ev) {
    matrixCode = 10;
    loadMatrixType();
});

$(document).on('click', "#50", function (ev) {
    matrixCode = 20;
    loadMatrixType();
});

$(document).on('click', "#100", function (ev) {
    matrixCode = 30;
    loadMatrixType();
});

$(document).on('click', ".network-user", function (ev) {
    $.ajax({
        type: "POST",
        url: baseUrl + "network/tree_level_search",
        data: {
            search: $(this).attr("user"),
        },
        cache: false,
        beforeSend: function (xhr) {
            $(".tree-design").hide();
            $(".network-search-leader").show();
        },
        success: function (response) {
            $(".network-search-leader").hide();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $(".tree-design").html(content.html).fadeIn();
                $(".node").each(function (index) {
                    loadMatrixType();
                });
            }
        },
        error: function (response) {
            $('.network-search-leader').hide();
            $(".tree-design").html("Não foi possível carregar a rede. Por favor, tente novamente.");
        }
    });
});

$(document).on('click', ".sponsor-user", function (ev) {
    $.ajax({
        type: "POST",
        url: baseUrl + "network/tree_sponsor_search",
        data: {
            search: $(this).attr("user"),
        },
        cache: false,
        beforeSend: function (xhr) {
            $(".tree-design").hide();
            $(".network-search-leader").show();
        },
        success: function (response) {
            $(".network-search-leader").hide();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $(".tree-design").html(content.html).fadeIn();
                $(".node").each(function (index) {
                    loadMatrixType();
                });
            }
        },
        error: function (response) {
            $('.network-search-leader').hide();
            $(".tree-design").html("Não foi possível carregar a rede. Por favor, tente novamente.");
        }
    });
});

function loadMatrixType() {
    $(".node").each(function (index) {
        if (!$(this).attr("matrix")) {
            $(this).css("opacity", "0.2");
        } else {
            if ($(this).attr("matrix") < matrixCode) {
                $(this).css("opacity", "0.2");
            } else {
                $(this).css("opacity", "1");
            }
        }
    });
}
