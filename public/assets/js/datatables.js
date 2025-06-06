$(function (e) {
    $("#basic-datatable").DataTable({
        language: { searchPlaceholder: "Search...", sSearch: "" },
    }),
        $("#responsive-datatable").DataTable({
            responsive: !0,
            language: { searchPlaceholder: "Search...", sSearch: "" },
        }),
        (s = $("#file-datatable").DataTable({
            buttons: ["copy", "excel", "pdf", "colvis"],
            responsive: !0,
            language: { searchPlaceholder: "Search...", sSearch: "" },
        }))
            .buttons()
            .container()
            .appendTo("#file-datatable_wrapper .col-md-6:eq(0)");
    var a,
        l,
        t,
        s = $("#delete-datatable").DataTable({
            language: { searchPlaceholder: "Search...", sSearch: "" },
        });
    $("#delete-datatable tbody").on("click", "tr", function () {
        $(this).hasClass("selected")
            ? $(this).removeClass("selected")
            : (s.$("tr.selected").removeClass("selected"),
              $(this).addClass("selected"));
    }),
        $("#button").click(function () {
            s.row(".selected").remove().draw(!1);
        }),
        $("#details-datatable").DataTable(
            ((a = {
                responsive: !0,
                language: { searchPlaceholder: "Search...", sSearch: "" },
            }),
            (l = "responsive"),
            (t = {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (e) {
                            var a = e.data();
                            return "Details for " + a[0] + " " + a[1];
                        },
                    }),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: "table border mb-0",
                    }),
                },
            }),
            l in a
                ? Object.defineProperty(a, l, {
                      value: t,
                      enumerable: !0,
                      configurable: !0,
                      writable: !0,
                  })
                : (a[l] = t),
            a)
        ),
        $(".select2").select2({ minimumResultsForSearch: 1 / 0 });
});
