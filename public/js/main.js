const app = {
    handleDataTable() {
        try {
            $(document).ready(function () {
                const height = $('#sidebar').height() - 260;
                table = $('#table').DataTable({
                    lengthChange: false,
                    info: false,
                    pageLength: 15,
                    scrollY: height,
                    scrollX: true,
                    language: {
                        paginate: {
                            previous: '<i class="fas fa-chevron-left"></i>',
                            next: '<i class="fas fa-chevron-right"></i>',
                        },
                    },
                });

                $('#myInputTextField').keyup(function () {
                    table.search($(this).val()).draw();
                });

                if ($(window).height() >= 900) {
                    table.page.len(15).draw();
                } else {
                    table.page.len(8).draw();
                }

                $('#rowsPerPage').on('change', function () {
                    let row = $('#rowsPerPage').val();
                    table.page.len(row).draw();
                });

                const tableReport = $('#table-report').DataTable({
                    lengthChange: false,
                    info: false,
                    pageLength: 10,
                    scrollY: height,
                    scrollX: true,
                    language: {
                        paginate: {
                            previous: '<i class="fas fa-chevron-left"></i>',
                            next: '<i class="fas fa-chevron-right"></i>',
                        },
                    },
                    buttons: [
                        {
                            extend: 'excel',
                        },
                    ],
                });

                $('#export-to-excel').on('click', function () {
                    tableReport.button('.buttons-excel').trigger();
                });

                $('#myInputTextField').keyup(function () {
                    tableReport.search($(this).val()).draw();
                });

                $('#rowsPerPage').on('change', function () {
                    let row = $('#rowsPerPage').val();
                    tableReport.page.len(row).draw();
                });

                $('#toggle-sidebar-button').on('click', function () {
                    $('.main').toggleClass('sidebar-close');
                    // Set width table from data-table
                    if (table) {
                        table.DataTable().columns.adjust();
                    }

                    if (tableReport) {
                        tableReport.DataTable().columns.adjust();
                    }
                });
            });
        } catch (error) {
            return;
        }
    },

    handleAddSavingAccount() {
        const depositAmount = $('#depositAmount');
        const btnSubmit = $('#btn-submit');
        let amount = 0;
        $('#spending_account').on('change', function (e) {
            $.post(
                'spending_account/getMoneyById',
                {
                    id: e.target.value,
                },
                function (data) {
                    amount_new = data.amount
                        ? data.amount
                        : data.initial_amount;
                    amount = Number(amount_new);
                    depositAmount.attr({
                        max: amount,
                        min: 200000,
                    });
                    console.log(amount);
                }
            );
        });

        depositAmount.on('input', (e) => {
            let value = Number(e.target.value);
            if (value < 200000) {
                $('#number-error').text('Số tiền tối thiểu phải là 200.000 đ');
                btnSubmit.prop('disabled', true);
                btnSubmit.addClass('disabled');
            } else if (value > amount) {
                $('#number-error').text(
                    'Số tiền vượt quá số dư tài khoản hiện có!'
                );
                btnSubmit.prop('disabled', true);
                btnSubmit.addClass('disabled');
            } else {
                $('#number-error').text('');
                if ($('#confirm:checkbox:checked').length > 0) {
                    btnSubmit.prop('disabled', false);
                    btnSubmit.removeClass('disabled');
                } else {
                    btnSubmit.prop('disabled', true);
                    btnSubmit.adđClass('disabled');
                }
            }
        });

        $('#durationInMonths').on('change', (e) => {
            if (e.target.value == 3) {
                $('#interestRate').val(6.5);
            } else if (e.target.value == 6) {
                $('#interestRate').val(6.6);
            } else if (e.target.value == 9) {
                $('#interestRate').val(6.7);
            } else if (e.target.value == 12) {
                $('#interestRate').val(6.9);
            }
        });

        $('#confirm').on('click', (e) => {
            if ($('#confirm:checkbox:checked').length > 0) {
                btnSubmit.prop('disabled', false);
                btnSubmit.removeClass('disabled');
            } else {
                btnSubmit.prop('disabled', true);
                btnSubmit.addClass('disabled');
            }
        });
    },

    start() {
        this.handleDataTable();
        this.handleAddSavingAccount();
    },
};

app.start();
