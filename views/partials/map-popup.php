<!-- Map Popup Template -->
<div id="mapop" class="col-xs-12 col-sm-6 infowindow_map" style="display: none;">
    <div class="mapop-content">
        <img class="featured" src="">
        <div class="result-item__price nosale center col-xs-12">
            <span class="currency">from <span class="price-range"></span>/night</span>
        </div>
        <div class="col-xs-12 text-center" style="margin-bottom: 20px;">
            <div class="col-xs-12 no-padding">
                <span class="prop_title">
                    <b class="prop-title"></b>
                </span>
            </div>
        </div>
        <ul id="loc-list">
            <li>
                <a href="#">
                    <img class="thumb" src="">
                    <div>
                        <small class="price">$8,888</small>
                        <label class="title">Title</label>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
    .gm-style .gm-style-iw-d{overflow: hidden!important;}
    .gm-style-iw.gm-style-iw-c{padding: 0;}
    .mapop-content{text-align: center;}
    .mapop-content img.featured { width: 280px; height: 110px; object-fit: cover; }
    .mapop-content a{display: block;}
    .mapop-content .currency {display: block;margin: 5px;}
    .mapop-content .prop_title { font-weight: 600; margin: 5px 0; display: block; max-width: 280px; }
    .gm-style .gm-style-iw-t::after{top:-1px;}

    #loc-list::-webkit-scrollbar{width:9px;height:9px}
    #loc-list::-webkit-scrollbar-thumb{background:linear-gradient(13deg,#F44932 14%,#f44932 64%);border-radius:10px}
    #loc-list::-webkit-scrollbar-track{background:#fff;border-radius:10px;box-shadow:inset 7px 10px 12px #f0f0f0}
    #loc-list{height:140px;background:#f0f0f0;overflow-y:auto;list-style:none;margin:5px 0}
    #loc-list li{background:#fff;margin:10px 5px;border-radius:3px;overflow:hidden}
    #loc-list a,#loc-list a div{display:flex;flex-direction:row;flex-wrap:wrap}
    #loc-list a div{width:133px;position: relative;}
    #loc-list a img{max-width:100px;height:auto;margin-right:10px;object-fit:cover}
    #loc-list li label { font-weight: 500; margin: 10px 0 10px 0px; height: auto; width: 100%; text-align: left; font-size: 11px; cursor: pointer; }
    #loc-list li small { width: 56px; margin: 10px 0; height: 20px; background: #F44932; color: #fff; padding: 4px 5px; border-radius: 18px; position: absolute; margin-left: -70px; margin-top: 5px; }
</style>