<?php

namespace App\Http\Controllers;

use App\Http\Requests\HubPostRequest;
use Illuminate\Http\Request;
use src\search\hub\infrastructure\HUBPostController;

class HubController extends Controller
{

    private $hexController;
    public function __construct()
    {
        $this->hexController = new HUBPostController();
    }

    public function search(HubPostRequest $request)
    {

        // validate the request
        $request->validated();



        $rooms = $this->hexController->__invoke(
            $request
        );

        return response()->json($rooms);
    }
}
