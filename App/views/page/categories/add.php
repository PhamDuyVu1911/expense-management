<form action="category/create" class="form-wrapper" method="POST">
    <h1 class="form-title">Thêm nhóm chi tiêu</h1>
    <div class="form-container">
        <div class="form-group">
            <label for="">
                Tên
                <b>(*)</b>
            </label>
            <input type="text" placeholder="Nhập tên nhóm chi tiêu" name="name">
        </div>
        <div class="form-group">
            <label for="">
                Loại thu chi
                <b>(*)</b>
            </label>
            <select name="type_transaction_id">
                <option selected disabled value=" ">-- Chọn --</option>
                <option value="1">Thu nhập</option>
                <option value="2">Chi tiêu</option>
            </select>
        </div>
    </div>
    <div class=" form-button">
        <button type="submit" class="btn-action btn-action--submit">Thêm</button>
        <a href="category" class="btn-action btn-action--back">Quay lại</a>
    </div>
</form>