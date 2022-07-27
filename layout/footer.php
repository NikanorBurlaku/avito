</main>
    <div class="login__popup" style="display: none;">
        <div class="login__block">
            <h2 class="login__title">вход</h2>
            <form action="#" class="login__form" method="post">
                <input type="text" class="login__input" id="login__login" placeholder="телефон или электронная почта">
                <input type="password" class="login__input" id="login__password" placeholder="пароль"
                    autocomplete="off">
                <input type="submit" class="login__submit" value="войти">
            </form>
            <button class="login__href">зарегистрироваться</button>
            <span class="login__close"><img src="images/close.svg" alt=""></span>
        </div>
    </div>
    <div class="register__popup" style="display: none;">
        <div class="login__block">
            <h2 class="login__title"></h2>
            <form action="#" class="login__form" method="post">
                <input type="text" class="login__input" id="register__login"
                    placeholder="телефон или электронная почта">
                <input type="password" class="login__input" id="register__password" placeholder="пароль"
                    autocomplete="off">
                <input type="submit" class="login__submit" value="войти">
            </form>
            <button class="login__href">войти</button>
            <span class="register__close"><img src="images/close.svg" alt=""></span>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>

</html>