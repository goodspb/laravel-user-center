<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Config;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'mobile', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Return user profile
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('App\Models\UserProfile', 'user_id', 'id');
    }

    public function save(array $options = [], $saveProfile = true)
    {
        //生成用户资料如果不存在
        $result = parent::save($options);
        if ($result && (!$this->profile) && $saveProfile) {
            $this->saveProfile();
        }
        return $result;
    }

    public function saveProfile($data = [])
    {
        $profile = $this->profile;
        if (is_null($profile)) {
            $profile = new UserProfile;
        }
        $this->relations['profile'] = $profile;
        $profile->user_id = $this->id;
        $profile->nickname = isset($data['nickname']) ? $data['nickname'] : '';
        $profile->avatar = isset($data['avatar']) ? $data['avatar'] : Config::get('auth.default_avatar');
        $profile->sex = isset($data['sex']) ? (in_array($data['sex'], array(0, 1, 2)) ? $data['sex'] : 0) : ($profile->sex ?: 0);
        $profile->province = isset($data['province']) ? $data['province'] : ($profile->province ?: 0);
        $profile->city = isset($data['city']) ? $data['city'] : ($profile->city ?: 0);
        $profile->area = isset($data['area']) ? $data['area'] : ($profile->area ?: 0);
        $profile->description = isset($data['description']) ? $data['description'] : ($profile->description ?: '');
        return $this->profile()->save($profile);
    }

    public function saveRoles($data, $save = false)
    {
        $this->detachRoles();
        if (!empty($data)) {
            $this->attachRoles($data);
        }
        $save and $this->save();
    }

    public function delete()
    {
        $result = parent::delete();
        (new UserProfile())->find($this->getAttribute($this->getKeyName()))->delete();
        return $result;
    }


}
