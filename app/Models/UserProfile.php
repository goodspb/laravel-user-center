<?php
namespace App\Models;

use App\Library\Avatar;

class UserProfile extends Model
{
    protected $table = 'user_profiles';
    protected $primaryKey = 'user_id';

    public function getAvatarAttribute($value)
    {
        return Avatar::getAvatar($value);
    }

    public function getNicknameAttribute($value)
    {
        return empty($value) ? $value : base64_decode($value);
    }

    public function setNicknameAttribute($value)
    {
        $this->attributes['nickname'] = empty($value) ? $value : base64_encode($value);
    }

    /**
     * Return user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}