"use strict";
var KTNewAccount = (function () {
    var t,
        e,
        r;
    return {
        init: function () {
            $("#kt_ecommerce_datepicker").flatpickr({
                enableTime: false,
                altInput: true,
                dateFormat: "Y-m-d",
            });
            (t = document.querySelector("#kt_new_voucher_form")),
                (e = document.querySelector("#kt_new_voucher_submit")),
                (r = FormValidation.formValidation(t, {
                    fields: {
                        amount: { validators: { notEmpty: { message: "Amount is required" } } },
                    },
                    plugins: { 
                        trigger: new FormValidation.plugins.Trigger(),
                        e: new FormValidation.plugins.SubmitButton(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }),
                     },
                })),
                new Dropzone("#kt_ecommerce_add_voucher_media", {
                    url: "https://keenthemes.com/scripts/void.php",
                    autoProcessQueue: false,
                    paramName: "file",
                    maxFiles: 10,
                    maxFilesize: 10,
                    addRemoveLinks: true,
                }),
                e.addEventListener("click", function (a) {
                    a.preventDefault(),
                    r.validate().then(function (r) {
                        if (r === "Valid") {
                            e.setAttribute("data-kt-indicator", "on");
                            e.disabled = true;
            
                            // Prepare form data
                            var formData = new FormData(t);
                            const dropzoneElement = document.querySelector('#kt_ecommerce_add_voucher_media');
                            if (dropzoneElement.dropzone) {
                                const files = dropzoneElement.dropzone.files;
                                files.forEach((file) => {
                                formData.append('voucher_media[]', file, file.name);
                                });
                            }
                            // AJAX request to server
                            fetch('/add-voucher', {
                                method: 'POST',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Voucher saved successfully',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = t.getAttribute('data-kt-redirect'); // Replace with your desired path
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'There was a problem saving the voucher',
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
                                e.removeAttribute("data-kt-indicator");
                                e.disabled = false;
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
                    $(t.querySelector('[name="account_code"]')).on("change", function () {
                        validator.revalidateField("account_code");
                    });
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTNewAccount.init();
});
