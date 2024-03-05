"use strict";

var KTAccountSettingsProfileDetails = (function () {
    var form, validator, submitButton;

    function matureLeadExists(){
        if ($('#mature').is(':checked')) {
            $('#transferTo').show();
        } else {
            $('#transferTo').hide();
        }
    }

    return {
        init: function () {
            form = document.getElementById("kt_leads_form");
            submitButton = form.querySelector("#kt_leads_submit");

            if (form) {
                validator = FormValidation.formValidation(form, {
                    fields: {
                        name: { validators: { notEmpty: { message: "Name is required" } } },
                        mobile_no_1: { validators: { notEmpty: { message: "Mobile Number is required" } } },
                        source_of_information: { validators: { notEmpty: { message: "User access level is required" } } },
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
                            var leadId = formData.get('id'); // Get the user ID from the form data
                            var url = leadId ? '/update-lead' : '/add-lead';
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

                $(form.querySelector('[name="source_of_information"]')).on("change", function () {
                    validator.revalidateField("source_of_information");
                });
            }
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTAccountSettingsProfileDetails.init();
});
