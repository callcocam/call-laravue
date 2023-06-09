
import { createRouter, createWebHistory } from "vue-router";
import App from "@/views/layouts/App.vue";
import Dashboard from "@/views/Dashboard.vue";
import Index from "@/views/crud/Index.vue";
import { get, map } from "lodash";

const components = {
    icones: () => import('@/views/Icones.vue')
}

const createMenuRoute = (path_name, route_name, children = [], component = null) => {
    if (component) {
        if (components.hasOwnProperty(component))
            component = components[component]
    } else {
        component = () => import("@/views/crud/Index.vue")
    }
    return {
        path: path_name,
        name: route_name,
        component,
        children
    }
};

const createSubRoute = (sub) => {
    let sub_path_name = sub.path_name;
    let sub_route_name = sub.name;

    return {
        path: sub_path_name,
        name: sub_route_name,
        meta: {
            label: sub.title,
            index: false,
        },
        component: () => import("@/views/crud/Index.vue")
    }

};

const createCrud = (path_name, route_name, label, meta={}) => {

    return {
        path: path_name,
        name: route_name,
        component: Index,
        redirect: { name: route_name.replace('index', 'list') },
        children: [
            {
                path: "",
                name: route_name.replace('index', 'list'),
                component: () => import("@/views/crud/List.vue"),
                meta: {
                    label,
                    index: true,
                },
                children: [
                    {
                        path: ":id/excluir",
                        name: route_name.replace(".index", ".destroy"),
                        component: () => import("@/views/crud/Delete.vue"),
                        meta: {
                            label,
                            component: meta.hasOwnProperty('componentDelete') ? meta.componentDelete : '',
                        },
                    },
                ],
            },
            {
                path: ":id/editar",
                name: route_name.replace(".index", ".edit"),
                component: () => import("@/views/crud/Edit.vue"),
                meta: {
                    label,
                    component: meta.hasOwnProperty('componentEdit') ? meta.componentEdit : '',
                },
            },
            {
                path: ":id/visualizar",
                name: route_name.replace(".index", ".show"),
                component: () => import("@/views/crud/View.vue"),                
                meta: {
                    label,
                    component: meta.hasOwnProperty('componentView') ? meta.componentView : '',
                }, 
            },
            {
                path: "cadastar",
                name: route_name.replace(".index", ".create"),
                component: () => import("@/views/crud/Create.vue"),
                meta: {
                    label,
                    component: meta.hasOwnProperty('componentCreate') ? meta.componentCreate : '',
                },
            }
        ],
    }
};

const cretaeRoutes = (data) => {
    const routers = [];

    const { allSidebarItems } = data;

    allSidebarItems.map((menus) => {
        const { items } = menus;
        if (items) {
            items.map((item) => {
                Object.values(item).map((menu, index) => {
                    const { submenu } = menu;
                    let path_name = menu.path_name;
                    let route_name = menu.name;
                    if (submenu) {
                        const childrens = [];
                        map(submenu, sub => {
                            if (sub.hasOwnProperty("crud") && sub.crud) {
                                childrens.push(createCrud(sub.path_name, sub.name, sub.title));
                            } else {
                                childrens.push(createSubRoute(sub))
                            }
                        })
                        routers.push(createMenuRoute(path_name, path_name.concat('.').concat(index).concat('.index'), childrens, menu.component))
                    } else {
                        if (path_name.includes('/')) {
                            path_name = menus.path_name.concat(path_name);
                        } else {
                            path_name = menus.path_name.concat('/').concat(path_name);
                        }
                        if (menu.hasOwnProperty("crud") && menu.crud) {
                            const { meta } = menu
                            routers.push(createCrud(path_name, route_name, menu.title, meta));
                        } else {
                            routers.push(createMenuRoute(path_name, route_name, [], menu.component));
                        }

                    }
                });
            });
        }
    });

    const routes = [
        {
            path: "/admin",
            name: "admin",
            component: App,
            redirect: { name: "dashboard" },
            children: [
                { path: "dashboard", name: "dashboard", component: Dashboard },
                ...routers,
                {
                    path: "file-manager",
                    name: "file-manager",
                    component: () => import("@/views/FileManager.vue"),
                    meta:{
                        fileManager:true
                    }
                }, 
                {
                    path: "/:pathMatch(.*)*",
                    name: "NotFound",
                    component: () => import("@/views/NotFound.vue"),
                },
            ],
        },
    ];

    // 3. Create the router instance and pass the `routes` option
    // You can pass in additional options here, but let's
    // keep it simple for now.
    const router = createRouter({
        // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
        history: createWebHistory(),
        routes, // short for `routes: routes`
    });
    return router;
};

export { cretaeRoutes };
