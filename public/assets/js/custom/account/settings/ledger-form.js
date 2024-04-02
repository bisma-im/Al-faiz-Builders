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
    return {
        init: function () {
            (t = document.querySelector("#kt_new_account_form")),
                (e = document.querySelector("#kt_new_acount_submit")),
                (r = FormValidation.formValidation(t, {
                    fields: {
                        account_title: { validators: { notEmpty: { message: "Account Title is required" } } },
                    },
                    plugins: { 
                        trigger: new FormValidation.plugins.Trigger(),
                        e: new FormValidation.plugins.SubmitButton(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }),
                     },
                })),
                e.addEventListener("click", function (a) {
                    r.validate().then(function (r) {
                        if (r === "Valid") {
                            e.setAttribute("data-kt-indicator", "on");
                            e.disabled = true;
                            Swal.fire({
                                title: 'Success!',
                                text: 'Success!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    // window.location.href = t.getAttribute('data-kt-redirect'); // Replace with your desired path
                                    t.submit();
                                }
                            });
            
                            // Prepare form data
                            // var formData = new FormData(t);
                            // AJAX request to server
                            // fetch('/show-ledger', {
                            //     method: 'POST',
                            //     headers: {
                            //         'X-Requested-With': 'XMLHttpRequest',
                            //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            //     },
                            //     body: formData
                            // })
                            // .then(response => response.json())
                            // .then(data => {
                            //     if (data.success) {
                                    
                            //     } else {
                            //         Swal.fire({
                            //             title: 'Error!',
                            //             text: 'There was a problem saving the account',
                            //             icon: 'error',
                            //             confirmButtonText: 'OK'
                            //         });
                            //     }
                            // })
                            // .catch(error => {
                            //     // Handle network errors
                            //     Swal.fire({
                            //         title: 'Error!',
                            //         text: 'A network error occurred. Please try again.',
                            //         icon: 'error',
                            //         confirmButtonText: 'OK'
                            //     });
                            // })
                            // .finally(() => {
                            //     e.removeAttribute("data-kt-indicator");
                            //     e.disabled = false;
                            // });
            
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
                    $(t.querySelector('[name="account_head_code"]')).on("change", function () {
                        validator.revalidateField("account_head_code");
                    });
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTNewAccount.init();
});
