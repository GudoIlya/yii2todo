<fildset name="services">
    <tr>
        <td><h5>Услуги</h5></td>
        <td>Кол-во</td>
        <td>Пред. показания счетчика</td>
        <td>Текущие показания счетчика</td>
        <td>Долг</td>
        <td>Пени</td>
        <td>Тариф</td>
        <td>Результат</td>
    </tr>
    <?php
    foreach ($model as $i => $serviceModel) {
        echo $this->render('_oneProductItemForm', ['form' => $form, 'index' => 'services', 'subindex' => $i, 'model' => $serviceModel]);
    }
    ?>
</fildset>