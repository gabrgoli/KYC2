var IAMX = (function (parent, $) {
    var Wallet = {
        wallet: null,
        wallets: [],
        walletNames: [],
        bech32: null,
        hexAddr: null,
        isConnected: false,
        computeBech32: (address) => {
            const data = "addr"; //this.networkId === types_1.NetworkId.MAINNET ? "addr" : "addr_test";
            const words = IAMX.bech32.toWords(address);
            const encoded = IAMX.bech32.encode(data, words, 200);
            return encoded;
        },
        connect: async function (walletName) {
            console.log('connect: ' + walletName);
            try {
                Wallet.wallet = await window.cardano[walletName].enable();
                let raw = await Wallet.wallet.getRewardAddresses();
                Wallet.hexAddr = raw[0];
                Wallet.bech32 = Wallet.computeBech32(Wallet.hexAddr);
                console.log(Wallet.bech32);
                Wallet.isConnected = true;
                const wallet_network = await Wallet.wallet.getNetworkId();
                let addrStr = Wallet.bech32.substring(0, 6) + "..." + Wallet.bech32.substring(Wallet.bech32.length - 6);
                let the_wallet = window.cardano[walletName];
                let img = `<img src="${the_wallet.icon}" alt="${the_wallet.name}" height="24" class="wallet-icon-small" />`;
                $('#walletaddr').html('');
                $('#walletaddr').append(img);
                $('#walletaddr').append(addrStr);
                $.ajax({
                    url: "/wallet_connect/" + walletName + "/" + Wallet.bech32
                }).done(function () {
                    $(this).addClass("done");
                });
                $('#wallet-options').html('');
                let btn = `<button type="button" class="wallet-btn btn" onclick="IAMX.Wallet.disconnect();">` +
                    `<span class="wallet-name sr-only">Disconnect</span>` +
                    `</button>`;
                $('#wallet-options').append(btn);
            } catch (err) {
                console.log(err);

            }
        },
        disconnect: async function () {
            console.log('disconnect:');
            try {
                Wallet.wallet = null;
                Wallet.hexAddr = null;
                Wallet.bech32 = null;
                Wallet.isConnected = false;
                $.ajax({
                    url: "/wallet_disconnect"
                }).done(function () {
                    $(this).addClass("done");
                });
                $('#wallet-options').html('');
                Wallet.wallets.forEach((wallet) => {
                    let the_wallet = window.cardano[wallet];
                    let btn = `<button type="button" class="btn wallet-btn" data-wallet="${wallet}" onclick="IAMX.Wallet.connect('${wallet}');">` +
                        `<img src="${the_wallet.icon}" alt="${the_wallet.name}" class="wallet-icon"  />` +
                        `<span class="wallet-name sr-only">${the_wallet.name}</span>` +
                        `</button>`;
                    $('#wallet-options').append(btn);
                });
            } catch (err) {
                console.log(err);

            }
        },
        resume: async function (walletName, bech32) {
            console.log('resume: ' + walletName, bech32);
            try {
                Wallet.bech32 = bech32;
                Wallet.isConnected = true;
                let addrStr = Wallet.bech32.substring(0, 6) + "..." + Wallet.bech32.substring(Wallet.bech32.length - 6);
                let the_wallet = window.cardano[walletName];
                let img = `<img src="${the_wallet.icon}" alt="${the_wallet.name}" height="24" class="wallet-icon-small" />`;
                $('#walletaddr').html('');
                $('#walletaddr').append(img);
                $('#walletaddr').append(addrStr);
                $.ajax({
                    url: "/wallet_connect/" + walletName + "/" + Wallet.bech32
                }).done(function () {
                    $(this).addClass("done");
                });
                $('#wallet-options').html('');
                let btn = `<button type="button" class="wallet-btn btn" onclick="IAMX.Wallet.disconnect();">` +
                    `<span class="wallet-name sr-only">Disconnect</span>` +
                    `</button>`;
                $('#wallet-options').append(btn);
            } catch (err) {
                console.log(err);

            }
        },
        init: async function () {
            //Get Available Wallets
            for (const key in window.cardano) {
                if (
                    window.cardano[key].enable &&
                    Wallet.wallets.indexOf(key) === -1 &&
                    Wallet.walletNames.indexOf(window.cardano[key].name) === -1
                ) {
                    Wallet.wallets.push(key);
                    Wallet.walletNames.push(window.cardano[key].name);
                }
            }
            //Add Wallets to Dropdown
            $('#wallet-options').html('');
            Wallet.wallets.forEach((wallet) => {
                let the_wallet = window.cardano[wallet];
                let btn = `<button type="button" class="btn wallet-btn" data-wallet="${wallet}" onclick="IAMX.Wallet.connect('${wallet}');">` +
                    `<img src="${the_wallet.icon}" alt="${the_wallet.name}" class="wallet-icon"  />` +
                    `<span class="wallet-name sr-only">${the_wallet.name}</span>` +
                    `</button>`;
                $('#wallet-options').append(btn);
            });
            //Init GUI
            $('#walletBtn').click(function () {
                if ($('#walletBtn').hasClass('btn-open')) {
                    $('#wallet-options').hide();
                    if (Wallet.isConnected == false) {
                        $('#walletaddr').html("Connect Wallet &or;")
                    }
                    $('#walletBtn').removeClass('btn-open');
                } else {
                    $('#wallet-options').show();
                    if (Wallet.isConnected == false) {
                        $('#walletaddr').html("Connect Wallet &and;")
                    }
                    $('#walletBtn').addClass('btn-open');
                }
            });
            $("#wallet-options").mouseleave(function () {
                $('#wallet-options').hide();
                if (Wallet.isConnected == false) {
                    $('#walletaddr').html("Connect Wallet &or;")
                }
                $('#walletBtn').removeClass('btn-open');
            });
            $("#walletBtn").mouseleave(function () {
                $('#wallet-options').hide();
                if (Wallet.isConnected == false) {
                    $('#walletaddr').html("Connect Wallet &or;")
                }
                $('#walletBtn').removeClass('btn-open');
            });
        },
        iaAvailable: ()  => {
            return windows.carano != undefined;
        }
    };
    parent.Wallet = Wallet;
    return parent;
})(IAMX || {}, jQuery);