<header class="header">
    <div class="header__left">
        <div class="sidebar__logo">
            <a href="/home" class="logo__link"><b>$</b>6APlus</a>
        </div>
        <div class="directional" id="toggle-sidebar-button"><i class="fa-sharp fa-solid fa-bars"></i></div>
        <form style="display:<?php echo $display = (empty($func->getUrl()[0]) || $func->getUrl()[0] == 'home') ? 'none' : '' ?>;" method="POST">
            <div class="form-search-group">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input id="myInputTextField" type="text" placeholder="Tìm kiếm" name='name' autocomplete="off">
            </div>
        </form>
    </div>
    <div class="header__right">
        <div class="user">
            <div class="user__avatar">
                <img src="./public/img/admin.png" alt="" />
            </div>
            <div class="user__name">
                <?php echo $name = isset($_SESSION['login']) ? $_SESSION['login']['full_name'] : 'Chưa đăng nhập'; ?>
                <ul class="user-menu">
                    <li class="user-menu__item">
                        <a href="money_limit" class="user-menu__link">
                            Cảnh báo chi tiêu
                        </a>
                    </li>

                    <li class="user-menu__item">
                        <a href="auth/logout" class="user-menu__link">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>