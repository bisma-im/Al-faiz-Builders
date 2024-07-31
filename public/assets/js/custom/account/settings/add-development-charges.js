"use strict";
var KTModalChargesAdd = (function () {
    var t, e, o, n, r, i;
    function generateInvoicePdf(reportId) {
        const pdfUrl = `/generate-invoice-pdf?reportId=${reportId}`;
        window.open(pdfUrl, '_blank');
    }

    function generateInvoice(devChargesId, bookingId){
        console.log(devChargesId);
        // Example: Suppose you need to send this ID to a server
        $.ajax({
            url: '/charges-invoice',  // Your server endpoint to handle the invoice generation
            type: 'POST',
            data: { 
                bookingId: bookingId,
                devChargesId: devChargesId,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            success: function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Invoice generated successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        generateInvoicePdf(response.reportId);
                    }
                });
            },
            error: function(response) {
                Swal.fire({
                    title: 'Error!',
                    text: response.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
    return {
        init: function () {
            (i = new bootstrap.Modal(document.querySelector("#kt_modal_add_charges"))),
                (r = document.querySelector("#kt_modal_add_charges_form")),
                (t = r.querySelector("#kt_modal_add_charges_submit")),
                (e = r.querySelector("#kt_modal_add_charges_cancel")),
                (o = r.querySelector("#kt_modal_add_charges_close"));

                (n = FormValidation.formValidation(r, {
                    fields: {
                        dev_charges: { validators: { notEmpty: { message: "This field is required" } } },
                        dev_charges_description: { validators: { notEmpty: { message: "This field is required" } } },
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                })),
                
                t.addEventListener("click", function (e) {
                    e.preventDefault();
                    if (n) {
                        n.validate().then(function (status) {
                            if (status === "Valid") {
                                var formData = new FormData(r); // Serialize form data
                                var bookingId = document.getElementById('id').value;
                                formData.append('bookingId', bookingId);
                                fetch('/add-charges', {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    }
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.success){
                                        (t.setAttribute("data-kt-indicator", "on"),
                                        (t.disabled = !0),
                                        setTimeout(function () {
                                            t.removeAttribute("data-kt-indicator"),
                                                Swal.fire({
                                                    text: "Charges added successfully!",
                                                    icon: "success",
                                                    buttonsStyling: !1,
                                                    confirmButtonText: "Ok, got it!",
                                                    customClass: { confirmButton: "btn btn-primary" },
                                                }).then(function (e) {
                                                    if (e.isConfirmed) {
                                                        t.disabled = false;
                                                        window.location.reload(); // Reload the current page
                                                    }
                                                });
                                        }, 2e3))
                                    }
                                })
                            } 
                            else {
                                Swal.fire({ 
                                    text: "Sorry, looks like there are some even more errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: { confirmButton: "btn btn-primary" },
                                 });
                            }
                        });
                    }
                });
                e.addEventListener("click", function (t) {
                    t.preventDefault();
                    t.stopPropagation();
                    $('input').blur();
                        Swal.fire({
                            text: "Are you sure you would like to cancel?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, cancel it!",
                            cancelButtonText: "No, return",
                            customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light" },
                        }).then(function (t) {
                            t.value
                                ? (r.reset(), i.hide())
                                : t.dismiss;
                        });
                });
                
                o.addEventListener("click", function (t) {
                    t.preventDefault();
                    t.stopPropagation();
                    $('input').blur();
                        Swal.fire({
                            text: "Are you sure you would like to cancel?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, cancel it!",
                            cancelButtonText: "No, return",
                            customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light" },
                        }).then(function (t) {
                            t.value
                                ? (r.reset(), i.hide())
                                : t.dismiss;
                        });
                });

                $('#devChargesTable').on('click', 'a.btn-light', function(event) {
                    event.preventDefault();  // Prevent the default anchor click behavior
                    var devChargesId = this.getAttribute('data-devChargesId');  // Get the installment ID from the data attribute
                    var bookingId = this.getAttribute('data-bookingId');
                    generateInvoice(devChargesId, bookingId);
                    // Now you can use the installmentId to do whatever you need, like making an AJAX call
                    console.log('devChargesId:', devChargesId);
                });
        },
        
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalChargesAdd.init();
});
