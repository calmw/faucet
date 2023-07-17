import React from "react";
import stylesHeader from './header.module.css';
import logo from '../assets/images/logo.png'
import up_down from '../assets/images/up_down.png'

const Header: React.FC = () => {

    return (
        <div className={[stylesHeader.pageheader].join(' ')}>
            <a href="/" className={stylesHeader.topLeft}>
                <img className={[stylesHeader.logo].join(' ')} src={logo}/>
            </a>
            <div className={stylesHeader.topRight}>
                <div className={stylesHeader.langbox}>
                    <div className={stylesHeader.langCurrent}>
                        <div>繁体中文</div>
                        <img className={stylesHeader.longIcon} src={up_down}/>
                    </div>
                    <div className="lang-box">
                        <div className="lang-item">English</div>
                        <div className="lang-item active">繁體中文</div>
                    </div>
                </div>
                <div className={stylesHeader.connectwallect}>
                    <img className="icon connecticon" src=""/>
                    <div>0xd5f9...d9e</div>
                    <div className="disconnect">
                        <div className="disconnect-con display-flex box-center">
                            <div>断开鏈接</div>
                            <img className="icon" src=""/>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    );
}

export default Header