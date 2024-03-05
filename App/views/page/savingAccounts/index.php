<div class="saving_title">
    Tiền gửi tiết kiệm
</div>
<div class="card_saving">
    <?php
    $number = 0;
    foreach ($savingAccounts as $savingAccount) { ?>
        <?php $number++ ?>
        <div class="card_saving_item">
            <div class="card_saving__overlay"></div>
            <div class="card_logo">
                <div class="logo__link">6APLUS</div>
            </div>
            <div class="card_icon">
                <i class="fa-solid fa-sack-dollar"></i>
            </div>
            <?php
            $full_term_interest = $savingAccount['depositAmount'] +  $savingAccount['depositAmount'] * $savingAccount['interestRate'] / 100 / 12 * $savingAccount['durationInMonths'];
            if ($savingAccount['total_amount'] >= $full_term_interest) {
            ?>
                <div class="card_get_money">
                    <form action="saving_account/take_out_money&id=<?php echo $savingAccount['id'] ?>" method="POST">
                        <input type="number" name="total" value="<?php echo $savingAccount['total_amount']; ?>" style="display: none">
                        <input style="display: none" type="number" name="spending_account_id" value="<?php foreach ($spendingAccounts as $spendingAccount) {
                                                                                                            if ($spendingAccount['id'] === $savingAccount['spending_account_id']) {
                                                                                                                echo $spendingAccount['id'];
                                                                                                            }
                                                                                                        }
                                                                                                        ?>">
                        <button class="btn-get-money" id="get_money" type="submit"> <i class="fa-solid fa-money-bill-trend-up"></i>
                            Rút tiền</button>
                    </form>

                </div>
            <?php } ?>
            <div class="card_content">
                <div class="card_title">Tiền gửi Tiết kiệm <span style="opacity: 0.7;">#<?php echo $number  ?></span></div>
                <div class="card_info">
                    <p>
                        Tên tài khoản:
                        <span>
                            <?php foreach ($spendingAccounts as $spendingAccount) {
                                if ($spendingAccount['id'] === $savingAccount['spending_account_id']) {
                                    echo $spendingAccount['name'];
                                }
                            } ?>
                        </span>
                    </p>
                    <p>Số tiền gốc: <span><?php echo  number_format($savingAccount['depositAmount'], 0, '.', '.'); ?> VND</span></p>
                    <p>Kỳ hạn: <span><?php echo $savingAccount['durationInMonths'] ?> tháng</span></p>
                    <p>Ngày đến hạn: <span><?php echo $date = date('d-m-Y', strtotime("+${savingAccount['durationInMonths']} month", strtotime($savingAccount['openingDate'])));  ?></span></p>
                    <p>Lãi xuất: <span><?php echo $savingAccount['interestRate'] ?>%</span></p>
                </div>
                <div class="card_bottom">
                    <p>
                        Tổng số dư quy đổi
                        <br />
                        <span>
                            <b>
                                <?php
                                $money = $savingAccount['total_amount'] != 0 ? $savingAccount['total_amount'] : $savingAccount['depositAmount'];

                                echo number_format($money, 0, '.', '.'); ?> VND
                            </b>
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <form action="savingAccount/take_out_money" method="POST" style="display:none;">
            <input type="number" name="total" value="<?php echo $savingAccount['total_amount']; ?>">
            <input type="number" name="spending_account_id" value="<?php
                                                                    foreach ($spendingAccounts as $spendingAccount) {
                                                                        if ($spendingAccount['id'] === $savingAccount['spending_account_id']) {
                                                                            echo $spendingAccount['id'];
                                                                        }
                                                                    }
                                                                    ?>">
            <button id="get_money" type="submit">Lấy tiền</button>
        </form>
    <?php  } ?>
    <div class="card_saving_item" style="background-color: rgba(82, 139, 139, 0.5); cursor: pointer; ">
        <a href="saving_account/add" class="card_saving_add">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
</div>