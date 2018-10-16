$(document).on("click", ".person-type-click", function () {
    $(".complete-name").text($(this).attr("label"));
    $("#complete_name").attr("placeholder", $(this).attr("label"));
    personTypeUpdate();
});
$(document).on("click", ".confirm-financial-auth", function () {
    confirmFinancialAuth();
});
$(document).on("click", ".btn-form", function () {
    $(this).hide();
    $(this).closest("form").submit();
});
$(document).on("click", "#terms_conditions", function () {
    if ($(this).is(":checked")) {
        $(".btn-form").removeAttr("disabled");
    } else {
        $(".btn-form").attr("disabled", "disabled");
    }
});
$(document).on("click", ".register-financial-auth", function () {
    registerFinancialAuth();
});
$(document).on("click", ".user-avatar-change", function () {
    $(".user-image").click();
    $(".user-image-type-error").hide();
    $(".user-image-error").hide();
});
$(document).on("change", ".user-image", function () {
    $(".btn-image-change").show();
    $(".user-avatar-change-label").hide();
});
$(document).on("click", ".btn-image-change", function (e) {
    updateUserImage();
});
$(document).on("click", ".indicator-change", function () {
    $(".indicator-change-content").hide();
    $(".indicator-change-form").show();
});
$(document).on("click", ".mask, .popup-cancel", function () {
    $(".mask").hide();
    $(".popup-widget").hide();
});
$(document).on("click", ".user-direction", function () {
    var direction = $(this).attr("direction");
    if (direction != "R" && direction != "L") {
        direction = "R";
    }
    changeUserDirection(direction);
});
$(document).on("click", ".indicator-direction", function () {
    var direction = $(this).attr("direction");
    var userId = $(this).attr("id");
    if (direction != "R" && direction != "L") {
        direction = "R";
    }
    changeIndicatedDirection(userId, direction);
});
$(document).on("click", ".btn-buy-plan, .btn-buy-monthly, .btn-buy-ticket", function () {
    $("#plan").val($(".plan-selected").attr("code"));
    var paymentMethod = $(this).attr("paymentmethod");
    $("#payment_method").val(paymentMethod);
    if (paymentMethod == "balance") {
        $(".mask").show();
        $(".financial-auth-widget").fadeIn();
        if ($(this).hasClass("btn-buy-plan")) {
            $(".financial-action").val("purchase-plan");
        } else if ($(this).hasClass("btn-buy-ticket")) {
            $(".financial-action").val("purchase-ticket");
        } else if ($(this).hasClass("btn-buy-monthly")) {
            $(".financial-action").val("monthly-payment");
        }
    } else {
        $("#purchase-plan-form").submit();
    }
});
$(document).on("click", ".confirm-upgrade, .confirm-ticket", function () {
    $(".mask").click();
    $("#purchase-plan-form").submit();
});
$(document).on("click", ".confirm-monthly-payment", function () {
    $(".mask").click();
    $("#purchase-plan-form").submit();
});
$(document).on("click", ".confirm-thirdparty-monthly-payment", function () {
    $(".mask").click();
    $("#purchase-plan-form").submit();
});
$(document).on("click", ".btn-thirdparty-upgrade", function () {
    $("#thirdparty_plan").val($(".thirdyplan-selected").attr("code"));
    $(".mask").show();
    $(".thirdparty-upgrade-warn").fadeIn();
});
$(document).on("click", ".btn-thirdparty-monthly", function () {
    $(".mask").show();
    $("#thirdparty_monthly").val($(".thirdyplan-selected").attr("code"));
    $(".financial-auth-widget").fadeIn();
    $(".financial-action").val("thirdparty-monthly");
});
$(document).on("click", ".confirm-thirdparty-upgrade", function () {
    $(".thirdparty-upgrade-warn").hide();
    $(".financial-auth-widget").show();
    $(".financial-action").val("thirdparty-upgrade");
});

$(document).on('click', ".thirdyplan", function (ev) {
    $(".thirdyplan").each(function () {
        $(this).removeClass("thirdyplan-selected");
    });
    $(this).addClass("thirdyplan-selected");

    $.scrollTo(".payment-thirdparty", 800);
});
$(document).on('click', ".plan", function (ev) {
    $(".plan").each(function () {
        $(this).removeClass("plan-selected");
    });
    $(this).addClass("plan-selected");

    $.scrollTo(".payment-print", 800);
});

$(document).on('click', ".search-thirdparty-plan", function (ev) {
    $(".thirdparty-search-required").hide();
    $(".thirdparty-search-result").removeClass("error");
    if ($("#username_upgrade").val().length > 0) {
        searchThirdpartyPlans();
    } else {
        $(".thirdparty-search-result").addClass("error");
        $(".thirdparty-search-required").slideDown();
    }
});

$(document).on('click', ".search-thirdparty-monthly", function (ev) {
    $(".thirdparty-search-required").hide();
    $(".thirdparty-search-result").removeClass("error");
    if ($("#username_monthly").val().length > 0) {
        searchThirdpartyMonthly();
    } else {
        $(".thirdparty-search-result").addClass("error");
        $(".thirdparty-search-required").slideDown();
    }
});

$(document).on("change", "#country", function () {
    countryUpdate();
    personTypeUpdate();
});

$(document).on('blur', "#zipcode", function (ev) {
    if (($("#country").val() == "BR") && ($(this).val().replace(/\D/g, '').length == 8)) {
        complete_address();
    }
});


function countryUpdate() {
    if ($("#country").val() == "BR") {
        $(".foreign-person").hide();
        $(".national-person").show();
        $('#zipcode').mask('99999-999');
        $('#telephone').mask('(99) 9999-9999?9');
        if ($("#birthdate").length > 0) {
            $("#birthdate").attr("placeholder", "dd/mm/aaaa");
        }
    } else {
        $(".foreign-person").show();
        $(".national-person").hide();
        $('#zipcode').unmask();
        $('#telephone').unmask();
        if ($("#birthdate").length > 0) {
            $("#birthdate").attr("placeholder", "mm/dd/aaaa");
        }
    }
}
function personTypeUpdate() {
    if ($("#country").val() == "BR") {
        if ($(".person-type-click:checked").val() == "J") {
            $(".label-fis").hide();
            $(".label-jur").show();
            $('#document').mask('99.999.999/9999-99', {reverse: true});
        } else {
            $(".label-jur").hide();
            $(".label-fis").show();
            $('#document').mask('999.999.999-99', {reverse: true});
        }
    } else {
        if ($("#document").length > 0) {
            $("#document").mask("999-99-9999", {reverse: true});
        }
    }
}
function getNumbersFromText(str) {
    var money = parseInt(str.replace(/[\D]+/g, ''));
    if (isNaN(money)) {
        return 0;
    } else {
        return money;
    }
}
function getRealNumbersFromText(input) {
    var value = getNumbersFromText($(input).val());
    var tmp = value + '';
    tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
    return tmp;
}
function formatNumber(input) {
    var value = getNumbersFromText($(input).val());
    $(input).val(value);
}
function formatRealNumber(input) {
    var value = getRealNumbersFromText(input);
    $(input).val(value);
}
function purchaseUpgrade() {
    $(".upgrade-widget").fadeIn();
}
function purchaseTicket() {
    $(".ticket-widget").fadeIn();
}
function purchaseMonthlyPayment() {
    $(".mask").show();
    $(".monthly-payment-widget").fadeIn();
}
function complete_address() {
    $.ajax({
        type: "POST",
        url: baseUrl + "complete_address/search",
        data: {
            zipcode: $("#zipcode").val().replace(/\D/g, '')
        },
        cache: false,
        beforeSend: function () {
            $('.address-disable').each(function () {
                $(this).attr("disabled", "disabled");
            });
            $(".address-loader").fadeIn();
            $('.complete-address-error').hide();
        },
        success: function (response) {
            $(".address-loader").hide();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $('#address').val(content.logradouro);
                $('#neighborhood').val(content.bairro);
                $('#city').val(content.cidade);
                $('#state').val(content.uf);
                $('.address-disable').each(function () {
                    $(this).removeAttr("disabled");
                });
            } else {
                $('.address-disable').each(function () {
                    $(this).val("");
                    $(this).removeAttr("disabled");
                });
                $(".complete-address-error").html(content.error);
                $('.complete-address-error').slideDown();
            }
        },
        error: function (response) {
            $('.address-disable').each(function () {
                $(this).removeAttr("disabled");
            });
            $('.address-loader').hide();
            $('.complete-address-error').hide();
            $(".complete-address-error").html("Não foi possível realizar esta ação. Por favor, tente novamente.");
            $('.complete-address-error').slideDown();
        }
    });
    return false;
}

function loadAllComissions(update) {
    $.ajax({
        type: "POST",
        url: baseUrl + "account/load_comissions",
        data: {
            update: update
        },
        cache: false,
        beforeSend: function (xhr) {
            $(".comissions-container").hide();
            $('.comissions-loading').show();
            $(".reload-comissions").hide();
        },
        success: function (response) {
            $(".comissions-loading").hide();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $(".comissions-container").html(content.view).fadeIn();
            } else {
                $(".comissions-container").html(content.error).fadeIn();
            }
            $(".reload-comissions").show();
        },
        error: function (response) {
            $(".reload-comissions").show();
            $('.comissions-loading').hide();
            $(".comissions-container").html("Connection error. Failed to load comissions.");
        }
    });
}
function searchThirdpartyPlans() {
    $("#thirdparty-plans").html("");
    $.ajax({
        url: baseUrl + "upgrade/thirdparty",
        type: "POST",
        data: {
            username_upgrade: $("#username_upgrade").val()
        },
        cache: false,
        beforeSend: function () {
            $(".thirdparty-search-result").html("").removeClass("error").hide();
            $(".thirdparty-search-leader").show();
            $(".thirdparty-loading").show();
            $(".search-thirdparty-plan").hide();
        },
        success: function (response) {
            $(".thirdparty-search-leader").hide();
            $(".thirdparty-loading").hide();
            $(".search-thirdparty-plan").show();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $("#thirdparty-plans").html(content.success).fadeIn();
            } else {
                $(".thirdparty-search-result").html(content.error);
                $(".thirdparty-search-result").removeClass("success");
                $(".thirdparty-search-result").addClass("error");
                $(".thirdparty-search-result").slideDown();
            }
        },
        error: function (response) {
            $(".thirdparty-search-leader").hide();
            $(".thirdparty-loading").hide();
            $(".search-thirdparty-plan").show();
            $(".thirdparty-search-result").removeClass("success");
            $(".thirdparty-search-result").addClass("error");
            $(".thirdparty-search-result").html("Could not complete this request.").slideDown();
        }
    });
}
function searchThirdpartyMonthly() {
    $("#thirdparty-monthly").html("");
    $.ajax({
        url: baseUrl + "network/thirdparty_monthly",
        type: "POST",
        data: {
            username_monthly: $("#username_monthly").val()
        },
        cache: false,
        beforeSend: function () {
            $(".thirdparty-search-result").html("").removeClass("error").hide();
            $(".thirdparty-search-leader").show();
            $(".thirdparty-loading").show();
            $(".search-thirdparty-monthly").hide();
        },
        success: function (response) {
            $(".thirdparty-search-leader").hide();
            $(".thirdparty-loading").hide();
            $(".search-thirdparty-monthly").show();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $("#thirdparty-monthly").html(content.success).fadeIn();
                $("#thirdparty_username").val($("#username_monthly").val());
            } else {
                $(".thirdparty-search-result").html(content.error);
                $(".thirdparty-search-result").removeClass("success");
                $(".thirdparty-search-result").addClass("error");
                $(".thirdparty-search-result").slideDown();
            }
        },
        error: function (response) {
            $(".thirdparty-search-leader").hide();
            $(".thirdparty-loading").hide();
            $(".search-thirdparty-monthly").show();
            $(".thirdparty-search-result").removeClass("success");
            $(".thirdparty-search-result").addClass("error");
            $(".thirdparty-search-result").html("Could not complete this request.").slideDown();
        }
    });
}
function confirmFinancialAuth() {
    $.ajax({
        url: baseUrl + "account/financial_auth",
        type: "POST",
        data: {
            financial_auth: $("#financial_auth").val()
        },
        cache: false,
        beforeSend: function () {
            $("#financial_auth").val("");
            $(".financial-auth-loader").show();
            $(".confirm-financial-auth").hide();
            $(".financial-auth-result").html("");
        },
        success: function (response) {
            $(".financial-auth-loader").hide();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $(".confirm-financial-auth").show();
                var action = $(".financial-action").val();
                if (action == "purchase-plan") {
                    $(".financial-auth-widget").hide();
                    purchaseUpgrade();
                } else if (action == "purchase-ticket") {
                    $(".financial-auth-widget").hide();
                    purchaseTicket();
                } else if (action == "thirdparty-upgrade") {
                    $(".mask").click();
                    sendThirdpartyUpgrade();
                } else if (action == "monthly-payment") {
                    $(".financial-auth-widget").hide();
                    purchaseMonthlyPayment();
                } else if (action == "thirdparty-monthly") {
                    $(".mask").click();
                    sendThirdpartyMonthly();
                }
            } else {
                $(".confirm-financial-auth").show();
                $(".financial-auth-result").html(content.error);
                $(".financial-auth-result").removeClass("success");
                $(".financial-auth-result").addClass("error");
                $(".financial-auth-result").slideDown();
            }
        },
        error: function (response) {
            $(".financial-auth-loader").hide();
            $(".confirm-financial-auth").show();
            $(".financial-auth-result").removeClass("success");
            $(".financial-auth-result").addClass("error");
            $(".financial-auth-result").html("Could not complete this request.").slideDown();
        }
    });
}
function registerFinancialAuth() {
    $.ajax({
        url: baseUrl + "account/financial_auth_register",
        type: "POST",
        data: {
            financial_auth: $("#financial_auth").val(),
            financial_auth_confirm: $("#financial_auth_confirm").val(),
            password: $("#password").val()
        },
        cache: false,
        beforeSend: function () {
            $(".financial-auth-loader").show();
            $(".register-financial-auth").hide();
            $(".financial-auth-result").html("");
        },
        success: function (response) {
            $(".financial-auth-loader").hide();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $(".financial-content").html(content.success).fadeIn();
                $(".financial-auth-widget").fadeIn();
            } else {
                $(".register-financial-auth").show();
                $(".financial-auth-result").html(content.error);
                $(".financial-auth-result").removeClass("success");
                $(".financial-auth-result").addClass("error");
                $(".financial-auth-result").slideDown();
            }
        },
        error: function (response) {
            $(".financial-auth-loader").hide();
            $(".register-financial-auth").show();
            $(".financial-auth-result").removeClass("success");
            $(".financial-auth-result").addClass("error");
            $(".financial-auth-result").html("Could not complete this request.").slideDown();
        }
    });
}
function sendThirdpartyUpgrade() {
    $.ajax({
        url: baseUrl + "payment/thirdparty_upgrade",
        type: "POST",
        data: {
            username_upgrade: $("#username_upgrade").val(),
            plan: $("#thirdparty_plan").val()
        },
        cache: false,
        beforeSend: function () {
            $("#thirdparty-plans").html("");
            $(".thirdparty-loading").show();
            $(".thirdparty-search-result").html("").removeClass("error").hide();
        },
        success: function (response) {
            $(".thirdparty-loading").hide();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $("#username_upgrade").val("");
                $("#thirdparty-plans").html(content.success);
            } else {
                $("#thirdparty-plans").html("");
                $(".thirdparty-search-result").html(content.error).addClass("error").show();
            }
        },
        error: function (response) {
            $(".thirdparty-loading").hide();
            $("#thirdparty-plans").html("Could not complete this request");
        }
    });
}
function sendThirdpartyMonthly() {
    $.ajax({
        url: baseUrl + "payment/thirdparty_monthly",
        type: "POST",
        data: {
            username_monthly: $("#thirdparty_username").val(),
            months: $("#thirdparty_monthly").val()
        },
        cache: false,
        beforeSend: function () {
            $(".thirdparty-search-result").html("").removeClass("error").hide();
            $("#thirdparty-monthly").html("");
            $(".thirdparty-loading").show();
        },
        success: function (response) {
            $(".thirdparty-loading").hide();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $("#username_monthly").val("");
                $("#thirdparty-monthly").html(content.success);
            } else {
                $("#thirdparty-monthly").html("");
                $(".thirdparty-search-result").html(content.error).addClass("error").show();
            }
        },
        error: function (response) {
            $(".thirdparty-loading").hide();
            $("#thirdparty-monthly").html("Could not complete this request");
        }
    });
}
function changeUserDirection(direction) {
    $.ajax({
        url: baseUrl + "network/change_direction",
        type: "POST",
        data: {
            direction: direction
        },
        cache: false,
        beforeSend: function () {
            $(".btn-change-direction").hide();
            $(".change-direction-loader").show();
        },
        success: function (response) {
            $(".change-direction-loader").hide();
            $(".btn-change-direction").show();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $(".btn-change-direction").html(content.direction)
            }
        },
        error: function (response) {
            $(".change-direction-loader").hide();
            $(".btn-change-direction").show();
        }
    });
}
function changeIndicatedDirection(userId, direction) {
    $.ajax({
        url: baseUrl + "network/indicator_direction",
        type: "POST",
        data: {
            indicated: userId,
            direction: direction
        },
        cache: false,
        beforeSend: function () {
            $(".btn-" + userId).hide();
            $(".loader-" + userId).show();
            $(".result-" + userId).html("").hide();
        },
        success: function (response) {
            $(".loader-" + userId).hide();
            $(".btn-" + userId).show();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $(".result-" + userId).html(content.success).show();
                $(".btn-" + userId).html(content.direction)
            } else {
                $(".result-" + userId).html(content.error).show();
            }
            setTimeout(function (ev) {
                $('.indicator-change-result').slideUp();
            }, 3000);
        },
        error: function (response) {
            $(".loader-" + userId).hide();
            $(".btn-" + userId).show();
            $(".result-" + userId).html("Could not complete this request").show();
            setTimeout(function (ev) {
                $('.indicator-change-result').slideUp();
            }, 3000);
        }
    });
}
function updateUserImage() {
    var file = $(".user-image")[0].files[0];
    var error = false;
    switch (file.type) {
        case "image/jpeg":
            break;
        case "image/png":
            break;
        case "image/gif":
            break;
        default:
            error = true;
    }
    if (error) {
        $(".user-image-type-error").show();
        $(".btn-image-change").hide();
        $(".user-avatar-change-label").show();
    } else {
        var data = new FormData();
        $.each($(".user-image")[0].files, function (key, value) {
            data.append(key, value);
        });
        $.ajax({
            url: baseUrl + "account/change_image",
            type: "POST",
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $(".user-image-content").hide();
                $(".user-image-loader").show();
                $(".user-image-error").hide();
            },
            success: function (response) {
                $(".user-image-loader").hide();
                $(".user-image-content").show();
                var content = $.parseJSON(response);
                if (typeof content.error === "undefined") {
                    $(".user-image-success").attr("src", content.success);
                    $(".user-menu-image img").attr("src", content.success);
                } else {
                    $(".user-image-error").html(content.error).show();
                }
                $(".btn-image-change").hide();
                $(".user-avatar-change-label").show();
            },
            error: function (response) {
                $(".btn-image-change").hide();
                $(".user-avatar-change-label").show();
                $(".user-image-loader").hide();
                $(".user-image-content").show();
                $(".user-image-error").html("Could not complete this request").show();
            }
        });
    }

}
