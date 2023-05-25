const makes = [
    {
        path: "makes",
        name: "makes.index",
        component: () => import("../views/List.vue"),
        children: [
            {
                path: ":id/excluir",
                name: "makes.destroy",
                component: () =>
                    import("../views/Delete.vue"),
            },
        ],
        meta: {
            label: "Makes",
            index: true,
        },
    },
    {
        path: "makes/:id/editar",
        name: "makes.edit",
        component: () => import("../views/Edit.vue"),
        meta: {
            label: "Edit Make",
            index: true,
        },
    },
    {
        path: "makes/:id/visualizar",
        name: "makes.show",
        component: () => import("../views/View.vue"),
        meta: {
            label: "View Make",
            index: true,
        },
    },
    {
        path: "makes/cadastrar",
        name: "makes.create",
        component: () => import("../views/Create.vue"),
        meta: {
            label: "Create Make",
            index: true,
        },
    },
];

export { makes };