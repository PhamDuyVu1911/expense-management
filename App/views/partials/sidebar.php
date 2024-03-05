<div class="sidebar" id="sidebar">
    <nav class="menu">
        <ul class="menu__list">
            <li class="menu__item">
                <a href="home" class="menu__link 
                <?php
                $display = $func->handleActive('home');
                echo $display['active'];
                echo $displayDefault = isset($display['display']) ? $display['display'] : '';
                ?>">
                    <i class="fa-regular fa-address-card"></i>
                    <span> Giới thiệu</span>
                </a>
            </li>
            <li class="menu-title">Tổng quan</li>
            <li class="menu__item">
                <a href="overview" class="menu__link
                <?php
                echo $func->handleActive('overview')['active'];
                ?>">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Tổng quan</span>
                </a>
            </li>
            <li class="menu-title">Ngân sách</li>
            <li class="menu__item">
                <a href="spending_account" class="menu__link
                <?php
                echo $func->handleActive('spending_account')['active'];
                ?>">
                    <i class="fa-solid fa-landmark"></i>
                    <span>Quản lý tài khoản</span>
                </a>
            </li>
            <li class="menu__item">
                <a href="saving_account" class="menu__link
                <?php
                echo $func->handleActive('saving_account')['active'];
                ?>">
                    <i class="fa-solid fa-piggy-bank"></i>
                    <span>Tiền gửi tiết kiệm</span>
                </a>
            </li>
            <li class="menu-title">Thu chi</li>
            <li class="menu__item">
                <a href="category" class="menu__link
                <?php
                echo $func->handleActive('category')['active'];
                ?>">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Quản lý nhóm chi tiêu</span>
                </a>
            </li>
            <li class="menu__item">
                <a href="transaction" class="menu__link
                <?php
                echo $func->handleActive('transaction')['active'];
                ?>">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <span> Quản lý chi tiêu</span>
                </a>
            </li>
            <li class="menu__item">
                <a href="plan" class="menu__link
                <?php
                echo $func->handleActive('plan')['active'];
                ?>">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                    <span>Kế hoạch chi tiêu</span>
                </a>
            </li>
            <li class="menu-title">Báo cáo</li>
            <li class="menu__item">
                <a href="report" class="menu__link
                <?php
                echo $func->handleActive('report')['active'];
                ?>">
                    <i class="fa-solid fa-network-wired"></i>
                    <span>Báo cáo thống kê</span>
                </a>
            </li>
        </ul>
    </nav>
</div>