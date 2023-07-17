import React from "react";

const PageContent: React.FC = () => {
    return (
        <div className="pagecontent">
            <div className="wrapper">
                <div className="dialog-box">
                    <div className="main-box">
                        <div data-v-5e94dcc7="">
                            <div className="tab-list display-flex box-center-Y">
                                <div className="tab-item active">跨鏈兌換</div>
                                <div className="box-flex1"></div>
                                <div className="exchangerule display-flex box-center">
                                    <img className="iconrule" src=""/>
                                    <div data-v-5e94dcc7="">兌換規則</div>
                                </div>
                            </div>
                            <div className="fromchain display-flex box-center-Y">
                                <div data-v-5e94dcc7="">From</div>
                                <div className="box-flex1 chaininfo display-flex box-flex1">
                                    <img className="iconchian" src=""/>
                                    <div data-v-5e94dcc7="">Polygon Testnet</div>
                                    <div className="line"></div>
                                    <div className="contractaddress">0xd5f9...2d9e</div>
                                </div>
                            </div>
                            <div className="send-box">
                                <div className="send-txt display-flex box-flex1">
                                    <div className="box-flex1">Send:</div>
                                    <div data-v-5e94dcc7="">餘額: 95,299,680.9799</div>
                                </div>
                                <div className="input-box display-flex box-center-Y">
                                    <input className="box-flex1" min="0" type="number" placeholder="輸入數量"/>
                                    <div className="all">All</div>
                                    <div className="line"></div>
                                    <div className="selecttoken display-flex box-center-Y">
                                        <img className="tokenimg" src=""/>
                                        <div data-v-5e94dcc7="">BGT</div>
                                        <div className="box-flex1"></div>
                                        <img className="downicon" src=""/>
                                    </div>
                                </div>
                                <div className="token-list">
                                    <div className="token-item display-flex box-center-Y active">
                                        <img className="tokenimg" src=""/>
                                        <div data-v-5e94dcc7="">BGT</div>
                                    </div>
                                    <div className="token-item weth display-flex box-center-Y">
                                        <img src="" className="tokenimg"/>
                                        <div data-v-5e94dcc7="">WETH</div>
                                    </div>
                                    <div className="token-item weth display-flex box-center-Y">
                                        <img src="" className="tokenimg"/>
                                        <div data-v-5e94dcc7="">USDT</div>
                                    </div>
                                </div>
                            </div>
                            <img className="iconexchange" src=""/>
                            <div className="fromchain display-flex box-center-Y">
                                <div data-v-5e94dcc7="">To</div>
                                <div className="box-flex1 chaininfo display-flex box-flex1">
                                    <img className="iconchian" src=""/>
                                    <div data-v-5e94dcc7="">Arbitrum Testnet</div>
                                    <div className="line"></div>
                                    <div className="contractaddress">0xd5f9...2d9e</div>
                                </div>
                            </div>
                            <div className="send-box receive-box">
                                <div className="send-txt">Receive:</div>
                                <div className="input-box receive display-flex box-center-Y">
                                    <input className="box-flex1"/>
                                    <div className="all">All</div>
                                    <div className="line"></div>
                                    <div data-v-5e94dcc7=""
                                         className="selecttoken display-flex box-center-Y">
                                        <img src="" className="tokenimg"/>
                                        <div data-v-5e94dcc7="">BGT</div>
                                        <img className="downicon receive" src=""/>
                                    </div>
                                </div>
                            </div>

                            <div className="exchangebtn-box">
                                <button type="button"
                                        className="van-button van-button--default van-button--normal exchangebtn display-flex box-center">
                                    <div className="van-button__content"> <span
                                        className="van-button__text">確定兌換</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <img className="lefttop" src=""/>
                    <img className="leftbottom" src=""/>
                    <img className="righttop" src=""/>
                    <img className="rightmiddle" src=""/>
                    <img className="rightbottom" src=""/>
                    <div className="desc desc1 display-flex box-center">
                        <div data-v-5e94dcc7="">BGT Polygon Testnet 地址<span
                            data-v-5e94dcc7="">0x811e...e3F</span></div>
                        <div data-v-5e94dcc7="">BGT Arbitrum Testnet 地址<span
                            data-v-5e94dcc7="">0x8098...76B</span></div>
                    </div>
                    <div className="desc">(完成兌換請認準官方合約地址，切勿相信其他渠道)</div>
                </div>
            </div>
        </div>
    );
}

export default PageContent