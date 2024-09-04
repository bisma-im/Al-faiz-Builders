"use strict";

var KTNewInvoice = (function () {
    var paidRadio = document.getElementById('paid');
    var unpaidRadio = document.getElementById('unpaid');
    var cancelledRadio = document.getElementById('cancelled');
    var paymentDateDiv = document.getElementById('paymentDate');
    var datePickerInput = document.getElementById('kt_ecommerce_payment_datepicker');
    const a = (listData) => {
        const repeater = $("#kt_ecommerce_add_item_options").repeater({
            initEmpty: false,
            defaultValues: { "text-input": "foo" },
            show: function () {
                $(this).slideDown();
                c();  // Ensure function 'c' is defined or remove this if not needed
            },
            hide: function (e) {
                $(this).slideUp(e);
            },
        });

        // Use setList if listData is provided and is an array
        if (Array.isArray(listData) && listData.length > 0) {
            repeater.setList(listData);
        }
    },
        c = () => {
            document.querySelectorAll('[data-kt-ecommerce-catalog-add-project="project_option"]').forEach((e) => {
                $(e).hasClass("select2-hidden-accessible") || $(e).select2({ minimumResultsForSearch: -1 });
            });
        };

    function calculateTotal() {
        var total = 0;
        const repeaterItems = document.querySelectorAll('[data-repeater-item]');
        repeaterItems.forEach((item, index) => {
            // Using attribute selector to match any input name that contains 'serial_number'
            const amountInput = item.querySelector('input[name*="amount"]');

            if (amountInput) {
                total += parseFloat(amountInput.value) || 0;
            } else {
                console.log('Error');
            }
        });
        $('#totalAmount').val(total.toFixed(2));  // Assuming you want to fix to two decimal places
        $('#total').val(total.toFixed(2));
    }
    function generatePdf(reportId) {
        const pdfUrl = `/generate-invoice-pdf?reportId=${reportId}`;
        window.open(pdfUrl, '_blank');

        // Redirect the current window after a short delay.
        setTimeout(function () {
            window.location.href = '/invoices';
        }, 500);
    }
    function togglePaymentDate() {
        datePickerInput.value = ''; // Clear the datepicker input
        if (paidRadio.checked) {
            paymentDateDiv.style.display = 'flex'; // Show the payment date div
        } else {
            paymentDateDiv.style.display = 'none'; // Hide the payment date div
        }
    }
    var t, e, r;
    return {
        init: function () {
            var paymentDate = document.getElementById('fetchedDate').value;
            $("#kt_ecommerce_payment_datepicker").flatpickr({
                enableTime: true,
                altInput: true,
                dateFormat: "Y-m-d H:i:s",
                defaultDate: paymentDate,
            });
            t = document.querySelector("#kt_new_invoice_form");
            e = document.querySelector("#kt_new_invoice_submit");// Ensure this ID matches your plot dropdown ID

            a();

            // Event listeners for radio buttons
            paidRadio.addEventListener('change', togglePaymentDate);
            unpaidRadio.addEventListener('change', togglePaymentDate);
            cancelledRadio.addEventListener('change', togglePaymentDate);

            // Initial check on page load
            togglePaymentDate();

            $(document).on('focusout', 'input[name*="amount"]', function () {
                console.log('Focus out detected on dynamically added element');
                calculateTotal();
            });

            const isInstallment = document.getElementById('isInstallment') ? document.getElementById('isInstallment').value : false;
            const isCharges = document.getElementById('isCharges') ? document.getElementById('isCharges').value : false;

            if (isInstallment || isCharges) {
                const inputs = document.querySelectorAll('#kt_ecommerce_add_item_options input');
                inputs.forEach(function (input) {
                    input.disabled = true;
                });

                // Disable all buttons in the repeater
                const buttons = document.querySelectorAll('#kt_ecommerce_add_item_options button[data-repeater-delete], #kt_ecommerce_add_item_options button[data-repeater-create]');
                buttons.forEach(function (button) {
                    button.style.display = 'none';
                });
            }

            document.querySelector('#kt_ecommerce_add_item_options').addEventListener('click', function (event) {
                if (event.target.matches('[data-repeater-delete], [data-repeater-delete] *')) {
                    console.log('category deleted');
                    setTimeout(calculateTotal, 1000); // Delay update to ensure DOM has updated
                }
            });

            // Initialize form validation
            r = FormValidation.formValidation(t, {
                fields: {
                    booking_id: { validators: { notEmpty: { message: "Booking is required" } } },
                    payment_status: { validators: { notEmpty: { message: "Payment Status is required" } } },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    e: new FormValidation.plugins.SubmitButton(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }),
                },
            });

            var invoiceDataElement = document.getElementById('invoiceData');
            var itemsJson = invoiceDataElement.getAttribute('data-items');
            if (itemsJson) {
                var items = JSON.parse(itemsJson);
                console.log(items);
                a(items);
            }

            $('#bookingDropdown').on('change', function (e) {
                var bookingId = e.target.value;
                $.ajax({
                    url: '/get-booking-details',
                    type: "POST",
                    data: {
                        booking_id: bookingId,
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    dataType: 'json',
                    success: function (response) {
                        // Assuming 'response' is already an object; if not, use JSON.parse(response)
                        // response = JSON.parse(response);
                        $('#project').val(response[0].project_title);  // Update the project title
                        $('#phase').val(response[0].phase_title);      // Update the phase title
                        $('#plot_no').val(response[0].plot_no);           // Update the plot number
                    },
                    error: function (error) {
                        console.log("Error fetching data:", error);
                        // Handle errors here
                    }
                });
            });
            e.addEventListener("click", function (a) {
                a.preventDefault();
                r.validate().then(function (r) {
                    if (r === "Valid") {
                        e.setAttribute("data-kt-indicator", "on");
                        e.disabled = true;
                        var formData = new FormData(t);
                        var invoiceId = formData.get('id');
                        var url = invoiceId ? '/update-invoice' : '/add-invoice';
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
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed && data.reportId !== null) {
                                            generatePdf(data.reportId);
                                        }
                                        else {
                                            window.location.href = '/invoices';
                                        }
                                    });
                                }
                                else {
                                    console.log(data.message);
                                    Swal.fire({
                                        title: 'Error!',
                                        text: data.message,
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
            });
            // Re-validate on change
            $(t.querySelector('[name="customer_id"]')).on("change", function () {
                r.revalidateField("customer_id");
            });
            $(t.querySelector('[name="project_id"]')).on("change", function () {
                r.revalidateField("project_id");
            });
            $(t.querySelector('[name="plot_id"]')).on("change", function () {
                r.revalidateField("plot_id");
            });
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTNewInvoice.init();
});
