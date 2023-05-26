import { defineStore } from 'pinia'
export const useManagerMemuStore = defineStore('menus', {
    state: () => ({
        currentMenu: null,
        menus: [],
        items: [],
        isSidebar: false,
        isSidebarExpanded: false,
    }),
    getters: {
        getCurrentMenu: (state) => state.currentMenu,
        getMenus: (state) => state.menus,
        getIsSidebar: (state) => state.isSidebar,
        getIsSidebarExpanded: (state) => state.isSidebarExpanded,
    },
    actions: {
        setIsSidebarExpanded(isSidebarExpanded) {
            this.isSidebarExpanded = isSidebarExpanded
        },
        setHiddeSidebarExpanded() {
            this.setIsSidebar(false)
        },
        setCurrentMenu(currentMenu) {
            this.currentMenu = currentMenu
        },
        setMenus(menus) {
            this.menus = menus
        },
        setIsSidebar(isSidebar) {
            this.isSidebar = isSidebar
            this.isSidebarExpanded = isSidebar
            this.expandSidaber()
        },
        setMenuItems(items) {
            this.items = items
        },
        toogleSidaber() {
            this.isSidebar = !this.isSidebar
            this.isSidebarExpanded = !this.isSidebarExpanded
            this.expandSidaber()
        },
        expandSidaber() {
            setTimeout(() => {
                if (this.isSidebar) {
                    document.body.classList.add("is-sidebar-open");
                } else {
                    // this.setMenuItems([])
                    // this.setCurrentMenu(null)
                    document.body.classList.remove("is-sidebar-open");
                }
            }, 200);
        }
    },
})
