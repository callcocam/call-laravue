
export default {
    install: async (app, options) => {
        let languages;
        languages = {};
        // if(localStorage.getItem('lang')){
        //     languages = JSON.parse(localStorage.getItem('lang'))
        // }else{
        //     const { data } = await http.get('lang')
        //     localStorage.setItem('lang', JSON.stringify(data))
        //     languages = data
        // }

        const t = (key) => {
            let trans = key.split(".").reduce((o, i) => {
                if (o) return o[i];
            },Object.assign({}, options, languages));
            return trans ?? key;
        }
        app.config.globalProperties.$t = t ;

        app.config.globalProperties.$translate = t;




        app.provide("i18n", Object.assign({}, options, languages));
    },
};
