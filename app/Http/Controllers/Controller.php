<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var int $perPage Per Page.
     */
    public $perPage;

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        Auth()->shouldUse('api');
        $this->perPage = $request->limit ?? 15;
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|User
     */
    public function user()
    {
        return Auth::user();
    }
}
