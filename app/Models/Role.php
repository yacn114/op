<?php

namespace App\Models;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
    public function HasPermission($permission){
        return $this->permissions()->where("permission_id",$permission->id)->exists();
    }
}
