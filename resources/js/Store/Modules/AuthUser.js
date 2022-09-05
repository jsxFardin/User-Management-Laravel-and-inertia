const getDefaultUserState = () => {
    return {
        authUser: {
            id: "",
            id_no: "",
            name: "...",
            email: "",
            mobile: "",
            username: "",
            agencies: [],
            teams: [],
        },
    };
};
const state = getDefaultUserState();

const getters = {
    getAuthUser: (state) => state.authUser,
    getAgencies: (state) => state.authUser.agencies,
    getTeams: (state) => state.authUser.teams
};

const actions = {
    getUser: ({ commit, dispatch }) => {
        let actionUrl = "ajax/auth-user";
        if (state.authUser.id != "" || state.authUser.email != "") return true;

        return new Promise((resolve, reject) => {
            axios
                .get(actionUrl)
                .then((resp) => {
                    commit("successUser", resp.data.user);
                    resolve(resp.data);
                })
                .catch((err) => {
                    reject(err);
                });
        });
    }
};

const mutations = {
    successUser: (state, data) => {
        state.authUser = data;
    },
    resetUserState(state) {
        Object.assign(state, getDefaultUserState());
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
