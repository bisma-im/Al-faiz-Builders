"use strict";

var KTAccountSettingsProfileDetails = (function () {
    var form, validator, submitButton;

    function passwordValidator() {
        return {
            validate: function(input) {
                var value = input.value;
                var isValid = value.length >= 8 && /[!@#$%^&*(),.?":{}|<>]/g.test(value);
                if (isValid) {
                    return { valid: true };
                } else {
                    return { valid: false, message: 'Password must be at least 8 characters long and include at least one special character.' };
                }
            }
        };
    }

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
                        password: {
                            validators: {
                                notEmpty: { message: "Password is required" },
                                // The custom validator function should be passed directly, not within an object
                                passwordValidator: {
                                    message: 'Password must be at least 8 characters long and include at least one special character.',
                                    validator: function(value, validator, $field) {
                                        var isValid = value.length >= 8 && /[!@#$%^&*(),.?":{}|<>]/g.test(value);
                                        if (isValid) {
                                            return true;
                                        } else {
                                            return {
                                                valid: false,
                                                message: 'Password must be at least 8 characters long and include at least one special character.'
                                            };
                                        }
                                    }
                                }
                            }
                        },
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
                            var userId = formData.get('id'); // Get the user ID from the form data
                            var url = userId ? '/update-user' : '/add-user';
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
                                } else if (data.error === 'Account already exists') {
                                    // Handle the duplicate email error
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Email already exists. Please use a different email.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                                else if (data.error === 'invalid regex') {
                                    // Handle the duplicate email error
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Password must be at least 8 characters long and include at least one special character.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                                else {
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
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'A network error occurred. Please try again.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
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
