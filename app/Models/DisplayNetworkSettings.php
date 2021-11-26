<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisplayNetworkSettings extends Model
{
    protected $fillable = [
      'display_id',
      'display_identifier',
      'mac',
      'ip',
      'vpn_ip',
    ];

    public function isOnline() {
        return $this->is_online === 1;
    }
}
