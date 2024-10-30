(function (a,b,c) {
    var po = b.createElement(a);
    var s = b.getElementsByTagName(a)[0];

    po.type = 'text/javascript';
    po.async = true;
    po.src = pluginConfig.server + 'widget/widget.js';
    s.parentNode.insertBefore(po, s);
})('script', document, window);