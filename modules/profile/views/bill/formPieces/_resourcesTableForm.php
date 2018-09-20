<fildset name="resources">
    <tr>
        <td><h5>Ресурсы</h5></td>
        <td>Кол-во</td>
        <td>Показания счетчика</td>
        <td>Тариф</td>
        <td>Результат</td>
    </tr>
    <?php
    foreach ($model as $i => $resourceModel) {
        echo $this->render('_oneProductItemForm', ['form' => $form, 'index' => 'resources', 'subindex' => $i, 'model' => $resourceModel]);
    }
    ?>
</fildset>