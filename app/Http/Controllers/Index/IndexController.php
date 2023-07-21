<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Chain;
use App\Models\Token;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function Index(Request $request)
    {
        $lang = $request->lang == "zh" ? "English" : "简体中文";
        $tokenModel = new Token();
        $tokenInfo = $tokenModel
            ->leftJoin("rate", "rate.token_id", '=', 'token.id')
            ->select('token.*', 'rate.rate')
            ->orderBy('token.id', 'asc')
            ->get();

        $chainModel = new Chain();
        $chainInfo = $chainModel->where('id', 2)->first();

        return view('index', ["tokenInfo" => $tokenInfo, 'lang' => $lang, 'chainInfo' => $chainInfo]);
    }
}
