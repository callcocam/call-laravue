import { isPlainObject, map } from "lodash"
import { useRouter } from "vue-router";

class Menu {

    constructor() {
        this.options = {}
    }

    install(app, options = {}) {

        app.config.globalProperties.$menu = this

        app.provide('menus', this)

        this.extend(options || {})


        Object.entries(
            import.meta.glob("./components/**/*.vue", {
                eager: true,
            })
        ).forEach(([path, definition]) => {
            const component = path.replaceAll("./components/", "");

            const re = /\/\s(\w+)/;
            let name = component
                .replaceAll("/", "-")
                .replace(/\.\w+$/, "");

            const regex = /[A-Z]/g;

            const arrays = path.match(regex);

            arrays.map((v, i) => {
                name = name.replace(v, "-".concat(v));
            });
            name = name.replaceAll("--", "-").toLowerCase()
            let result = ('m-').concat(name);

            // console.log(result.replaceAll("--", "-"));

            app.component(result.replaceAll("--", "-"), definition.default);
        });


    }

    extend(extendWith) {
        if (typeof extendWith === 'object') {
            this.options = this.merge(this.options, extendWith)
            return this
        }
        throw new Error(`Menu.extend expects an object, was ${typeof extendWith}`)
    }

    merge(base, mergeWith, concatArrays = true) {
        var merged = {}
        for (var key in base) {
            if (mergeWith.hasOwnProperty(key)) {
                if (isPlainObject(mergeWith[key]) && isPlainObject(base[key])) {
                    merged[key] = this.merge(base[key], mergeWith[key], concatArrays)
                } else if (concatArrays && Array.isArray(base[key]) && Array.isArray(mergeWith[key])) {
                    merged[key] = base[key].concat(mergeWith[key])
                } else {
                    merged[key] = mergeWith[key]
                }
            } else {
                merged[key] = base[key]
            }
        }
        for (var prop in mergeWith) {
            if (!merged.hasOwnProperty(prop)) {
                merged[prop] = mergeWith[prop]
            }
        }
        return merged
    }


    createRoute(path, name, label, index, component, children) {
        if (name) {
            if (name.hasOwnProperty("name")) {
                name = name.name;
            }
        }
        return {
            path,
            name,
            component,
            meta: {
                label,
                index,
            },
            children,
        };
    };

    createMenuRoute(menu, menus, component, submenus) {
        let path_name = menu.path_name;
        if (menus) {
            if (path_name.includes('/')) {
                path_name = ('/').concat(menus.path_name.concat(path_name));
            } else {
                path_name = ('/').concat(menus.path_name.concat('/').concat(path_name));

            }
        }

        return this.createRoute(
            path_name,
            menu.route_name,
            menu.title,
            true,
            component,
            submenus
        );
    };

    createSubRoute(sub, component) {
        return this.createRoute(
            sub.path_name,
            sub.route_name,
            sub.title,
            false,
            component
        );
    };

    async load(router) {
        const { data } = await this.options.http.get('menus')

        const routers = [];

        const { allSidebarItems } = data;

        allSidebarItems.map((menus) => {
            const { items } = menus;
            if (items) {
                items.map((item) => {
                    map(item, menu => {
                        const submenus = [];
                        const { submenu } = menu;
                        if (submenu) {
                            map(submenu, sub => submenus.push(this.createSubRoute(sub, () => import("@/views/crud/List.vue"))))
                            routers.push(this.createMenuRoute(menu, null, () => import("@/views/crud/Index.vue"), submenus))
                        }
                        else {
                            routers.push(this.createMenuRoute(menu, menus, () => import("@/views/crud/List.vue")))
                        }
                    })
                })
            }
        })
        
        return { data, routers }

    }
}

export default new Menu