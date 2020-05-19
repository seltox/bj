<a href="/tasks/manage" class="btn btn-primary">Добавить задачу</a>
<table class="table">
    <caption>Список задач</caption>
    <thead>
    <tr>
        <th><?=\application\components\Helpers::linkSort($sort, $sort_type, $currentPage, 'id', '#')?></th>
        <th><?=\application\components\Helpers::linkSort($sort, $sort_type, $currentPage, 'name', 'Имя')?></th>
        <th><?=\application\components\Helpers::linkSort($sort, $sort_type, $currentPage, 'email', 'E-mail')?></th>
        <th>Текст</th>
        <th><?=\application\components\Helpers::linkSort($sort, $sort_type, $currentPage, 'status', 'Статус')?></th>
        <? if(\application\components\Auth::getInstance()->isAdmin()): ?>
            <th></th>
        <? endif; ?>
    </tr>
    </thead>
    <tbody>
        <? foreach($rows as $row): ?>
    <tr>
        <th><?=$row['id']?></th>
        <td><?=htmlspecialchars($row['name'])?></td>
        <td><?=htmlspecialchars($row['email'])?></td>
        <td><?=htmlspecialchars($row['text'])?></td>
        <td><?=($row['status'] == 1 ? 'Выполнено' : 'Не выполнено')?><?=($row['is_edit_admin'] == 1 ? ' | Отредактировано администратором' : '')?></td>
        <? if(\application\components\Auth::getInstance()->isAdmin()): ?>
            <td><a href="/tasks/manage/?id=<?=$row['id']?>">Редактировать</a></td>
        <? endif; ?>
    </tr>
        <? endforeach; ?>
    </tbody>
</table>

<? if($countPages > 1) : ?>
    <? for($i=1;$i<=$countPages;$i++): ?>
        <? if($currentPage == $i): ?>
            <strong><?=$i?></strong>
        <? else: ?>
            <a href="/tasks/index/?sort=<?=htmlspecialchars($sort)?>&sort_type=<?=htmlspecialchars($sort_type)?>&page=<?=$i?>">
                <?=$i?>
            </a>
        <? endif; ?>

    <? endfor; ?>
<? endif; ?>