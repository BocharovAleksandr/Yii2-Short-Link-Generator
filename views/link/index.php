<?php
    $this->title = 'Short Links Generator';
?>

<div class="row">
    <div class="text-center margin-top">
        <h2 class="text-center margin-bottom-sm">Генератор коротких ссылок</h2>

        <form action="" method="post" class="form-inline">
            <input class="form-control" type="url" name="url" id="js-url-field" placeholder="Введите URL" autocomplete="off">
            <button type="button" id="js-send-form-button" class="btn btn-success">Сгенерировать</button>
        </form>

        <div id="data-box">
            <h2 id="js-data-title"></h2>
            <div id="js-data-value"></div>
        </div>
    </div>
</div>