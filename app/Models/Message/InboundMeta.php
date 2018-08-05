<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Model;
use App\Models\Message\Outbound as OutboundMessage;

class InboundMeta extends Model
{
    /**
     * The table name attribute.
     *
     * @var string
     */
    public $table = 'message.inbound_meta';
    
    /**
     * The fillable attributes
     *
     * @var array
     */
    public $fillable = ['inbound_id', 'message_id', 'handle_id', 'contact_id', 'mechanism_id'];
    
    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            // trigger outbound
            $outbound = new OutboundMessage;
            $outbound->trigger($model);
        });
    }

    /**
     * Get the meta for this message
     */
    public function message()
    {
        return $this->belongsTo('App\Models\Message\Inbound', 'inbound_id');
    }

    /**
     * Get the meta for this message
     */
    public function handle()
    {
        return $this->belongsTo('App\Models\Client\Handle', 'handle_id');
    }
}
