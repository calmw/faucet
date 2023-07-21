$(function () {
    // 初始化钱包及账户信息
    initAccount();

    // 授权链接MetaMask
    $('.connectMetamask').click(function () {
        initAccount();
    })
    // 断开链接MetaMask
    $('.disconnect').click(function () {
        $('.connectedMetamask').hide()
        $('.connectMetamask').show()
        disConnect();
    })


    // 购买选择币种
    $('.selectToken').click(function () {
        $('.tokenList').toggle()
    })
    // 选择购买的币种
    $('.tokenItem').click(function () {
        tokenIndex = $(this).index();
        $(this).siblings().removeClass("active")
        $(this).addClass("active")
        $('.tokenList').toggle()
        $('.tokenLogo').attr("src", tokens[tokenIndex]['chain_logo'])
        $('.tokenName').text(tokens[tokenIndex]['token_name'])
        renderNum()
    })

    // 购买选择全部余额
    $('.all').click(function () {
        buyNum = accountBalance
        $('.buyNum').val(accountBalance)
        renderNum()
    })

    // 选择语言
    $('.langBox').hover(function () {
        $(".currentLangBox").css('border-radius', "20px 20px 0 0");
        $(".langUpDown").css({'transform': 'rotate(180deg)', 'transition': 'transform 0.2s ease-in-out'});
        $('.langSelect').show()
    }, function () {
        $(".currentLangBox").css('border-radius', "30px");
        $(".langUpDown").css({'transform': 'rotate(360deg)', 'transition': 'transform 0.2s ease-in-out'});
        $('.langSelect').hide()
    })

    // 显示钱包断开连接
    $('.connectedMetamask').hover(function () {
        $('.disconnect').show()
    }, function () {
        $('.disconnect').hide()
    })

    // 输入购买数量
    $('.buyNum').blur(function () {
        typeNum = parseFloat($(this).val())
        if (typeNum > accountBalance) {
            buyNum = accountBalance
        } else {
            buyNum = parseFloat($(this).val())
        }
        $(this).val(buyNum)
        renderNum()
    })

    // 购买
    $('.exchangeButton').click(async function () {
        console.log(buyNum)
        if (buyNum <= 0) {
            layer.msg(ErrBuyNumZero)
        }
        if (accountBalance <= 0) {
            layer.msg(ErrBalanceZero)
        }
        if (accountCurrent && accountBalance > 0 && buyNum > 0) {
            await transfer()
        }
    })
})
