"use strict";
var KTNewAccount = (function () {
    var t,
        e,
        r;
        // Initialize the "From" date picker
        var fromPicker = flatpickr("#kt_start_datepicker", {
            dateFormat: "d-m-Y",
            onChange: function(selectedDates) {
                toPicker.set('minDate', selectedDates[0]);
            },
        });

        // Initialize the "To" date picker
        var toPicker = flatpickr("#kt_end_datepicker", {
            dateFormat: "d-m-Y",
            onChange: function(selectedDates) {
                fromPicker.set('maxDate', selectedDates[0]);
            },
        });
        
        // function generateTB(reportId) {
        //     const pdfUrl = `/generate-pdf?reportId=${reportId}`;
        //     window.open(pdfUrl, '_blank');
        // }        
    return {
        init: function () {
            (t = document.querySelector("#kt_new_account_form")),
                (e = document.querySelector("#kt_new_acount_submit")),
                (r = FormValidation.formValidation(t, {
                    fields: {
                        start_date: { validators: { notEmpty: { message: "Start date is required" } } },
                        end_date: { validators: { notEmpty: { message: "End date is required" } } },
                    },
                    plugins: { 
                        trigger: new FormValidation.plugins.Trigger(),
                        e: new FormValidation.plugins.SubmitButton(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }),
                     },
                })),
                e.addEventListener("click", function (a) {
                    a.preventDefault();
                    r.validate().then(function (r) {
                        if (r === "Valid") {
                            t.submit();
                        //     e.setAttribute("data-kt-indicator", "on");
                        //     e.disabled = true;            
                        //     // Prepare form data
                        //     var startDate= document.querySelector("#kt_start_datepicker").value;
                        //     var endDate= document.querySelector("#kt_end_datepicker").value;
                        //     var accountCode= document.querySelector('[name="account_head_code"]').value;
                        //     fetch(t.action, {
                        //         method: 'POST',
                        //         headers: {
                        //             'Content-Type': 'application/json',
                        //             'X-Requested-With': 'XMLHttpRequest',
                        //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        //         },
                        //         body: JSON.stringify({ start_date: startDate, end_date: endDate, account_head_code: accountCode })
                        //     })
                        //     .then(response => response.json())
                        //     .then(data => {
                        //         if (data.success) {
                        //             generatePdf(data.reportId);
                        //         } else {
                        //             Swal.fire({
                        //                 text: data.message,
                        //                 icon: "error",
                        //                 buttonsStyling: false,
                        //                 confirmButtonText: "Ok, got it!",
                        //                 customClass: { confirmButton: "btn btn-primary" },
                        //             });
                        //         }
                        //     })
                        //     .catch(error => {
                        //         // Handle network errors
                        //         Swal.fire({
                        //             title: 'Error!',
                        //             text: 'A network error occurred. Please try again.',
                        //             icon: 'error',
                        //             confirmButtonText: 'OK'
                        //         });
                        //     })
                        //     .finally(() => {
                        //         e.removeAttribute("data-kt-indicator");
                        //         e.disabled = false;
                        //     });
            
                        } else {
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: { confirmButton: "btn btn-primary" },
                            });
                        }
                    });
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTNewAccount.init();
});
