<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faucet</title>
    <meta type="keywords" content="faucet testnet">
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <link href="/layui/css/layui.css" rel="stylesheet">
</head>
<body>
<header class="pageHeader">
    <a href="/" class="topLeft">
        <img class="logo" src="./images/logo.png" alt="">
    </a>
    <div class="topRight">
        <div class="langBox">
            <div class="currentLangBox">
                <span class="currentLang">{{$lang}}</span>
                <img class="langUpDown" src="images/up_down.png">
            </div>
            <div class="langSelect">
                <a href="/?lang=en" class="langLi ">English</a>
                <a href="/?lang=zh" class="langLi langLiBottom">简体中文</a>
            </div>
        </div>
        <div class="connectWallet">
            <div class="connectMetamask">
                <img class="connectIcon" src="images/connect.png">
                <span class="connect">{{__('index.connectMetaMask')}}</span>
            </div>
            <div class="connectedMetamask">
                <div class="walletInfo">
                    <img class="chainIcon" src="images/polygon.png" alt="">
                    <div class="userAddress">0xd5f9...d9e</div>
                </div>
                <div class="disconnect">
                    <span>断开连接</span>
                    <img class="icon" src="images/disconnect.png" alt="">
                </div>
            </div>
        </div>
    </div>
</header>
<section class="content">
    <img class="leftTop" src="./images/bg_left_top.png">
    <img class="leftBottom" src="./images/bg_left_bottom.png">
    <img class="rightTop" src="images/bg_right_top.png">
    <img class="rightMiddle" src="./images/bg_right_middle.png">
    <img class="rightBottom" src="./images/bg_right_bottom.png">
    <div class="dialogBox">
        <div class="top">
            <div class="buyTitle">{{__('index.buyTestnetCoin')}}</div>
            <div class="buyRule">
                <img class="iconRule" src="./images/swap_rule.png">
                <span>{{__('index.buyRules')}}</span>
            </div>
        </div>
        <div class="buyBox">
            <div class="buyTop">
                <div class="buyTopLeft">Buy:</div>
                <div class="buyTopRight">{{__('index.receive')}} ≈ <span id="receive">0</span>
                    <span id="tokenName">MATIC</span>
                </div>
                <div class="buyTopRight">{{__('index.balance')}}: <span id="balance">0</span>
                    <span>MATIC</span>
                </div>
            </div>
            <div class="buyContent">
                <input class="buyNum" min="0"
                       type="number" placeholder="{{__('index.typeCoinNum')}}">
                <div class="all">All</div>
                <div class="line"></div>
                <div class="selectToken">
                    @foreach($tokenInfo as $k=>$t)
                        @if($k==0)
                            <img class="tokenLogo" src="{{$t->chain_logo}}">
                            <div class="tokenName">{{$t->token_name}}</div>
                            <img class="downIcon" src="./images/up_down.png">
                        @endif
                    @endforeach
                </div>
                <div class="tokenList">
                    @foreach($tokenInfo as $k=>$t)
                        @if($k==0)
                            <div class="tokenItem active">
                                <img class="tokenImg" src="{{$t->token_logo}}">
                                <span>{{$t->token_name}} ({{$t->chain_name}})</span>
                            </div>
                        @else
                            <div class="tokenItem">
                                <img class="tokenImg" src="{{$t->token_logo}}">
                                <span>{{$t->token_name}} ({{$t->chain_name}})</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="exchangeBox">
            <button type="button" class="exchangeButton">
                {{__('index.buyBtn')}}
            </button>
        </div>
        <div class="desc">
            <div>
                <p>{{__('index.BuyTips')}}</p>
            </div>
        </div>
    </div>
</section>
<footer class="footer">
    <div class="footerText">Copyright © 2020-{{date('Y')}}, Feedback: calm.fei@gmail.com</div>
</footer>
</body>
</html>
<script type="text/javascript" src="/js/jquery.js"></script>
<script src="/js/web3.js"></script>
<script src="/layui/layui.js"></script>
<script type="text/javascript">
    let tokenIndex = 0;
    let accountCurrent = null;
    let accountBalance = 0;
    let receiveCoin = 0;
    let buyNum = 0;
    let MetaMaskConnected = false;
    let MetaMaskInstalled = false;
    let ErrBalanceZero = '{{__('index.errBalanceZero')}}';
    let ErrBuyNumZero = '{{__('index.errBuyNumZero')}}';
    let StatusBuying = '{{__('index.statusBuying')}}';
    let StatusBuySuccess = '{{__('index.statusBuySuccess')}}';
    let StatusBuyFailed = '{{__('index.statusBuyFailed')}}';
    const tokens = [
            @foreach($tokenInfo as $k=>$t)
        {
            "chain_logo": "{{$t->chain_logo}}",
            "chain_name": "{{$t->chain_name}}",
            "token_logo": "{{$t->token_logo}}",
            "token_name": "{{$t->token_name}}",
            "chain_id": "{{$t->chain_id}}",
            "rate": "{{$t->rate}}",
        },
        @endforeach
    ];

    // web3
    let web3 = undefined;
    if (typeof web3 !== 'undefined') {
        web3 = new Web3(web3.currentProvider);
    } else {
        web3 = new Web3(new Web3.providers.HttpProvider("{{$chainInfo->chain_rpc}}"));
    }

    // metamask
    if (typeof window.ethereum === 'undefined') {
        layer.msg("Please install MetaMask")
    } else {
        initAccount()
    }

    // 检查网络
    async function checkChain() {
        const {ethereum} = window;
        // 判断链对不，链不对就请求切换网络，或者添加网络，
        if (ethereum) {
            try {
                await ethereum.request({
                    method: 'wallet_switchEthereumChain',
                    params: [{
                        chainId: Web3.utils.numberToHex({{$chainInfo->chain_id}})
                    }]
                })
                MetaMaskInstalled = true;
                MetaMaskConnected = true;
            } catch (err) {
                if (err.code === 4902) {
                    try {
                        await ethereum.request({
                            method: 'wallet_addEthereumChain',
                            params: [
                                {
                                    chainId: Web3.utils.numberToHex({{$chainInfo->chain_id}}),
                                    chainName: '{{$chainInfo->chain_name}}',
                                    nativeCurrency: {
                                        name: 'MATIC',
                                        symbol: 'MATIC',
                                        decimals: 18
                                    },
                                    rpcUrls: ['{{$chainInfo->chain_rpc}}'], // 节点
                                    blockExplorerUrls: ['{{$chainInfo->explorer}}']
                                }
                            ]
                        })
                    } catch (ee) {
                        console.log('Add chain failed.');
                        layer.msg("Add chain failed")
                    }
                } else if (err.code === 4001) {
                    console.log('Please connect to MetaMask.');
                    layer.msg("Please connect to MetaMask.")
                }
            }
        }
    }

    function isMetaMaskInstalled() {
        return Boolean(window.ethereum && window.ethereum.isMetaMask);
    }

    async function isMetaMaskConnected() {
        const {ethereum} = window;
        const accounts = await ethereum.request({method: 'eth_accounts'});
        return accounts && accounts.length > 0;
    }

    async function initialise() {
        MetaMaskInstalled = isMetaMaskInstalled();
        MetaMaskConnected = await isMetaMaskConnected();
    }

    // 初始化账号信息
    async function initAccount() {
        await checkChain()
        await initialise();
        if (!MetaMaskInstalled) {
            layer.msg("Please install MetaMask.")
            return;
        }
        if (!MetaMaskConnected) {
            connectMetaMask();
            return;
        }
        window.ethereum.request({method: 'eth_accounts'}).then((accounts) => {
            if (accounts.length > 0) {
                $('.connectMetamask').css("display", "none")
                $('.connectedMetamask').css("display", "block")
                setAccount()
            }
        });
    }

    function connectMetaMask() {
        window.ethereum
            .request({method: 'eth_requestAccounts'})
            .then(setAccount)
            .catch((err) => {
                if (err.code === 4001) {
                    console.log('Please connect to MetaMask.');
                    layer.msg("Please connect to MetaMask.")
                } else {
                    layer.msg(err.message)
                    console.error(err);
                }
            });
    }

    function handleAccountsChanged(accounts) {
        if (accounts[0] !== accountCurrent) {
            accountCurrent = accounts[0];
            let subUserAddress = accountCurrent.substring(0, 6) + "..." + accountCurrent.substring(39, 42)
            $('.userAddress').text(subUserAddress);
            web3.eth.getBalance(accountCurrent).then((balance) => {
                accountBalance = (parseInt(balance) / 1e18).toFixed(4)
                renderNum()
            });
        }
    }

    // 设置当前激活账号
    function setAccount() {
        window.ethereum.request({method: 'eth_accounts'}).then((accounts) => {
            if (MetaMaskConnected) {
                handleAccountsChanged(accounts);
            } else {
                renderNum()
            }
        });
    }

    // 断开连接
    function disConnect() {
        accountCurrent = null;
        accountBalance = 0;
        receiveCoin = 0;
        buyNum = 0;
        MetaMaskConnected = false;
        renderNum()
    }

    // 数值渲染
    function renderNum() {
        receiveCoin = (parseFloat(tokens[tokenIndex]['rate']) * accountBalance * buyNum).toFixed(4)
        console.log()
        $('#balance').text(accountBalance);
        $('#receive').text(receiveCoin);
        $('#tokenName').text(tokens[tokenIndex]['token_name']);
        $('.buyNum').val(buyNum);
    }

    // 监听账号切换
    window.ethereum.on('accountsChanged', async (accounts) => {
        handleAccountsChanged(accounts);
    });

    // 转账交易
    async function transfer() {
        let buyLoading = layer.load(0, {shade: false});

        MetaMask = new Web3(window.ethereum);
        await MetaMask.eth.sendTransaction({
            from: accountCurrent,
            to: '{{$sysConfigInfo->account}}',
            value: web3.utils.toWei(buyNum, 'ether'),
            chainId: {{$chainInfo->chain_id}}
        }).then(res => {
            console.log("转账完成,txHash: ", res.transactionHash);
            // 下单
            $.ajax({
                url: "demo_test.txt",
                data: {
                    txHash: res.transactionHash,
                    tokenId: tokenIndex + 1,
                    lang: {{$lang=='en'?'zh':'en'}}
                },
                success: function (result) {
                    layer.close(buyLoading);
                    // .....
                }
            });
        }).catch(err => {
            console.error(err);
            layer.msg(err.message);
        });
    }
</script>
<script type="text/javascript" src="js/index.js"></script>
