(function () {
    $(window).scroll(function () {
        var top = $(document).scrollTop();
        $('.splash').css({
            'background-position': '0px -' + (top / 3).toFixed(2) + 'px'
        });
        if (top > 50)
            $('#home > .navbar').removeClass('navbar-transparent');
        else
            $('#home > .navbar').addClass('navbar-transparent');
    });

    $("a[href='#']").click(function (e) {
        e.preventDefault();
    });

    var $button = $("<div id='source-button' class='btn btn-primary btn-xs'>&lt; &gt;</div>").click(function () {
        var html = $(this).parent().html();
        html = cleanSource(html);
        $("#source-modal pre").text(html);
        $("#source-modal").modal();
    });

    $('.bs-component [data-toggle="popover"]').popover();
    $('.bs-component [data-toggle="tooltip"]').tooltip();

    $(".bs-component").hover(function () {
        // $(this).append($button);
        $button.show();
    }, function () {
        $button.hide();
    });

    function cleanSource(html) {
        html = html.replace(/×/g, "&times;")
                .replace(/«/g, "&laquo;")
                .replace(/»/g, "&raquo;")
                .replace(/←/g, "&larr;")
                .replace(/→/g, "&rarr;");

        var lines = html.split(/\n/);

        lines.shift();
        lines.splice(-1, 1);

        var indentSize = lines[0].length - lines[0].trim().length,
                re = new RegExp(" {" + indentSize + "}");

        lines = lines.map(function (line) {
            if (line.match(re)) {
                line = line.substring(indentSize);
            }

            return line;
        });

        lines = lines.join("\n");

        return lines;
    }

    $("#body-type-div .radio input").click(function () {
        ele = $(this).attr('data');
        $(".body-type-field").css('display', 'none');
        $("#" + ele + "").css('display', 'block');
    })

    $("#showPass").click(function () {
        ele = $(this).prop('checked');
        if (ele === true) {
            $("#baseAuthPassword").attr('type', 'text');
        } else {
            $("#baseAuthPassword").attr('type', 'password');
        }
    })

    $("#newLine").click(function (e) {
        e.preventDefault();
        eleText = '<div class="form-group">\
                    <div class="col-lg-1"></div>\
                    <div class="col-lg-5">\
                        <input type="text" class="form-control" name="body-form-key[]" placeholder="key" value="">\
                    </div>\
                    <div class="col-lg-5">\
                        <input type="text" class="form-control" name="body-form-value[]" placeholder="value" value="">\
                    </div>\
                </div>';
        $("#fieldsDiv").append(eleText);
    })

    $("#methodSelect ul li").click(function (e) {
        $("#requestMethodText").text(this.innerText)
        $("#requestMethodInput").val(this.innerText)
    })

    $("#saveLink").click(function (e) {
        $("#requestForm").attr('action', $(this).attr('data'));
        $("#requestForm").submit();
    });

    $("#requestForm").submit(function (e) {
        e.preventDefault();
        $("#greyLayer").css('display', 'block');
        $("#processBar").css('display', 'block');
        $(".alert").css('display', 'none');
        $(".error-msg-notice").remove();
        var request = $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: $(this).serialize(),
            dataType: "json", //json html text xml
            success: function (data) {
                $("#responseContent").html('<pre>' + data.data.content + '</pre>')
                $("#responseHeader").html(data.data.header)
                if (data.status != 'succ') {
                    $(".alert-warning").slideDown();
                    $("#alertDiv").html(data.msg);
                    if ($("#requestForm").attr('action').slice(-4) != 'save') {
                        if (data.data.error_field) {
                            var field = $("[name='" + data.data.error_field + "']");
                            field.focus();
                            field.parent().append('<span class="error-msg-notice">' + data.data.error_field_msg + '</span>');
                        }
                    }
                } else {
                    $("#successDiv").html(data.msg);
                    $(".alert-success").slideDown();
                    if ($("#requestForm").attr('action').slice(-4) != 'save') {
                        $("#requestReponse").trigger('click');
                    }
                }
            }
        });
        request.done(function (msg) {
            $("#greyLayer").css('display', 'none');
            $("#processBar").css('display', 'none');
//            $(".alert-success").css('display', 'block');
        });
        request.fail(function (jqXHR, textStatus) {
            $("#greyLayer").css('display', 'none');
            $("#processBar").css('display', 'none');
            $(".alert-danger").css('display', 'block');
        });
    })


    $(".btn-request").click(function (e) {
        e.preventDefault();
        $.cookie('curr_tab', '#body');
        window.location.href = $(this).attr('data');
        return true;
    })

    $("#selectConnection").change(function (e) {
        if ($(this).val() == 'keep-alive') {
            $("#keepAliveTime").removeAttr("disabled");
        } else {
            $("#keepAliveTime").attr("disabled", true);
        }
    })

    $(".data-tr").click(function () {
        $(this).next().slideToggle();
    })

    $(".nav-tabs li a").click(function (e) {
        if ($(this).attr('href') == '#') {

        } else {
            $.cookie('curr_tab', $(this).attr('href'));
        }
    })

    if (typeof ($.cookie('curr_tab')) != 'undefined' && $.cookie('curr_tab') != 'undefined') {
        if ($(".nav-tabs a[href='" + $.cookie('curr_tab') + "']").parent().parent().hasClass('dropdown-menu')) {
            $(".nav-tabs a[href='" + $.cookie('curr_tab') + "']").parent().parent().parent().addClass("active");
        } else {
            $(".nav-tabs a[href='" + $.cookie('curr_tab') + "']").parent().addClass("active");
        }
        $("#" + $.cookie('curr_tab').slice(1)).addClass("active").addClass("in");
    } else {
        $('.nav-tabs li').first().addClass("active");
        $("#body").addClass("active").addClass("in");
    }

}
)();
