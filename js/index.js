$(function () {
    // aui
    var toast = new auiToast();

    function showToast(type) {
        switch (type) {
            case "success":
                toast.success({
                    title: "提交成功",
                    duration: 2000
                });
                break;
            case "fail":
                toast.fail({
                    title: "提交失败",
                    duration: 2000
                });
                break;
            case "custom":
                toast.custom({
                    title: "提交成功",
                    html: '<i class="aui-iconfont aui-icon-laud"></i>',
                    duration: 2000
                });
                break;
            case "loading":
                toast.loading({
                    title: "加载中",
                    duration: 2000
                }, function (ret) {
                    console.log(ret);
                    setTimeout(function () {
                        toast.hide();
                    }, 3000)
                });
                break;
            default:
                // statements_def
                break;
        }
    }

    // web3
    let web3 = undefined;
    if (typeof web3 !== 'undefined') {
        web3 = new Web3(web3.currentProvider);
    } else {
        web3 = new Web3(new Web3.providers.HttpProvider("https://rpc-mumbai.maticvigil.com/"));
    }

    // metamask
    if (typeof window.ethereum === 'undefined') {
        console.log("Please install MetaMask.");
    } else {
        initAccount()
    }

    var accountCurrent = null;
    var accountBalance = 0;

    function connectMetaMask() {
        ethereum
            .request({method: 'eth_requestAccounts'})
            .then(handleAccountsChanged)
            .catch((err) => {
                if (err.code === 4001) {
                    console.log('Please connect to MetaMask.');
                    showToast()
                } else {
                    console.error(err);
                }
            });
    }

    function handleAccountsChanged(accounts) {
        if (accounts.length === 0) {
            console.log('Please connect to MetaMask.');
            connectMetaMask();
        } else if (accounts[0] !== accountCurrent) {
            accountCurrent = accounts[0];
            console.log("accountCurrent: ", accountCurrent)
            $('.userAddress').text(accountCurrent.substring(0, 6) + "..." + accountCurrent.substring(39, 42))
        }
    }

    // 授权链接MetaMask
    $('#connectMetamask').click(function () {
        connectMetaMask();
    })

    // 初始化账号信息
    function initAccount() {
        ethereum.request({method: 'eth_accounts'}).then((accounts) => {
            if (accounts.length === 0) {
                alert("请连接MetaMask")
                connectMetaMask()
            } else {
                $('#connectMetamask').css("display", "none")
                $('.connectedMetamask').css("display", "block")
                web3.eth.getBalance(accounts[0]).then((balance) => {
                    accountBalance = (parseInt(balance) / 1e18).toFixed(4)
                    console.log(accountBalance)
                    $('#balance').text(accountBalance)
                });
            }
        });
    }

    // 设置当前激活账号
    function setAccount() {
        ethereum.request({method: 'eth_accounts'}).then((accounts) => {
            console.log(accounts[0]);
            handleAccountsChanged(accounts);
        });
    }


    // 监听账号切换
    ethereum.on('accountsChanged', (accounts) => {
        handleAccountsChanged(accounts);
    });

    initAccount();

    // 购买逻辑
    $('.selectToken').click(function () {
        $('.tokenList').toggle()
    })

    // 全部余额购买
    $('.all').click(function(){
        $('.butNum').val(accountBalance)
    })
    // 选择购买的币种
    $('.tokenItem').click(function (){
        $(this).siblings().removeClass("active")
        $(this).addClass("active")
    })
})