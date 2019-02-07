<div style="font-size: 16px; text-align: center">
    Подтвердите свой номер, что бы получить доступ к интернету
    <div style="height: 15px"></div>
    <small>На Ваш номер: +<?=$phone?> высланно смс с кодом подтверждения</small>
    <div style="height: 10px"></div>
    <div style="padding-top: 0px; width: 90%; padding-left: 10%">
        <form method="post" action="/?<?=$_SERVER['QUERY_STRING']?>">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <?php if($errors != null):?>
                <small style="color: #e4b9b9;"><?=$errors;?></small>
            <?php endif;?>
            <input style="text-align: center" class="form-control" type="number" name="code" placeholder="000 000">
            <input class="form-control" type="hidden" name="phone" value="<?=$phone?>">
            <input class="form-control" type="hidden" name="pass" value="<?=$pass?>">
            <div style="height: 30px"></div>
            <input class="form-control btn-info" type="submit" name="get_int" value="Получить доступ">
            <div style="padding-top: 10px;"></div>
            <input class="form-control btn-info" type="submit" name="change_nmb" value="Изменить номер">
        </form>
    </div>

    <div style="font-size: 14px; width: 85%; padding-left: 15%; padding-top: 10px; color: #fff">
        <small>После подтверждения номера, вы получите доступ в интернет на 1 час. После истечения времени потребуется повторная проверка номера.</small>
    </div>
</div>