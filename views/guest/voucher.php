<div style="font-size: 16px; text-align: center">
    Введите логин и код для получения доступа к интернету
    <div style="height: 15px"></div>
    <div style="height: 10px"></div>
    <div style="padding-top: 0px; width: 90%; padding-left: 10%">
        <form method="post" action="/voucher?<?=$_SERVER['QUERY_STRING']?>">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <?php if($errors != null):?>
                <small style="color: #e4b9b9;"><?=$errors;?></small>
            <?php endif;?>
            <input style="text-align: center" class="form-control" type="text" name="login" placeholder="Логин">
            <div style="height: 30px"></div>
            <input style="text-align: center" class="form-control" type="number" name="code" placeholder="Код">
            <div style="height: 30px"></div>
            <input class="form-control btn-info" type="submit" name="get_int" value="Получить доступ">
            <div style="padding-top: 10px;"></div>
            <a class="form-control btn-info" type="submit" href="<?='/?'.$_SERVER['QUERY_STRING']?>">Вернутся</a>
        </form>
    </div>
</div>