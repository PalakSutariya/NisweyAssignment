!(function (e) {
    "use strict";
    (window.asd = e(".SlectBox").SumoSelect({
        csvDispCount: 3,
        selectAll: !0,
        captionFormatAllSelected: "Yeah, OK, so everything.",
    })),
        (window.Search = e(".search-box").SumoSelect({
            csvDispCount: 3,
            search: !0,
            searchText: "Enter here.",
        })),
        (window.sb = e(".SlectBox-grp-src").SumoSelect({
            csvDispCount: 3,
            search: !0,
            searchText: "Enter here.",
            selectAll: !0,
        })),
        e(".testselect1").SumoSelect(),
        e(".testselect2").SumoSelect(),
        e(".select1").SumoSelect({ okCancelInMulti: !0, selectAll: !0 }),
        e(".select3").SumoSelect({ selectAll: !0 }),
        e(".search_test").SumoSelect({ search: !0, searchText: "Enter here." });
    var a = {
        inputId: "languageInput",
        data: [
            { language: "jQuery", value: 122 },
            { language: "AngularJS", value: 132 },
            { language: "ReactJS", value: 422 },
            { language: "VueJS", value: 232 },
            { language: "JavaScript", value: 765 },
            { language: "Java", value: 876 },
            { language: "Python", value: 453 },
            { language: "TypeScript", value: 125 },
            { language: "PHP", value: 633 },
            { language: "Ruby on Rails", value: 832 },
        ],
        groupData: [
            {
                groupName: "JavaScript",
                groupData: [
                    { language: "jQuery", value: 122 },
                    { language: "AngularJS", value: 643 },
                    { language: "ReactJS", value: 422 },
                    { language: "VueJS", value: 622 },
                ],
            },
            {
                groupName: "Popular",
                groupData: [
                    { language: "JavaScript", value: 132 },
                    { language: "Java", value: 112 },
                    { language: "Python", value: 124 },
                    { language: "TypeScript", value: 121 },
                    { language: "PHP", value: 432 },
                    { language: "Ruby on Rails", value: 421 },
                ],
            },
        ],
        itemName: "language",
        groupItemName: "groupName",
        groupListName: "groupData",
        container: "transfer",
        valueName: "value",
        callable: function (a, l) {
            console.log("Selected ID：" + a), e("#selectedItemSpan").text(l);
        },
    };
    Transfer.transfer(a);
    var l = document.getElementById("fruit_select");
    multi(l, {
        non_selected_header: "Fruits",
        selected_header: "Favorite fruits",
    }),
        (l = document.getElementById("fruit_select1")),
        multi(l, { enable_search: !0 }),
        e("#demo").FancyFileUpload({
            params: { action: "fileuploader" },
            maxfilesize: 1e6,
        });
})(jQuery);
