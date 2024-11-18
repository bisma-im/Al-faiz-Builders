"use strict";

var KTNewBooking = (function () {
    var isLocked, t, e, r, installmentAmount, numberOfInstallments, totalAmount, totalAmountforInstallment, bookingId, customerImageWrapper, partPaymentInput;
    var totalAmountAfterAdvAndToken = document.getElementById('remaining_amount');
    var numberOfInstallmentsInput = document.getElementById('num_of_installments');
    var discountAmountInput = document.getElementById('discount_amount');
    var discountPercentageInput = document.getElementById('discount_percentage');
    var fileRegNumber = document.getElementById('file_reg_number');
    var nokCnicInput = document.getElementById('nok_cnic_image');
    var thumbImpressionInput = document.getElementById('thumb_impression');
    var cnicImageInput = document.getElementById('cnic_image');

    function updatePaymentPlanDisplay() {
        var paymentPlan = $('#paymentPlan').val();
        let tableBody = $('#installmentTable tbody');
        tableBody.empty();
        if (!isLocked) { numberOfInstallmentsInput.value = ''; }
        $('#customerDropdown, #numOfInstallmentsInput, #installmentAmountInput, #installmentTableCard, #installments').hide();
        $('#discountType').hide();
        $('#partPaymentInput').hide();
        $('#discountPlan').hide();
        if (paymentPlan === 'full_cash') {
            $('#installmentTableCard').show();
            totalAmountforInstallment = parseInt(totalAmountAfterAdvAndToken.value, 10);
            numberOfInstallmentsInput.value = '1';
            document.getElementById('installment_amount').value = (totalAmountforInstallment / 1);
            generateInstallmentTable(null, 1, totalAmountforInstallment, new Date());
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
        // numberOfInstallments = numberOfInstallments + 1;
        partPayment = partPayment === null ? installmentAmount : partPayment;

        let discountAmount;
        if ($('#discount_type').val() === 'discount_amount') {
            discountAmount = parseFloat(document.getElementById('discount_amount').value);
        } else if ($('#discount_type').val() === 'discount_percentage') {
            discountAmount = (parseFloat(discountPercentageInput.value) / 100) * parseFloat(document.getElementById('total_amount').value, 10);
        }

        let adjustedInstallmentsCount = Math.ceil(discountAmount / installmentAmount);
        let lastInstallmentsAdjustment = Array(numberOfInstallments + 1).fill(0);
        // if ($('#payment_plan').val() === 'part_payment'){
            
        // }
        for (let i = 0; i < adjustedInstallmentsCount; i++) {
            let index = numberOfInstallments - i;  // Adjust to start from the very last installment
            if (index < 2) break;  // Ensure that the first two installments are not adjusted
            let adjustment = (discountAmount > installmentAmount) ? installmentAmount : discountAmount;
            lastInstallmentsAdjustment[index] = adjustment;
            discountAmount -= adjustment;
        }
        console.log(lastInstallmentsAdjustment);

        let initialBookingDate = new Date(bookingDate);

        for (let i = 0; i <= numberOfInstallments; i++) {
            let dueDate = new Date(initialBookingDate);
            let installmentValue;

            if (i === 0) {
                installmentValue = parseFloat(document.getElementById('token_amount').value) + parseFloat(document.getElementById('advance_amount').value);
                dueDate = new Date(); // Set due date for the first installment to today's date
            } else {
                dueDate.setMonth(dueDate.getMonth() + i, 15); // Subsequent installments on the 15th of each month
                installmentValue = (i === 1 ? partPayment : installmentAmount) - lastInstallmentsAdjustment[i];
            }
    
            let intimationDate = new Date(dueDate.getTime());

            if (i !== 0) {
                intimationDate.setDate(dueDate.getDate() - 5);
            }

            let formattedDueDate = formatDate(dueDate); // Format due date
            let formattedIntimationDate = formatDate(intimationDate);

            if (i !== 0 && installmentValue <= 0) {
                break;
            }
            let row = `
                <tr>
                    <td><span>${i + 1}</span></td>
                    <td><input class="form-control form-control-lg form-control-solid installment-input" type="number" name="amounts[]" value="${installmentValue.toFixed(2)}" data-index="${i}"></td>
                    <td>
                        <input type="hidden" name="due_dates[]" value="${dueDate.toISOString().split('T')[0]}">
                        <span class="date-display">${formattedDueDate}</span>
                    </td>
                    <td>
                        <input type="hidden" name="intimation_dates[]" value="${intimationDate.toISOString().split('T')[0]}">
                        <span class="date-display">${formattedIntimationDate}</span>
                    </td>
                    <td><input class="form-control form-control-lg form-control-solid" type="text" name="statuses[]" value="pending" readonly></td>
                </tr>
            `;
            tableBody.append(row);
        }
        attachEventListeners();
    }

    function formatDate(date) {
        const options = { day: 'numeric', month: 'short', year: 'numeric' };
        return date.toLocaleDateString('en-GB', options);  // Adjust the locale as needed
    }

    function handleInstallments() {
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
            if ($('#paymentPlan').val() === 'installment') {
                totalAmountforInstallment = parseFloat(totalAmountAfterAdvAndToken.value, 10);
                installmentAmount = totalAmountforInstallment / parseInt(numberOfInstallments, 10);
                partPaymentInput = null;
            } else if ($('#paymentPlan').val() === 'part_payment') {
                totalAmount = document.getElementById('pending_amount').value;
                installmentAmount = totalAmount / (parseInt(numberOfInstallments, 10));
                partPaymentInput = parseFloat(document.getElementById('part_payment_amount').value);
            }

            document.getElementById('installment_amount').value = installmentAmount;
            var selectedBookingDate = document.getElementById('kt_ecommerce_booking_datepicker').value;
            generateInstallmentTable(partPaymentInput, numberOfInstallments, installmentAmount, selectedBookingDate);
        }
    }

    function updateInstallments(inputElement) {
        totalAmountforInstallment = parseFloat(totalAmountAfterAdvAndToken.value, 10); // Total contract value
        const inputs = Array.from(document.querySelectorAll('input[name="amounts[]"]'));
        const statuses = Array.from(document.querySelectorAll('input[name="statuses[]"]'));

        const changedIndex = parseInt(inputElement.getAttribute('data-index'));
        const changedStatus = statuses[changedIndex].value;

        // Exit if the changed installment is not pending
        if (changedStatus !== 'pending') {
            return;
        }
        console.log('changedIndex: ', changedIndex);
        // Compute the total paid or fixed up to the changed installment
        const paidTotal = inputs.slice(1, changedIndex + 1).reduce((acc, input, index) => {
            return acc + parseFloat(input.value);
        }, 0);
        console.log('paidTotal: ', paidTotal);

        let remainingAmount = totalAmountforInstallment - paidTotal;

        console.log('remainingAmount: ', remainingAmount);
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

    function updateDevelopmentInstallments(inputElement, totalAmountforInstallment) { // Total contract value
        const inputs = Array.from(document.querySelectorAll('input[name="devAmounts[]"]'));
        const statuses = Array.from(document.querySelectorAll('input[name="devStatuses[]"]'));
        const paymentDates = Array.from(document.querySelectorAll('input[name="devPaymentDates[]"]'));

        const changedIndex = parseInt(inputElement.getAttribute('data-index'));
        const changedStatus = statuses[changedIndex].value;
        const changedPaymentDate = paymentDates[changedIndex].value;
        // Exit if the changed installment is not pending
        if (changedStatus !== 'N/A' && changedPaymentDate !== 'N/A') {
            return;
        }
        console.log('changedIndex: ', changedIndex);
        // Compute the total paid or fixed up to the changed installment
        const paidTotal = inputs.slice(0, changedIndex + 1).reduce((acc, input, index) => {
            return acc + parseFloat(input.value);
        }, 0);
        console.log('paidTotal: ', paidTotal);

        let remainingAmount = totalAmountforInstallment - paidTotal;

        console.log('remainingAmount: ', remainingAmount);
        const unpaidIndexes = inputs.slice(changedIndex + 1).reduce((acc, input, index) => {
            const realIndex = changedIndex + 1 + index;
            if (statuses[realIndex].value === 'N/A') {
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
        $('#installmentTable').on('change', 'input.installment-input', function () {
            updateInstallments(this);
        });
        $('#devChargesTable').on('change', 'input.editable-devcharge', function () {
            totalAmountforInstallment = parseFloat(document.getElementById('development_charges').value, 10);
            updateDevelopmentInstallments(this, totalAmountforInstallment);
        });
    }


    function renderInstallments(installments) {
        let tableBody = $('#installmentTable tbody');
        tableBody.empty(); // Clear the table first
        let i = 0;
        installments.forEach(installment => {
            const isEditable = installment.installment_status === 'pending' || installment.installment_status === 'unpaid';
            let formattedDueDate = formatDate(new Date(installment.due_date)); // Format the due date
            let formattedIntimationDate = formatDate(new Date(installment.intimation_date)); // Format the intimation date
            let formattedPayDate = installment.installment_status === 'paid' ? formatDate(new Date(installment.pd)) : installment.installment_status;
            let row = `
                <tr>
                    <td><span>${i + 1}</span></td>
                    <input type="hidden" name="installment_ids[]" value="${installment.id || ''}">
                    <td><input type="number" name="amounts[]" value="${Number(installment.amount).toFixed(2)}" class="form-control ${isEditable ? 'installment-input' : ''}" ${isEditable ? '' : 'readonly disabled'} data-index="${i}"></td>
                    <td>
                        <input type="hidden" name="due_dates[]" value="${installment.due_date}">
                        <span class="date-display">${formattedDueDate}</span>
                    </td>
                    <td>
                        <input type="hidden" name="intimation_dates[]" value="${installment.intimation_date}">
                        <span class="date-display">${formattedIntimationDate}</span>
                    </td>
                    <td>
                        <input type="hidden" name="statuses[]" value="${installment.installment_status}">
                        <span class="date-display">${formattedPayDate}</span>
                    </td>
                    <td><a href="#" data-installmentId = "${installment.id || ''}" class="btn btn-light generate-invoice-link">Generate Invoice</a></td>
                </tr>
            `;
            tableBody.append(row);
            i++;
        });

        attachEventListeners();
    }

    function generateInvoicePdf(reportId) {
        const pdfUrl = `/generate-invoice-pdf?reportId=${reportId}`;
        window.open(pdfUrl, '_blank');
    }

    function generateInvoice(installmentId) {
        console.log(installmentId);
        // Example: Suppose you need to send this ID to a server
        $.ajax({
            url: '/installment-invoice',  // Your server endpoint to handle the invoice generation
            type: 'POST',
            data: {
                installmentId: installmentId,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            success: function (response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Invoice generated successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        generateInvoicePdf(response.reportId);
                    }
                });
            },
            error: function (response) {
                Swal.fire({
                    title: 'Error!',
                    text: response.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
    function fetchInstallments(bookingId) {
        $.ajax({
            url: `/get-installments/${bookingId}`,
            type: 'GET',
            success: function (response) {
                if (response.success) {
                    renderInstallments(response.data);
                } else {
                    // Handle error
                    console.error('Failed to fetch installments.');
                }
            },
            error: function (xhr, status, error) {
                // Handle request error
                console.error('Error fetching installments:', error);
            }
        });
    }
    function customerExists() {
        $('#customerExistsCheck').hide();
        if ($('#customer_exists_yes').is(':checked')) {
            $('#customerExistsCheck').show();
        } else if ($('#customer_exists_no').is(':checked')) {
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
            success: function (response) {
                if (response.success) {
                    populateCustomerFields(response.data);
                } else {
                    console.error('Failed to fetch customer.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching customer:', error);
            }
        });
    }

    function populateCustomerFields(customerData) {
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
            if (customer.thumb_impression) {
                document.getElementById('thumb_impression_preview').src = `images/customer/thumb-impression/${customer.thumb_impression}`;
            }
            if (customer.customer_cnic_image) {
                document.getElementById('customer_cnic_preview').src = `images/customer/customer-cnic/${customer.customer_cnic_image}`;
            }
            if (customer.nok_cnic_image) {
                document.getElementById('nok_cnic_preview').src = `images/customer/nok-cnic/${customer.nok_cnic_image}`;
            }
        }
    }

    function previewImage(input, previewElementId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.querySelector(previewElementId).setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    const checkDiscount = function () {
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

    function calculateTotalAmount() {
        // var extraCharges = parseFloat(document.getElementById('extra_charges').value) || 0;
        // var developmentCharges = parseFloat(document.getElementById('development_charges').value) || 0;
        var unitCost = parseFloat(document.getElementById('unit_cost').value) || 0;

        document.getElementById('total_amount').value = unitCost;
    }

    function calculateTotalAmountAfterAdvAndToken() {
        var tokenAmount = parseFloat(document.getElementById('token_amount').value) || 0;
        var advanceAmount = parseFloat(document.getElementById('advance_amount').value) || 0;
        var totalAmount = parseFloat(document.getElementById('total_amount').value) || 0;

        totalAmountAfterAdvAndToken.value = totalAmount - tokenAmount - advanceAmount;
    }

    return {
        init: function () {
            // document.getElementById('extra_charges').addEventListener('keyup', calculateTotalAmount);
            // document.getElementById('development_charges').addEventListener('keyup', calculateTotalAmount);
            document.getElementById('unit_cost').addEventListener('keyup', calculateTotalAmount);

            //Calculate remaining amount on entry of advance and
            document.getElementById('advance_amount').addEventListener('keyup', calculateTotalAmountAfterAdvAndToken);
            document.getElementById('token_amount').addEventListener('keyup', calculateTotalAmountAfterAdvAndToken);

            if (document.getElementById('isLocked').value === 'true') {
                calculateTotalAmountAfterAdvAndToken();
            }

            nokCnicInput.addEventListener('change', function () {
                previewImage(nokCnicInput, '#nok_cnic_preview');
            });

            thumbImpressionInput.addEventListener('change', function () {
                previewImage(thumbImpressionInput, '#thumb_impression_preview');
            });

            cnicImageInput.addEventListener('change', function () {
                previewImage(cnicImageInput, '#customer_cnic_preview');
            });

            var bookingDate = document.getElementById('fetchedBookingDate').value;
            $("#kt_ecommerce_booking_datepicker").flatpickr({
                enableTime: false,
                altInput: true,
                defaultDate: bookingDate ? bookingDate : new Date(),
                dateFormat: "Y-m-d",
            });
            $('#installmentTable').on('click', 'a.generate-invoice-link', function (event) {
                event.preventDefault();  // Prevent the default anchor click behavior
                var installmentId = this.getAttribute('data-installmentId');  // Get the installment ID from the data attribute
                generateInvoice(installmentId);
                // Now you can use the installmentId to do whatever you need, like making an AJAX call
                console.log('Installment ID:', installmentId);
            });
            t = document.querySelector("#kt_new_booking_form");
            e = document.querySelector("#kt_new_booking_submit");// Ensure this ID matches your plot dropdown ID
            isLocked = document.getElementById('isLocked').value;
            function makeInputsReadonly() {
                $('form#kt_new_booking_form').find('input, select, textarea')
                .not('.editable-devcharge, .editable-devcharge *')
                    .attr('readonly', true)
                    .attr('disabled', 'disabled');
            };
            r = FormValidation.formValidation(t, {
                fields: {
                    discount_amount: { validators: { checkDiscount: { message: "Discount amount must be less than the total amount" } } },
                    project_id: { validators: { notEmpty: { message: "Project is required" } } },
                    project_phase: { validators: { notEmpty: { message: "Project phase is required" } } },
                    plot_id: { validators: { notEmpty: { message: "Plot is required" } } },
                    customer_name: { validators: { notEmpty: { message: "Customer name is required" } } },
                    customer_cnic: { validators: { notEmpty: { message: "Customer CNIC is required" } } },
                    customer_address: { validators: { notEmpty: { message: "Customer Address is required" } } },
                    mobile_no: { validators: { notEmpty: { message: "Customer Mobile Number is required" } } },
                    unit_cost: { validators: { notEmpty: { message: "Customer Mobile Number is required" } } },
                    // extra_charges: { validators: { notEmpty: { message: "Extra Charges is required" } } },
                    // development_charges: { validators: { notEmpty: { message: "Development Charges is required" } } },
                    total_amount: { validators: { notEmpty: { message: "Total Amount is required" } } },
                    token_amount: { validators: { notEmpty: { message: "Token Amount is required" } } },
                    advance_amount: { validators: { notEmpty: { message: "Advance Amount is required" } } },
                    file_reg_number: { validators: { notEmpty: { message: "File Registration No. is required" } } },
                    discount_percentage: {
                        validators: {
                            greaterThan: { message: 'The value must be greater than or equal to 0', min: 0 },
                            lessThan: { message: 'The value must be less than or equal to 100', max: 100 }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    e: new FormValidation.plugins.SubmitButton(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }),
                },
            });

            $(document).ready(function () {
                // var selectedPlot = parseInt($('#bookingForm').data('selected-plot'), 10);
                var selectedPhase = $('#bookingForm').data('selected-phase');
                $('input[name="customer_exists"]').on('change', customerExists);
                updatePaymentPlanDisplay();
                customerExists();
                $('#customerDropdown').on('change', function (e) {
                    var customerId = e.target.value;
                    if (customerId) { // Check if customerId is not empty
                        loadCustomer(customerId);
                    } else {
                        console.log('no customer');
                    }
                });
                $('#plotDropdown').on('change', function (e) {
                    var selectedPlotId = e.target.value;
                    if (selectedPlotId) {
                        $.ajax({
                            url: `/get-registration-number/${selectedPlotId}`,  // Your server endpoint to handle the invoice generation
                            type: 'GET',
                            success: function (response) {
                                if (response.success) {
                                    if (response.data !== null && response.data !== '') {
                                        fileRegNumber.value = response.data;
                                        fileRegNumber.setAttribute('readonly', true);
                                    } else {
                                        fileRegNumber.value = '';
                                        fileRegNumber.removeAttribute('readonly');
                                    }
                                } else {
                                    console.error('Failed to fetch registration number.');
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('Error fetching registration number:', error);
                            }
                        });
                    }
                });
                $('#projectDropdown').on('change', function (e) {
                    $('#phaseDropdown').val('').trigger('change');
                    // $('#plotDropdown').val('').trigger('change');
                    $('#plotDropdown').val('');
                    var projectId = e.target.value;
                    loadPhases(projectId);
                });
                $('#phaseDropdown').on('change', function (e) {
                    // $('#plotDropdown').val('').trigger('change');
                    $('#plotDropdown').val('');
                    var phaseId = e.target.value;
                    loadPlots(phaseId);
                });
                $('#discount_type').on('change', function () {
                    var discountType = $(this).val();
                    document.getElementById('discount_amount').value = '';
                    document.getElementById('discount_percentage').value = '';
                    document.getElementById('pending_amount').value = '';
                    numberOfInstallmentsInput.value = '';
                    document.getElementById('installment_amount').value = '';
                    $('#installmentTable tbody').empty();
                    $('#discountPlan').show(); // Show the discount plan section
                    $('#installments, #numOfInstallmentsInput, #installmentAmountInput').show();

                    if (discountType === 'discount_amount') {
                        $('#discountAmount').show(); // Show discount amount input
                        $('#discountPercentage').hide(); // Hide discount percentage input
                    } else if (discountType === 'discount_percentage') {
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
                else if (isLocked === 'true') {
                    $('#customerExistsCheck').hide();
                    $('#devChargesCard').show();
                    makeInputsReadonly();
                    bookingId = document.getElementById('id').value;
                    console.log(bookingId);
                    if (bookingId) {
                        fetchInstallments(bookingId);
                    }
                    return;
                }

                function loadPhases(projectId) {
                    $.ajax({
                        url: '/get-phases-for-booking',
                        type: "POST",
                        data: {
                            project_id: projectId,
                            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        dataType: 'json',
                        success: function (result) {
                            $('#phaseDropdown').find('option:not(:first)').remove();
                            $.each(result, function (index, phase) {
                                if (phase.id == selectedPhase)
                                    var option = $('<option>').val(phase.id).text(phase.phase_title).attr('selected', 'selected').attr('data-completion-date', phase.completion_date);
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
                        success: function (result) {
                            $('#plotDropdown').find('option:not(:first)').remove();
                            $.each(result, function (index, plot) {
                                // if(plot.id==selectedPlot)
                                //     var option = $('<option>').val(plot.id).text(plot.plot_no).attr('selected','selected');
                                // else
                                var option = $('<option>').val(plot.id).text(`${plot.plot_no} (${plot.category})`);

                                $('#plotDropdown').append(option);
                            });
                        }
                    });
                }
                $('#paymentPlan').on('change', updatePaymentPlanDisplay);
                numberOfInstallmentsInput.addEventListener('focusout', handleInstallments);
                discountAmountInput.addEventListener('focusout', function () {
                    let pendingAmount = parseFloat(document.getElementById('remaining_amount').value, 10) - parseFloat(document.getElementById('part_payment_amount').value, 10);
                    document.getElementById('pending_amount').value = pendingAmount;
                });
                discountPercentageInput.addEventListener('focusout', function () {
                    let pendingAmount = parseFloat(document.getElementById('remaining_amount').value, 10) - parseFloat(document.getElementById('part_payment_amount').value, 10);
                    document.getElementById('pending_amount').value = pendingAmount;
                });
            });
            if (!$('#id').val()) {
                new Dropzone("#kt_ecommerce_add_booking_media", {
                    url: "https://keenthemes.com/scripts/void.php",
                    autoProcessQueue: false,
                    paramName: "file",
                    maxFiles: 10,
                    maxFilesize: 10,
                    addRemoveLinks: true,
                })
            }

            e.addEventListener("click", function (a) {
                a.preventDefault();
                r.validate().then(function (r) {
                    if (r === "Valid") {
                        e.setAttribute("data-kt-indicator", "on");
                        e.disabled = true;
                        var formData = new FormData(t);
                        var devInstallmentIds = document.querySelectorAll('input[name="dev_installment_ids[]"]');

                        // Loop through each input element and append its value to the FormData
                        devInstallmentIds.forEach(function(input) {
                            formData.append('dev_installment_ids[]', input.value);
                        });
                        bookingId = $('#id').val();
                        var url = bookingId ? '/update-booking' : '/add-booking';
                        const dropzoneElement = document.querySelector('#kt_ecommerce_add_booking_media');
                        if (dropzoneElement.dropzone) {
                            const files = dropzoneElement.dropzone.files;
                            files.forEach((file) => {
                                formData.append('booking_media[]', file, file.name);
                            });
                        }
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
            
            $('#devChargesTable').on('click', 'button.generate-invoice-button', function (event) {
                event.preventDefault();  // Prevent the default anchor click behavior
                const devChargeId = this.getAttribute('data-devChargeId'); 
                fetch(`/devcharge-invoice/${devChargeId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ id: devChargeId })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Call the function to handle PDF generation with the returned report ID
                        generateInvoicePdf(data.reportId);
                        document.getElementById(`myButton${devChargeId}`).disabled = true;
                        const inputElement = $(this).closest('tr').find('input[name="devAmounts[]"]');
                if (inputElement.length > 0) {
                    inputElement.prop('readonly', true); // Make input readonly
                    console.log('Input is now readonly:', inputElement);
                }
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error generating invoice.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: `There was an error with the fetch operation: ${error.message}`,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
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
