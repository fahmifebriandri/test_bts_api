<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Checklist extends Model
{
    use HasFactory;

    protected $table = 'cbts_checklist';

    protected $guarded = [];
    public function items()
    {
        return $this->hasMany(ChecklistItem::class);
    }

}
