<form action="spending_account/create" method="POST" class="form-wrapper">
    <h1 class="form-title">Thêm tài khoản</h1>
    <div class="form-group mt-20">
        <label for="">
            Tên tài khoản
            <b>(*)</b>
        </label>
        <input type="text" name='name' placeholder="Nhập tên tài khoản">
    </div>
    <div class="form-group mt-20">
        <label for="">
            Loại tài khoản
            <b>(*)</b>
        </label>
        <input type="text" name='type_account' placeholder="Thêm loại tài khoản">
    </div>
    <div class="form-group mt-20">
        <label for="">
            Tiền ban đầu
            <b>(*)</b>
        </label>
        <input type="text" name='initial_amount' placeholder="Nhập số tiền ban đầu">
    </div>
    <div class="form-group mt-20">
        <label for="">
            Diễn giải
            <b>(*)</b>
        </label>
        <textarea type="text" name='description' placeholder="Thêm diễn giải"></textarea>
    </div>
    <div class="form-button">
        <button type="submit" class="btn-action btn-action--submit">Thêm</button>
        <a href="spending_account" class="btn-action btn-action--back">Quay lại</a>
    </div>
</form>