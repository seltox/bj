<form action="" method="post">
    <p>
        <legend><? if($isNewRecord): ?>Добавить <? else: ?> Редактировать<? endif; ?> задачу</legend>
        <? if(count($model->getErrors())): ?>
            <div class="alert alert-danger" role="alert">
                <?=implode("<br>", $model->getErrors()); ?>
            </div>
        <? endif; ?>
        <p>
            <label for="input">Введите имя</label>
            <input type="text" id="input" placeholder="Введите имя" class="form-control" name="name" value="<?=\application\components\Helpers::encode($model->getField('name'))?>">
        </p>


        <p>
            <label for="input">Введите E-mail</label>
            <input type="text" id="input" placeholder="Введите E-mail" class="form-control" name="email"  value="<?=\application\components\Helpers::encode($model->getField('email'))?>">
        </p>

        <p>
            <label for="textarea">Введите текст</label>
            <p>
                <textarea id="textarea" name="text" rows="5" cols="50"  class="form-control"><?=\application\components\Helpers::encode($model->getField('text'))?></textarea>
            </p>
        </p>

        <? if(\application\components\Auth::getInstance()->isAdmin()): ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="status" value="1" <?=($model->getField('status') == 1 ? 'checked' : '')?>> Выполнено
                </label>
            </div>
        <? endif; ?>
        <p>
            <button type="submit" class="btn">Сохранить</button>
        </p>
    </fieldset>
</form>