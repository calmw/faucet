<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Chain;
use App\Models\SysConfig;
use App\Models\Token;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function Index(Request $request)
    {
        $lang = $request->lang == "zh" ? "English" : "简体中文";
        $msgBuySuccess = $request->lang == "zh" ? "购买成功，请稍后到对应链查看" : "Buy success, Please check later.";
        $tokenModel = new Token();
        $tokenInfo = $tokenModel
            ->leftJoin("rate", "rate.token_id", '=', 'token.id')
            ->select('token.*', 'rate.rate')
            ->orderBy('token.id', 'asc')
            ->get();

        $chainModel = new Chain();
        $chainInfo = $chainModel->where('is_default', 1)->first();

        $sysConfigModel = new SysConfig();
        $sysConfigInfo = $sysConfigModel->where('id', 1)->first();

        return view('index', [
            "tokenInfo" => $tokenInfo,
            'lang' => $lang,
            'chainInfo' => $chainInfo,
            'msgBuySuccess' => $msgBuySuccess,
            'sysConfigInfo' => $sysConfigInfo,
        ]);
    }
}
