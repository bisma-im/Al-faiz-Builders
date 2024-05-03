"use strict";
var KTModalLogsAdd = (function () {
    var t, e, o, n, r, i, cancelledVal;
    return {
        init: function () {
            (i = new bootstrap.Modal(document.querySelector("#kt_modal_cancel_booking"))),
                (r = document.querySelector("#kt_modal_cancel_booking_form")),
                (t = r.querySelector("#kt_modal_cancel_booking_submit")),
                (e = r.querySelector("#kt_modal_cancel_booking_cancel")),
                (o = r.querySelector("#kt_modal_cancel_booking_close")),
                new Dropzone("#kt_cancel_booking_media", {
                    url: "https://keenthemes.com/scripts/void.php",
                    autoProcessQueue: false,
                    paramName: "file",
                    maxFiles: 10,
                    maxFilesize: 10,
                    addRemoveLinks: true,
                }),
                cancelledVal = document.getElementById("cancelled");
                const checkCancelled = function () {
                    return {
                        validate: function (input) {
                            const value = input.value;
                            if (value === '') {
                                return {
                                    valid: true,
                                };
                            }
                            if (value !== 'CANCELLED') {
                                return {
                                    valid: false,
                                };
                            }
                            return {
                                valid: true,
                            };
                        },
                    };
                };
                FormValidation.validators.isCancelled = checkCancelled;
                (n = FormValidation.formValidation(r, {
                    fields: {
                        reason_for_cancellation: { validators: { notEmpty: { message: "This field is required" } } },
                        cancelled: { validators: { 
                            notEmpty: { message: "Please enter CANCELLED to proceed" },
                            isCancelled: { message: 'The field must contain the word "CANCELLED"'}, 
                            }
                        },
                        cancel_booking_checkbox: { validators: { notEmpty: { message: "This field is required" } } },
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                })),
                
                t.addEventListener("click", function (e) {
                    e.preventDefault();
                    if (n) {
                        n.validate().then(function (status) {
                            if (status === "Valid") {
                                var formData = new FormData(r); // Serialize form data
                                const dropzoneElement = document.querySelector('#kt_cancel_booking_media');
                                if (dropzoneElement.dropzone) {
                                    const files = dropzoneElement.dropzone.files;
                                    files.forEach((file) => {
                                        formData.append('cancelled_booking_media[]', file, file.name);
                                    });
                                }
                                var bookingId = document.getElementById('id').value;
                                var plotId = document.getElementById('selectedPlot').value;
                                formData.append('bookingId', bookingId);
                                formData.append('plotId', plotId);
                                fetch('/cancel-booking', {
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
                                                    text: "Booking has been successfully cancelled!",
                                                    icon: "success",
                                                    buttonsStyling: !1,
                                                    confirmButtonText: "Ok, got it!",
                                                    customClass: { confirmButton: "btn btn-primary" },
                                                }).then(function (e) {
                                                    e.isConfirmed && ((t.disabled = !1), (window.location.href = r.getAttribute("data-kt-redirect")));
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
        },
        
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalLogsAdd.init();
});
