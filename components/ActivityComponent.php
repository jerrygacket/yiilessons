<?php


namespace app\components;


use app\models\Activity;
use app\models\ActivityDB;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ActivityComponent extends \app\base\BaseComponent
{
    /**
     * @return Activity
     */
    public function getModel($activityId = null) {
        if (empty($activityId)) {
            return new $this->nameClass;
        }

        // здесь получаем сущность пока что из файла.
        $activity = new $this->nameClass($this->getActivity($activityId));

        return $activity;
    }

    /**
     * @param $activityId
     * @return array
     * @throws \yii\base\Exception
     */
    private function getActivity($activityId):array {
//        FileHelper::createDirectory(\Yii::getAlias('@webroot/activities'));
//        $jsonFile = \Yii::getAlias('@webroot/activities/').$activityId.'.json';
//
//        return json_decode(file($jsonFile)[0]);
        $user_id = \Yii::$app->user->id;

        return ActivityDB::find()->andWhere(['user_id'=>$user_id,'id'=>$activityId])->one()->toArray();
    }

    /**
     * @param $model Activity
     * @return bool
     */
    public function createActivity(&$model):bool{
//        $model->file=$this->getUploadedFile($model,'file');
//        $model->uploadedFiles=$this->getUploadedFile($model,'uploadedFiles');

        $dateStart=\DateTime::createFromFormat('d.m.Y',$model->dateStart);
        $model->dateStart=$dateStart->format('Y-m-d');

        $dateEnd=\DateTime::createFromFormat('d.m.Y',$model->dateEnd);
        $model->dateEnd=$dateEnd->format('Y-m-d');

        if (!$model->save()) {
            $model->getErrors();
            return false;
        }

//        if (empty($model->id)){
//            $model->id = uniqid();
//        }

//        if(!empty($model->uploadedFiles)) {
//            foreach ($model->uploadedFiles as $file) {
//                $path=$this->genFilePath($this->genFileName($file));
//                if(!$this->saveUploadedFile($file,$path)){
//                    $model->addError('file','Не удалось сохранить файл');
//                    return false;
//                }else{
//                    $model->files[]=basename($path);
//                }
//            }
//
//        }

//        return $this->saveToDb($model);
        return true;
    }

//    private function saveUploadedFile(UploadedFile $file,$path):bool{
//        return $file->saveAs($path);
//    }
//
//    private function genFileName(UploadedFile $file){
//        $file=uniqid().'.'.$file->getExtension();
//        return $file;
//    }

//    private function genFilePath($file_name){
//        FileHelper::createDirectory(\Yii::getAlias('@webroot/images'));
//        $path=\Yii::getAlias('@webroot/images/'.$file_name);
//        return $path;
//    }

    /**
     * @param Activity $model
     * @param $attr
     * @return UploadedFile[]
     */
//    private function getUploadedFile(Activity $model,$attr){
//        return UploadedFile::getInstances($model,$attr);
//    }

    /**
     * @param $model
     * @return bool|int
     * @throws \yii\base\Exception
     */
//    private function saveToDb($model){
//        // сохраняем в файл
//        FileHelper::createDirectory(\Yii::getAlias('@webroot/activities'));
//        $jsonFile= \Yii::getAlias('@webroot/activities/'.$model->activityId.'.json');
//        $fp = fopen($jsonFile, 'w');
//        $result = fwrite($fp, json_encode($model->toArray()));
//        fclose($fp);
//
//        return $result;
//    }
}