"use strict";

var KTAccountSettingsProfileDetails = (function () {
    var form, validator, submitButton;

    return {
        init: function () {
            form = document.getElementById("kt_account_profile_details_form");
            submitButton = form.querySelector("#kt_account_profile_details_submit");

            if (form) {
                validator = FormValidation.formValidation(form, {
                    fields: {
                        full_name: { validators: { notEmpty: { message: "Full Name is required" } } },
                        address: { validators: { notEmpty: { message: "Address is required" } } },
                        mobile_no_1: { validators: { notEmpty: { message: "Mobile number is required" } } },
                        cnic: { validators: { notEmpty: { message: "CNIC is required" } } },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }),
                    },
                });

                submitButton.addEventListener("click", function (event) {
                    event.preventDefault();
                    validator.validate().then(function (status) {
                        if (status === 'Valid') {
                            submitButton.setAttribute("data-kt-indicator", "on");
                            submitButton.disabled = true;

                            var formData = new FormData(form);
                            var userId = formData.get('id'); // Get the user ID from the form data
                            var url = userId ? '/update-customer' : '/add-customer';
                            fetch(url, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'User saved successfully',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = form.getAttribute('data-kt-redirect'); // Replace with your desired path
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'There was a problem saving the user',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            })
                            .catch(error => {
                                // Handle network errors
                            })
                            .finally(() => {
                                submitButton.removeAttribute("data-kt-indicator");
                                submitButton.disabled = false;
                            });
                        } 
                    });
                });
            }
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTAccountSettingsProfileDetails.init();
});
