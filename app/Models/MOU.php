<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOU extends Model
{
    use HasFactory;
    protected $table = 'm_o_u_s';
    protected $fillable = [
        'mou_id',
        'mou_no',
        'mou_year',
        'subject',
        'ext_department',
        'dep_id',
        'country',
        'start_date',
        'end_date',
        'status',
        'file_path',
        'mou_type',
    ];
    protected $primaryKey = 'mou_id';

    public function department_name() {
        return $this->hasOne('App\Models\Department', 'dep_id', 'dep_id');
    }
}
