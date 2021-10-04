<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'entry_numer',
        'description',
        'address',
        'commune',
        'entry_date',
        'limit_re_entry_date',
        're_entry_date',
        'status',
        'entry_doc_path',
        're_entry_doc_path',
        'customer_id',
        'type_project_id',
    ];

    public function type_proyect()
    {
        $this->belongsTo(TypeProject::class);
    }

    public function customer()
    {
        $this->belongsTo(Customer::class);
    }
}
