<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Link;
use yii\validators\UrlValidator;

class LinkController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Получить короткую ссылку
     **/
    public function actionGetShortLink()
    {
        $url = $this->editUrl(Yii::$app->request->post('url'));
        $response_data = ['status' => 1];

        $validator = new UrlValidator();
        $validator->defaultScheme = 'http';

        if(!$url || !$validator->validate($url)){
            $response_data['status'] = 0;
            $response_data['error'] = 'Некорректный URL';
        }
        elseif($link = Link::findByUrl($url)){
            $response_data['link'] = $link->alias;
        }
        else{
            $link = new Link();
            $link->url = $url;
            $link->create_date = date('Y-m-d H:i:s');
            $link->save();

            $link->alias = substr(md5($link->id), 0, 12);
            $link->save();

            $response_data['link'] = $link->alias;
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $response_data;
    }

    /**
     * Совершить перенаправление по короткой ссылке на исходную страницу
     **/
    public function actionRedirectWithAlias($alias)
    {
        $link = Link::findByAlias($alias);

        if($link){
            return $this->redirect($link->url);
        }
        else{
            return $this->render('error', ['message' => 'Такой страницы нет в базе']);
        }
    }

    /**
     * Привести входящий url к единому виду - во избежание дублирования записей
     **/
    private function editUrl($url)
    {
        if($url && substr($url, -1) == "/"){
            $url = substr($url, 0, -1);
        }

        return $url;
    }
}
