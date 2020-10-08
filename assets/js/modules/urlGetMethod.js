module.exports = {
    setGet: function(obj) {
        const url = new URL(window.location.href);
        const search_param = new URLSearchParams(url.search);

        obj.forEach(function (val){
            if (val[1] === ''){
                this.deleteGet([val[0]]);
                return;
            }
            search_param.set(val[0], val[1]);
        });

        url.search = search_param.toString();
        history.pushState(null, null, url.search);
    },
    deleteGet: function(indexGET) {
        const url = new URL(window.location.href);
        const search_param = new URLSearchParams(url.search.slice(1));

        $.each(indexGET, function (index, val){
            search_param.delete(val);
        });

        url.search = search_param.toString();
        history.pushState(null, null, url);
    },
};