var luser = false;
// A $( document ).ready() block.
$(document).ready(function () {
    if ($(window).width() < 991) {
        $(".cli1").removeClass('hover');
        $(".sidebar-toggle-box").removeClass("hidden");
    }
});

$(document).on("click", "#fancybox-close", function () {
    $("#product_detail").html("").fadeOut();
});


$(document).on("click", ".check", function () {
    var direction = 1;
    if ($(".check").prop("checked")) {
        direction = 2;
    } else {
        direction = 1;
    }
    $.ajax({
        type: "POST",
        url: baseUrl + "network/direction",
        data: {
            direction: direction
        },
        cache: false,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
        },
        error: function (response) {

        }
    });

});

$(document).on("click", ".sidebar-toggle-box", function () {
    if (luser == false) {
        $(".logouser").css("display", "block");
        luser = true;
    } else {
        $(".logouser").css("display", "none");
        luser = false;
    }
});
$(document).on("click", ".person-type-click", function () {
    $(".complete-name").text($(this).attr("label"));
    $("#complete_name").attr("placeholder", $(this).attr("label"));
    personTypeUpdate($(this).val());
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
    $(".user-image-success").attr("src", $('.user-image').val());
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
$(document).on("click", ".change-auth", function () {
    $(".recover-auth-widget").hide();
    $(".financial-auth-widget").hide();
    $(".change-auth-widget").fadeIn("fast");
    $(".mask").show();
});
$(document).on("click", ".recover-auth", function () {
    $(".change-auth-widget").hide();
    $(".financial-auth-widget").hide();
    $(".recover-auth-widget").fadeIn("fast");
    $(".mask").show();
});
$(document).on("click", ".btn-recover-auth", function () {
    recoverFinancialAuth();
});
$(document).on("click", ".btn-change-auth", function () {
    changeFinancialAuth();
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
$(document).on("click", ".btn-buy-plan2", function () {
    alert("Um boleto está sendo gerado e será enviado para seu e-mail");
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
            var userToActive = String($("#actvate_login").val());
            if (userToActive) {
                $("#user_actvate_login").val(userToActive);
            } else {
                $("#user_actvate_login").val("");
            }
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
$(document).on("change", "#commercial_use", function () {
    if ($("#commercial_use").is(":checked")) {
        $(".commercial-use").show();
    } else {
        $(".commercial-use").hide();
    }
});
$(document).on('blur', "#zipcode", function (ev) {
    if (($("#country").val() == "BR") && ($(this).val().replace(/\D/g, '').length == 8)) {
        complete_address();
    }
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
$(document).on('click', ".load-more-outlay", function (ev) {
    loadOutlays();
});
$(document).on('click', ".load-more-direct-indication", function (ev) {
    loadDirectIndications();
});
$(document).on('click', ".load-more-indirect-indication", function (ev) {
    loadIndirectIndications();
});
$(document).on("change", "#country", function () {
    countryUpdate();
    personTypeUpdate();
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
        $('#document').mask('999.999.999-99', {reverse: true});
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
function formatIntNumber(input) {
    $(input).val(getNumbersFromText($(input).val()));
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

function loadAllInformations(update) {
    $.ajax({
        type: "POST",
        url: baseUrl + "account/load_informations",
        data: {
            update: update
        },
        cache: false,
        beforeSend: function (xhr) {
            $(".informations-container").hide();
            $('.informations-loading').show();
            $(".reload-informations").hide();
        },
        success: function (response) {
            $(".informations-loading").hide();
            console.log(response);
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $(".informations-container").html(content.view).fadeIn();
            } else {
                $(".informations-container").html(content.error).fadeIn();
            }
            $(".reload-informations").show();
        },
        error: function (response) {
            $(".reload-informations").show();
            $('.informations-loading').hide();
            $(".informations-container").html("Connection error. Failed to load informations.");
        }
    });
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
            console.log(response);
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
            $(".btn-auth").hide();
            $(".financial-auth-result").html("");
        },
        success: function (response) {
            $(".financial-auth-loader").hide();
            var content = $.parseJSON(response);
            $(".btn-auth").show();
            if (typeof content.error === "undefined") {
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
                $(".mask").hide();
                $(".popup-widget").hide();
            } else {
                $(".financial-auth-result").html(content.error);
                $(".financial-auth-result").removeClass("success");
                $(".financial-auth-result").addClass("error");
                $(".financial-auth-result").slideDown();
            }
        },
        error: function (response) {
            $(".financial-auth-loader").hide();
            $(".btn-auth").show();
            $(".financial-auth-result").removeClass("success");
            $(".financial-auth-result").addClass("error");
            $(".financial-auth-result").html("Could not complete this request.").slideDown();
        }
    });
}
function recoverFinancialAuth() {
    $.ajax({
        url: baseUrl + "account/financial_auth_recover",
        type: "POST",
        data: {
            password: $("#current_password").val()
        },
        cache: false,
        beforeSend: function () {
            $("#current_password").val("");
            $(".financial-auth-loader").show();
            $(".btn-auth").hide();
            $(".auth-recover-result").html("");
        },
        success: function (response) {
            $(".financial-auth-loader").hide();
            var content = $.parseJSON(response);
            $(".btn-auth").show();
            if (typeof content.error === "undefined") {
                $(".auth-recover-result").addClass("success");
                $(".auth-recover-result").removeClass("error");
                $(".auth-recover-result").html(content.success).slideDown();
                setTimeout(function (ev) {
                    $(".recover-auth-widget").hide();
                    $(".financial-auth-widget").fadeIn();
                    $(".mask").show();
                    $(".auth-recover-result").slideUp();
                }, 3400);
            } else {
                $(".auth-recover-result").html(content.error);
                $(".auth-recover-result").removeClass("success");
                $(".auth-recover-result").addClass("error");
                $(".auth-recover-result").slideDown();
            }
        },
        error: function (response) {
            $(".financial-auth-loader").hide();
            $(".btn-auth").show();
            $(".auth-recover-result").removeClass("success");
            $(".auth-recover-result").addClass("error");
            $(".auth-recover-result").html("Could not complete this request.").slideDown();
        }
    });
}
function changeFinancialAuth() {
    $.ajax({
        url: baseUrl + "account/financial_auth_change",
        type: "POST",
        data: {
            current_financial_auth: $("#current_financial_auth").val(),
            new_financial_auth: $("#new_financial_auth").val(),
            confirm_financial_auth: $("#confirm_financial_auth").val()
        },
        cache: false,
        beforeSend: function () {
            $("#current_financial_auth").val("");
            $("#new_financial_auth").val("");
            $("#confirm_financial_auth").val("");
            $(".financial-auth-loader").show();
            $(".btn-auth").hide();
            $(".auth-change-result").html("");
        },
        success: function (response) {
            $(".financial-auth-loader").hide();
            var content = $.parseJSON(response);
            $(".btn-auth").show();
            if (typeof content.error === "undefined") {
                $(".auth-change-result").addClass("success");
                $(".auth-change-result").removeClass("error");
                $(".auth-change-result").html(content.success).slideDown();
                setTimeout(function (ev) {
                    $(".change-auth-widget").hide();
                    $(".financial-auth-widget").fadeIn();
                    $(".mask").show();
                    $(".auth-change-result").slideUp();
                }, 2400);
            } else {
                $(".auth-change-result").html(content.error);
                $(".auth-change-result").removeClass("success");
                $(".auth-change-result").addClass("error");
                $(".auth-change-result").slideDown();
            }
        },
        error: function (response) {
            $(".financial-auth-loader").hide();
            $(".btn-auth").show();
            $(".auth-change-result").removeClass("success");
            $(".auth-change-result").addClass("error");
            $(".auth-change-result").html("Could not complete this request.").slideDown();
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
            console.log(response);
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
                $(".btn-change-direction").html(content.direction);
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
                $(".btn-" + userId).html(content.direction);
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
function loadOutlays() {
    $.ajax({
        url: baseUrl + "financial/load_outlays",
        type: "POST",
        data: {
            outlays: $(".load-more-outlay").attr("outlay")
        },
        cache: false,
        beforeSend: function () {
            $(".load-more-button").hide();
            $(".load-more-loading").show();
            $(".load-more-result").html("").removeClass("error").hide();
        },
        success: function (response) {
            $(".load-more-loading").hide();
            $(".load-more-button").show();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $(".load-more-outlay").attr("outlay", content.offset);
                if (content.success == "") {
                    $(".outlay-data").append(content.html);
                } else {
                    $(".load-more-outlay").hide();
                    $(".load-more-result").addClass("success").html(content.success).slideDown();
                }
            } else {
                $(".load-more-result").addClass("error").html(content.error).slideDown();
            }
        },
        error: function (response) {
            $(".load-more-loading").hide();
            $(".load-more-button").show();
            $(".load-more-result").html("Could not complete this request");
        }
    });
}
function loadDirectIndications() {
    $.ajax({
        url: baseUrl + "financial/load_direct_indications",
        type: "POST",
        data: {
            direct_indications: $(".load-more-direct-indication").attr("directindication")
        },
        cache: false,
        beforeSend: function () {
            $(".load-more-button").hide();
            $(".load-more-loading").show();
            $(".load-more-result").html("").removeClass("error").hide();
        },
        success: function (response) {
            $(".load-more-loading").hide();
            $(".load-more-button").show();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $(".load-more-direct-indication").attr("directindication", content.offset);
                if (content.success == "") {
                    $(".direct-indication-data").append(content.html);
                } else {
                    $(".load-more-direct-indication").hide();
                    $(".load-more-result").addClass("success").html(content.success).slideDown();
                }
            } else {
                $(".load-more-result").addClass("error").html(content.error).slideDown();
            }
        },
        error: function (response) {
            $(".load-more-loading").hide();
            $(".load-more-button").show();
            $(".load-more-result").html("Could not complete this request");
        }
    });
}

function loadIndirectIndications() {
    $.ajax({
        url: baseUrl + "financial/load_indirect_indications",
        type: "POST",
        data: {
            indirect_indications: $(".load-more-indirect-indication").attr("indirectindication")
        },
        cache: false,
        beforeSend: function () {
            $(".load-more-button").hide();
            $(".load-more-loading").show();
            $(".load-more-result").html("").removeClass("error").hide();
        },
        success: function (response) {
            $(".load-more-loading").hide();
            $(".load-more-button").show();
            var content = $.parseJSON(response);
            if (typeof content.error === "undefined") {
                $(".load-more-indirect-indication").attr("indirectindication", content.offset);
                if (content.success == "") {
                    $(".indirect-indication-data").append(content.html);
                } else {
                    $(".load-more-indirect-indication").hide();
                    $(".load-more-result").addClass("success").html(content.success).slideDown();
                }
            } else {
                $(".load-more-result").addClass("error").html(content.error).slideDown();
            }
        },
        error: function (response) {
            $(".load-more-loading").hide();
            $(".load-more-button").show();
            $(".load-more-result").html("Could not complete this request");
        }
    });
}

function loadProductDetails(product) {
    $.ajax({
        type: "POST",
        url: baseUrl + "store/productDetails",
        data: {
            search: product
        },
        cache: false,
        beforeSend: function (xhr) {
            $(".tree-design").hide();
            $(".network-search-leader").show();
        },
        success: function (response) {
//            $(".network-search-leader").hide();
            var content = $.parseJSON(response);
            console.log(response);
            console.log(content);
            if (typeof content.error === "undefined") {
                $("#product_detail").html(content.html).fadeIn();
            }
        },
        error: function (response) {
            $('.network-search-leader').hide();
            $(".tree-design").html("Não foi possível carregar a rede. Por favor, tente novamente.");
        }
    });
}
;

function cancelaPedido(pedido, status) {
    if (status == 1) {
        $.ajax({
            type: "POST",
            url: baseUrl + "store/cancela_pedido",
            data: {
                search: pedido
            },
            cache: false,
            beforeSend: function (xhr) {
//            $(".tree-design").hide();
//            $(".network-search-leader").show();
            },
            success: function (response) {
                alert("Seu pedido foi cancelado com sucesso");
                location.reload();
//            $(".network-search-leader").hide();
//            var content = $.parseJSON(response);
//            console.log(response);
//            console.log(content);
//            if (typeof content.error === "undefined") {
//                $("#product_detail").html(content.html).fadeIn();
//            }
            },
            error: function (response) {
                alert(response);
                location.reload();
//            $('.network-search-leader').hide();
//            $(".tree-design").html("Não foi possível carregar a rede. Por favor, tente novamente.");
            }
        });
    } else {
        if (status == 5) {
            alert("Este pedido já foi cancelado.");
        } else {
            alert("Seu pedido já está sendo processado e não pode ser cancelado.");
        }
    }
}

function fechaPedido(pedido, status) {
    if (status == 1) {
        $.ajax({
            type: "POST",
            url: baseUrl + "store/closeSavedOrder",
            data: {
                search: pedido
            },
            cache: false,
            beforeSend: function (xhr) {
//            $(".tree-design").hide();
//            $(".network-search-leader").show();
            },
            success: function (response) {
                alert("Seu pedido foi enviado com sucesso");
                location.reload();
//            $(".network-search-leader").hide();
//            var content = $.parseJSON(response);
//            console.log(response);
//            console.log(content);
//            if (typeof content.error === "undefined") {
//                $("#product_detail").html(content.html).fadeIn();
//            }
            },
            error: function (response) {
                alert(response);
                location.reload();
//            $('.network-search-leader').hide();
//            $(".tree-design").html("Não foi possível carregar a rede. Por favor, tente novamente.");
            }
        });
    } else {
        if (status == 5) {
            alert("Este pedido já foi cancelado.");
        } else {
            alert("Seu pedido já está sendo processado.");
        }
    }
}

function atualizaSaque(id, status) {
        $.ajax({
            url: baseUrl + "admin/atualiza_saque",
            type: "POST",
            data: {
                search: id, 
                status: status
            },
            cache: false,
            beforeSend: function (xhr) {
//            $(".tree-design").hide();
//            $(".network-search-leader").show();
            },
            success: function (response) {
                alert("Saque atualizado com sucesso");
                location.reload();
//            $(".network-search-leader").hide();
//            var content = $.parseJSON(response);
//            console.log(response);
//            console.log(content);
//            if (typeof content.error === "undefined") {
//                $("#product_detail").html(content.html).fadeIn();
//            }
            },
            error: function (response) {
//            $('.network-search-leader').hide();
//            $(".tree-design").html("Não foi possível carregar a rede. Por favor, tente novamente.");
            }
        });
}

function atualizaPedido(pedido, status) {
        $.ajax({
            url: baseUrl + "store/atualiza_pedido",
            type: "POST",
            data: {
                search: pedido, 
                status: status
            },
            cache: false,
            beforeSend: function (xhr) {
//            $(".tree-design").hide();
//            $(".network-search-leader").show();
            },
            success: function (response) {
                alert("Pedido atualizado com sucesso");
                location.reload();
//            $(".network-search-leader").hide();
//            var content = $.parseJSON(response);
//            console.log(response);
//            console.log(content);
//            if (typeof content.error === "undefined") {
//                $("#product_detail").html(content.html).fadeIn();
//            }
            },
            error: function (response) {
                alert(response);
                location.reload();
//            $('.network-search-leader').hide();
//            $(".tree-design").html("Não foi possível carregar a rede. Por favor, tente novamente.");
            }
        });
}

function finalizaPedido() {
        $.ajax({
            type: "POST",
            url: baseUrl + "store/closeOrder",
            data: {
                search: true
            },
            cache: false,
            beforeSend: function (xhr) {
//            $(".tree-design").hide();
//            $(".network-search-leader").show();
            },
            success: function (response) {
//                console.log(response);
//                alert("Seu pedido foi realizado com sucesso");
//            $(".network-search-leader").hide();
//            var content = $.parseJSON(response);
//            console.log(response);
//            console.log(content);
//            if (typeof content.error === "undefined") {
//                $("#product_detail").html(content.html).fadeIn();
//            }
            },
            error: function (response) {
                alert(response);
                location.reload();
//            $('.network-search-leader').hide();
//            $(".tree-design").html("Não foi possível carregar a rede. Por favor, tente novamente.");
            }
        });
 }

