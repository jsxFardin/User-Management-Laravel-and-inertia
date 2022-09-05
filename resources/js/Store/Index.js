import { createStore } from "vuex";
import Menu from "./Modules/Menu";
import AuthUser from "./Modules/AuthUser";

export const store = new createStore({
    modules: {
        Menu,
        AuthUser,
    },
});
