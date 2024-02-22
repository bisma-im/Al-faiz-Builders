"use strict";

var KTNewBooking = (function () {
    var t, e, r, installmentAmount, numberOfInstallments, totalAmount, bookingId;
    var numberOfInstallmentsInput = document.getElementById('num_of_installments');

    function updatePaymentPlanDisplay() {
        var paymentPlan = $('#paymentPlan').val();
        $('#fullCashInputs, #installmentInputs, #partPaymentInputs, #installmentTable').hide();
        if (paymentPlan === 'full_cash') {
            $('#fullCashInputs').show();
        } else if (paymentPlan === 'installment') {
            $('#installmentInputs, #installmentTable').show();
        } else if (paymentPlan === 'part_payment') {
            $('#partPaymentInputs').show();
        }
    }

    function monthDiff(d1, d2) {
        var months = (d2.getFullYear() - d1.getFullYear()) * 12;
        months -= d1.getMonth();
        months += d2.getMonth();
        return months <= 0 ? 0 : months;
    }

    function generateInstallmentTable(numberOfInstallments, installmentAmount, bookingDate) {
        let tableBody = $('#installmentTable tbody');
        tableBody.empty(); // Clear existing rows
    
        for (let i = 0; i < numberOfInstallments; i++) {
            let dueDate = new Date(bookingDate);
            dueDate.setMonth(dueDate.getMonth() + i); // Increment month by i

            let intimationDate = new Date(dueDate.getTime());
            intimationDate.setDate(dueDate.getDate() + 5);
            
            let row = `
                <tr>
                    <td><input class="form-control form-control-lg form-control-solid" type="text" name="amounts[]" value="${installmentAmount.toFixed(2)}" ${i === 0 ? 'readonly' : ''}></td>
                    <td><input class="form-control form-control-lg form-control-solid" type="date" name="due_dates[]" value="${dueDate.toISOString().split('T')[0]}" readonly></td>
                    <td><input class="form-control form-control-lg form-control-solid" type="date" name="intimation_dates[]" value="${intimationDate.toISOString().split('T')[0]}" readonly></td>
                    <td>
                        <select name="statuses[]" class="form-select form-select-solid form-select-lg fw-semibold" data-control="select2">
                            <option value="pending">Pending</option>
                            <option value="paid">Paid</option>
                        </select>
                    </td>
                    <td>
                        <select name="payment_modes[]" class="form-select form-select-solid form-select-lg fw-semibold" data-control="select2">
                            <option value="cash">Cash</option>
                            <option value="check">Check</option>
                            <option value="online">Online</option>
                        </select>
                    </td>
                </tr>
            `;
            
            tableBody.append(row);
        }
    }

    function handleInstallments(){
        var projectCompletionDate = new Date($('#phaseDropdown').find('option:selected').attr('data-completion-date'));
        var numberOfMonthsUntilCompletion = monthDiff(new Date(), projectCompletionDate);
        numberOfInstallments = parseInt(numberOfInstallmentsInput.value, 10);

        if (numberOfInstallments > numberOfMonthsUntilCompletion) {
            Swal.fire({
                title: 'Error!',
                text: `Select less than ${numberOfMonthsUntilCompletion} installments`,
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    numberOfInstallmentsInput.value = '';
                }
            });                        
        } else {
            totalAmount = parseFloat(document.getElementById('total_amount').value, 10);
            installmentAmount = totalAmount/parseFloat(numberOfInstallments,10);
            document.getElementById('installment_amount').value = installmentAmount;
            generateInstallmentTable(numberOfInstallments, installmentAmount, new Date());
        }
    }

    function renderInstallments(installments) {
        let tableBody = $('#installmentTable tbody');
        tableBody.empty(); // Clear the table first
    
        installments.forEach(installment => {
            // Determine if dropdowns should be disabled
            let isPaid = installment.installment_status === 'paid';
            let statusDropdownDisabledAttribute = isPaid ? 'disabled' : '';
            let paymentModeDropdownDisabledAttribute = isPaid ? 'disabled' : '';

            // Generate the status and payment mode options with the correct option selected
            let statusOptions = `
                <option value="pending" ${installment.installment_status === 'pending' ? 'selected' : ''}>Pending</option>
                <option value="paid" ${isPaid ? 'selected' : ''}>Paid</option>
            `;
            let paymentModeOptions = `
                <option value="cash" ${installment.payment_mode === 'cash' ? 'selected' : ''}>Cash</option>
                <option value="check" ${installment.payment_mode === 'check' ? 'selected' : ''}>Check</option>
                <option value="online" ${installment.payment_mode === 'online' ? 'selected' : ''}>Online</option>
            `;
    
            // Assuming installment is an object with amount, due_date, etc.
            let row = `
                <tr>
                    <input type="hidden" name="installment_ids[]" value="${installment.id || ''}">
                    <td><input type="text" name="amounts[]" value="${Number(installment.amount).toFixed(2)}" class="form-control"></td>
                    <td><input type="date" name="due_dates[]" value="${installment.due_date}" class="form-control"></td>
                    <td><input type="date" name="intimation_dates[]" value="${installment.intimation_date}" class="form-control"></td>
                    <td>
                        <select name="statuses[]" class="form-select form-select-solid form-select-lg fw-semibold" data-control="select2" ${statusDropdownDisabledAttribute}>
                            ${statusOptions}
                        </select>
                    </td>
                    <td>
                        <select name="payment_modes[]" class="form-select form-select-solid form-select-lg fw-semibold" data-control="select2" ${paymentModeDropdownDisabledAttribute}>
                            ${paymentModeOptions}
                        </select>
                    </td>
                </tr>
            `;
            tableBody.append(row);
        });
    }
    
    function fetchInstallments(bookingId) {
        $.ajax({
            url: `/get-installments/${bookingId}`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    renderInstallments(response.data);
                } else {
                    // Handle error
                    console.error('Failed to fetch installments.');
                }
            },
            error: function(xhr, status, error) {
                // Handle request error
                console.error('Error fetching installments:', error);
            }
        });
    }
        

    return {
        init: function () {
            t = document.querySelector("#kt_new_booking_form");
            e = document.querySelector("#kt_new_booking_submit");// Ensure this ID matches your plot dropdown ID
            var isLocked = document.getElementById('isLocked').value; 
            console.log(isLocked);
            function makeInputsReadonly() {
                $(t).find('input, select, textarea').attr('readonly', true).attr('disabled', 'disabled');
            };
            r = FormValidation.formValidation(t, {
                fields: {
                    project_id: { validators: { notEmpty: { message: "Project is required" } } },
                    project_phase: { validators: { notEmpty: { message: "Project phase is required" } } },
                    plot_id: { validators: { notEmpty: { message: "Plot is required" } } },
                    customer_name: { validators: { notEmpty: { message: "Customer_name is required" } } },
                    customer_cnic: { validators: { notEmpty: { message: "Customer CNIC is required" } } },
                    customer_address: { validators: { notEmpty: { message: "Customer Address is required" } } },
                    mobile_no: { validators: { notEmpty: { message: "Customer Mobile Number is required" } } },
                    unit_cost: { validators: { notEmpty: { message: "Customer Mobile Number is required" } } },
                    extra_charges: { validators: { notEmpty: { message: "extra_charges is required" } } },
                    development_charges: { validators: { notEmpty: { message: "development_charges is required" } } },
                    total_amount: { validators: { notEmpty: { message: "total_amount is required" } } },
                    token_amount: { validators: { notEmpty: { message: "token_amount is required" } } },
                    advance_amount: { validators: { notEmpty: { message: "advance_amount is required" } } },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    e: new FormValidation.plugins.SubmitButton(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }),
                },
            });
            
            $(document).ready(function(){
                var selectedPlot = parseInt($('#bookingForm').data('selected-plot'), 10);
                var selectedPhase = $('#bookingForm').data('selected-phase');
                updatePaymentPlanDisplay();
                bookingId = $('#id').val(); 
                if(bookingId) {
                    fetchInstallments(bookingId);
                }
                $('#projectDropdown').on('change', function(e){
                    var projectId = e.target.value;
                    loadPhases(projectId);
                });
                $('#phaseDropdown').on('change', function(e){
                    var phaseId = e.target.value;
                    loadPlots(phaseId);
                });
                if ($('#projectDropdown').val() !== "" && isLocked === 'false') {
                    loadPhases($('#projectDropdown').val());
                    loadPlots($('#phaseDropdown').val());
                }
                else if(isLocked === 'true')
                {
                    makeInputsReadonly();
                    return; 
                }

                function loadPhases(projectId){
                    $.ajax({
                        url: '/get-phases-for-booking',
                        type: "POST",
                        data: {
                            project_id: projectId,
                            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        dataType: 'json',
                        success: function(result){
                            $('#phaseDropdown').find('option:not(:first)').remove();                            
                            $.each(result, function(index, phase){ 
                                if(phase.id==selectedPhase)
                                    var option = $('<option>').val(phase.id).text(phase.phase_title).attr('selected','selected').attr('data-completion-date', phase.completion_date);
                                else
                                    var option = $('<option>').val(phase.id).text(phase.phase_title).attr('data-completion-date', phase.completion_date);
                                
                                $('#phaseDropdown').append(option);
                            });
                        }
                    });
                }

                function loadPlots(phaseId) {
                    $.ajax({
                        url: '/get-plots-for-booking',
                        type: "POST",
                        data: {
                            phase_id: phaseId,
                            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        dataType: 'json',
                        success: function(result){
                            $('#plotDropdown').find('option:not(:first)').remove();      
                            $.each(result, function(index, plot){ 
                                // if(plot.id==selectedPlot)
                                //     var option = $('<option>').val(plot.id).text(plot.plot_no).attr('selected','selected');
                                // else
                                    var option = $('<option>').val(plot.id).text(plot.plot_no);
                                
                                $('#plotDropdown').append(option);
                            });
                        }
                    });
                }
                $('#paymentPlan').on('change', updatePaymentPlanDisplay);
                numberOfInstallmentsInput.addEventListener('focusout', handleInstallments);                
            });            
            
            e.addEventListener("click", function (a) {
                a.preventDefault();
                r.validate().then(function (r) {
                    if (r === "Valid") {
                        e.setAttribute("data-kt-indicator", "on");
                            e.disabled = true;
                            var formData = new FormData(t);
                            bookingId = $('#id').val(); 
                            var url = bookingId ? '/update-booking' : '/add-booking';
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
                                        text: 'Booking generated successfully',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = t.getAttribute('data-kt-redirect');
                                        }
                                    });
                                }
                                else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'There was a problem generating the booking',
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
    KTNewBooking.init();
});
