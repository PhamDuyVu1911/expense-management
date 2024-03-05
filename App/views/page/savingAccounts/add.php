<form action="saving_account/create" class="form-wrapper" method="POST" enctype="multipart/form-data">
    <h1 class="form-title">Thêm tiết kiệm</h1>
    <div class="">
        <div class="form-group">
            <label for="">
                Tài khoản
                <b>(*)</b>
            </label>
            <select name="spending_account_id" id='spending_account'>
                <option selected disabled value=" ">-- Chọn --</option>
                <?php foreach ($spendingAccounts as $spendingAccount) { ?>
                    <option value="<?php
                                    echo $spendingAccount['id'] ?>" <?php $amount = isset($spendingAccount['amount']) ? $spendingAccount['amount'] : $spendingAccount['initial_amount'];
                                                                    echo $disable = $amount < 200000 ? 'disabled' : "";
                                                                    ?>>
                        <?php echo $spendingAccount['name'];
                        echo ' -  ';
                        $result = isset($spendingAccount['amount']) ? $spendingAccount['amount'] : $spendingAccount['initial_amount'];
                        echo number_format($result, 0, '.', '.');
                        ?>đ <?php echo $info = $amount < 200000 ? '- Số dư không đủ' : "" ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group mt-20">
            <label for="">
                Số tiền
                <b>(*)</b>
            </label>
            <input type="number" placeholder="Nhập số tiền" name="depositAmount" id="depositAmount">
            <span id='number-error' style="color: red; margin-left: 4px; margin-top: 8px; display:block"></span>
        </div>
        <div class="form-group mt-20">
            <label for="">
                Kỳ hạn
                <b>(*)</b>
            </label>
            <select name="durationInMonths" id='durationInMonths'>
                <option selected disabled value=" ">-- Chọn --</option>
                <option value="3">3 tháng</option>
                <option value="6">6 tháng</option>
                <option value="9">9 tháng</option>
                <option value="12">12 tháng</option>
            </select>
        </div>
        <div class="form-group mt-20">
            <label for="">
                Lãi xuất
                <b>(*)</b>
            </label>
            <input value="6.5" type="number" placeholder="Lãi xuất" name="interestRate" id="interestRate" readonly>
        </div>
        <div class="form-group mt-20">
            <label>- Bạn không thể thay đổi những thông tin trên trong tương lai.</label>
            <label>- Tiền của bạn sẽ được cộng vào tài khoản khi tới kỳ hạn.</label>
            <div style="display: flex; justify-content: start; align-items: center;gap:4px;">
                <input type="checkbox" name="confirm" id="confirm">
                <label for="confirm" style="display: inline; user-select: none; margin-bottom: 0; line-height: 0;">Tôi đồng ý với điều khoản này!</label>
            </div>
        </div>
    </div>
    <div class="form-button">
        <button type="submit" id="btn-submit" class="btn-action btn-action--submit disabled" disabled>Xác nhận</button>
        <a href="saving_account" class="btn-action btn-action--back">Huỷ</a>
    </div>
</form>