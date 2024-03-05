<div class="table-wrapper">
    <div class="table__header">
        <div class="table__top">
            <div class="table__top">
                <h1 class="table__title">Danh sách sản phẩm</h1>
                <div class="select_page">
                    <select id="rowsPerPage">
                        <option value="10">10</option>
                        <option selected value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="30">30</option>
                    </select>
                </div>
            </div>
        </div>
        <div style="display: flex; gap:10px; color:#fff">
            <h1>Thu nhập : <?php echo number_format($income_total, 0, '.', '.') ?>đ</h1>
            <h1>Chi tiêu : <?php echo  number_format($spending_total, 0, '.', '.') ?>đ</h1>
            <h1 class=<?php echo $isWarning = $spending_total > $spending_limit ? 'blinking' : '' ?>>Cảnh báo chi tiêu: <?php echo $isWarning = $spending_total > $spending_limit ? '   Có' : 'Không' ?></h1>
        </div>
        <div class="table__right">
            <a href="transaction/add" class="btn btn--add"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>

    <div class="table-container">
        <table class="content-table hover row-border" id="table">
            <thead>
                <tr>
                    <th class="width-100">STT</th>
                    <th class="width-150">Số tiền</th>
                    <th class="width-200">Hình ảnh</th>
                    <th class="width-150">Thời gian</th>
                    <th class="width-150">Nhóm chi tiêu</th>
                    <th class="width-150">Tài khoản</th>
                    <th class="width-150">Loại chi tiêu</th>
                    <th class="width-250">Hành động</th>
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
                        <td class="width-100">
                            <img src="./img_save/<?php echo $transaction['img'] ?>" alt="">
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
                        <td class="width-250 text-center">
                            <a href="transaction/edit&id=<?php echo $transaction['id'] ?>" class="btn-action btn-action--edit">Chi tiết</a>
                            <a class="btn-action btn-action--delete" onclick="handleNotification(<?php echo $transaction['id'] ?>, 'Bạn có chắc muốn xóa chi tiêu này không? Bạn sẽ được hoàn tiền vào tài khoản của mình!','transaction/delete');">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>