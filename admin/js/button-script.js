window.___bi_bcfg = {
    textWidth:      buttonConfig.textWidth,
    textMargin:     buttonConfig.textMargin,
    iconWidth:      buttonConfig.iconWidth,
    height:         buttonConfig.height,
    topColor:       buttonConfig.backgroundColor,
    bottomColor:    buttonConfig.bottomColor,
    borderColor:    buttonConfig.bottomColor,
    color:          buttonConfig.textColor,
    fontSize:       buttonConfig.fontSize,
    text:           buttonConfig.buttonText,
    isSmall:        buttonConfig.isSmall,
    company:        buttonConfig.companyToken,
    guntonUrl:      pluginConfig.gunton,
    bamUrl:         pluginConfig.server
};

(function (a,b,c) {
    var po=b.createElement(a);po.type='text/javascript';
    po.async = true;po.src=pluginConfig.server + 'widget/button.js';var s=b.getElementsByTagName(a)[0];
    s.parentNode.insertBefore(po, s);
})('script', document, window);