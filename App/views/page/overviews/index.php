<div class="card" style="margin-top: 0;">
    <div class="card-item">
        <div class="card-item__icon">
            <i class="fa-solid fa-money-bill-trend-up"></i>
        </div>
        <div class="card-item__desc">
            <p class="desc__name">Thu nhập</p>
            <p class="desc__price"><?php echo  number_format($income_total, 0, ' ', ' '); ?> đ</p>
        </div>
    </div>
    <div class="card-item">
        <div class="card-item__icon">
            <i class="fa-solid fa-money-bill-transfer"></i>

        </div>
        <div class="card-item__desc">
            <p class="desc__name">Chi tiêu</p>
            <p class="desc__price"><?php echo  number_format($spending_total, 0, ' ', ' '); ?> đ</p>
        </div>
    </div>
    <div class="card-item">
        <div class="card-item__icon">
            <i class="fa-solid fa-dollar-sign"></i>
        </div>
        <div class="card-item__desc">
            <p class="desc__name">Số dư</p>
            <p class="desc__price"><?php echo number_format($income_total - $spending_total, 0, ' ', ' ');  ?>đ </p>
        </div>
    </div>
    <div class="card-item">
        <div class="card-item__icon">
            <i class="fa-solid fa-dollar-sign"></i>
        </div>
        <div class="card-item__desc">
            <p class="desc__name">Tổng tiền hiện có</p>
            <p class="desc__price"><?php echo number_format($amount_spending_account, 0, ' ', ' ');  ?> đ</p>
        </div>
    </div>
</div>