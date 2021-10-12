<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'workers';

    public $timestamps = true;

    protected $fillable = ['user_id', 'status_id', 'age', 'sex', 'birthday', 'source_id', ];

    //public $rights = ['админ', 'пользователь', 'имеет доступ'];

    //public $statuses = ['работает сейчас', 'работал ранее', 'участвовал в собеседованиях', 'готов к подработкам'];

    public function fields()
    {
        return $this->hasMany('App\Models\Field', 'worker_id');
    }

    public function status() {
        return $this->hasOne('App\Models\Worker', 'status_id');
    }

    public function source() {
        return $this->hasOne('App\Models\Worker', 'source_id');
    }

    public function saveWorker($data) {
        $this->user_id = intval($data['user_id']);
        $this->status_id = intval($data['status_id']);
        $this->age = intval($data['age']);
        $this->sex = trim(strip_tags($data['sex']));
        $this->birthday = date('Y-m-d', strtotime($data['birthday']));
        $this->source_id = intval($data['source_id']);
        $this->region = trim(strip_tags($data['region']));
        $this->phone = trim(strip_tags($data['phone']));
        $this->email = trim(strip_tags($data['email']));
        $this->telegram = trim(strip_tags($data['telegram']));
        $this->watsapp = trim(strip_tags($data['watsapp']));
        $this->vyber = trim(strip_tags($data['vyber']));
        $this->skype = trim(strip_tags($data['skype']));
        $this->resume = trim(strip_tags($data['resume']));
        $this->experience = trim(strip_tags($data['experience']));
        $this->education = trim(strip_tags($data['education']));
        $this->skills = (is_array($data['skills'])) ? implode(',', $data['skills']) : trim(strip_tags($data['skills']));
        dd($this);
        return $this->save();
    }

    public function updateWorker($data) {
        $model = Worker::find($data['id']);
        $model->user_id = $data['user_id'];
        $model->right = (isset($data['right']) && $data['right']) ? $data['right'] : $this->getRight()[1];
        $model->status = (isset($data['status']) && $data['status']) ? $data['status'] : $this->getStatus()[0];
        return $model->update();
    }

    public static function getRight() {
        return ['админ', 'пользователь', 'имеет доступ'];
    }

    public static function getStatus() {
        return ['работает сейчас', 'работал ранее', 'участвовал в собеседованиях', 'готов к подработкам'];
    }

    public function delete() {
        //dd($this);
        $this->fields()->delete();
        return parent::delete();
    }

}
