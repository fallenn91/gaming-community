<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommunityUserController extends Controller
{
    public function kickOut($userId)
    {
      // Usuario actual pertenece a esa comunidad?
      // Tiene permisos?
      // Role?
      // Puede expulsar a alguien con igual o mayor rango?

      $userCommunity = UserCommunity::where('community_id', $communityId)
            ->where('user_id', $userId)
            ->first();           
      
    }
}
