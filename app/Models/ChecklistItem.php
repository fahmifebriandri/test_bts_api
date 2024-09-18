<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ChecklistItem extends Model
{
    use HasFactory;

    protected $table = 'cbts_checklist_items';

    protected $guarded = [];
    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

}
