export default {
    namespaced: true,
    
    state: {
        status: false,
        text: null,
        code: null,
        variant: 'danger',
    },

    getters: {
        getError (state) {
            return state
        }
    },

    mutations: {
        changeErrorStatus (state) {
            state.status = !state.status;
        },
        changeErrorInfo (state, payload) {
            state.text = payload.text;
            state.code = payload.code;
            state.status = payload.status;
            if (payload.variant) state.variant = payload.variant;
        },
        defaultVariant (state) {
            state.variant = 'danger'
        }
    },

    actions: {
        changeError ({commit}, payload) {
            //commit('changeErrorStatus');
            commit('changeErrorInfo', payload);
        },
        clearError ({commit}, payload) {
            commit('changeErrorInfo', payload);
        }
    }
}
