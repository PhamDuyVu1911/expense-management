<div class="table-wrapper">
    <div class="table__header">
        <div class="table__top">
            <h1 class="table__title">Danh sách tài khoản</h1>
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
        <div class="table__right">
            <a href="spending_account/add" class="btn btn--add"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>

    <div class="table-container">
        <table class="content-table hover row-border" id="table">
            <thead>
                <tr>
                    <th class="width-100">STT</th>
                    <th class="width-250">Tên</th>
                    <th class="width-320">Số dư</th>
                    <th class="width-320">Loại tài khoản</th>
                    <th class="width-150">Mô tả</th>
                    <th class="width-200">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                foreach ($spendingAccounts as $spendingAccount) {
                ?>
                    <tr>
                        <td class="width-100 text-center">
                            <?php
                            echo $number;
                            $number++
                            ?>
                        </td>
                        <td class="width-250"><?php echo $spendingAccount['name']  ?> </td>
                        <td class="width-320"><?php
                                                $result = isset($spendingAccount['amount']) ? $spendingAccount['amount'] : $spendingAccount['initial_amount'];
                                                echo number_format($result, 0, '.', '.');  ?>đ </td>
                        <td class="width-320"><?php echo $spendingAccount['type_account'] ?></td>
                        <td class="width-150 text-center"><?php echo $spendingAccount['description'] ?></td>
                        <td class="width-200 text-center">
                            <a href="spending_account/edit&id=<?php echo $spendingAccount['id'] ?>" class="btn-action btn-action--edit">
                                Sửa
                            </a>
                            <a class="btn-action btn-action--delete" onclick="handleNotification(<?php echo $spendingAccount['id'] ?>, 'Tất cả chi phí và thu nhập liên kết tới tài khoản này sẽ bị xoá!','spending_account/delete');">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>