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
                var $selectedPhase = $('#selectedPhase');
                var selectedPhaseId = $selectedPhase.data('selected-phase-id');
    
                // Clear existing options except the first one
                $selectedPhase.find('option:not(:first)').remove();
    
                // Append new options
                result.forEach(phase => {
                    var option = $('<option>', {
                        value: phase.id,
                        text: phase.phase_title
                    });
                    if (phase.id == selectedPhaseId) {
                        option.prop('selected', true);
                    }
                    $selectedPhase.append(option);
                });
                var firstPhaseId = result.length > 0 ? result[0].id : null;
                $selectedPhase.val(firstPhaseId).trigger('change');
            }
        });
    }
    return {
        init: function () {
            loadPhases(document.getElementById('selectedProject').value);

            $('#selectedProject').on('change', function(e){
                // $('#selectedPhase').val('').trigger('change');
                var projectId = e.target.value;
                loadPhases(projectId);
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
                    info: !1,
                    order: [],
                    columnDefs: [
                        { orderable: !1, targets: 0 },
                        { orderable: !1, targets: 6 },
                    ],
                })).on("draw", function () {
                    r(), l(), KTMenu.init();
                }),
                r());
                $('#selectedPhase, #selectedStatus').on('change', function () {
                    var project = $('#selectedProject').val();
                    var phase = $('#selectedPhase').val();
                    var status = $('#selectedStatus').val();

                    $.ajax({
                        url: '/bookings', // Adjust the URL as necessary
                        type: 'GET',
                        data: {
                            selectedProject: project,
                            selectedPhase: phase,
                            selectedStatus: status
                        },
                        success: function(data) {
                            $('#bookingList').html(data);
                        }
                    });
                }); 
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTCustomersList.init();
});
