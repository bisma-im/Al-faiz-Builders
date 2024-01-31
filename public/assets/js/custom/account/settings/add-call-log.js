"use strict";
var KTModalLogsAdd = (function () {
    var t, e, o, n, r, i;
    $("#kt_ecommerce_add_call_log_datepicker").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        onClose: function(selectedDates, dateStr, instance) {
            // You can handle any actions here after the date is selected
            console.log('DatePicker closed');
        }
    });
    
    // For the next call datepicker
    $("#kt_ecommerce_add_next_call_log_datepicker").flatpickr   ({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        onClose: function(selectedDates, dateStr, instance) {
            // You can handle any actions here after the date is selected
        }
    });
    return {
        init: function () {
            (i = new bootstrap.Modal(document.querySelector("#kt_modal_add_log"))),
                (r = document.querySelector("#kt_modal_add_log_form")),
                (t = r.querySelector("#kt_modal_add_log_submit")),
                (e = r.querySelector("#kt_modal_add_log_cancel")),
                (o = r.querySelector("#kt_modal_add_log_close")),
                
                (n = FormValidation.formValidation(r, {
                    fields: {
                        customer_response: { validators: { notEmpty: { message: "Customer response is required" } } },
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                })),
                t.addEventListener("click", function (e) {
                    e.preventDefault();
                    if (n) {
                        n.validate().then(function (status) {
                            if (status === "Valid") {
                                var formData = $(r).serialize(); // Serialize form data
                                var leadId = document.getElementById('id').value;
                                $.ajax({
                                    url: '/add-call-log', // Replace with your endpoint URL
                                    type: 'POST',
                                    contentType: 'application/json',
                                    data: JSON.stringify({
                                        call_date_time: $('#kt_ecommerce_add_call_log_datepicker').val(),
                                        customer_response: $('input[name="customer_response"]').val(),
                                        next_call_date_time: $('#kt_ecommerce_add_next_call_log_datepicker').val(),
                                        id: leadId // Assuming you have this variable correctly set
                                    }),
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    beforeSend: function () {
                                        console.log(formData);
                                        t.setAttribute("data-kt-indicator", "on");
                                        t.disabled = true;
                                    },
                                    success: function (response) {
                                        // Handle success. For example:
                                        Swal.fire({ 
                                            text: "Form has been successfully submitted!", 
                                            icon: "success", 
                                            buttonsStyling: !1, 
                                            confirmButtonText: "Ok, got it!", 
                                            customClass: { confirmButton: "btn btn-primary" } })
                                            .then(
                                            function (e) {
                                                e.isConfirmed && (i.hide(), 
                                                (t.disabled = !1), 
                                                window.location.reload());
                                            });
                                    },
                                    error: function (error) {
                                        Swal.fire({
                                            text: "Sorry, looks like there are some errors detected, please try again.",
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: { confirmButton: "btn btn-primary" },
                                        });
                                    },
                                    complete: function () {
                                        t.removeAttribute("data-kt-indicator");
                                        t.disabled = false;
                                    }
                                });
                            } else {
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
                    t.preventDefault(),
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
                                : "cancel" === t.dismiss && Swal.fire({ text: "Your form has not been cancelled!.", icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } });
                        });
                });
                o.addEventListener("click", function (t) {
                    t.preventDefault(),
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
                                : "cancel" === t.dismiss && Swal.fire({ text: "Your form has not been cancelled!.", icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } });
                        });
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalLogsAdd.init();
});
