<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\SesSendError;
use App\Models\UserLog\Log as UserLog;
use App\Models\UserLog\Event as UserLogEvent;
use App\Models\Message\Outbound as OutboundMessage;
use Notification;

class Inbound extends Model
{
    protected $metadata;
    /**
     * The table name attribute.
     *
     * @var string
     */
    public $table = 'message.inbound';
    
    /**
     * The fillable attributes
     *
     * @var array
     */
    public $fillable = ['client_id', 'user_id', 'medium_id', 'to', 'from', 'body'];

    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            if (!empty($model->user_id)) {
                // log event
                UserLog::log($model->user_id, UserLogEvent::EVENT_RECEIVED, $model->id);
            }
        });
    }

    /**
     * Get the meta for this message
     */
    public function meta()
    {
        return $this->hasOne('App\Models\Message\InboundMeta', 'inbound_id');
    }
}   

?>