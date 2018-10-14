<?php
namespace app\migrations;
//use Yii;
use yii\db\Migration;

/**
 * Class m180918_062926_init_rbac
 */
class m180918_062926_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /*
        $auth = Yii::$app->authManager;

        // Разрешение создавать недвижимость
        $createEstate = $auth->createPermission('createEstate');
        $createEstate->description = 'Разрешение на создание недвижимости';
        $auth->add($createEstate);

        $updateEstate = $auth->createPermission('updateEstate');
        $updateEstate->description = 'Рашрение на обновление недвижимости';
        $auth->add($updateEstate);

        $deleteEstate = $auth->createPermission('deleteEstate');
        $deleteEstate->description = 'Разрешение на удаление недвижимости';
        $auth->add($deleteEstate);

        $viewEstate = $auth->createPermission('viewEstate');
        $viewEstate->description = 'Разрешение на просмотр недвижимости';
        $auth->add($viewEstate);

        $estateOwnerRole = $auth->createRole('estateOwner');
        $auth->add($estateOwnerRole);
        $auth->addChild($estateOwnerRole, $createEstate);
        $auth->addChild($estateOwnerRole, $updateEstate);
        $auth->addChild($estateOwnerRole, $deleteEstate);
        $auth->addChild($estateOwnerRole, $viewEstate);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $createEstate);
        $auth->addChild($admin, $updateEstate);
        $auth->addChild($admin, $deleteEstate);
        $auth->addChild($admin, $viewEstate);


        $auth->assign($estateOwnerRole, 2);
        $auth->assign($admin, 1);
        */
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180918_062926_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
