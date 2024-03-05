<form action="plan/update&id=<?php echo $plan['id'] ?>" class="form-wrapper" method="POST" enctype="multipart/form-data">
    <h1 class="form-title">Thêm kế hoạch thu chi</h1>
    <div class="">
        <div class="form-group mt-20">
            <label for="">
                Tên
                <b>(*)</b>
            </label>
            <input value="<?php echo $plan['name'] ?>" type="text" placeholder="Nhập tên kế hoạch chi tiêu" name="name">
        </div>
        <div class="form-group mt-20">
            <label for="">
                Số tiền
                <b>(*)</b>
            </label>
            <input value="<?php echo $plan['money_number'] ?>" type="text" placeholder="Nhập số tiền" name="money_number">
        </div>
        <div class="form-group mt-20">
            <label for="">
                Nhóm chi tiêu, loại chi tiêu
                <b>(*)</b>
            </label>
            <select name="group_transaction_id">
                <option selected disabled value=" ">-- Chọn --</option>
                <?php foreach ($categories as $category) { ?>
                    <option <?php echo $selected = $category['id'] == $plan['group_transaction_id'] ? 'selected' : '' ?> value="<?php echo $category['id'] ?>"><?php echo $category['name'];
                                                                                                                                                                $result = $category['type_transaction_id'] == 1 ? ' - Thu nhập' : ' - Chi tiêu';
                                                                                                                                                                echo $result;
                                                                                                                                                                ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group mt-20">
            <label for="">
                Thời gian
                <b>(*)</b>
            </label>
            <input value="<?php echo $plan['time'] ?>" type="date" placeholder="Nhập thời gian" name="time">
        </div>

        <div class="form-group mt-20">
            <label for="">
                Mô tả <b>(*)</b>
            </label>
            <textarea name='description' placeholder="Nhập mô tả thu chi" id='ckeditor'><?php echo $plan['description'] ?></textarea>
        </div>
    </div>
    <div class="form-button">
        <button type="submit" class="btn-action btn-action--submit">Lưu</button>
        <a href="plan" class="btn-action btn-action--back">Quay lại</a>
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