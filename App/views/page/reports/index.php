<div class="table-wrapper">
    <div class="table__header">
        <div class="table__top">
            <div class="table__top">
                <button id="export-to-excel">
                    <i class="fa-regular fa-file-excel"></i>
                    Export
                </button>
            </div>
        </div>

        <div class="table__right">
            <form action="report/sayHi" class="form-table" method="POST">
                <div class="form-group-table" style="display: flex; gap:8px; align-items: center;">
                    <label style="color: #fff;" for="">Loại:</label>
                    <select name="type_transaction_id" id="">
                        <option selected disabled value=" ">-- Tất cả --</option>
                        <option <?php echo $selected = $type_transaction_id == 1 ? 'selected' : '' ?> value="1">Thu nhập</option>
                        <option <?php echo $selected = $type_transaction_id == 2 ? 'selected' : '' ?> value="2">Chi tiêu</option>
                    </select>
                </div>
                <div class="form-group-table" style="display: flex; gap:8px; align-items: center;">
                    <label style="color: #fff;" for="">Tài khoản:</label>
                    <select name="spending_account_id" id="">
                        <option selected value=" " disabled>-- Tất cả --</option>
                        <?php foreach ($spendingAccounts as $spendingAccount) { ?>
                            <option <?php echo $selected = $spending_account_id == $spendingAccount['id'] ? 'selected' : '' ?> value="<?php echo $spendingAccount['id'] ?>"><?php echo  $spendingAccount['name'] ?></option>
                        <?php   } ?>
                    </select>
                </div>
                <div class="form-group-table" style="display: flex; gap:8px; align-items: center;">
                    <label style="color: #fff;" for="">Từ:</label>
                    <input type="date" name="time_start" placeholder="Mặc định là tất cả" id="time_start" value="<?php echo $value = isset($time_start) ? $time_start : ''  ?>">
                </div>
                <div class="form-group-table" style="display: flex; gap:8px; align-items: center;">
                    <label style="color: #fff;" for="">Đến:</label>
                    <input type="date" name="time_end" placeholder="Mặc định là tất cả" id="time_end">
                </div>
                <button type="submit" class="btn btn--add" style="padding: 2px 12px; border-radius: 2px;">
                    Xem
                </button>
                <?php if ($time_start != 0 || $type_transaction_id != 0 || $spending_account_id != 0) { ?>
                    <a href="report" class="btn btn--add" style="padding: 2px 12px; border-radius: 2px;">
                        Huỷ
                    </a>
                <?php } ?>
            </form>
        </div>
    </div>

    <div class="table-container">
        <table class="content-table hover row-border" id="table-report">
            <thead>
                <tr>
                    <th class="width-100">STT</th>
                    <th class="width-150">Số tiền</th>
                    <th class="width-150">Thời gian</th>
                    <th class="width-150">Nhóm chi tiêu</th>
                    <th class="width-150">Tài khoản</th>
                    <th class="width-150">Loại chi tiêu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                foreach ($transactions as $transaction) { ?>
                    <tr>
                        <td class="width-100 text-center">
                            <?php echo $number;
                            $number++; ?>
                        </td>
                        <td class="width-150 text-center" style="color: <?php foreach ($categories as $category) {
                                                                            if ($category['id'] == $transaction['group_transaction_id']) {
                                                                                echo $red = $category['type_transaction_id'] == 1 ? "" : 'red';
                                                                            }
                                                                        }; ?>;">
                            <?php
                            foreach ($categories as $category) {
                                if ($category['id'] == $transaction['group_transaction_id']) {
                                    echo $result = $category['type_transaction_id'] == 1 ? '+' : '-';
                                }
                            };
                            echo number_format($transaction['money_number'], 0, '.', '.'); ?>đ
                        </td>
                        <td class=""><?php echo $transaction['time'] ?> </td>
                        <td class="">
                            <?php foreach ($categories as $category) {
                                if ($category['id'] == $transaction['group_transaction_id']) {
                                    echo $category['name'];
                                }
                            } ?>
                        </td>
                        <td class="">
                            <?php foreach ($spendingAccounts as $spendingAccount) {
                                if ($spendingAccount['id'] == $transaction['spending_account_id']) {
                                    echo $spendingAccount['name'];
                                }
                            } ?>
                        </td>
                        <td class="">
                            <?php foreach ($categories as $category) {
                                if ($category['id'] == $transaction['group_transaction_id']) {
                                    echo $result = $category['type_transaction_id'] == 1 ? "Thu nhập " : 'Chi tiêu';
                                }
                            } ?>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('time_end').valueAsDate = new Date();
    document.getElementById('time_end').max = new Date().toLocaleDateString('fr-ca')

    document.getElementById('time_start').max = new Date().toLocaleDateString('fr-ca')
</script>