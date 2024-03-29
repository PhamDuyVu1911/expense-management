<form action="transaction/create" class="form-wrapper" method="POST" enctype="multipart/form-data">
    <h1 class="form-title">Thêm chi tiêu</h1>
    <div class="form">
        <div class="form-left">
            <div class="form-group">
                <label for="file">
                    <div class="form-img">
                        <img id="blah" src="./public/img/img.png" alt="">
                    </div>
                </label>
                <label for="file" class="input-file">Thêm ảnh hoá đơn ( nếu có )</label>
                <input type="file" id="file" style="display: none;" name="file" accept="image/*">
            </div>
        </div>
        <div class="form-right">
            <div class="form-group">
                <label for="">
                    Số tiền
                    <b>(*)</b>
                </label>
                <input type="text" placeholder="Nhập số tiền" name="money_number">
            </div>
            <div class="form-group">
                <label for="">
                    Tài khoản
                    <b>(*)</b>
                </label>
                <select name="spending_account_id">
                    <option selected disabled value=" ">-- Chọn --</option>
                    <?php foreach ($spendingAccounts as $spendingAccount) { ?>
                        <option value="<?php
                                        echo $spendingAccount['id'] ?>">
                            <?php echo $spendingAccount['name'];
                            echo ' -  ';
                            $result = isset($spendingAccount['amount']) ? $spendingAccount['amount'] : $spendingAccount['initial_amount'];
                            echo number_format($result, 0, '.', '.'); ?>đ</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">
                    Nhóm chi tiêu, loại chi tiêu
                    <b>(*)</b>
                </label>
                <select name="group_transaction_id">
                    <option selected disabled value=" ">-- Chọn --</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category['id'] ?>"><?php echo $category['name'];
                                                                        $result = $category['type_transaction_id'] == 1 ? ' - Thu nhập' : ' - Chi tiêu';
                                                                        echo $result;
                                                                        ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="">
                    Mô tả (Không bắt buộc)
                </label>
                <textarea name='description' placeholder="Nhập mô tả thu chi" id='ckeditor'></textarea>
            </div>
            <div class="form-group">
                <label for="">
                    Chi tiết (Không bắt buộc)
                </label>
                <textarea name='detail' placeholder="Nhập chi tiết thu chi" id='ckeditor1'></textarea>
            </div>
        </div>
    </div>
    <div class="form-button">
        <button type="submit" class="btn-action btn-action--submit">Thêm</button>
        <a href="transaction" class="btn-action btn-action--back">Quay lại</a>
    </div>
</form>
<script>
    // Preview Img Input
    const fileValue = document.getElementById('file');
    fileValue.onchange = evt => {
        const [file] = fileValue.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }

    // -----------------------
    // Ckeditor
    // CKEDITOR.replace('ckeditor');
    // CKEDITOR.replace('ckeditor1');
    ClassicEditor.create(document.querySelector('#ckeditor')).catch((error) => {
        console.error(error);
    });

    ClassicEditor.create(document.querySelector('#ckeditor1')).catch((error) => {
        console.error(error);
    });
</script>