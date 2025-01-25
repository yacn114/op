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
        $permissions = Permission::query()->where('title',$permission)->first();
        return $this->permissions()->where("permission_id",$permissions->id)->exists();
    }
}
