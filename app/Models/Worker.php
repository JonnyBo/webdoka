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

    protected $fillable = ['user_id', 'status_id', /*'age',*/ 'sex', 'birthday', 'source_id', 'region', 'phone', 'telegram', 'watsapp', 'vyber', 'skype', 'resume', 'experience', 'education', 'skills', 'photo'];

    //public $rights = ['админ', 'пользователь', 'имеет доступ'];

    //public $statuses = ['работает сейчас', 'работал ранее', 'участвовал в собеседованиях', 'готов к подработкам'];

    public function fields()
    {
        return $this->hasMany('App\Models\Field', 'worker_id');
    }

    public function status() {
        return $this->hasOne('App\Models\Status', 'id', 'status_id');
    }

    public function source() {
        return $this->hasOne('App\Models\Source', 'id', 'source_id');
    }

    public function saveWorker($data) {
        $prefix = self::getPrefixName();
        $this->user_id = intval($data['user_id']);
        $this->status_id = (isset($data['status_id']) && $data['status_id']) ? intval($data['status_id']) : 1;
        //$this->age = intval($data['age']);
        $this->{'sex' . $prefix} = trim(strip_tags($data['sex' . $prefix]));
        $this->birthday = date('Y-m-d', strtotime($data['birthday']));
        $this->source_id = (isset($data['source_id']) && $data['source_id']) ? intval($data['source_id']) : null;
        $this->{'region' . $prefix} = trim(strip_tags($data['region' . $prefix]));
        $this->phone = trim(strip_tags($data['phone']));
        $this->telegram = trim(strip_tags($data['telegram']));
        $this->watsapp = trim(strip_tags($data['watsapp']));
        $this->vyber = trim(strip_tags($data['vyber']));
        $this->skype = trim(strip_tags($data['skype']));
        $this->resume = trim(strip_tags($data['resume']));
        $this->experience = trim(strip_tags($data['experience']));
        $this->{'education' . $prefix} = trim(strip_tags($data['education' . $prefix]));
        $this->skills = (isset($data['skills']) && $data['skills'] && is_array($data['skills'])) ? implode(',', $data['skills']) : null;
        $this->photo = (isset($data['photo']) && $data['photo']) ? $data['photo'] : null;
        return $this->save();
    }

    public function updateWorker($data) {
        $prefix = self::getPrefixName();
        $model = Worker::find($data['id']);
        $model->user_id = intval($data['user_id']);
        $model->status_id = (isset($data['status_id']) && $data['status_id']) ? intval($data['status_id']) : 1;
        //$model->age = intval($data['age']);
        $model->{'sex' . $prefix} = trim(strip_tags($data['sex' . $prefix]));
        $model->birthday = date('Y-m-d', strtotime($data['birthday']));
        $model->source_id = (isset($data['source_id']) && $data['source_id']) ? intval($data['source_id']) : null;
        $model->{'region' . $prefix} = trim(strip_tags($data['region' . $prefix]));
        $model->phone = trim(strip_tags($data['phone']));
        $model->telegram = trim(strip_tags($data['telegram']));
        $model->watsapp = trim(strip_tags($data['watsapp']));
        $model->vyber = trim(strip_tags($data['vyber']));
        $model->skype = trim(strip_tags($data['skype']));
        $model->resume = trim(strip_tags($data['resume']));
        $model->experience = trim(strip_tags($data['experience']));
        $model->{'education' . $prefix} = trim(strip_tags($data['education' . $prefix]));
        $model->skills = (isset($data['skills']) && $data['skills'] && is_array($data['skills'])) ? implode(',', $data['skills']) : null;
        if (isset($data['photo']) && $data['photo']) {
            $model->photo = $data['photo'];
        }
        return $model->update();
    }

    public static function getAge($birth) {
        return intval(date('Y', time() - strtotime($birth))) - 1970;
    }

    public static function getRight() {
        $rights = Role::all();
        $result = [];
        foreach ($rights as $right) {
            $result[] = $right->{'name' . self::getPrefixName()};
        }
        return $result;
    }

    public static function getStatus() {
        $statuses = Status::all();
        $result = [];
        foreach ($statuses as $status) {
            $result[] = $status->{'name' . self::getPrefixName()};
        }
        return $result;
    }

    public function delete() {
        //dd($this);
        $this->fields()->delete();
        return parent::delete();
    }

    protected function getPrefixName() {
        $lang = session()->get('locale');
        return ($lang == 'ru') ? '' : '_' . $lang;
    }

}
