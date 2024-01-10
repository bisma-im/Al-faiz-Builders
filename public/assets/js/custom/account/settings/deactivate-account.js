"use strict";

var KTAccountSettingsDeactivateAccount = (function () {
    var form, validator, submitButton;
    return {
        init: function () {
            form = document.querySelector("#kt_account_deactivate_form");
            submitButton = document.querySelector("#kt_account_deactivate_account_submit");

            if (form) {
                validator = FormValidation.formValidation(form, {
                    fields: { 
                        deactivate: { 
                            validators: { 
                                notEmpty: { 
                                    message: "Please check the box to deactivate your account" 
                                } 
                            } 
                        } 
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({ 
                            rowSelector: ".fv-row", 
                            eleInvalidClass: "", 
                            eleValidClass: "" 
                        }),
                    },
                });

                submitButton.addEventListener("click", function (event) {
                    event.preventDefault();
                    var username = document.querySelector('[name="username"]').value;
                    var email = document.querySelector('[name="email"]').value;
                    validator.validate().then(function (status) {
                        if (status === 'Valid') {
                            swal.fire({
                                text: "Are you sure you would like to deactivate your account?",
                                icon: "warning",
                                buttonsStyling: false,
                                showDenyButton: true,
                                confirmButtonText: "Yes",
                                denyButtonText: "No",
                                customClass: { 
                                    confirmButton: "btn btn-light-primary", 
                                    denyButton: "btn btn-danger" 
                                },
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // AJAX request to server to deactivate account
                                    fetch('/delete-user', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                        },
                                        body: JSON.stringify({ username: username, email: email })
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok');
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire({ 
                                                text: "Your account has been deactivated.", 
                                                icon: "success", 
                                                confirmButtonText: "Ok", 
                                                buttonsStyling: false, 
                                                customClass: { 
                                                    confirmButton: "btn btn-light-primary" 
                                                } 
                                            });
                                        } else {
                                            throw new Error(data.error || 'There was a problem deactivating the account.');
                                        }
                                    })
                                    .catch(error => {
                                        Swal.fire({ 
                                            text: error.message, 
                                            icon: "error", 
                                            confirmButtonText: "Ok", 
                                            buttonsStyling: false, 
                                            customClass: { 
                                                confirmButton: "btn btn-light-primary" 
                                            } 
                                        });
                                    });
                                } else if (result.isDenied) {
                                    Swal.fire({ 
                                        text: "Account not deactivated.", 
                                        icon: "info", 
                                        confirmButtonText: "Ok", 
                                        buttonsStyling: false, 
                                        customClass: { 
                                            confirmButton: "btn btn-light-primary" 
                                        } 
                                    });
                                }
                            });
                        } else {
                            swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: { 
                                    confirmButton: "btn btn-light-primary" 
                                },
                            });
                        }
                    });
                });
            }
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTAccountSettingsDeactivateAccount.init();
});
