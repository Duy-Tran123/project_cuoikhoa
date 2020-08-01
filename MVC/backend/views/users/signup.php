<!--views/users/signup.php-->
<!--<h1>Form đăng ký user</h1>-->
<div class="container">
    <h2>Form register</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username"
                   id="username" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password"
                   class="form-control" />
        </div>
        <div class="form-group">
            <label for="confirm-password">Nhập lại password</label>
            <input type="password" name="confirm_password"
                   id="confirm-password" class="form-control" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Đăng ký"
                   class="btn btn-primary" />
        </div>
        Đã có tài khoản,
        <a href="index.php?controller=login&action=login">
            Đăng nhập
        </a> ngay
    </form>
</div>