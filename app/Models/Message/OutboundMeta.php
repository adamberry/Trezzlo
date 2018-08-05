<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Model;

class OutboundMeta extends Model
{
    /**
     * The table name attribute.
     *
     * @var string
     */
    public $table = 'message.outbound_meta';
    
    /**
     * The fillable attributes
     *
     * @var array
     */
    public $fillable = ['outbound_id', 'message_id', 'handle_id', 'contact_id', 'mechanism_id'];

    /**
     * Get the meta for this message
     */
    public function handle()
    {
        return $this->belongsTo('App\Models\Client\Handle', 'handle_id');
    }
}
