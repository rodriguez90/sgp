<?php

namespace app\controllers;

use Yii;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use Da\User\Model\User;
use Da\User\Event\FormEvent;
use Da\User\Controller\RegistrationController as BaseController;
use Da\User\Validator\AjaxRequestModelValidator;


use Da\User\Query\UserQuery;
use Da\User\Query\SocialNetworkAccountQuery;

use app\forms\RegistrationForm;


class RegistrationController extends BaseController
{

    public function __construct(
        $id,
        Module $module,
        UserQuery $userQuery,
        SocialNetworkAccountQuery $socialNetworkAccountQuery,
        array $config = []
    ) {
        parent::__construct($id, $module, $userQuery,  $socialNetworkAccountQuery, $config);
    }

    public function actionRegister()
    {

        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException();
        }
        /** @var RegistrationForm $form */
        $form = $this->make(RegistrationForm::class);

        $this->make(AjaxRequestModelValidator::class, [$form])->validate();

        if(Yii::$app->request->isPost)
        {

            $data = Yii::$app->request->post();

            $form->setAttributes($data);

            if ($form->validate()) {

                if ($form->save()) {
                    Yii::$app->session->setFlash('info', Yii::t('usuario', 'Your account has been created'));
                    $this->redirect(Url::toRoute(['/user/login']));
                }
                else {
                    Yii::$app->session->setFlash('danger', Yii::t('usuario', 'User could not be registered.'));
                }
            }
        }

        return $this->render('register', ['model' => $form, 'module' => $this->module]);
    }
}
