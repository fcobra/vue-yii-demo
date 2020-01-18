<?php
/**
 * This view is used by console/controllers/MigrateController.php.
 *
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */

echo "<?php\n";
if (!empty($namespace)) {
    echo "\nnamespace {$namespace};\n";
}
?>

use yii\db\Migration;

/**
 * Class <?= $className . "\n" ?>
 */
class <?= $className ?> extends Migration
{
    protected $tableName = '___tableName___';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        // $tableOptions = null;
        // if ($this->db->driverName === 'mysql') {
        //    $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        // }

        // $this->createTable('{{%'.$this->tableName.'}}', [
        //     'id' => ($this->integer(11)->unsigned()) . ' AUTO_INCREMENT',
        //     'PRIMARY KEY (id)',
        // ], $tableOptions);

        $this->createTable('{{%'.$this->tableName.'}}', [
            'id' => $this->primaryKey(),


            // 'disabled' => $this->boolean()->defaultValue(0)->comment('Скрыть на сайте'),

            // 'author_id' => $this->integer()->comment('Автор'),
            // 'updater_id' => $this->integer()->comment('Кто редактировал последний'),
            // 'dt_create' => $this->dateTime()->comment('Дата создания записи'),
            // 'dt_update' => $this->dateTime()->comment('Дата редактирования записи'),
        ]);

        // добавление разрешения на редактирование

        $auth = Yii::$app->authManager;
        if(!($permission = $auth->getPermission($this->tableName.'-RW'))){
            $permission = $auth->createPermission($this->tableName.'-RW');
            $permission->description = 'Управление';
            $auth->add($permission);

            $admin = $auth->getPermission('admin');

            if($admin){
                $auth->addChild($admin, $permission);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "<?= $className ?> cannot be reverted.\n";

//        $this->dropTable('{{%'.$this->tableName.'}}');

//        $auth = Yii::$app->authManager;
//        if($permission = $auth->getPermission($this->tableName.'-RW')){
//            $auth->remove($permission);
//        }

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "<?= $className ?> cannot be reverted.\n";

        return false;
    }
    */
}
