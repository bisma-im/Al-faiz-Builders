"use strict";
var KTAuthNewPassword = (function () {
    var t,
        e,
        r,
        o,
        a = function () {
            return 100 === o.getScore();
        };
    return {
        init: function () {
            (t = document.querySelector("#kt_new_password_form")),
                (e = document.querySelector("#kt_new_password_submit")),
                (o = KTPasswordMeter.getInstance(t.querySelector('[data-kt-password-meter="true"]'))),
                (r = FormValidation.formValidation(t, {
                    fields: {
                        password: {
                            validators: {
                                notEmpty: { message: "The password is required" },
                                callback: {
                                    message: "Please enter valid password",
                                    callback: function (t) {
                                        if (t.value.length > 0) return a();
                                    },
                                },
                            },
                        },
                        "confirm_password": {
                            validators: {
                                notEmpty: { message: "The password confirmation is required" },
                                identical: {
                                    compare: function () {
                                        return t.querySelector('[name="new_password"]').value;
                                    },
                                    message: "The password and its confirm are not the same",
                                },
                            },
                        },
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger({ event: { password: !1 } }), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                })),
                e.addEventListener("click", function (a) {
                    a.preventDefault(),
                    r.revalidateField("new_password"),
                    r.validate().then(function (r) {
                        if (r === "Valid") {
                            e.setAttribute("data-kt-indicator", "on");
                            e.disabled = true;
            
                            // Prepare form data
                            var formData = new FormData(t);
                            var object = {};
                            formData.forEach(function (value, key) {
                                object[key] = value;
                            });
                            var json = JSON.stringify(object);
            
                            // AJAX request to server
                            fetch('/change-password', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': t.querySelector('input[name="_token"]').value
                                },
                                body: json
                            })
                            .then(function (response) {
                                return response.json();
                            })
                            .then(function (data) {
                                e.removeAttribute("data-kt-indicator");
                                e.disabled = false;
            
                                if (data.success) {
                                    Swal.fire({
                                        text: "You have successfully reset your password!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: { confirmButton: "btn btn-primary" }
                                    }).then(function (e) {
                                        if (e.isConfirmed) {
                                            (t.querySelector('[name="new_password"]').value = ""), 
                                            (t.querySelector('[name="confirm_password"]').value = ""), 
                                            (t.querySelector('[name="current_password"]').value = ""), 
                                            o.reset();
                                            var redirectUrl = t.getAttribute("data-kt-redirect-url");
                                            if (redirectUrl) {
                                                location.href = redirectUrl;
                                            }
                                        }
                                    });
                                } else {
                                    throw new Error(data.error || 'An unknown error occurred.');
                                }
                            })
                            .catch(function (error) {
                                Swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again. Error: " + error.message,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: { confirmButton: "btn btn-primary" }
                                });
                            });
            
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
    KTAuthNewPassword.init();
});
