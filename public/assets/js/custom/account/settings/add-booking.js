"use strict";

var KTNewBooking = (function () {
    var isLocked, t, e, r, installmentAmount, numberOfInstallments, totalAmount, bookingId, customerImageWrapper, partPaymentInput;
    var numberOfInstallmentsInput = document.getElementById('num_of_installments');
    var discountAmountInput = document.getElementById('discount_amount');
    var discountPercentageInput = document.getElementById('discount_percentage');

    function updatePaymentPlanDisplay() {
        var paymentPlan = $('#paymentPlan').val();
        let tableBody = $('#installmentTable tbody');
        tableBody.empty(); 
        if(!isLocked){numberOfInstallmentsInput.value = '';}
        $('#customerDropdown, #numOfInstallmentsInput, #installmentAmountInput, #installmentTableCard, #installments').hide();
        $('#discountType').hide();
        $('#partPaymentInput').hide();
        $('#discountPlan').hide();
        if (paymentPlan === 'full_cash') {
            $('#installmentTableCard').show();
            totalAmount = parseInt(document.getElementById('total_amount').value, 10);
            numberOfInstallmentsInput.value = '1';
            document.getElementById('installment_amount').value = (totalAmount/1);
            generateInstallmentTable(null, 1, totalAmount, new Date());
        } else if (paymentPlan === 'installment') {
            $('#numOfInstallmentsInput').show(); 
            $('#installmentAmountInput').show(); 
            $('#installmentTableCard').show();
            $('#installments').show();
        } else if (paymentPlan === 'part_payment') {
            $('#partPaymentInput').show(); 
            $('#discountPlan').show(); 
            $('#discountType').show(); 
            $('#numOfInstallmentsInput').show(); 
            $('#installmentAmountInput').show(); 
            $('#installments').show();
            $('#installmentTableCard').show();
        }
    }

    function monthDiff(d1, d2) {
        var months = (d2.getFullYear() - d1.getFullYear()) * 12;
        months -= d1.getMonth();
        months += d2.getMonth();
        return months <= 0 ? 0 : months;
    }

    function generateInstallmentTable(partPayment, numberOfInstallments, installmentAmount, bookingDate) {
        let tableBody = $('#installmentTable tbody');
        tableBody.empty(); // Clear existing rows
        
        numberOfInstallments = partPayment === null ? numberOfInstallments : (numberOfInstallments + 1);
        partPayment = partPayment === null ? installmentAmount : partPayment;

        let discountAmount;
        if($('#discount_type').val() === 'discount_amount'){
            discountAmount = parseFloat(document.getElementById('discount_amount').value);
        } else if($('#discount_type').val() === 'discount_percentage'){
            discountAmount = (parseFloat(discountPercentageInput.value) / 100) * parseFloat(document.getElementById('total_amount').value, 10);
        }

        let adjustedInstallmentsCount = Math.ceil(discountAmount / installmentAmount);
        let lastInstallmentsAdjustment = Array(numberOfInstallments).fill(0);

        for (let i = 0; i < adjustedInstallmentsCount; i++) {
            let index = numberOfInstallments - 1 - i; // Start adjusting from the last installment backwards
            let adjustment = (discountAmount > installmentAmount) ? installmentAmount : discountAmount;
            lastInstallmentsAdjustment[index] = adjustment;
            discountAmount -= adjustment;
        }

        for (let i = 0; i < numberOfInstallments; i++) {
            let dueDate = new Date(bookingDate);
            dueDate.setMonth(dueDate.getMonth() + i); // Increment month by i

            let intimationDate = new Date(dueDate.getTime());
            intimationDate.setDate(dueDate.getDate() + 5);

            let installmentValue = i === 0 ? partPayment - lastInstallmentsAdjustment[i] : installmentAmount - lastInstallmentsAdjustment[i];
            if (installmentValue <= 0) {
                break;
            }
            
            let row = `
                <tr>
                    <td><input class="form-control form-control-lg form-control-solid installment-input" type="number" name="amounts[]" value="${installmentValue.toFixed(2)}" data-index="${i}"></td>
                    <td><input class="form-control form-control-lg form-control-solid" type="date" name="due_dates[]" value="${dueDate.toISOString().split('T')[0]}" readonly></td>
                    <td><input class="form-control form-control-lg form-control-solid" type="date" name="intimation_dates[]" value="${intimationDate.toISOString().split('T')[0]}" readonly></td>
                    <td><input class="form-control form-control-lg form-control-solid" type="text" name="statuses[]" value="pending" readonly></td>
                </tr>
            `;
            tableBody.append(row);
        }
        attachEventListeners();
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
            if($('#paymentPlan').val() === 'installment'){
                totalAmount = parseFloat(document.getElementById('total_amount').value, 10);
                installmentAmount = totalAmount/parseInt(numberOfInstallments,10);
                partPaymentInput = null;
            } else if($('#paymentPlan').val() === 'part_payment'){
                totalAmount = document.getElementById('pending_amount').value;
                installmentAmount = totalAmount/(parseInt(numberOfInstallments,10));
                partPaymentInput = parseFloat(document.getElementById('part_payment_amount').value);
            }

            document.getElementById('installment_amount').value = installmentAmount;
            generateInstallmentTable(partPaymentInput, numberOfInstallments, installmentAmount, new Date());
        }
    }

    function updateInstallments(inputElement) {
        totalAmount = parseFloat(document.getElementById('total_amount').value); // Total contract value
        const inputs = Array.from(document.querySelectorAll('input[name="amounts[]"]'));
        const statuses = Array.from(document.querySelectorAll('input[name="statuses[]"]'));
    
        const changedIndex = parseInt(inputElement.getAttribute('data-index'));
        const changedStatus = statuses[changedIndex].value;
    
        // Exit if the changed installment is not pending
        if (changedStatus !== 'pending') {
            return;
        }
    
        // Compute the total paid or fixed up to the changed installment
        const paidTotal = inputs.slice(0, changedIndex + 1).reduce((acc, input, index) => {
            return acc + parseFloat(input.value);
        }, 0);
    
        let remainingAmount = totalAmount - paidTotal;
        const unpaidIndexes = inputs.slice(changedIndex + 1).reduce((acc, input, index) => {
            const realIndex = changedIndex + 1 + index;
            if (statuses[realIndex].value === 'pending') {
                acc.push(realIndex);
            }
            return acc;
        }, []);
    
        // Adjust future 'pending' installments
        if (unpaidIndexes.length > 0) {
            const newInstallmentAmount = remainingAmount / unpaidIndexes.length;
            unpaidIndexes.forEach(index => {
                inputs[index].value = newInstallmentAmount.toFixed(2);
            });
        }
    }
    
    function attachEventListeners() {
        // Attach the change event listener to only editable (pending) installment inputs
        $('#installmentTable').on('change', 'input.installment-input', function() {
            updateInstallments(this);
        });
    }
    

    function renderInstallments(installments) {
        let tableBody = $('#installmentTable tbody');
        tableBody.empty(); // Clear the table first
        let i = 0;
        installments.forEach(installment => {
            const isEditable = installment.installment_status === 'pending' || installment.installment_status === 'unpaid';
            let row = `
                <tr>
                    <input type="hidden" name="installment_ids[]" value="${installment.id || ''}">
                    <td><input type="number" name="amounts[]" value="${Number(installment.amount).toFixed(2)}" class="form-control ${isEditable ? 'installment-input' : ''}" ${isEditable ? '' : 'readonly disabled'} data-index="${i}"></td>
                    <td><input type="date" name="due_dates[]" value="${installment.due_date}" class="form-control" readonly disabled></td>
                    <td><input type="date" name="intimation_dates[]" value="${installment.intimation_date}" class="form-control" readonly disabled></td>
                    <td><input type="text" name="statuses[]" value="${installment.installment_status}" class="form-control" readonly disabled></td>
                </tr>
            `;
            tableBody.append(row);
            i++;
        });

        attachEventListeners();
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
    function customerExists(){
        $('#customerExistsCheck').hide();
        if($('#customer_exists_yes').is(':checked')){
            $('#customerExistsCheck').show();
        } else if($('#customer_exists_no').is(':checked')){
            $('#customerExistsCheck').hide();
            $('#customerDropdown').val('').trigger('change');
            document.getElementById('customer_name').value = '';
            document.getElementById('customer_cnic').value = '';
            document.getElementById('mobile_no').value = '';
            document.getElementById('customer_address').value = '';
            customerImageWrapper = document.querySelector('.image-input-wrapper');
            customerImageWrapper.style.backgroundImage = 'none';
            customerImageWrapper.style.backgroundImage = "url('assets/media/svg/avatars/blank.svg')";
        }
    }

    function loadCustomer(customerId) {
        $.ajax({
            url: `/get-customer/${customerId}`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    populateCustomerFields(response.data);
                } else {
                    console.error('Failed to fetch customer.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching customer:', error);
            }
        });
    }

    function populateCustomerFields(customerData){
        customerImageWrapper = document.querySelector('.image-input-wrapper');
        if (customerData.length > 0) {
            var customer = customerData[0];
            document.getElementById('customer_id_dropdown').value = customer.id;
            document.getElementById('existing_customer_image').value = customer.customer_image;
            document.getElementById('existing_cnic_image').value = customer.customer_cnic_image;
            document.getElementById('existing_nok_cnic_image').value = customer.nok_cnic_image;
            document.getElementById('existing_thumb_impression').value = customer.thumb_impression;
            document.getElementById('customer_name').value = customer.name;
            document.getElementById('customer_cnic').value = customer.cnic_number;
            document.getElementById('mobile_no').value = customer.mobile_number_1;
            document.getElementById('customer_address').value = customer.address;
            document.getElementById('nok_name').value = customer.next_of_kin_name;
            document.getElementById('nok_relation').value = customer.next_of_kin_relation;
            document.getElementById('nok_address').value = customer.next_of_kin_address;
            document.getElementById('nok_mobile_no').value = customer.next_of_kin_mobile_number_1;
            document.getElementById('nok_cnic').value = customer.next_of_kin_cnic;
            if (customer.customer_image) {
                var imageUrl = '/images/customer-images/' + customer.customer_image; // Update the base URL path as needed
                customerImageWrapper.style.backgroundImage = `url(${imageUrl})`;
            } else {
                customerImageWrapper.style.backgroundImage = "url('assets/media/svg/avatars/blank.svg')";
            }
        }
    }

    const checkDiscount = function() {
        return {
            validate: function (input) {
                const value = input.value;
                const discountValue = value ? parseFloat(value, 10) : 0;
                const totalAmount = parseFloat(document.getElementById('total_amount').value, 10);
                if (discountValue > totalAmount) {
                    return {
                        valid: false,
                    };
                }
                return {
                    valid: true,
                };
            }
        }
    };
    FormValidation.validators.checkDiscount = checkDiscount;
    
    function calculateTotalAmount(){
        var extraCharges = parseFloat(document.getElementById('extra_charges').value) || 0;
        var developmentCharges = parseFloat(document.getElementById('development_charges').value) || 0;
        var unitCost = parseFloat(document.getElementById('unit_cost').value) || 0;

        document.getElementById('total_amount').value = extraCharges + developmentCharges + unitCost;
    }

    return {
        init: function () {
            document.getElementById('extra_charges').addEventListener('keyup', calculateTotalAmount);
            document.getElementById('development_charges').addEventListener('keyup', calculateTotalAmount);
            document.getElementById('unit_cost').addEventListener('keyup', calculateTotalAmount);
            var bookingDate = document.getElementById('fetchedBookingDate').value;
            $("#kt_ecommerce_booking_datepicker").flatpickr({
                enableTime: false,
                altInput: true,
                defaultDate: bookingDate ? bookingDate : new Date(),
                dateFormat: "Y-m-d",
            });
            t = document.querySelector("#kt_new_booking_form");
            e = document.querySelector("#kt_new_booking_submit");// Ensure this ID matches your plot dropdown ID
            isLocked = document.getElementById('isLocked').value; 
            function makeInputsReadonly() {
                // $('form:not(.kt_account_deactivate_form)').find('input, select, textarea, button[type="submit"], input[type="submit"]').attr('readonly', true).attr('disabled', 'disabled');
                $('form#kt_new_booking_form').find('input, select, textarea')
                .attr('readonly', true)
                .attr('disabled', 'disabled');
            };
            r = FormValidation.formValidation(t, {
                fields: {
                    discount_amount: {validators: {checkDiscount: {message: "Discount amount must be less than the total amount"} } },
                    project_id: { validators: { notEmpty: { message: "Project is required" } } },
                    project_phase: { validators: { notEmpty: { message: "Project phase is required" } } },
                    plot_id: { validators: { notEmpty: { message: "Plot is required" } } },
                    customer_name: { validators: { notEmpty: { message: "Customer name is required" } } },
                    customer_cnic: { validators: { notEmpty: { message: "Customer CNIC is required" } } },
                    customer_address: { validators: { notEmpty: { message: "Customer Address is required" } } },
                    mobile_no: { validators: { notEmpty: { message: "Customer Mobile Number is required" } } },
                    unit_cost: { validators: { notEmpty: { message: "Customer Mobile Number is required" } } },
                    extra_charges: { validators: { notEmpty: { message: "Extra Charges is required" } } },
                    development_charges: { validators: { notEmpty: { message: "Development Charges is required" } } },
                    total_amount: { validators: { notEmpty: { message: "Total Amount is required" } } },
                    token_amount: { validators: { notEmpty: { message: "Token Amount is required" } } },
                    advance_amount: { validators: { notEmpty: { message: "Advance Amount is required" } } },
                    discount_percentage: {
                        validators: {
                            greaterThan: {message: 'The value must be greater than or equal to 0', min: 0},
                            lessThan: {message: 'The value must be less than or equal to 100', max: 100}
                        }
                    },
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
                $('input[name="customer_exists"]').on('change', customerExists);
                updatePaymentPlanDisplay();
                customerExists();
                $('#customerDropdown').on('change', function(e){
                    var customerId = e.target.value;
                    if(customerId) { // Check if customerId is not empty
                        loadCustomer(customerId);
                    } else {
                        console.log('no customer');
                    }
                });
                $('#projectDropdown').on('change', function(e){
                    $('#phaseDropdown').val('').trigger('change');
                    $('#plotDropdown').val('').trigger('change');
                    var projectId = e.target.value;
                    loadPhases(projectId);
                });
                $('#phaseDropdown').on('change', function(e){
                    $('#plotDropdown').val('').trigger('change');
                    var phaseId = e.target.value;
                    loadPlots(phaseId);
                });
                $('#discount_type').on('change', function() {
                    var discountType = $(this).val();
                    document.getElementById('discount_amount').value = '';
                    document.getElementById('discount_percentage').value = '';
                    document.getElementById('pending_amount').value = '';
                    numberOfInstallmentsInput.value = '';
                    document.getElementById('installment_amount').value = '';
                    $('#installmentTable tbody').empty();
                    $('#discountPlan').show(); // Show the discount plan section
                    $('#installments, #numOfInstallmentsInput, #installmentAmountInput').show();
                
                    if(discountType === 'discount_amount') {
                        $('#discountAmount').show(); // Show discount amount input
                        $('#discountPercentage').hide(); // Hide discount percentage input
                    } else if(discountType === 'discount_percentage') {
                        $('#discountAmount').hide(); // Hide discount amount input
                        $('#discountPercentage').show(); // Show discount percentage input
                    }
                });
                
                if ($('#projectDropdown').val() !== "" && isLocked === 'false') {
                    $('#phaseDropdown').val('').trigger('change');
                    $('#plotDropdown').val('').trigger('change');
                    loadPhases($('#projectDropdown').val());
                    loadPlots($('#phaseDropdown').val());
                }
                else if(isLocked === 'true')
                {
                    $('#customerExistsCheck').hide();
                    makeInputsReadonly();
                    bookingId = document.getElementById('id').value;
                    console.log(bookingId);
                    if(bookingId) {
                        fetchInstallments(bookingId);
                    }
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
                discountAmountInput.addEventListener('focusout', function (){
                    let pendingAmount = parseFloat(document.getElementById('total_amount').value, 10) - parseFloat(document.getElementById('part_payment_amount').value, 10);
                    document.getElementById('pending_amount').value = pendingAmount;
                });  
                discountPercentageInput.addEventListener('focusout', function (){
                    let pendingAmount = parseFloat(document.getElementById('total_amount').value, 10) - parseFloat(document.getElementById('part_payment_amount').value, 10);
                    document.getElementById('pending_amount').value = pendingAmount;
                });              
            });            
            
            e.addEventListener("click", function (a) {
                a.preventDefault();
                r.validate().then(function (r) {
                    if (r === "Valid") {
                        e.setAttribute("data-kt-indicator", "on");
                            e.disabled = true;
                            var formData = new FormData(t);
                            console.log(formData);
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
                                        text: 'Booking saved successfully',
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
