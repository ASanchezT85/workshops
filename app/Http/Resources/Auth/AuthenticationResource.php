<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'created_at'    => $this->created_at->format('d-M-Y'),
            'updated_at'    => $this->updated_at->format('d-M-Y'),
            'type'          => $this->type,
            'permissions'   => $this->permissions($this->roles),
        ];
    }

    protected function permissions($roles)
    {   
        $permissions = array();
        foreach ($roles as $role) {
            if(is_null($role->special)){
                foreach ($role->permissions as $permission) {
                     if (!in_array($role->slug, $permissions)) {
                        $permissions[] = $permission->slug;
                    }
                }
            }

            if( ! is_null($role->special) ){
                $permissions[] = $role->special;
            }
        }

        return $permissions;
    }
}
