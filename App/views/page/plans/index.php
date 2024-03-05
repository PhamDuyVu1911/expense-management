<div class="table-wrapper">
    <div class="table__header">
        <div class="table__top">
            <div class="table__top">
                <h1 class="table__title">Danh sách kế hoạch thu chi</h1>
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
        <div class="table__right">
            <a href="plan/add" class="btn btn--add"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>

    <div class="table-container">
        <table class="content-table hover row-border" id="table">
            <thead>
                <tr>
                    <th class="width-100">STT</th>
                    <th class="width-100">Tên</th>
                    <th class="width-150">Số tiền</th>
                    <th class="width-150">Thời gian</th>
                    <th class="width-150">Nhóm chi tiêu</th>
                    <th class="width-150">Loại chi tiêu</th>
                    <th class="width-150">Diễn giải</th>
                    <th class="width-250">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                foreach ($plans as $plan) { ?>
                    <tr>
                        <td class="width-100 text-center">
                            <?php echo $number;
                            $number++; ?>
                        </td>
                        <td class="width-100 text-center">
                            <?php echo $plan['name'];
                            ?>
                        </td>
                        <td class="width-150 text-center"><?php echo number_format($plan['money_number'], 0, '.', '.'); ?>đ</td>
                        <td class=""><?php echo $plan['time'] ?> </td>
                        <td class="">
                            <?php foreach ($categories as $category) {
                                if ($category['id'] == $plan['group_transaction_id']) {
                                    echo $category['name'];
                                }
                            } ?>
                        </td>
                        <td class="">
                            <?php foreach ($categories as $category) {
                                if ($category['id'] == $plan['group_transaction_id']) {
                                    echo $result = $category['type_transaction_id'] == 1 ? 'Thu nhập' : ' Chi tiêu';
                                }
                            } ?>
                        </td>
                        <td class="width-100 text-center">
                            <?php echo $plan['description'];
                            ?>
                        </td>
                        <td class="width-250 text-center">
                            <a href="plan/edit&id=<?php echo $plan['id'] ?>" class="btn-action btn-action--edit">Cập nhật</a>
                            <a class="btn-action btn-action--delete" onclick="handleNotification(<?php echo $plan['id'] ?>, 'Bạn có chắc muốn xóa kế hoạch chi tiêu này?','plan/delete');">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>