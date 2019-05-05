<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 29/03/2019
 * Time: 10:13
 */

namespace app\forms;

use Da\User\Model\Profile;
use Yii;
use Da\User\Model\User;
use Da\User\Event\FormEvent;
use Da\User\Form\RegistrationForm as BaseForm;
use Da\User\Service\UserCreateService;
use Da\User\Service\UserRegisterService;
use Da\User\Factory\MailFactory;

use app\models\InformacionContacto;


class RegistrationForm extends BaseForm {

    private $_user = null;
    private $_profile = null;
    private $_informacionContacto = null;

    public $nombre = '';
    public $telefono = '';
    public $direccion = '';

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->user = new User();
        $this->_user->loadDefaultValues();
        $this->_profile =  new Profile();
        $this->_informacionContacto =  new InformacionContacto();
        $this->_informacionContacto->loadDefaultValues();
    }

    public function rules()
    {

        $rules = parent::rules();

        $rules [] = [['telefono' ,  'direccion'], 'required'];

        return $rules;
    }

    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();

        $attributeLabels['telefono'] = 'Télefono';
        $attributeLabels['direccion'] = 'Dirección';

        return $attributeLabels;
    }

    public function save() {

        $this->_user->setScenario('register');
        $mailService = MailFactory::makeWelcomeMailerService($this->_user);


        if ($this->make(UserRegisterService::class, [$this->_user, $mailService])->run()) {

            $result = $this->saveProfile();
            if ($result['error']) {
                User::deleteAll(['id'=>$this->_user->getId()]);
                $this->addError('error', $result['msg']);
                return false;
            }

            $this->_user = $this->_user;
            return true;
        }
        return false;
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        return true;
//        return parent::validate($attributeNames, $clearErrors); // TODO: Change the autogenerated stub
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function setUser($user)
    {
        if ($user instanceof User) {
            $this->_user= $user;
        } else if (is_array($user)) {
            $this->_user->setAttributes($user);
        }
    }

    public function getProfile() {
        return $this->_profile;
    }

    public function setProfile($profile)
    {
        if ($profile instanceof Profile) {
            $this->_profile= $profile;
        } else if (is_array($profile)) {
            $this->_profile->setAttributes($profile);
        }
    }

    public function getInformacionContacto() {
        return $this->_informacionContacto;
    }

    public function setInformacionContacto($info)
    {
        if ($info instanceof InformacionContacto) {
            $this->_informacionContacto= $info;
        } else if (is_array($info)) {
            $this->_informacionContacto->setAttributes($info);
        }
    }

    private function saveProfile() {
        $result = [
            'error'=>false,
            'msg' => ''
        ];
        if($this->_user == null || $this->_user->isNewRecord) {
            $result['error'] = true;
            $result['msg'] = 'Debe ingresar los datos del usuario.';
            return $result;
        }

        $this->_profile->user_id = $this->_user->getId();
        $this->_informacionContacto->id = $this->_user->getId();

        $profile =  Profile::findOne(['user_id'=>$this->_user->getId()]);

        $profile->name =  $this->_profile->name;
        $transaction = \Yii::$app->db->beginTransaction();

        if(!$profile->save()) {
            $result['error'] = true;
            $result['msg'] = $this->_profile->getErrorSummary(true);
            $transaction->rollBack();
            return $result;
        }

        if(!$this->_informacionContacto->save()) {
            $result['error'] = true;
            $result['msg'] = $this->_informacionContacto->getErrorSummary(true);
            $transaction->rollBack();
            return $result;
        }

        $role = Yii::$app->authManager->getRole('Proveedor');

        if($role)
            Yii::$app->authManager->assign($role, $this->_user->getId());

        $transaction->commit();

        return $result;
    }

    private function getAllModels()
    {
        $models = [
            'User' => $this->user,
            'Profile' => $this->docente,
            'InformacionContacto' => $this->docente,
        ];
        return $models;
    }

    public function setAttributes($data) {
        if(isset($data['User']) && isset($data['Profile']) && isset($data['InformacionContacto']))
        {
            $this->_user->setAttributes($data['User']);
            $this->_profile->setAttributes($data['Profile']);
            $this->_informacionContacto->setAttributes($data['InformacionContacto']);
        }
    }

    public function errorSummary($form)
    {
        $errorLists = [];
        foreach ($this->getAllModels() as $id => $model) {
            $errorList = $form->errorSummary($model, [
                'header' => '<p>Por favor verifique el siguiente error <b>' . $id . '</b></p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

}