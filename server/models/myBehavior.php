<?php
namespace OrderBook\Models;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\Behavior;
use Phalcon\Mvc\Model\BehaviorInterface;
use Phalcon\Di;
class MyBehavior extends \Phalcon\Mvc\Model\Behavior implements \Phalcon\Mvc\Model\BehaviorInterface
{
    public function notify($eventType, ModelInterface $model)
    {
        switch ($eventType) {
            case 'afterCreate': 
            $this->auditAfterCreate($model);
            break;
            case 'beforeUpdate':
            $this->auditAfterUpdate($model);
            break;
            case 'afterDelete': /* ... some code ... */ break;
            default: /* ... some code ... */ break;
        }

        return true;
    }

    public function auditAfterCreate($model)
    { 
         $registry = Di::getDefault()->getRegistry();
        $audit = new Audit();
        $audit->setIdCompany($registry['user']['id_company']);
        $audit->setTable($model->getSource());
        $metaData = $model->getModelsMetaData();
        $fields = $metaData->getAttributes($model);
        $changesDone = [];
        foreach($fields as $key => $value)
        {
            $changesDone[$value] = $model->readAttribute($value);
        }

        $audit->setUser($registry['user']['id_user']);
        $audit->setEmail($registry['user']['email']);
        $audit->setAction('create');
        $audit->setNewValue(json_encode($changesDone));
        $audit->setCreateAt(date("Y-m-d H:i:s"));
        $audit->save();
    }

    public function auditAfterUpdate($model)
    {
      $registry = Di::getDefault()->getRegistry();
      $audit = new Audit();
      $audit->setIdCompany($registry['user']['id_company']);
      $audit->setTable($model->getSource());

      $metaData = $model->getModelsMetaData();
      $fields = $metaData->getAttributes($model);

      $changesDone = [];
      $oldValues = [];
      //snapshotData contains old data before update
      $originalData = $model->getSnapshotData();
      
      foreach($fields as $field)
      {
        if($model->readAttribute($field) != $originalData[$field])
            $changesDone[$field] = $model->readAttribute($field);
        else
            $changesDone[$field] = null;
        $oldValues[$field] = $originalData[$field];
    }

    $audit->setUser($registry['user']['id_user']);
    $audit->setEmail($registry['user']['email']);
    $audit->setAction('update');
    $audit->setNewValue(json_encode($changesDone));
    $audit->setOldValue(json_encode($oldValues));
    $audit->setCreateAt(date("Y-m-d H:i:s"));
    $audit->save();
}

}