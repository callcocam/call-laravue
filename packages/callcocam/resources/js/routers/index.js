
import { createRouter, createWebHistory } from "vue-router";
import App from "@/views/layouts/App.vue";
import Dashboard from "@/views/Dashboard.vue";

const createRoute = (path, name, label, index, component, children) => {
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

const createMenuRoute = (menu, menus, component, submenus) => {
    let path_name = menu.path_name;
    if (menus) {
        path_name = menus.path_name.concat(path_name);
    }
    return createRoute(
        path_name,
        menu.route_name,
        menu.title,
        true,
        component,
        submenus
    );
};

const createSubRoute = (sub, component) => {
    return createRoute(
        sub.path_name,
        sub.route_name,
        sub.title,
        false,
        component
    );
};

const createCrud = (item) => {
    const children = [];

    const path = item.path_name;
    const route_name = item.route_name;
    const title = item.title;

    children.push(
        createRoute(path, route_name, title, true, () =>
            import("@/views/crud/List.vue")
        ),
        [
            {
                path: path.concat("/:id/excluir"),
                name: route_name.concat(".destroy"),
                component: () => import("@/views/crud/Delete.vue"),
            },
        ]
    );
    children.push(
        createRoute(
            path.concat("/:id/editar"),
            route_name.concat(".edit"),
            title,
            true,
            () => import("@/views/crud/Edit.vue")
        )
    );
    children.push(
        createRoute(
            path.concat("/:id/visualizar"),
            route_name.concat(".view"),
            title,
            true,
            () => import("@/views/crud/View.vue")
        )
    );
    children.push(
        createRoute(
            path.concat("/cadastar"),
            route_name.concat(".create"),
            title,
            true,
            () => import("@/views/crud/Create.vue")
        )
    );

    return [
        {
            path: path_name,
            name: route_name.name,
            component: () => import("@/views/crud/Index.vue"),
            children,
        },
    ];
};

const cretaeRoutes = (data) => {
    const routers = [];

    const { allSidebarItems } = data;

    allSidebarItems.map((menus) => {
        const { items } = menus;
        if (items) {
            items.map((item) => {
                Object.values(item).map((menu) => {
                    const { submenu } = menu;
                    if (submenu) {
                        const submenus = [];
                        Object.values(submenu).map((sub) => {
                            submenus.push(
                                createSubRoute(sub, () =>
                                    import("@/views/crud/List.vue")
                                )
                            );
                        });
                        routers.push(
                            createMenuRoute(
                                menu,
                                null,
                                () => import("@/views/crud/Index.vue"),
                                submenus
                            )
                        );
                    } else {
                        routers.push(
                            createMenuRoute(
                                menu,
                                menus,
                                () => import("@/views/crud/List.vue"),
                                []
                            )
                        );
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
