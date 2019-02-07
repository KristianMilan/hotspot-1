<div style="font-size: 16px; text-align: center">
    Подтвердите свой номер, что бы получить доступ к интернету
    <br><br>
    <div style="padding-top: 10px; width: 90%; padding-left: 10%">
        <form method="post" action="/?<?=$_SERVER['QUERY_STRING']?>">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <?php if($errors != null):?>
                <small style="color: #e4b9b9;"><?=$errors;?></small>
            <?php endif;?>
            <input class="form-control" type="number" name="phone" placeholder="998 90 000 00 00" <?=!empty($smsc) ? 'value="'.$smsc->phone.'"' : ''?>>
            <div style="height: 10px"></div>
            <input class="form-control" type="password" name="pass" placeholder="Пароль от WiFi сети">
            <div style="height: 30px"></div>
            <input class="form-control btn-info" type="submit" value="Отправить СМС">
            <!-- <div style="height: 30px"></div>
            <a class="form-control btn-info" type="submit" href="<?='/?'.$_SERVER['QUERY_STRING']?>">Вернутся</a>-->
        </form>
    </div>

    <div style="font-size: 14px; width: 85%; padding-left: 15%; padding-top: 10px; color: #fff">
        <small>После подтверждения номера, вы получите доступ в интернет на 1 час. После истечения времени потребуется повторная проверка номера.</small>
    </div>
</div>