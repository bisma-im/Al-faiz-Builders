"use strict";
var KTCustomersList = (function () {
    var t,
        n,
        r = () => {
            const e = n.querySelectorAll('[type="checkbox"]'),
                o = document.querySelector('[data-kt-customer-table-select="delete_selected"]');
            e.forEach((t) => {
                t.addEventListener("click", function () {
                    setTimeout(function () {
                        l();
                    }, 50);
                });
            }),
                o.addEventListener("click", function () {
                    Swal.fire({
                        text: "Are you sure you want to delete selected customers?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: { confirmButton: "btn fw-bold btn-danger", cancelButton: "btn fw-bold btn-active-light-primary" },
                    }).then(function (o) {
                        o.value
                            ? Swal.fire({ text: "You have deleted all selected customers!.", icon: "success", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn fw-bold btn-primary" } }).then(
                                  function () {
                                      e.forEach((e) => {
                                          e.checked &&
                                              t
                                                  .row($(e.closest("tbody tr")))
                                                  .remove()
                                                  .draw();
                                      });
                                      n.querySelectorAll('[type="checkbox"]')[0].checked = !1;
                                  }
                              )
                            : "cancel" === o.dismiss &&
                              Swal.fire({ text: "Selected customers was not deleted.", icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn fw-bold btn-primary" } });
                    });
                });
        };
    const l = () => {
        const t = document.querySelector('[data-kt-customer-table-toolbar="base"]'),
            e = document.querySelector('[data-kt-customer-table-toolbar="selected"]'),
            o = document.querySelector('[data-kt-customer-table-select="selected_count"]'),
            c = n.querySelectorAll('tbody [type="checkbox"]');
        let r = !1,
            l = 0;
        c.forEach((t) => {
            t.checked && ((r = !0), l++);
        }),
            r ? ((o.innerHTML = l), t.classList.add("d-none"), e.classList.remove("d-none")) : (t.classList.remove("d-none"), e.classList.add("d-none"));
    };
    function loadPhases(projectId, preserveSelected = false){
        $.ajax({
            url: '/get-phases-for-booking',
            type: "POST",
            data: {
                project_id: projectId,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            dataType: 'json',
            success: function(result){
                
                var $selectedPhase = $('#selectedPhase');
                var selectedPhaseId = preserveSelected ? $selectedPhase.val() : $selectedPhase.data('selected-phase-id');
                console.log(selectedPhaseId);
                // Clear existing options except the first one
                $selectedPhase.find('option:not(:first)').remove();
    
                // Append new options
                result.forEach(phase => {
                    var option = $('<option>', {
                        value: phase.id,
                        text: projectId === "all" ? phase.phase_title +'-' + phase.project_title : phase.phase_title
                    });
                    if (phase.id == selectedPhaseId) {
                        option.prop('selected', true);
                    }
                    $selectedPhase.append(option);
                });
                var option = $('<option>', {
                    value: "all",
                    text: "All"
                });
                if (result.length === 0 || !result.some(phase => phase.id === selectedPhaseId)) {
                    $selectedPhase.append('<option value="all">All</option>');
                    $selectedPhase.val("all").trigger('change');
                } else {
                    $selectedPhase.val(selectedPhaseId).trigger('change'); // Ensure selected value is set correctly
                }
            }
        });
    }
    return {
        init: function () {
            loadPhases(document.getElementById('selectedProject').value);

            $('#selectedProject').on('change', function(e){
                // $('#selectedPhase').val('').trigger('change');
                var projectId = e.target.value;
                loadPhases(projectId, true);
                console.log($('#selectedPhase').val());
            });

            // Initial load of phases for the selected project
            var initialProjectId = $('#selectedProject').val();
            loadPhases(initialProjectId);

            (n = document.querySelector("#kt_users_table")) &&
                (n.querySelectorAll("tbody tr").forEach((t) => {
                    const e = t.querySelectorAll("td"),
                        o = moment(e[5].innerHTML, "DD MMM YYYY, LT").format();
                    e[5].setAttribute("data-order", o);
                }),
                (t = $(n).DataTable({
                    // pageLength: 10,
                    info: !1,
                    order: [],
                    paging: true, // Ensure paging is enabled
                    responsive: true,
                    columnDefs: [
                        { orderable: !1, targets: 0 },
                    ],
                })).on("draw", function () {
                    r(), l(), KTMenu.init();
                }),
                r()),
                document.querySelector('[data-kt-customer-table-filter="search"]').addEventListener("keyup", function (e) {
                    t.search(e.target.value).draw();
                });
               
                $('#selectedPhase').on('change', function () {
                    var project = $('#selectedProject').val();
                    var phase = $('#selectedPhase').val();
                    var status = $('#selectedStatus').val();
                
                    $.ajax({
                        
                        url: status === 'active' ? '/active-bookings' : '/cancelled-bookings',
                        type: 'GET',
                        data: {
                            selectedProject: project,
                            selectedPhase: phase,
                        },
                        success: function(data) {
                            if ($.fn.DataTable.isDataTable('#kt_users_table')) {
                                $('#kt_users_table').DataTable().clear().destroy(); // Clear and destroy the existing table
                            }
                
                            t = $('#kt_users_table').DataTable({
                                data: data, // use the data from the AJAX response
                                columns: [
                                    {
                                        data: null,
                                        defaultContent: '',
                                        orderable: false,
                                        targets: 0,
                                        render: function (data, type, row, meta) {
                                            return '<div class="form-check form-check-sm form-check-custom form-check-solid">' +
                                                       '<input class="form-check-input" type="checkbox" value="' + row.id + '" />' +
                                                   '</div>';
                                        }
                                    },
                                    {
                                        data: 'name',
                                        render: function(data, type, row) {
                                            // Replace 'your-url-here' with the actual URL you want to use
                                            // You can also dynamically set the URL based on other data properties from 'row'
                                            return '<a href="/bookings/' + row.id + '" class="text-gray-600 text-hover-primary mb-1">' + data + '</a>';
                                        }
                                    },
                                    { data: 'cnic_number' },
                                    { data: 'mobile_number_1' },
                                    { data: 'project_title' },
                                    { data: 'plot_no' },
                                    { data: 'received_amount' },
                                    { data: 'pending_amount' }
                                ],
                                paging: true,
                                responsive: true,
                                searching: true,
                                destroy: true // Ensure you can reinitialize without issues
                            }).on("draw", function () {
                                r(), l(), KTMenu.init();
                            });
                            
                        },
                        error: function(xhr, status, error) {
                            console.error("Error occurred: " + error);
                            $('#bookingList').html('<tr><td colspan="8">No data found</td></tr>');
                        }
                    });

                    r(),
                    document.querySelector('[data-kt-customer-table-filter="search"]').addEventListener("keyup", function (e) {
                        console.log('searching');
                        t.search(e.target.value).draw();
                    });
                });
                
                
                
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTCustomersList.init();
});
