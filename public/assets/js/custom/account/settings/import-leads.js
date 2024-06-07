"use strict";
var KTModalLogsAdd = (function () {
    var n;
    const checkFileType = function() {
        return {
            validate: function (input) {
                var file = input.element.files[0];
                if (file && (file.type === "text/csv" || file.type === "application/vnd.ms-excel")) {
                    return { valid: true };
                }
                return { valid: false, message: "File must be in CSV format" };
            }
        };
    };
    FormValidation.validators.checkFileType = checkFileType;

    return {
        init: function () {
            // Modal and form references
            var modalInstance = new bootstrap.Modal(document.querySelector("#import_csv"));
            var form = $("#import_csv_form");
            var submitButton = $("#import_csv_submit");
            var cancelButton = $("#import_csv_cancel");
            var closeButton = $("#import_csv_close");

            // Form validation setup
            (n = FormValidation.formValidation(form[0], {
                fields: {
                    leadsImportCSV: { validators: { 
                        notEmpty: { message: "CSV file is required" },
                        checkFileType: { message: "File must be in CSV format" },
                    } },
                },
                plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
            })),

            // Submit button event
            submitButton.click(function (e) {
                e.preventDefault();
                n.validate().then(function (status) {
                    if (status === "Valid") {
                        var formData = new FormData();
                        var fileInput = $('#leadsImportCSV')[0];
                        if (fileInput.files.length > 0) {
                            formData.append('leadsImportCSV', fileInput.files[0]);

                            $.ajax({
                                url: '/import-leads-csv', // Replace with your endpoint URL
                                type: 'POST',
                                processData: false,  // tell jQuery not to process the data
                                contentType: false,
                                data: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                beforeSend: function () {
                                    submitButton.attr("data-kt-indicator", "on");
                                    submitButton.prop("disabled", true);
                                },
                                success: function (response) {
                                    Swal.fire({
                                        text: response.msg,
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: { confirmButton: "btn btn-primary" }
                                    }).then(function (result) {
                                        if (result.isConfirmed) {
                                            modalInstance.hide();
                                            submitButton.prop("disabled", false);
                                            window.location.href = '/leads';
                                        }
                                    });
                                },
                                error: function (error) {
                                    Swal.fire({
                                        text: "Sorry, looks like there are some errors detected, please try again.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: { confirmButton: "btn btn-primary" }
                                    });
                                },
                                complete: function () {
                                    submitButton.removeAttr("data-kt-indicator");
                                    submitButton.prop("disabled", false);
                                }
                            });
                        }
                        else{
                            Swal.fire({
                                text: "Please select a file.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: { confirmButton: "btn btn-primary" }
                            });
                        }
                        
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn btn-primary" }
                        });
                    }
                });
            });

            // Cancel button event
            cancelButton.click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                $('input').blur();
                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light" }
                }).then(function (result) {
                    if (result.value) {
                        form[0].reset();
                        modalInstance.hide();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            text: "Your form has not been cancelled!",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn btn-primary" }
                        });
                    }
                });
            });

            // Close button event
            closeButton.click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                $('input').blur();
                Swal.fire({
                    text: "Are you sure you would like to close?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, close it!",
                    cancelButtonText: "No, keep it",
                    customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light" }
                }).then(function (result) {
                    if (result.value) {
                        form[0].reset();
                        modalInstance.hide();
                    }
                });
            });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalLogsAdd.init();
});
