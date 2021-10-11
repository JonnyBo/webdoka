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

    protected $fillable = ['right', 'status', 'user_id'];

    //public $rights = ['админ', 'пользователь', 'имеет доступ'];

    //public $statuses = ['работает сейчас', 'работал ранее', 'участвовал в собеседованиях', 'готов к подработкам'];

    public function fields()
    {
        return $this->hasMany('App\Models\Field', 'worker_id');
    }

    public function saveWorker($data) {
        $this->user_id = $data['user_id'];
        $this->right = (isset($data['right']) && $data['right']) ? $data['right'] : $this->getRight()[1];
        $this->status = (isset($data['status']) && $data['status']) ? $data['status'] : $this->getStatus()[0];
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
