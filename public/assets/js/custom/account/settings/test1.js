"use strict";

var KTModalLogsAdd = (function () {
    var submitButton, cancelButton, closeButton, modalInstance, form, validator;
    
    function initializeDatepickers() {
        // Only initialize each flatpickr instance once
        if (!$.fn.flatpickr) return; // Make sure flatpickr is loaded

        $("#kt_ecommerce_add_call_log_datepicker").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            onClose: function(selectedDates, dateStr, instance) {
                console.log('DatePicker closed');
            }
        });

        $("#kt_ecommerce_add_next_call_log_datepicker").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i"
        });
    }

    function initValidation() {
        validator = FormValidation.formValidation(form, {
            fields: {
                customer_response: { validators: { notEmpty: { message: "Customer response is required" } } },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({ 
                    rowSelector: ".fv-row", 
                    eleInvalidClass: "", 
                    eleValidClass: "" 
                }),
            },
        });
    }

    function handleFormSubmission() {
        submitButton.addEventListener("click", function (e) {
            e.preventDefault();
            if (validator) {
                validator.validate().then(function (status) {
                    if (status === "Valid") {
                        var formData = $(form).serialize(); // Serialize form data

                        // AJAX request
                        sendFormData(formData);
                    } else {
                        displayErrorModal("Sorry, looks like there are some errors detected, please try again.");
                    }
                });
            }
        });
    }

    function sendFormData(formData) {
        $.ajax({
            url: 'your-endpoint-url', // Replace with your endpoint URL
            type: 'POST',
            data: formData,
            beforeSend: function () {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;
            },
            success: function (response) {
                displaySuccessModal("Form has been successfully submitted!");
            },
            error: function (error) {
                displayErrorModal("Sorry, looks like there are some errors detected, please try again.");
            },
            complete: function () {
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;
            }
        });
    }

    function displaySuccessModal(text) {
        Swal.fire({ 
            text: text, 
            icon: "success", 
            buttonsStyling: false, 
            confirmButtonText: "Ok, got it!", 
            customClass: { confirmButton: "btn btn-primary" } 
        }).then(function (e) {
            if (e.isConfirmed) {
                modalInstance.hide();
                window.location = form.getAttribute("data-kt-redirect");
            }
        });
    }

    function displayErrorModal(text) {
        Swal.fire({
            text: text,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: { confirmButton: "btn btn-primary" },
        });
    }

    return {
        init: function () {
            modalInstance = new bootstrap.Modal(document.querySelector("#kt_modal_add_log"));
            form = document.querySelector("#kt_modal_add_log_form");
            submitButton = form.querySelector("#kt_modal_add_log_submit");
            cancelButton = form.querySelector("#kt_modal_add_log_cancel");
            closeButton = form.querySelector("#kt_modal_add_log_close");

            initializeDatepickers();
            initValidation();
            handleFormSubmission();
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTModalLogsAdd.init();
});
