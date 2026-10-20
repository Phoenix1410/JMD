import {
  SET_SITE_DATA,
  SET_PAGE,
  SET_USER_DATA,
  SET_LOADING
} from "./Action";

const initialState = {
  siteData: {},
  userData: {},
  page: "",
  isLoading: true,
};

const reducer = (state = initialState, action) => {
  const { type, payload } = action;

  switch (type) {
    case SET_SITE_DATA:
      return {
        ...state,
        siteData: { ...state.siteData, ...payload }
      };

    case SET_PAGE:
      if (state.page === payload) return state;
      return {
        ...state,
        page: payload
      };

    case SET_USER_DATA:
      return {
        ...state,
        userData: { ...state.userData, ...payload }
      };

    case SET_LOADING:
      return {
        ...state,
        isLoading: Boolean(payload)
      };

    default:
      return state;
  }
};

export default reducer;
