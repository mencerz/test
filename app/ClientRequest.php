<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ClientRequest extends Model
{
    const FILES_STORE_DIR = 'files';

    protected $fillable = [
        'subject',
        'message'
    ];

    public static function createRules()
    {
        return [
            'subject' => 'required|min:3',
            'message' => 'required|min:3',
            'file' => 'required|file|max:2048'
        ];
    }

    // todo there might be error messages

    public static function updateRules()
    {
        return [
            'is_viewed' => 'boolean'
        ];
    }

    /**
     * @param array $data
     * @param string $file_link
     * @param User $user
     * @return ClientRequest
     */
    public static function add($data, $file_link, User $user)
    {
        $model = new self();
        $model->fill($data);
        $model->file_link = $file_link;
        $model->user_id = $user->id;
        $model->save();

        return $model;
    }

    public function toggleViewed()
    {
        $this->is_viewed = !$this->is_viewed;
        $this->save();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public static function getLastRequest(User $user)
    {
        return self::where(['user_id' => $user->id])->orderBy('created_at', 'desc')->first();
    }

    /**
     * @return bool
     */
    public function canSendRequest()
    {
        $dateWhenCan = $this->created_at->addDay();
        return Carbon::now() > $dateWhenCan;
    }

    /**
     * @return string
     */
    public function getRemain()
    {
        $dateWhenCan = $this->created_at->addDay();
        $diff = Carbon::now()->diff($dateWhenCan);
        return $diff->format('%H:%i:%s');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
