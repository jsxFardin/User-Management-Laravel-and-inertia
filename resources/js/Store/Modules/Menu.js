const getDefaultState = () => {
    return {
        menus: [],
    };
};

const state = getDefaultState()

const getters = {
    getMenus: state => state.menus
}

const actions = {
    menuRequest: ({commit, dispatch}, payload) => {
        let actionUrl = 'ajax/get-menus'

        if(state.menus.length != 0) return true;

        return new Promise((resolve, reject) => {
            axios.get(actionUrl, { params:payload })
                .then((resp) => {
                    commit('success', resp.data);
                    resolve(resp.data);
                })
                .catch((err) => {
                    reject(err)
                })
        })
    }
}

const mutations = {
    success: (state, data) => {
        state.menus = data
    },
    resetState(state) {
        Object.assign(state, getDefaultState());
    },
}

export default {
    state,
    getters,
    actions,
    mutations
}
