<form action="category/update&id=<?php echo $category['id'] ?>" class="form-wrapper" method="POST">
    <h1 class="form-title">Cập nhật nhóm chi tiêu</h1>
    <div class="form-container">
        <div class="form-group">
            <label for="">
                Tên
                <b>(*)</b>
            </label>
            <input value="<?php echo $category['name'] ?>" type="text" placeholder="Nhập tên nhóm chi tiêu" name="name">
        </div>
        <div class="form-group">
            <label for="">
                Loại thu chi
                <b>(*)</b>
            </label>
            <select name="type_transaction_id">
                <option selected disabled value=" ">-- Chọn --</option>
                <option value="1" <?php echo $selected = $category['type_transaction_id'] == 1 ? 'selected' : ''  ?>>Thu nhập</option>
                <option value="2" <?php echo $selected = $category['type_transaction_id'] == 2 ? 'selected' : ''  ?>>Chi tiêu</option>
            </select>
        </div>
    </div>
    <div class=" form-button">
        <button type="submit" class="btn-action btn-action--submit">Cập nhật</button>
        <a href="category" class="btn-action btn-action--back">Quay lại</a>
    </div>
</form>