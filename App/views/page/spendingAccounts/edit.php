<form action="spending_account/update/&id=<?php echo $spendingAccount['id']  ?>" method="POST" class="form-wrapper">
    <h1 class="form-title">Cập nhật tài khoản</h1>
    <div class="form-group mt-20">
        <label for="">
            Tên tài khoản
            <b>(*)</b>
        </label>
        <input type="text" name='name' value="<?php echo $spendingAccount['name']  ?>" placeholder="Nhập tên tài khoản">
    </div>
    <div class="form-group mt-20">
        <label for="">
            Loại tài khoản
            <b>(*)</b>
        </label>
        <input type="text" name='type_account' value="<?php echo $spendingAccount['type_account']  ?>" placeholder="Thêm loại tài khoản">
    </div>
    <div class="form-group mt-20">
        <label for="">
            Lượng ban đầu
            <b>(*)</b>
        </label>
        <input value="<?php echo $spendingAccount['initial_amount']  ?>" type="text" name='initial_amount' placeholder=" Nhập số tiền ban đầu">
    </div>
    <div class="form-group mt-20">
        <label for="">
            Diễn giải
            <b>(*)</b>
        </label>
        <textarea type="text" name='description' placeholder="Thêm diễn giải"><?php echo $spendingAccount['description']  ?></textarea>
    </div>
    <div class="form-button">
        <button type="submit" class="btn-action btn-action--submit">Lưu</button>
        <a href="spending_account" class="btn-action btn-action--back">Quay lại</a>
    </div>
</form>