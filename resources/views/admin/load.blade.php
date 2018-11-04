<div class="lds-css ng-scope">
        <div style="width:100%;height:100%" class="lds-wedges">
            <div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
            </div>
        </div>
        <style type="text/css">
            @keyframes lds-wedges {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }

            @-webkit-keyframes lds-wedges {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }

            .lds-wedges {
                position: relative;
            }

            .lds-wedges>div>div {
                -webkit-transform-origin: 100px 100px;
                transform-origin: 100px 100px;
                -webkit-animation: lds-wedges 3s linear infinite;
                animation: lds-wedges 3s linear infinite;
                opacity: 0.8;
            }

            .lds-wedges>div>div>div {
                position: absolute;
                left: 30px;
                top: 30px;
                width: 70px;
                height: 70px;
                border-radius: 70px 0 0 0;
                -webkit-transform-origin: 100px 100px;
                transform-origin: 100px 100px;
            }

            .lds-wedges>div div:nth-child(1)>div {
                background: #1d3f72;
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            .lds-wedges>div div:nth-child(1) {
                -webkit-animation-duration: 0.75s;
                animation-duration: 0.75s;
            }

            .lds-wedges>div div:nth-child(2)>div {
                background: #5699d2;
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            .lds-wedges>div div:nth-child(2) {
                -webkit-animation-duration: 1s;
                animation-duration: 1s;
            }

            .lds-wedges>div div:nth-child(3)>div {
                background: #d8ebf9;
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            .lds-wedges>div div:nth-child(3) {
                -webkit-animation-duration: 1.5s;
                animation-duration: 1.5s;
            }

            .lds-wedges>div div:nth-child(4)>div {
                background: #71c2cc;
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            .lds-wedges>div div:nth-child(4) {
                -webkit-animation-duration: 3s;
                animation-duration: 3s;
            }

            .lds-wedges {
                width: 200px !important;
                height: 200px !important;
                -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
                transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
            }
        </style>
    </div>