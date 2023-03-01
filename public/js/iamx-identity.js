var IAMX = (function (parent, $) {
    window.addEventListener("message", function (event) {
        if (event.data.type === "FROM_IAMX") {
            console.log("FROM_IAMX: ", JSON.stringify(event.data.msg));
            IAMX.Identity.onResponse(event.data.msg);
        }
    });
    var Identity = {
        name: "",
        did: null,
        isConnected: false,
        init: () => {
            console.log('init:');
            $('#identityBtn').click(function () {
                if ($('#identityBtn').hasClass('btn-open')) {
                    $('#identity-options').hide();
                    if (Identity.isConnected == false) {
                        $('#identityaddr').html("Connect Identity &or;")
                    }
                    $('#identityBtn').removeClass('btn-open');
                } else {
                    $('#identity-options').show();
                    if (Identity.isConnected == false) {
                        $('#identityaddr').html("Connect Identity &and;")
                    }
                    $('#identityBtn').addClass('btn-open');
                }
            });

            $('#identity-options').html('');
            let btn = `<button type="button" class="btn identity-btn" onclick="IAMX.Identity.connect('IAMX');">` +
                `<img src="/images/IAMX_OYI_Blue.png" alt="IAMX" class="identity-icon" />` +
                `<img src="/images/IAMX_OYI_White.png" alt="IAMX" class="identity-icon2" />` +
                `<span class="wallet-name sr-only">IAMX</span>` +
                `</button>`;
            $('#identity-options').append(btn);

            $("#identity-options").mouseleave(function () {
                $('#identity-options').hide();
                if (Identity.isConnected == false) {
                    $('#identityaddr').html("Connect Identity &or;")
                }
                $('#identityBtn').removeClass('btn-open');
            });
            $("#identityBtn").mouseleave(function () {
                $('#identity-options').hide();
                if (Identity.isConnected == false) {
                    $('#identityaddr').html("Connect Identity &or;")
                }
                $('#identityBtn').removeClass('btn-open');
            });
        },
        connect: (name) => {
            console.log('connect:' + name);
            let payload = {
                price: "0,00 ADA",
                product: "rKYC",
                productimage: "https://kyc.iamx.id/images/IAMX_OYI_White.png",
                site:  "https://kyc.iamx.id"
              };
            Identity.requestCredentials(name,payload);
        },
        resume: (did) => {
            console.log('resume: ' + did);
        },
        disconnect: () => {
            console.log('disconnect:');
            Wallet.isConnected = false;

            $('#identity-options').html('');
            let btn = `<button type="button" class="btn identity-btn" onclick="IAMX.Identity.connect('IAMX');">` +
                `<img src="/images/IAMX_OYI_Blue.png" alt="IAMX" class="identity-icon" />` +
                `<img src="/images/IAMX_OYI_White.png" alt="IAMX" class="identity-icon2" />` +
                `<span class="wallet-name sr-only">IAMX</span>` +
                `</button>`;
            $('#identity-options').append(btn);
        },
        onResponse: (data) => {
          /*
          {"type":"FROM_IAMX","msg":{"did":{"context":["https://www.w3.org/ns/did/v1","https://w3id.org/security/suites/ed25519-2020/v1"],
          "id":"did:iamx:43373956-e752-4c1a-8529-3e601db0d53a","authentication":{"id":"","type":"","controller":"","publicKeyMultibase":""},"credentials":[{"data":"debc879591e984d2f7521a414d1264a79135ea62fe97ad7abfffbaa2efd485ca","publicKeyMultibase":"-----BEGIN RSA PUBLIC KEY-----\nMIIBCgKCAQEA5xmw1Y9FU9UvcYsz6S74TxyYRJ5UKMaKzWK4E5e6KW6wVKdfV+iS\nEf5ERAyZ3uTZ8WnwSVb8/t9YNuo+0kskViVhetjFRC876Yvr6x4iJkv8TOb+NTeh\n8UVs/G66Hm6UbevgLsCynfs6BbUOTUNOokl+5QQfeZTGScC8qHh4xwNjOqaIZQCA\ncVZGamSUkObj6UImE8cgH1kqZiPVvC+TPo35Kj6v8H76QDDnjacBCBmZlDJ1zKcg\nPrSSl/V2v/Bnk5i4UCuNHq0PvMX6lRdQSq83l1hdlpcIHtnJ0K4fiwkIUX7HiNS1\nVoSRjqDXDfielx1wfLYT5kkbZPEVDRgUxwIDAQAB\n-----END RSA PUBLIC KEY-----\n"}]},"cpay":{"passportid":"L0L0016W7","lastname":"MUSTERMANN","firstname":"ERIKA","birthdate":"12.08.1983","nationality":"DEUTSCH","birthplace":"BERLIN","zipcode":"51147","city":"KÖLN","street":"HEIDESTRASSE","housenr":"17","iban":"DE02370502990000684712","email":"erika@compucamus.de","gender":"FEMALE"}}}
          */
            console.log('onResponse: ' + data.did.id);
            Identity.isConnected = true; 
            Identity.did = data.did.id;
            let addrStr = Identity.did.substring(0, 8) + "..." + Identity.did.substring(Identity.did.length - 6);
            let img = `<img src="/images/IAMX_OYI_Blue.png" alt="IAMX" class="identity-icon" />`;
            $('#identityaddr').html('');
            $('#identityaddr').append(img);
            $('#identityaddr').append(addrStr);
            /*
            $.ajax({
                url: "/wallet_connect/" + walletName + "/" + Wallet.bech32
            }).done(function () {
                $(this).addClass("done");
            });
            */
            $('#identity-options').html('');
            let btn = `<button type="button" class="identity-btn btn" onclick="IAMX.Identity.disconnect();">` +
                `<span class="identity-name sr-only">Disconnect</span>` +
                `</button>`;
            $('#identity-options').append(btn);
        },
        //Selective Disclosure
        // 1. Website requests Creentials
        requestCredentials: (schema, payload) => {
            console.log('requestCredentials: ' + schema);
            console.log('requestCredentials: ' + payload);
            window.postMessage({
                type: "FROM_PAGE",
                msg: "requestCredentials",
                schema: schema,
                payload: payload,
            });
        },
        // 2. Identity Wallet (Browser Extension) aks User for permission to share requestet data with the website

        // 3. Website receives credentials
        receiveCredentials: (data) => {
            console.log('receiveCreentials: ' + data);
        },
        // 4. Website verifies credentials
        verifyCredentials: (data) => {
            console.log('receiveCreentials: ' + data);
        },
        iaAvailable: ()  => {
            return windows.carano != undefined;
        }
    };
    parent.Identity = Identity;
    return parent;
})(IAMX || {}, jQuery);