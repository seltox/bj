<div class="row">
    <div class="col-sm-6">
        <form action="" method="post">

            <? if(\application\components\Auth::getInstance()->hasError()): ?>
                <div class="alert alert-danger" role="alert">
                    <?=\application\components\Auth::getInstance()->getError() ?>
                </div>
            <? endif; ?>


            <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" name="login" id="login" class="form-control" placeholder="Логин">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" class="form-control"placeholder="Password">
            </div>
            <button type="submit" class="btn btn-default">Войти</button>
        </form>
    </div>
</div>