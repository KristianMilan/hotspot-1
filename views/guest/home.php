<div style="font-size: 16px; text-align: center">
    Подтвердите свой номер, что бы получить доступ к интернету
    <br><br>
    <div style="padding-top: 10px; width: 90%; padding-left: 10%">
        <form method="post" action="/?<?=$_SERVER['QUERY_STRING']?>">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />

            <a class="form-control btn-info" type="submit" href="<?='/guest?'.$_SERVER['QUERY_STRING']?>">Для гостей</a>
            <br/>
            <a class="form-control btn-info" type="submit" href="<?='/voucher?'.$_SERVER['QUERY_STRING']?>">Ввести ваучер код</a>
        </form>
    </div>

    <div style="font-size: 14px; width: 85%; padding-left: 15%; padding-top: 10px; color: #fff">
        <small>После подтверждения номера, вы получите доступ в интернет на 1 час. После истечения времени потребуется повторная проверка номера.</small>
    </div>
</div>