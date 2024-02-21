"use strict";

var KTAccountsList = (function () {
    var t,
        n,
        c = () => {
            n.querySelectorAll('[data-kt-accounts-table-filter="delete_row"]').forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault();
                    const o = e.target.closest("tr"),
                        c = o.querySelectorAll("td")[0].innerText; // Assuming account head is the first column
                    Swal.fire({
                        text: "Are you sure you want to delete " + c + "?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        },
                    }).then(function (e) {
                        e.value
                            ? Swal.fire({
                                text: "You have deleted " + c + "!",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: { confirmButton: "btn fw-bold btn-primary" }
                              }).then(function () {
                                  t.row($(o)).remove().draw();
                              })
                            : "cancel" === e.dismiss && Swal.fire({
                                text: c + " was not deleted.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: { confirmButton: "btn fw-bold btn-primary" }
                              });
                    });
                });
            });
        };

    return {
        init: function () {
            (n = document.querySelector("#kt_accounts_table")) &&
                ((t = $(n).DataTable({
                    info: !1,
                    order: [],
                    columnDefs: [
                        { orderable: !1, targets: 2 }, // Actions column is not orderable
                    ],
                })).on("draw", function () {
                    c(), KTMenu.init();
                }),
                c(),
                document.querySelector('[data-kt-accounts-table-filter="search"]').addEventListener("keyup", function (e) {
                    t.search(e.target.value).draw();
                }));
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTAccountsList.init();
});
