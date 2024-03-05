<?php if ($money_limit == 0) { ?>
    <form action="money_limit/update" class="form-wrapper" method="POST">
        <h1 class="form-title">Thêm giới hạn thu chi</h1>
        <div class="form-container">
            <div class="form-group">
                <label for="">
                    Giới hạn số tiền thu chi
                    <b>(*)</b>
                </label>
                <input type="text" placeholder="Nhập giới hạn thu chi" name="money_limit">
            </div>
        </div>
        <div class=" form-button">
            <button type="submit" class="btn-action btn-action--submit">Thêm</button>
        </div>
    </form>
<?php } else { ?>
    <form action="money_limit/update" class="form-wrapper" method="POST">
        <h1 class="form-title">Cập nhật giới hạn thu chi</h1>
        <div class="form-container">
            <div class="form-group">
                <label for="">
                    Giới hạn số tiền thu chi
                    <b>(*)</b>
                </label>
                <input value="<?php echo $money_limit ?>" type="text" placeholder="Nhập giới hạn thu chi" name="money_limit">
            </div>
        </div>
        <div class=" form-button">
            <button type="submit" class="btn-action btn-action--submit">Cập nhật</button>
        </div>
    </form>
<?php } ?>