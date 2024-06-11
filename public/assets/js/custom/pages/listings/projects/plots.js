"use strict";
var KTCustomersList = (function () {
    var t, plotId,
        x,
        e,
        o,
        n,
        c = () => {
            n.querySelectorAll('[data-kt-customer-table-filter="delete_row"]').forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault();
                    const o = e.target.closest("tr"),
                        n = o.querySelectorAll("td")[1].innerText;
                    Swal.fire({
                        text: "Are you sure you want to delete " + n + "?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: { confirmButton: "btn fw-bold btn-danger", cancelButton: "btn fw-bold btn-active-light-primary" },
                    }).then(function (e) {
                        e.value
                            ? Swal.fire({ text: "You have deleted " + n + "!.", icon: "success", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn fw-bold btn-primary" } }).then(function () {
                                  t.row($(o)).remove().draw();
                              })
                            : "cancel" === e.dismiss && Swal.fire({ text: n + " was not deleted.", icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn fw-bold btn-primary" } });
                    });
                });
            });
        },
        r = () => {
            const e = n.querySelectorAll('[type="checkbox"]'),
                o = document.querySelector('[data-kt-customer-table-select="delete_selected"]');
            e.forEach((t) => {
                t.addEventListener("click", function () {
                    setTimeout(function () {
                        l();
                    }, 50);
                });
            }),
                o.addEventListener("click", function () {
                    Swal.fire({
                        text: "Are you sure you want to delete selected customers?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: { confirmButton: "btn fw-bold btn-danger", cancelButton: "btn fw-bold btn-active-light-primary" },
                    }).then(function (o) {
                        o.value
                            ? Swal.fire({ text: "You have deleted all selected customers!.", icon: "success", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn fw-bold btn-primary" } }).then(
                                  function () {
                                      e.forEach((e) => {
                                          e.checked &&
                                              t
                                                  .row($(e.closest("tbody tr")))
                                                  .remove()
                                                  .draw();
                                      });
                                      n.querySelectorAll('[type="checkbox"]')[0].checked = !1;
                                  }
                              )
                            : "cancel" === o.dismiss &&
                              Swal.fire({ text: "Selected customers was not deleted.", icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn fw-bold btn-primary" } });
                    });
                });
        };
    const l = () => {
        const t = document.querySelector('[data-kt-customer-table-toolbar="base"]'),
            e = document.querySelector('[data-kt-customer-table-toolbar="selected"]'),
            o = document.querySelector('[data-kt-customer-table-select="selected_count"]'),
            c = n.querySelectorAll('tbody [type="checkbox"]');
        let r = !1,
            l = 0;
        c.forEach((t) => {
            t.checked && ((r = !0), l++);
        }),
            r ? ((o.innerHTML = l), t.classList.add("d-none"), e.classList.remove("d-none")) : (t.classList.remove("d-none"), e.classList.add("d-none"));
    };
    return {
        init: function () {
            // Modal and form references
            var modalInstance = new bootstrap.Modal(document.querySelector("#editPlotModal"));
            var form = $("#editPlotForm");
            var submitButton = $("#edit_plot_submit");
            var cancelButton = $("#edit_plot_cancel");
            var closeButton = $("#edit_plot_close");

            const editButtons = document.querySelectorAll('#editButton');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    plotId = row.dataset.plotId;
                    const category = row.dataset.category;
                    const serialNo = row.querySelector('.serialNo').value; // Corrected to use .value for input
                    const plotOrShop = row.querySelector('.plotOrShop').value; // Corrected to use .value for input
                    const prefix = row.querySelector('.prefix').value;
                    const amount = row.querySelector('.amount').textContent;

                    // // Set data in the modal fields
                    document.getElementById('category').value = category;
                    document.getElementById('serial_no').value = serialNo;
                    document.getElementById('prefix').value = prefix;
                    document.getElementById('amount').value = amount;

                    var selectElement = document.getElementById('plot_or_shop');
                    selectElement.value = plotOrShop;

                    // If using Select2, you may need to trigger a change event for Select2 to display the value
                    $(selectElement).trigger('change');
                });
            });
            (x = FormValidation.formValidation(form[0], {
                fields: {
                    category: { validators: { notEmpty: { message: "Category is required" } } },
                    serial_no: { validators: { notEmpty: { message: "Plot Number is required" } } },
                    prefix: { validators: { notEmpty: { message: "Prefix is required" } } },
                    amount: { validators: { notEmpty: { message: "Amount is required" } } },
                    plot_or_shop: { validators: { notEmpty: { message: "Plot type is required" } } },
                },
                plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
            })),

            // Submit button event
            submitButton.click(function (e) {
                e.preventDefault();
                x.validate().then(function (status) {
                    if (status === "Valid") {
                        var formData = new FormData(form[0]);
                        formData.append('plot_id', plotId);
                        $.ajax({
                            url: '/update-plot', // Replace with your endpoint URL
                            type: 'POST',
                            processData: false,  // tell jQuery not to process the data
                            contentType: false,
                            data: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function () {
                                submitButton.attr("data-kt-indicator", "on");
                                submitButton.prop("disabled", true);
                            },
                            success: function (response) {
                                Swal.fire({
                                    text: 'Plot updated successfully',
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: { confirmButton: "btn btn-primary" }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        modalInstance.hide();
                                        submitButton.prop("disabled", false);
                                        window.location.reload();
                                    }
                                });
                            },
                            error: function (xhr, textStatus, errorThrown) {
                                var message = "An error occurred"; // Default error message
                                if (xhr.responseJSON && xhr.responseJSON.error) {
                                    message = xhr.responseJSON.error; // Message from server
                                }
                            
                                Swal.fire({
                                    text: message,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: { confirmButton: "btn btn-primary" }
                                }).then(function () {
                                    submitButton.prop("disabled", false); // Re-enable the submit button
                                });
                            },
                            complete: function () {
                                submitButton.removeAttr("data-kt-indicator");
                                submitButton.prop("disabled", false);
                            }
                        });
                        
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn btn-primary" }
                        });
                    }
                });
            });

            (n = document.querySelector("#kt_users_table")) &&
            (
                (t = $(n).DataTable({
                    info: !1,
                    order: [],
                    paging: false,
                    columnDefs: [
                        { orderable: !1, targets: 0 },
                    ],
                })).on("draw", function () {
                    r(), c(), l(), KTMenu.init();
                }),
                r(),
                document.querySelector('[data-kt-customer-table-filter="search"]').addEventListener("keyup", function (e) {
                    t.search(e.target.value).draw();
                }),
                (e = $('[data-kt-customer-table-filter="month"]')),
                (o = document.querySelectorAll('[data-kt-customer-table-filter="payment_type"] [name="payment_type"]')),
                document.querySelector('[data-kt-customer-table-filter="filter"]').addEventListener("click", function () {
                    const n = e.val();
                    let c = "";
                    o.forEach((t) => {
                        t.checked && (c = t.value), "all" === c && (c = "");
                    });
                    const r = n + " " + c;
                    t.search(r).draw();
                }),
                c(),
                
                document.querySelector('[data-kt-customer-table-filter="reset"]').addEventListener("click", function () {
                    e.val(null).trigger("change"), (o[0].checked = !0), t.search("").draw();
                })
            );
            let deleteForm = document.getElementById("deleteForm");
            let button = document.getElementById("deleteButton");
            addDeleteListener(button);
            function addDeleteListener(button) {
                document.querySelector('#plotCategoryContent').addEventListener('click', function (e) {
                    if (e.target && e.target.id === 'deleteButton') {
                        e.preventDefault();
                        const o = e.target.closest("tr"),
                        plotId = o.dataset.plotId,
                        category = o.dataset.category,
                        n = o.querySelectorAll("td")[1].innerText;
                        const formData = new FormData();
                        formData.append('plotId', plotId);
                        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                        console.log(plotId);
                        console.log(category);
                        Swal.fire({
                            text: "Are you sure you want to delete " + n + "?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, delete!",
                            cancelButtonText: "No, cancel",
                            customClass: { confirmButton: "btn fw-bold btn-danger", cancelButton: "btn fw-bold btn-active-light-primary" },
                        })
                        .then(function (result) {
                            if (result.isConfirmed) {
                                // Send AJAX request to delete project
                                fetch('/delete-plot', { // Use the correct URL pattern as per your routes
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    }
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Server responded with a status: ' + response.status);
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.success) {
                                        console.log('plot deleted');
                                        Swal.fire({
                                            text: "You have deleted " + n + "!.", icon: "success", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn fw-bold btn-primary" } })
                                            .then(function () {
                                                t.row($(o)).remove().draw(); 
                                                window.location.reload();
                                        });
                                    } else {
                                        "cancel" === e.dismiss && 
                                        Swal.fire({ text: n + " was not deleted.", icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn fw-bold btn-primary" } });
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                            }
                        });
                    }
                });
            } 
            
            // Cancel button event
            cancelButton.click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                $('input').blur();
                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light" }
                }).then(function (result) {
                    if (result.value) {
                        form[0].reset();
                        modalInstance.hide();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            text: "Your form has not been cancelled!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn btn-primary" }
                        });
                    }
                });
            });

            // Close button event
            closeButton.click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                $('input').blur();
                Swal.fire({
                    text: "Are you sure you would like to close?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, close it!",
                    cancelButtonText: "No, keep it",
                    customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light" }
                }).then(function (result) {
                    if (result.value) {
                        form[0].reset();
                        modalInstance.hide();
                    }
                });
            });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTCustomersList.init();
});
