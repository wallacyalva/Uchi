!function () {
    $(function () {
        return $(".datatable").dataTable(
                 { aaSorting: []}
//                {aoColumnDefs: [{bSortable: !1, aTargets: [0, 3]}], aaSorting: []}
        ),
                $(".datatable").each(function () {
            var a, t, e;
            return a = $(this), e = a.closest(".dataTables_wrapper").find("div[id$=_filter] input"), e.attr("placeholder", "Pesquisar na tabela"), e.addClass("form-control input-sm"), t = a.closest(".dataTables_wrapper").find("div[id$=_length] select"), t.addClass("form-control input-sm"), t = a.closest(".dataTables_wrapper").find("div[id$=_info]"), t.css("margin-top", "18px")
        })
    })
}.call(this);
;
!function () {
    $(function () {
        return $(".datatable2").dataTable(
                {aoColumnDefs: [{bSortable: !1, aTargets: [0, 3]}], aaSorting: []}
        ),
                $(".datatable2").each(function () {
            var a, t, e;
            return a = $(this), e = a.closest(".dataTables_wrapper").find("div[id$=_filter] input"), e.attr("placeholder", "Pesquisar na tabela"), e.addClass("form-control input-sm"), t = a.closest(".dataTables_wrapper").find("div[id$=_length] select"), t.addClass("form-control input-sm"), t = a.closest(".dataTables_wrapper").find("div[id$=_info]"), t.css("margin-top", "18px")
        })
    })
}.call(this);
;