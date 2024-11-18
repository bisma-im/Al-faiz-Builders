"use strict";
var KTModalChargesAdd = (function () {
    var t, e, o, n, r, i;
    let totalAmount = document.getElementById('dev_charge');
    let numberOfInstallments = document.getElementById('num_of_installments');
    let installmentAmount = document.getElementById('installment_amount');

    // function generateInvoicePdf(reportId) {
    //     const pdfUrl = `/generate-invoice-pdf?reportId=${reportId}`;
    //     window.open(pdfUrl, '_blank');
    // }
    $("#kt_ecommerce_booking_datepicker").flatpickr({
        enableTime: false,
        altInput: true,
        defaultDate: new Date(),
        dateFormat: "Y-m-d",
    });

    function handleInstallments() {
        const totalAmount = parseFloat(document.getElementById('dev_charge').value);
        const numberOfInstallments = parseInt(document.getElementById('num_of_installments').value);
        const installment = totalAmount / numberOfInstallments;
        installmentAmount.value = installment;
        if(totalAmount && numberOfInstallments){$('#installmentTableCard').show();
        let tableBody = $('#installmentTable tbody');
        tableBody.empty();

        // Prepare dates for installments
        var selectedBookingDate = document.getElementById('kt_ecommerce_booking_datepicker').value;
        let currentDate = new Date(selectedBookingDate); // Set to 15th of the next month
        // Loop to create each row for the installments
        for (let i = 0; i < numberOfInstallments; i++) {
            // Format the due date
            let dueDate = new Date(currentDate);
            dueDate.setMonth(dueDate.getMonth() + i + 1, 15);

            // Calculate the intimation date (5 days before the due date)
            let intimationDate = new Date(dueDate.getTime());
            intimationDate.setDate(dueDate.getDate() - 5);

            let formattedDueDate = formatDate(dueDate); // Format due date
            let formattedIntimationDate = formatDate(intimationDate);

            // Create a row with installment data
            let row = `<tr>
                <td class="text-start"><span>${i + 1}</span></td>
                <td class="text-end">
                    <input class="form-control form-control-lg form-control-solid installment-input" type="number" name="amounts[]" value="${installment.toFixed(2)}" data-index="${i}">
                </td>
                <td class="text-start">
                    <input type="hidden" name="due_dates[]" value="${dueDate.toISOString().split('T')[0]}">
                    <span class="date-display">${formattedDueDate}</span>
                </td>
                <td class="text-center">
                    <input type="hidden" name="intimation_dates[]" value="${intimationDate.toISOString().split('T')[0]}">
                    <span class="date-display">${formattedIntimationDate}</span>
                </td>
                <td><input class="form-control form-control-lg form-control-solid" type="text" name="statuses[]" value="pending" readonly></td>
            </tr>`;

            // Append the row to the table
            tableBody.append(row);
        }}
    }

    function formatDate(date) {
        const options = { day: 'numeric', month: 'short', year: 'numeric' };
        return date.toLocaleDateString('en-GB', options);  // Adjust the locale as needed
    }
    return {
        init: function () {
            r = document.querySelector("#development_charges_form");

            numberOfInstallments.addEventListener('keyup', handleInstallments);
            (n = FormValidation.formValidation(r, {
                fields: {
                    // booking_id: { validators: { notEmpty: { message: "This field is required" } } },
                    dev_charge: { validators: { notEmpty: { message: "This field is required" } } },
                    num_of_installments: { validators: { notEmpty: { message: "This field is required" } } },
                },
                plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
            }))

            $('#development_charges_form').on('submit', function (e) {
                e.preventDefault();
                if (n) {
                    n.validate().then(function (status) {
                        if (status === "Valid") {
                            var formData = new FormData(r); 
                            fetch('/add-dev-charges', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                }
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
                                            text: "Development charges successfully added.",
                                            icon: "success",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: { confirmButton: "btn btn-primary" },
                                        });
                                    }
                                })
                        }
                        else {
                            Swal.fire({
                                text: "Sorry, looks like there are some even more errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: { confirmButton: "btn btn-primary" },
                            });
                        }
                    });
                }
            });
        },

    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalChargesAdd.init();
});
