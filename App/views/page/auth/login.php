<div class="login">
    <div class="login__header">
        <div class="login__logo">
            <a class="logo__link"><b>$</b> Đăng nhập</a>
        </div>
    </div>
    <form action="auth/signIn" class="login__form" method="POST" id="form">
        <div class="form-group">
            <input class="form-input" type="text" placeholder="Tài khoản" name="username">
            <span class="err"></span>
        </div>
        <div class="form-group">
            <input class="form-input" type="password" placeholder="Mật khẩu" name="password" autocomplete="off">
            <span class="err"></span>
        </div>
        <div class="login__action">
            <div class="remember__login">

            </div>
            <div class="register">
                <a href="auth/register" class="register__link">Đăng ký</a>
            </div>
        </div>
        <div class="login__btn">
            <button type="submit" class="btn btn--submit width-full rounded-2px">Đăng nhập</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        let checkEmail = false;

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
                if (target.name === "username") {
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
                            if (!data.status) {
                                parentElement.classList.add('active');
                                errorElement.innerText = "Tài khoản chưa được đăng ký";
                                if (checkEmail) {
                                    checkEmail = false;
                                }
                            } else {
                                checkEmail = true;
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

            if (countVal === 0 && checkEmail) {
                return true;
            } else {
                return false;
            }
        });
    });
</script>