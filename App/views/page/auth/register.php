<div class="login" style="max-width: 600px;">
    <div class="login__header">
        <div class="login__logo">
            <a class="logo__link"><b>$</b>Đăng ký</a>
        </div>
    </div>
    <form action="auth/create" method="POST" id="form">
        <div class="form-group mt-20">
            <input class="form-input" type="text" placeholder="Họ và tên" name="name" autocomplete="off">
            <span class="err"></span>
        </div>
        <div class="form-group mt-20">
            <input class="form-input" type="text" placeholder="Email" name="email" id="email" autocomplete="off">
            <span class="err"></span>
        </div>
        <div class="form-group mt-20">
            <input class="form-input" type="text" placeholder="Điện thoại" name="phoneNumber">
            <span class="err"></span>
        </div>
        <div class="form-group mt-20">
            <input class="form-input" type="password" placeholder="Mật khẩu" name="pass" autocomplete="on">
            <span class="err"></span>
        </div>
        <div class="form-group mt-20">
            <input class="form-input" type="password" placeholder="Nhập lại mật khẩu" name="pass_r" autocomplete="on">
            <span class="err"></span>
        </div>
        <div class="form-group mt-20">
            <textarea class="form-input" type="text" placeholder="Địa chỉ" name="address"></textarea>
            <span class="err"></span>
        </div>
        <div class="login__action mt-20">
            <div class="remember__login">
            </div>
            <div class="register">
                <a href="auth/login" class="register__link">
                    <i class="fa-solid fa-circle-left"></i>
                    Quay lại đăng nhập
                </a>
            </div>
        </div>
        <div class="login__btn mt-20">
            <button type="submit" class="btn btn--submit width-full rounded-2px">Đăng ký</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        let checkEmail = false;
        let checkPassword = false;
        let pass = 0;
        const inputs = $("#form .form-input");

        // Lắng nghe sự kiện "blur" cho input
        inputs.on('blur', function(e) {
            const target = e.target;
            const parentElement = target.parentElement;
            const errorElement = parentElement.querySelector('.err');

            if (!target.value) {
                parentElement.classList.add('active');
                errorElement.innerText = "Vui lòng nhập dữ liệu";
            } else {
                if (target.name === "pass") {
                    pass = target.value;
                }

                if (target.name === "pass_r") {
                    if (target.value === pass) {
                        if (parentElement.classList.contains('active')) {
                            parentElement.classList.remove('active');
                        }
                        errorElement.innerText = '';
                        checkPassword = true;
                        return;
                    } else {
                        parentElement.classList.add('active');
                        errorElement.innerText = "Mật khẩu không khớp";
                        if (checkPassword) {
                            checkPassword = false;
                        }
                        return;
                    }
                }

                if (target.name === "email") {
                    let isEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(target.value);

                    if (!isEmail) {
                        parentElement.classList.add('active');
                        errorElement.innerText = "Email không hợp lệ";
                        if (checkEmail) {
                            checkEmail = false;
                        }
                        return;
                    } else {
                        $.post("auth/checkEmail", {
                            email: target.value
                        }, function(data) {
                            if (data.status) {
                                parentElement.classList.add('active');
                                errorElement.innerText = data.message;
                                return;
                            } else {
                                if (parentElement.classList.contains('active')) {
                                    parentElement.classList.remove('active');
                                }
                                errorElement.innerText = '';
                                checkEmail = true;
                                return;
                            }
                        });
                    }
                }

                if (parentElement.classList.contains('active')) {
                    parentElement.classList.remove('active');
                }
                errorElement.innerText = '';
            }
        });

        // Lắng nghe sự kiện "input" cho input
        inputs.on('input', function(e) {
            const parentElement = e.target.parentElement;
            const errorElement = parentElement.querySelector('.err');

            if (parentElement.classList.contains('active')) {
                parentElement.classList.remove('active');
            }
            errorElement.innerText = '';
        });

        // Lắng nghe sự kiện "submit" cho form
        $("#form").submit(function(e) {
            let countVal = 0;

            inputs.each(function() {
                if (!$(this).val()) {
                    countVal += 1;
                    const parentElement = $(this).parent();
                    const errorElement = parentElement.find('.err');

                    if (!parentElement.hasClass('active')) {
                        parentElement.addClass('active');
                        errorElement.text('Vui lòng nhập dữ liệu');
                    }
                }
            });

            if (countVal === 0 && checkEmail && checkPassword) {
                return true;
            } else {
                return false;
            }
        });
    });
</script>