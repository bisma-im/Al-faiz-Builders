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
                        full_name: { validators: { notEmpty: { message: "Full name is required" } } },
                        username: { validators: { notEmpty: { message: "Username is required" } } },
                        email: { validators: { notEmpty: { message: "Email is required" }, emailAddress: { message: "The value is not a valid email address" } } },
                        password: { validators: { notEmpty: { message: "Password is required" } } },
                        mobile_no: { validators: { notEmpty: { message: "Mobile number is required" } } },
                        user_access_level: { validators: { notEmpty: { message: "User access level is required" } } },
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
                            fetch('/add-user', {
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
                                        text: 'User added successfully',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = '/test'; // Replace with your desired path
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'There was a problem adding the user',
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

                $(form.querySelector('[name="user_access_level"]')).on("change", function () {
                    validator.revalidateField("user_access_level");
                });
            }
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTAccountSettingsProfileDetails.init();
});
