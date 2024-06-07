"use strict";

var KTCustomersList = (function () {
    var n,t;
    //     e,
    //     o,
    //     n,
    //     r = () => {
    //         const e = n.querySelectorAll('[type="checkbox"]');

    //         e.forEach((t) => {
    //             t.addEventListener("click", function () {
    //                 setTimeout(function () { l()
    //                 }, 50);
    //             });
    //         });
    //     };
    // const l = () => {
    //     const t = document.querySelector('[data-kt-customer-table-toolbar="base"]'),
    //         e = document.querySelector('[data-kt-customer-table-toolbar="selected"]');
           
    // };
    return {
        init: function () {
            (n = document.querySelector("#kt_users_table")),
                (t = $(n).DataTable({
                    info: !1,
                    order: [],
                    columnDefs: [
                        { orderable: !1, targets: '_all' },
                    ],
                    paging: false,
                    scrollY: "auto",
                })).on("draw", function () {
                    KTMenu.init();
                });
                // document.querySelector('[data-kt-customer-table-filter="search"]').addEventListener("keyup", function (e) {
                //     t.search(e.target.value).draw();
                // }),
                // (e = $('[data-kt-customer-table-filter="month"]')),
                // (o = document.querySelectorAll('[data-kt-customer-table-filter="payment_type"] [name="payment_type"]')),
                // document.querySelector('[data-kt-customer-table-filter="filter"]').addEventListener("click", function () {
                //     const n = e.val();
                //     let c = "";
                //     o.forEach((t) => {
                //         t.checked && (c = t.value), "all" === c && (c = "");
                //     });
                //     const r = n + " " + c;
                //     t.search(r).draw();
                // }),
                // c();
                // document.querySelector('[data-kt-customer-table-filter="reset"]').addEventListener("click", function () {
                //     e.val(null).trigger("change"), (o[0].checked = !0), t.search("").draw();
                // });
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTCustomersList.init();
});
